
@extends('layouts.app')

@section('content')

<div class="row text-center">
        <!-- Placeholder-->
        <div class="col-12 col-md-6">
            <!-- Selecter for the beneficiary type -->
            <div style="height: 50px;">
                <h4>Percent of Female Beneficiaries</h4>
            </div>
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
    <div class="col-12 col-md-6" >
      <div style="height: 25px;">
      </div>
      <div style="height:50px;">
        <h4>Percent of female beneficiaries represented in formed cooperatives / businesses</h4>
      </div>
      <div style="height: 25px;">
      </div>
      <div id="genderPie" style="height: 350px;">
      </div>



    </div>
</div>
<div style="height: 50px;">
</div>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Percent of cooperatives / businesses that have at least one women in a board position other than Treasurer / Cashier
    </div>
    <div>
    </div>
    <div class="col-12 col-md-6" >
      <div style="height:50px;">
        <h4>Percentage of Female Beneficiaries Who Control Their Own Income</h4>
      </div>
      <div style="height:350px" id="incomeControlPie" class= "incomePie">
      </div>
</div>
@include('js.genderBenPie')

<script>

// D3 javascript for Women controlling income pie
const incomeControlPie = new BasicPieChart(
    '#incomeControlPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $incomeControl ) ?>,
        valueField: 'amount',
        catField: 'category',
        unit: '',
        fillRatio: 0.5,
        showTotals: false,
        showAsPercent: true,
        colorPalette: ['#70c9c1','#36aa84','#f9c83b','#ce678c'],
        sliceTextColor: '#113a2d',
    }
)

// D3 javascript for Increased Fruits and vegetable pie
const genderPie = new BasicPieChart(
    '#genderPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $busGen ) ?>,
        valueField: 'amount',
        catField: 'category',
        unit: '',
        fillRatio: 0.5,
        showTotals: false,
        showAsPercent: true,
        colorPalette: ['#ce678c','#f9c83b'],
        sliceTextColor: '#113a2d',
    }
)
</script>
@endsection
