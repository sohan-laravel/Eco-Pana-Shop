@extends('backend.layouts.app')

@section('title')
    SubCategory Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">SubCategory Edit</h3>

            <div class="container">
                <a href="{{ route('admin.subcategory.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="image">Category Name</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
        
                        <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : ''  }}>{{ $category->category_name }}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                <label for="image">Category Name</label>
                <input type="text" class="form-control" name="subcat" value="{{ $subcategory->subcat }}" placeholder="Enter SubCategory Name">
                </div>

                <div class="form-group">
					<label for="image">SubCategory Image</label> <br>
				
					<img src="{{  asset('frontend/images/SubCategoryImage/' .$subcategory->image) }}" width="200" class="img-fluid mt-2" alt="{{ $subcategory->subcat }}" >
									
					<label class="col-md-12 col-from-label mt-5">Category New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="image">
					</div>
				</div>

                {{-- <div class="form-group">
					<label for="image">Category Hover Image</label> <br>
				
					<img src="{{  asset('frontend/images/CategoryImage/' .$category->photo) }}" width="200" class="img-fluid mt-2" alt="{{ $category->category_name }}" >
									
					<label class="col-md-12 col-from-label mt-5">Category Hover New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="photo">
					</div>
				</div> --}}

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Update</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')

@endsection