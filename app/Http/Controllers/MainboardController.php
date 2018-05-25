<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Mainboard;

class MainboardController extends Controller
{
    public function index()
    {
        //$communities = Mainboard::getSROIACommunities();
        $sectorBens = Mainboard::getBenPie();
        $districtBens = Mainboard::getBenBar();
        $communities = Mainboard::getCommunities();
        $incomeChange = Mainboard::getIncomeChange();
        $activities = Mainboard::getActivities();

        return view('mainboard', compact('communities', 'sectorBens',
                                         'districtBens', 'incomeChange',
                                         'activities'));
    }

    public function communityFilter()
    {
        $communities = Mainboard::getSROIACommunities();
        $sectorBens = Mainboard::getFinalBeneficiariesBySector();
        $finBens = Mainboard::getTotalFinalBeneficiaries();
        $sexBens = Mainboard::getFinalBeneficiariesBySex();
        $kActivityBens = Mainboard::getFinalBeneficiariesBykeyActivity();

        return view('mainboard', compact('communities', 'sectorBens', 'finBens', 'sexBens', 'kActivityBens'));
    }
}
