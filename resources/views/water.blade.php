
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
    <div class="col-12 col-md-6" id="waDistrictBar" style="height: 400px;">
    </div>
</div>
<h3>Rainwater Harvesting</h3>
<div class="row text-center">

    <div class="col-12 col-md-6 col-lg-4" class="placeholder" style="height: 400px;">
        <div style="height: 50px;">
            <h5>Number of beneficiary households with improved access to water for human consumption</h5>
        </div>
        <div id="waterHHPie" style="height: 350px;">
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div style="height: 50px;">
            <h5>Number of community rainwater harvesting systems</h5>
        </div>
        <div id="waterSysPie" style="height: 350px;">
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div style="height: 50px;">
            <h5>Storage capacity of rainwater harvesting systems</h5>
        </div>
        <div id="waterCapacityPie" style="height: 350px;">
        </div>
    </div>
</div>
<h3>Catchment Conservation</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6">
        <div style="height: 50px;">
            <h5>Number of beneficiary households with improved access to water for agriculture</h5>
        </div>
        <div id="waterAgPie" style="height: 350px;">
        </div>
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6">
        <div style="height: 50px;">
            <h5>Area of community catchment conservation areas restored</h5>
        </div>
        <div id="waterCatchPie" style="height: 350px;">
        </div>
    </div>
</div>

<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.waterPieDistrictBar')

<script>

// D3 javascript for Water Household Beneficiaries-
const waterHHPie = new BasicPieChart(
    '#waterHHPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $waterHHs ) ?>,
        valueField: 'totalHH',
        catField: 'status',
        classField: 'status',
        valueUnit: 'HH',
        fillRatio: 0.5,
        showTotals: false,
    }
)

// D3 javascript for Water System Count
const waterSysPie = new BasicPieChart(
    '#waterSysPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $waSys ) ?>,
        valueField: 'totalSystems',
        catField: 'status',
        classField: 'status',
        valueUnit: 'Systems',
        fillRatio: 0.5,
        showTotals: false,
    }
)

// D3 javascript for Total Water Capacity
const waterCapPie = new BasicPieChart(
    '#waterCapacityPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $waCap ) ?>,
        valueField: 'totalCapacity',
        catField: 'status',
        classField: 'status',
        valueUnit: 'L',
        fillRatio: 0.5,
        showTotals: false,
    }
)

// D3 javascript for Water Agriculture Beneficiaries
const waterAgPie = new BasicPieChart(
    '#waterAgPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $waAg ) ?>,
        valueField: 'totalHH',
        catField: 'shortenedName',
        classField: 'shortenedName',
        valueUnit: 'HH',
        fillRatio: 0.5,
        showTotals: true,
    }
)

// D3 javascript for Water Agriculture Beneficiaries
const waterCatchPie = new BasicPieChart(
    '#waterCatchPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $waCatch ) ?>,
        valueField: 'hectares',
        catField: 'shortenedName',
        classField: 'shortenedName',
        valueUnit: 'Ha',
        fillRatio: 0.5,
        showTotals: true,
    }
)
</script>

@endsection
