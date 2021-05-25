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
     * @link https://developer-prod.sticky.io/#0c888f79-8ff8-435f-b5e9-f6b0f6357123
     * @param array $data
     * @return JsonResponse
     */
    public function newProspect(array $prospectPayload): JsonResponse
    {
        $returnResponse = ['error' => true, 'message' => '', 'data' => []];
        try {
            //Api validations
            $isValid = json_decode(validator($prospectPayload, Config::get('sticky.NEW_PROSPECT_VALIDATION'))->errors(), true);

            if ($isValid) {
                $returnResponse['data'] = $isValid;
                throw new InvalidArgumentException(__('sticky.new_prospect_validation_fails'));
            }

            //If validation pass, call new prospect api
            $stickyHost    = env('STICKY_API_DOMAIN');
            $endPoint      = Config::get('sticky.ENDPOINTS.STICKY.NEW_PROSPECT');
            $host          = $stickyHost.$endPoint;
            $request       = $this->getRequest();

            $response = $request->post($host, $prospectPayload)->json();

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

    /** Update new prospect - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#c1e65f32-eb37-48e5-904a-bc4ed02134cf
     * @param array $prospectPayload
     * @return JsonResponse
     */
    public function updateProspect(array $prospectPayload): JsonResponse
    {
        $isValid        = [];
        $returnResponse = ['error' => true, 'message' => '', 'data' => []];
        try {
            //Api validations
            foreach (Arr::get($prospectPayload, 'prospect_id', []) as $prospectId => $prospects) {
                $isValid[$prospectId] = json_decode(validator($prospects, Config::get('sticky.UPDATE_PROSPECT_VALIDATION'))->errors(), true);

                if ($isValid[$prospectId]) {
                    $returnResponse['data'] = $isValid;
                    throw new InvalidArgumentException(__('sticky.new_prospect_validation_fails'));
                }
            }

            //If validation pass, call update prospect api
            $stickyHost = env('STICKY_API_DOMAIN');
            $endPoint   = Config::get('sticky.ENDPOINTS.STICKY.UPDATE_PROSPECT');
            $host       = $stickyHost.$endPoint;
            $request    = $this->getRequest();

            $response = $request->post($host, $prospectPayload)->json();

            //Check each field response from the update_prospect API
            $fieldResponse = $this->checkEachFieldFromApiResponse($response);

            if ($fieldResponse === true) {
                $returnResponse['data'] = json_encode($response);
                throw new InvalidArgumentException(__('update_prospect_response_fails'));
            }

            $returnResponse['error']   = false;
            $returnResponse['message'] = __('sticky.update_prospect_create_success');
            $returnResponse['data']    = json_encode($response);

            return response()->json($returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $returnResponse['message'] = $ex->getMessage();

            return response()->json($returnResponse);
        }
    }
}
