<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\TreeDiagram;

class TreeDiagramController extends Controller
{
    public function index()
    {
        $treeBens = TreeDiagram::getD3TreeFinalBeneficiaries();

        return view('treediagram', compact('treeBens'));
    }

    public function communityFilter()
    {
        $treeBens = TreeDiagram::getD3TreeFinalBeneficiaries(request('idCom'));

        return view('treediagram', compact('treeBens'));
    }
}
