@extends('backend.layouts.app')

@section('title')
    Journal Create
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">Journal Add</h3>

            <div class="container">
                <a href="{{ route('admin.journal.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.journal.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                <label for="image">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                <label for="image">Image Link</label>
                <input type="text" class="form-control" name="link" placeholder="Enter Image Link Like https://....">
                </div>

                <div class="form-group">
                <label for="image">Journal Image</label>
                <input type="file" class="form-control" name="image">
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Submit</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')

@endsection