@extends('layout.home')
@section('content')
    <div class="container mt-3">
        @if(Session::get('user'))
            <div class="">
                <div class="d-flex myA p-3" style="align-items: center;">
                    <i class="fa fa-id-card text-danger m-2"></i>
                    <span class="m-2">{{$user->user_name}}</span>
                    <div class="d-flex position-absolute end-0" style="margin-right: 12vw;">
                        <i class="fa fa-envelope text-danger m-2"></i>
                        <span class="m-2">{{$user->email}}</span>
                        <i class="fa fa-phone text-danger m-2"></i>
                        <span class="m-2">{{$user->mobile_no}}</span>
                    </div>
                </div>
            </div>
            <!-- Nav tabs -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="mt-4">
                        <div class="myPro">
                            <ul class="nav nav-pills flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link c" data-bs-toggle="tab" href="#myProfile" id="Profile"><i class="fa fa-address-card" aria-hidden="true"></i> My Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link c" data-bs-toggle="tab" href="#myOrder" id="order"><i class="fa fa-gift" aria-hidden="true"></i> My Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link c" data-bs-toggle="tab" href="#myWallet" id='wallet'><i class="fa fa-money" aria-hidden="true"></i> My Wallet</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link c" data-bs-toggle="tab" href="#addressBook" id="address"><i class="fa fa-map-marker" aria-hidden="true"></i> Address Book</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Tab panes -->
                    <div class="tab-content ">
                        <div id="myProfile" class="container tab-pane"><br>
                            <div class="myPro">
                                <div class="pb-4">
                                    <span class="text-lg font-bold text-left" style="font-size: 17px;">Profile Details</span>
                                </div>
                                <div class="" style="margin-left:5vw;">
                                    <form  method="post" id="editUser" action="{{url('saveUser')}}?id={{$user->id}}">
                                        @csrf
                                        <div class=" d-flex mb-3">
                                            <label for="user_name" class="form-label w-25">Name:</label>
                                            <input type="text" class="form-control w-50" id="user_name" name="user_name" value="{{$user->user_name}}" disabled>
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="gender" class="form-label w-25">Gender:</label>
                                            <input type="radio" class="form-check-input m-2" id="gender" name="gender" value="f" {{ ($user->gender=="f")? "checked" : "" }} disabled>Female
                                            <input type="radio" class="form-check-input m-2" id="gender" name="gender" value="m" {{ ($user->gender=="m")? "checked" : "" }} disabled>Male
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="bday" class="form-label w-25">Birthday:</label>
                                            <input type="text" class="form-control w-50 datepicker" id="bday" name="bday" value="{{$user->bday}}" disabled>
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="mobile_no" class="form-label w-25">Mobile:</label>
                                            <input type="tel" class="form-control w-50" id="mobile_no" name="mobile_no" value="{{$user->mobile_no}}" disabled>
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="email" class="form-label w-25">Email:</label>
                                            <input type="email" class="form-control w-50" id="email" name="email" value="{{$user->email}}" readonly>
                                        </div>
                                        <div>
                                            <button type="reset" class="btn btn-danger" id="edit">Edit</button>
                                        </div>
                                        <div class="" style="text-align: right;">
                                            <button type="button" class="btn btn-success" id="submit" onclick="submitForm('editUser','post')" hidden>Submit</button>
                                        </div>
                                    </form>
                                    <span>(*) Email is not changeable. Click Support for more details</span>
                                </div>
                            </div>
                        </div>
                        <div id="myOrder" class="container tab-pane fade"><br>
                            <div class="myPro" style="height:250px;">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li>
                                        <a class="nav-link active" data-bs-toggle="tab" href="#recent">Recent Orders</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#past">Past Orders</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="recent" class="container tab-pane active"><br>
                                        <div>
                                            <span>Recent Oders</span>
                                        </div>
                                    </div>
                                    <div id="past" class="container tab-pane fade"><br>
                                        <div>
                                            <span>Past Oders</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="myWallet" class="container tab-pane fade"><br>
                            <div class="myPro" style="height:250px;">
                                <h4>My Wallet</h4>
                                <div>
                                    <div>
                                        <span>Aj Cake-shop Credits</span><br>
                                        <span>Current Balance:</span><span>0 Cash | 0 Rewards</span>
                                        <span>₹ 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="addressBook" class="container tab-pane fade"><br>
                            <div class="myPro">
                                @if(!empty($address))
                                    <h5 class="h5">Saved Addresses {{count($address)}}</h5>
                                    <div id="addList">
                                        @foreach($address as $add)
                                        <div class="cartList">
                                            <ul class="cartListing">
                                                <li class="opacity-50">{{ $add['addtype'] }}</li>
                                                <li><strong>{{ $add['reciever_name']}}</strong></li>
                                                <li>{{ $add['delivery_address'] }} {{ $add['delivery_city'] }} {{ $add['pinCode'] }}</li>
                                                <li><strong>{{ $add['shipping_number'] }}</strong></li>
                                            </ul>
                                            <div class="" style="width: 40%;text-align: right;margin-right: 2rem;">
                                                <a href="{{url('address_edit')}}/{{ $add['id']}}?tab=editAddress">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a data-url="address_delete/{{ $add['id']}}" class="delete-data">
                                                    <i class="fa fa-trash editAdd" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center" style="margin-top:5rem" id="addTab1">
                                        <p>Your Shipping information address book is currently empty.</p>
                                    </div>
                                @endif
                                <div class="text-center" style="margin-top:3rem;margin-bottom:3rem;" id="addTab1">
                                    <span class="btn btn-success" id="addAddress">Add Address</span>
                                </div>
                                <div class="" style="margin-left:5vw;" id="addTab2" hidden>
                                    <h5 class="text-danger mb-4">New Address</h5>
                                    <form  method="post" id="saveAdd" action="{{url('saveAddress') . (!empty($edit['id']) ? '/' . $edit['id'] : '') }}">
                                        @csrf
                                        <input type="hidden" name="address_id" value="{{ $edit['id'] ?? '' }}">
                                        <div class=" d-flex mb-3">
                                            <label for="reciever_name" class="form-label w-25">Reciever Name<span class="text-danger">*</span></label>
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="text" class="form-control w-50" id="reciever_name" name="reciever_name" value="{{ $edit['reciever_name'] ?? '' }}">
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="delivery_city" class="form-label w-25">Delivery City<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-50" id="delivery_city" name="delivery_city" value="{{ $edit['delivery_city'] ?? '' }}" >
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="pinCode" class="form-label w-25">PinCode<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-50" id="pinCode" name="pinCode" value="{{ $edit['pinCode'] ?? '' }}">
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="delivery_address" class="form-label w-25">Delivery Address<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-50" id="delivery_address" name="delivery_address" value="{{ $edit['delivery_address'] ?? '' }}">
                                        </div>
                                        <div class=" d-flex mb-3">
                                            <label for="shipping_number" class="form-label w-25">Shipping Phone No<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control w-50" id="shipping_number" name="shipping_number" value="{{ $edit['shipping_number'] ?? '' }}">
                                        </div>
                                        <div class=" d-flex mb-3">
                                            @if(isset($edit))
                                            <label for="addtype" class="form-label w-25">Address Type<span class="text-danger">*</span></label>
                                           
                                            <input type="radio" class="form-check-input m-2" id="home" name="addtype" value="home" {{ $edit['addtype'] == 'home'?'checked="checked"':''}}>Home
                                            <input type="radio" class="form-check-input m-2" id="office" name="addtype" value="office"  {{ $edit['addtype']=='office'? 'checked="checked"':"no"}}>Office
                                            <input type="radio" class="form-check-input m-2" id="other" name="addtype" value="other" {{ $edit['addtype']=='other'? 'checked="checked"':"no"}}>Other
                                            @else
                                             <label for="addtype" class="form-label w-25">Address Type<span class="text-danger">*</span></label>
                                           
                                            <input type="radio" class="form-check-input m-2" id="home" name="addtype" value="home" >Home
                                            <input type="radio" class="form-check-input m-2" id="office" name="addtype" value="office">Office
                                            <input type="radio" class="form-check-input m-2" id="other" name="addtype" value="other">Other
                                            @endif
                                        </div>
                                        <div>
                                            @if(!empty($edit['id']))
                                            <button type="button" class="btn btn-danger opacity-75" id="updateAdd" onclick="submitForm('saveAdd','post')" >Update Address</button>
                                            @else
                                            <button type="button" class="btn btn-danger opacity-75" id="newAdd" onclick="submitForm('saveAdd','post')" >save Address</button>
                                            @endif
                                        </div>
                                        <div class="" style="text-align: right;">
                                            <span class="text-danger tect-rigth text-decoration-underline pe-auto btn" id="seeAll">See All Saved Address</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div>
                <div class="" style="margin:10em 0">
                    <img src="{{url('public/img/not found.png')}}" width="350px">
                    <span class="card-heading" style="margin-left:5vw">Please <a class="text-danger" href="{{url('login')}}">Login</a> to Acces Your Account</span>
                </div>
            </div>
        @endif
    </div>
