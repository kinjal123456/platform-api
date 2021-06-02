<?php

namespace Tests\Unit;

use Tests\TestCase;

class UpsellTest extends TestCase
{
    /**
     * Validate New Upsell API unit test.
     *
     * @return void
     */
    public function testNewUpsellValidateApiRequest()
    {
        $data = [
            "previousOrderId" => "",
            "shippingId"      => "",
            "offers"          => "",
        ];

        $validateFields = [
            "previousOrderId",
            "shippingId",
            "offers",
        ];

        $this->json('POST', 'api/upsell/create', $data, ['Accept' => 'application/json'])->assertOk()->assertHeader('Content-Type', 'application/json')->assertJsonValidationErrors($validateFields, 'data.0');
    }

    /**
     * New Upsell API unit test.
     *
     * @return void
     */
    public function testNewUpsellApi()
    {
        $this->json('POST', 'api/upsell/create', ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'data',
        ]);
    }
}
