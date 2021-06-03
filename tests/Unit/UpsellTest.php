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
        $data = [
            "previousOrderId" => "27159",
            "shippingId"      => 8,
            "offers"          => [
                [
                    "offer_id"         => 1,
                    "product_id"       => 14,
                    "billing_model_id" => 2,
                    "quantity"         => 2,
                    "step_num"         => 2,
                ],
            ],
        ];

        $this->json('POST', 'api/upsell/create', $data, ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'data',
        ])->assertJson([
            'error'   => false,
            'success' => true,
            'message' => __('sticky.new_upsell_create_success'),
        ]);
    }
}
