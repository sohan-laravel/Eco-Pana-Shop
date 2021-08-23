@extends('backend.layouts.app')

@section('title')
    Menu Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">Menu Edit</h3>

            <div class="container">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="image">Name</label>
                    <input type="text" class="form-control" name="journal_name" value="{{ $menu->journal_name }}" placeholder="Enter Journal Name">
                </div>
                <div class="form-group">
                    <label for="image">Link</label>
                    <input type="text" class="form-control" name="journal_link" value="{{ $menu->journal_link }}" placeholder="Enter Journal Link Like https://....">
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Update</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')
@endsection