<?php

namespace App\Http\Controllers;

use App\Classes\StickyApi\Upsells\Upsells;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;

/**
 * Class UpsellController
 */
class UpsellController extends Controller
{
    /** Call sticky new upsell api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $upsellPayload = $request->all();
            $upsells = new Upsells();

            return $upsells->newUpsell($upsellPayload);
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
