<?php

namespace Database\Seeders;

use App\Models\CardCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardCenterSeeder extends Seeder
{
    public function run(): void
    {
        CardCenter::factory(5)->create();
    }
}
