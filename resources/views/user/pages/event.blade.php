@extends('user.layouts.main')

@section('content')

<script>
    var url = "{{url('search-event/fetch_data')}}";</script>
<style>
    .img-fluid{
        height:300px;
        width:500px;
    }

</style>
<div id="event-page" class="banner breadcrumb">
    <div class="slider-content">
        <h4>Quick Events</h4>
        <h2>Search Event</h2>
    </div>
</div>

<div id="floating-search" class="container evnt">
    <h2>Event Browse</h2>
    <div class=" row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control seachName" value="" placeholder="Enter KeyWord"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select class="form-control" id="event-cat" >
                    <option value="">Event Category</option>
                    @foreach($allCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary advanceSearch seachButton">Search Event</button>
        </div>
    </div>
</div>


<div id="eve" class="events">
    <div class="container">
        <div class="row">

            <div class="filterr col-12" align="center">
                <button class="btn btn-default filter-button tabFillter" data-value="all" data-filter="all">All</button>
                <button class="btn btn-default filter-button tabFillter" data-value="recent" data-filter="Recent">Most Recent</button>
                <button class="btn btn-default filter-button tabFillter" data-value="free" data-filter="Free">Free Forms</button>
                <button class="btn btn-default filter-button tabFillter" data-value="paid" data-filter="Paid">Paid Forms</button>
            </div>
            <br/>
            <div class="row" id="event_data_ajax">

            </div>

        </div>
    </div>
    <input class="keyname" type="hidden" value="{{$eventname}}">
    <input class="evnt_date" type="hidden" value="{{$eventDate}}">
    <script>
        $(document).ready(function () {
//            function checkeventInput() {
//                var name = $('.seachName').val();
//                var cat = $('#event-cat').val();
//                alert(name);
//                if (name != '' || cat != '') {
//                    $('.seachButton').prop('disabled', false);
//                } else {
//                    $('.seachButton').prop('disabled', true);
//                }
//            }



            $(".filter-button").click(function () {
                var value = $(this).attr('data-filter');
                if (value == "all")
                {
                    //$('.filter').removeClass('hidden');
                    $('.filter').show('1000');
                } else
                {
                    //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
                    //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                    $(".filter").not('.' + value).hide('3000');
                    $('.filter').filter('.' + value).show('3000');
                }
            });
            if ($(".filter-button").removeClass("active")) {
                $(this).removeClass("active");
            }
            $(this).addClass("active");
        });
    </script>
</div>

<script>
    $(document).ready(function () {
        //  /* home page search */
        var keyname = $('.keyname').val();
        var eventdate = $('.evnt_date').val();
        var category = '';
        var tabfillter = 'all';
        fetch_data(keyname, eventdate, category, tabfillter);
        /* end */
//fetch_data('', '', '');
        // /* event seach */
        $('.seachButton').on('click', function () {
            var keyname = $('.seachName').val();
            var category = $('#event-cat').val();
            var eventdate = '';
            var tabfillter = 'all';
            fetch_data(keyname, eventdate, category, tabfillter);
        });
        /* end*/
        // /*event tabFillter */
        $('.tabFillter').on('click', function () {
            var keyname = $('.seachName').val();
            var category = $('#event-cat').val();
            var eventdate = $('.evnt_date').val();
            var tabfillter = $(this).data('value');
            fetch_data(keyname, eventdate, category, tabfillter);
        });
        // end//
        function fetch_data(keyname, eventdate, category, tabfillter)
        {
            var htmldata = '';
            var minPrice = '';
            $.ajax({
                url: url,
                type: 'POST',
                data: {'keyname': keyname, 'eventdate': eventdate, 'category': category, 'tabfillter': tabfillter, "_token": "{{ csrf_token() }}"},
                dataType: 'json',
                success: function (data)
                {
                    //alert('dfg');
//                    console.log(data);
                    $('#event_data_ajax').children().remove();
                    $.each(data, function (key, value) {
                        var eventstartDate = new Date(value.start_date);
                        var datemonth = (eventstartDate.getUTCDate()) + ' ' + GetMonthName(eventstartDate.getMonth() + 1);
                        var date = (eventstartDate.getUTCDate()) + "-" + (eventstartDate.getMonth() + 1) + "-" + (eventstartDate.getUTCFullYear());
                        var cHour = eventstartDate.getHours();
                        var cMin = eventstartDate.getMinutes();

                        var cSec = eventstartDate.getSeconds();
                        var tim = cHour + ":" + cMin + ":" + cSec;
                        var tickets = value.tickets;
                        
                        
                        htmldata = '<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent"><div class="tcard border-0 py-3 px-4">\n\
            <div class="justify-content-center"> <img src="' + imageUrl + value.image + '" class="img-fluid profile-pic mb-4 mt-3" > </div><div class="fe-abs">\n\
            <span class="date-abs">' + datemonth + '</span>\n\
            <div class="txt-card"><div class="event-name"><h2 class="titleh2 event-title">' + value.name + '</h2>\n\
            <span class="tickets">Tickets From ' + minPrice + '</span></div><p class="time-price">\n\
            <span class="etime"><i class="far fa-clock"></i>  Start ' + tim + '</span>\n\
            <span class="eprice"></span></p>\n\
            <a class="btn btn-grad-bd ticket-details" href="#">Tickets & Details</a></div>';
                        $('#event_data_ajax').append(htmldata);
                    })
                }
            });
        }
    });
    function GetMonthName(monthNumber) {

        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
        return months[monthNumber - 1];

    }

</script>
@include('user.components.newsletter')
@include('user.components.trusted-brands')

@endsection