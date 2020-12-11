var fontSize_Ins;
var StrokeWidth_Ins;
var borderRadius_Ins;
const STEP = 3;
var activeChartObject;
var chartEditing = false;
var isLoadingJSON = false;

var Direction = {
    LEFT: 0,
    UP: 1,
    RIGHT: 2,
    DOWN: 3
};
function addIcon(droppedObject, event) {
    if(event) {
        var offset = $(canvasObject).offset();
        var y = event.clientY - (offset.top + imageOffsetY);
        var x = event.clientX - (offset.left + imageOffsetX);
        var texts = new fabric.Icon([], {
            left: x,
            top: y,
            imageUrl: $(droppedObject).attr('src')
        });
        canvas.add(texts);
        canvas.setActiveObject(texts);
    } else {
        var texts = new fabric.Icon([], {
            imageUrl: $(droppedObject).attr('src')
        });
        canvas.add(texts);
        canvas.setActiveObject(texts);
    }
}



// window.addEventListener("keydown", function(e) {
//     if (e.keyCode === 46 && document.activeElement !== 'text') {
//         object = canvas.getActiveObject();
//         if (object && !object.isEditing && !chartEditing) {
//             e.preventDefault();
//             deleteSelectedObject();
//         }
//     }
// });


// Background Imgaes
document.getElementById('background_image_file').addEventListener("change", function(e) {
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        $('#background_image_form').submit();
    }
});


$("#fontSize").ionRangeSlider({
    skin: "sharp",
    min: 10,
    max: 100,
    from: 10,
    step: 1,
    onChange: function(data) {
        $('.selected_font_size').text($('#fontSize').prop('value'));
        applytextactions('fontSize', $('#fontSize').prop('value'));
    },
});
fontSize_Ins = $("#fontSize").data("ionRangeSlider");

$("#strokeWidth").ionRangeSlider({
    skin: "sharp",
    min: 1,
    max: 100,
    from: 2,
    step: 1,
    onChange: function(data) {
        $('.selected_stroke_width').text($('#strokeWidth').prop('value'));
        canvas.getActiveObject().set('strokeWidth',parseInt($('#strokeWidth').prop('value')));
        canvas.renderAll();
    },
});

StrokeWidth_Ins = $("#strokeWidth").data("ionRangeSlider");


$("#borderRadius").ionRangeSlider({
    skin: "sharp",
    min: 1,
    max: 100,
    from: 2,
    step: 1,
    onChange: function(data) {
        $('.selected_border_radius').text($('#borderRadius').prop('value'));
        if(canvas.getActiveObject().get('type')=='rect') {
            console.log('dfsdfdsfdf',parseInt($('#borderRadius').prop('value')));
            canvas.getActiveObject().set('rx',parseInt($('#borderRadius').prop('value')));
            canvas.getActiveObject().set('ry',parseInt($('#borderRadius').prop('value')));
        } else {
            canvas.getActiveObject().set('radius',parseInt($('#borderRadius').prop('value')));
        }
        canvas.renderAll();
    },
});

borderRadius_Ins = $("#borderRadius").data("ionRangeSlider");

$(document).on('click', '.text-action', function() {
    var type = $(this).data('action');
    var value = $(this).data('value');
    applytextactions(type, value);
})

$(document).on('change', '#font-family', function() {
    var value = $(this).val();
    $('.my-select').find('.filter-option-inner-inner').css('font-family',value);
    loadAndUse(value);
})

$(document).on('change', '#font-size', function() {
    var value = $(this).val();
    applytextactions('fontSize', value);
})

$(document).on('change', '#text-bgcolor', function() {
    var value = $(this).val();
    $(".text-bgcolor-class").css("border-bottom", "5px solid " + value);
    applytextactions('textBackgroundColor', value);
})

$(document).on('change', '#text-color', function() {
    var value = $(this).val();
    $(".text-color-class").css("border-bottom", "5px solid " + value);
    applytextactions('fill', value);
})

// document.getElementById('copyButton').addEventListener("click", function(e) {
//     // clone what are you copying since you
//     // may want copy and paste on different moment.
//     // and you do not want the changes happened
//     // later to reflect on the copy.
//     canvas.getActiveObject().clone(function(cloned) {
//         _clipboard = cloned;
//     });
// });

// document.getElementById('pasteButton').addEventListener("click", function(e) {
    
//     // clone again, so you can do multiple copies.
//     _clipboard.clone(function(clonedObj) {
//         canvas.discardActiveObject();
//         clonedObj.set({
//             left: clonedObj.left + 10,
//             top: clonedObj.top + 10,
//             evented: true,
//         });
//         if (clonedObj.type === 'activeSelection') {
//             // active selection needs a reference to the canvas.
//             clonedObj.canvas = canvas;
//             clonedObj.forEachObject(function(obj) {
//                 canvas.add(obj);
//             });
//             // this should solve the unselectability
//             clonedObj.setCoords();
//         } else {
//             canvas.add(clonedObj);
//         }
//         _clipboard.top += 10;
//         _clipboard.left += 10;
//         canvas.setActiveObject(clonedObj);
//         canvas.requestRenderAll();
//     });
// });

$('.refresh_slides').click(function() {
    $('#slide_preview').html(canvas.toSVG({
        suppressPreamble: true
    })).trigger('click');
})

$('.add_slide_js').click(function() {

    /*var jsonstring = JSON.stringify(canvas);
    if(jsonstring != ""){
        canvasArr.push(JSON.stringify(canvas))
        canvasSVGArr.push(canvas.toSVG())
        canvas.clear();
        var SVGHtml = '';
        canvasSVGArr.forEach(function(row,idx){
            var slideClass = 'slide_'+idx;
            var div = "<div rel="+canvasArr[idx]+" class='canves_slide "+slideClass+"'>"+row+"</div>"
            SVGHtml += div;

        })
        $('#slide_preview').html(SVGHtml);
    }
    console.log("canvasArr :",canvasArr);*/
})

// document.getElementById('bgButton').addEventListener("click", function(e) {
//     $('#selected_image').val("yes");
//     document.getElementById('upload_image_file').click();
// });

// $('.upload-btn').click(function() {
//     $('#selected_image').val("no");
//     document.getElementById('upload_image_file').click();
// })


$("#upload_image_file").change(function() {
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        $('#upload_image_form').submit();
    }

})

// $(".save_tempate").click(function() {
//     l = Ladda.create(document.querySelector('.save_tempate'));
//     var template_json = JSON.stringify(canvas)
//     var template_svg = canvas.toSVG();
//     var template_id = $("#template_id").val();
//     var category_id = $("#category_id").val();
//     var color_palette = $("#color_palette_id").val();
//     var bg_image = $("#design_template_save").find('.bg_image').val();

//     $.ajax({
//         type: "POST",
//         url: url,
//         data: {
//             template_json: template_json,
//             template_svg: template_svg,
//             template_id: template_id,
//             category_id: category_id,
//             color_palette: color_palette,
//             bg_image: bg_image
//         },
//         beforeSend: function() {
//             l.start();
//         },
//         success: function(data) {
//             l.stop();
//             if (data.status == 2) {
//                 Swal.fire({
//                     type: 'error',
//                     title: 'Error!',
//                     text: data.error,
//                     confirmButtonClass: 'btn btn-confirm mt-2',
//                 });
//             } else if (data.status == 1) {
//                 Swal.fire({
//                     type: 'success',
//                     title: 'Success!',
//                     text: data.message,
//                     confirmButtonClass: 'btn btn-confirm mt-2',
//                 }).then((value) => {
//                     window.location.href = redirect_url;
//                 });
//             }
//         },
//         error: function(res) {
//             l.stop();
//             var error = res.responseJSON.message;
//             if (error == "") {
//                 error = res.responseJSON.exception;
//             }
//             Swal.fire({
//                 type: 'error',
//                 title: 'Error!',
//                 text: error,
//                 confirmButtonClass: 'btn btn-confirm mt-2',
//             });
//         },
//         complete: function() {
//             l.stop();
//         },
//     });
// });


$('#upload_image_form').on('submit', function(e) {
    e.preventDefault();
    var formdata = new FormData($('#upload_image_form')[0]);
    $.ajax({
        type: "POST",
        url: $('#upload_image_form').attr('action'),
        data: formdata,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#full_page_loader').removeClass('d-none');
        },
        success: function(data) {
            $('#full_page_loader').addClass('d-none');
            if (data.status == 2) {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: data.error,
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });
            } else if (data.status == 1) {
                if ($('#selected_image').val() == 'no') {
                    addImage(data.path, true);
                } else {
                    addImage(data.path, false);
                }
                privew();
            }
        },
        error: function(res) {
            $('#full_page_loader').addClass('d-none');
            var error = res.responseJSON.message;
            if (error == "") {
                error = res.responseJSON.exception;
            }
            Swal.fire({
                type: 'error',
                title: 'Error!',
                text: error,
                confirmButtonClass: 'btn btn-confirm mt-2',
            });
        },
        complete: function() {
            $('#full_page_loader').addClass('d-none');
        },
    });
})


$('#background_image_form').on('submit', function(e) {
    e.preventDefault();
    var formdata = new FormData($('#background_image_form')[0]);
    $.ajax({
        type: "POST",
        url: $('#background_image_form').attr('action'),
        data: formdata,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $('#full_page_loader').removeClass('d-none');
        },
        success: function(data) {
            $('#full_page_loader').addClass('d-none');
            if (data.status == 2) {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: data.error,
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });
            } else if (data.status == 1) {
                $('#design_template_save').find('.bg_image').val(data.short_path);
                fabric.Image.fromURL(data.path, function(img) {
                    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                        scaleX: canvas.width / img.width,
                        scaleY: canvas.height / img.height
                    });
                    canvas.renderAll();
                    privew();
                });
            }
        },
        error: function(res) {
            $('#full_page_loader').addClass('d-none');
            var error = res.responseJSON.message;
            if (error == "") {
                error = res.responseJSON.exception;
            }
            Swal.fire({
                type: 'error',
                title: 'Error!',
                text: error,
                confirmButtonClass: 'btn btn-confirm mt-2',
            });
        },
        complete: function() {
            $('#full_page_loader').addClass('d-none');
        },
    });
})



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

