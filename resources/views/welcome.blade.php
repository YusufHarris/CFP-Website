@extends('layouts.app')

@section('content')

<!-- jumbotron -->
<div id="home" class="py-6 text-center text-light" style="background-image: url(/storage/main/banner.jpg); background-size: cover; background-position: center;">
  <div class="container">
    <h1 class="h2 text-uppercase">Community Forest Pemba</h1>
    <p class="lead">We are together.</p>
    <a href="#about" class="btn btn-primary btn-lg">Learn More</a>
    <a href="#contact" class="btn btn-primary btn-lg">Contact Us</a>
  </div>
</div>


<!-- about -->
  <div id="about" class="py-5 ">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <h2 class="text-center text-uppercase mb-4-5">About Us</h2>
          <h3 class="text-center text-uppercase text-light bg-dark">Vision</h3>
          <p class="lead mb-0">Together we change the world. Through shared challeges we create opportunity.
           Our communities have transformed how we live and work. We are all leaders. We all innovate.
           We work in harmony with the natural world. It's not just our responsibility, it's our potential.
          </p>
          <hr/>
          <h3 class="text-center text-uppercase text-light bg-dark">Mission</h3>
          <p class="lead mb-0">
           To foster environmental stewardship in the four districts of Pemba,
           Zanzibar by establishing community forests,
           promoting sustainable forestry techniques and initiating environmental education.
          </p>
        </div>
      </div>
    </div>
  </div>

<!-- features -->
  <div id="features" class="pt-5 pb-4 text-center bg-light">
    <div class="container">
      <h2 class="text-uppercase mb-4-5">Our Expertise</h2>
      <div class="row">
       <div class="col-md-3 mb-4">
        <span class="fa-stack fa-3x mb-2">
         <img src="/storage/Pictures/water.jpg" onerror="this.src='';" alt="" class="fas fa-dollar-sign fa-stack-1x fa-inverse" style="border-radius:50px;"/>
        </span>
        <h4>Water</h4>
        <p class="mb-0">
         Community Forests Pemba has installed two large scale rain water harvesting systems on two remote islets off of the coast of Pemba.
         These systems come complete with large storage tanks and UV and micron filters to ensure that the water is safe for consumption.
        </p>
      </div>
     <div class="col-md-3 mb-4">
      <span class="fa-stack fa-3x mb-2">
        <img src="/storage/Pictures/agriculture.jpg" onerror="this.src='';" alt="" class="fas fa-dollar-sign fa-stack-1x fa-inverse" style="border-radius:50px;"/>
      </span>
      <h4>Agriculture</h4>
      <p class="mb-0">Our communities are practicing a multitude of small-scale gardening
        techniques to increase their access to the fruits and vegetables necessary for a
        healthy diet.
      </p>
      </div>
       <div class="col-md-3 mb-4">
        <span class="fa-stack fa-3x mb-2">
         <img src="/storage/Pictures/forestry.jpg" onerror="this.src='';" alt="" class="fas fa-dollar-sign fa-stack-1x fa-inverse" style="border-radius:50px;"/>
       </span>
       <h4>Forestry</h4>
       <p class="mb-0">
         Our communities have planted over 1,000,000 trees throughout Pemba.
         It is inspiring to see tree planting continue to grow and spread throughout the island.
       </p>
      </div>
      <div class="col-md-3 mb-4">
        <span class="fa-stack fa-3x mb-2">
          <img src="/storage/Pictures/energy.jpg" onerror="this.src='';" alt="" class="fas fa-dollar-sign fa-stack-1x fa-inverse" style="border-radius:50px;"/>
        </span>
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

<!-- image gallery -->
<div id="galleries" class="pt-5 pb-4 bg-light">
  <div class="container">
    <h2 class="text-center text-uppercase mb-4-5">Galleries</h2>
    <div class="row col-md">
        @foreach($galleries as $gallery)
              <div class="col-md-3 mb-4">
                <a href="{{route('newgal.show', $gallery->id)}}">
                  <p class="text-center text-light bg-dark" style="border-bottom-right-radius:50px;border-bottom-left-radius:50px;">
                    {{$gallery->title}}</br>
                    <span class="text-uppercase"><strong>{{$gallery->sector}}</strong></span>
                  </p>
                </a>
              </div>

        @endforeach
    </div>
  </div>
