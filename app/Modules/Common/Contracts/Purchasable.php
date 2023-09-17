<?php

namespace App\Modules\Common\Contracts;

interface Purchasable
{
    public function purchasePrice();

    public function purchaseCache();

    public function updateStock($transaction);

    public function isAvailable();

    public function minQuantity();

    public function maxQuantity();

    public function quantityStep();

    public function availableQuantity($quantity);
}
