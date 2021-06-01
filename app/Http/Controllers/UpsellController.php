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
    private $upsells;

    public function __construct()
    {
        $this->upsells = new Upsells();
    }

    /** Call sticky new upsell api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            return $this->upsells->newUpsell($request->all());
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
