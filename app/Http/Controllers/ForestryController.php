<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Forestry;

class ForestryController extends Controller
{
    public function index()
    {
        $communities = Forestry::getSROIACommunities();
        $foBens = Forestry::getBenPie();
        $districtBens = Forestry::getBenBar();
        $seedlings = Forestry::getSeedlingsGrown();

        $treesPlanted = Forestry:: getTreesPlanted();

        return view('forestry', compact('communities', 'seedlings' ,'foBens', 'districtBens','treesPlanted'));
    }
}
