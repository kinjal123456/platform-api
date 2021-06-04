<?php

namespace App\Classes\StickyApi\Prospects;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use InvalidArgumentException;
use App\Classes\StickyTraits\StickyTraits;
use App\Classes\StickyTraits\ValidationTraits;
use App\Classes\StickyApi\ApiConfig;

/**
 * Class Prospects
 */
class Prospects
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

    /** Create new prospect - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#0c888f79-8ff8-435f-b5e9-f6b0f6357123
     * @param array $prospectPayload
     * @return JsonResponse
     */
    public function newProspect(array $prospectPayload): JsonResponse
    {
        try {
            //Api validations
            $this->payloadValidation($prospectPayload, Config::get('sticky.NEW_PROSPECT_VALIDATION'));

            //If validation pass, call new prospect api
            $endPoint = Config::get('sticky.ENDPOINTS.STICKY.NEW_PROSPECT');
            $method   = Config::get('sticky.METHODS.post');
            $response = $this->prepareRequest($endPoint, $method, $prospectPayload);

            //If Api request decline
            if (Arr::get($response, 'response_code') !== '100' && Arr::get($response, 'error_found') === '1') {
                throw new InvalidArgumentException(Arr::get($response, 'decline_reason'));
            }

            $this->returnResponse['error']   = false;
            $this->returnResponse['message'] = __('sticky.new_prospect_create_success');
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

    /** Update prospect - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#c1e65f32-eb37-48e5-904a-bc4ed02134cf
     * @param array $prospectPayload
     * @return JsonResponse
     */
    public function updateProspect(array $prospectPayload): JsonResponse
    {
        try {
            //Api validations
            foreach (Arr::get($prospectPayload, 'prospect_id', []) as $prospectId => $prospects) {
                $this->payloadValidation($prospects, Config::get('sticky.UPDATE_PROSPECT_VALIDATION'), $prospectId);
            }

            //If validation pass, call update prospect api
            $endPoint = Config::get('sticky.ENDPOINTS.STICKY.UPDATE_PROSPECT');
            $method   = Config::get('sticky.METHODS.post');
            $response = $this->prepareRequest($endPoint, $method, $prospectPayload);

            //Write update_prospect API response (field specific) in a log
            //@ToDo log

            $this->returnResponse['error']   = false;
            $this->returnResponse['message'] = __('sticky.update_prospect_success');
            $this->returnResponse['data']    = $response;

            return response()->json($this->returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $this->returnResponse['success'] = false;
            $this->returnResponse['message'] = $ex->getMessage();
            if (! empty($this->validateResponse)) {
                $this->returnResponse['data'] = $this->validateResponse;
            }

            return response()->json($this->returnResponse);
        }
    }
}
