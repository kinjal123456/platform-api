<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Classes\StickyApi\Prospects\Prospects;

class ProspectController extends Controller
{
    /** call sticky new prospect api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function newProspect(Request $request): JsonResponse
    {
        $stickyPayload = $request->all();
        $prospect      = new Prospects();

        return $prospect->newProspect($stickyPayload);
    }
}
