<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AcquiringClient;
use Illuminate\Support\Facades\Hash;

class CreateAcquiringClient extends Command
{
    protected $signature = 'acquiring-client:create {password}';
    protected $description = 'Создает нового клиента AcquiringClient';

    public function handle()
    {
        $password = $this->argument('password');

        $client = AcquiringClient::create([
            'password' => Hash::make($password),
        ]);

        $this->info('Клиент AcquiringClient успешно создан с паролем: ' . $password);
    }
}
