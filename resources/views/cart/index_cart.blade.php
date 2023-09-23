@extends('layout.home')
@section('content')
<div class="container">
	<div class="row mt-4 mb-3" style="width: 100%;font-size: 18px;color: #0a818d;font-family: emoji;margin-left: 60px;">My Cart({{$count}} item)</div>
	<div class="row" style="justify-content: center;margin: auto;width: 100%;">
	<div class="col-sm-7">
		@foreach($cart_items as $key=>$cart)
		<div class="cartList">
			<div>
				<img src="{{ url('public/img/'.$cart->img_name) }}" class="cartImg">
			</div>
			<div>
				<ul class="cartListing">
					<li>
				<a href="{{url('buy/'.$cart->cake_url)}}" class="no-decoration">
						{{$cart->cake_name}}</a></li>
					<li>₹<span id="cakePrice{{$cart->id}}">{{$cart->cake_price}}</span></li>
					<li>{{$cart->cake_weight}}</li>
					<li style="display: flex;">
						Quantity
						@if($cart->cake_quentity > 1) 
							<button class="fa fa-minus sub" style="border: none;background: none;" id="sub{{$cart->id}}" onclick="changeQty('sub', {{$cart->id}})"></button>
						@else
							<span style="padding-right: 26px !important;"></span>
						@endif
						<input type="text" value="{{$cart->cake_quentity}}" readonly class="cartInput" id="qty{{$cart->id}}" name="cake_quentity" onload="on({{$cart->id}})">
						@if($cart->cake_quentity < 10)
							<button class="fa fa-plus add" style="border: none;background: none;" id="add{{$cart->id}}" onclick="changeQty('add', {{$cart->id}})"></button>
						@endif
					</li>
				</ul>
			</div>
			<div class="" style="width: 100%;text-align: right;">
				<a data-url="deleteCart/{{$cart->id}}" class="delete-data"><i class="fa fa-trash"></i></a>
			</div>
		</div>
		@endforeach
	</div>
	<div class="col-sm-4" >
		<div class="p-4" style="border: 2px solid hsla(0,0%,72.5%,.42);border-radius: 20px;">
			<span>Order summery</span>
			<div>
				<div class="grandTotal">Sub Total
					<strong>₹{{$cartP}}</strong>
				</div>
				<div class="grandTotal">Grand Total <small style="color: red;margin-right: 60px;margin-top: 8px;font-size: 9px;">2 % GST</small>
					<strong>₹{{(2/100 * $cartP) + $cartP}}</strong>
				</div>
			</div>
			<div>
				<a href="{{url('checkout')}}" class="btn btn-primary mt-3 w-100">Place Order</a>
			</div>
		<a href="#" class="no-decoration">Continue Shopping</a>
		</div>
	</div>
</div>
</div>
@endsection
