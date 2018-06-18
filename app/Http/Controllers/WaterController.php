<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Water;

class WaterController extends Controller
{
    public function index()
    {
        $communities = Water::getSROIACommunities();
        $waBens = Water::getBenPie();
        $districtBens = Water::getBenBar();
        $waterHHs = Water::getWaterHH();
        $waSys = Water::getWaterSystems();
        $waCap = Water::getWaterCapacity();

        return view('water', compact('communities', 'waBens', 'districtBens',
                    'waterHHs', 'waSys', 'waCap'));
    }
}
