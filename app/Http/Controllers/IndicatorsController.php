<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

use App\Models\Indicators\Mainboard;
use App\Models\Indicators\Agriculture;
use App\Models\Indicators\Energy;
use App\Models\Indicators\Forestry;
use App\Models\Indicators\Gender;
use App\Models\Indicators\GovLinks;
use App\Models\Indicators\LandRights;
use App\Models\Indicators\TreeDiagram;
use App\Models\Indicators\Water;

class IndicatorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('enabled');
    }

    public function mainboard()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        //$communities = Mainboard::getSROIACommunities();
        $sectorBens = Mainboard::getBenPie();
        $districtBens = Mainboard::getBenBar();
        $communities = Mainboard::getCommunities();
        $incomeChange = Mainboard::getIncomeChange();
        $activities = Mainboard::getActivities();
        $increased = Mainboard::getIncreasedAwareness();
        $awareness = Mainboard::getIncreasedAwareness();
        $businesses = Mainboard::getBusinesses();
        $knowOthers = Mainboard::getPracticeOthers();

        return view('indicators.mainboard', compact('communities', 'sectorBens',
                                         'districtBens', 'incomeChange',
                                         'activities', 'increased',
                                         'awareness','businesses','knowOthers'));
    }

    public function agriculture()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        $communities = Agriculture::getSROIACommunities();
        $agBens = Agriculture::getBenPie();
        $districtBens = Agriculture::getBenBar();
        $yieldChgs = Agriculture::getAgYieldChgs();
        $vegetables = Agriculture::getIncreasedVegetables();
        $kitchenGardens = Agriculture::getKitchenGardens();
        $beehives = Agriculture::getBeeHives();
        $agroArea = Agriculture::getAgroArea();
        $spiceArea = Agriculture::getSpiceArea();

        return view('indicators.agriculture', compact('communities', 'agBens', 'districtBens', 'yieldChgs', 'seedlings','vegetables','kitchenGardens','beehives','agroArea','spiceArea'));
    }

    public function energy()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
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

        return view('indicators.energy', compact('communities', 'enBens', 'districtBens','solarHouseholds','enSystems',
                                        'firewood','cookstoveGroups','cookstoves','charcoalSys','earthBlocks'));
    }

    public function forestry()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        $communities = Forestry::getSROIACommunities();
        $foBens = Forestry::getBenPie();
        $districtBens = Forestry::getBenBar();
        $seedlings = Forestry::getSeedlingsGrown();

        $treesPlanted = Forestry:: getTreesPlanted();

        return view('indicators.forestry', compact('communities', 'seedlings' ,'foBens', 'districtBens','treesPlanted'));
    }

    public function gender()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        $communities = Gender::getSROIACommunities();

        return view('indicators.gender', compact('communities'));
    }

    public function govLinks()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        $agencies = GovLinks::getGovAgencies();
        $workshops = GovLinks::getGovWorkshops();

        return view('indicators.gov-links', compact('agencies', 'workshops'));
    }

    public function landRights()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        $communities = LandRights::getSROIACommunities();

        return view('indicators.land-rights', compact('communities'));
    }

    public function treeDiagram()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        $treeBens = TreeDiagram::getD3TreeFinalBeneficiaries();

        return view('treediagram', compact('treeBens'));
    }

    public function water()
    {
        if ($this->checkUserStatus() == 0) {
            return redirect('/');
        }
        $communities = Water::getSROIACommunities();
        $waBens = Water::getBenPie();
        $districtBens = Water::getBenBar();
        $waterHHs = Water::getWaterHH();
        $waSys = Water::getWaterSystems();
        $waCap = Water::getWaterCapacity();
        $waAg = Water::getWaterAgriculture();
        $waCatch = Water::getCatchConsArea();

        return view('indicators.water', compact('communities', 'waBens', 'districtBens',
                    'waterHHs', 'waSys', 'waCap', 'waAg', 'waCatch'));
    }


    /**
     * Check user status
     *
     * @return int 0 - not logged in
     *             1 - logged in with enabled account
     *             2 - logged in with enabled account as Administrator
     */
    public static function checkUserStatus()
    {
        // Ensure the user is logged in
        if (Auth::guard()->check()) {
            // And that the user is an administrator
            if (Auth::user()->enabled) {

                // Check if the user is an Administrator
                if (Auth::user()->admin) {
                    return 2;
                }
                return 1;
            }
            // Log the user out if the account is disabled
            else {
                Auth::logout();
            }
        }
        // Return false if the user is not logged in with an enabled account
        return 0;
    }
}
