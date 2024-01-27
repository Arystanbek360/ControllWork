<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'expiry_month',
        'expiry_year',
        'csv',
        'name',
        'balance',
    ];


}
