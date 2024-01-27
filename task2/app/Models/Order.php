<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Order extends Model
{
    public const STATUS_WAITING = 'waiting';
    public const STATUS_FAILED = 'failed';
    public const STATUS_PAID = 'paid';

    protected $fillable = [
        'acquiring_client_id',
        'order_number',
        'data',
        'status',
        'card',
        'date',
    ];

    protected $casts = [
        'data' => 'array',
        'card' => 'array',
        'date' => 'timestamp',
    ];

    public function client()
    {
        return $this->belongsTo(AcquiringClient::class, 'acquiring_client_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = self::generateUniqueOrderNumber();
        });
    }

    public function amount(): int
    {
        $totalAmount = 0;
        $orderItems = json_decode($this->data, true);

        foreach ($orderItems as $item) {
            $totalAmount += $item['amount'] * $item['qty'];
        }

        return $totalAmount;
    }

    /**
     * @return string
     */
    protected static function generateUniqueOrderNumber()
    {
        $uniqueHash = md5(Str::random(40) . time());

        if (!self::where('order_number', $uniqueHash)->exists()) {
            return $uniqueHash;
        }

        return self::generateUniqueClientId();
    }
}
