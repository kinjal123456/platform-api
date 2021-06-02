<?php

namespace Tests\Unit;

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
        $this->json('POST', 'api/prospect/create', ['Accept' => 'application/json'])->assertOk()->assertJsonStructure([
            'error',
            'success',
            'message',
            'data',
        ]);
    }
}
