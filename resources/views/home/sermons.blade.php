<section id="sermons" class="sermons-horizontal-main-block sermons-hOne">
    <div class="container-fluid">
      <div class="section text-center">
        <h3 class="section-heading" style="text-decoration: underline; text-decoration-color: red; text-decoration-thickness: 2px;">Two Most Recent Sermons</h3>
        {{-- <h5 class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at euismod ex, Maeceans sit amet sollicitudin ex.</h5> --}}
      </div>
      <div class="row row-spacing">
    @foreach($data2 as $state)
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="sermons-block">
            <div class="sermons-img">
              <img src="{{URL::to($state['image'])}}" class="img-responsive" alt="sermons-img-1">
            </div>
            <div class="item sermons-horizontal-block">
              <div class="sermons-content">
                <a href="{{ $state['slug'] ?? '#' }}"><h4 class="sermons-heading">{{ucfirst($state['name'] ?? 'No name')}}</h4></a>
                <div class="sermons-desc">
                  <p class="sermons-speaker">Speaker : <a href="">{{ucfirst($state['speaker' ] ?? 'No speaker')}}</a></p>

                </div>
              </div>
              <div class="sermons-icon">
                <ul>
                  <li>
                      <a class="popup-video" href="{{URL::to($state['video'] ?? 'No video' )}}"><i class="flaticon-video-player"></i></a>
                  </li>
                  <li>
                      <a class="popup-video" href="{{URL::to($state['audio'] ?? 'No audio')}}"><i class="flaticon-headphones"></i></a>
                  </li>
                  <li><a href="{{URL::to($state['zip'] ?? 'No zip file')}}" target="_blank" class="cloud"><i class="flaticon-cloud-computing"></i></a></li>
                  <li><a href="{{URL::to($state['file' ?? 'No file'])}}" class="pdf"><i class="flaticon-pdf"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    @endforeach
      </div>
    </div>
  </section>
