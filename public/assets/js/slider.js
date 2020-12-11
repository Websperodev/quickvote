function fabricInt(){
    canvasObject = $("canvas")[0];
    fabric.Object.prototype.transparentCorners = false;
    fabric.Object.prototype.padding = 5;
    // var $ = function(id){return document.getElementById(id)};
    canvas = this.__canvas = new fabric.Canvas('c');
    canvas.setHeight(280);
    canvas.setWidth(620);
    canvasConatiner = $('.box')[0];
    images = document.querySelectorAll('.moveObject');
    [].forEach.call(images, function(img) {
        img.addEventListener('dragstart', handleDragStart, false);
        img.addEventListener('dragend', handleDragEnd, false);
    });
    canvasConatiner.addEventListener('dragenter', handleDragEnter, false);
    canvasConatiner.addEventListener('dragover', handleDragOver, false);
    canvasConatiner.addEventListener('dragleave', handleDragLeave, false);
    canvasConatiner.addEventListener('drop', handleDrop, false);
    canvas.on('selection:created', itemSelected);
    canvas.on('selection:updated', itemSelected);
    canvas.on('selection:cleared', itemDeSelected);
}

function itemSelected(e) {
    if (canvas.getActiveObject().get('type') == 'i-text') {
        if (canvas.getActiveObject().get('textBackgroundColor')) {
            $(".text-bgcolor-class").css("border-bottom", "5px solid " + canvas.getActiveObject().get('textBackgroundColor'));
        }
        if (canvas.getActiveObject().get('fill')) {
            $(".text-color-class").css("border-bottom", "5px solid " + canvas.getActiveObject().get('fill'));
        }
        showTextEditorToolBar();
    } else {
        hideTextEditorToolBar();
    }
    showactionsButtonsCommonToolBar();
}

