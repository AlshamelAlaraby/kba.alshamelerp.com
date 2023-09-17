<?php

namespace App\Http\Requests;

use App\Modules\Order\Enum\Status;
use App\Modules\Order\OrderLibrary;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param OrderLibrary $orderLibrary
     * @return bool
     */
    public function authorize(OrderLibrary $orderLibrary)
    {
        $order = $orderLibrary->find($this->route()->parameter('order'));
        return $order->status === Status::WAITING_FOR_PAYMENT && $order->user_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
