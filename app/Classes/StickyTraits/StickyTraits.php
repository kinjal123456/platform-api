<?php

namespace App\Classes\StickyTraits;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use App\Classes\StickyApi\Config;

/**
 * Trait StickyTraits
 */
trait StickyTraits
{
    /** Prepare Http request with basic auth and header
     *
     * @return PendingRequest
     */
    private function setHttpRequest(): PendingRequest
    {
        return Http::withBasicAuth($this->username, $this->password)->withHeaders(['Content-Type' => 'application/json']);
    }

    /** Prepare Sticky API request
     *
     * @param string $endPoint
     * @param string $method
     * @param array $payload
     * @return array
     */

    private function prepareRequest(string $endPoint, string $method, array $payload = []): array
    {
        $host    = $this->host.$endPoint;
        $request = $this->setHttpRequest();

        return $request->$method($host, $payload)->json();
    }
}
