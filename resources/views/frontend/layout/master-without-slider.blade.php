<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title> @yield('title') </title>
	
	@include('frontend.partial.style')

</head>

<body>

  <!-- ======= Top Bar ======= -->
  
  @include('frontend.partial.topbar')

  <!-- ======= Header ======= -->

  @include('frontend.partial.header')

  <!-- End Header -->


  <!-- : lead_slider  -->

	@include('frontend.partial.slider')


  <!-- : about_us  -->

   @yield('frontend-content')

  <!--------------------footer ------------------------------->

	@include('frontend.partial.footer')
  
  <!-- Vendor JS Files -->

  @include('frontend.partial.scripts')
  
</body>

</html>