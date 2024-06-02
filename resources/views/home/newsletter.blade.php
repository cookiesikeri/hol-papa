<section id="subscribe" class="subscribe-main-block">
    <div class="bg-img parallax" style="background-image: url('images/bg-img.jpg')">
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="subscribe-dtl">
          <h5 class="subscribe-heading">Are you interested in getting weekly uplifting Newsletter from us?</h5>
          <div class="email-btn">

                <form action="{{route('site.newsletter.post')}}" method="post" class="subscribe-form">
                    {{csrf_field()}}
                    @if(Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success no-b">
                            <span class="text-semibold">Thank you!</span> {{ Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        </div>
                    </div>
                    @endif

              <div class="input-group">
                <label class="sr-only">Your Email address</label>
                <input class="form-control" name="email" placeholder="Your email address.." type="email" required>
                <button type="submit" class="btn btn-default subscribe-btn">Subscribe</button>
              </div>
              <label for="mc-email"></label>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--  end subscribe -->
