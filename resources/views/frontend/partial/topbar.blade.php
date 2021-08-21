<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container ">
      <div class="row mt-1">
        <div class="col-2 ">
          <a href="" class=""><button type="button" class="btn btn-dark">MEMBERS</button></a>
        </div>

        @foreach ($topbar as $row)

        <div class="col-7 header_social text-center">
          <a href="{{ $row->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="{{ $row->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="{{ $row->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
          <a href="#"><i class="fas fa-phone-alt"></i> {{ $row->number }}</a>
        </div>

        @endforeach

        <div class="col-3 header_right">
          <div class="box">
            <div class="container-2">
              <span class="icon"><i class="fa fa-search"></i></span>
              <input type="search" id="search" placeholder="Search..." />
            </div>
          </div>
          <div class="sign_in ml-5"><a href=""><i class="fas fa-plus-circle"></i> Sign in</a>
          </div>
        </div>
      </div>
     
    </div>
  </div>