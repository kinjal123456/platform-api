<?php

namespace App\Http\Controllers;

use App\Classes\StickyApi\Shipping\Shipping;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Exception;

/**
 * Class ShippingController
 */
class ShippingController extends Controller
{
    private $shipping;

    public function __construct()
    {
        $this->shipping = new Shipping();
    }

    /** Call sticky get shipping methods api
     *
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        try {
            return $this->shipping->getShippingMethods();
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
