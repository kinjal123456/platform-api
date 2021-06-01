<?php

return [
    'ENDPOINTS' => [
        'STICKY' => [
            'NEW_PROSPECT'         => '/api/v1/new_prospect',
            'UPDATE_PROSPECT'      => '/api/v1/prospect_update',
            'NEW_ORDER'            => '/api/v1/new_order',
            'UPDATE_ORDER'         => '/api/v1/order_update',
            'VIEW_ORDER'           => '/api/v1/order_view',
            'NEW_UPSELL'           => '/api/v1/new_upsell',
            'GET_SHIPPING_METHODS' => '/api/v2/shipping',
        ],
    ],

    'RESPONSE_CODES' => [
        'STICKY' => [
            '100',
            '200',
        ],
    ],

    'METHODS' => [
        'get'    => 'GET',
        'post'   => 'POST',
        'put'    => 'PUT',
        'delete' => 'DELETE',
    ],

    'API_DEFAULT_RESPONSE' => [
        'error'   => true,
        'success' => true,
        'message' => '',
        'data'    => [],
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
        'email'      => 'email',
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

    'UPDATE_ORDER_VALIDATION' => [
        'notes'      => 'string',
        'email'      => 'email',
        'first_name' => 'string',
        'last_name'  => 'string',
    ],

    'VIEW_ORDER_VALIDATION' => [
        'order_id' => 'required|array',
    ],

    'NEW_UPSELL_VALIDATION' => [
        'previousOrderId' => 'required',
        'shippingId'      => 'required',
        'offers'          => 'required|array',
    ],
];
