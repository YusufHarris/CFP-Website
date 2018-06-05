
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
    <div class="col-12" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of seedlings grown
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
    </div>
</div>
<h3>Afforestation and Reforestation</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number trees propagated and planted
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
@include('js.forestryPieDistrictBar')

@endsection
