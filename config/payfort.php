<?php

return [
    'merchant_identifier' => env('PAYFORT_MERCHANT_IDENTIFIER'),
    'access_code' => env('PAYFORT_ACCESS_CODE'),
    'purchase_return_url' => env('PAYFORT_PURCHASE_RETURN_URL'),
    'tokenization_return_url' => env('PAYFORT_TOKENIZATION_RETURN_URL'),
    'request_sign' => env('PAYFORT_REQUEST_SIGN'),
    'response_sign' => env('PAYFORT_RESPONSE_SIGN'),
    'tokenization_url' => env('PAYFORT_TOKENIZATION_URL','https://checkout.payfort.com/FortAPI/paymentPage'),
    'purchase_url' => env('PAYFORT_PURCHASE_URL','https://paymentservices.payfort.com/FortAPI/paymentApi'),
    'currency' => env('PAYFORT_CURRENCY'),
    'language' => env('PAYFORT_LANGUAGE'),
];