function itemSelected(e) {
    activeSelectedObject();
    if (canvas.getActiveObject().get('type') == 'line') {
        canvas.getActiveObject().setControlsVisibility({
            bl: false,
            br: false,
            tl: false,
            tr: false,
            mt: true,
            mb: true,
            ml : false,
            mr : false,
        });
    }

    if (canvas.getActiveObject().get('type') == 'rect') {
        $('.heightreatset').val(canvas.getActiveObject().get('height'));
        $('.widthreatset').val(canvas.getActiveObject().get('width'));
        $('.reactHeightTools').show();
    } else {
        $('.reactHeightTools').hide();
    }

    if (['circle','triangle','ellipse','path','polygon'].indexOf(canvas.getActiveObject().get('type'))!=-1) {
        canvas.getActiveObject().setControlsVisibility({
            mt: false,
            mb: false,
            ml : false,
            mr : false,
        });
    }

    if (['circle','triangle','ellipse','path','rect','line','polygon'].indexOf(canvas.getActiveObject().get('type'))!=-1) {
        canvas.getActiveObject().set('originX','center'); 
        canvas.getActiveObject().set('originY','center'); 
        $('.shape-tools').show();
        $("#shape-fill").spectrum("set", canvas.getActiveObject().get('fill'));
        $("#shape-stroke-color").spectrum("set", canvas.getActiveObject().get('stroke'));
        StrokeWidth_Ins.update({
            from: canvas.getActiveObject().get('strokeWidth') //your new value
        });
        $('.selected_stroke_width').text(canvas.getActiveObject().get('strokeWidth'));
        if(canvas.getActiveObject().get('type')=='rect') {
            $('.borderRadiusTools').show();
        } else {
            $('.borderRadiusTools').hide();
        }
        if(canvas.getActiveObject().get('type')=='rect') {
            borderRadius_Ins.update({
                from: canvas.getActiveObject().get('rx') //your new value
            });
            $('.selected_border_radius').text(parseInt(canvas.getActiveObject().get('rx')));
        } else {
            borderRadius_Ins.update({
                from: canvas.getActiveObject().get('radius') //your new value
            });
            $('.selected_border_radius').text(parseInt(canvas.getActiveObject().get('radius')));
        }
    } else {
        $('.shape-tools').hide();
    }
    
    if (canvas.getActiveObject().get('type') == 'i-text' || canvas.getActiveObject().get('type') == 'heading' || canvas.getActiveObject().get('type') == 'paragraph'  || canvas.getActiveObject().get('type') == 'list') {
        canvas.getActiveObject().setControlsVisibility({
            bl: false,
            br: false,
            tl: false,
            tr: false,
            mt: false,
            mb: false,
            mtr : false
        });
        if (canvas.getActiveObject().get('fontSize') && canvas.getActiveObject().get('fontSize') <= 100) {
            $('.selected_font_size').text(canvas.getActiveObject().get('fontSize'));
            $('#fontSize').val(canvas.getActiveObject().get('fontSize'));
            $('#font-family').val(canvas.getActiveObject().get('fontFamily'));
            $('#font-family').selectpicker('refresh');
            $('.my-select').find('.filter-option-inner-inner').css('font-family',canvas.getActiveObject().get('fontFamily'));
            fontSize_Ins.update({
                from: canvas.getActiveObject().get('fontSize') //your new value
            });
        }
        if (canvas.getActiveObject().get('textBackgroundColor')) {
            $("#text-bgcolor").spectrum("set", canvas.getActiveObject().get('textBackgroundColor'));
        }
        if (canvas.getActiveObject().get('fill')) {
            $("#text-color").spectrum("set", canvas.getActiveObject().get('fill'));
        }
        $('.font-tools').show();
    } else {
        $('.font-tools').hide();
    }

    if (canvas.getActiveObject().get('type') == 'chart') {
        canvas.getActiveObject().setControlsVisibility({
            bl: false,
            br: false,
            tl: false,
            tr: false,
            mt: false,
            mb: false,
            mtr : false
        });
        $('.chart-tools').show();
    } else {
        $('.chart-tools').hide();
    }

    if (canvas.getActiveObject().get('type') == 'image') {
        canvas.getActiveObject().setControlsVisibility({
            bl: false,
            br: false,
            tl: false,
            tr: false,
            mt: false,
            mb: false,
            mtr : false
        });
        $('.image-tools').show();
    } else {
        $('.image-tools').hide();
    }
    showactionsButtonsCommonToolBar();
}

function itemDeSelected(e) {
    $('.font-tools').hide();
    $('.chart-tools').hide();
    hideactionsButtonsCommonToolBar();
    $('.shape-tools').hide();
    $('.image-tools').hide();
    $('.borderRadiusTools').hide();
    $('.reactHeightTools').hide();
}

// Drag and Drop Code start
function handleDragStart(e) {
    [].forEach.call(images, function(img) {
        img.classList.remove('img_dragging');
    });
    this.classList.add('img_dragging');
    var imageOffset = $(this).offset();
    imageOffsetX = e.clientX - imageOffset.left;
    imageOffsetY = e.clientY - imageOffset.top;
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }
    e.dataTransfer.dropEffect = 'copy';
    return false;
}

function handleDragEnter(e) {
    this.classList.add('over');
}

function handleDragLeave(e) {
    this.classList.remove('over');
}

// function handleDrop(e) {
    
//     e = e || window.event;
//     if (e.preventDefault) {
//         e.preventDefault();
//     }
//     if (e.stopPropagation) {
//         e.stopPropagation();
//     }
//     var droppedObject = document.querySelector('.img_dragging');
//     console.log(".droppedObject", droppedObject)
//     switch ($(droppedObject).data('action')) {
//         case 'font':
//             addFont(droppedObject, e);
//             break;
//         case 'img':
//             addImg(droppedObject, e);
//             break;
//         case 'shape':
//             addShape(droppedObject, e);
//             break;
//         case 'svg':
//             addSvg(droppedObject, e);
//             break;
//         case 'list':
//             addList(droppedObject, e);
//             break;
//         case 'chart':
//             addChart(droppedObject);
//             break;
//         case 'icon':
//             addIcon(droppedObject, e);
//             break;
//         default:
//             // code block
//     }
//     return false;
// }

function handleClick(obj) {

    var droppedObject = obj;
    
    switch ($(droppedObject).data('action')) {
        case 'font':
            addFont(droppedObject, null);
            break;
        case 'img':
            addImg(droppedObject, null);
            break;
        case 'shape':
            addShape(droppedObject, null);
            break;
        case 'svg':
            addSvg(droppedObject, null);
            break;
        case 'list':
            addList(droppedObject, null);
            break;
        case 'chart':
            addChart(droppedObject);
            break;
        case 'icon':
            addIcon(droppedObject, null);
            break;
        default:
            // code block
    }
    return false;
}



function handleDragEnd(e) {
    [].forEach.call(images, function(img) {
        img.classList.remove('img_dragging');
    });
}

function addFont(droppedObject, event) {    
    var offset = $(canvasObject).offset();
    let text = $(droppedObject).data('text');
    if ($(droppedObject).data('size') == 15) {
        text = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industrys standard dummy text ever since the 1500s'
    }
    if (event != null) {
        var y = event.clientY - (offset.top + imageOffsetY);
        var x = event.clientX - (offset.left + imageOffsetX);
        let texts = new fabric.Textbox(text, {
            left: x,
            top: y,
            fontFamily: 'Arial',
            fontSize: $(droppedObject).data('size'),
            disableStyleCopyPaste : false
        });
        texts.initBehavior();
        canvas.add(texts);
        canvas.setActiveObject(texts)
    } else {
        var txt = new fabric.Textbox(text, {
            fontFamily: 'Arial',
            width : $(droppedObject).data('width'),
            fontSize: $(droppedObject).data('size'),
            disableStyleCopyPaste : false
        })
        txt.initBehavior();
        canvas.add(txt);
        txt.center();
        canvas.setActiveObject(txt)
 
    }
}

function addList(droppedObject, event) {
    console.log('droppedObject', droppedObject);
    var offset = $(canvasObject).offset();
    let text = 'First Line\nSecond Line\nThird Line';
    if (event != null) {
        var y = event.clientY - (offset.top + imageOffsetY);
        var x = event.clientX - (offset.left + imageOffsetX);
        let texts = new fabric.List(text, {
            left: x,
            top: y,
            fontFamily: 'Arial',
            fontSize: 15,
            width: 150,
            style: $(droppedObject).data('type')
        });
        canvas.add(texts);
        canvas.setActiveObject(texts)

    } else {
        var txt = new fabric.List(text, {
            fontFamily: 'Arial',
            fontSize: 15,
            width: 150,
            style: $(droppedObject).data('type')
        })
        canvas.add(txt);
        txt.center();
        canvas.setActiveObject(txt)
    }
}

