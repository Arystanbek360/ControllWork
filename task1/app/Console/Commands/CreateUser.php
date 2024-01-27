<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'client:create {name} {email} {password}';
    protected $description = 'Создает нового клиента CardCenterClient';

    public function handle()
    {
        $client = User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password') ?? 'password'),
        ]);

        $this->info('Клиент успешно создан: ' . $client->name);
    }
}
