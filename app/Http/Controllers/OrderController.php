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
    private $orders;

    public function __construct()
    {
        $this->orders = new Orders();
    }

    /** Call sticky new order api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            return $this->orders->newOrder($request->all());
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
            return $this->orders->updateOrder($request->all());
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }

    /** Call sticky order view api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function view(Request $request): JsonResponse
    {
        try {
            return $this->orders->viewOrder($request->all());
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
