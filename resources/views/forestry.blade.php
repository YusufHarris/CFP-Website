
@extends('layouts.master')

@section('content')

<div class="row text-center">
    <div class="col-12 col-md-6">
        <!-- Selecter for the beneficiary type -->
        <div id="benSelect" style="height: 50px;">
            <select>
                <option value="Direct Trainees" selected>Direct Trainees</option>
                <option value="Indirect Trainees">Indirect Trainees</option>
                <option value="Final Beneficiaries">Final Beneficiaries</option>
            </select>
        </div>
        <!-- Beneficiary Pie Chart by Sector-->
        <div id="keyActivityPie" style="height: 350px;">
        </div>
    </div>
    <!-- Beneficiary Bar Chart by District -->
    <div class="col-12 col-md-6" id="foDistrictBar" style="height: 400px;">
    </div>
</div>
</div>
<h3>Tree Nurseries</h3>
<div class="row text-center">

    <!-- Placeholder-->
    <div class="col-12" id="seedlingsGrownBar" style="height: 1275px;">

    </div>

</div>

<h3>Afforestation and Reforestation</h3>
<div class="row text-center">


    <!-- Placeholder-->
    <div class="col-12 " id="treesPlantedBar" style="height: 1275px;">


    </div>
</div>


<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.forestryPieDistrictBar')
@include('js.seedlingsGrownBar')
@include('js.treesPlantedBar')

@endsection
