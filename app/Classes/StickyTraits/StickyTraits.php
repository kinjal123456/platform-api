<?php

namespace App\Classes\StickyTraits;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait StickyTraits
{
    /**
     * @return PendingRequest
     */
    private function getRequest(): PendingRequest
    {
        $username = env('STICKY_API_USERNAME');
        $password = env('STICKY_API_PASSWORD');

        return Http::withBasicAuth($username, $password)->withHeaders(['Content-Type' => 'application/json']);
    }

    private function newProspectPayload(array $data): array
    {
        return [
            'campaignId' => $data['campaignId'],
            'email'      => $data['email'],
            'ipAddress'  => $data['ipAddress'],
            'firstName'  => (! empty($data['firstName'])) ? $data['firstName'] : '',
            'lastName'   => (! empty($data['lastName'])) ? $data['lastName'] : '',
            'address1'   => (! empty($data['address1'])) ? $data['address1'] : '',
            'address2'   => (! empty($data['address2'])) ? $data['address2'] : '',
            'city'       => (! empty($data['city'])) ? $data['city'] : '',
            'state'      => (! empty($data['state'])) ? $data['state'] : '',
            'zip'        => (! empty($data['zip'])) ? $data['zip'] : '',
            'country'    => (! empty($data['country'])) ? $data['country'] : '',
            'phone'      => (! empty($data['phone'])) ? $data['phone'] : '',
            'AFID'       => (! empty($data['AFID'])) ? $data['AFID'] : '',
            'SID'        => (! empty($data['SID'])) ? $data['SID'] : '',
            'AFFID'      => (! empty($data['AFFID'])) ? $data['AFFID'] : '',
            'C1'         => (! empty($data['C1'])) ? $data['C1'] : '',
            'C2'         => (! empty($data['C2'])) ? $data['C2'] : '',
            'C3'         => (! empty($data['C3'])) ? $data['C3'] : '',
            'AID'        => (! empty($data['AID'])) ? $data['AID'] : '',
            'OPT'        => (! empty($data['OPT'])) ? $data['OPT'] : '',
            'click_id'   => (! empty($data['click_id'])) ? $data['click_id'] : '',
            'notes'      => (! empty($data['notes'])) ? $data['notes'] : '',
        ];
    }
}
