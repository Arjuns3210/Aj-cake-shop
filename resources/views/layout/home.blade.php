<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" type="image/x-icon" href="https://media.bakingo.com/chocolate.jpg?tr=w-184,dpr-1.5,q-70" />
  <title>Aj cake shop</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{ url('public/css/index.css') }}" >
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- <script type="text/javascript" src="{{ url('public/js/ckeditor/ckeditor.js') }}"></script> -->
  <script src="{{url('public/js/ajax.js')}}"></script>
  <script src="{{url('public/js/custom.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>

   <div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-3 d-md-block d-md-flex d-none" style="padding-left: 30px;padding-top: 4px;"> 
            <div><a class="navbar-brand" href="/cake-shop"><img src="{{ url('public/img/aj.png') }}" class="img-responsive" style="width:10rem !important;"></a></div>
            <div class="mt-2">
                <i class="fas fa-map-marker-alt text-danger h-25"></i>
                <span>
                    <a href="#"  class="no-decoration"><span id="city">Mumbai</span>
                        <i class="fa fa-regular fa-caret-down"></i>
                    </a>
                </span>
            </div>
        </div>
        <div class="col-md-5 d-none d-md-block" style="height: 42px;width: 35vw;">
            <form action="{{url('searchCake')}}" method="get">
                <div class="input-group mb-3">
                    <input class="form-control password" id="search" class="block mt-1 w-full" placeholder="Search Cake" type="text" name="search"/>
                    <button class="input-group-text">
                        <i class="fa fa-search" id="sBtn"
                        style="cursor: pointer"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-4 d-md-block d-none m-auto">
            <ul class="nav justify-content-end align-items-center ">
                <li class="nav-item lr danger">
                    <a class="nav-link" href="{{url('myAccount?tab=wallet')}}"><i class='fa fa-wallet' style='font-size:24px'></i></a>
                    <span class="card-span">Wallet</span>
                </li>
                <li class="nav-item  lr">
                    <a class="nav-link" href="{{url('track_order')}}"><i class="fa fa-map-marked" style='font-size:24px'></i></a>
                    <span class="card-span">Track Order</span>
                </li>
                @if(Session::get('user'))
                <li class="nav-item lr ">
                    <a class="nav-link" href="{{url('cart')}}"><i class="fa fa-cart-arrow-down" style='font-size:24px'></i></a>
                    <div class="coutCart">({{session::get('cart')}})</div>
                    <span class="card-span">My Cart</span>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user" style='font-size:24px'></i>
                My account
                </a>
                <!-- <span>My account</span> -->
                <ul class="dropdown-menu">
                    <div class="prName font-weight-bold">
                        <a href="myAccount?tab=Profile" class="no-decoration">
                            <i class='fa fa-user-circle' style='font-size:24px;color:red;'></i> 
                            <span class="text-danger">{{session::get('user')}}</span>
                        </a>
                    </div>
                    <li><a class="dropdown-item" href="{{url('myAccount?tab=Profile')}}">My Profile</a></li>
                    <li><a class="dropdown-item" href="{{url('myAccount?tab=order')}}" id="MyOrde">My Oders</a></li>
                    <li><a class="dropdown-item" href="{{url('myAccount?tab=address')}}" id="ManageAddress">Manage Address</a></li>
                    <li><a class="dropdown-item" href="{{url('cake_add')}}">Add Cake</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{url('logout')}}">Logout</a></li>
                </ul>
                </li>
                @else
                <li class="nav-item lr ">
                    <a class="nav-link" href="{{url('cart')}}"><i class="fa fa-cart-arrow-down" style='font-size:24px'></i></a>
                    <div class="coutCart">({{session::get('cart')??''}})</div>
                    <span class="card-span">My Cart</span>
                </li>
                <li class="nav-item lr">
                    <a class="nav-link" href="{{url('login')}}"><i class='fa fa-user' style='font-size:24px'></i></a>
                    <span class="card-span">Login</span>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- mobile view -->
    <div class="header-content d-md-none">
        <div class="d-flex">
            <div class="">
                <a class="navbar-brand" href="/cake-shop"><img src="{{ url('public/img/aj.png') }}" class="img-responsive" style="width:auto;height: 30px;"></a>
            </div>
            <div class="m-auto">
                <button class="btn" type="submit"><i class="fa fa-search"></i></button>
            </div>
            <div class="nav-item ">
                <button class="btn" type="submit"><a href="{{url('cart')}}" class="fa fa-cart-arrow-down"></a></button>
            </div>
            <div class="">
                  <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                    <i class="fa fa-bars"></i>
                  </button>
                <div class="offcanvas offcanvas-lg offcanvas-end" id="demo">
                  <div class="offcanvas-header">
                    @if(session::get('user'))
                    <span class=""><i class='fa fa-user' style='font-size:24px;color: red;'></i> {{session::get('user')}}</span>
                    @else
                    <div><i class='fa fa-user' style='font-size:24px;color: red;'></i> Hello!</div>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                  </div><hr>

                  @if(!session::get('user'))
                     <div class="p-auto" style="border-bottom: 1px solid red;padding: 8px;font-family: -webkit-body;color: red">Please login to access your account <a class="no-decoration text-danger" href="{{url('login')}}"> Login</a>
                    </div>
                  @endif
                  <div class="offcanvas-body">
                    @if(session::get('user'))
                    <a class="no-decoration fa fa-cart-arrow-down" href="{{url('cart')}}"> My Cart</a><br>
                    <a class="fa fa-wallet no-decoration" href="{{url('cart')}}"> Wallet</a><br>
                    <a class="fa fa-map-marked no-decoration" href="{{url('track_order')}}"> Track Order</a><br>
                    <a class="fa fa-plus no-decoration" href="{{url('cake_add')}}"> Add Cake</a><br>
                    <a class=" text-danger rounded" href="logout">Logout</a>
                    @else
                    <br>
                    <a class="no-decoration" href="{{url('cart')}}"><i class="fa fa-cart-arrow-down"></i> My Cart</a>

                    @endif
                  </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @yield('content')
    <div class="container-fluid">
        
   
            <footer class="aj-footer mt-2 row d-flex">
                <div class="footer-year col-md-3">
                    <a class="navbar-brand" href="/cake-shop"><img src="{{ url('public/img/logo1.png') }}"  class="img-fluid"></a>
                    <br/><span>&copy; 2022 &nbsp;</span>
                </div>
                <div class="know-us col-md-3">Know Us
                    <ul class="know-list">
                        <li>Our Story</li>
                        <li>Contact Us</li>
                        <li>Locate Us</li>
                    </ul>
                </div>
                <div class="need-help col-md-3">Need Help
                    <ul class="know-list">
                    <li>Cancellation and Refund</li>
                    <li>Privacy Policy</li>
                    <li>Terms and Conditions</li>
                    </ul>
                </div>
                <div class="find-us col-md-3">Find Us
                    <ul class="know-list">
                        <li>Corporate Cakes</li>
                        <li>Coupons & Offers</li>
                        <li>Franchise</li>
                        <li>Download App</li>
                    </ul>
                </div>
            </footer>
    </div>
