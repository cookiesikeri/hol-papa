<!-- footer -->
<footer id="footer" class="footer-main-block">
    <div class="bg-img" style="background-image: url('images/footer-bg.jpg')">
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="row footer-block">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="footer-logo">
              <a href="{{url('/')}}"><img src="{{ asset($site->logo) }}" alt="footer-logo" height="100" width="100"></a>
            </div>
            <div >
              <div class="col-lg-6 col-md-4" style="color: white"><p>Church Address:</p></div>
              <div class="col-lg-9 col-md-4"><p><i class="fa fa-home"></i> {!! $site->site_address !!}</p></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="footer-section">
              <h6 class="footer-heading"></h6>
            </div>
            <div class="footer-content">
              <div class="row">
                <div class="col-lg-6 col-md-3"><p>Phone (s):</p></div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"><p class="contact-no"><a href="tel:{{$site->hotline}}"><i class="fa fa-phone"></i> {{$site->hotline}}</a><br><a href="tel:{{$site->hotline2}}"><i class="fa fa-phone"></i> {{$site->hotline2}}</a></p></div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="footer-section">
              <h6 class="footer-heading"> </h6>
            </div>
            <div class="footer-content portfolio-popup">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 portfolio-item">
                <div class="col-lg-4 col-md-4"><p>Email:</p></div>
                <div class="col-lg-4 col-md-5">
                  <p class="mail-to"><a href="mailto:{{$site->site_email}}" target="_top"><i class="fa fa-evelope"></i> {{$site->site_email}}</a><br>
                  <a href="mailto:{{$site->site_email}}" target="_top">w{{$site->site_email}}</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-dtl text-center">
            <p>Copyright. All Rights Reserved {{$site->site_name}} {{date('Y')}}.</p></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
<!-- end footer -->
