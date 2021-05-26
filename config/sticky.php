<?php

return [
    'ENDPOINTS' => [
        'STICKY' => [
            'NEW_PROSPECT'    => '/api/v1/new_prospect',
            'UPDATE_PROSPECT' => '/api/v1/prospect_update',
            'NEW_ORDER'       => '/api/v1/new_order',
            'NEW_UPSELL'      => '/api/v1/new_upsell',
        ],
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

    'UPDATE_PROSPECT_VALIDATION' => [
        'first_name' => 'string',
        'last_name'  => 'string',
        'address'    => 'string',
        'address2'   => 'string',
        'city'       => 'string',
        'state'      => 'string',
        'zip'        => 'numeric',
        'country'    => 'string',
        'phone'      => 'numeric',
        'email'      => 'required|email',
        'notes'      => 'string',
    ],

    'NEW_ORDER_VALIDATION' => [
        'firstName'        => 'required',
        'lastName'         => 'required',
        'shippingAddress1' => 'required',
        'shippingCity'     => 'required',
        'shippingState'    => 'required',
        'shippingZip'      => 'required',
        'shippingCountry'  => 'required',
        'billingFirstName' => 'required',
        'billingLastName'  => 'required',
        'billingAddress1'  => 'required',
        'billingCity'      => 'required',
        'billingState'     => 'required',
        'billingZip'       => 'required',
        'billingCountry'   => 'required',
        'phone'            => 'required',
        'email'            => 'required',
        'creditCardType'   => 'required',
        'creditCardNumber' => 'required',
        'expirationDate'   => 'required',
        'CVV'              => 'required',
        'shippingId'       => 'required',
        'tranType'         => 'required',
        'ipAddress'        => 'required',
        'campaignId'       => 'required',
        'offers'           => 'required',
    ],

    'NEW_UPSELL_VALIDATION' => [
        'previousOrderId' => 'required',
        'shippingId'      => 'required',
        'ipAddress'       => 'required',
        'campaignId'      => 'required',
        'offers'          => 'required',
    ],
];
