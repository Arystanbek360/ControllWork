<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AcquiringClientsTableSeeder::class,
            ItemSeeder::class,
            OrdersTableSeeder::class
        ]);
    }
}
