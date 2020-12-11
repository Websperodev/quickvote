fabric.List = fabric.util.createClass(fabric.Textbox, fabric.Observable, {
    type: "list",
    style: "number",
    bullet: "●",
    uppercase: !0,
    initialize: function(t, e) {
        this.callSuper("initialize", t, e);
        this.setCusText();
    },
    setCusText: function() {
        this.set('previous_value', this.text);
        let lines = this.text.split('\n');
        let temp = [];
        let i = 0;
        lines.forEach(l => {
            temp.push(this.getBulletValue(i) + " " + l);
            i++;
        })
        this.text = temp.join('\n');
    },
    getBulletValue: function(t) {
        var e = t + 1 + ".";
        if ("alphabet" == this.style) {
            for (var i = "", s = !0; s;) {
                var r = t - 26 * Math.floor(t / 26);
                i = String.fromCharCode(65 + r) + i, (t = Math.floor(t / 26) - 1) < 0 && (s = !1)
            }
            return e = this.uppercase ? i.toUpperCase() + "." : i.toLowerCase() + "."
        }
        return "bullet" == this.style ? this.bullet : e
    },
    enterEditing: function(t) {
        this.callSuper("enterEditing", t);
        this.text = this.get('previous_value');
        this.hiddenTextarea.value = this.get('previous_value');
    },
    exitEditing: function(t) {
        this.callSuper("exitEditing", t);
        this.setCusText();
    },
    toObject: function(t) {
        return fabric.util.object.extend(this.callSuper("toObject"), {
            style: this.style,
            bullet: this.bullet,
            uppercase: this.uppercase,
            text: this.get('previous_value')
        })
    },
});
fabric.List.fromObject = function(object, callback) {
    callback && callback(new fabric.List(object.text, object));
};
//Chart start here
fabric.Chart = fabric.util.createClass(fabric.Group, fabric.Observable, {
    lockUniScaling: true,
    type: 'chart',
    chartData: {},
    chartType: 'pie',
    showLabel: true,
    textColor: '#000',
    chartTitle: 'Dummy Chart',
    fontFamily: 'Arial',
    initialize: function(t, e) {
        let that = this;
        this.chartData = e.chartData;
        this.chartType = e.chartType;
        this.showLabel = (e.showLabel != undefined) ? e.showLabel : true;
        this.textColor = (e.textColor != undefined) ? e.textColor : '#000';
        this.chartTitle = (e.chartTitle != undefined) ? e.chartTitle : 'Dummy Chart';
        this.fontFamily = (e.fontFamily != undefined) ? e.fontFamily : 'Arial';
        this.callSuper('initialize', t, e);
    },
    updateChart: function(obj) {
        var preiviousValues = {
            top: this.get('top'),
            left: this.get('left'),
            scaleX: this.get('scaleX'),
            scaleY: this.get('scaleY'),
            aCoords: this.get('aCoords'),
            flipX: this.get('flipX'),
            flipY: this.get('flipY'),
            skewX: this.get('skewX'),
            skewY: this.get('skewY'),
            zoomX: this.get('zoomX'),
            zoomY: this.get('zoomY'),
            matrixCache: this.get('matrixCache'),
            oCoords: this.get('oCoords'),
        }
        let that = this;
        $.each(this.getObjects(), function(index, value) {
            that.remove(value);
        });
        that.addWithUpdate(obj);
        that.moveTo(obj, 0);
        Object.keys(preiviousValues).map(function(objectKey, index) {
            that.set(objectKey, preiviousValues[objectKey]);
        });
        canvas.renderAll();
    },
    toObject: function(t) {
        let temp = fabric.util.object.extend(this.callSuper("toObject"), {
            chartData: this.chartData,
            chartType: this.chartType,
            showLabel: this.showLabel,
            textColor: this.textColor,
            chartTitle: this.chartTitle,
            fontFamily: this.fontFamily,
        });
        return temp;
    }
});
fabric.Chart.fromObject = function(object, callback) {
    var _enlivenedObjects;
    fabric.util.enlivenObjects(object.objects, function(enlivenedObjects) {
        delete object.objects;
        _enlivenedObjects = enlivenedObjects;
        callback(new fabric.Chart(_enlivenedObjects, object));
    });
};
fabric.Heading = fabric.util.createClass(fabric.Textbox, fabric.Observable, {
    type: "heading",
    initialize: function(t, e) {
        this.callSuper("initialize", t, e);
    },
    toObject: function(t) {
        return fabric.util.object.extend(this.callSuper("toObject"), {})
    },
});
fabric.Heading.fromObject = function(object, callback) {
    callback && callback(new fabric.Heading(object.text, object));
};
fabric.Paragraph = fabric.util.createClass(fabric.Textbox, fabric.Observable, {
    type: "paragraph",
    initialize: function(t, e) {
        this.callSuper("initialize", t, e);
    },
    toObject: function(t) {
        return fabric.util.object.extend(this.callSuper("toObject"), {})
    },
});
fabric.Paragraph.fromObject = function(object, callback) {
    callback && callback(new fabric.Paragraph(object.text, object));
};