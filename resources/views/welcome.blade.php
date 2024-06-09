@extends('layouts.app')
@section('title')
Home
@endsection
@section('content')


<section id="pastor-dtl-page" class="pastor-dtl-block">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="pastor-img">
            <img src="{{ URL::to($general['about_image']) }}" class="img-responsive" alt="pastor-img-1">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="row">
            <div class="col-lg-offset-1 col-lg-11 col-md-offset-1 col-md-11 col-sm-12 col-xs-12">
              <div class="pastor-content">
                <h3 class="pastor-id">Rev. Yinka Yusuf</h3>
                <p class="pastor-post">Senior Pastor</p>
                <hr>
                <div class="social-icon social-two">
                  <ul>
                    <li><a href="{{$site->twitter}}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="{{$site->facebook}}" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{$site->youtube}}" target="_blank" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                    <li><a href="{{$site->instagram}}" target="_blank" class="google-plus"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                </div>
                <p class="pastor-desc">{!! $general->about_content !!}.</p>
                <div class="pastor-body">
                  <div class="row">
                    <div class="col-xs-3"><p>Church Address: <i class="fa fa-home"></i></a></li></p></div>
                    <div class="col-xs-9"><p>{!! $site->site_address !!} </p></div>
                    <div class="col-xs-3"><p>Phone: <i class="fa fa-phone"></i></a></li></p></div>
                    <div class="col-xs-9"><p class="contact-no"><a href="tel:{{$site->hotline}}">{{$site->hotline}}</a><br><a href="tel:{{$site->hotline2}}">{{$site->hotline2}}</a></p></div>
                    <div class="col-xs-3"><p>Email: <i class="fa fa-envelope-open"></i></p></div>
                    <div class="col-xs-9">
                      <p class="mail-to"><a href="mailto:{{$site->site_email}}" target="_top">{{$site->site_email}}</a><br>
                      <a href="mailto:{{$site->site_address2}}" target="_top">{{$site->site_address2}}</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
  <section class="pastor-dtl-two">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
          <div class="pastor-faq">
            @forelse($bios as $product)
            <div class="panel panel-default faq-block">
                <div class="panel-heading" role="tab" id="pastorheadingTwo">
                  <div class="panel-title faq-heading">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#pastoraccordion" href="#{{$product->id}}" aria-expanded="false" aria-controls="pastorcollapseTwo">
                     <h4 class="faq-heading">{{ucfirst($product['name'])}}</h4>
                      <span class="btn btn-default faq-btn faq-btn faq-btn-minus pull-right"><i class="fa fa-minus"></i></span>
                      <span class="btn btn-default faq-btn faq-btn-plus pull-right"><i class="fa fa-plus"></i></span>
                    </a>
                  </div>
                </div>
                <div id="{{$product->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pastorheadingTwo">
                  <div class="panel-body faq-dtl">
                    <p>{!! $product->body !!}</p>
                  </div>
                </div>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="portfolio" class="portfolio-main-index-block">
    <div class="container-fluid">
      <div class="section text-center">
        <h3 class="section-heading" style="text-decoration: underline; text-decoration-color: rgb(0, 60, 255); text-decoration-thickness: 2px;">My Gallery</h3>
        <h5 class="sub-heading">Indeed God has been using Rev. Yinka Yusuf to do signs and wonders. May the blessing of God touch you wherever you are "AMEN".</h5>
      </div>
      <div class="row">
        <div id="portfolio-block" class="portfolio-popup">
            @foreach($galleries as $state)
        <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6 portfolio-item portfolio-btm-mrgn">
            <div class="portfolio-img">
                <img src="{{URL::to($state['image'])}}" class="img-responsive" alt="gallery-img-1">
                <div class="portfolio-overlay"><a href="{{URL::to($state['image'])}}"><i class="fa fa-search"></i></a></div>
            </div>
        </div>
         @endforeach
        </div>
      </div>
      <a class="read-more col-md-12 load-more text-center" a href="{{ route('gallery') }}">View All <i class="fa fa-long-arrow-right"></i></a>
    </div>
  </section>
<!--  latest sermons -->
@include('home.events')
@include('home.sermons')

@include('home.quote')

@include('home.contact')

<div class="donation-modal-block">
    <div id="donationModal" class="modal fade donation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalHeading" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close close-btn" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalHeading" class="myModalHeading">Weekly Prayer</h4>
            <h6 id="myModalSubHeading" class="myModalSubHeading">Beloved! are you interested in getting weekly prayer from me? </h6>
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
