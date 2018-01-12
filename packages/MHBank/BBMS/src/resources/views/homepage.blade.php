<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>Red Cross Iligan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
  <style>
          body {
              
              line-height: 1.8;
              color: #818181;
          }
          h2 {
              font-size: 24px;
              text-transform: uppercase;
              color: #303030;
              font-weight: 600;
              margin-bottom: 30px;
          }
          h4 {
              font-size: 19px;
              line-height: 1.375em;
              color: #303030;
              font-weight: 400;
              margin-bottom: 30px;
          }
          .jumbotron {
              background-color: #f4511e;
              color: #fff;
              padding: 100px 25px;
              height: 600px;
              
          }
          .container-fluid {
              padding: 60px 50px;
          }
          .bg-grey {
              background-color: #f6f6f6;
          }
          .logo-small {
              color: #f4511e;
              font-size: 50px;
          }
          .logo {
              color: #f4511e;
              font-size: 200px;
          }
          .thumbnail {
              padding: 0 0 15px 0;
              border: none;
              border-radius: 0;
          }
          .thumbnail img {
              width: 100%;
              height: 100%;
              margin-bottom: 10px;
          }
          .carousel-control.right, .carousel-control.left {
              background-image: none;
              color: #f4511e;
          }
          .carousel-indicators li {
              border-color: #f4511e;
          }
          .carousel-indicators li.active {
              background-color: #f4511e;
          }
          .item h4 {
              font-size: 19px;
              line-height: 1.375em;
              font-weight: 400;
              font-style: italic;
              margin: 70px 0;
          }
          .item span {
              font-style: normal;
          }
          .panel {
              border: 1px solid #f4511e;
              border-radius:0 !important;
              transition: box-shadow 0.5s;
          }
          .panel:hover {
              box-shadow: 5px 0px 40px rgba(0,0,0, .2);
          }
          .panel-footer .btn:hover {
              border: 1px solid #f4511e;
              background-color: #fff !important;
              color: #f4511e;
          }
          .panel-heading {
              color: #fff !important;
              background-color: #f4511e !important;
              padding: 25px;
              border-bottom: 1px solid transparent;
              border-top-left-radius: 0px;
              border-top-right-radius: 0px;
              border-bottom-left-radius: 0px;
              border-bottom-right-radius: 0px;
          }
          .panel-footer {
              background-color: white !important;
          }
          .panel-footer h3 {
              font-size: 32px;
          }
          .panel-footer h4 {
              color: #aaa;
              font-size: 14px;
          }
          .panel-footer .btn {
              margin: 15px 0;
              background-color: #f4511e;
              color: #fff;
          }
          .navbar {
              margin-bottom: 0;
              background-color: #f4511e;
              z-index: 9999;
              border: 0;
              font-size: 12px !important;
              line-height: 1.42857143 !important;
              letter-spacing: 4px;
              border-radius: 0;
              padding-top: 20px;
              opacity: 0.9;
              

          }
          .navbar li a, .navbar .navbar-brand {
              color: #fff !important;
          }
          .navbar-nav li a:hover, .navbar-nav li.active a {
              color: #f4511e !important;
              background-color: #ff8346 !important;
          }
          .navbar-default .navbar-toggle {
              border-color: transparent;
              color: #000 !important;
          }
          footer .glyphicon {
              font-size: 20px;
              margin-bottom: 20px;
              color: #f4511e;
          }
          .slideanim {visibility:hidden;}
          .slide {
              animation-name: slide;
              -webkit-animation-name: slide;
              animation-duration: 1s;
              -webkit-animation-duration: 1s;
              visibility: visible;
          }
          @keyframes slide {
            0% {
              opacity: 0;
              transform: translateY(70%);
            }
            100% {
              opacity: 1;
              transform: translateY(0%);
            }
          }
          @-webkit-keyframes slide {
            0% {
              opacity: 0;
              -webkit-transform: translateY(70%);
            }
            100% {
              opacity: 1;
              -webkit-transform: translateY(0%);
            }
          }
          @media screen and (max-width: 768px) {
            .col-sm-4 {
              text-align: center;
              margin: 25px 0;
            }
            .btn-lg {
                width: 100%;
                margin-bottom: 35px;
            }
          }
          @media screen and (max-width: 480px) {
            .logo {
                font-size: 150px;
            }
          }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    @if (Route::has('login'))
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Red Cross Iligan</a>
          </div>
          @if (Auth::check())
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/admin') }}" style="color: #fff !important">Admin Panel</a></li>
                    <li class="dropdown" >
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true" style="color: #fff !important">
                                     Manage Options <span class="caret"></span>
                                </a>

                                      <ul class="dropdown-menu" role="menu" >
                                          <li>
                                        <a href="{{ url('/admin/users') }} " style="color:#f4511e !important; font-size: 10pt !important">Staff</a>
                                        <a href="{{ url('/clients_donors')}}" style="color:#f4511e !important; font-size: 10pt !important">Donors</a>
                                        <a href="{{ url('/clients_recipients') }}" style="color:#f4511e !important; font-size: 10pt !important" >Recipients</a>
                                        <a href="{{ url('/donations') }}" style="color:#f4511e !important; font-size: 10pt !important">Donations</a>
                                        <a href="{{ url('/inventory') }}" style="color:#f4511e !important; font-size: 10pt !important">Manage Inventory</a>
                                        <a href="{{ url('/releases') }}" style="color:#f4511e !important; font-size: 10pt !important">Manage Releases</a>
                                        <a href="{{ url('/hospitals') }}" style="color:#f4511e !important; font-size: 10pt !important">Manage Hospitals</a>
                                        <a href="{{ url('/reports') }}" style="color:#f4511e !important; font-size: 10pt !important">Generate Reports</a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                      </ul>
                    </li>
                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: #fff !important">
                                          {{ Auth::user()->name }} <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i><span class="caret"></span>
                                      </a>

                                      <ul class="dropdown-menu" role="menu">
                                          <li>
                                              <li><a href="{{ url('profile') }}" style="color:#f4511e !important"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                              </li>
                                              <!-- <li><a href="#" style="color:#f4511e !important"><i class="fa fa-gear fa-fw"></i> Settings</a> -->
                                              </li>
                                              <li class="divider"></li>
                                              <li><a href="{{ url('/logout') }}"
                                                  onclick="event.preventDefault();
                                                           document.getElementById('logout-form').submit();" style="color:#f4511e !important">
                                                  Logout
                                              </a></li>

                                              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;color:#f4511e !important">
                                                  {{ csrf_field() }}
                                              </form>
                                          </li>
                                      </ul>
                    </li>
              </ul>
          </div>
        </div>

          @else
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              
              <li><a href="#about">ABOUT</a></li>
              <li><a href="#services">SERVICES</a></li>
              <li><a href="#portfolio">NEWS and EVENTS</a></li>
              <li><a href="#pricing">RESOURCES</a></li>
              <li><a href="#contact">CONTACT US</a></li>
            </ul>
          </div>
        </div>
      </div>
        @endif
    @endif