</body>
</html>
<!-- The City Modal -->
<div class="modal" id="cityModel">
  <div class="modal-dialog ">
        <div class=" model-box" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            
            <div class="select-city">Select City</div>
            <div class="selectCity-heading">And Get Your Cake Delivered In 2 Hours</div>
            <div class="city-heading-container"><span class="city-header-line"></span>
                <span class="city-header">Popular Cities</span>
                <span class="city-header-line"></span>
            </div>
            <div class="city-container">
                <div class="city-card citypopup-card">
                    <img class="city-image" src="https://media.bakingo.com/city/delhi.png" alt="Delhi">
                    <div class="headCity">Delhi</div>
                </div>
                <div class="city-card citypopup-card">
                    <img class="city-image" src="https://media.bakingo.com/city/gurgaon.png" alt="Gurgaon">
                    <div class="headCity">Gurgaon</div>
                </div>
                <div class="city-card citypopup-card">
                    <img class="city-image" src="https://media.bakingo.com/city/noida.png" alt="Noida">
                    <div class="headCity">Noida</div>
                </div>
                <div class="city-card citypopup-card">
                    <img class="city-image" src="https://media.bakingo.com/city/ghaziabad.png" alt="Ghaziabad">
                    <div class="headCity">Mumbai</div>
                </div>
                <div class="city-card citypopup-card">
                    <img class="city-image" src="https://media.bakingo.com/city/bangalore.png" alt="Bangalore">
                    <div class="headCity">Bangalore</div>
                </div>
                <div class="city-card citypopup-card">
                    <img class="city-image" src="https://media.bakingo.com/city/hyderabad.png" alt="Hyderabad">
                    <div class="headCity">Hyderabad</div>
                </div>
            </div>
            <div class="city-heading-container">
                <span class="city-header-line"></span>
                <span class="city-header">Other Cities</span>
                <span class="city-header-line"></span>
            </div>

            <div class="other-city-container">
          <div class="ocn">'+data[i].city_name+'</div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$('.city-card').click(function(){
    var v=$(this).text();
        // console.log(v);
       $('#city').text(v);
    $('#cityModel').modal('hide');


});

$('#city').click(function () {
    $('#cityModel').modal('show');
    // body...
    $.ajax({
            type:"get",
            cache:false,
            url:"{{ url('/city') }}",
            data:{},
            dataType:"json",

            success:function(data){
                var response = JSON.stringify(data);
              // console.log(data);
                let city=data.length;
              // console.log(city);
              // console.log(data[0].city_name);
              var html="";
              for(i=0;i<city;i++){
                    html +='<div class="ocn">'+data[i].city_name+'</div>';
                // console.log(html);

              }
              $('.other-city-container').html(html);
                $('.ocn').click(function () {
                    var v=$(this).text();
                    console.log(v);
                   $('#city').text(v);
                   $('#cityModel').modal('hide');
                });
            }
        });

});
</script>