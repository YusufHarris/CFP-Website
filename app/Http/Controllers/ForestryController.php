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

        return view('forestry', compact('communities', 'foBens', 'districtBens'));
    }
}