</nav>

<div class="jumbotron text-center" style="padding-top:200px;background-image:url(/storage/5.jpg);margin-top:70px;background-size:100%;background-repeat:no-repeat;
      -webkit-background-size:cover;
      -moz-background-size:cover;
      -o-background-size:cover;
      background-size:cover;
      background-position:center;" >
  <h1>Welcome to Red Cross Iligan</h1>
  <h3>We Serve. We Provide. We Care.</h3>
  <form class="form-inline">
    
    @if (Route::has('login'))
          @if (Auth::check())
          @else
              <button type="button" class="btn btn-danger" style="padding-left:30px;padding-right:30px;margin-top:30px"><a href="{{ url('/admin/login') }}" style="color: white;padding-left:30px;padding-right:30px">Login</a></button>
        @endif
    @endif


    
  </form>
</div>

 
 <!-- Container (Services Section) 
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Red Cross Iligan</h2>
      <p>Red Cross Iligan is a chapter of Red Cross Philippines in Northern Mindanao.</p>
      <br><button class="btn btn-default btn-lg">Get in Touch</button>
    </div>
    <div class="col-sm-4">
      
      <img src="pic_mountain.jpg" alt="Mountain View" style="width:304px;height:228px;">
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2><br>
      <h4><strong>MISSION:</strong> Our mission lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
      <p><strong>VISION:</strong> Our vision Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>