function itemDeSelected(e) {
    hideTextEditorToolBar();
    hideactionsButtonsCommonToolBar();
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

function handleDrop(e) {
    e = e || window.event;
    if (e.preventDefault) {
        e.preventDefault();
    }
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    var droppedObject = document.querySelector('.img_dragging');
    switch ($(droppedObject).data('action')) {
        case 'font':
            addFont(droppedObject, e);
            break;
        case 'img':
            addImg(droppedObject, e);
            break;
        case 'shape':
            addShape(droppedObject, e);
            break;
        case 'svg':
            addSvg(droppedObject, e);
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
    var y = event.clientY - (offset.top + imageOffsetY);
    var x = event.clientX - (offset.left + imageOffsetX);
    canvas.add(new fabric.IText($(droppedObject).data('text'), {
        left: x,
        top: y,
        fontFamily: 'Arial',
        fontSize: $(droppedObject).data('size')
    }));
    // canvas.add(newImage);
}

function addImg(droppedObject, event) {
    var offset = $(canvasObject).offset();
    var y = event.clientY - (offset.top + imageOffsetY);
    var x = event.clientX - (offset.left + imageOffsetX);
    var newImage = new fabric.Image(droppedObject, {
        left: x,
        top: y
    });
    canvas.add(newImage);
}

function addSvg(droppedObject, event) {
    var offset = $(canvasObject).offset();
    var y = event.clientY - (offset.top + imageOffsetY);
    var x = event.clientX - (offset.left + imageOffsetX);
      // locked, flipped
    fabric.loadSVGFromURL($(droppedObject).attr('src'), function(objects, options) {
        var shape = fabric.util.groupSVGElements(objects, options);
        shape.set({
            left: x,
            top: y
        }).scale(0.25);
        shape.opacity = 1;
        canvas.add(shape);
      });
}


function addShape(dropppedObject, event) {
    var shape;
    var offset = $(canvasObject).offset();
    var y = event.clientY - (offset.top + imageOffsetY);
    var x = event.clientX - (offset.left + imageOffsetX);
    switch ($(dropppedObject).data('name')) {
        case 'circle':
            shape = new fabric.Circle({
                top: y,
                left: x,
                radius: 50,
                fill: '',
                stroke: 'black',
                strokeWidth: 2
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
                strokeWidth: 2
            });
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
            var emerald = [{
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
}

window.addEventListener("keydown", function(e) {
    console.log('e', e);
    if (e.keyCode === 46 && document.activeElement !== 'text') {
        e.preventDefault();
        deleteSelectedObject();
    }
});


//Background Imgaes
document.getElementById('backgroundImage').addEventListener("change", function(e) {
    console.log("backgroundImage :",e)
    var file = e.target.files[0];
    var reader = new FileReader();
    reader.onload = function(f) {
        var data = f.target.result;
        fabric.Image.fromURL(data, function(img) {
            // Add background image
            // canvas.backgroundColor = null;
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                scaleX: canvas.width / img.width,
                scaleY: canvas.height / img.height,
                opacity: $('#rangeSelect').prop('value')
            });
            canvas.renderAll();
        });
    };
    reader.readAsDataURL(file);
});


document.getElementById('backgroundColor').addEventListener("change", function(e) {
    canvas.backgroundImage = null;
    canvas.backgroundColor = e.target.value;
    canvas.renderAll();
});

$("#rangeSelect").ionRangeSlider({
    skin: "sharp",
    min: 0,
    max: 1,
    from: 0.5,
    step: 0.1,
    onChange: function(data) {
        if (canvas.backgroundImage) {
            canvas.backgroundImage.opacity = $('#rangeSelect').prop('value');
        } else {
            canvas.backgroundColor.opacity = $('#rangeSelect').prop('value');
        }
        canvas.renderAll();
    },
});

$(document).on('click', '.text-action', function() {
    var type = $(this).data('action');
    var value = $(this).data('value');
    applytextactions(type, value);
})

$(document).on('change', '#font-family', function() {
    var value = $(this).val();
    applytextactions('fontFamily', value);
})

$(document).on('change', '#text-bgcolor', function() {
    var value = $(this).val();
    console.log('value', value);
    $(".text-bgcolor-class").css("border-bottom", "5px solid " + value);
    applytextactions('textBackgroundColor', value);
})

$(document).on('change', '#text-color', function() {
    var value = $(this).val();
    console.log('value', value);
    $(".text-color-class").css("border-bottom", "5px solid " + value);
    applytextactions('fill', value);
})


function showTextEditorToolBar() {
    $('.texteditortollbar').show();
}

function hideTextEditorToolBar() {
    $('.texteditortollbar').hide();
}

function showactionsButtonsCommonToolBar() {
    $('.actionsButtonsCommon').show();
}

function hideactionsButtonsCommonToolBar() {
    $('.actionsButtonsCommon').hide();
}

function applytextactions(type, value) {
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
    canvas.renderAll();
}

document.getElementById('copyButton').addEventListener("click", function(e) {
    // clone what are you copying since you
    // may want copy and paste on different moment.
    // and you do not want the changes happened
    // later to reflect on the copy.
    canvas.getActiveObject().clone(function(cloned) {
        _clipboard = cloned;
    });
});

document.getElementById('pasteButton').addEventListener("click", function(e) {
    // clone again, so you can do multiple copies.
    _clipboard.clone(function(clonedObj) {
        canvas.discardActiveObject();
        clonedObj.set({
            left: clonedObj.left + 10,
            top: clonedObj.top + 10,
            evented: true,
        });
        if (clonedObj.type === 'activeSelection') {
            // active selection needs a reference to the canvas.
            clonedObj.canvas = canvas;
            clonedObj.forEachObject(function(obj) {
                canvas.add(obj);
            });
            // this should solve the unselectability
            clonedObj.setCoords();
        } else {
            canvas.add(clonedObj);
        }
        _clipboard.top += 10;
        _clipboard.left += 10;
        canvas.setActiveObject(clonedObj);
        canvas.requestRenderAll();
    });
});

function deleteSelectedObject() {
    var activeGroup = canvas.getActiveObject();
    if (activeGroup._objects != undefined) {
        var activeObjects = activeGroup.getObjects();
        for (let i in activeObjects) {
            canvas.remove(activeObjects[i]);
        }
        canvas.discardActiveObject();
        canvas.renderAll()
    } else canvas.remove(canvas.getActiveObject());
}

$('.refresh_slides').click(function(){
    console.log(JSON.stringify(canvas))
    $('#slide_preview').html(canvas.toSVG());
})

$('.add_slide_js').click(function(){
    var jsonstring = JSON.stringify(canvas);
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
    console.log("canvasArr :",canvasArr);
})