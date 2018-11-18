@extends('layouts.app')

@section('content')

<!-- jumbotron -->
<div id="jumbotron" class="py-6 text-center text-light shade parallax-window">
    <div class="container" style="">
        <h1 id="cfp-title" class="h2 text-uppercase">Community Forests Pemba</h1>
        <div class="container"><img src="/storage/main/CFP_large_logo.png" alt="CFP" width="200px"></div>
        <div id="btn-contact" class="container">
            <a class="btn btn-info btn-lg scroll" href="#contact">Contact Us</a>
        </div>
    </div>
</div>
<script>
$('.parallax-window').parallax({imageSrc: '/storage/main/banner.jpg'});
</script>

<!-- about -->
<div id="about" class="py-5 pt-5 pb-4 bg-light border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center text-uppercase">Mission</h3>
                <p class="lead mb-0">
                    To adapt to climate change and overcome poverty on Pemba Island by
                    sharing knowledge, advancing sustainable livelihoods, and restoring the
                    natural environment.
                </p>
                <hr/>
                <h2 class="text-center text-uppercase">Vision</h3>
                <p class="lead mb-0 ">
                    Pemba communities thrive in harmony with the natural world. The
                    challenges of climate change are overcome with resilient livelihoods that
                    create lasting positive change.
                </p>
                <hr/>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <i class="fa fa-4x fa-shopping-basket text-warning"></i>
                <h4>Agriculture</h4>
                <p class="mb-0">
                    We have expertise in assisting small-scale farmers to convert thier monoculture farmland,
                    a common practice throughout Pemba, to regenerative and diversified agroforesty and spice
                    forest polyculture systems.  We also assist women with developing household permaculture
                    systems for improving nutrition and developing small businesses selling their produce.
                </p>
            </div>
            <div class="col-md-3 mb-4">
                <i class="fa fa-4x fa-bolt text-danger"></i>
                <h4>Energy</h4>
                <p class="mb-0">
                    In partnership with <a href="https://forestsinternational.org/">CFI</a>, we developed a
                    community-wide solar portable microgrid, that has since spun off into the for-profit business,
                    <a href="https://www.jazaenergy.com/">Jaza</a>.  In communities with limited access
                    to main-line energy where the Jaza model does not fit, we continue to improve access to
                    renewable energy through community-based systems, whether it's in the community's gathering
                    center or at the household level.
                    We also have expertise in improved cook stove production that reduces both smoke and biomass
                    consumption.
                </p>
            </div>
            <div class="col-md-3 mb-4">
                <i class="fa fa-4x fa-tree text-success"></i>
                <h4>Forestry</h4>
                <p class="mb-0">
                    We have assisted over 32 communities throughout Pemba with planting over one million trees
                    and counting.  Coupled with reforestation efforts, we work in partnership with local government
                    authorities to support communities with gaining land rights to their forests and building their
                    capacity to sustainably manage them through community-based natural resource management plans.
                    Additionally, we work with communities to develop sustainable beekeeping in the forests to
                    provide non-wood-based forest products as alternative income generation activities.
                </p>
            </div>
            <div class="col-md-3 mb-4">
                <i class="fa fa-4x fa-tint text-primary"></i>
                <h4>Water</h4>
                <p class="mb-0">
                    We assist communities with improving access to water for households and agriculture, including
                    community-scale rainwater harvesting systems, catchment conservation, drip irrigation systesm,
                    and gray water use for household vegetable gardens.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- photo gallery -->
