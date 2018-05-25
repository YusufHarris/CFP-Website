
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
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of agriculture beneficiaries that report increased yields
    </div>
</div>
<h3>Kitchen Gardens</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of kitchen garden trainees that report eating vegetables and fruits more days per week
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of kitchen gardens established
    </div>
</div>
<h3>Beekeeping</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of top bar or Langstroth beehives
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Area of agroforestry systems established
    </div>
</div>
<h3>Agroforestry</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of agriculture beneficiaries that report increased yields
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Area of agroforestry systems established
        Area of spice forest polyculture systems established
    </div>
</div>
<h3>Spice Forest Polyculture</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Area of spice forest polyculture systems established
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Area of spice forest polyculture systems established
    </div>
</div>


<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.agriculturePieDistrictBar')

@endsection
