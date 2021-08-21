@extends('backend.layouts.app')

@section('title')
    Topbar Edit
@endsection

@section('css')
   
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">Topbar Edit</h3>

            <div class="container">
                <a href="{{ route('admin.topbar.index') }}" class="btn btn-outline-info btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> Back</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    
            <form action="{{ route('admin.topbar.update', $topbar->id) }}" method="post">

                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="number">Number</label>
                    <input type="number" class="form-control" name="number" value="{{ $topbar->number }}" placeholder="Enter Your Number">
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="{{ $topbar->facebook }}" placeholder="Enter Your Facebook URL Like https://.....">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter" value="{{ $topbar->twitter }}" placeholder="Enter Your Twitter URL Like https://.....">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="{{ $topbar->twitter }}" placeholder="Enter Your Instagram URL Like https://.....">
                </div>
                <div class="form-group">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" name="whatsapp" value="{{ $topbar->whatsapp }}" placeholder="Enter Your Whatsapp URL Like https://.....">
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm mt-3">Update</button>
            </form>

        </div>
    </div>
</div>
   
@endsection

@section('js')
@endsection