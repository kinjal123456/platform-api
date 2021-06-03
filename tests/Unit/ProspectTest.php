<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ProspectTest extends TestCase
{
    /**
     * Validate New Prospect API unit test.
     *
     * @return void
     */
    public function testNewProspectValidateApiRequest()
    {
        $data = [
            "campaignId" => "",
            "email"      => "",
            "ipAddress"  => "",
            "firstName"  => "",
            "lastName"   => "",
            "address1"   => "",
            "address2"   => "",
            "city"       => "",
            "state"      => "",
            "zip"        => "",
            "country"    => "",
            "phone"      => "",
            "AFID"       => "",
            "SID"        => "",
            "AFFID"      => "",
            "C1"         => "",
            "C2"         => "",
            "C3"         => "",
            "AID"        => "",
            "OPT"        => "",
            "click_id"   => "",
            "notes"      => "",
        ];

        $validateFields = [
            "campaignId",
            "email",
            "ipAddress",
            "firstName",
            "lastName",
            "address1",
            "address2",
            "city",
            "state",
            "zip",
            "country",
            "phone",
            "AFID",
            "SID",
            "AFFID",
            "C1",
            "C2",
            "C3",
            "AID",
            "OPT",
            "click_id",
            "notes",
        ];

        $this->json('POST', 'api/prospect/create', $data, ['Accept' => 'application/json'])->assertOk()->assertHeader('Content-Type', 'application/json')->assertJsonValidationErrors($validateFields, 'data.0');
    }

    /**
     * New Prospect API unit test.
     *
     * @return void
     */
    public function testNewProspectApi()
    {
        $data = [
            "campaignId" => "1",
            "email"      => "test2prospect@gmail.com",
            "ipAddress"  => "127.0.0.1",
        ];

        $this->json('POST', 'api/prospect/create', $data, ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'data',
        ]);
    }

    /**
     * Validate Update Prospect API unit test.
     *
     * @return void
     */
    public function testUpdateProspectValidateApiRequest()
    {
        $data = [
            "prospect_id" => [
                "7642" => [
                    "first_name" => "",
                    "last_name"  => "",
                    "address"    => "",
                    "address2"   => "",
                    "city"       => "",
                    "state"      => "",
                    "zip"        => "",
                    "country"    => "",
                    "phone"      => "",
                    "email"      => "",
                    "notes"      => "",
                ],
            ],
        ];

        $validateFields = [
            "first_name",
            "last_name",
            "address",
            "address2",
            "city",
            "state",
            "zip",
            "country",
            "phone",
            "email",
            "notes",
        ];

        $this->json('POST', 'api/prospect/update', $data, ['Accept' => 'application/json'])->assertOk()->assertHeader('Content-Type', 'application/json')->assertJsonValidationErrors($validateFields, 'data.7642');
    }

    /**
     * Update Prospect API unit test.
     *
     * @return void
     */
    public function testUpdateProspectApi()
    {
        $data = [
            "first_name" => "John",
            "last_name"  => "Doe",
            "address"    => "1234 Ashton New Rd",
            "address2"   => "Apt B",
            "city"       => "Manchester",
            "state"      => "Manchester",
            "zip"        => "432",
            "country"    => "GBdsf",
            "phone"      => "8135551218",
            "email"      => "testprospect@email.com",
            "notes"      => "Add this via Postman",
        ];

        $this->json('POST', 'api/prospect/update', $data, ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'data',
        ]);
    }
}
