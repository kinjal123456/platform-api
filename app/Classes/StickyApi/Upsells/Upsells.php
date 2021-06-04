<?php

namespace App\Classes\StickyApi\Upsells;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use InvalidArgumentException;
use App\Classes\StickyTraits\StickyTraits;
use App\Classes\StickyTraits\ValidationTraits;
use App\Classes\StickyApi\ApiConfig;

/**
 * Class Upsells
 */
class Upsells
{
    use StickyTraits;
    use ValidationTraits;

    private $host;

    private $username;

    private $password;

    private $returnResponse;

    public function __construct()
    {
        $host     = env('STICKY_API_DOMAIN');
        $username = env('STICKY_API_USERNAME');
        $password = env('STICKY_API_PASSWORD');

        $apiConfig      = new ApiConfig();
        $this->host     = $apiConfig->setHost($host);
        $this->username = $apiConfig->setUsername($username);
        $this->password = $apiConfig->setPassword($password);

        $this->returnResponse = Config::get('sticky.API_DEFAULT_RESPONSE');
    }

    /** Create new upsell - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#41b57a24-e245-44cb-a5be-71d6180f9562
     * @param array $upsellPayload
     * @return JsonResponse
     */
    public function newUpsell(array $upsellPayload): JsonResponse
    {
        try {
            //Api validations
            $this->payloadValidation($upsellPayload, Config::get('sticky.NEW_UPSELL_VALIDATION'));

            //If validation pass, call new upsell api
            $endPoint = Config::get('sticky.ENDPOINTS.STICKY.NEW_UPSELL');
            $method   = Config::get('sticky.METHODS.post');
            $response = $this->prepareRequest($endPoint, $method, $upsellPayload);

            //If Api request decline
            if (Arr::get($response, 'response_code') !== '100' && Arr::get($response, 'error_found') === '1') {
                throw new InvalidArgumentException(Arr::get($response, 'error_message'));
            }

            $this->returnResponse['error']   = false;
            $this->returnResponse['message'] = __('sticky.new_upsell_create_success');
            $this->returnResponse['data']    = $response;

            return response()->json($this->returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $this->returnResponse['success'] = false;
            if (! empty($this->validateResponse[0])) {
                $this->returnResponse['message'] = $ex->getMessage();
                $this->returnResponse['data']    = $this->validateResponse;
            } else {
                $this->returnResponse['apiError'] = $ex->getMessage();
            }

            return response()->json($this->returnResponse);
        }
    }
}
