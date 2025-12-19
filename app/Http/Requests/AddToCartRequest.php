<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pizza_code' => ['required', 'string', 'exists:pizzas,code'],
            'qty'        => ['required', 'integer', 'min:1', 'max:20'],
            'toppings'   => ['array'],
            'toppings.*' => ['integer', 'exists:toppings,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'pizza_code.exists' => 'Invalid pizza selected.',
        ];
    }
}
