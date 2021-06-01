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
    private $prospect;

    public function __construct()
    {
        $this->prospect = new Prospects();
    }

    /** Call sticky new prospect api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            return $this->prospect->newProspect($request->all());
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }

    /** Call sticky update prospect api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            return $this->prospect->updateProspect($request->all());
        } catch (Exception $ex) {
            return response()->json([$ex->getMessage()]);
        }
    }
}
