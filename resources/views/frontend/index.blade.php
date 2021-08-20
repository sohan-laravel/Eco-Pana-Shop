@extends('frontend.layout.master')

@section('frontend-content')

<section id="about_us">
    <div class="about_us" data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-center">
       @foreach ($about as $row)

       {{-- <img class="img-fluid" src="{{ asset('frontend/images/AboutImage/'.$row->image) }}" /> --}}

      <h3>{{ $row->name }}</h3>
      <p>
        {!! $row->description !!}
      </p>

      @endforeach

      <a href="" class=""><button>View all product</button> </a>
    </div>
  </section>
    
@endsection