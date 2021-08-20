@extends('backend.layouts.app')

@section('title')
    About Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">About Us Edit</h3>

            <div class="container">
                <a href="{{ route('admin.slider.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.about.update', $about->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                <label for="image">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $about->name }}" placeholder="Enter Name">
                </div>

                <div class="form-group">
					<label for="image">About Us Image</label> <br>
				
					<img src="{{  asset('frontend/images/AboutImage/' .$about->image) }}" width="200" class="img-fluid mt-2" alt="{{ $about->name }}" >
									
					<label class="col-md-12 col-from-label mt-5">About Us New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="image">
					</div>
				</div>

                <div class="form-group">
                <label for="photo">Description</label>
                <textarea name="description" id="mytextarea" cols="30" rows="10">{{ $about->description }}</textarea>
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