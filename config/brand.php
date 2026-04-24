<?php

return [
    'instagram_handle' => env('BRAND_INSTAGRAM_HANDLE', '@paulmwaikenda'),
    'instagram_url' => env('BRAND_INSTAGRAM_URL', 'https://www.instagram.com/paulmwaikenda/'),

    'contact' => [
        'whatsapp_number' => env('BRAND_WHATSAPP_NUMBER', ''),
        'phone_number' => env('BRAND_PHONE_NUMBER', ''),
    ],

    'payment' => [
        'gateway' => env('BRAND_PAYMENT_GATEWAY', 'Selcom / DPO / Pesapal / AzamPay'),

        'links' => [
            'starter_guide' => env('PAYMENT_LINK_STARTER_GUIDE', ''),
            'starter_kit' => env('PAYMENT_LINK_STARTER_KIT', ''),
            'workshop' => env('PAYMENT_LINK_WORKSHOP', ''),
            'coaching' => env('PAYMENT_LINK_COACHING', ''),
            'private_mentorship' => env('PAYMENT_LINK_PRIVATE_MENTORSHIP', ''),
            'program_90_day' => env('PAYMENT_LINK_90_DAY_PROGRAM', ''),
        ],

        'api' => [
            'create_order' => env('API_ENDPOINT_CREATE_ORDER', ''),
            'verify_payment' => env('API_ENDPOINT_VERIFY_PAYMENT', ''),
            'webhook_callback_url' => env('WEBHOOK_CALLBACK_URL', ''),
        ],
    ],
];
