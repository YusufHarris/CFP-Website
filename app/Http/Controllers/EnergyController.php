<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Energy;

class EnergyController extends Controller
{
    public function index()
    {
        $communities = Energy::getSROIACommunities();

        return view('energy', compact('communities'));
    }
}
