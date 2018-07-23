
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
    <div class="col-12 col-md-6" id="enDistrictBar" style="height: 400px;">
    </div>
</div>

<h3>Fuel Efficient Cook Stoves</h3>
<div class="row text-center">
    <div class="col-12 ">
        <div id="cookstoveBar" style="height: 400px;">
        </div>
    </div>
</div>
<div class="row text-center">

    <div class="col-12 col-md-6"  style="overflow-y:auto; height:400px;color:#00043d;font-family:sans-serif;">
      <h1>{{count($cookstoveGroups)}} Cookstove Production Groups</h1>
      <?php
        // Filter for individual districts
        $wet = array_filter($cookstoveGroups, function($obj)
        {
            return $obj->district == "Wete";
        });
        $mko = array_filter($cookstoveGroups, function($obj)
        {
            return $obj->district == "Mkoani";
        });
        $cha = array_filter($cookstoveGroups, function($obj)
        {
            return $obj->district == "Chake Chake";
        });
        $mic = array_filter($cookstoveGroups, function($obj)
        {
            return $obj->district == "Micheweni";
        });
      ?>


        <div class="row text-left">
          <div class="col-6">
            <h5>{{count($wet)}} Wete</h5>
            <ul>
              @foreach($wet as $cookstoveGroups)
                <li>{{ $cookstoveGroups->uniqueMIName }}</li>
              @endforeach
            </ul>

            <h5>{{count($mic)}} Micheweni</h5>
            <ul>
              @foreach($mic as $cookstoveGroups)
                <li>{{ $cookstoveGroups->uniqueMIName }}</li>
              @endforeach
            </ul>

          </div>
          <div class="col-6">
            <h5>{{count($mko)}} Mkoani</h5>
            <ul>
              @foreach($mko as $cookstoveGroups)
                <li>{{ $cookstoveGroups->uniqueMIName }}</li>
              @endforeach
            </ul>
            <h5>{{count($cha)}} Chake Chake</h5>
            <ul>
              @foreach($cha as $cookstoveGroups)
                <li>{{ $cookstoveGroups->uniqueMIName }}</li>
              @endforeach
            </ul>

          </div>
      </div>

    </div>

    <div class="col-12 col-md-6" >
      <div style="height:50px;">
        <h4>Beneficiaries requiring less firewood</h4>
      </div>
      <div style="height:350px" id="decreasedFirewoodPie">
      </div>
    </div>
</div>


<h3>Renewables</h3>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" id="solarHouseholdsBar" style="height: 400px;">

    </div>

    <div class="col-12 col-md-6"  style="overflow-y:auto; height:400px;color:#b73a00;font-family:sans-serif;">
      <div style="height: 100px;">
      </div>
      <h1>{{count($enSystems)}} Renewable Energy Systems</h1>
      <?php
        // Filter for individual districts
        $wet = array_filter($enSystems, function($obj)
        {
            return $obj->district == "Wete";
        });
      ?>

      <h2>{{count($wet)}} Wete</h2>
      <ul>
        @foreach($wet as $enSystems)
          <h3>{{ $enSystems->uniqueMIName }}</h3>
        @endforeach
      </ul>

    </div>
</div>

<h3>Improved Charcoal Production System</h3>
<div class="row text-center">
  <div class="col-12 col-md-6" style="height:400px;color:#c07;font-family:sans-serif;">
      <h1>{{count($charcoalSys)}} Improved Charcoal Production Systems</h1>
  </div>
</div>

<h3>Discontinued</h3>

<div class="row text-center">
    <div class="col-12 col-md-6"  style="overflow-y:auto; height:400px;color:#00043d;font-family:sans-serif;">
      <div style="height: 50px">
      </div>
      <h1>{{count($earthBlocks)}} Earth Block Presses</h1>
      <?php
        // Filter for individual districts
        $wet = array_filter($earthBlocks, function($obj)
        {
            return $obj->district == "Wete";
        });
        $mko = array_filter($earthBlocks, function($obj)
        {
            return $obj->district == "Mkoani";
        });
        $cha = array_filter($earthBlocks, function($obj)
        {
            return $obj->district == "Chake Chake";
        });
        $mic = array_filter($earthBlocks, function($obj)
        {
            return $obj->district == "Micheweni";
        });
      ?>


        <div class="row text-left">
          <div class="col-6">
            <h5>{{count($wet)}} Wete</h5>
            <ul>
              @foreach($wet as $earthBlocks)
                <li>{{ $earthBlocks->uniqueMIName }}</li>
              @endforeach
            </ul>

            <h5>{{count($mic)}} Micheweni</h5>
            <ul>
              @foreach($mic as $earthBlocks)
                <li>{{ $earthBlocks->uniqueMIName }}</li>
              @endforeach
            </ul>

          </div>
          <div class="col-6">
            <h5>{{count($mko)}} Mkoani</h5>
            <ul>
              @foreach($mko as $earthBlocks)
                <li>{{ $earthBlocks->uniqueMIName }}</li>
              @endforeach
            </ul>
            <h5>{{count($cha)}} Chake Chake</h5>
            <ul>
              @foreach($cha as $earthBlocks)
                <li>{{ $earthBlocks->uniqueMIName }}</li>
              @endforeach
            </ul>

          </div>
      </div>

    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of fuel briquette presses
    </div>
</div>

<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.energyPieDistrictBar')
@include('js.cookstoveBar')
@include('js.solarHouseholdsBar')


<script>
// D3 javascript for Decreased Firewood Pie Chart
const decreasedFirewoodPie = new BasicPieChart(
    '#decreasedFirewoodPie',
    {
        margin: {top: 10, bottom: 10, left: 10, right: 10,},
        dataSet: <?php echo json_encode( $firewood ) ?>,
        valueField: 'amount',
        catField: 'category',
        fillRatio: 0.5,
        showTotals: false,
        showAsPercent: true,
        colorPalette: ['#526887','#e572d4','#ffb99e'],
        sliceTextColor: '#fff',
    }
)




</script>

@endsection
