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
              <img class="card-img-top" src="{{ asset('frontend/images/AccessoriesLeftImage/'.$row->image) }}" alt="Card image" />
              <div class="card-img-overlay">
                <h2 class="card-title font-weight-bold">{{ $row->name }}</h2>
                <a href="#" class="btn btn-info">See ALL</a>
              </div>
            </div>
          </div>
         @endforeach
        </div>
      </div>

      <div class="col-6">
        <div class="lead_card">
          <img class="card-img-top" src="{{ asset('frontend/assets/img/accessories/Leather-Accessories.jpg') }}" alt="Card image" />
          <div class="card-img-overlay">
            <h2 class="card-title font-weight-bold">Accessories</h2>
            <a href="#" class="btn btn-info">See ALL</a>
          </div>
        </div>
      </div>

      <div class="col-3">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <img class="card-img-top" src="{{ asset('frontend/assets/img/accessories/women_shoe.png') }}" alt="Card image" />
              <div class="card-img-overlay">
                <h2 class="card-title font-weight-bold">Women Shoes</h2>
                <a href="#" class="btn btn-info">See ALL</a>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <img class="card-img-top" src="{{ asset('frontend/assets/img/accessories/jacket.jpg') }}" alt="Card image" />
              <div class="card-img-overlay">
                <h2 class="card-title font-weight-bold">Jacket</h2>
                <a href="#" class="btn btn-info">See ALL</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>