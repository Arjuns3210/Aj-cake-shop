@extends('layout.home')
@section('content')
<div class="container mt-4" style="max-width: 960px;">
  <main>
    
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        @if(isset($cart_items))
          <ul class="list-group mb-3 mt-4">
            @foreach($cart_items as $key=>$cart)
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">{{$cart->cake_name}}</h6>
                  <small class="text-muted">Brief description</small>
                </div>
                <span class="text-muted">₹{{$cart->cake_price}}</span>
              </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>WELCOME</small>
              </div>
              <span class="text-success">-₹10</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (INR)</span>
              <strong>₹{{$cartP-10}}</strong>
            </li>
          </ul>
        @endif
        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control " placeholder="Promo code" disabled>
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form>
      </div>

      <div class="col-md-7 col-lg-8"> 
        <div id="accordion">
          <div class="card checkout">
            <div class="card-header one" style="background-color:#b3eeff">
              <div class="d-flex W-75">
                <span class="btn border">1</span>
                <div> 
                  <strong class="head"> Login</strong><br>
                  <strong class="uper" hidden> {{$user->user_name}}</strong>
                  <label class="uper" hidden> {{$user->mobile_no}} </label>
                </div>
              </div>
                <a class="btn btn-outline-danger pull-right" data-bs-toggle="collapse" href="#collapseOne" hidden id="changeLogin" style="margin-top: -35px;">Change</a>
            </div>
            <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
              <div class="card-body">
                @if(empty($address))
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
                            <i class="far fa-eye-slash" id="pass" style="cursor: pointer"></i>
                          </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                @else
                  <div class="d-flex justify-content-between">
                    <div style="width:250px">
                      <label>Name  : <strong>{{$user->user_name}}</strong></label><br>
                      <label>Phone : <strong>{{$user->mobile_no}}</strong></label>
                      <a class="collapsed btn btn-danger mt-4" data-bs-toggle="collapse" href="#collapseTwo" id="bLogin" style="width:250px">Continue</a>
                    </div>
                    <div>
                      <label class="opacity-50">Advantages of our secure login</label><br>
                      <label><i class="fa fa-truck" aria-hidden="true"></i> Easily Track Orders, Hassle free Returns</label><br>
                      <label><i class="fa fa-bell" aria-hidden="true"></i> Get Relevant Alerts and Recommendation</label><br>
                      <label><i class="fa fa-star" aria-hidden="true"></i> Wishlist, Reviews, Ratings and more.</label>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
          <div class="card checkout">
            <div class="card-header two">
              <div class="d-flex W-75">
                <span class="btn border">2</span>
                <div>
                  <strong class="head1">Delivery Address</strong><br>
                  <label id="fullAdd"></label>
                </div>
              </div>
              <a class="collapsed pull-right btn btn-outline-danger" data-bs-toggle="collapse" href="#collapseTwo" hidden id="changeAdd" style="margin-top: -35px;">
              Change
            </a>
            </div>
            <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
              <div class="card-body">
                @if(isset($address))
                  <div id="addList">
                    @foreach($address as $add)
                      <div class="cartList">
                          <ul class="cartListing">
                            <li class="opacity-50">{{ $add['addtype'] }}</li>
                            <li><strong id="nameAdd{{ $add['id'] }}">{{ $add['reciever_name']}}</strong></li>
                            <li id="halfAdd{{ $add['id'] }}">{{ $add['delivery_address'] }} {{ $add['delivery_city'] }} {{ $add['pinCode'] }}</li>
                            <li><strong>{{ $add['shipping_number'] }}</strong></li>
                          </ul>
                          <div class="" style="width: 40%;text-align: right;margin-right: 2rem;">
                            <a href="{{url('address_edit')}}/{{ $add['id']}}?tab=editAddress">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                            </a><br>
                            <a class="collapsed btn btn-success mt-4" data-bs-toggle="collapse" href="#collapseThree" id="bAdd{{ $add['id'] }}" onclick="delivery({{ $add['id'] }})">Delivery Here</a>
                          </div>
                      </div>
                    @endforeach
                  </div>
                @endif
                
              </div>
            </div>
          </div>
          <div class="card checkout">
            <div class="card-header three">
              <span class="btn border">3</span>
              <strong class="head2">Order Summery</strong>
              <label id="orderSum" >{{count($cart_items)}} Item</label>
              <a class="collapsed pull-right btn btn-outline-danger" data-bs-toggle="collapse" href="#collapseThree" hidden id="changeOrder">
              Change
              </a>
            </div>
            <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
              <div class="card-body">
                @if(isset($cart_items))
                  @foreach($cart_items as $key=>$cart)
                    <div class="cartList">
                      <div>
                        <img src="{{ url('public/img/'.$cart->img_name) }}" class="cartImg">
                      </div>
                      <div>
                        <ul class="cartListing">
                          <li>
                            <a href="{{url('buy/'.$cart->cake_url)}}" class="no-decoration">{{$cart->cake_name}}</a>
                          </li>
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
                @endif
                <a class="collapsed btn btn-danger" data-bs-toggle="collapse" href="#collapseFour" id="bOrder">Continue</a>
              </div>
            </div>
          </div>
          <div class="card checkout">
            <div class="card-header four">
              <span class="btn border">4</span>
              <strong class="head3">Payment Option</strong>
              <a class="collapsed pull-right btn btn-outline-danger" data-bs-toggle="collapse" href="#collapseFour" hidden id="changePayment">
              Change
              </a>
            </div>
            <div id="collapseFour" class="collapse" data-bs-parent="#accordion">
              <div class="card-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                <button class="w-100 btn btn-primary mt-2" type="submit">Continue to checkout</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
