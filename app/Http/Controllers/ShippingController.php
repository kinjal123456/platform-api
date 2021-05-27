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
    /** Call sticky get shipping methods api
     *
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        try {
            $shipping = new Shipping();

            return $shipping->getShippingMethods();
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
