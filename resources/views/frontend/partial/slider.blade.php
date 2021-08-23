  <section id="lead_slider" class="lead_slider">
    <div id="myCarousel" class="carousel slide" data-interval="false">
      <div class="carousel-inner">

        @foreach ($slider as $row)

        <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
          <video autoplay loop muted class="myvid" id="player">
            <source src="{{ asset('frontend/video/SliderVideo/'.$row->video) }}" type="video/mp4" />
          </video>
          
        </div>

        <div class="carousel-item">
          <img class="img-fluid" src="{{ asset('frontend/images/SliderImage/'.$row->image) }}" alt="{{ $row->name }}" />
         
        </div>

        @endforeach

      </div>

      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Vorige</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Volgende</span>
      </a>
    </div>
  </section>