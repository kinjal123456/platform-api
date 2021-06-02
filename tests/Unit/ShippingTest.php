<?php

namespace Tests\Unit;

use Tests\TestCase;

class ShippingTest extends TestCase
{
    /**
     * Get Shipping Methods API unit test.
     *
     * @return void
     */
    public function testGetShippingMethodsApi()
    {
        $this->json('GET', 'api/shipping/get', ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'data',
        ]);
    }
}
