<?php

namespace App\Console\Commands;

use App\Models\CardCenter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddCard extends Command
{
    protected $signature = 'card:add {number} {expiry_month} {expiry_year} {csv} {owner_name} {balance}';
    protected $description = 'Добавляет новую карту в систему';

    public function handle()
    {
        $card = CardCenter::create([
            'number' => $this->argument('number') ?? rand(1000000000000000, 9999999999999999),
            'expiry_month' => $this->argument('expiry_month') ?? rand(1, 12),
            'expiry_year' => $this->argument('expiry_year') ?? rand(2020, 2220),
            'csv' => Hash::make($this->argument('csv') ?? 001),                                         //csv 001
            'name' => $this->argument('owner_name') ?? 'Example Name',
            'balance' => $this->argument('balance') ?? rand(0, 999999),
        ]);

        $this->info('Карта успешно добавлена: ' . $card->number);
    }
}