<!-- Container (Services Section) 
<div id="services" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-off logo-small"></span>
      <h4>POWER</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>LOVE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>JOB DONE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h4>GREEN</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>CERTIFIED</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4 style="color:#303030;">HARD WORK</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
  </div>
</div>

<!-- Container (Portfolio Section) 
<div id="portfolio" class="container-fluid text-center bg-grey">
  <h2>Portfolio</h2><br>
  <h4>What we have created</h4>
  <div class="row text-center slideanim">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="paris.jpg" alt="Paris" width="400" height="300">
        <p><strong>Paris</strong></p>
        <p>Yes, we built Paris</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="newyork.jpg" alt="New York" width="400" height="300">
        <p><strong>New York</strong></p>
        <p>We built New York</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="sanfran.jpg" alt="San Francisco" width="400" height="300">
        <p><strong>San Francisco</strong></p>
        <p>Yes, San Fran is ours</p>
      </div>
    </div>
  </div><br>
  
  <h2>What our customers say</h2>
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">

    <!-- Indicators 
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides 
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"This company is the best. I am so happy with the result!"<br><span style="font-style:normal;">Michael Roe, Vice President, Comment Box</span></h4>
      </div>
      <div class="item">
        <h4>"One word... WOW!!"<br><span style="font-style:normal;">John Doe, Salesman, Rep Inc</span></h4>
      </div>
      <div class="item">
        <h4>"Could I... BE any more happy with this company?"<br><span style="font-style:normal;">Chandler Bing, Actor, FriendsAlot</span></h4>
      </div>
    </div>

    <!-- Left and right controls 
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Container (Pricing Section) 
<div id="pricing" class="container-fluid">
  <div class="text-center">
    <h2>Pricing</h2>
    <h4>Choose a payment plan that works for you</h4>
  </div>
  <div class="row slideanim">
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Basic</h1>
        </div>
        <div class="panel-body">
          <p><strong>20</strong> Lorem</p>
          <p><strong>15</strong> Ipsum</p>
          <p><strong>5</strong> Dolor</p>
          <p><strong>2</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>$19</h3>
          <h4>per month</h4>
          <button class="btn btn-lg">Sign Up</button>
        </div>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Pro</h1>
        </div>
        <div class="panel-body">
          <p><strong>50</strong> Lorem</p>
          <p><strong>25</strong> Ipsum</p>
          <p><strong>10</strong> Dolor</p>
          <p><strong>5</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>$29</h3>
          <h4>per month</h4>
          <button class="btn btn-lg">Sign Up</button>
        </div>
      </div>
    </div>
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Premium</h1>
        </div>
        <div class="panel-body">
          <p><strong>100</strong> Lorem</p>
          <p><strong>50</strong> Ipsum</p>
          <p><strong>25</strong> Dolor</p>
          <p><strong>10</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>$49</h3>
          <h4>per month</h4>
          <button class="btn btn-lg">Sign Up</button>
        </div>
      </div>
    </div>
  </div>
</div>

-->

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Iligan City, Philippines</p>
      <p><span class="glyphicon glyphicon-phone"></span> +63 228 0681</p>
      <p><span class="glyphicon glyphicon-envelope"></span> redcrossiliga@gmail.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="googleMap" style="height:400px;width:100%;"></div>

<!-- Add Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter = new google.maps.LatLng(8.230833, 124.236111);

function initialize() {
var mapProp = {
  center:myCenter,
  zoom:12,
  scrollwheel:false,
  draggable:false,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Red Cross Iligan. All Rights Reserved.</p>
  <p>Software Provided by MHBank, Inc.</p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

<script>
$(document).ready(function(){
    $(".btn").click(function(){
        $(this).button("loading").delay(500).queue(function(){
            $(this).button("reset");
            $(this).dequeue();
        });
    });
});
</script>

</body>
</html>

