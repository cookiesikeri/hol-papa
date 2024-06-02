<section id="pastor" class="pastor-main-block block-spacing">
    <div class="parallax" style="background-image: url('https://media.householdoflove.org/images/DSC09590.JPG')">
      <div class="overlay-bg"></div>
      <div id="pastor-slider" class="pastor-slider">
        @foreach($data1 as $state)
        <div class="item pastor-block">
          <div class="container">
            <div class="pastor-content">
              <span class="quotes-icon"><i class="fa fa-2x fa-quote-left"></i></span>
              <h2 class="pastor-dtl"> {{ $state['body'] }}</h2>
              <div class="pastor-id"><p> {{ucfirst($state['name'])}}</p></div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </section>