function addImg(droppedObject, event) {

    var offset = $(canvasObject).offset();
    if (event != null) {
        var y = event.clientY - (offset.top + imageOffsetY);
        var x = event.clientX - (offset.left + imageOffsetX);
        var newImage = new fabric.Image(droppedObject, {
            left: x,
            top: y
        });
        newImage.scaleToHeight(150);
        newImage.scaleToWidth(150);
        canvas.add(newImage);
    } else {
        var newImage = new fabric.Image(droppedObject, {});
        canvas.add(newImage);
        newImage.scaleToHeight(150);
        newImage.scaleToWidth(150);
        newImage.center();
    }
    canvas.setActiveObject(newImage);
    privew();

}

function addSvg(droppedObject, event) {
    var offset = $(canvasObject).offset();
    if (event != null) {
        var y = event.clientY - (offset.top + imageOffsetY);
        var x = event.clientX - (offset.left + imageOffsetX);
        fabric.loadSVGFromURL($(droppedObject).attr('src'), function(objects, options) {
            var shape = fabric.util.groupSVGElements(objects, options);
            shape.set({
                left: x,
                top: y
            }).scale(0.25);
            shape.opacity = 1;
            canvas.add(shape);
            canvas.setActiveObject(shape);
        });
    } else {

        fabric.loadSVGFromURL($(droppedObject).attr('src'), function(objects, options) {
            var shape = fabric.util.groupSVGElements(objects, options);

            shape.opacity = 1;
            canvas.add(shape);
            shape.center();
            canvas.setActiveObject(shape);
        });
    }
    // locked, flipped

}


function addShape(dropppedObject, event) {
    var shape;
    var offset = $(canvasObject).offset();
    if (event != null) {
        var y = event.clientY - (offset.top + imageOffsetY);
        var x = event.clientX - (offset.left + imageOffsetX);
    } else {
        var y =0;
        var x =0;
    }
    switch ($(dropppedObject).data('name')) {
        case 'circle':
            shape = new fabric.Circle({
                top: y,
                left: x,
                radius: 50,
                fill: '',
                stroke: 'black',
                strokeWidth: 2,
                originX : 'center',
                originY : 'center',
            });
            break;
        case 'triangle':
            shape = new fabric.Triangle({
                top: y,
                left: x,
                width: 100,
                height: 100,
                fill: '',
                stroke: 'black',
                strokeWidth: 2,
                lockUniScaling : true,
                originX : 'center',
                originY : 'center',
            });
            break;
        case 'rect':
            shape = new fabric.Rect({
                top: y,
                left: x,
                width: 75,
                height: 100,
                fill: '',
                stroke: 'black',
                strokeWidth: 2,
                originX : 'center',
                originY : 'center',
            });
            break;
        case 'ellipse':
            shape = new fabric.Ellipse({
                top: y,
                left: x,
                /* Try same values rx, ry => circle */
                rx: 75,
                ry: 50,
                fill: '',
                stroke: 'black',
                strokeWidth: 2,
                lockUniScaling : true,
                originX : 'center',
                originY : 'center',
            });
            break;
        case 'square':
            shape = new fabric.Rect({
                top: y,
                left: x,
                width: 100,
                height: 100,
                fill: '',
                stroke: 'black',
                strokeWidth: 2,
                originX : 'center',
                originY : 'center',
            });
            break;
        case 'line':
            shape =  new fabric.Line([50, 50, 50, 200], {
                fill: 'black',
                stroke: 'black',
                strokeWidth: 2,
                originX : 'center',
                originY : 'center',
            });
            break;
        case 'heart':
            shape = new fabric.Path('M 272.70141,238.71731 \
                C 206.46141,238.71731 152.70146,292.4773 152.70146,358.71731  \
                C 152.70146,493.47282 288.63461,528.80461 381.26391,662.02535 \
                C 468.83815,529.62199 609.82641,489.17075 609.82641,358.71731 \
                C 609.82641,292.47731 556.06651,238.7173 489.82641,238.71731  \
                C 441.77851,238.71731 400.42481,267.08774 381.26391,307.90481 \
                C 362.10311,267.08773 320.74941,238.7173 272.70141,238.71731  \
                z ');    
            var scale = 100 / shape.width;
            shape.set({ top: y,
                left: x, scaleX: scale, scaleY: scale,  fill: '', stroke: 'black', strokeWidth: 12, lockUniScaling : true,  originX : 'center',
            originY : 'center'});
            break;
        case 'star':
            shape = new fabric.Path('M 170.000 190.000\
            L 190.000 204.641\
            L 187.321 180.000\
            L 210.000 170.000\
            L 187.321 160.000\
            L 190.000 135.359\
            L 170.000 150.000\
            L 150.000 135.359\
            L 152.679 160.000\
            L 130.000 170.000\
            L 152.679 180.000\
            L 150.000 204.641z');    
            var scale = 100 / shape.width;
            shape.set({ top: y,
                left: x, scaleX: scale, scaleY: scale,  fill: '', stroke: 'black', strokeWidth: 2, lockUniScaling : true,  originX : 'center',
            originY : 'center'});
            break;
        case 'polyg':
            var trapezoid = [{
                x: -100,
                y: -50
            }, {
                x: 100,
                y: -50
            }, {
                x: 150,
                y: 50
            }, {
                x: -150,
                y: 50
            }];
            var emerald = [
                {
                    x: 850,
                    y: 75
                },
                {
                    x: 958,
                    y: 137.5
                },
                {
                    x: 958,
                    y: 262.5
                },
                {
                    x: 850,
                    y: 325
                },
                {
                    x: 742,
                    y: 262.5
                },
                {
                    x: 742,
                    y: 137.5
                },
            ];
            var star4 = [{
                    x: 0,
                    y: 0
                },
                {
                    x: 100,
                    y: 50
                },
                {
                    x: 200,
                    y: 0
                },
                {
                    x: 150,
                    y: 100
                },
                {
                    x: 200,
                    y: 200
                },
                {
                    x: 100,
                    y: 150
                },
                {
                    x: 0,
                    y: 200
                },
                {
                    x: 50,
                    y: 100
                },
                {
                    x: 0,
                    y: 0
                }
            ];
            var star5 = [{
                    x: 350,
                    y: 75
                },
                {
                    x: 380,
                    y: 160
                },
                {
                    x: 470,
                    y: 160
                },
                {
                    x: 400,
                    y: 215
                },
                {
                    x: 423,
                    y: 301
                },
                {
                    x: 350,
                    y: 250
                },
                {
                    x: 277,
                    y: 301
                },
                {
                    x: 303,
                    y: 215
                },
                {
                    x: 231,
                    y: 161
                },
                {
                    x: 321,
                    y: 161
                }
            ];
            var shape2 = new Array(trapezoid, emerald, star4, star5);
            var shape = new fabric.Polygon(shape2[1], {
                top: y,
                left: x,
                fill: '',
                stroke: 'black',
                strokeWidth: 2
            });
            break;
        default:

    }
    canvas.add(shape);
    if (event == null) {
        shape.center();
    }
    canvas.setActiveObject(shape);
}

