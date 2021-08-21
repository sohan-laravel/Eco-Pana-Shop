 <section id="accessories" class="accessories">
    <div class="section_title">
      <div class="section_name">
        <p>Accessories</p>
      </div>
    </div>

    <div class="row no-gutters">
      <div class="col-3">
        <div class="row">
           @foreach ($accessleft as $row)
          <div class="col-12">
            <div class="card">
              <img class="card-img-top" src="{{ asset('frontend/images/AccessoriesLeftImage/'.$row->image) }}" alt="{{ $row->name }}" />
              <div class="card-img-overlay">
                <h2 class="card-title font-weight-bold">{{ $row->name }}</h2>
                <a href="#" class="btn btn-info">See ALL</a>
              </div>
            </div>
          </div>
         @endforeach
        </div>
      </div>

      @foreach ($accessmiddle as $row)

      <div class="col-6">
        <div class="lead_card">
          <img class="card-img-top" src="{{ asset('frontend/images/AccessoriesMiddleImage/'.$row->image) }}" alt="{{ $row->name }}" />
          <div class="card-img-overlay">
            <h2 class="card-title font-weight-bold">{{ $row->name }}</h2>
            <a href="#" class="btn btn-info">See ALL</a>
          </div>
        </div>
      </div>

      @endforeach

      <div class="col-3">
        <div class="row">

          @foreach ($accessright as $row)

          <div class="col-12">
            <div class="card">
              <img class="card-img-top" src="{{ asset('frontend/images/AccessoriesRightImage/'.$row->image) }}" alt="{{ $row->name }}" />
              <div class="card-img-overlay">
                <h2 class="card-title font-weight-bold">{{ $row->name }}</h2>
                <a href="#" class="btn btn-info">See ALL</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>