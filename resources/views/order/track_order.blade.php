@extends('layout.home')
@section('content')

<div class="conteiner-fluid">
<div class="orderMain">
    <div class="orderTrack">
        <div class="row m-auto">
            <div class=" col-sm-4">
                <img src="{{url('public/img/trackorder.png')}}"  class="img-fluid">
            </div>
            <div class=" col-sm-8 trorder">
                <div class="trorder-heading">Track Order</div>
                <div id="webForm" class="form-row">
                    <div class="col-md-4 ">
                        <label id="Oid">Order Id*</label>
                        <input type="text" name="orderId" class="form-control ">
                    </div>
                    <div class=" col-md-4">
                        <label id="emailN">Email/Phone Number*</label>
                        <input type="text" name="email" class="form-control " >
                        <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>
                    </div>
                </div>
                <div class="btn btn-primary mt-3 w-50" style="margin-left: 20px;">Track Order</div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>