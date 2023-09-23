@extends('layout.home')
@section('content')
<div class="container-fluid">
	<div class="row"><a href="{{url()->previous()}}"><i class="fa fa-arrow-left" style="font-size: 30px;color: red;"></i></a></div>
	<div class="row content-row">
		<div class="col">
			<div style="display: flex;flex-direction: row;margin-left: 48px;">
				<ol class="smallPic">
					@php
					$sideImg=json_decode($cakes->img_name);
					@endphp
					@foreach($sideImg as $img)
					<li class="sidePic"><img class="card-img-top" src="{{ url('public/images/'.$img) }}" alt="Card image" style="width: 100px;height: 100px;">
					</li>
					@endforeach
					
				</ol>
				<div class="bigPic">
					<ul class="">
					@foreach($sideImg as $key=>$img)
						@if($key==0)<img class="card-img-top img-responsive" src="{{ url('public/images/'.$img) }}" id="bigimg" alt="Card image" >
					@endif
					@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="col">
			<div>
				<h3 class="" style="text-align: left;margin-bottom: 40px;">{{$cakes ->cake_name}} 
				</h3>
				<h4><i class="fas fa-rupee-sign" style="font-size: 23px;"></i><span id="weightPrice">{{$cakes->cake_price}}</span></h4>
				<!-- <span><i class="fas fa-rupee-sign"></i>564 </span> -->
				<span>(Inclusive of GST)</span>
				<h5>Select Weight</h5>
				<div class="weight-price">
					<div class="kg" onclick="kgPrice(1,this)">0.5 Kg</div>
					<div class="kg" onclick="kgPrice(2,this)">1 Kg</div>
					<div class="kg" onclick="kgPrice(2.5,this)">1.5 Kg</div>
					<div class="kg" onclick="kgPrice(4.3,this)">2 Kg</div>
					<div class="kg" onclick="kgPrice(8.4,this)">4 Kg</div>
				</div>
				<span style="font-size: 20px;font-weight: 500;">Cake Massage</span>
				<!-- form for cart -->
				<form action="{{url('addToCart')}}" method="Post" id="cartData">
					@csrf
				<div class="customerMsg">
					@foreach($sideImg as $key=>$img)
						@if($key==0)
						<input type="hidden" name="img_name" value="{{$img}}">
						@endif
					@endforeach
						<input type="hidden" name="cake_url" value="{{$cakes ->cake_url}}">
						<input type="hidden" name="cake_name" value="{{$cakes ->cake_name}}">
						<input type="hidden" name="cake_price" value="{{$cakes->cake_price}}" id="cake_price">
						<input type="hidden" name="cake_weight" value="0.5 Kg" id="cake_weight">
						<input type="hidden" name="cake_quentity" value="1">
					<input type="text" name="cake_massage" placeholder="Enter message on cake" class="form-control required" required id="cMessage" maxlength='25'><br>
					<span class="message-length">25 characters left</span>
				</div>
				<div class="customerMsg mt-2">
					<span style="font-size: 20px;font-weight: 500;">Delivery Location</span><br>
					<input type="text" name="location" placeholder="Enter your city" class="form-control required" required>
				</div>
				<div class="cartBuy">
					<button type="button" class="d addCart" onclick="submitForm('cartData','post')">Add To Cart</button>
					<div class="d buy-now"><a class="buy-now no-decoration" href="{{url('checkout')}}">Buy Now</a> </div>
				</div>
				</form>
				<hr>
				<div class="cake-description">
					<h4>Cake Description</h4>
					<div class="">{{$cakes->cake_details}}</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-details">
        <div class="card-heading">Recently Viewed Products</div>
        <div class="card-description">
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
    <div class="card-details">
        <div class="card-heading">You may also like</div>
        <div class="card-description">
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
        </div>
    </div>
</div>

@endsection
<script >
window.addEventListener('load', function() {
	
	//for weight change in hidden input
		document.getElementsByClassName('weight-price')[0].addEventListener('click',(e)=>{ 
			let v=e.target.innerText
		document.getElementById('cake_weight').value=v;

		});
//for image
	var f1 = document.getElementsByClassName('smallPic')[0];
	f1.addEventListener('click', identify, false);

	function identify(e) {
	  for (let i = 0; i < document.images.length; i++) {
	    if (document.images[i] === e.target) {
	       document.getElementById('bigimg').src=document.images[i].src;
	    }
	  }
	}
	//for remaining characters in message box
	$("#cMessage").on('input', function() {
		var left = this.maxLength - this.value.length;
		$(".message-length").text(left + " characters left");
	});
});
//for weight by price
function kgPrice(value,c) {

	$('.kg').removeAttr('style');
    $(c).css({'backgroundColor':'#abfff0','boxShadow':' 0 0 7px','color':'red'});

	document.getElementById('weightPrice').innerHTML={{$cakes->cake_price}}*value;

	document.getElementById('cake_price').value={{$cakes->cake_price}}*value;

}


</script>
