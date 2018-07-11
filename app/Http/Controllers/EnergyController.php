<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Energy;

class EnergyController extends Controller
{
    public function index()
    {
        $communities = Energy::getSROIACommunities();
        $enBens = Energy::getBenPie();
        $districtBens = Energy::getBenBar();
        $solarHouseholds = Energy::getSolarHouseholds();
        $enSystems = Energy::getEnergySystems();
        $firewood = Energy::getDecreasedFirewood();
        $cookstoveGroups = Energy::getCookStoveGroups();
        $cookstoves = Energy::getCookStoves();
        $charcoalSys = Energy::getCharcoalSystems();
        $earthBlocks = Energy::getEarthBlockPresses();

        return view('energy', compact('communities', 'enBens', 'districtBens','solarHouseholds','enSystems',
                                        'firewood','cookstoveGroups','cookstoves','charcoalSys','earthBlocks'));
    }
}
