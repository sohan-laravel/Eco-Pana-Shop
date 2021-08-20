@extends('backend.layouts.app')

@section('title')
    Make Story Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">Make Story Edit</h3>

            <div class="container">
                <a href="{{ route('admin.story.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.story.update', $story->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
					<label for="image">Make Story Image</label> <br>
				
					<img src="{{  asset('frontend/images/StoryImage/' .$story->image) }}" width="200" class="img-fluid mt-2" alt="" >
									
					<label class="col-md-12 col-from-label mt-5">Make Story New Image<span class="text-danger">*</span></label>
					<div class="col-md-12">
						<input type="file" class="form-control" name="image">
					</div>
				</div>

                <div class="form-group">
                <label for="photo">Description</label>
                <textarea name="description" id="mytextarea" cols="30" rows="10">{{ $story->description }}</textarea>
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