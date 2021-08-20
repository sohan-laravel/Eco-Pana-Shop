 <section id="category_slider" class="category_slider my-2">
    <div class="owl-carousel owl-theme">

      @foreach ($categories as $category)

      <div class="item">
        <a href="#" class="hover-switch">
          <img src="{{ asset('frontend/images/CategoryImage/'.$category->image) }}" alt="">
          <img src="{{ asset('frontend/images/CategoryImage/'.$category->photo) }}" alt="">
        </a>
        <div class="focus-link owl-link button">
          <a href="" class="p-4 my-3">
            <span>{{ $category->category_name }}</span>
            <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i>
          </a>
        </div>
      </div>
      @endforeach

    </div>
  </section>