<section id="events" class="events-main-block">
    <div class="section text-center">
      <h3 class="section-heading" style="text-decoration: underline; text-decoration-color: red; text-decoration-thickness: 2px;">Upcoming Events</h3>
      {{-- <h5 class="sub-heading">below are some of our events</h5> --}}
    </div>
    <div id="event-slider" class="event-slider">
        @forelse($events as $state)
      <div class="item event-block">
        <div class="event-item">
          <div class="event-img">
            <div class="overlay-bg"></div>
            <a href="{{ route('event.details', [ 'slug' => $state->slug]) }}"><img src="{{URL::to($state['image'])}}" class="img-responsive" alt="event-img-1"></a>
          </div>
          <div class="event-content">
            <a href="{{ route('event.details', [ 'slug' => $state->slug]) }}"><h4 class="event-heading">{{ucfirst($state['name'])}}</h4></a>
            <p class="sermons-date">{{ date('M j, Y', strtotime($state['date'])) }} | {{ date('h:ia', strtotime($state['time'])) }}</p>

            <a class="read-more" href="{{ route('event.details', [ 'slug' => $state->slug]) }}">More Details<i class="fa fa-long-arrow-right"></i></a>
          </div>
        </div>
      </div>
      @empty
      <h3>No upcoming event...</h3>
      @endforelse

    </div>
  </section>