<div id="galleries" class="py-5 pt-5 pb-4 border-bottom">
    @if(is_null($galleries))
    @else
    <div class="container">
        <h2 class="text-center text-uppercase">Latest <a href="{{route('galleries')}}">News</a></h2>
        <div class="row col-md">
            @foreach($galleries as $gallery)
            <div class="col-md-3 mb-4 img-thumbnail">
                <a href="{{route('gallery.show', $gallery->id)}}" class="opa">
                    <img src="{{$gallery->photos[0]->filename}}" class="w-100" alt="{{$gallery->title}}">
                    <p class="text-center text-light bg-dark" style="border-bottom-right-radius:50px;border-bottom-left-radius:50px;">
                        {{$gallery->title}}</br>
                        <span class="text-uppercase"><strong>{{$gallery->sector}}</strong></span>
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Beneficiaries -->
<div id="beneficiaries" class="py-5 pt-5 pb-4 bg-light border-bottom">
    <div class="container">
        <h2 class="text-center text-uppercase">Meet Our Beneficiaries</h2>
        <div id="carouselTestimonials" class="carousel slide text-center" data-ride="carousel" data-interval="7500" style="height:400px;">
            <div class="carousel-inner">
                <?php $cnt = 0; ?>
                @foreach ($beneficiaries as $beneficiary)
                <div class="carousel-item{{ $cnt == 0 ? ' active' : '' }}">
                    <div class="row">
                        <div class="col-8 offset-2">
                            <img class="mb-3 rounded-circle img-thumbnail shadow" src="{{$beneficiary->avatar}}" onerror="this.src='https://i.imgur.com/fitWknA.png';">
                            <p class="lead font-italic">{{$beneficiary->name}}</p>
                            <p class="">{{$beneficiary->occupation}}</p>
                            <p class="mb-0">{{$beneficiary->introduction}}</p>
                        </div>
                    </div>
                </div>
                <?php $cnt += 1; ?>
                @endforeach
            </div>
            <a class="carousel-control-prev text-dark" href="#carouselTestimonials" role="button" data-slide="prev">
                <i class="fa fa-lg fa-chevron-left"></i>
            </a>
            <a class="carousel-control-next text-dark" href="#carouselTestimonials" role="button" data-slide="next">
                <i class="fa fa-lg fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Donors -->
<div id="donors" class="py-5 pt-5 pb-4 border-bottom">
    @if(is_null($donors))
    @else
    <div class="container">
        <h2 class="text-center text-uppercase">Our Donors</h2>
        <div class="row col-md-12">
            @foreach ($donors as $donor)
            <div class="col-md-2 text-center">
                <img src="{{$donor->logo}}" data-toggle="tooltip" data-html="true" data-animation="true" title="{{$donor->title}}" class="curve img-thumbnail shadow" alt="$donor->title">
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Staff -->
<div id="staff" class="py-5 pt-5 pb-4 bg-light border-bottom">
    @if(is_null($employees))
    @else
    <div class="container">
        <h2 class="text-center text-uppercase">Our Staff</h2>
        <div class="row col-md">
            @foreach ($employees as $employee)
            <div class="col-md-3 text-center">
                <ul style="list-style-type:none;">
                    <li><img src="{{$employee->avatar}}" class="avatar-sm curve shade img-thumbnail" onerror="this.src='https://i.imgur.com/fitWknA.png';" alt="{{$employee->name}} Photo"/></p>
                    <li><h4>{{$employee->name}}</h4></li>
                    <li><strong><h5 style="font-style:italic;">{{$employee->title}}</h5></strong></li>
                    <li>{{$employee->description}}</li>

                </ul>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Contact -->
<div id="contact" class="py-5 pt-5 pb-4 border-bottom">
    <div class="container">
        <h2 class="text-center text-uppercase">Contact Us</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <ul class="list-unstyled lead mb-0">
                    <li class="mb-2">
                        <i class="fa fa-fw fa-phone"></i> +255 777 427450
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-fw fa-envelope"></i>
                        <a href="mailto:contact@forestspemba.org" class="text-decoration-none">
                            contact@forestspemba.org
                        </a>
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-fw fa-map-marker"></i>
                        Plot 56 Minyenyeni
                        P.O. Box 177
                        Wete, Pemba, Zanzibar
                        Tanzania
                    </li>
                    <li>
                        <i class="fa fa-fw fa-clock-o"></i> 8am-4pm Monday-Friday
                    </li>
                </ul>
            </div>
            <div id="office-map" class="col-md-8 mb-4"></div>
        </div>
    </div>
</div>

<!-- social -->
<div id="social" class="pt-5 pb-4 bg-dark">
    <div class="container">
        <h2 class="text-center text-uppercase text-light mb-4-5">Like &amp; Follow Us</h2>
        <div class="row justify-content-center">
            <div class="col-auto mb-4">
                <a href="https://www.facebook.com/COMMUNITYFORESTSPEMBA" class="text-light" target="_blank">
                    <i class="fa fa-3x fa-facebook"></i>
                </a>
            </div>
            <div class="col-auto mb-4">
                <a href="https://www.youtube.com/user/forestsinternational" class="text-light" target="_blank">
                    <i class="fa fa-3x fa-youtube"></i>
                </a>
            </div>
        </div>                                                                                                                                                                                      </div>
    </div>
</div>

<!-- Custom Javascript for the Welcome Page -->
<script src="{{asset('js/welcome.js')}}"></script>

@endsection
