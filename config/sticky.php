<?php

return [
    'ENDPOINTS' => [
        'NEW_PROSPECT' => '/api/v1/new_prospect',
    ],

    'NEW_PROSPECT_VALIDATION' => [
        'campaignId' => 'required|int',
        'email'      => 'required|email',
        'ipAddress'  => 'required|string',
    ],
];
