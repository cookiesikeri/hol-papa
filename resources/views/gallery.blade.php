@extends('layouts.app')
@section('title')
My Gallery
@endsection
@section('content')

<!-- gallery -->
  <section id="portfolio" class="portfolio-main-block portfolio-three">
    <div class="container-fluid">
      <div class="section text-center">
        <h3 class="section-heading">My Gallery</h3>

      </div>
    </div>
    <div class="portfolio-content">
      <div class="container">
        <div class="row">
          <div class="portfolio-block portfolio-popup">
            @forelse($projects as $state)
            <div class="col-md-4 col-sm-6 portfolio-item portfolio-btm-mrgn">
              <div class="portfolio-img">
                <img src="{{URL::to($state['image'])}}" class="img-responsive" alt="portfolio-img-1">
                <div class="portfolio-overlay"><a href="{{URL::to($state['image'])}}"><i class="fa fa-plus"></i></a></div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 load-more text-center">
            {{ $projects->links() }}

          </div>
        </div>
      </div>
    </div>
  </section>
<!--  end gallery -->

@endsection
