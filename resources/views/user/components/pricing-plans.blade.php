<div class="pricing">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="titleh2 tc">{!! isset($pageData['our pricing']['heading1']) ? ucfirst($pageData['our pricing']['heading1']) : 'Our Pricing' !!}</h2>
      <p>{!! isset($pageData['our pricing']['description']) ? ucfirst($pageData['our pricing']['description']) : 'Our platform is free to use, users just have to sign up to vote but you can also use our freemium or paid plan for instant voting and other cool features.' !!} </p>
      <div class="cards row">
         
        @foreach($pricingData as $key => $data)

        <div class="col-6 card {{ ($key == 0) ? 'free' : 'paid' }}">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">{{ isset($data['plan_type']) ? $data['plan_type'] : 'FREEMIUM'}}</h5>
            <h6 class="card-price text-center">{{ isset($data['plan_amount']) ? $data['plan_amount'] : '50,000'}}</h6>
            <p>{{ isset($data['plan_heading']) ? $data['plan_heading'] : 'One-time Contest fee'}}</p>
            <hr>
            @php
              $planFeatures = $data['plan_features'];
              $features = explode(",",$planFeatures);
            @endphp

            <ul class="fa-ul">
            @foreach($features as $feature)
              <li><span class="fa-li"><i class="fas fa-check"></i></span>{{ $feature}}</li>
            @endforeach
            <!-- <li><span class="fa-li"><i class="fas fa-check"></i></span>Support & Monitoring</li>
            <li><span class="fa-li"><i class="fas fa-times"></i></span>Voters Pays to Vote</li>
            <li><span class="fa-li"><i class="fas fa-check"></i></span>Result Exports</li> -->
            </ul>
            <a href="#" class="btn btn-block btn-primary text-uppercase">{{ isset($data['button_text']) ? $data['button_text'] : 'Create Freemium Contest'}}</a>
          </div>
        </div>
        @endforeach
        
        <!-- <div class="col-6 card paid">
          <div class="card-body">
            <h5 class="card-title text-uppercase text-center">Paid</h5>
            <h6 class="card-price text-center">20%</h6>
            <p>Service Charge Per Paid Vote</p>
            <hr>
            <ul class="fa-ul">
            <li><span class="fa-li"><i class="fas fa-check"></i></span>Instant Voting</li>
            <li><span class="fa-li"><i class="fas fa-check"></i></span>Support & Monitoring</li>
            <li><span class="fa-li"><i class="fas fa-check"></i></span>Voters Pays to Vote</li>
            <li><span class="fa-li"><i class="fas fa-check"></i></span>Result Exports</li>
            </ul>
            <a href="#" class="btn btn-block btn-primary text-uppercase">Get Started</a>
          </div>
        </div> -->

      </div>
      </div>
    </div>
    </div>
  </div>