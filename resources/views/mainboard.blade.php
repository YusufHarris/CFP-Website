
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

<!-- 2nd row -->

<div class="row text-center">
        <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="overflow-y:auto; height: 400px;">


      <h4>{{count($communities)}} Beneficiary Communities</h4>
      <?php

        // Filter for individual districts
        $wet = array_filter($communities, function($obj)
        {
            return $obj->district == "Wete";
        });

        $mko = array_filter($communities, function($obj)
        {
            return $obj->district == "Mkoani";
        });

        $cha = array_filter($communities, function($obj)
        {
            return $obj->district == "Chake Chake";
        });
        $mic = array_filter($communities, function($obj)
        {
            return $obj->district == "Micheweni";
        });

      ?>

        <div class="row text-left">
          <div class="col-6">

            <h5>{{count($wet)}} Wete</h5>
            <ul>
              @foreach($wet as $community)
                <li>{{ $community->community }}</li>
              @endforeach
            </ul>


          </div>
          <div class="col-6">

            <h5>{{count($mic)}} Micheweni</h5>
            <ul>
              @foreach($mic as $community)
                <li>{{ $community->community }}</li>
              @endforeach
            </ul>
            <h5>{{count($cha)}} Chake Chake</h5>
            <ul>
              @foreach($cha as $community)
                <li>{{ $community->community }}</li>
              @endforeach
            </ul>
            <h5>{{count($mko)}} Mkoani</h5>
            <ul>
              @foreach($mko as $community)
                <li>{{ $community->community }}</li>
              @endforeach
            </ul>

          </div>
        </div>
    </div>



    <!-- PlaceholderNumber of adaptive technologies initiated and demonstrated-->

            <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="overflow-y:auto; height: 400px;">

      <h4>{{count($activities)}} Adaptive Technologies</h4>
      <?php
      $wat = array_filter($activities, function($obj)
      {
          return $obj->sector == "Water";
      });
      $agr = array_filter($activities, function($obj)
      {
          return $obj->sector == "Agriculture";
      });
      $for = array_filter($activities, function($obj)
      {
          return $obj->sector == "Forestry";
      });
      $ene = array_filter($activities, function($obj)
      {
          return $obj->sector == "Energy";
      });
      ?>

        <div class="row text-left">


          <div class="col-6">


            <h5>{{count($wat)}} Water</h5>
            <ul>
              @foreach($wat as $activity)
                <li>{{ $activity->activity }}</li>
              @endforeach
            </ul>
            <h5>{{count($ene)}} Energy</h5>
            <ul>
              @foreach($ene as $activity)
                <li>{{ $activity->activity }}</li>
              @endforeach
            </ul>

          </div>
          <div class="col-6">

            <h5>{{count($for)}} Forestry</h5>
            <ul>
              @foreach($for as $activity)
                <li>{{ $activity->activity }}</li>
              @endforeach
            </ul>
            <h5>{{count($agr)}} Agriculture</h5>
            <ul>
              @foreach($agr as $activity)
                <li>{{ $activity->activity }}</li>
              @endforeach
            </ul>

          </div>
        </div>
    </div>

</div>

<!-- end second row -->

<div class="row text-center">

    <!-- Placeholder-->
    <div class="col-12 col-md-6" >
      <div style="height:50px;">
        <h4>Beneficiary Income Change</h4>
      </div>
      <div style="height:350px" id="incomeChange" class= "incomePie">
      </div>

    </div>

    <!-- Placeholder-->
    <div class="col-12 col-md-6">

      <div style="height:50px;">
        <h4>Beneficiary Awareness Change</h4>
      </div>
      <div style="height:350px" id="increasedAwarenessPie" >
      </div>





    </div>
</div>

<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6">
      <div style="height:50px;">
        <h4>Beneficiaries Who Know Other Project Beneficiaries </h4>
      </div>
      <div style="height:350px" id="knowOthersPie">
      </div>
    </div>
    <!-- Placeholder-->

      <div class="col-12 col-md-6" id= "businessesFormed" style="overflow-y:auto; height: 400px;">

        <h4>{{count($businesses)}} Businesses Formed</h4>
        <?php
        $ear = array_filter($businesses, function($obj)
        {
            return $obj->keyActivity == "06 - Interlocking Compressed Stabilized Earth Blocks";
        });
        $coo = array_filter($businesses, function($obj)
        {
            return $obj->keyActivity == "05 - Fuel Efficient Cook Stoves";
        });
        $tre = array_filter($businesses, function($obj)
        {
            return $obj->keyActivity == "02A - Tree Nurseries";
        });
        $aff = array_filter($businesses, function($obj)
        {
            return $obj->keyActivity == "02B - Afforestation & Reforestation";
        });
        $agr = array_filter($businesses, function($obj)
        {
            return $obj->keyActivity == "01 - Agroforestry";
        });
        $sus = array_filter($businesses, function($obj)
        {
            return $obj->keyActivity == "08 - Sustainable Beekeeping";
        });
        $spi = array_filter($businesses, function($obj)
        {
            return $obj->keyActivity == "12 - Spice Forest Polyculture";
        });

        ?>

          <div class="row text-left">


            <div class="col-6">



              <h5>{{count($coo)}}  Fuel Efficient Cook Stoves</h5>
              <ul>
                @foreach($coo as $businesses)
                  <li>{{ $businesses->uniqueMIName }}</li>
                @endforeach
              </ul>
              <h5>{{count($tre)}}  Tree Nurseries</h5>
              <ul>
                @foreach($tre as $businesses)
                  <li>{{ $businesses->uniqueMIName }}</li>
                @endforeach
              </ul>
              <h5>{{count($aff)}}  Afforestation & Reforestation</h5>
              <ul>
                @foreach($aff as $businesses)
                  <li>{{ $businesses->uniqueMIName }}</li>
                @endforeach
              </ul>

            </div>
            <div class="col-6">

              <h5>{{count($agr)}}  Agroforestry</h5>
              <ul>
                @foreach($agr as $businesses)
                  <li>{{ $businesses->uniqueMIName }}</li>
                @endforeach
              </ul>
              <h5>{{count($sus)}}  Sustainable Beekeeping</h5>
              <ul>
                @foreach($sus as $businesses)
                  <li>{{ $businesses->uniqueMIName }}</li>
                @endforeach
              </ul>
              <h5>{{count($spi)}}  Spice Forest Polyculture</h5>
              <ul>
                @foreach($spi as $businesses)
                  <li>{{ $businesses->uniqueMIName }}</li>
                @endforeach
              </ul>
              <h5>{{count($ear)}}  Interlocking Compressed Stabilized Earth Blocks</h5>
              <ul>
                @foreach($ear as $businesses)
                  <li>{{ $businesses->uniqueMIName }}</li>
                @endforeach
              </ul>

            </div>
          </div>
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
        Percent of trainees reporting an increase in income from project initiated (but no longer actively supported) interventions
    </div>
</div>

<!-- D3 javascript for Beneficiary Pie Chart and Bar Chart -->
@include('js.sectorPieDistrictBar')
<!-- D3 javascript for Income Pie Chart -->
@include('js.incomePie')
<!-- D3 javascript for Income Pie Chart -->
@include('js.knowOthersPie')
@include('js.increasedAwarenessPie')
@endsection
