<?php

namespace App\Classes\StickyApi\Orders;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use InvalidArgumentException;
use App\Classes\StickyTraits\StickyTraits;

/**
 * Class Orders
 */
class Orders
{
    use StickyTraits;

    /** Create new order - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#0dddabee-997a-4b00-8f47-d560493cb1b7
     * @param array $orderPayload
     * @return JsonResponse
     */
    public function newOrder(array $orderPayload): JsonResponse
    {
        $returnResponse = ['error' => true, 'message' => '', 'data' => []];
        try {
            //Api validations
            $orderFieldsToValidate = Config::get('sticky.NEW_ORDER_VALIDATION');
            if (! empty(Arr::get($orderPayload, 'billingSameAsShipping')) && strtoupper(Arr::get($orderPayload, 'billingSameAsShipping')) === 'NO') {
                $orderFieldsToValidate['billingAddress1'] = 'required';
                $orderFieldsToValidate['billingCity']     = 'required';
                $orderFieldsToValidate['billingState']    = 'required';
                $orderFieldsToValidate['billingZip']      = 'required';
                $orderFieldsToValidate['billingCountry']  = 'required';
            }

            $isValid = json_decode(validator($orderPayload, $orderFieldsToValidate)->errors(), true);

            if ($isValid) {
                $returnResponse['data'] = $isValid;
                throw new InvalidArgumentException(__('sticky.new_order_validation_fails'));
            }

            //If validation pass, call new order api
            $stickyHost = env('STICKY_API_DOMAIN');
            $endPoint   = Config::get('sticky.ENDPOINTS.STICKY.NEW_ORDER');
            $host       = $stickyHost.$endPoint;
            $request    = $this->getRequest();

            $response = $request->post($host, $orderPayload)->json();

            //If Api request decline
            if (Arr::get($response, 'response_code') !== '100' && Arr::get($response, 'error_found') === '1') {
                throw new InvalidArgumentException(Arr::get($response, 'error_message'));
            }

            $returnResponse['error']   = false;
            $returnResponse['message'] = __('sticky.new_order_create_success');
            $returnResponse['data']    = json_encode($response);

            return response()->json($returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $returnResponse['message'] = $ex->getMessage();

            return response()->json($returnResponse);
        }
    }
}
