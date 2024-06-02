<header id="home-slider" class="slider-main-block">
    @foreach($sliders as $state)
    <div class="item home-slider-img" style="background-image: url('{{URL::to($state['image'])}}')">
      <div class="overlay-bg"></div>
      <div class="container">
        <div class="slider-dtl">
          <h1 class="slider-heading">{{$state['header']}}</h1>
          <h5 class="slider-subheading">{{$state['sub_header']}}</h5>
        </div>
      </div>
    </div>
    @endforeach
  </header>
