<section id="journal" class="journal">
    <div class="section_title py-3">
      <h4 class="text-center"><span class="jounal_title"> Journal </span></h4>
    </div>

    <div class="row no-gutters">

       @foreach ($journal as $row)

      <div class="col-3">
        <a href="{{ $row->link }}" target="_blank"><img src="{{ asset('frontend/images/JournalImage/'.$row->image) }}" class="img-thumbnail" /></a>
      </div>

     @endforeach
    </div>
  </section>