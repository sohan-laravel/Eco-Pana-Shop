@extends('backend.layouts.app')

@section('title')
    Accessories Right Side Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">Accessories Right Side Edit</h3>

            <div class="container">
                <a href="{{ route('admin.accessright.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.accessright.update', $accessright->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="image">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $accessright->name }}" placeholder="Enter Name">
                </div>

                <div class="form-group">
					<label for="image">Accessories Right Side Image</label> <br>
				
					<img src="{{  asset('frontend/images/AccessoriesRightImage/' .$accessright->image) }}" width="200" class="img-fluid mt-2" alt="{{ $accessright->name }}" >
									
					<label class="col-md-12 col-from-label mt-5">Accessories Right Side New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="image">
					</div>
				</div>

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Update</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')
@endsection