@endsection
<script>
    window.addEventListener('load', function() {
        $('#addAddress').click(function(){
            $('#addTab2').removeAttr('hidden');
            $('#addTab1').toggle();
            $('#addList').hide();
            $('.h5').hide();
            $('#addTab2').show();
            $(this).hide();
        });

        $('#seeAll').click(function(){
            $('#addTab1').show();
            $('.cartList').show();
            $('#addList').show();
            $('.h5').show();
            $('#addTab2').hide();
        });
        $url ='<?php echo $_GET['tab']; ?>';

        $('#updateAdd').click(function(){
            $('#addTab1').show();
            $('.cartList').show();
            $('#addList').show();
            $('.h5').show();
            $('#addTab2').hide();
            setTimeout(function(){
                    window.location ='../myAccount?tab=address';
                },1500);
             
        });

        var numList = $('.cartList').length
        if (numList>1){
            $('#addList').css({'height':'320px','overflow':'auto'});
        } else {
            $('#addList').removeAttr('style');
        }

        //for account form
        $('#edit').click(function(){
            $('#edit').hide();
            $('.form-control').removeAttr("disabled");
            $('.form-check-input').removeAttr("disabled");
            $('#submit').removeAttr("hidden");
        });

        console.log($url);

        if ($url == 'wallet') {
            var el = document.getElementById('wallet');
            el.classList.add("active");
            var el1 = document.getElementById('myWallet');
            el1.classList.add("active");
            el1.classList.add("show");
        } else if ($url == 'order') {
            var el = document.getElementById('order');
            el.classList.add("active");
            var el1 = document.getElementById('myOrder');
            el1.classList.add("active");
            el1.classList.add("show");
        } else if ($url == 'Profile') {
            var el = document.getElementById('Profile');
            el.classList.add("active");
            var el1 = document.getElementById('myProfile');
            el1.classList.add("active");
            el1.classList.add("show");
        } else if ($url == 'address') {
            var el = document.getElementById('address');
            el.classList.add("active");
            var el1 = document.getElementById('addressBook');
            el1.classList.add("active");
            el1.classList.add("show");
        } else if ($url == 'editAddress') {
            var el = document.getElementById('address');
            el.classList.add("active");
            var el1 = document.getElementById('addressBook');
            el1.classList.add("active");
            el1.classList.add("show");
            $('#addTab2').removeAttr('hidden');
            $('#addTab1').toggle();
            $('#addList').hide();
            $('.h5').hide();
            $('#addTab2').show();
        }
    });
</script>
