<?php

namespace App\Classes\StickyApi\Shipping;

use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use App\Classes\StickyTraits\StickyTraits;

/**
 * Class Shipping
 */
class Shipping
{
    use StickyTraits;

    /** Get shipping methods - Sticky.io
     *
     * @link https://developer-v2.sticky.io/#240bc49b-19ac-4286-98ea-9485c70677e3
     * @return JsonResponse
     */
    public function getShippingMethods(): JsonResponse
    {
        $returnResponse = ['error' => true, 'message' => '', 'data' => []];
        try {
            $stickyHost = env('STICKY_API_DOMAIN');
            $endPoint   = Config::get('sticky.ENDPOINTS.STICKY.GET_SHIPPING_METHODS');
            $host       = $stickyHost.$endPoint;
            $request    = $this->getRequest();

            $response = $request->get($host)->json();

            //If Api request decline
            if (Arr::get($response, 'status') !== 'SUCCESS') {
                throw new InvalidArgumentException(__('sticky.get_shipping_methods_fails'));
            }

            $returnResponse['error']   = false;
            $returnResponse['message'] = __('sticky.get_shipping_methods_success');
            $returnResponse['data']    = $response;

            return response()->json($returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $returnResponse['message'] = $ex->getMessage();

            return response()->json($returnResponse);
        }
    }
}
