<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Tests\TestDataFaker;

class ProspectTest extends TestCase
{
    private $faker;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->faker = new TestDataFaker();
    }

    /**
     * New Prospect API unit test (with valid data).
     *
     * @return void
     */
    public function testNewProspectApiWithValidData()
    {
        $this->json('POST', 'api/prospect/create', $this->faker->prepareNewProspectValidData(), ['Accept' => 'application/json'])->assertOk()->assertHeader('Content-Type', 'application/json')->assertJsonStructure([
            'error',
            'success',
            'message',
            'apiError',
            'data',
        ])->assertJson([
            'error'   => false,
            'success' => true,
            'message' => __('sticky.new_prospect_create_success'),
            'apiError' => ''
        ]);
    }

    /**
     * New Prospect API unit test (with invalid data).
     *
     * @return void
     */
    public function testNewProspectApiWithInvalidData()
    {
        $this->json('POST', 'api/prospect/create', $this->faker->prepareNewProspectInvalidData(), ['Accept' => 'application/json'])->assertOk()->assertHeader('Content-Type', 'application/json')->assertJsonStructure([
            'error',
            'success',
            'message',
            'apiError',
            'data',
        ])->assertJson([
            'error'    => true,
            'success'  => false,
            'message'  => '',
            'apiError' => 'Invalid campaign id of  1432432', //Campaign Id i.e. pass from the payload
        ]);
    }

    /**
     * Update Prospect API unit test (with valid data).
     *
     * @return void
     */
    public function testUpdateProspectApiWithValidData()
    {
        $this->json('POST', 'api/prospect/update', $this->faker->prepareUpdateProspectValidData(), ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'apiError',
            'data',
        ])->assertJson([
            'error'   => false,
            'success' => true,
            'message' => __('sticky.update_prospect_success'),
            'apiError' => ''
        ]);
    }

    /**
     * Update Prospect API unit test (with invalid data).
     *
     * @return void
     */
    public function testUpdateProspectApiWithInvalidData()
    {
        $this->json('POST', 'api/prospect/update', $this->faker->prepareUpdateProspectInvalidData(), ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'apiError',
            'data',
        ])->assertJson([
            'error'   => false,
            'success' => true,
            'message' => __('sticky.update_prospect_success'),
            'apiError' => '',
            'data' => [
                'response_code' => '911'
            ]
        ]);
    }
}
