@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'product'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4>Edit Product</h4>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body ">
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    {!! @csrf_field() !!}
                        @method('PUT')
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Name
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{$product->product_name}}">
                                @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Category
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <select name="product_category" class="form-control">
    @foreach($categories as $category)
        <option value="{{ $category->category_id }}" @if($category->category_id == $product->product_category) selected @endif>{{ $category->category_name }}</option>
    @endforeach
</select>
                                @error('product_category')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Code
                            
                            </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="product_code" placeholder="Enter Product Code" value="{{$product->product_code}}" >
                                
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Selling Price
                            <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_sellingprice" placeholder="Enter Product Selling Price (RM)" value="{{$product->product_sellingprice}}" >
                                @error('product_sellingprice')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Supplier Price
                            
                            </label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="product_supplierprice" placeholder="Enter Product Supplier Price (RM)" value="{{$product->product_supplierprice}}">
                                
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 1
                            
                            </label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img1" placeholder="Product Image 1" value="{{$product->product_img1}}">
    
                                <br>
                                <img src="{{$product->product_img1}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 2</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img2" placeholder="Product Image 2" value="{{$product->product_img2}}">
                                <br>
                                <img src="{{$product->product_img2}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Image 3</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="photo" name="product_img3" placeholder="Product Image 3" value="{{$product->product_img3}}">
                                <br>
                                <img src="{{$product->product_img3}}"  class="img img-responsive"></img>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Product Details
                            
                            </label>
                            <div class="col-md-10">
                            <textarea cols="100" rows="10" placeholder="Enter Product Details" name="product_details">{{$product->product_details}}</textarea>
                            </div>
                            
                        </div>  
                            <br>
                            <button class="btn btn-primary btn-lg btn-block">Edit Product</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection