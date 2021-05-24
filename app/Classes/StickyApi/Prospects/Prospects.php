<?php

namespace App\Classes\StickyApi\Prospects;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Client\PendingRequest;

/**
 * Class Prospects
 */
class Prospects
{
    /** Create new prospect
     *
     * @return array|mixed
     */
    public function newProspect(array $request): array
    {
        //all the api validations
        $validated = Validator::make($request, Config::get('sticky.NEW_PROSPECT_VALIDATION'));
dd($validated);
        //on success call new prospect api
        $stickyHost = Config::get('sticky.STICKY_CREDENTIALS.STICKY_API_DOMAIN');
        $endPoint   = Config::get('sticky.ENDPOINTS.NEW_PROSPECT');
        $host       = $stickyHost.$endPoint;
        $request    = $this->getRequest();

        return $request->post($host, $stickybody)->json();
    }

    /**
     * @return PendingRequest
     */
    private function getRequest(): PendingRequest
    {
        $username = Config::get('sticky.STICKY_CREDENTIALS.STICKY_API_USERNAME');
        $password = Config::get('sticky.STICKY_CREDENTIALS.STICKY_API_PASSWORD');

        return Http::withBasicAuth($username, $password)->withHeaders(['Content-Type' => 'application/json']);
    }
}
