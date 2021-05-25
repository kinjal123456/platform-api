<?php

namespace App\Classes\StickyApi\Prospects;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use InvalidArgumentException;
use App\Classes\StickyTraits\StickyTraits;

/**
 * Class Prospects
 */
class Prospects
{
    use StickyTraits;

    /** Create new prospect - Sticky.io
     *
     * @param array $data
     * @return JsonResponse
     */
    public function newProspect(array $data): JsonResponse
    {
        $returnResponse = ['error' => true, 'message' => '', 'data' => []];
        try {
            //Api validations
            $isValid = json_decode(validator($data, Config::get('sticky.NEW_PROSPECT_VALIDATION'))->errors(), true);

            if ($isValid) {
                $returnResponse['data'] = $isValid;
                throw new InvalidArgumentException(__('sticky.new_prospect_validation_fails'));
            }

            //If validation pass, call new prospect api
            $stickyHost    = env('STICKY_API_DOMAIN');
            $endPoint      = Config::get('sticky.ENDPOINTS.NEW_PROSPECT');
            $host          = $stickyHost.$endPoint;
            $request       = $this->getRequest();
            $stickyPayload = $this->newProspectPayload($data);

            $response = $request->post($host, $stickyPayload)->json();

            //If Api request decline
            if (Arr::get($response, 'response_code') !== '100' && Arr::get($response, 'error_found') === '1') {
                throw new InvalidArgumentException(Arr::get($response, 'decline_reason'));
            }

            $returnResponse['error']   = false;
            $returnResponse['message'] = __('sticky.new_prospect_create_success');
            $returnResponse['data']    = json_encode($response);

            return response()->json($returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $returnResponse['message'] = $ex->getMessage();

            return response()->json($returnResponse);
        }
    }
}
