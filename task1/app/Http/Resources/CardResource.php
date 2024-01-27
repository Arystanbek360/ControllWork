<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'expiry_month' => $this->expiry_month,
            'expiry_year' => $this->expiry_year,
            'csv' => $this->csv,
            'owner' => $this->name,
            'balance' => $this->balance,
        ];
    }
}