function addChart(droppedObject) {
    $('#full_page_loader').removeClass('d-none');
    if ($(droppedObject).data('type') == 'pie') {
        let data  ={
            columns: [
                ['data1', 30],
                ['data2', 120],
            ],
            type: 'pie',
            colors: {
                data1: '#ff0000',
                data2: '#cccccc'
            }
        };
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: data,
            size: {
                width: 250,
                height : 250
            },
            pie: {
                label: {
                    format: function(value) {
                        return value;
                    },
                    show: true
                }
            },
            onrendered : function() {
                setTimeout(() => {
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    var svgStr = $("#test-"+id).html(); 
                    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        var texts = new fabric.Chart([obj], {
                            chartData: data,
                            chartType: $(droppedObject).data('type'),
                            showLabel: true,
                            left: 0,
                            top: 0
                        });
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        canvas.add(texts);
                        canvas.setActiveObject(texts);
                    });
                }, 100);
            }
        });
    } else if ($(droppedObject).data('type') == 'bar') {
        let data  = {
            x : 'x',
            columns: [
                ['x', '0', '1', '2', '3', '4', '5'],
                ['data1', 30, 200, 100, 400, 150, 250],
                ['data2', 130, 100, 140, 200, 150, 50]
            ],
            type: 'bar',
            colors: {
                data1: '#ff0000',
                data2: '#cccccc'
            }
        };

        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
            var chart = c3.generate({
            bindto : '#test-'+id,
            data: data,
            size: {
                width: 400,
                height : 250
            },     
            axis: {
                x: {
                    type: 'category'
                }
            },                   
            grid: {
                x: {
                    show: false
                },
                y: {
                    show: false
                }
            },              
            onrendered : function() {
                setTimeout(() => {
                    var svgStr = fixBarChart(id);
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    var svgStr = $("#test-"+id).html(); 
                    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        var texts = new fabric.Chart([obj], {
                            chartData: data,
                            chartType: $(droppedObject).data('type'),
                            showLabel: false,
                            left: 0,
                            top: 0
                        });
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        $('.charts_append_here').html('');
                        canvas.add(texts);
                        canvas.setActiveObject(texts);
                    });
                }, 100);
            }
        });
    }

    else if ($(droppedObject).data('type') == 'line') {
        let data = {
            x : 'x',
            columns: [
                ['x', '0', '1', '2', '3', '4', '5'],
                ['data1', 30, 200, 100, 400, 150, 250],
                ['data2', 130, 100, 140, 200, 150, 50]
            ],
            type: 'line',
            colors: {
                data1: '#ff0000',
                data2: '#cccccc'
            }
        };
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
            var chart = c3.generate({
                bindto : '#test-'+id,
                data: data,
                axis: {
                    x: {
                        type: 'category'
                    }
                },
                size: {
                    width: 400,
                    height : 250
                },                        
                grid: {
                    x: {
                        show: false
                    },
                    y: {
                        show: false
                    }
                },              
                onrendered : function() {
                    setTimeout(() => {
                        var svgStr = fixLineChart(id);
                        $("#test-"+id).find('.c3-tooltip-container').remove();
                        var svgStr = $("#test-"+id).html(); 
                        svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
                        fabric.loadSVGFromString(svgStr,function(objects,options)
                        {
                            var obj = fabric.util.groupSVGElements(objects, options);
                            var texts = new fabric.Chart([obj], {
                                chartData: data,
                                chartType: $(droppedObject).data('type'),
                                showLabel: false,
                                left: 0,
                                top: 0
                            });
                            $('#full_page_loader').addClass('d-none');
                            chart.destroy();
                            $('.charts_append_here').html('');
                            canvas.add(texts);
                            canvas.setActiveObject(texts);
                        });
                    }, 100);
                }
            });
    }

    else if ($(droppedObject).data('type') == 'donut') { 
        let data = {
            columns: [
                ['data1', 30],
                ['data2', 120],
            ],
            type: 'donut',
            colors: {
                data1: '#ff0000',
                data2: '#cccccc'
            }
        };
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: data,
            size: {
                width: 250,
                height : 250
            },
            donut: {
                title: 'Dummy Title',
                label: {
                    format: function(value) {
                        return value;
                    },
                    show: true
                }
            },                
            onrendered : function() {
                setTimeout(() => {
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    var svgStr = $("#test-"+id).html(); 
                    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);           
                        var texts = new fabric.Chart([obj], {
                            chartData: data,
                            chartType: $(droppedObject).data('type'),
                            showLabel: true,
                            left: 0,
                            top: 0
                        });
                        canvas.add(texts);
                        canvas.setActiveObject(texts);
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        $('.charts_append_here').html('');
                    });
                }, 100);
            }
        });
    }

    else if ($(droppedObject).data('type') == 'area' || $(droppedObject).data('type') == 'area-spline') {
        let data = {
            x : 'x',
            columns: [
                ['x', '0', '1', '2', '3', '4', '5'],
                ['data1', 30, 200, 100, 400, 150, 250],
                ['data2', 130, 100, 140, 200, 150, 50]
            ],
            types: {
                data1 : $(droppedObject).data('type'),
                data2 : $(droppedObject).data('type'),
            },
            colors: {
                data1: '#ff0000',
                data2: '#cccccc'
            }
        };

        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: data,
            size: {
                width: 400,
                height : 250
            },
            axis: {
                x: {
                    type: 'category'
                }
            },
            grid: {
                x: {
                    show: false
                },
                y: {
                    show: false
                }
            },                  
            onrendered : function() {
                setTimeout(() => {
                    var svgStr = fixLineChart(id);
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    var svgStr = $("#test-"+id).html(); 
                    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        var texts = new fabric.Chart([obj], {
                            chartData: data,
                            chartType: $(droppedObject).data('type'),
                            showLabel: false,
                            left: 0,
                            top: 0
                        });
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        $('.charts_append_here').html('');
                        canvas.add(texts);
                        canvas.setActiveObject(texts);
                    });
                }, 100);
            }
        });
    }
}

function updateChart() {
    var objects = canvas.getObjects();
    $('#full_page_loader').removeClass('d-none');
    
    if(activeChartObject.chartType=="pie") {
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: activeChartObject.get('chartData'),
            size: {
                width: 250,
                height : 250
            },
            pie: {
                label: {
                    format: function(value, ratio, id) {
                        return value;
                    },
                    show: activeChartObject.get('showLabel')
                }
            },
            onrendered : function() {
                setTimeout(() => {
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    if(activeChartObject.get('textColor')) {
                        svgStr = $('svg').find('text').css('fill',activeChartObject.get('textColor'));
                    }

                    if(objects[selectedObject].get('fontFamily')) {
                        svgStr = $('svg').find('text').css('font-family',objects[selectedObject].get('fontFamily'));
                    }
                    
                    var svgStr = $("#test-"+id).html(); 
                    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        activeChartObject.updateChart(obj);
                        privew();
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        lockObjectMovements();
                    });
                }, 100);
            }
        });
    }

    if(activeChartObject.chartType=="donut") {
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: activeChartObject.get('chartData'),
            size: {
                width: 250,
                height : 250
            },
            donut: {
                title: activeChartObject.get('chartTitle'),
                label: {
                    format: function(value) {
                        return value;
                    },
                    show: activeChartObject.get('showLabel')
                }
            },  
            onrendered : function() {
                setTimeout(() => {
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    if(activeChartObject.get('textColor')) {
                        svgStr = $('svg').find('text').css('fill',activeChartObject.get('textColor'))
                    }
                    
                    if(objects[selectedObject].get('fontFamily')) {
                        svgStr = $('svg').find('text').css('font-family',objects[selectedObject].get('fontFamily'));
                    }

                    var svgStr = $("#test-"+id).html(); 
                    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        activeChartObject.updateChart(obj);
                        privew();
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        lockObjectMovements();
                    });
                }, 100);
            }
        });
    }

    else if(activeChartObject.chartType=="bar") {
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: activeChartObject.get('chartData'),
            size: {
                width: 400,
                height : 250
            },                     
            grid: {
                x: {
                    show: activeChartObject.get('showLabel')
                },
                y: {
                    show: activeChartObject.get('showLabel')
                }
            },
            axis: {
                x: {
                    type: 'category'
                }
            },  
            onrendered : function() {
                setTimeout(() => {
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    var svgStr = fixBarChart(id);
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        activeChartObject.updateChart(obj);
                        privew();
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        lockObjectMovements();
                    });
                }, 100);
            }
        });
    }

    else if(activeChartObject.chartType=="line") {
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: activeChartObject.get('chartData'),
            size: {
                width: 400,
                height : 250
            },       
            axis: {
                x: {
                    type: 'category'
                }
            },              
            grid: {
                x: {
                    show: activeChartObject.get('showLabel')
                },
                y: {
                    show: activeChartObject.get('showLabel')
                }
            },
            onrendered : function() {
                setTimeout(() => {
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    var svgStr = fixLineChart(id);
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        activeChartObject.updateChart(obj);
                        privew();
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        lockObjectMovements();
                    });
                }, 100);
            }
        });
    }

    else if(activeChartObject.chartType=="area" || activeChartObject.chartType=="area-spline") {
        let id = Math.floor(Date.now() / 1000) + getRandomString();
        $(".charts_append_here").append('<div id="test-'+id+'"></div>');
        var chart = c3.generate({
            bindto : '#test-'+id,
            data: activeChartObject.get('chartData'),
            size: {
                width: 400,
                height : 250
            },  
            axis: {
                x: {
                    type: 'category'
                }
            },                     
            grid: {
                x: {
                    show: activeChartObject.get('showLabel')
                },
                y: {
                    show: activeChartObject.get('showLabel')
                }
            },
            onrendered : function() {
                setTimeout(() => {
                    $("#test-"+id).find('.c3-tooltip-container').remove();
                    var svgStr = fixLineChart(id);
                    fabric.loadSVGFromString(svgStr,function(objects,options)
                    {
                        var obj = fabric.util.groupSVGElements(objects, options);
                        activeChartObject.updateChart(obj);
                        privew();
                        $('#full_page_loader').addClass('d-none');
                        chart.destroy();
                        lockObjectMovements();
                    });
                }, 100);
            }
        });
    }

}


function showTextEditorToolBar() {
    $('.texteditortollbar').show();
}

function hideTextEditorToolBar() {
    $('.texteditortollbar').hide();
}

function showactionsButtonsCommonToolBar() {
    // $('.actionsButtonsCommon').show();
}

function hideactionsButtonsCommonToolBar() {
    // $('.actionsButtonsCommon').hide();
}

function applytextactions(type, value) {
    if(canvas.getActiveObject()) {
        switch (type) {
            case 'underline':
                object = canvas.getActiveObject();
                if (object.setSelectionStyles && object.isEditing) {
                    var style = {};
                    style['underline'] = true;
                    object.setSelectionStyles(style);
                } else {
                    canvas.getActiveObject().set('underline', !canvas.getActiveObject().get('underline'));
                }
                break;
            case 'linethrough':
                object = canvas.getActiveObject();
                if (object.setSelectionStyles && object.isEditing) {
                    var style = {};
                    style['linethrough'] = true;
                    object.setSelectionStyles(style);
                } else {
                    canvas.getActiveObject().set('linethrough', !canvas.getActiveObject().get('linethrough'));
                }
                break;
            case 'textAlign':
                canvas.getActiveObject().set('textAlign', value);
                break;
            case 'fontFamily':
                canvas.getActiveObject().set('fontFamily', value);
                break;
            case 'fontSize':
                object = canvas.getActiveObject();
                if (object.setSelectionStyles && object.isEditing) {
                    var style = {};
                    style['fontSize'] = value;
                    object.setSelectionStyles(style);
                } else {
                    canvas.getActiveObject().set('fontSize', value);
                }
                break;
            case 'textBackgroundColor':
                canvas.getActiveObject().set('textBackgroundColor', value);
                break;
            case 'fill':
                canvas.getActiveObject().set('fill', value);
                break;
            default:
                object = canvas.getActiveObject();
                if (object.setSelectionStyles && object.isEditing) {
                    var style = {};
                    style[type] = value;
                    object.setSelectionStyles(style);
                } else {
                    if (canvas.getActiveObject().get(type) == 'normal') {
                        canvas.getActiveObject().set(type, value);
                    } else {
                        canvas.getActiveObject().set(type, 'normal');
                    }
                }
        }
        canvas.trigger('object:modified', {target: canvas.getActiveObject()});
        canvas.renderAll();
    }
}

