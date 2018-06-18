
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
    <div class="col-12 col-md-6" id="enDistrictBar" style="height: 400px;">
    </div>
</div>
<h3>Fuel Efficient Cook Stoves</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent decrease in firewood use for owners of new fuel-efficient cook stoves
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of fuel efficient cook stoves
    </div>
</div>
<h3>Renewables</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of households that acquire solar energy equipment
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of renewable energy systems
    </div>
</div>
<h3>Improved Charcoal Production System</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of improved charcoal production systems
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
    </div>
</div>
<h3>Discontinued</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of interlocking compressed stabilized earth block (ICSEB) presses
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of fuel briquette presses
    </div>
</div>

<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.energyPieDistrictBar')

@endsection
