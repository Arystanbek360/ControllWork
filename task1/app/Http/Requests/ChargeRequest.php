<?php

namespace App\Http\Requests;

use App\Rules\ValidExpiryDate;
use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
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
            'number' => ['required', 'integer', 'digits:16', 'exists:card_centers,number'],
            'expiry_month' => ['required', 'string', 'min:2', 'max:2'],
            'expiry_year' => ['required', 'string', 'max:4', 'min:4'],
            'csv' => ['required', 'numeric', 'digits:3'],
            'owner' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0.01']
        ];
    }
}
