<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Agriculture;

class AgricultureController extends Controller
{
    public function index()
    {
        $communities = Agriculture::getSROIACommunities();
        $agBens = Agriculture::getBenPie();
        $districtBens = Agriculture::getBenBar();
        $yieldChgs = Agriculture::getAgYieldChgs();

        return view('agriculture', compact('communities', 'agBens', 'districtBens', 'yieldChgs'));
    }
}
