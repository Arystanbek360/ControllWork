<?php

namespace App\Services;

use App\Http\Resources\CardResource;
use App\Models\CardCenter;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AcquiringService
{
    public function check(string $cardNumber)
    {
        $card = CardCenter::where('number', $cardNumber)->first();

        if (!$card) {
            throw new \Exception("Карта с номером {$cardNumber} не найдена.", Response::HTTP_NOT_FOUND);
        }

        return [
            'message' => "Карта с номером {$cardNumber} найдена",
            'card' => CardResource::make($card)
        ];
    }

    public function chargeCard(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $card = CardCenter::where('number', $data['number'])->first();
            if (!$card && Hash::check($card->csv, $data['csv'])) {
                throw new Exception("Неверные данные карты", Response::HTTP_BAD_REQUEST);
            }
            if ($card->balance < $data['amount']) {
                throw new Exception("Недостаточно средств на карте", Response::HTTP_BAD_REQUEST);
            }

            $card->balance -= $data['amount'];
            $card->save();

            Transaction::create([
                'card_center_id' => $card->id,
                'amount' => $data['amount'],
                'action' => 'outcome',
                'date' => now(),
            ]);

            return ['message' => 'Средства успешно списаны', 'balance' => $card->balance];
        });
    }
}