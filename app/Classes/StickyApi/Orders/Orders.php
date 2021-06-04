<?php

namespace App\Classes\StickyApi\Orders;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use InvalidArgumentException;
use App\Classes\StickyTraits\StickyTraits;
use App\Classes\StickyTraits\ValidationTraits;
use App\Classes\StickyApi\ApiConfig;

/**
 * Class Orders
 */
class Orders
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

    /** Create new order - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#0dddabee-997a-4b00-8f47-d560493cb1b7
     * @param array $orderPayload
     * @return JsonResponse
     */
    public function newOrder(array $orderPayload): JsonResponse
    {
        try {
            $orderPayload['shippingAddress1'] = str_replace(',', '', $orderPayload['shippingAddress1']);
            $orderPayload['shippingAddress2'] = str_replace(',', '', $orderPayload['shippingAddress2']);

            $orderFieldsToValidate = Config::get('sticky.NEW_ORDER_VALIDATION');
            if (! empty(Arr::get($orderPayload, 'billingSameAsShipping')) && strtoupper(Arr::get($orderPayload, 'billingSameAsShipping')) === 'NO') {
                $orderPayload['billingAddress1'] = str_replace(',', '', $orderPayload['billingAddress1']);
                $orderPayload['billingAddress2'] = str_replace(',', '', $orderPayload['billingAddress2']);

                $orderFieldsToValidate['billingAddress1'] = 'required';
                $orderFieldsToValidate['billingCity']     = 'required';
                $orderFieldsToValidate['billingState']    = 'required';
                $orderFieldsToValidate['billingZip']      = 'required';
                $orderFieldsToValidate['billingCountry']  = 'required';
            }

            //Api validations
            $this->payloadValidation($orderPayload, $orderFieldsToValidate);

            //If validation pass, call new order api
            $endPoint = Config::get('sticky.ENDPOINTS.STICKY.NEW_ORDER');
            $method   = Config::get('sticky.METHODS.post');
            $response = $this->prepareRequest($endPoint, $method, $orderPayload);

            //If Api request decline
            if (Arr::get($response, 'response_code') !== Config::get('sticky.RESPONSE_CODES.STICKY.0') && Arr::get($response, 'error_found') === '1') {
                throw new InvalidArgumentException(Arr::get($response, 'error_message'));
            }

            $this->returnResponse['error']   = false;
            $this->returnResponse['message'] = __('sticky.new_order_create_success');
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

    /** Update order - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#50bf0f66-38b2-4513-908d-04f4af02593f
     * @param array $orderPayload
     * @return JsonResponse
     */
    public function updateOrder(array $orderPayload): JsonResponse
    {
        try {
            //Api validations
            foreach (Arr::get($orderPayload, 'order_id', []) as $orderId => $orders) {
                $this->payloadValidation($orders, Config::get('sticky.UPDATE_ORDER_VALIDATION'), $orderId);
            }

            //If validation pass, call update order api
            $endPoint = Config::get('sticky.ENDPOINTS.STICKY.UPDATE_ORDER');
            $method   = Config::get('sticky.METHODS.post');
            $response = $this->prepareRequest($endPoint, $method, $orderPayload);

            //Write order_update API response (field specific) in a log
            //@ToDo log

            $this->returnResponse['error']   = false;
            $this->returnResponse['message'] = __('sticky.update_order_success');
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

    /** View orders - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#fa3f4efb-0b1f-4467-9454-3bb1aff96aae
     * @param array $orderPayload
     * @return JsonResponse
     */
    public function viewOrder(array $orderPayload): JsonResponse
    {
        try {
            //Api validations
            $this->payloadValidation($orderPayload, Config::get('sticky.VIEW_ORDER_VALIDATION'));

            //If validation pass, call view order api
            $endPoint = Config::get('sticky.ENDPOINTS.STICKY.VIEW_ORDER');
            $method   = Config::get('sticky.METHODS.post');
            $response = $this->prepareRequest($endPoint, $method, $orderPayload);

            //If Api request decline
            if (Arr::get($response, 'response_code') !== Config::get('sticky.RESPONSE_CODES.STICKY.0')) {
                throw new InvalidArgumentException(sprintf(__('sticky.view_order_fails'), implode(',', Arr::get($orderPayload, 'order_id'))));
            }

            $this->returnResponse['error']   = false;
            $this->returnResponse['message'] = __('sticky.view_order_success');
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
