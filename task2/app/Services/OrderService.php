<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\AcquiringClient;
use App\Models\Item;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    public function __construct(public PaymentService $paymentService)
    {
    }

    /**
     * @return array{message: string, order: mixed}
     */
    public function createOrder(array $data): array
    {
        $acquiringClient = $this->getAcquiringClient($data['token'], $data['password']);

        $orderData = $this->getOrderItems($data['orderItems']);
        $order = $this->storeOrder($acquiringClient->id, $orderData, $data['card']);

        $this->processPayment($order, $data['card']);

        return [
            'message' => 'Заказ успешно сформирован',
            'order' => OrderResource::make($order)
        ];
    }

    /**
     * @param $token
     * @param $password
     * @return AcquiringClient
     * @throws Exception
     */
    protected function getAcquiringClient($token, $password): AcquiringClient
    {
        $acquiringClient = AcquiringClient::where('client_id', $token)->first();
        if (!$acquiringClient || !Hash::check($password, $acquiringClient->password)) {
            throw new Exception('Неверный токен или пароль', Response::HTTP_BAD_REQUEST);
        }
        return $acquiringClient;
    }

    /**
     * @param $orderItems
     * @return array
     */
    protected function getOrderItems($orderItems): array
    {
        $orderData = [];
        foreach ($orderItems as $orderItem) {
            $item = Item::find($orderItem['id']);
            if ($item) {
                $orderData[] = [
                    'name' => $item->name,
                    'amount' => $item->amount,
                    'qty' => $orderItem['qty'],
                ];
            }
        }
        return $orderData;
    }

    /**
     * @param $clientId
     * @param $orderData
     * @param $cardData
     * @return Order
     */
    protected function storeOrder($clientId, $orderData, $cardData): Order
    {
        return Order::create([
            'acquiring_client_id' => $clientId,
            'data' => json_encode($orderData),
            'card' => json_encode($cardData),
            'status' => Order::STATUS_WAITING,
            'date' => now(),
        ]);
    }

    /**
     * @param Order $order
     * @param array $cardData
     * @return void
     * @throws Exception
     */
    protected function processPayment(Order $order, array $cardData): void
    {
        $response = $this->paymentService->chargeCard($cardData, $order->amount());

        if ($response->ok()) {
            $order->update(['status' => Order::STATUS_PAID, 'date' => now()]);
        } else {
            $order->update(['status' => Order::STATUS_FAILED, 'date' => now()]);
            throw new Exception(
                'Ошибка оплаты: ' . json_decode($response->body())?->message, Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @return array{order: mixed}
     */
    public function getOrderStatus(array $data): array
    {
        $this->getAcquiringClient($data['client_id'], $data['password']);

        $order = Order::where('order_number', $data['orderNumber'])->firstOrFail();
        return ['order' => OrderResource::make($order)];
    }
}
