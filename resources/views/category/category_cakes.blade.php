@extends('layout.home')
@section('content')
<div>
     @if(!empty($category) > 0)
    <h4>
        <a href="{{url('/')}}"><i class="fa fa-arrow-left" style="font-size: 30px;color: red;margin: 0 35px"></i></a>
        Order {{$category->category_name}} Cake

            <div class="btn-group use-choosen">
                <select class="form-select" aria-label="Default select example" name='sortingBy' id="sortingBy">
                  <option disabled selected value="Popularity">Sort BY</option>
                  <option  value="Popularity" disabled>Popularity</option>
                  <option value="priceAsc">Price -- Low to High</option>
                  <option value="priceDesc">Price -- High to Low</option>
                  <option value="new">Newest First</option>
                </select>
            </div>
            <input type="hidden" name="catId" value="{{$category->id}}" id="catId">

        <a href="{{url()->previous()}}" class="pull-right"><i class="fa fa-arrow-right " style="font-size: 30px;color: red;margin: 0 35px"></i>
        </a>
    </h4>
    @endif
</div>
<div class="card-details">
    @if(!empty($category) > 0)
    <div class="card-heading">{{$category->category_description}}</div>
        <div class="card-description" id="cakedata">
            @if(count($cakes) > 0)
                @foreach($cakes as $cake)
                    <a href="{{url('buy/'.$cake->cake_url)}}" class="no-decoration">
                    <div class="card3">
                       <div id="{{'cake'.$cake->id}}" class="carousel slide" data-bs-ride="carousel">
                        @php
                            $image_path = json_decode($cake->img_name, true);
                            $class = 'active';
                        @endphp
                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                         @foreach($image_path as $key=>$pics)

                        <button type="button" data-bs-target="#{{'cake'.$cake->id}}" data-bs-slide-to={{$key}} class="{{$class}}" style="background-color:red;border-radius: 50%;height: 15px;width: 15px;"></button>
                        @php $class = ''; @endphp

                        @endforeach
            
                    </div>
                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        
                        @if(is_array($image_path))
                           
                         <?php $i = 0; do { ?>
                             <div class="carousel-item {{ ($i == 0) ? 'active' : '' }}">
                                <img class="card-img-top" src="{{ url('public/images/'.$image_path[$i]) }}" alt="Card image" style="width:100%">
                            </div>
                        <?php $i++; } while ($i<count($image_path)); ?>
                        @endif
                        
                    </div>
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#{{'cake'.$cake->id}}" data-bs-slide="prev">
                        <i class="fa fa-arrow-left" style="font-size: 30px;color: red;"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#{{'cake'.$cake->id}}" data-bs-slide="next">
                        <i class="fa fa-arrow-right" style="font-size: 30px;color: red;"></i>
                    </button>
                </div>
                        <!-- <img class="card-img-top" src="{{'../storage/app/'.$cake->img_path}}" alt="Card image" style="width:100%"> -->
                        <div class="card-body">
                            <h5 class="mt-2 text-left">{{$cake->cake_name}}</h5>
                            <p class="card-text"><i class="fas fa-rupee-sign"></i>{{$cake->cake_price}}</p>
                            <!-- <p class="card-text">{{$cake->cake_description}}</p> -->
                        </div>
                    </div></a>
                @endforeach
            @else
                <div class="card-heading">No {{$category->category_name}} cake found</div>
            @endif
           <!--  <div class="card2">
                <img class="card-img-top" src="{{ url('public/img/chocolate.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Chocolate</h4>
                    <p class="card-text">For choco addicts</p>
                </div>
            </div>
            <div class="card2">
                <img class="card-img-top" src="{{ url('public/img/chocolate.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"  >Chocolate</h4>
                    <p class="card-text">For choco addicts</p>
                </div>
            </div>
            <div class="card2">
                <img class="card-img-top" src="{{ url('public/img/chocolate.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Chocolate</h4>
                    <p class="card-text">For choco addicts</p>
                </div>
            </div> -->
        </div>
        @else
            <h5 class="text-danger mt-2">Showing results for- {{$sData}} ({{count($cakes)}} Cakes)</h5>
        <div class="card-description" id="cakedata">
            @if(count($cakes) > 0)
                @foreach($cakes as $cake)
                    <a href="{{url('buy/'.$cake->cake_url)}}" class="no-decoration">
                    <div class="card3">
                       <div id="{{'cake'.$cake->id}}" class="carousel slide" data-bs-ride="carousel">
                        @php
                            $image_path = json_decode($cake->img_name, true);
                            $class = 'active';
                        @endphp
                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                         @foreach($image_path as $key=>$pics)

                        <button type="button" data-bs-target="#{{'cake'.$cake->id}}" data-bs-slide-to={{$key}} class="{{$class}}" style="background-color:red;border-radius: 50%;height: 15px;width: 15px;"></button>
                        @php $class = ''; @endphp

                        @endforeach
            
                    </div>
                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        
                        @if(is_array($image_path))
                           
                         <?php $i = 0; do { ?>
                             <div class="carousel-item {{ ($i == 0) ? 'active' : '' }}">
                                <img class="card-img-top" src="{{ url('public/images/'.$image_path[$i]) }}" alt="Card image" style="width:100%">
                            </div>
                        <?php $i++; } while ($i<count($image_path)); ?>
                        @endif
                        
                    </div>
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#{{'cake'.$cake->id}}" data-bs-slide="prev">
                        <i class="fa fa-arrow-left" style="font-size: 30px;color: red;"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#{{'cake'.$cake->id}}" data-bs-slide="next">
                        <i class="fa fa-arrow-right" style="font-size: 30px;color: red;"></i>
                    </button>
                </div>
            
                <div class="card-body">
                    <h5 class="mt-2 text-left">{{$cake->cake_name}}</h5>
                    <p class="card-text"><i class="fas fa-rupee-sign"></i>{{$cake->cake_price}}</p>
                </div>
            </div></a>
                @endforeach
            @else
            <div class="" style="padding:5vw">
            <img src="{{url('public/img/not found.png')}}" width="350px">
                
            </div>
            <div class="card-heading">Sorry, we couldn't find what you are looking for</div>
            @endif
           <!--  <div class="card2">
                <img class="card-img-top" src="{{ url('public/img/chocolate.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Chocolate</h4>
                    <p class="card-text">For choco addicts</p>
                </div>
            </div>
            <div class="card2">
                <img class="card-img-top" src="{{ url('public/img/chocolate.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"  >Chocolate</h4>
                    <p class="card-text">For choco addicts</p>
                </div>
            </div>
            <div class="card2">
                <img class="card-img-top" src="{{ url('public/img/chocolate.png') }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Chocolate</h4>
                    <p class="card-text">For choco addicts</p>
                </div>
            </div> -->
        </div>
        @endif
    </div>

    </div>
</div>
@endsection
