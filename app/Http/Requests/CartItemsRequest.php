<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Bisa disesuaikan jika perlu otorisasi khusus
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id', // Pastikan produk valid
            'quantity'   => 'required|integer|min:1',      // Minimal 1 item
        ];
    }
}
