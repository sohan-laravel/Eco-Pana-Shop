@extends('backend.layouts.app')

@section('title')
    product Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">product Edit</h3>

            <div class="container">
                <a href="{{ route('admin.product.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" placeholder="Enter Name">
                </div>

                {{-- <div class="form-group">
					<label for="image">product Us Image</label> <br>
				
					<img src="{{  asset('frontend/images/productImage/' .$product->image) }}" width="200" class="img-fluid mt-2" alt="{{ $product->name }}" >
									
					<label class="col-md-12 col-from-label mt-5">product Us New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="image">
					</div>
				</div> --}}

                <div class="form-group">
                    <label for="image">Product Category Name</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
        
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : ''  }}>{{ $category->category_name }}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="text" class="form-control" name="price" value="{{ $product->price }}" placeholder="Enter Product Price">
                </div>

                <div class="form-group">
                    <label for="photo">Description</label>
                    <textarea name="description" id="mytextarea" cols="30" rows="10">{{ $product->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image_one">Main Thumbnail Old Image</label><br>

                    <img src="{{  asset('frontend/images/productImage/' .$product->image_one) }}" width="50" class="img-fluid mt-2" alt="{{ $product->product_name }}" >

                    <label class="col-md-12 col-from-label mt-5">Main Thumbnail New Image</label>

                    <input type="file" class="form-control" name="image_one">
                </div>

                <div class="form-group">
                    <label for="image_two">Old Image Two</label><br>

                    <img src="{{  asset('frontend/images/productImage/' .$product->image_two) }}" width="50" class="img-fluid mt-2" alt="{{ $product->product_name }}" >

                    <label class="col-md-12 col-from-label mt-5">New Image Two</label>

                    <input type="file" class="form-control" name="image_two">
                </div>

                <div class="form-group">
                    <label for="image_three">Old Image Three</label><br>

                    <img src="{{  asset('frontend/images/productImage/' .$product->image_three) }}" width="50" class="img-fluid mt-2" alt="{{ $product->product_name }}" >

                    <label class="col-md-12 col-from-label mt-5">New Image Three</label>

                    <input type="file" class="form-control" name="image_three">
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Update</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')

{{-- tinymce editor --}}

    <script src="https://cdn.tiny.cloud/1/bm9h9r85nvmh9qbraq9wm4ttz6k1bngsfcs3txiq3ud8x0sk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    tinymce.init({
      selector: '#mytextarea',
   });
  </script>

@endsection