
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
        <div id="sectorPie" style="height: 350px;">
        </div>
    </div>
    <!-- Beneficiary Bar Chart by District -->
    <div class="col-12 col-md-6" id="districtBar" style="height: 400px;">
    </div>
</div>

<div class="row text-center">
        <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of Villages at-risk to the negative effects of climate change with improved adaptive capacity
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of adaptive technologies initiated and demonstrated
    </div>
</div>

<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of beneficiary households the correctly apply / use at least one new intervention / technology disaggregated by sector
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of final beneficiaries with increased awareness of adaptive livelihood activities
    </div>
</div>

<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of direct beneficiaries that know at least one non-direct beneficiary household that has also adopted one or more project innovations
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of cooperatives/businesses formed around appropriate technologies and innovations
    </div>
</div>

<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of trainees that report an increase in income resulting from project supported interventions
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of trainees reporting an increase in income from project initiated (but no longer actively supported) interventions
    </div>
</div>

<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.sectorPieDistrictBar')

@endsection
