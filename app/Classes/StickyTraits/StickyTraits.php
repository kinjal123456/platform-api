<?php

namespace App\Classes\StickyTraits;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

/**
 * Trait StickyTraits
 */
trait StickyTraits
{
    /** Prepare Http request with basic auth and header
     *
     * @return PendingRequest
     */
    private function getRequest(): PendingRequest
    {
        $username = env('STICKY_API_USERNAME');
        $password = env('STICKY_API_PASSWORD');

        return Http::withBasicAuth($username, $password)->withHeaders(['Content-Type' => 'application/json']);
    }

    /** Check for the each update prospect api field response
     * @param array $response
     * @return bool
     */
    private function checkEachFieldFromApiResponse(array $response): bool
    {
        $fieldResponse = false;
        foreach (Arr::get($response, 'prospect_id', []) as $prospectResponse) {
            if ((Arr::get($prospectResponse, 'first_name.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'first_name.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'last_name.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'last_name.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'address.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'address.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'address2.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'address2.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'city.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'city.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'state.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'state.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'zip.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'zip.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'country.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'country.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'phone.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'phone.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'email.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'email.response_code') !== '343') ||
                (Arr::get($prospectResponse, 'notes.response_code') !== '100' &&
                    Arr::get($prospectResponse, 'notes.response_code') !== '343')) {
                $fieldResponse = true;
            }
        }
        return $fieldResponse;
    }
}
