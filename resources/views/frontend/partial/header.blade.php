<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">  

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ route('index') }}">Home</a></li>
          {{-- <li><a href="#">What's New</a></li> --}}

          @foreach ($categories as $category)

          <li class="drop-down"><a href="">{{ $category->category_name }}</a>
          <ul>

            @foreach ($subcategories as $subcategory)


            <li><a href="#">{{ $subcategory->subcat }}</a></li>

            @endforeach

          </ul>
        </li>

        @endforeach

          {{-- <li><a href="#contact">SAle</a></li> --}}

          @foreach ($menu as $row)
          
          <li><a href="{{ $row->journal_link }}" target="_blank">{{ $row->journal_name }}</a></li>

          @endforeach

        </ul>
      </nav><!-- .nav-menu -->

    

    </div>
  </header>