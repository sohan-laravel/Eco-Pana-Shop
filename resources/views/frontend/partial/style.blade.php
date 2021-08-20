 <!-- fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('frontend/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}" />

  <style>

    /* about us */

    @foreach ($about as $row)
    #about_us { 
     background-image: url({{ asset('frontend/images/AboutImage/'.$row->image) }});
     background-repeat: no-repeat;
     background-size: cover;

    }
      @endforeach

    /* leather care */

    @foreach ($leather as $row)

    #leather_care{
      background-image: url({{ asset('frontend/images/LeatherImage/'.$row->image) }});
      background-repeat: no-repeat;
      background-size: cover;
    }

@endforeach

  </style>