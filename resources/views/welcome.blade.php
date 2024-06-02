@extends('layouts.app')
@section('title')
Home
@endsection
@section('content')


<!--  about  -->
<section id="about" class="about-main-block">
    <div class="container-fluid">
      <div class="row row-spacing">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-img">
            <img src="{{URL::to($general->introimage)}}" class="img-responsive" alt="about-img">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="about-content">
            <h3 class="about-heading">You are welcome to {{$site->site_name}}</h3>
            <h5 class="about-subheading">{!! $general->home_intro !!}</h5>
            <p class="about-dtl">- Rev Yinka Yusuf</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--  end about -->
<!--  parallax  -->
  <section id="abt-tab" class="tab-main-block">
    <div class="parallax" style="background-image: url('images/bg-img.jpg')">
      <div class="overlay-bg"></div>
      <div class="abt-tab-block">
        <div class="container">
          {{-- <div class="abt-tab-content text-center">
            <h3 class="abt-tab-heading">Nullam ullamcorper ultricies nulla mattis blandit Praesent dignissim quam bibendum.</h3>
          </div> --}}
          <div class="abt-tab-icons">
            <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">
                  <a href="#" data-toggle="modal" data-target="#donationModal">
                    <div class="abt-tab-icon">
                      <i class="flaticon-prayers"></i>
                    </div>
                    <h6 class="abt-icon-name">Weekly Prayer</h6>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">
                  <a href="{{ route('sermons') }}">
                    <div class="abt-tab-icon">
                        <i class="flaticon-teaching"></i>
                    </div>
                    <h6 class="abt-icon-name">Sermons</h6>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">
                  <a href="{{ route('give') }}">
                    <div class="abt-tab-icon">

                      <i class="fa fa-credit-card"></i>
                    </div>
                    <h6 class="abt-icon-name">Give Online</h6>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">
                  <a href="{{ route('live') }}">
                    <div class="abt-tab-icon">
                        <i class="fa fa-tv"></i>
                    </div>
                    <h6 class="abt-icon-name">Live Stream</h6>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">
                  <a href="{{ route('projects.church') }}">
                    <div class="abt-tab-icon">

                        <i class="flaticon-sermons"></i>
                    </div>
                    <h6 class="abt-icon-name">Projects</h6>
                  </a>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <div class="abt-tab-item">
                  <a href="{{ route('events') }}">
                    <div class="abt-tab-icon">
                      <i class="flaticon-events"></i>
                    </div>
                    <h6 class="abt-icon-name">Events</h6>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--  end parallax -->
<!--  who are we -->
@include('home.whoweare')

<!--  latest sermons -->
@include('home.sermons')

@include('home.quote')

@include('home.events')
<section id="donation-bg" class="donation-bg-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
          <div class="donation-bg-itemOne">
            <div class="bg-img" style="background-image: url('{{URL::to($general['call_to_action'])}}')">
              <div class="overlay-bg"></div>
              <div class="donation-content">
                <h2 class="donation-heading">You Can Talk to Someone no matter what the challenge is.</h2>
                <h5 class="donation-dtl">There are competent & Spirit filled Counsellors, Pastors & Ministers willing to speak with you at any time. Don't keep it all in, speak to someone now..</h5>
                <span class="donation-dtl-btn"><a href="{{ route('contact') }}" class="btn btn-default">Contact US</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@include('pages.newsletter')
<div class="donation-modal-block">
    <div id="donationModal" class="modal fade donation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalHeading" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalHeading" class="myModalHeading">Weekly Prayer</h4>
            <h6 id="myModalSubHeading" class="myModalSubHeading">Beloved! are you interested in getting weekly prayer from PAPA? </h6>
          </div>
          <div class="modal-body">
            <form class="contact-form" method="post" action="{{route('site.newsletter.post')}}">
                    {{csrf_field()}}
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="email" class="form-control" id="number" name="email" placeholder="Your Email Address" required>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" type="submit">Submit</button>
          </div>
        </form>
        </div>
      </div>
    </div>
</div>


<br>

@endsection
