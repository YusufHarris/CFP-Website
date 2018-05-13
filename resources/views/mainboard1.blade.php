
@extends('layouts.master')

@section('content')

<div class="row text-center">
    <div class="col-12 col-md-6">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead><tr><th>Sex</th><th>Direct Trainees</th><th>Indirect Trainees</th><th>Final Beneficiaries</th></tr></thead>
                <tbody>
                    @foreach($sexBens as $sexBen)
                    <tr><td> <b>{{ $sexBen->mF }}</b></td><td align="right">{{ number_format($sexBen->DirTrain, 0, ".", ",") }}</td>
                        <td align="right">{{ number_format($sexBen->IndTrain, 0, ".", ",") }}</td>
                        <td align="right">{{ number_format($sexBen->FinalBen, 0, ".", ",") }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-md-6" id="map">
        <script>
            var cities = L.layerGroup();

            @foreach($communities as $comm)
            L.marker([{{ $comm->latitude }}, {{ $comm->longitude }}], {title: '{{ $comm->community }}'}).bindPopup('<form method="POST" action="/">{{ csrf_field() }} <input type="hidden" name="idCom" value="{{ $comm->id }}"><input type="submit" value="{{ $comm->community }}"></form>').addTo(cities);
            @endforeach

            var mbAttr = 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

            var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr});

            var map = L.map('map', {
                center: [-5.20, 39.75],
                zoom: 9,
                layers: [grayscale, cities]
            });

                // control that shows state info on hover
        	var title = L.control();

            title.onAdd = function (map) {
        		this._div = L.DomUtil.create('div');
        		this._div.innerHTML = '<h4><a href="./">{{ count($communities) }} Communities</a></h4>'
        		return this._div;
        	};

            title.addTo(map);

            //L.control.layers(baseLayers, overlays).addTo(map);
        </script>
    </div>
</div>
<div class="row text-center">
    <div class="col-12" id="benBar">
    </div>
</div>

<script>

var data = [4, 8, 15, 16, 23, 42];

var x = d3.scale.linear()
    .domain([0, d3.max(data)])
    .range([0, 420]);

d3.select("#benBar")
  .selectAll("div")
    .data(data)
  .enter().append("div")
    .style("width", function(d) { return x(d) + "px"; })
    .text(function(d) { return d; });

</script>

@endsection
