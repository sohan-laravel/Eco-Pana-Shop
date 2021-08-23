@extends('backend.layouts.app')

@section('title')
    SubCategory Create
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">SubCategory Add</h3>

            <div class="container">
                <a href="{{ route('admin.subcategory.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.subcategory.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                <label for="image">Category Name</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Select Catgeory Name</option>
                    @foreach ($categories as $category)
    
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                    @endforeach

                </select>

                </div>

                <div class="form-group">
                <label for="image">SubCategory Name</label>
                <input type="text" class="form-control" name="subcat" placeholder="Enter Category Name">

                </div>

                <div class="form-group">
                <label for="image">Category Image</label>
                <input type="file" class="form-control" name="image">
                </div>

                {{-- <div class="form-group">
                <label for="photo">Category Hover Image</label>
                <input type="file" class="form-control" name="photo">
                </div> --}}

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Submit</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')

@endsection