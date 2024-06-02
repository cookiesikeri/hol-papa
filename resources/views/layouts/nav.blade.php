<div class="nav-bar navbar-fixed-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="logo">
            <a href="{{url('/')}}"><img src="{{ asset($site->logo) }}" alt="logo" height="100" width="100"></a>
          </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="navigation-menu">
            <div id="cssmenu">
              <ul>
                <li @if(active('/')) class="active" @endif><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">About Us</a>
                  <ul>
                    <li><a href="{{route('aboutus')}}">About Our Church</a></li>
                    <li><a href="">About Our Pastor</a></li>
                  </ul>
                </li>
                <li><a href="#">Media Center</a>
                 <ul>
                    <li><a href="{{ route('live') }}" target="_blank">Live Stream</a></li>
                    <li><a href="{{ route('downloads') }}">Downloads</a></li>
                    <li><a href="{{ route('sermons') }}">Sermons</a></li>
                  </ul>
                </li>
                <li><a href="#">Quick links </a>
                    <ul>
                       <li><a href="{{route('prayerreq')}}">Prayer Requests</a></li>
                       <li><a href="{{route('faqs')}}">FAQs</a></li>
                       <li><a href="{{route('testimonies')}}">Testimonies</a></li>
                       <li><a href="{{route('departments')}}">Departments</a></li>
                       <li><a href="{{route('events')}}">Events</a></li>
                       <li><a href="{{route('projects.church')}}">Projects</a></li>
                     </ul>
                   </li>
                <li><a href="{{route('contact')}}">Contact Us</a></li>
                <li class="donate-btn"><a href="{{ route('give') }}" class="btn btn-default">Give Online</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--  end navigation -->

