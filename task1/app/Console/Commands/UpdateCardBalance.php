<?php

namespace App\Console\Commands;

use App\Models\CardCenter;
use Illuminate\Console\Command;

class UpdateCardBalance extends Command
{
    protected $signature = 'card:balance-update {number} {amount}';
    protected $description = 'Обновляет баланс карты';

    public function handle()
    {
        $card = CardCenter::where('number', $this->argument('number'))
            ->first();

        if (!$card) {
            $this->error('Карта не найдена');
            return;
        }

        $card->balance += $this->argument('amount');
        $card->save();

        $this->info('Баланс успешно обновлен. Текущий баланс: ' . $card->balance);
    }
}
