<?php

namespace App\Modules\Common\Traits;

trait HasPurchaseAttributes
{
    public function purchasePrice()
    {
        return $this->price;
    }

    public function purchaseCache()
    {
        return [
          //
        ];
    }

    public function updateStock($transaction)
    {
        //
    }
}
