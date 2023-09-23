@extends('layout.home')
@section('content')


<div class="container-fluid">
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
        </div>
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ url('public/img/img1.png') }}" alt="Los Angeles" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="{{ url('public/img/img2.jpg') }}" alt="Chicago" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="{{ url('public/img/img4.jpg') }}" alt="New York" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src= "{{ url('public/img/img3.jpg') }}" alt="New York" class="d-block" style="width:100%">
            </div>
        </div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="card-details">
        <div class="card-heading">Experience Flavours</div>
        <div class="card-description">
            @foreach($categories as $cat)
            <a href="cake/{{$cat->category_url}}" class="no-decoration">
            <div class="card1">
                <img class="card-img-top" src="{{url('public/catImages/'.$cat->image_path)}}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">{{$cat->category_name}}</h4>
                    <p class="card-text">{{$cat->category_description}}</p>
                </div>
            </div></a>
            @endforeach
            <div class="card1">
                <img class="card-img-top" src="{{ url('public/img/chocolate.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Chocolate</h4>
                    <p class="card-text">For choco addicts</p>
                </div>
            </div>
            <div class="card1">
                <img class="card-img-top" src="{{ url('public/img/fruit.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Fruits</h4>
                    <p class="card-text">A Test of Tropics</p>
                </div>
            </div>
            <div class="card1">
                <img class="card-img-top" src="{{ url('public/img/redVelvet.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Red Velvet</h4>
                    <p class="card-text">For Exotic Lover</p>
                </div>
            </div>
            <div class="card1">
                <img class="card-img-top" src="{{ url('public/img/mango.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Mango</h4>
                    <p class="card-text">For Mango Lovers</p>
                </div>
            </div>
            <div class="card1">
                <img class="card-img-top" src="{{ url('public/img/blackforest.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Blackforest</h4>
                    <p class="card-text">The All Time Favourite</p>
                </div>
            </div>
            <div class="card1">
                <img class="card-img-top" src="{{ url('public/img/pineapple.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Pineapple Cake</h4>
                    <p class="card-text">Evergreen One</p>
                </div>
            </div>
            <div class="card1">
                <img class="card-img-top" src="{{ url('public/img/butterscotch.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Butterscotch</h4>
                    <p class="card-text">For Candy Fans</p>
                </div>
            </div>
            <div class=   "card1">
                <img class="card-img-top" src="{{ url('public/img/kit_kat.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Kit Kat</h4>
                    <p class="card-text">Crunchiness Overloaded</p>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection


