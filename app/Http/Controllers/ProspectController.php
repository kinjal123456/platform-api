<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Classes\StickyApi\Prospects\Prospects;
use Exception;

/**
 * Class ProspectController
 */
class ProspectController extends Controller
{
    /** Call sticky new prospect api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $stickyPayload = $request->all();
            $prospect      = new Prospects();

            return $prospect->newProspect($stickyPayload);
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
