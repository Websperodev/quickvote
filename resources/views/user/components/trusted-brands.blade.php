<div class="brands py-5 my-3">
    <div class="container">
    <h2 class="titleh2 tc">{!! isset($pageData['trusted brands']['heading1']) ? ucfirst($pageData['trusted brands']['heading1']) : 'Trusted By Great Brands In Nigeria' !!} </h2>

    <div class="customer-logos">
      @if(isset($sliders['trusted brands']) && !empty($sliders['trusted brands']))
        @foreach($sliders['trusted brands'] as $k => $slider)
          <div class="slide"><img src="{{ url("$slider->img1") }}"></div>
        @endforeach
      @endif

    </div>    
  </div>
