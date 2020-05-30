var modules = {};
function initDrawing(){
    ! function(a) {
        a(document).ready(function() {
            function o(a) {
                return void 0 !== window.ontouchstart && u[a] && (a = u[a]), a
            }

            function e(a) {
                return a.originalEvent.changedTouches ? {
                    pageX: a.originalEvent.changedTouches[0].pageX,
                    pageY: a.originalEvent.changedTouches[0].pageY
                } : {
                    pageX: a.pageX,
                    pageY: a.pageY
                }
            }

            function n() {
                l.$canvas.drawRect({
                    fillStyle: "transparent",
                    x: 0,
                    y: 0,
                    width: l.canvasW,
                    height: l.canvasH,
                    fromCenter: !1
                })
            }

            function s(a) {
                l.$canvas.clearCanvas(), l.$canvas.drawImage({
                    source: a,
                    x: 0,
                    y: 0,
                    width: l.canvasW,
                    height: l.canvasH,
                    fromCenter: !1
                })
            }

            modules.color = function c(color) {
                l.color = "#"+color
            }

            function r(a) {
                var o = d.slider.width();
                d.slider.children("#filler").width(o * (a / 100))
            }
            var i, l = {
                    $canvas: a("#draw-signature"),
                    color: "000000",
                    press: !1,
                    last: new Image,
                    hist: [],
                    undoHist: [],
                    clicks: 0,
                    start: !1
                },
                d = {
                    box: a("#box"),
                    tools: a("#tools"),
                    clear: a("#clear"),
                    slider: a("#slider"),
                    undo: a("#undo")
                },
                u = {
                    mousedown: "touchstart",
                    mouseup: "touchend",
                    mousemove: "touchmove"
                };
            l.getTouchEventName = o, l.getPageCoords = e, l.clearCanvas = n;
            d.clear.on("click", function() {
                    l.$canvas.trigger("mouseup"), l.last.src = l.$canvas[0].toDataURL("image/png"), l.hist.push(l.last.src), n(), l.clicks = 0, l.$canvas.clearCanvas()
                }), d.undo.on("click", function() {
                    l.$canvas.mouseup(), l.hist.length > 0 && (l.clicks = 0, l.undoHist.push(l.$canvas[0].toDataURL("image/png")), s(l.hist.pop()))
                }), l.$canvas.brushTool(l), modules.color(l.color), d.slider.slider({
                    min: 1,
                    value: 50
                });
            var p = d.slider.slider("option", "value");
            r(p), l.stroke = 5, modules.stroke = function updateStroke(width) {
                    l.stroke = width
                },
                function() {
                    var a = l.$canvas.getCanvasImage("image/png");
                    l.canvasW = l.$canvas.attr("width"), l.canvasH = l.$canvas.attr("height"), l.$canvas.prop({
                        width: l.canvasW,
                        height: l.canvasH
                    }), l.$canvas.detectPixelRatio(), a.length > 10 && l.$canvas.drawImage({
                        source: a,
                        x: 0,
                        y: 0,
                        width: l.canvasW,
                        height: l.canvasH,
                        fromCenter: !1
                    })
                }(), n()
        })
    }(jQuery);
    ! function(e) {
        e.fn.brushTool = function(e) {
            var t = this,
            tOffset = t.offset();
            t.unbind(), e.clicks = 0;
            var o, n, a, r, s = function() {
                t.drawLine({
                    strokeWidth: e.stroke,
                    strokeStyle: e.color,
                    rounded: true,
                    strokeCap: "round",
                    strokeJoin: "round",
                    x1: o,
                    y1: n,
                    x2: a,
                    y2: r
                })
            };
            t.on(e.getTouchEventName("mousedown"), function(s) {
                if (e.hist.push(e.last.src = t[0].toDataURL("image/png")), e.undoHist.length = 0, !0 === e.press && (e.clicks = 0), 0 === e.clicks) {
                    e.drag = !0;
                    var c = e.getPageCoords(s);
                    o = c.pageX - tOffset.left, n = c.pageY - tOffset.top, a = o, r = n, t.drawArc({
                        fillStyle: e.color,
                        x: o,
                        y: n,
                        radius: e.stroke / 2,
                        start: 0,
                        end: 360
                    }), e.clicks += 1
                }
                s.preventDefault()
            }), t.on(e.getTouchEventName("mouseup"), function(o) {
                e.drag = !1, e.last.src = t[0].toDataURL("image/png"), e.clicks = 0, o.preventDefault()
            }), t.on(e.getTouchEventName("mousemove"), function(t) {
                if (!0 === e.drag && e.clicks >= 1) {
                    o = a, n = r;
                    var c = e.getPageCoords(t);
                    a = c.pageX - tOffset.left, r = c.pageY - tOffset.top, s()
                }
                t.preventDefault()
            })
        }
    }(jQuery);
}

