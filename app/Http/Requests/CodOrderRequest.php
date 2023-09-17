<?php

namespace App\Http\Requests;

use App\Modules\Order\OrderLibrary;
use Illuminate\Foundation\Http\FormRequest;

class CodOrderRequest extends FormRequest
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
     * @param OrderLibrary $orderLibrary
     * @return array
     */
    public function rules(OrderLibrary $orderLibrary)
    {
        return [
            'order_id' => ['required', function ($attribute, $value, $fail) use ($orderLibrary) {
                $order = $orderLibrary->findWithDeleted($value);
                if (!$order || $order->user_id != $this->user()->id) {
                    $fail('Invalid order');
                }
            }]
        ];
    }
}