<script>
window.addEventListener('load',function() {

  $('#bLogin').click(function(){
    $('.uper').removeAttr('hidden');
    $('#changeLogin').removeAttr('hidden');
    $('.card-header').removeAttr('style');
    $('.two').css({'backgroundColor':'#b3eeff'})
    $('.head').css({'opacity':'0.5'})
  })
  $('#changeLogin').click(function(){
    $(this).prop('hidden',true);
    $('.uper').prop('hidden',true);
    $('.card-header').css({'backgroundColor':''})
    $(this).parent().css({'backgroundColor':'#b3eeff'})
    $('.head').css({'opacity':''})
  })
  // $('#bAdd1').click(function(){
  //   $('#changeAdd').removeAttr('hidden');
  //   $('.card-header').removeAttr('style');
  //   $('.three').css({'backgroundColor':'#b3eeff'})
  //   $('.head1').css({'opacity':'0.5'})

  // })
  // $('#bAdd2').click(function(){
  //   $('#changeAdd').removeAttr('hidden');
  //   $('.card-header').removeAttr('style');
  //   $('.three').css({'backgroundColor':'#b3eeff'})
  //   $('.head1').css({'opacity':'0.5'})

  // })
  // $('#bAdd3').click(function(){
  //   $('#changeAdd').removeAttr('hidden');
  //   $('.card-header').removeAttr('style');
  //   $('.three').css({'backgroundColor':'#b3eeff'})
  //   $('.head1').css({'opacity':'0.5'})

  // })
  $('#changeAdd').click(function(){
    $(this).prop('hidden',true);
    $('.card-header').css({'backgroundColor':''})
    $(this).parent().css({'backgroundColor':'#b3eeff'})
    $('.head1').css({'opacity':''})

  })
  $('#bOrder').click(function(){
    $('#changeOrder').removeAttr('hidden');
    $('.card-header').removeAttr('style');
    $('.four').css({'backgroundColor':'#b3eeff'})
  })
  $('#changeOrder').click(function(){
    $(this).prop('hidden',true);
    $('.card-header').css({'backgroundColor':''})
    $(this).parent().css({'backgroundColor':'#b3eeff'})

  })
});
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

function delivery(id){
  var half=document.getElementById('halfAdd'+id).innerHTML;
  var name=document.getElementById('nameAdd'+id).innerHTML;
  document.getElementById('fullAdd').innerHTML='<strong>'+name+'</strong>' +" "+half;

  $('#changeAdd').removeAttr('hidden');
  $('.card-header').removeAttr('style');
  $('.three').css({'backgroundColor':'#b3eeff'})
  $('.head1').css({'opacity':'0.5'})
  
}
</script>
