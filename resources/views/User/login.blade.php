@extends('layout.home')
@section('content')
<div class="container-fluid">
    <div class="row mt-2 login-bg" style="height:auto;">
        <div class="row" style="margin: auto;width: 53em;">
            <div class="col-md-6 d-md-block d-none" style="background-image:url('public/img/side1.png')">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner" style="height: 500px;">
                    <div class="carousel-item active">
                        <img src="{{ url('public/img/l.png') }}" alt="Los Angeles" class="d-block img-fluid" style="width:100%">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('public/img/l1.png') }}" alt="Chicago" class="d-block img-fluid" style="width:100%">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('public/img/l2.png') }}" alt="New York" class="d-block img-fluid" style="width:100%">
                    </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6" style="padding:3em;background: radial-gradient(#bde6fb,#dedede);font-style: italic;">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="">
                        <a class="nav-link active" data-bs-toggle="tab" href="#login-tab">Login</a>
                        </li>
                        <li class="">
                        <a class="nav-link" data-bs-toggle="tab" href="#signup-tab">Signup</a>
                        </li>
                    
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="login-tab" class="container tab-pane active"><br>
                            @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                @if($error != 'login')
                                                    <li>{{ $error }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                            @endif 
                            <form action="loginData" method="Post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email1" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control password" id="password" class="block mt-1 w-full" type="password" name="password" required />
                                        <span class="input-group-text" onclick="myFunction()">
                                            <i class="far fa-eye-slash" id="pass"
                                            style="cursor: pointer"></i>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <h6 style="font-family: cursive;border-top: 1px solid red;padding-bottom: 10px;margin-top: 30px;text-align: right;"><a href="">Forgot password?</a> </h6>
                        </div>
                        <div id="signup-tab" class="container tab-pane fade"><br>
                        
                        <form action="saveUser" method="Post" id="saveUser">
                            @csrf
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Name</label>
                                <input type="text" name="user_name" class="form-control required" id="user_name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control required" id="email1">
                            </div>
                            <div class="mb-3">
                                <label for="mobile_no" class="form-label">Mobile</label>
                                <input type="tel" name="mobile_no" class="form-control required" id="mobile_no">
                            </div>
                            <div class="mb-3">
                                <label for="password1" class="form-label">Password</label>
                                <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control required" id="password1">
                                    <span class="input-group-text" onclick="myFunction1()">
                                        <i class="far fa-eye-slash" id="pass1"
                                        style="cursor: pointer"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control required" id="address">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="submitForm('saveUser','post')">Submit</button>
                        </form>
                        </div>
                    </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {

    x.type = "text";
    var element = document.getElementById("pass");
  element.classList.remove("fa-eye-slash");
  element.classList.add("fa-eye");
  } else {
     var element = document.getElementById("pass");
  element.classList.add("fa-eye-slash");
    x.type = "password";
  }
}
function myFunction1() {
  var x = document.getElementById("password1");
  if (x.type === "password") {

    x.type = "text";
    var element1 = document.getElementById("pass1");
  element1.classList.remove("fa-eye-slash");
  element1.classList.add("fa-eye");
  } else {
     var element1 = document.getElementById("pass1");
  element1.classList.add("fa-eye-slash");
    x.type = "password";
  }
}
</script>
