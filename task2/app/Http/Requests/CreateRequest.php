<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => 'required',
            'password' => 'required',
            'orderItems' => 'required|array',
            'orderItems.*.id' => 'required|integer|exists:items,id',
            'orderItems.*.qty' => 'required|integer|exists:items,id',
            'card' => 'required|array',
            'card.number' => 'required|integer|digits:16',
            'card.expiry_month' => 'required|numeric|digits:2',
            'card.expiry_year' => 'required|numeric|digits:4',
            'card.csv' => 'required|numeric|digits:3',
            'card.owner' => 'required|string',
            'amount' => 'required|numeric',
        ];
    }
}
