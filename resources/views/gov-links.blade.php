
@extends('layouts.master')

@section('content')

<div class="row text-center">
        <!-- Government Agencies-->
    <div class="col-12 col-md-6" id="govAgencies" style="overflow-y:auto; height: 400px;">
        <h4>{{count($agencies)}} Strategic Partnerships</h4>
        <?php list($agencies1, $agencies2) = array_chunk($agencies, ceil(count($agencies) / 2));?>
        <div class="row text-left">
            <div class="col-6">
                <ul>
                    @foreach($agencies1 as $agency)
                    <li>{{ $agency->agencyName }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6">
                <ul>
                    @foreach($agencies2 as $agency)
                    <li>{{ $agency->agencyName }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
        <!-- Government Members and Agencies Chart-->
    <div class="col-12 col-md-6" id="govTrainees" style="height: 400px;">
    </div>
</div>
<div class="row text-center">
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>{{count($workshops)}} Government Workshops</h4>
        <?php list($workshops1, $workshops2) = array_chunk($workshops, ceil(count($workshops) / 2));?>
        <div class="row text-left">
            <div class="col-6">
                <ul>
                    @foreach($workshops1 as $workshop)
                    <li>{{ $workshop->startDate }} - {{ $workshop->title }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6">
                <ul>
                    @foreach($workshops2 as $workshop)
                    <li>{{ $workshop->startDate }} - {{ $workshop->title }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Placeholder-->
    <div class="col-12 col-md-6" class="placeholder" style="height: 400px;">
        <h4>Placeholder:</h4>
        Number of project interventions incorporated into district development or land use plans
    </div>
</div>

<!-- D3 javascript for Government Member Bar Chart -->
<!--'js.govMembersBar')-->

<script>

// D3 javascript for Knowing Others that have adapted the activities
const govBar= new BasicBarChart(
    '#govTrainees',
    {
        margin: {top: 10, bottom: 10, left: 150, right: 10,},
        dataSet: <?php echo json_encode( $agencies ) ?>,
        xField: 'members',
        yField: 'agencyAcronym',
        popupField: 'agencyName',
        titleText: getFieldSum(<?php echo json_encode($agencies)?>, 'members') + ' Government Members',
        colorPalette: ['#FF9FCC','#FC0076'],
    }
)

</script>


@endsection