</div>


<!-- staff -->
        <div id="staff" class="pt-5 pb-4 bg-light">
        <div class="container">
            <h2 class="text-center text-uppercase mb-4-5">Our Staff</h2>
            <div class="row col-md">

                @foreach ($employees as $employee)
                      <div class="col-md text-center">
                        <ul style="list-style-type:none;">


                          <li><img src="{{$employee->avatar}}" class="avatar-sm" onerror="this.src='https://i.imgur.com/fitWknA.png';" width="150px" height="150px" style="border-radius:50px;" alt="{{$employee->name}} Photo"/></p>
                          <li><h4>{{$employee->name}}</h4></li>
                          <li><strong><h5 style="font-family:times; font-style:italic;">{{$employee->title}}</h5></strong></li>
                          <li>{{$employee->description}}</li>

                        </ul>
                      </div>
                  @endforeach

            </div>
        </div>
<hr>
<!-- testimonials -->
<div id="testimonials" class="py-5 text-center ">
  <div class="container">
  <h2 class="text-center text-uppercase mb-4-5">Beneficiaries of Our Project</h2>
    <div class="row col-md">
      @foreach ($beneficiaries as $beneficiary)
        <div class="col-md text-center">
          <ul style="list-style-type:none;">
            <li><img src="{{$beneficiary->avatar}}" onerror="this.src='https://i.imgur.com/fitWknA.png';" width="125px" height="125px" style="border-radius:50px;" alt="{{$beneficiary->directory}}defavatar.jpg"/></p>
            <li><h4>{{$beneficiary->name}}</h4></li>
            <li><strong><h5 style="font-family:times; font-style:italic;">{{$beneficiary->occupation}}</h5></strong></li>
            <li>{{$beneficiary->introduction}}</li>
          </ul>
        </div>
      @endforeach
    </div>
  </div>
</div>

<!-- contact -->
<div id="contact" class="pt-5 pb-4 bg-light">
  <div class="container">
     <h2 class="text-center text-uppercase mb-4-5">Contact Us</h2>
     <div class="row">
      <div class="col-md-4 mb-4">
        <p>Please feel free to get in touch with us today!</p>
        <ul class="list-unstyled lead mb-0">
          <li class="mb-2">
            <a href="tel:+255 777 427450" class="text-decoration-none">
              <i class="fa fa-fw fa-phone"></i> +255 777 427450
            </a>
          </li>
          <li class="mb-2">
           <a href="mailto:webmaster@forestspemba.org" class="text-decoration-none">
            <i class="fa fa-fw fa-envelope"></i> webmaster@forestspemba.org
           </a>
          </li>
          <li class="mb-2">
           <a href="" target="_blank" class="text-decoration-none">
            <i class="fa fa-fw fa-map-marker-alt"></i>
            Location
            Plot 56 Minyenyeni
            P.O. Box 177
            Wete, Pemba, Zanzibar
            Tanzania
          </a>
          </li>
          <li>
           <i class="fa fa-fw fa-clock"></i> 8am-4pm Monday-Friday
          </li>
        </ul>
      </div>
      <div class="col-md-8 mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7948.582784700076!2d39.724669437775496!3d-5.056439127307255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2stz!4v1535627312433" width="600" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
     </div>
  </div>
</div>

<!-- social -->
<div id="social" class="pt-5 pb-4 bg-primary">
  <div class="container">
  <h2 class="text-center text-uppercase text-light mb-4-5">Like &amp; Follow Us</h2>
    <div class="row justify-content-center">
      <div class="col-auto mb-4">
        <a href="https://www.facebook.com/COMMUNITYFORESTSPEMBA" class="text-light" target="_blank">
          <i class="fab fa-3x fa-facebook"></i>
        </a>
      </div>
      <div class="col-auto mb-4">
        <a href="https://www.youtube.com/user/forestsinternational" class="text-light" target="_blank">
          <i class="fab fa-3x fa-youtube"></i>
        </a>
      </div>
      <div class="col-auto mb-4">
        <a href="https://twitter.com/mycompany" class="text-light" target="_blank">
          <i class="fab fa-3x fa-twitter"></i>
        </a>
      </div>
    </div>                                                                                                                                                                                      </div>
  </div>
</div>
@endsection
