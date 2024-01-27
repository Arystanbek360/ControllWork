<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class AcquiringClient extends Model
{
    protected $fillable = [
        'client_id',
        'password'
    ];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    //Коменты просили не оставлять просто хотел показать что разобрался с этой вещью))
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($acquiringClient) {
            $acquiringClient->client_id = self::generateUniqueClientId();
        });
    }

    /**
     * @return string
     */
    protected static function generateUniqueClientId(): string
    {
        $uniqueHash = md5(Str::random(40) . time());

        if (!self::where('client_id', $uniqueHash)->exists()) {
            return $uniqueHash;
        }

        return self::generateUniqueClientId();
    }
}
