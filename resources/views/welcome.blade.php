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
<div id="about" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center text-uppercase mb-4-5" style="margin-bottom:25px;">About</h2>
                <hr/>
                <h3 class="text-center text-uppercase rounded">Vision</h3>
                <p class="lead mb-0 ">
                    Pemba communities thrive in harmony with the natural world. The
                    challenges of climate change are overcome with resilient livelihoods that
                    create lasting positive change.
                </p>
                <hr/>
                <h3 class="text-center text-uppercase rounded">Mission</h3>
                <p class="lead mb-0">
                    To adapt to climate change and overcome poverty on Pemba Island by
                    sharing knowledge, advancing sustainable livelihoods, and restoring the
                    natural environment.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Focus -->
<div id="features" class="pt-5 pb-4 img-thumbnail shade text-center bg-light">
    <div class="container">
        <h2 class="text-uppercase mb-4-5">Our Focus</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div>
                    <i class="fa fa-4x fa-tint text-primary"></i>
                </div>
                <h4>Water</h4>
                <p class="mb-0">
                    Community Forests Pemba has installed two large scale rain water harvesting systems on two remote islets off of the coast of Pemba.
                    These systems come complete with large storage tanks and UV and micron filters to ensure that the water is safe for consumption.
                </p>
            </div>
            <div class="col-md-3 mb-4">
                <div>
                    <i class="fa fa-4x fa-shopping-basket text-warning"></i>
                </div>
                <h4>Agriculture</h4>
                <p class="mb-0">
                    Our communities are practicing a multitude of small-scale gardening
                    techniques to increase their access to the fruits and vegetables necessary for a
                    healthy diet.
                </p>
            </div>
            <div class="col-md-3 mb-4">
                <div>
                    <i class="fa fa-4x fa-tree text-success"></i>
                </div>
                <h4>Forestry</h4>
                <p class="mb-0">
                    Our communities have planted over 1,000,000 trees throughout Pemba.
                    It is inspiring to see tree planting continue to grow and spread throughout the island.
                </p>
            </div>
            <div class="col-md-3 mb-4">
                <div>
                    <i class="fa fa-4x fa-bolt text-danger"></i>
                </div>
                <h4>Energy</h4>
                <p class="mb-0">
                    Community Forests Pemba is working to revolutionize off grid electricity.
                    Each household in a community receives a locally available motorcycle battery and 12V LED light bulb.
                    When the battery dies, they then take the battery to the central charging station,
                    where they pay into a community fund and recharge the battery.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- photo gallery -->
<div id="galleries" class="pt-5 pb-4">
    @if(is_null($galleries))
    @else
    <div class="container">
        <h2 class="text-center text-uppercase mb-4-5">Latest <a href="{{route('galleries')}}">News</a></h2>
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
<div id="beneficiaries" class="py-5 text-center img-thumbnail shade">
    <div class="container">
        <h2 class="text-center text-uppercase mb-4-5">Meet Our Beneficiaries</h2>
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
<div id="donors" class="pt-5 pb-4 img-thumbnail shade bg-light">
    @if(is_null($donors))
    @else
    <div class="container">
        <h2 class="text-center text-uppercase mb-4-5">Our Donors</h2>
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
<div id="staff" class="pt-5 pb-4 bg-light">
    @if(is_null($employees))
    @else
    <div class="container">
        <h2 class="text-center text-uppercase mb-4-5">Our Staff</h2>
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
<div id="contact" class="pt-5 pb-4 bg-light">
    <div class="container">
        <h2 class="text-center text-uppercase mb-4-5" style="">Contact Us</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <p>Please feel free to get in touch with us today!</p>
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
