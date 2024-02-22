<?php
return [
    'serverKey' => env('MIDTRANS_SERVERKEY'),
    'clientKey' => env('MIDTRANS_CLIENTKEY'),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION'),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED'),
    'is3ds' => env('MIDTRANS_IS_3DS'),
    'callback' => env('APP_URL') . '/callback',
];
