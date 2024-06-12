<section id="contact-form" class="form-main-block form-two pastor-form">
    <div class="parallax" style="background-image: url('{{URL::to($general['page_holder'])}}')">
      <div class="overlay-bg"></div>
      <div class="form-section">
        {{-- <h4 class="form-heading">PEACE AND BLESSINGS BE UNTO YOU IN THE NAME OF JESUS. </h4>
        <h3 class="form-subheading">For appointments/suggestions/enquiries/or to report a case <br> to Rev Yinka Yusuf kindly reach out to the contacts below;</h3> --}}
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
