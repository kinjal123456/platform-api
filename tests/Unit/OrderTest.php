<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Order crate unit test.
     *
     * @return void
     */
    public function testOrderView()
    {
        $data = [
            "order_id" => [27157],
        ];;

        $this->json('POST', 'api/order/view', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "error" => false,
                "success" => true,
                "message" => Config::get('sticky.view_order_success'),
                "data" => [],
            ]);
    }
}
