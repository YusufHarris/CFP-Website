<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Water;

class WaterController extends Controller
{
    public function index()
    {
        $communities = Water::getSROIACommunities();

        return view('water', compact('communities'));
    }
}
