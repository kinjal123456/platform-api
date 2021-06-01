<?php

namespace App\Classes\StickyApi\Shipping;

use Illuminate\Http\JsonResponse;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use App\Classes\StickyTraits\StickyTraits;
use App\Classes\StickyTraits\ValidationTraits;
use App\Classes\StickyApi\ApiConfig;

/**
 * Class Shipping
 */
class Shipping
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

    /** Get shipping methods - Sticky.io
     *
     * @link https://developer-v2.sticky.io/#240bc49b-19ac-4286-98ea-9485c70677e3
     * @return JsonResponse
     */
    public function getShippingMethods(): JsonResponse
    {
        try {
            $endPoint = Config::get('sticky.ENDPOINTS.STICKY.GET_SHIPPING_METHODS');
            $method   = Config::get('sticky.METHODS.get');
            $response = $this->prepareRequest($endPoint, $method);

            //If Api request decline
            if (Arr::get($response, 'status') !== 'SUCCESS') {
                throw new InvalidArgumentException(__('sticky.get_shipping_methods_fails'));
            }

            $this->returnResponse['error']   = false;
            $this->returnResponse['message'] = __('sticky.get_shipping_methods_success');
            $this->returnResponse['data']    = $response;

            return response()->json($this->returnResponse);
        } catch (Exception $ex) {
            //@ToDo log Exception
            $this->returnResponse['success'] = false;
            $this->returnResponse['message'] = $ex->getMessage();

            return response()->json($this->returnResponse);
        }
    }
}
