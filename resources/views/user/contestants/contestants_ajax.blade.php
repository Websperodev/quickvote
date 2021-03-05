<div id="cand" class="events candidatelists">
    <div class="container">
        <div class="row">
            @if(!empty($contestants))
            @foreach($contestants as $cont)
            @php  if($cont->image != '')
            {
            $cImg = $cont->image;
            }
            else{
            $cImg ="img/fe2.jpg";
            }
            @endphp
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 candidates">
                <div class="tcard border-0 py-3 px-4">
                    <div class="justify-content-center"> <img src="{{url($cImg)}}" class="img-fluid cand-pic mt-3"> </div>
                    <div class="can-detail">
                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="cand-name">{{$cont->name}}</h2>
                                <span class="cand-no">Candidate Number: <span>{{ $cont->candidate_id}}<span></span>
                                        </div>
                                        <div class="votez"><span class="vote-result">Vote Result: <span>{{$cont->percentage}}%</span></span> <span class="vote-btn"><a href="#" class="btn btn-bg">Vote</a></span></div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>

                                        @endforeach
                                        @endif
                                        </div>
                                        </div>
                                        </div>

