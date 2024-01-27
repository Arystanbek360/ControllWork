<?php

namespace Database\Seeders;

use App\Models\AcquiringClient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AcquiringClientsTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i <= 5; $i++) {
            AcquiringClient::create([
                'password' => Hash::make('password'),
            ]);
        }
    }
}
