<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Forestry;

class ForestryController extends Controller
{
    public function index()
    {
        $communities = Forestry::getSROIACommunities();
        $seedlings = Forestry::getSeedlingsGrown();


        return view('forestry', compact('communities','seedlings'));
    }
}
