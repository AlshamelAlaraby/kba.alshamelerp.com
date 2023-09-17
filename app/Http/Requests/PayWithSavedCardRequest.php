<?php

namespace App\Http\Requests;

use App\Modules\Order\OrderLibrary;
use Illuminate\Foundation\Http\FormRequest;

class PayWithSavedCardRequest extends FormRequest
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
     * @return array
     */
    public function rules(OrderLibrary $orderLibrary)
    {
        return [
            'saved_card_id' => ['required', function ($attribute, $value, $fail) {
                if (!$this->user()->cards()->where('id', $value)->exists())
                    $fail("Invalid card");
            }],
            'merchant_reference' => ['required', function ($attribute, $value, $fail) use($orderLibrary) {
                if (!$orderLibrary->findWithDeleted($value)->user_id == $this->user()->id){
                    $fail("Invalid reference number");
                }
            }],
        ];
    }
}
