<?php

return [
    'STICKY_CREDENTIALS' => [
        'STICKY_API_DOMAIN'   => 'https://sketchbrains.sticky.io',
        'STICKY_API_USERNAME' => 'TESTER 9',
        'STICKY_API_PASSWORD' => 'VMjjYyXhbVk5W8',
    ],

    'ENDPOINTS' => [
        'NEW_PROSPECT' => '/api/v1/new_prospect',
    ],

    'NEW_PROSPECT_VALIDATION' => [
        'campaignId' => 'required',
        'email'      => 'required',
        'ipAddress'  => 'required',
    ],
];
