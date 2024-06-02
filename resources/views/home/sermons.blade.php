<section id="sermons" class="sermons-horizontal-main-block sermons-hOne">
    <div class="container-fluid">
      <div class="section text-center">
        <h3 class="section-heading" style="text-decoration: underline; text-decoration-color: red; text-decoration-thickness: 2px;">Latest Sermons</h3>
        {{-- <h5 class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at euismod ex, Maeceans sit amet sollicitudin ex.</h5> --}}
      </div>
      <div class="row row-spacing">
    @foreach($serms as $state)
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="sermons-block">
            <div class="sermons-img">
              <img src="{{URL::to($state['image'])}}" class="img-responsive" alt="sermons-img-1">
            </div>
            <div class="item sermons-horizontal-block">
              <div class="sermons-content">
                <a href="{{ route('sermon.details', [ 'slug' => $state->slug]) }}"><h4 class="sermons-heading">{{ucfirst($state['name'])}}.</h4></a>
                <div class="sermons-desc">
                  <p class="sermons-speaker">Speaker : <a href="{{ route('sermon.details', [ 'slug' => $state->slug]) }}">{{ucfirst($state['speaker'])}}</a></p>
                  <p class="sermons-date">Date : {{ date('M j, Y', strtotime($state['date'])) }}</p>
                </div>
                <p class="sermons-dtl">{{ substr($state->body, 0, 100) }}{{ strlen($state->body) > 100 ? '...' : "" }}</p>
                <a class="read-more" href="{{ route('sermon.details', [ 'slug' => $state->slug]) }}">Read More<i class="fa fa-long-arrow-right"></i></a>
              </div>
              <div class="sermons-icon">
                <ul>
                  <li>
                      <a class="popup-video" href="{{URL::to($state['video'])}}"><i class="flaticon-video-player"></i></a>
                  </li>
                  <li>
                      <a class="popup-video" href="{{URL::to($state['audio'])}}"><i class="flaticon-headphones"></i></a>
                  </li>
                  <li><a href="{{URL::to($state['zip'])}}" target="_blank" class="cloud"><i class="flaticon-cloud-computing"></i></a></li>
                  <li><a href="{{URL::to($state['file'])}}" class="pdf"><i class="flaticon-pdf"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    @endforeach
      </div>
    </div>
  </section>
