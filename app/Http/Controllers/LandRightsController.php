<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\LandRights;

class LandRightsController extends Controller
{
    public function index()
    {
        $communities = LandRights::getSROIACommunities();

        return view('land-rights', compact('communities'));
    }
}
