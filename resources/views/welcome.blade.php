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
                    <li><a href="{{$site->site_email}}" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
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
                      <p class="mail-to"><a href="{{$site->site_email}}" target="_top">{{$site->site_email}}</a><br>
                      <a href="{{$site->site_email}}" target="_top">{{$site->site_email}}</a></p>
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
<!--  latest sermons -->
@include('home.sermons')

@include('home.quote')

@include('home.events')

<section id="contact-form" class="form-main-block form-two pastor-form">
    <div class="parallax" style="background-image: url('{{URL::to($general['page_holder'])}}')">
      <div class="overlay-bg"></div>
      <div class="form-section">
        <h4 class="form-heading">PEACE AND BLESSINGS BE UNTO YOU IN THE NAME OF JESUS. </h4>
        <h3 class="form-subheading">For appointments/suggestions/enquiries/or to report a case to Rev Yinka Yusuf (General Overseer of Household of Love Church) kindly reach out to the contacts below;</h3>
        <div class="pastor-form-block">
          <div class="pastor-contact">
            <span><i class="fa fa-phone"></i></span>
            <p><a href="tel:{{$site->hotline}}">{{$site->hotline}}</a></p>
          </div>
          <div class="pastor-mail">
            <span><i class="fa fa-envelope"></i></span>
            <p><a href="mailto:{{$site->site_email}}" target="_top">{{$site->site_email}}</a></p>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
         <div class="contact-form-block">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
       @endif
       <form  class="contact-form" action="{{route('site.contact.post')}}" method="post">
        {{csrf_field()}}
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <select name="title" id="title" class="form-control" style="color:#ccc;">
                    <option>Title</option>
                    <option>Mr</option>
                    <option>Mrs</option>
                    <option>Pastor</option>
                    <option>Deacon</option>
                    <option>Doctor</option>
                    <option>Engineer</option>
                    <option>Apostle</option>
                    <option>Minister</option>
                    <option>Bishop</option>
                    <option>Reverend</option>
                    <option>Others</option>
                </select>
            </div>
          </div>
        <div class="col-lg-9 col-md-4 col-sm-4 col-xs-12">
          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Please give us your FullName" required>
            @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $errors->first('name') }}</strong>
            </span>
        @endif
        </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                </span>
            @endif
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <input type="text" class="form-control" id="number" name="phone" placeholder="Your Phone Number" required>
                @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                </span>
            @endif
            </div>

          </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <select name="country" id="gender" class="form-control" style="color:#ccc;">
                    <option selected>Country</option>
                    <option value="Nigeria">Nigeria</option>
                    @foreach($countries as $country)
                    <option value="{{$country->title}}">{{ ucfirst($country->title) }}</option>
                    @endforeach

                </select>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <input type="text" class="form-control" id="name" name="province" placeholder="State/Province">
            </div>
          </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="form-group">
            <input type="text" class="form-control" id="number" name="city" placeholder="Town/city" >
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="subject" placeholder="Subject" required>
            @if ($errors->has('subject'))
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $errors->first('subject') }}</strong>
            </span>
        @endif
        </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-group">
            <textarea id="message" class="form-control" name="message" placeholder="Type your Message" required></textarea>
            @if ($errors->has('message'))
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $errors->first('message') }}</strong>
            </span>
        @endif
        </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <button type="submit" class="btn btn-default">SUBMIT</button>
        </div>
      </form>
          </div>
        </div>
      </div>
    </div>
</section>

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
