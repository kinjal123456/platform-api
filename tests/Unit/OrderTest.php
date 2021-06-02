<?php

namespace Tests\Unit;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Validate New Order API unit test.
     *
     * @return void
     */
    public function testNewOrderValidateApiRequest()
    {
        $data = [
            "firstName"        => "",
            "lastName"         => "",
            "shippingAddress1" => "",
            "shippingAddress2" => "",
            "shippingCity"     => "",
            "shippingState"    => "",
            "shippingZip"      => "",
            "shippingCountry"  => "",
            "phone"            => "",
            "email"            => "",
            "creditCardType"   => "",
            "creditCardNumber" => "",
            "expirationDate"   => "",
            "CVV"              => "",
            "shippingId"       => "",
            "tranType"         => "",
            "ipAddress"        => "",
            "campaignId"       => "",
            "offers"           => "",
        ];

        $validateFields = [
            'firstName',
            'lastName',
            'shippingAddress1',
            'shippingCity',
            'shippingState',
            'shippingZip',
            'shippingCountry',
            'phone',
            'email',
            'creditCardType',
            'creditCardNumber',
            'expirationDate',
            'CVV',
            'shippingId',
            'tranType',
            'ipAddress',
            'campaignId',
            'offers',
        ];

        $this->json('POST', 'api/order/create', $data, ['Accept' => 'application/json'])->assertOk()->assertHeader('Content-Type', 'application/json')->assertJsonValidationErrors($validateFields, 'data.0');
    }

    /**
     * New Order API unit test.
     *
     * @return void
     */
    public function testNewOrderApi()
    {
        $data = [
            "firstName"        => "Test",
            "lastName"         => "Donotship",
            "shippingAddress1" => "123 Medellin St, test",
            "shippingAddress2" => "APT 7, test",
            "shippingCity"     => "Santo Alto",
            "shippingState"    => "TX",
            "shippingZip"      => "33544",
            "shippingCountry"  => "US",
            "phone"            => "8135551212",
            "email"            => "postman@apitest.com",
            "creditCardType"   => "VISA",
            "creditCardNumber" => "1444444444444440",
            "expirationDate"   => "0628",
            "CVV"              => "123",
            "shippingId"       => "6",
            "tranType"         => "Sale",
            "ipAddress"        => "127.0.0.1",
            "campaignId"       => "1",
            "offers"           => [
                [
                    "offer_id"         => "8",
                    "product_id"       => "4",
                    "billing_model_id" => "",
                    "quantity"         => "1",
                ],
            ],
        ];

        $this->json('POST', 'api/order/create', $data, ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
                'error',
                'success',
                'message',
                'data',
            ]);
    }

    /**
     * Validate View Order API unit test.
     *
     * @return void
     */
    public function testOrderViewValidateApiRequest()
    {
        $data = [
            "order_id" => [],
        ];

        $this->json('POST', 'api/order/view', $data, ['Accept' => 'application/json'])->assertOk()->assertHeader('Content-Type', 'application/json')->assertJsonValidationErrors('order_id', 'data.0');
    }

    /**
     * View Order API unit test.
     *
     * @return void
     */
    public function testViewOrderAPI()
    {
        $data = [
            "order_id" => [27157],
        ];

        $this->json('POST', 'api/order/view', $data, ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'data',
        ]);
    }
}
