<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardResource;
use App\Models\CardCenter;
use Illuminate\Http\Request;

class InternalController extends Controller
{
    public function getCards()
    {
        $cards = CardCenter::all();
        return CardResource::collection($cards);
    }
}
