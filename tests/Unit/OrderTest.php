<?php

namespace Tests\Unit;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Validate Order view API unit test.
     *
     * @return void
     */
    public function testOrderViewValidateApiRequest()
    {
        $data = [
            "order_id" => [],
        ];

        $this->json('POST', 'api/order/view', $data, ['Accept' => 'application/json'])
            ->assertOk()
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonValidationErrors('order_id', 'data.0');
    }

    /**
     * Order view API unit test.
     *
     * @return void
     */
    public function testOrderViewAPI()
    {
        $data = [
            "order_id" => [27157],
        ];

        $this->json('POST', 'api/order/view', $data, ['Accept' => 'application/json'])
            ->assertOk()
            ->assertJsonStructure([
                'error', 'success', 'message', 'data'
            ]);
    }
}
