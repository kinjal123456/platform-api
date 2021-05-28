<?php

namespace App\Classes\StickyApi\Orders;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Exception;
use InvalidArgumentException;
use App\Classes\StickyTraits\StickyTraits;
use App\Classes\StickyTraits\ValidationTraits;

/**
 * Class Orders
 */
class Orders
{
    use StickyTraits;
    use ValidationTraits;

    /** Create new order - Sticky.io
     *
     * @link https://developer-prod.sticky.io/#0dddabee-997a-4b00-8f47-d560493cb1b7
     * @param array $orderPayload
     * @return JsonResponse
     */
    public function newOrder(array $orderPayload): JsonResponse
    {
        $returnResponse = ['error' => true, 'success' => true, 'message' => '', 'data' => []];
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
            $returnResponse['data']    = $response;

            return response()->json($returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $returnResponse['success'] = false;
            $returnResponse['message'] = $ex->getMessage();
            if(! empty($this->validateResponse)) {
                $returnResponse['data'] = $this->validateResponse;
            }

            return response()->json($returnResponse);
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
        $returnResponse = ['error' => true, 'success' => true, 'message' => '', 'data' => []];
        try {
            //Api validations
            foreach (Arr::get($orderPayload, 'order_id', []) as $orderId => $orders) {
                $this->payloadValidation($orders, Config::get('sticky.UPDATE_ORDER_VALIDATION'), $orderId);
            }

            //If validation pass, call update order api
            $stickyHost = env('STICKY_API_DOMAIN');
            $endPoint   = Config::get('sticky.ENDPOINTS.STICKY.UPDATE_ORDER');
            $host       = $stickyHost.$endPoint;
            $request    = $this->getRequest();

            $response = $request->post($host, $orderPayload)->json();

            //Write order_update API response (field specific) in a log
            //@ToDo log

            $returnResponse['error']   = false;
            $returnResponse['message'] = __('sticky.update_order_success');
            $returnResponse['data']    = $response;

            return response()->json($returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $returnResponse['success'] = false;
            $returnResponse['message'] = $ex->getMessage();
            if(! empty($this->validateResponse)) {
                $returnResponse['data'] = $this->validateResponse;
            }

            return response()->json($returnResponse);
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
        $returnResponse = ['error' => true, 'success' => true, 'message' => '', 'data' => []];
        try {
            //Api validations
            $this->payloadValidation($orderPayload, Config::get('sticky.VIEW_ORDER_VALIDATION'));

            //If validation pass, call view order api
            $stickyHost = env('STICKY_API_DOMAIN');
            $endPoint   = Config::get('sticky.ENDPOINTS.STICKY.VIEW_ORDER');
            $host       = $stickyHost.$endPoint;
            $request    = $this->getRequest();

            $response = $request->post($host, $orderPayload)->json();

            //If Api request decline
            if (Arr::get($response, 'response_code') !== '100') {
                throw new InvalidArgumentException(sprintf(__('sticky.view_order_fails'), implode(',', Arr::get($orderPayload, 'order_id'))));
            }

            $returnResponse['error']   = false;
            $returnResponse['message'] = __('sticky.view_order_success');
            $returnResponse['data']    = $response;

            return response()->json($returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $returnResponse['success'] = false;
            $returnResponse['message'] = $ex->getMessage();
            if(! empty($this->validateResponse)) {
                $returnResponse['data'] = $this->validateResponse;
            }

            return response()->json($returnResponse);
        }
    }
}
