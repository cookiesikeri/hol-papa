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

<!--  latest sermons -->
@include('home.sermons')

@include('home.quote')

@include('home.events')

@include('home.newsletter')


<br>

@endsection
