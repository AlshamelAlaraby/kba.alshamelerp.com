<?php

namespace App\Http\Requests;

use App\Modules\Cart\CartLibrary;
use App\Modules\Product\Models\ProductStore;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param CartLibrary $library
     * @return array
     */
    public function rules(CartLibrary $library)
    {
        return [
            'item' => 'required|exists:product_store,id',
            'quantity' => ['required', function ($attribute, $value, $fail) use ($library) {
                if (!$library->ItemQuantityCheck($this->item, ProductStore::class, $value)) {
                    $fail(trans("messages.This product or quantity isn't available"));
                }
            }]
        ];
    }
}
