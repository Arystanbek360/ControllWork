<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    public function chargeCard(array $cardData, $amount): Response|bool
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . config('acquiring.token'),
            ])->post(
                config('acquiring.api') . '/cards/charge',
                array_merge($cardData, ['amount' => $amount])
            );

            return $response;
        } catch (Exception $e) {
            throw new Exception(
                'Ошибка при обработке платежа: ' . $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
