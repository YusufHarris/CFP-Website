
@extends('layouts.app')

@section('content')

<div class="row text-center">
    <div class="col-12 col-md-6 col-lg-4">
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
    <div class="col-12 col-md-6 col-lg-4" id="agDistrictBar" style="height: 400px;">
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-lg-4">
        <div style="height: 50px;">
            <h5>Percent of agriculture beneficiaries that report increased yields</h5>
        </div>
        <div id="yieldPie" style="height: 350px;">
        </div>
    </div>
</div>
<h3>Kitchen Gardens</h3>
<div class="row text-center">
    <div class="col-12 col-md-6" >
      <div style="height: 50px">
        <h5>Kitchen garden trainees that report eating vegetables and fruits more days per week</h5>
      </div>
      <div id="vegetablePie" style="height: 350px;">
      </div>
    </div>

    <div class="col-12 col-md-6" id="kitchenBar" style="height: 400px;">
      </div>
    </div>
</div>

<h3>Beekeeping</h3>
<div class="row text-center">
  <div class="col-12 " id="beehiveBar" style="height: 400px;">
  </div>
</div>

<h3>Agroforestry</h3>
<div class="row text-center">
  <div class="col-12" id="agroBar" style="height: 400px;">
  </div>
</div>

<h3>Spice Forest Polyculture</h3>
<div class="row text-center">
  <div class="col-12" id="spiceBar" style="height: 400px;">
  </div>
</div>


<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.agriculturePieDistrictBar')

<script>
// D3 javascript for Yield Change Pie Chart
const yieldChgPie = new BasicPieChart(
    '#yieldPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $yieldChgs ) ?>,
        valueField: 'beneficiaries',
        catField: 'yield01',
        classField: 'yield01',
        unit: '',
        fillRatio: 0.5,
        showTotals: false,
        showAsPercent: true,
        colorPalette: ['#ff8442','#00a86b','#ffd963'],
    }
)

// D3 javascript for Increased Fruits and vegetable pie
const vegetablePie = new BasicPieChart(
    '#vegetablePie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $vegetables ) ?>,
        valueField: 'amount',
        catField: 'category',
        unit: '',
        fillRatio: 0.5,
        showTotals: false,
        showAsPercent: true,
        colorPalette: ['#00a86b','#b5d6ff'],
        sliceTextColor: '#00281a',
    }
)

// D3 javascript for
const kitchenBar = new BasicBarChart(
    '#kitchenBar',
    {
        margin: {top: 10, bottom: 10, left: 125, right: 10,},
        dataSet: <?php echo json_encode( $kitchenGardens ) ?>,
        xField: 'totalKitchens',
        yField: 'district',
        unit: '',
        fillRatio: 0.5,
        showTotals: true,
        showAsPercent: false,
        colorPalette: ['#00a86b','#22bf86'],
        yTextColor: '#666',
        xTextColor: '#fff',
        totalsTextColor: '#666',
        titleText: numberWithCommas(getFieldSum(<?php echo json_encode($kitchenGardens)?>, 'totalKitchens')) + ' Kitchen Gardens',
        titleTextColor: '#00a86b',
    }
)

// D3 javascript for
const beehiveBar = new BasicBarChart(
    '#beehiveBar',
    {
        margin: {top: 10, bottom: 10, left: 125, right: 10,},
        dataSet: <?php echo json_encode( $beehives ) ?>,
        xField: 'totalHives',
        yField: 'district',
        unit: '',
        fillRatio: 0.5,
        showTotals: true,
        showAsPercent: false,
        colorPalette: ['#ffd142','#ffd963'],
        yTextColor: '#666',
        xTextColor: '#fff',
        totalsTextColor: '#666',
        titleText: numberWithCommas(getFieldSum(<?php echo json_encode($beehives)?>, 'totalHives')) + ' Beehives',
        titleTextColor: '#e29f02',
    }
)

// D3 javascript for
const agroBar = new BasicBarChart(
    '#agroBar',
    {
        margin: {top: 10, bottom: 10, left: 125, right: 10,},
        dataSet: <?php echo json_encode( $agroArea ) ?>,
        xField: 'totalArea',
        yField: 'district',
        unit: 'Ha',
        fillRatio: 0.5,
        showTotals: true,
        showAsPercent: false,
        colorPalette: ['#ff8442','#ff9963'],
        yTextColor: '#666',
        xTextColor: '#fff',
        totalsTextColor: '#fff',
        titleText: numberWithCommas(getFieldSum(<?php echo json_encode($agroArea)?>, 'totalArea')) + 'Ha of Agroforestry Systems',
        titleTextColor: '#f60',
    }
)

// D3 javascript for
const spiceBar = new BasicBarChart(
    '#spiceBar',
    {
        margin: {top: 10, bottom: 10, left: 125, right: 10,},
        dataSet: <?php echo json_encode( $spiceArea ) ?>,
        xField: 'totalArea',
        yField: 'district',
        unit: 'Ha',
        fillRatio: 0.5,
        showTotals: true,
        showAsPercent: false,
        colorPalette: ['#00a86b','#22bf86'],
        yTextColor: '#666',
        xTextColor: '#fff',
        totalsTextColor: '#666',
        titleText: numberWithCommas(getFieldSum(<?php echo json_encode($spiceArea)?>, 'totalArea')) + 'Ha of Spice Forests',
        titleTextColor: '#00a86b',
    }
)

</script>

@endsection