function deleteSelectedObject() {
    var object = canvas.getActiveObject();
    if(!chartEditing && object && !object.isEditing) {
        var activeGroup = canvas.getActiveObjects();
        if (activeGroup.length > 0) {
            $.each(activeGroup, function(index) {
                canvas.remove(activeGroup[index]);
                canvas.discardActiveObject();
                lockObjectMovements();
            });
        }
    }
}

function addImage(imgLink, new_one = false) {
    if (new_one) {
        fabric.Image.fromURL(imgLink, function(img) {
            img.set({
                id: 'image_',
            });
            img.scaleToHeight(150);
            img.scaleToWidth(150);
            canvas.add(img).renderAll().setActiveObject(img);
            img.center();
            privew();
        });
    } else {
        var objects = canvas.getObjects();
        objects[selectedObject].setSrc(imgLink, function (image) {
            image.src = imgLink
			image.scaleToHeight(150);
            image.scaleToWidth(150);
            canvas.requestRenderAll();
            setTimeout(function(){
                lockObjectMovements();
            },1000)
        });
        privew();
    }
}

function privew() {
    setTimeout(function() {
        AllSlides[activeSlide]['slide_canvas'] = canvas.toSVG();
        AllSlides[activeSlide]['slide_json'] = JSON.stringify(canvas);
        //First Slide
        if(activeSlide==0) {
            $('.recent-slides').find('.my-slide:first').find('.canvas_content').html(AllSlides[activeSlide]['slide_canvas']);
            $('.recent-slides').find('.my-slide:first').find('.h5-heading').text(AllSlides[activeSlide]['title']);
        } 
        //Last Slide
        else if(activeSlide == AllSlides.length-1) {
            $('.recent-slides').find('.my-slide:last').find('.canvas_content').html(AllSlides[activeSlide]['slide_canvas']);
            $('.recent-slides').find('.my-slide:last').find('.h5-heading').text(AllSlides[activeSlide]['title']);
        } 
        //other Slides
        else {
            $('.recent-slides').find('.my-slide:nth('+parseInt(activeSlide)+')').find('.canvas_content').html(AllSlides[activeSlide]['slide_canvas']);
            $('.recent-slides').find('.my-slide:nth('+parseInt(activeSlide)+')').find('.h5-heading').text(AllSlides[activeSlide]['title']);
        }
        updateText();
    }, 500);
}

function fixBarChart(id) {
    $("#test-"+id).find('.c3-tooltip-container').remove();
    var tempStr = $("#test-"+id).find('svg').find('.c3-axis-y').find('path').attr('d');
    tempStr = tempStr.replace(/(6)+/g,'1');
    $("#test-"+id).find('svg').find('.c3-axis-y').find('path').attr('d',tempStr);
    var tempStr = $('svg').find('.c3-axis-x').find('path').attr('d');
    tempStr = tempStr.replace(/(6)+/g,'1');
    $("#test-"+id).find('svg').find('.c3-axis-x').find('path').attr('d',tempStr);
    if(canvas.getActiveObject() && canvas.getActiveObject().get('showLabel')){
        $("#test-"+id).find('svg').find('.c3-grid').find('.c3-xgrid').css('stroke','#aaa');
        $("#test-"+id).find('svg').find('.c3-grid').find('.c3-ygrid').css('stroke','#aaa');
    }
    if(canvas.getActiveObject() && canvas.getActiveObject().get('textColor')) {
        $("#test-"+id).find('svg').find('text').css('fill',canvas.getActiveObject().get('textColor'));
        $("#test-"+id).find('svg').find('.c3-axis-y').find('path').css('fill',canvas.getActiveObject().get('textColor'));
        $("#test-"+id).find('svg').find('.c3-axis-x').find('path').css('fill',canvas.getActiveObject().get('textColor'));
    }
    if(canvas.getActiveObject() && canvas.getActiveObject().get('fontFamily')) {
        svgStr = $('svg').find('text').css('font-family',canvas.getActiveObject().get('fontFamily'));
    }
    $("#test-"+id).find('.c3-axis-x').find('.tick').each(function(){
        let string = $(this).attr('transform');
        string = string.replace("0)","8)");
        $(this).attr('transform',string);
    });
    var svgStr = $("#test-"+id).html(); 
    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
    $("#test-"+id).find('svg').find('.c3-axis-y').find('path').attr('d').replace(/(6)+/g,'1');
    return svgStr;
}

