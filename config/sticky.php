<?php

return [
    'ENDPOINTS' => [
        'NEW_PROSPECT' => '/api/v1/new_prospect',
    ],

    'NEW_PROSPECT_VALIDATION' => [
        'campaignId' => 'required|numeric',
        'email'      => 'required|email',
        'ipAddress'  => 'string',
        'firstName'  => 'string',
        'lastName'   => 'string',
        'address1'   => 'string',
        'address2'   => 'string',
        'city'       => 'string',
        'state'      => 'string',
        'zip'        => 'numeric',
        'country'    => 'string',
        'phone'      => 'numeric',
        'AFID'       => 'string',
        'SID'        => 'string',
        'AFFID'      => 'string',
        'C1'         => 'string',
        'C2'         => 'string',
        'C3'         => 'string',
        'AID'        => 'string',
        'OPT'        => 'string',
        'click_id'   => 'string',
        'notes'      => 'string',
    ],
];
