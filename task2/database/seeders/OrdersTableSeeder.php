<?php

namespace Database\Seeders;

use App\Models\AcquiringClient;
use App\Models\Item;
use App\Models\Order;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['paid', 'waiting', 'failed'];

        foreach ($this->getCards() as $item) {
            unset($item->csv);
            unset($item->balance);
            Order::create([
                'acquiring_client_id' => AcquiringClient::inRandomOrder()->first()->id,
                'data' => json_encode($this->getItems()),
                'status' => $status[rand(0, 2)],
                'card' => json_encode($item),
                'date' => now(),
            ]);
        }
    }

    private function getCards()
    {
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer OktIGTnlJlvjdzeMcKTlcuTsF'
        ];
        $request = new Request('GET', 'http://127.0.0.1:8000/api/getCards', $headers);
        $res = $client->sendAsync($request)->wait();
        $data = json_decode($res->getBody());

        return $data->data;
    }

    /**
     * @return array
     */
    private function getItems(): array
    {
        $randomItems = Item::inRandomOrder()->limit(rand(1, 4))->get();
        $orderData = $randomItems->map(function ($item) {
            return [
                'name' => $item->name,
                'amount' => $item->amount,
                'qty' => rand(1, 10),
            ];
        })->toArray();
        return $orderData;
    }
}
