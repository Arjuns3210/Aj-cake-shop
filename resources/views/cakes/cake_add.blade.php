@extends('layout.home')
@section('content')

<div class="container-fluid">
    <div class="row" style="margin: auto;width: 500px;">
        <div class="cakeAdd" style="margin: 40px;width: 400px;">
        @if(session('status'))
        <div class="alert alert-primary">
            {{session('status')}}
        </div>
        @endif
            <form action="saveCake"  id="saveCakes" enctype="multipart/form-data" method="Post">
                @csrf
                <div class="mb-3">
                    <label for="cake_name" class="form-label">Cake Name</label>
                    <input type="text" name="cake_name" class="form-control required" id="cake_name" >
                </div>
                <div class="mb-3">
                    <label for="cake_price" class="form-label">Cake Price</label>
                    <input type="text" name="cake_price" class="form-control required" id="cake_price" >
                </div>
                <div class="mb-3">
                    <label for="cake_description" class="form-label">Description</label>
                    <input type="text" name="cake_description" class="form-control" id="cake_description">
                </div>
                <div class="mb-3">
                    <label for="cake_details" class="form-label">Cake Details</label>
                    <input type="text" name="cake_details" class="form-control" id="cake_details">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control required" name="category_id" id="category_id">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="img_name" class="form-label">Cake image</label>
                    <input type="file" name="img_name[]" class="form-control required" id="img_name" multiple="multiple">
                    @error('img_path')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <!-- <button type="submit" class="btn btn-success pull-center">Submit</button><br> -->
                <button type="button" onclick="submitForm('saveCakes','post')" class="btn btn-success pull-center">Submit</button><br>
            </form>
            <h6 style="text-align: center;margin-top: 26px;margin-left: 8em;">New category <a href="#createCategory" data-bs-toggle="modal" data-bs-target="#myModal"><span>Create</span></a></h6>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Category</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="saveCategory" method="Post" enctype="multipart/form-data" style="padding: 0px 46px;" id="saveCategory">
                @csrf
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control required" id="category_name" >
                </div>
                <div class="mb-3">
                    <label for="category_description" class="form-label">Category Description</label>
                    <input type="test" name="category_description" class="form-control required" id="category_description" >
                </div>
                <div class="mb-3">
                    <label for="image_path" class="form-label">Category Image</label>
                    <input type="file" name="image_path" class="form-control required" id="image_path" required>
                </div>
                <button type="button" onclick="submitForm('saveCategory','post')" class="btn btn-primary">Submit</button>
                <!-- <button type="button" onclick="submitForm('saveCategory','post')" class="btn btn-success pull-center">Submit</button><br> -->
                
            </form>
      </div>
    </div>
  </div>
</div>
@endsection