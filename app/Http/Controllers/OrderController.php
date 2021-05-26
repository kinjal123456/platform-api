<?php

namespace App\Http\Controllers;

use App\Classes\StickyApi\Orders\Orders;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

/**
 * Class OrderController
 */
class OrderController extends Controller
{
    /** Call sticky new order api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $orderPayload = $request->all();
            $orders       = new Orders();

            return $orders->newOrder($orderPayload);
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }

    /** Call sticky update order api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $orderPayload = $request->all();
            $orders       = new Orders();

            return $orders->updateOrder($orderPayload);
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
