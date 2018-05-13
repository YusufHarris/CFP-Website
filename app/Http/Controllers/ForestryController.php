<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Forestry;

class ForestryController extends Controller
{
    public function index()
    {
        $communities = Forestry::getSROIACommunities();

        return view('forestry', compact('communities'));
    }
}
