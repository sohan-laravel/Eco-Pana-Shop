@extends('backend.layouts.app')

@section('title')
    Slider Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">Slider Edit</h3>

            <div class="container">
                <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                <label for="image">Slider Name</label>
                <input type="text" class="form-control" name="name" value="{{ $slider->name }}" placeholder="Enter Slider Name">
                </div>

                <div class="form-group">
					<label for="image">Slider Image</label> <br>
				
					<img src="{{  asset('frontend/images/SliderImage/' .$slider->image) }}" width="200" class="img-fluid mt-2" alt="{{ $slider->name }}" >
									
					<label class="col-md-12 col-from-label mt-5">Slider New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="image">
					</div>
				</div>

                <div class="form-group">
					<label for="image">Slider Old Video</label> <br>
				
					<a href="{{  asset('frontend/video/SliderVideo/' .$slider->video) }}" target="_blank">View</a>
									
					<label class="col-md-12 col-from-label mt-5">Slider New Video<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="video">
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