<?php

namespace App\Classes\StickyApi\Upsells;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use InvalidArgumentException;
use App\Classes\StickyTraits\StickyTraits;

/**
 * Class Upsells
 */
class Upsells
{
    use StickyTraits;

    /** Create new upsell - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#41b57a24-e245-44cb-a5be-71d6180f9562
     * @param array $upsellPayload
     * @return JsonResponse
     */
    public function newUpsell(array $upsellPayload): JsonResponse
    {
        $returnResponse = ['error' => true, 'message' => '', 'data' => []];
        try {
            //Api validations
            $isValid = json_decode(validator($upsellPayload, Config::get('sticky.NEW_UPSELL_VALIDATION'))->errors(), true);

            if ($isValid) {
                $returnResponse['data'] = $isValid;
                throw new InvalidArgumentException(__('sticky.new_upsell_validation_fails'));
            }

            //If validation pass, call new prospect api
            $stickyHost    = env('STICKY_API_DOMAIN');
            $endPoint      = Config::get('sticky.ENDPOINTS.STICKY.NEW_UPSELL');
            $host          = $stickyHost.$endPoint;
            $request       = $this->getRequest();

            $response = $request->post($host, $upsellPayload)->json();

            //If Api request decline
            if (Arr::get($response, 'response_code') !== '100' && Arr::get($response, 'error_found') === '1') {
                throw new InvalidArgumentException(Arr::get($response, 'error_message'));
            }

            $returnResponse['error']   = false;
            $returnResponse['message'] = __('sticky.new_upsell_create_success');
            $returnResponse['data']    = json_encode($response);

            return response()->json($returnResponse);
        } catch(Exception $ex) {
            //@ToDo log Exception
            $returnResponse['message'] = $ex->getMessage();

            return response()->json($returnResponse);
        }
    }
}
