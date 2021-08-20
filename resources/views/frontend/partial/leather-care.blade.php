  <section id="leather_care" class="leather_care my-2">
    <div class="section_title py-2" data-aos="fade-up" data-aos-duration="2000" data-aos-anchor-placement="top-center">

       @foreach ($leather as $row)

      <h4 class="text-center">
        <span class="leather"> {{ $row->name }} </span>
      </h4>
    </div>
    <div class="row">
      <div class="des_leather_care" data-aos="fade-up" data-aos-duration="2000" data-aos-anchor-placement="top-center">
        <ul>
          <li> {!! $row->description !!}</li>
        </ul>
      </div>

      @endforeach

    </div>
  </section>