<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Classes\StickyApi\Prospects\Prospects;

class ProspectController extends Controller
{
    /** call sticky new prospect api
     *
     * @return array
     */
    public function newProspect(Request $request): array
    {
        $stickyPayload = $request->all();
        $prospect      = new Prospects();

        $prospect->newProspect($stickyPayload);
    }
}
