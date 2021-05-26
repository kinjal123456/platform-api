<?php

namespace App\Classes\StickyTraits;

use Illuminate\Http\Client\PendingRequest;
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
}