function fixLineChart(id) {
    $("#test-"+id).find('.c3-tooltip-container').remove();
    $("#test-"+id).find('svg').find('.c3-chart-lines').css('fill','none');
    $("#test-"+id).find('svg').find('.c3-chart-lines').find('.c3-chart-line').css('opacity','1');
    var tempStr = $("#test-"+id).find('svg').find('.c3-axis-y').find('path').attr('d');
    tempStr = tempStr.replace(/(6)+/g,'1');
    $("#test-"+id).find('svg').find('.c3-axis-y').find('path').attr('d',tempStr);
    var tempStr = $("#test-"+id).find('svg').find('.c3-axis-x').find('path').attr('d');
    tempStr = tempStr.replace(/(6)+/g,'1');
    $("#test-"+id).find('svg').find('.c3-axis-x').find('path').attr('d',tempStr);

    if(canvas.getActiveObject() && canvas.getActiveObject().get('showLabel')) {
        $("#test-"+id).find('svg').find('.c3-grid').find('.c3-xgrid').css('stroke','#aaa');
        $("#test-"+id).find('svg').find('.c3-grid').find('.c3-ygrid').css('stroke','#aaa');
    }

    if(canvas.getActiveObject() && canvas.getActiveObject().get('textColor')) {
        $("#test-"+id).find('svg').find('text').css('fill',canvas.getActiveObject().get('textColor'));
        $("#test-"+id).find('svg').find('.c3-axis-y').find('path').css('fill',canvas.getActiveObject().get('textColor'));
        $("#test-"+id).find('svg').find('.c3-axis-x').find('path').css('fill',canvas.getActiveObject().get('textColor'));
    }

    if(canvas.getActiveObject() && canvas.getActiveObject().get('fontFamily')) {
        svgStr = $('svg').find('text').css('font-family',canvas.getActiveObject().get('fontFamily'));
    }

    $("#test-"+id).find('.c3-axis-x').find('.tick').each(function(){
        let string = $(this).attr('transform');
        string = string.replace("0)","8)");
        $(this).attr('transform',string);
    });
    var svgStr = $("#test-"+id).html(); 
    svgStr = svgStr.replace(/(?:\"url\(https?|ftp):\/\/[\n\S]+/g, '""');
    return svgStr;
}

function loadAndUse(font) {
    canvas.getActiveObject().set("fontFamily", font);
    canvas.requestRenderAll();
    privew();
}

fabric.util.addListener(document.body, 'keydown', function (options) {
    var target = $( options.target );
    if (options.repeat || target.is('input')) {
        return;
    }
    var key = options.which || options.keyCode; // key detection
    // if (key === 37) { // handle Left key
    //     moveSelected(Direction.LEFT);
    // } else if (key === 38) { // handle Up key
    //     moveSelected(Direction.UP);
    // } else if (key === 39) { // handle Right key
    //     moveSelected(Direction.RIGHT);
    // } else if (key === 40) { // handle Down key
    //     moveSelected(Direction.DOWN);
    // }
    if (key === 46) { // handle Down key
        deleteSelectedObject();
    }
});

function moveSelected(direction) {
    var activeObject = canvas.getActiveObject();
    if (activeObject) {
        switch (direction) {
        case Direction.LEFT:
            activeObject.set('left', activeObject.get('left') - STEP);
            break;
        case Direction.UP:
            activeObject.set('top', activeObject.get('top') - STEP);
            break;
        case Direction.RIGHT:
            activeObject.set('left',activeObject.get('left') + STEP);
            break;
        case Direction.DOWN:
            activeObject.set('top', activeObject.get('top') + STEP);
            break;
        }
        activeObject.setCoords();
        canvas.renderAll();
        console.log('selected objects was moved');
    } else {
        console.log('no object selected');
    }
}

function rotateLeft() {
    var curAngle = canvas.getActiveObject().get('angle');
    canvas.getActiveObject().set('angle',curAngle-90); 
    canvas.renderAll();
}

function rotateRight() {
    var curAngle = canvas.getActiveObject().get('angle');
    canvas.getActiveObject().set('angle',curAngle+90); 
    canvas.renderAll();
}

$('.heightreatset, .widthreatset').on('change, keyup', function() {
    canvas.getActiveObject().set('height',parseInt($('.heightreatset').val()));
    canvas.getActiveObject().set('width',parseInt($('.widthreatset').val()));
    canvas.renderAll();
})

$('#line_type').on('change',function() {
    if($(this).val()=='dash') {
        canvas.getActiveObject().set('strokeDashArray',[5, 5]);
    } else {
        canvas.getActiveObject().set('strokeDashArray',[]);
    }
    canvas.renderAll();
})



$(document).on('click', '.change_chart_btn', function() {
    selectedObject = $(this).data('index');
    var objects = canvas.getObjects();
    $('#myCenterModalLabel').text(objects[selectedObject].get('chartType')+' Chart');
    if(objects[selectedObject].type == 'chart') {
        activeChartObject = objects[selectedObject];
        let html = '';
        //If pie Chart here
        if(activeChartObject.chartType=="pie") {
            html += `<div class="row">
                <div class="col-12">
                    <p>Note : All fields are editable. Simply click on any field to update the value.</p>
                <div>
                <div class="col-12 mb-2">
                    <button class="btn btn-success btn-xs add_row">Add Row</button>
                    <button class="btn btn-danger btn-xs delete_row">Delete Row</button> 
                </div>
            `;
            let i = 0;
            if(activeChartObject.chartData.colors) {
                html += `
                <div class="col-12">
                    <table style="width:auto;" class="table table-bordered mb-0 chart_table">
                    <thead>
                        <tr>    
                            <th style="min-width:130px;">Name</th>
                            <th style="min-width:130px;">Amount</th>
                            <th style="min-width:130px;">Color</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    `;
                Object.keys(activeChartObject.chartData.colors).map(function(objectKey, index) {
                    html += `
                    <tr>
                        <td data-index="`+objectKey+`" data-type="text" data-value="`+objectKey+`" class="chartLabel makeItInput parent_cell">
                            `+objectKey+`
                        </td>
                        <td data-index="`+objectKey+`" data-type="number" data-value="`+activeChartObject.chartData.columns[i][1]+`" class="chartValue makeItInput parent_cell">
                            `+activeChartObject.chartData.columns[i][1]+`
                        </td>
                        <td data-index="`+objectKey+`" data-type="picker" data-value="`+activeChartObject.chartData.colors[objectKey]+`" class="chartColor makeItInput parent_cell">
                            <div style="height:20px; width :100%;background:`+activeChartObject.chartData.colors[objectKey]+`"></div>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-danger single_delete"><i class="fa fa-times"></i></button>  
                        </td>  
                    </tr>
                    `;
                    i++;
                });
                let checked  = 'checked="checked"';
                if(!activeChartObject.showLabel){
                    checked = ''
                }
                html += `</tbody></table>
                </div>
                <div claass="col-12">
                    <div class="custom-control custom-checkbox mt-2">
                        <input type="checkbox" class="custom-control-input showLabels_box" id="showLabels_box_id" `+checked+`>
                        <label class="custom-control-label" for="showLabels_box_id">Show Chart labels</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label>Label Color</label>
                        <div data-value="`+activeChartObject.get('textColor')+`" class="makeItColorPicker">
                            <div style="height:20px; width :100%;background:`+activeChartObject.get('textColor')+`"></div>
                        </div>
                    </div>
                
                    <div class="col-4 mt-2">
                        <label>Label Font</label>
                        <select id="ChartFontFamily">
                        `+$('#font-family').html()+`
                        </select>
                    </div>
                </div>
                `;
            }
        }

         //If pie Chart here
        if(activeChartObject.chartType=="bar" || activeChartObject.chartType=="line" || activeChartObject.chartType=="area" || activeChartObject.chartType=="area-spline") {
            html += `<div class="row">
                <div class="col-12">
                    <p>Note : All fields are editable. Simply click on any field to update the value.</p>
                <div>
                <div class="col-12 mb-2">
                    <button class="btn btn-success btn-xs add_row">Add Row</button>
                    <button class="btn btn-danger btn-xs delete_row">Delete Row</button> 
                    <button class="btn btn-success btn-xs add_column">Add Column</button>
                    <button class="btn btn-success btn-xs delete_column">Delete Column</button>
                </div>
            `;
            let i = 0;
            if(activeChartObject.chartData.colors) {
                html += `
                <div class="col-12" style="overflow:auto">
                    <table class="table table-bordered mb-0 chart_table">
                    <thead>
                        <tr>    
                            <th style="min-width:100px;">Name</th>
                            <th style="min-width:100px;">Color</th>`;
                            console.log('dsdsf',activeChartObject.chartData.columns);
                            $(activeChartObject.chartData.columns[0]).each(function(index, value){
                                if(index>0){
                                    html += `
                                        <th class="amount_field makeItInput parent_cell" data-value="`+value+`" data-type="type" data-index="`+index+`" style="min-width:100px;">`+value+`</th>
                                    `;
                                }
                            })
                        html +=`<th></th>
                        </tr>
                    </thead>
                    <tbody>
                    `;
                $.each(activeChartObject.chartData.columns,function(index, objvale) {
                    if(index>0) {
                    html += `
                    <tr>
                        <td data-index="`+objvale[0]+`" data-type="text" data-value="`+objvale[0]+`" class="chartLabel parent_cell makeItInput">
                            `+objvale[0]+`
                        </td>
                        <td data-index="`+objvale[0]+`" data-type="picker" data-value="`+activeChartObject.chartData.colors[objvale[0]]+`" class="chartColor makeItInput parent_cell">
                            <div style="height:20px; width :100%;background:`+activeChartObject.chartData.colors[objvale[0]]+`"></div>
                        </td>`;
                        
                        $(activeChartObject.chartData.columns[index]).each(function(index2,value){
                                if(index2 >0){
                                    html += `
                                        <td data-index="`+objvale[0]+`" data-type="number" data-value="`+value+`" class="chartValue parent_cell  makeItInput">
                                            `+value+`
                                        </td>
                                    `;
                                }
                            })
                        
                        html += `<td>
                            <button class="btn btn-xs btn-danger single_delete"><i class="fa fa-times"></i></button>  
                        </td>  
                    </tr>
                    `;
                    i++;
                    }
                });
                let checked  = 'checked="checked"';
                if(!activeChartObject.showLabel){
                    checked = ''
                }
                html += `</tbody>
                </table>
                </div>
                
                <div claass="col-12">
                    <div class="custom-control custom-checkbox mt-2">
                        <input type="checkbox" class="custom-control-input showLabels_box" id="showLabels_box_id" `+checked+`>
                        <label class="custom-control-label" for="showLabels_box_id">Show Grid</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label>Label Color</label>
                        <div data-value="`+activeChartObject.get('textColor')+`" class="makeItColorPicker">
                            <div style="height:20px; width :100%;background:`+activeChartObject.get('textColor')+`"></div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label>Label Font</label>
                        <select id="ChartFontFamily">
                        `+$('#font-family').html()+`
                        </select>
                    </div>
                </div>
                `;
            }
        }

        //If pie Chart here
        if(activeChartObject.chartType=="donut") {
            html += `<div class="row">
                <div class="col-12">
                    <p>Note : All fields are editable. Simply click on any field to update the value.</p>
                <div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Chart Title</label>
                        <input type="text" value="`+activeChartObject.get('chartTitle')+`" class="form-control chartTitle">
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <button class="btn btn-success btn-xs add_row">Add Row</button>
                    <button class="btn btn-danger btn-xs delete_row">Delete Row</button> 
                </div>
            `;
            let i = 0;
            if(activeChartObject.chartData.colors) {
                html += `
                <div class="col-12">
                    <table style="width:auto;" class="table table-bordered mb-0 chart_table">
                    <thead>
                        <tr>    
                            <th style="min-width:130px;">Name</th>
                            <th style="min-width:130px;">Amount</th>
                            <th style="min-width:130px;">Color</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    `;
                Object.keys(activeChartObject.chartData.colors).map(function(objectKey, index) {
                    html += `
                    <tr>
                        <td data-index="`+objectKey+`" data-type="text" data-value="`+objectKey+`" class="chartLabel makeItInput parent_cell">
                            `+objectKey+`
                        </td>
                        <td data-index="`+objectKey+`" data-type="number" data-value="`+activeChartObject.chartData.columns[i][1]+`" class="chartValue makeItInput parent_cell">
                            `+activeChartObject.chartData.columns[i][1]+`
                        </td>
                        <td data-index="`+objectKey+`" data-type="picker" data-value="`+activeChartObject.chartData.colors[objectKey]+`" class="chartColor makeItInput parent_cell">
                            <div style="height:20px; width :100%;background:`+activeChartObject.chartData.colors[objectKey]+`"></div>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-danger single_delete"><i class="fa fa-times"></i></button>  
                        </td>  
                    </tr>
                    `;
                    i++;
                });
                let checked  = 'checked="checked"';
                if(!activeChartObject.showLabel){
                    checked = ''
                }
                html += `</tbody>
                </table>
                </div>
                <div claass="col-12">
                    <div class="custom-control custom-checkbox mt-2">
                        <input type="checkbox" class="custom-control-input showLabels_box" id="showLabels_box_id" `+checked+`>
                        <label class="custom-control-label" for="showLabels_box_id">Show Chart labels</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label>Label Color</label>
                        <div data-value="`+activeChartObject.get('textColor')+`" class="makeItColorPicker">
                            <div style="height:20px; width :100%;background:`+activeChartObject.get('textColor')+`"></div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label>Label Font</label>
                        <select id="ChartFontFamily">
                        `+$('#font-family').html()+`
                        </select>
                    </div>
                </div>
                `;
            }
        }
        $('#editChartModal').modal('show');
        $('#editChartModal').find('.modal-body').html(html);
        $('#editChartModal').find('.modal-body').find('#ChartFontFamily').selectpicker('refresh');
    }
    $('#ChartFontFamily').val(objects[selectedObject].get('fontFamily'));
});

$(document).on('click', '.update_chart', function() {
    var objects = canvas.getObjects();
    var valid = true;
    $.each($('.chartLabel'), function (index1, item1) {
        $.each($('.chartLabel').not(this), function (index2, item2) {
            if ($(item1).data('value') == $(item2).data('value')) {
                $(item1).css("border-color", "red");
                valid = false;
            }

        });
    });
    if(!valid){
        Swal.fire({
            type: 'error',
            title: 'Error!',
            text: "Data labels can't be same value.",
            confirmButtonClass: 'btn btn-confirm mt-2',
        });
        return false;
    }

    var valid = true;
    $.each($('.chartLabel'), function (index1, item1) {
        if($(item1).data('value') ==''){
            $(item1).css("border-color", "red");
            valid = false;
        }
    });

    if(!valid){
        Swal.fire({
            type: 'error',
            title: 'Error!',
            text: "Data labels can't be empty.",
            confirmButtonClass: 'btn btn-confirm mt-2',
        });
        return false;
    }

    $('#editChartModal').modal('hide');
    $('#full_page_loader').removeClass('d-none');
    //If pie Chart here
    if(activeChartObject.chartType=="pie" || activeChartObject.chartType=="donut") {
        let columns = [];
        var colors = {};
        $('.chart_table').find('tbody').find('tr').each(function(){
            columns.push([$(this).find('.chartLabel').data('value'), $(this).find('.chartValue').data('value')])
            colors[$(this).find('.chartLabel').data('value')] = $(this).find('.chartColor').data('value');
        })
        activeChartObject.chartData.columns = columns;
        activeChartObject.chartData.colors = colors;
        show_label = false;
        if($('.showLabels_box').is(':checked')) {
            show_label = true;
        }
        objects[selectedObject].set('textColor',$('.makeItColorPicker').data('value'));
        objects[selectedObject].set('fontFamily',$('#ChartFontFamily').val());
        if(activeChartObject.chartType=="donut") {
            objects[selectedObject].set('chartTitle',$('.chartTitle').val());
        }
        objects[selectedObject].set('chartData',activeChartObject.chartData);
        objects[selectedObject].set('showLabel',show_label);
        updateChart();
    }
    

    //If Bar Chart here
    if(activeChartObject.chartType=="bar" || activeChartObject.chartType=="line") {
        let columns = [];
        var colors = {};
        let tempArray = ['x'];
        $('.chart_table').find('thead').find('.amount_field').each(function(){
            tempArray.push($(this).data('value'));
        })
        columns.push(tempArray);
        $('.chart_table').find('tbody').find('tr').each(function() {
            let tempArray = [$(this).find('.chartLabel').data('value')];
            $(this).find('.chartValue').each(function(){
                tempArray.push($(this).data('value'));
            })
            columns.push(tempArray)
            colors[$(this).find('.chartLabel').data('value')] = $(this).find('.chartColor').data('value');
        })
        activeChartObject.chartData.columns = columns;
        activeChartObject.chartData.colors = colors;
        show_label = false;
        if($('.showLabels_box').is(':checked')){
            show_label = true;
        }
        objects[selectedObject].set('textColor',$('.makeItColorPicker').data('value'));
        objects[selectedObject].set('chartData',activeChartObject.chartData);
        objects[selectedObject].set('showLabel',show_label);
        objects[selectedObject].set('fontFamily',$('#ChartFontFamily').val());
        updateChart(activeChartObject.chartData,show_label);
    }

     //If Bar Chart here
     if(activeChartObject.chartType=="area" || activeChartObject.chartType=="area-spline") {
        let columns = [];
        var colors = {};
        var types = {};
        let tempArray = ['x'];
        $('.chart_table').find('thead').find('.amount_field').each(function(){
            tempArray.push($(this).data('value'));
        })
        columns.push(tempArray);
        $('.chart_table').find('tbody').find('tr').each(function() {
            let tempArray = [$(this).find('.chartLabel').data('value')];
            $(this).find('.chartValue').each(function(){
                tempArray.push($(this).data('value'));
            })
            columns.push(tempArray)
            colors[$(this).find('.chartLabel').data('value')] = $(this).find('.chartColor').data('value');
            types[$(this).find('.chartLabel').data('value')] = activeChartObject.chartType;
        })
        activeChartObject.chartData.columns = columns;
        activeChartObject.chartData.types = types;
        activeChartObject.chartData.colors = colors;
        show_label = false;
        if($('.showLabels_box').is(':checked')) {
            show_label = true;
        }
        objects[selectedObject].set('textColor',$('.makeItColorPicker').data('value'));
        objects[selectedObject].set('chartData',activeChartObject.chartData);
        objects[selectedObject].set('showLabel',show_label);
        objects[selectedObject].set('fontFamily',$('#ChartFontFamily').val());
        updateChart();
    }
    
});


$(document).on('click','.makeItInput', function() {            
    //If pie Chart here
    // if(activeChartObject.chartType=="pie" || activeChartObject.chartType=="bar") {
        let type = $(this).data('type');
        $(this).removeClass('makeItInput');
        let value = $(this).data('value');
        let index = $(this).data('index');
        
        if(type!='picker'){
            $(this).html(`
                <div class="input-group">
                    <input type="`+type+`" value="`+value+`" data-index="`+index+`" style="width:`+$(this).width()+`px" class="checkdatainput">
                </div>
            `);
            $(this).find('input').focus();
        } else {
            let that = this;
            setTimeout(() => {
                $(that).html(`
                    <div class="input-group">
                        <input type="`+type+`" value="`+value+`" data-index="`+index+`" style="width:`+$(this).width()+`px" class="colorinputcheck">
                    </div>
                `);
                var secp = $(this).find('input').spectrum({
                    color: value,
                    showPaletteOnly: true,
                    showPalette:true,
                    palette: colorPlallte,
                    preferredFormat: "hex",
                    allowEmpty:true,
                    hideAfterPaletteSelect:true,
                    change: function(color) {
                        
                    },
                    hide: function (color) {
                        $(that).find('input').spectrum('destroy');
                        let type = $(that).find('input').attr('type');
                        let value = $(that).find('input').val();
                        let index = $(that).find('input').attr('index');
                        $(that).find('input').parents('.parent_cell').data('type',type).data('value',value).data('index',index).addClass('makeItInput');
                        
                        $(that).find('input').parents('.parent_cell').html(`<div style="height:20px; width :100%;background:`+value+`"></div>`)
                        return false;
                    },
                });
                $(that).find("input").spectrum("show");
            }, 200);
        }
    // }
});

$(document).on('click','.makeItColorPicker',function(){
    let value = $(this).data('value');
    $(this).html(`
        <div class="input-group">
            <input type="text" value="`+value+`" style="width:`+$(this).width()+`px">
        </div>
    `);
    let that = this;
    var secp = $(this).find('input').spectrum({
        color: value,
        showPaletteOnly: true,
        showPalette:true,
        palette: colorPlallte,
        preferredFormat: "hex",
        allowEmpty:true,
        hideAfterPaletteSelect:true,
        hide: function (color) {
            $(that).find('input').spectrum('destroy');
            let value = $(that).find('input').val();
            $(that).data('value',value);
            $(that).html(`<div style="height:20px; width :100%;background:`+value+`"></div>`);
            return false;
        },
    });
    $(this).find("input").spectrum("show");
})


$(document).on('focusout','.checkdatainput', function() { 
    converttodiv(this);
});

// $(document).on('change','.colorinputcheck', function() { 
//     converttodiv(this);
// });

function converttodiv(obj){
    //If pie Chart here
    // if(activeChartObject.chartType=="pie" || activeChartObject.chartType=="bar") {         
        let type = $(obj).parents('.parent_cell').find('input').attr('type');
        let value = $(obj).parents('.parent_cell').find('input').val();
        let index = $(obj).parents('.parent_cell').find('input').attr('index');
        $(obj).parents('.parent_cell').data('type',type).data('value',value).data('index',index).addClass('makeItInput');
        if(type!='picker'){
            $(obj).parents('.parent_cell').html(value);
        } else {
            $(obj).parents('.parent_cell').html(`<div style="height:20px; width :100%;background:`+value+`"></div>`)
        }
    // }
}

$(document).on('click','.cancel_value', function() { 
    //If pie Chart here
    // if(activeChartObject.chartType=="pie") {         
        let type = $(this).parents('.parent_cell').data('type');
        let value = $(this).parents('.parent_cell').data('value');
        let index = $(this).parents('.parent_cell').data('index');
        $(this).parents('.parent_cell').data('type',type).data('value',value).data('index',index).addClass('makeItInput');
        if(type!='color'){
            $(this).parents('.parent_cell').html(value);
        } else {
            $(this).parents('.parent_cell').html(`<div style="height:20px; width :100%;background:`+value+`"></div>`)
        }
    // }
});


$(document).on('click','.add_row', function() {
    //If pie Chart here
    $trLast = $('.chart_table').find("tr:last"),
    $trNew = $trLast.clone();     
    $trNew.find('.chartLabel').data('value','no-name-'+$('.chart_table').find('tr').length).data('index','no-name-'+$('.chart_table').find('tr').length).html('no-name-'+$('.chart_table').find('tr').length);

    $trNew.find('.chartValue').data('index','no-name-'+$('.chart_table').find('tr').length);
    let color = getRandomColor();
    $trNew.find('.chartColor').data('index','no-name-'+$('.chart_table').find('tr').length).data('value',color).html('<div style="height:20px; width :100%;background:'+color+'"></div>');
    $trLast.after($trNew);
});

$(document).on('click','.add_column', function() {
    //If pie Chart here
    if(activeChartObject.chartType=="line" || activeChartObject.chartType=="bar") {  
        $thLast = $('.chart_table').find('thead').find('th:nth-last-child(2)');
        $thNew = $thLast.clone();
        $thNew.text($thNew.text()+'2');
        $thLast.after($thNew);
        $('.chart_table').find('tbody').find('tr').each(function() {
            $thLast = $(this).find('td:nth-last-child(2)');
            $thNew = $thLast.clone();
            $thLast.after($thNew);
        });
    }
});

$(document).on('click','.delete_row', function() { 
    if($('.chart_table').find('tbody').find("tr").length>1){
        $('.chart_table').find('tbody').find("tr:last").remove();
    } else {
        Swal.fire({
            type: 'error',
            title: 'Error!',
            text: "At least one row is required.",
            confirmButtonClass: 'btn btn-confirm mt-2',
        });
    } 
});


$(document).on('click','.delete_column', function() { 
    if($('.chart_table').find('thead').find('.amount_field').length>1){
        $('.chart_table').find('thead').find('th:nth-last-child(2)').remove();
        $('.chart_table').find('tbody').find('tr').each(function() {
            $(this).find('td:nth-last-child(2)').remove();
        });
    } else {
        Swal.fire({
            type: 'error',
            title: 'Error!',
            text: "At least one column is required.",
            confirmButtonClass: 'btn btn-confirm mt-2',
        });
    }
});

$(document).on('click','.single_delete', function() { 
    if($('.chart_table').find('tbody').find("tr").length>1){
        $(this).parents('tr').remove();
    } else {
        Swal.fire({
            type: 'error',
            title: 'Error!',
            text: "At least one row is required.",
            confirmButtonClass: 'btn btn-confirm mt-2',
        });
    } 
});

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getRandomString() {
    var letters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    var color = '';
    for (var i = 0; i < 15; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

$('#editChartModal').on('shown.bs.modal', function () {
    chartEditing = true;
})

$('#editChartModal').on('hidden.bs.modal', function () {
    chartEditing = false;
})

$(document).on('keyup', 'input', function(event){
   // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        $(this).blur();
    }
})

function openNav() {
    $('body').addClass('overflowhidden');
    document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
    $('body').removeClass('overflowhidden');
    document.getElementById("myNav").style.height = "0%";
}

$('.cus-drop').on('click', function(){
    $(this).toggleClass('show');
    $(this).parents('.my-drop').siblings('.my-drop').find('.cus-drop').removeClass('show');
    $(this).next('.my-data').slideToggle();
    $(this).parents('.my-drop').siblings('.my-drop').find('.my-data').slideUp();
});

var secp = $('#backgroundColor').spectrum({
    color: $('#backgroundColor').val(),
    showPaletteOnly: true,
    showPalette:true,
    palette: colorPlallte,
    preferredFormat: "hex",
    allowEmpty:true,
    hideAfterPaletteSelect:true,
    hide :function(color) {
        canvas.backgroundImage = null;
        canvas.setBackgroundColor($('#backgroundColor').val(), canvas.renderAll.bind(canvas));
        privew();
    }
});

var secp = $('#text-bgcolor').spectrum({
    color: $('#text-bgcolor').val(),
    showPaletteOnly: true,
    showPalette:true,
    palette: colorPlallte,
    preferredFormat: "hex",
    allowEmpty:true,
    hideAfterPaletteSelect:true,
    hide :function(color) {
        // canvas.backgroundImage = null;
        // canvas.backgroundColor = color;
        // canvas.renderAll();
    }
});

var secp = $('#text-color').spectrum({
    color: $('#text-color').val(),
    showPaletteOnly: true,
    showPalette:true,
    palette: colorPlallte,
    preferredFormat: "hex",
    allowEmpty:true,
    hideAfterPaletteSelect:true,
    hide :function(color) {

    }
});

var secp = $('#shape-fill').spectrum({
    color: $('#shape-fill').val(),
    showPaletteOnly: true,
    showPalette:true,
    palette: colorPlallte,
    preferredFormat: "hex",
    allowEmpty:true,
    hideAfterPaletteSelect:true,
    hide :function(color) {
        canvas.getActiveObject().set('fill',$('#shape-fill').val());
        canvas.renderAll();
    }
});
var secp = $('#shape-stroke-color').spectrum({
    color: $('#shape-stroke-color').val(),
    showPaletteOnly: true,
    showPalette:true,
    palette: colorPlallte,
    preferredFormat: "hex",
    allowEmpty:true,
    hideAfterPaletteSelect:true,
    hide :function(color) {
        canvas.getActiveObject().set('stroke',$('#shape-stroke-color').val());
        canvas.renderAll();
    }
});


$('.upload-svg-btn').on('click', function(){
    $('#upload_svg_file').click();
});

// file upload
// var span = document.querySelector('#upload_svg_file');
// span.onchange = function(e) {
//     var tempurl = e.target.value;
//     var ext = tempurl.substring(tempurl.lastIndexOf('.') + 1).toLowerCase();
//     if (e.target.files && e.target.files[0] && (ext == "svg")) {
//         var file = e.target.files[0];
//         var reader = new FileReader();
//         reader.onload = function(file) {
//             addSvgFile(file.target.result);
//         }
//         reader.readAsDataURL(file);
//     } else {
//         Swal.fire({
//             type: 'error',
//             title: 'Error!',
//             text: 'Please select a valid SVG file.',
//             confirmButtonClass: 'btn btn-confirm mt-2',
//         });
//     }
// }


function addSvgFile(url) {
    fabric.loadSVGFromURL(url, function(objects, options) {
        var shape = fabric.util.groupSVGElements(objects, options);
        shape.opacity = 1;
        shape.scaleToHeight(150);
        shape.scaleToWidth(150);
        canvas.add(shape);
        canvas.setActiveObject(shape);
    });
}

$(document).on('click', '.canvas_content', function() {
    slide_button_each();
    if(activeSlide!=$(this).parents('.my-slide').index()) {
        if(!isLoadingJSON) {
            $(this).parents('.my-slide').addClass('active').siblings().removeClass('active');
            $('.spinner-loader-div').show();
            isLoadingJSON = true;
            var self = $(this);
            setTimeout(function() {
                activeSlide = self.parents('.my-slide').index();
                $('#slide_title_each').val(AllSlides[activeSlide]['title']);
                canvas.loadFromJSON(AllSlides[activeSlide]['slide_json'], function() {
                    canvas.renderAll();
                    $('.spinner-loader-div').hide();
                    $('#notes_here').val(AllSlides[activeSlide]['notes']);
                    lockObjectMovements();
                    isLoadingJSON = false;
                    privew();
                });  
            },1500)
        }
    }
});

$(document).on('change, keyup', '#slide_title_each', function() {
    AllSlides[activeSlide]['title'] = $('#slide_title_each').val();
});

$(document).on('change, blur', '#slide_title_each', function() {
    updateText();
});

function updateText() {
    //First Slide
    if(activeSlide==0) {
        $('.recent-slides').find('.my-slide:first').find('.h5-heading').text(AllSlides[activeSlide]['title']);
    } 
    //Last Slide
    else if(activeSlide == AllSlides.length-1) {
        $('.recent-slides').find('.my-slide:last').find('.h5-heading').text(AllSlides[activeSlide]['title']);
    } 
    //other Slides
    else {
        $('.recent-slides').find('.my-slide:nth('+parseInt(activeSlide)+')').find('.h5-heading').text(AllSlides[activeSlide]['title']);
    }
}

$(document).on('change, keyup', '#notes_here', function() {
    console.log('notes_here');
    AllSlides[activeSlide]['notes'] = $('#notes_here').val();
});

function slide_button_each(gotoNext = null) {
    var data = new FormData();
    if(AllSlides[activeSlide] != undefined) {
        Object.entries(AllSlides[activeSlide]).forEach(
            ([key, value]) => {
                data.append(key, value); 
            }
        );
        // l = Ladda.create( document.querySelector('.slide_button_each' ) );
        $.ajax({
            type: "POST",
            url: $('#update_slide_url').val(),
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                // l.start();
            },
            success: function(data) {
                if(gotoNext != null) {
                    window.location = gotoNext;    
                }
                if (data.status == 2) {
                    Swal.fire({
                        type: 'error',
                        title: 'Error!',
                        text: data.error,
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                } else if (data.status == 1) {
                    privew();
                }
            },
            error: function(res) {
                // l.stop();
                var error = res.responseJSON.message;
                if (error == "") {
                    error = res.responseJSON.exception;
                }
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: error,
                    confirmButtonClass: 'btn btn-confirm mt-2',
                });
            },
            complete: function() {
                // l.stop();
            },
        });
    }
}

$(document).on('click', '.delete_slide', function() {
    if($('.delete_slide').length>1) {
        Swal.fire({
            title: 'Delete Slide ?',
            text: "Are you sure want you to delete this slide?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1c93d6',
            cancelButtonColor: '#f1556c',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.value) {
                var id = $(this).data('id');
                var slide_index = $(this).parents('.my-slide').index();
                AllSlides.splice(slide_index,1);
                if($(this).parents('.my-slide').hasClass('active')) {
                    $(this).parents('.my-slide').remove();
                    $('.my-slide:first').find('.canvas_content').trigger('click');
                } else {
                    $(this).parents('.my-slide').remove();
                }
                let index = 1;
                $('.counter_span').each(function(){
                    $(this).text(index++);
                });
                //Delete the slide from server side
                $.ajax({
                    type: "POST",
                    url: $('#delete_slide_url').val(),
                    data: { slide_id : id },
                    success: function (data) {
                        if (data.status == 2) {
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: data.message,
                                confirmButtonClass: 'btn btn-confirm mt-2',
                            }).then( x=>{
                                window.location.reload();
                            });
                        }
                        else if (data.status == 1) {
                            
                        } 
                    },
                    error: function (res) {
                        $("#full_page_loader").addClass('d-none');
                        var error = res.responseJSON.message;
                        if(error == "") {
                            error = res.responseJSON.exception;
                        }
                        Swal.fire({
                            type: 'error',
                            title: 'Error!',
                            text: error,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                        }).then( x=>{
                            window.location.reload();
                        });
                    }
                });      
            }
        })
    } else {
        Swal.fire({
            type: 'error',
            title: 'Error!',
            text: 'At least one slide required in a project.',
            confirmButtonClass: 'btn btn-confirm mt-2',
        });
    }
});

function activeSelectedObject(){
    var activeObj = canvas.getActiveObject();
    if(activeObj){
        let index = canvas.getObjects().indexOf(activeObj);
        $('.elements[data-index="'+index+'"]').parents('.collapse').collapse('show');
        $('.activeObject').removeClass('activeObject');
        $('.objectStatus[data-index="'+index+'"]').addClass('activeObject');
    }
}