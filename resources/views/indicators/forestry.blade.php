
@extends('layouts.app')

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
    <div class="col-12" id="seedlingsGrownBar" style="height: 1500px;">
    </div>

</div>

<h3>Afforestation and Reforestation</h3>
<div class="row text-center">

    <!-- Placeholder-->
    <div class="col-12 " id="treesPlantedBar" style="height: 1500px;">
    </div>
</div>


<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.forestryPieDistrictBar')

<script>
// D3 javascript for Seedlings seedlingsGrown
const seedlingsBar= new BasicBarChart(
    '#seedlingsGrownBar',
    {
        margin: {top: 315, bottom: 10, left: 150, right: 10,},
        dataSet: <?php echo json_encode( $seedlings ) ?>,
        xField: 'seedlingsGrown',
        yField: 'name',
        minVal: '-1000',
        maxVal: '36000',
        popupField: 'name',
        titleText: numberWithCommas(getFieldSum(<?php echo json_encode($seedlings)?>, 'seedlingsGrown')),
        titleTextColor: '#a3d02f',
        titleSize: '225px',
        titleDistance: '225',
        titleFont: 'sans-serif',
        fontWeight: 'bold',
        colorPalette: ['#a3d02f', '#bee067'],
        subTitleText: 'Seedlings Grown',
        subTitleDistance: '290',
        subTitleSize: '30px',
        subTitleTextColor: '#a3d02f',
    }
)

// D3 javascript for Trees Grown
const treesPlantedBar= new BasicBarChart(
    '#treesPlantedBar',
    {
        margin: {top: 315, bottom: 10, left: 150, right: 10,},
        dataSet: <?php echo json_encode( $treesPlanted ) ?>,
        xField: 'totalTrees',
        yField: 'name',
        minVal: '-1000',
        maxVal: '36000',
        popupField: 'name',
        titleText: numberWithCommas(getFieldSum(<?php echo json_encode($treesPlanted)?>, 'totalTrees')),
        titleTextColor: '#45ad00',
        titleSize: '225px',
        titleDistance: '225',
        titleFont: 'sans-serif',
        fontWeight: 'bold',
        colorPalette: ['#45ad00', '#6ecc30'],
        subTitleText: 'Trees Planted',
        subTitleDistance: '290',
        subTitleSize: '30px',
        subTitleTextColor: '#45ad00',
    }
)
</script>

@endsection
