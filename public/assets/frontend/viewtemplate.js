var activeChartObject;
var isLoadingJSON = false;
var w = null;
function getMeta(url) {
    var img = new Image();
    img.addEventListener("load", function() {
        canvas.setBackgroundImage(url, canvas.renderAll.bind(canvas), {
            scaleX: canvas.width / img.width,
            scaleY: canvas.height / img.height,
            opacity: $('#rangeSelect').prop('value')
        });
        canvas.renderAll();
    });
    img.src = url;
}

$(document).on('click', '.canvas_content', function() {
    if(activeSlide!=$(this).parents('.my-slide').index()) {
        if(!isLoadingJSON) {
            $(this).parents('.my-slide').addClass('active').siblings().removeClass('active');
            isLoadingJSON = true;
            var self = $(this);
            activeSlide = self.parents('.my-slide').index();
            $('#slide_title_each').val(AllSlides[activeSlide]['title']);
            canvas.loadFromJSON(AllSlides[activeSlide]['slide_json'], function() {
                canvas.renderAll();
                lockObjectMovements();
                $('#slides_notes').text(AllSlides[activeSlide]['notes']);
                isLoadingJSON = false;
            }); 
        }
    }
});


$(document).on('click', '.show_notes_screen', function(){
    console.log('w',w);
    if( w == null || (w != null && w.closed != undefined && w.closed)) {
        w =window.open('','_blank','width=800, height=600'); 
        w.document.write(`<html>
        <head>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha256-4hqlsNP9KM6+2eA8VUT0kk4RsMRTeS7QGHIM+MZ5sLY=" crossorigin="anonymous" />
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
            <link href="https://fonts.googleapis.com/css?family=Advent+Pro:400,500,600,700|Cabin&display=swap" rel="stylesheet">
            <style>
                .slick-next {right: 0px;}
                .slick-prev {left: 0px;z-index: 9;}
                .slick-slider .slick-arrow {background-color: #1c93d6;height: 40px;width: 22px;border-radius: 3px;}
                .main_div {width : 100%;}
                .slider_div {width : 70%;float: left;}
                .notes_div {width: 28%;float: left;margin-left: 10px;}
                .notes_div .inner-content-div{padding: 15px;border: 1px solid #eee;}
                .notes_div .inner-content-div h1{margin-top: 0;font-family: 'Advent Pro', sans-serif;font-weight:500;font-size: 30px;}
                .inner-content-div .notes_here{font-family: 'Cabin', sans-serif;line-height: 24px;height: 325px;
                 overflow-y: auto;}
                .slick-slide{height: auto !important;}
                .slick-slider:hover .slick-arrow {display: inline-block !important;}
                .slick-arrow{display: none !important;}
                .slick-next:before 
                {color: white;font: normal normal normal 14px/1 FontAwesome;font-weight: 600;content: "\\f105" !important;opacity: 1;font-size: 15px;}
                .slick-prev:before 
                {color: white;font: normal normal normal 14px/1 FontAwesome;font-weight: 600;content: "\\f104" !important;
                opacity: 1;font-size: 15px;}    
            </style>
        </head>
        <body></body></html>`);
        var slider = `
            <div class="main_div">
                <div class="slider_div">
                    <div class="slideshow__slides">
                        `+$('.all-sliders').html()+`
                    </div>
                </div>
                <div class="notes_div">
                    <div class="inner-content-div"><h1>Notes: </h1>
                       <div class="notes_here">
                           this is a demo notes you can see.
                    </div>
                </div>
                </div>
            </div>
        `;

        slider = $.parseHTML(slider);
        $(w.document.body).prepend(slider);
        $(w.document.body).find('.slideshow__slides').slick({
            dots: false,
            slidesToShow: 1,
            autoplay: false,
            infinite: false,
            swipe : false,
            initialSlide : $('#container_uid').find('.slider').slick('slickCurrentSlide')
        });
        $(w.document.body).find('.notes_here').text(AllSlides[$(w.document.body).find('.slideshow__slides').slick('slickCurrentSlide')]['notes']);
        $(w.document.body).find('.slideshow__slides').on('click', '.slick-prev', function() {
             $('#container_uid').find('.slider').slick('slickGoTo',$(w.document.body).find('.slideshow__slides').slick('slickCurrentSlide'));
        });
        $(w.document.body).find('.slideshow__slides').on('click', '.slick-next', function() {
             $('#container_uid').find('.slider').slick('slickGoTo',$(w.document.body).find('.slideshow__slides').slick('slickCurrentSlide'));
        });

        $(w.document.body).find('.slideshow__slides').on('afterChange', function() {
            $(w.document.body).find('.notes_here').text(AllSlides[$(w.document.body).find('.slideshow__slides').slick('slickCurrentSlide')]['notes']);
        });
        w.onresize = function(){
            $(w.document.body).find('.slideshow__slides').slick('setPosition');
        }
    } else {
        w.focus();
    }
})

window.onbeforeunload = function(e) {
    if(w != null && w.closed != undefined && !w.closed) {
        w.close();
    }
};



