!(function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : "undefined" != typeof exports ? (module.exports = e(require("jquery"))) : e(jQuery);
})(function (e) {
    "use strict";
    var t = window.EasyWheel || {};
    ((t = function (t, r) {
        var n,
            o = this;
        (o.defaults = {
            items: [
                { name: "Win", color: "#3498db" },
                { name: "Lose", color: "#ffc107" },
            ],
            width: 400,
            fontSize: 14,
            textOffset: 8,
            textLine: "h",
            textArc: !1,
            letterSpacing: 0,
            textColor: "#fff",
            centerWidth: 45,
            shadow: "#fff0",
            shadowOpacity: 0,
            centerLineWidth: 5,
            centerLineColor: "#424242",
            centerBackground: "#8e44ad",
            sliceLineWidth: 5,
            sliceLineColor: "#424242",
            selectedSliceColor: "#333",
            outerLineColor: "#424242",
            outerLineWidth: 5,
            centerImage: "",
            centerHtml: "",
            centerHtmlWidth: 45,
            centerImageWidth: 45,
            rotateCenter: !1,
            centerClass: "",
            button: "",
            easing: "easyWheel",
            markerAnimation: !0,
            markerColor: "#CC3333",
            selector: !1,
            selected: !1,
            random: !1,
            type: "spin",
            duration: 8e3,
            rotates: 8,
            max: 0,
            frame: 6,
            ajax: null,
            onStart: function (e, t, r) {},
            onStep: function (e, t, r) {},
            onProgress: function (e, t, r) {},
            onComplete: function (e, t, r) {},
            onFail: function (e, t, r) {},
        }),
            (n = e(t).data("easyWheel") || {}),
            (o.o = e.extend({}, o.defaults, r, n)),
            (o.initials = {
                slice: { id: null, results: null },
                currentSliceData: { id: null, results: null },
                winner: 0,
                rotates: parseInt(o.o.rotates),
                spinCount: 0,
                counter: 0,
                now: 0,
                resetCount: 0,
                currentSlice: 0,
                currentStep: 0,
                lastStep: 0,
                slicePercent: 0,
                circlePercent: 0,
                items: o.o.items,
                spinning: !1,
                inProgress: !1,
                nonce: null,
                $wheel: e(t),
            }),
            e.extend(o, o.initials),
            e.extend(e.easing, {
                easyWheel: function (e, t, r, n, o) {
                    return -n * ((t = t / o - 1) * t * t * t - 1) + r;
                },
            }),
            e.extend(e.easing, {
                easeOutQuad: function (e, t, r, n, o) {
                    return -n * (t /= o) * (t - 2) + r;
                },
            }),
            e.extend(e.easing, {
                MarkerEasing: function (e) {
                    var t = 1 - Math.pow(1 - 6 * e, 2);
                    return t < 0 && (t = 0), t;
                },
            }),
            (o.instanceUid = "ew" + o.guid()),
            o.validate(),
            o.init();
    }).prototype.validate = function (t) {
        var r = this;
        r.rotates < 1 && ((r.rotates = 1), console.log("warning", 'Min number of rotates is "1"')),
            parseInt(r.o.sliceLineWidth) > 10 && ((r.o.sliceLineWidth = 10), console.log("warning", 'Max sliceLineWidth is "10"')),
            parseInt(r.o.centerLineWidth) > 10 && ((r.o.centerLineWidth = 10), console.log("warning", 'Max centerLineWidth is "10"')),
            parseInt(r.o.outerLineWidth) > 10 && ((r.o.outerLineWidth = 10), console.log("warning", 'Max outerLineWidth is "10"')),
            void 0 === e.easing[e.trim(r.o.easing)] && (r.o.easing = "easyWheel");
    }),
        (t.prototype.destroy = function (t) {
            var r = this;
            r.spinning && r.spinning.finish(),
                "boolean" == typeof t && !0 === t && r.$wheel.html("").removeClass(r.instanceUid),
                e.extend(r.o, r.defaults),
                e.extend(r, r.initials),
                e(document).off("click." + r.instanceUid),
                e(document).off("resize." + r.instanceUid);
        }),
        (t.prototype.option = function (t, r) {
            if (-1 === e.inArray(typeof r, ["undefined", "function"]) && -1 === e.inArray(typeof this.o[t], ["undefined", "function"])) {
                -1 != e.inArray(t, ["easing", "type", "duration", "rotates", "max"]) && (this.o[t] = r);
            }
        }),
        (t.prototype.finish = function () {
            this.spinning && this.spinning.finish();
        }),
        (t.prototype.init = function () {
            this.initialize(), this.execute();
        }),
        (t.prototype.initialize = function () {
            var t = this;
            t.$wheel.addClass("easyWheel " + t.instanceUid);
            var r = 360 / t.totalSlices(),
                n = 0,
                o = 0;
            t.$wheel.html("");
            var i = e("<div/>").addClass("eWheel-wrapper").appendTo(t.$wheel),
                a = e("<div/>").addClass("eWheel-inner").appendTo(i),
                s = e("<div/>").addClass("eWheel").prependTo(a),
                l = e("<div/>").addClass("eWheel-bg-layer").appendTo(s),
                c = e(
                    t.SVG("svg", {
                        version: "1.1",
                        xmlns: "http://www.w3.org/2000/svg",
                        "xmlns:xlink": "http://www.w3.org/1999/xlink",
                        x: "0px",
                        y: "0px",
                        viewBox: "0 0 200 200",
                        "xml:space": "preserve",
                        style: "enable-background:new 0 0 200 200;",
                    })
                );
            c.appendTo(l);
            var d = e("<g/>"),
                p = e("<g/>");
            if ((d.addClass("ew-slicesGroup").appendTo(c), "string" == typeof t.o.shadow && "" !== e.trim(t.o.shadow))) {
                var h = e(t.SVG("radialGradient", { id: "SVGID_1_", cx: "50%", cy: "50%", r: "50%", gradientUnits: "userSpaceOnUse" })).appendTo(c),
                    u =
                        t.SVG("stop", { offset: "0.1676", style: "stop-color:" + t.o.shadow + ";stop-opacity:1" }).outerHTML +
                        t.SVG("stop", { offset: "0.5551", style: "stop-color:" + t.o.shadow + ";stop-opacity:1" }).outerHTML +
                        t.SVG("stop", { offset: "0.6189", style: "stop-color:" + t.o.shadow + ";stop-opacity:1" }).outerHTML +
                        t.SVG("stop", { offset: "1", style: "stop-color:" + t.o.shadow + ";stop-opacity:0" }).outerHTML;
                e(u).appendTo(h), e(t.SVG("circle", { cx: "50%", cy: "50%", r: "50%", "stroke-width": "0", "fill-opacity": parseInt(t.o.shadowOpacity) < 9 ? "0." + parseInt(t.o.shadowOpacity) : 1, fill: "url(#SVGID_1_)" })).appendTo(c);
            }
            if ((p.appendTo(c), "v" === t.o.textLine || "vertical" === t.o.textLine)) {
                var f = e("<div/>");
                f.addClass("eWheel-txt-wrap"), f.appendTo(s);
                var g = e("<div/>");
                g.addClass("eWheel-txt"),
                    g.css({
                        "-webkit-transform": "rotate(" + (-360 / t.totalSlices() / 2 + t.getDegree()) + "deg)",
                        "-moz-transform": "rotate(" + (-360 / t.totalSlices() / 2 + t.getDegree()) + "deg)",
                        "-ms-transform": "rotate(" + (-360 / t.totalSlices() / 2 + t.getDegree()) + "deg)",
                        "-o-transform": "rotate(" + (-360 / t.totalSlices() / 2 + t.getDegree()) + "deg)",
                        transform: "rotate(" + (-360 / t.totalSlices() / 2 + t.getDegree()) + "deg)",
                    }),
                    g.appendTo(f);
            } else {
                var m = e("<g/>"),
                    w = e("<defs/>");
                w.appendTo(c), m.appendTo(c);
            }
            var y = e("<div/>");
            if (
                (y.addClass("eWheel-center"),
                y.addClass(t.o.centerClass),
                y.appendTo(!0 === t.o.rotateCenter || "true" === t.o.rotateCenter ? s : a),
                "string" == typeof t.o.centerHtml && "" === e.trim(t.o.centerHtml) && "string" == typeof t.o.centerImage && "" !== e.trim(t.o.centerImage))
            ) {
                var v = e("<img />");
                parseInt(t.o.centerImageWidth) || (t.o.centerImageWidth = parseInt(t.o.centerWidth)),
                    v.css("width", parseInt(t.o.centerImageWidth) + "%"),
                    v.attr("src", t.o.centerImage),
                    v.appendTo(y),
                    y.append('<div class="ew-center-empty" style="width:' + parseInt(t.o.centerImageWidth) + "%; height:" + parseInt(t.o.centerImageWidth) + '%" />');
            }
            if ("string" == typeof t.o.centerHtml && "" !== e.trim(t.o.centerHtml)) {
                var S = e('<div class="ew-center-html">' + t.o.centerHtml + "</div>");
                parseInt(t.o.centerHtmlWidth) || (t.o.centerHtmlWidth = parseInt(t.o.centerWidth)), S.css({ width: parseInt(t.o.centerHtmlWidth) + "%", height: parseInt(t.o.centerHtmlWidth) + "%" }), S.appendTo(y);
            }
            "color" !== e.trim(t.o.type) &&
                e("<div/>")
                    .addClass("eWheel-marker")
                    .appendTo(i)
                    .append(
                        '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 80 115" style="enable-background:new 0 0 80 115;" xml:space="preserve"><g><path fill="' +
                            t.o.markerColor +
                            '" d="M40,0C17.9,0,0,17.7,0,39.4S40,115,40,115s40-53.9,40-75.6S62.1,0,40,0z M40,52.5c-7,0-12.6-5.6-12.6-12.4 S33,27.7,40,27.7s12.6,5.6,12.6,12.4C52.6,46.9,47,52.5,40,52.5z"/><path fill="rgba(0, 0, 0, 0.3)" d="M40,19.2c-11.7,0-21.2,9.3-21.2,20.8S28.3,60.8,40,60.8S61.2,51.5,61.2,40S51.7,19.2,40,19.2z M40,52.5 c-7,0-12.6-5.6-12.6-12.4S33,27.7,40,27.7s12.6,5.6,12.6,12.4C52.6,46.9,47,52.5,40,52.5z"/></g></svg>'
                    ),
                e.each(t.items, function (i, a) {
                    var s = (360 / t.totalSlices()) * i;
                    o += r;
                    var l = t.annularSector({ centerX: 100, centerY: 100, startDegrees: n, endDegrees: o, innerRadius: parseInt(t.o.centerWidth), outerRadius: 100.5 - parseInt(t.o.outerLineWidth) });
                    d.append(t.SVG("path", { "stroke-width": 0, fill: a.color, "data-fill": a.color, d: l })),
                        p.append(
                            t.SVG("path", {
                                "stroke-width": 0,
                                fill: t.o.sliceLineColor,
                                d: t.annularSector({ centerX: 100, centerY: 100, startDegrees: o + 0.2, endDegrees: o - 0.2, innerRadius: parseInt(t.o.centerWidth), outerRadius: 100.5 - parseInt(t.o.outerLineWidth) }, !0),
                            })
                        );
                    var c = "auto" !== e.trim(t.o.textColor) ? e.trim(t.o.textColor) : t.brightness(a.color);
                    if ("v" === t.o.textLine || "vertical" === t.o.textLine) {
                        var h = e("<div/>");
                        h.addClass("eWheel-title"),
                            h.html(a.name),
                            h.css({
                                paddingRight: parseInt(t.o.textOffset) + "%",
                                "-webkit-transform": "rotate(" + s + "deg) translate(0px, -50%)",
                                "-moz-transform": "rotate(" + s + "deg) translate(0px, -50%)",
                                "-ms-transform": "rotate(" + s + "deg) translate(0px, -50%)",
                                "-o-transform": "rotate(" + s + "deg) translate(0px, -50%)",
                                transform: "rotate(" + s + "deg) translate(0px, -50%)",
                                color: c,
                            }),
                            h.appendTo(g),
                            t.toNumber(t.o.letterSpacing) > 0 && g.css("letter-spacing", t.toNumber(t.o.letterSpacing));
                    } else {
                        var u = '<text stroke-width="0" fill="' + c + '" dy="' + t.toNumber(t.o.textOffset) + '%"><textPath xlink:href="#ew-text-' + i + '" startOffset="50%" style="text-anchor: middle;">' + a.name + "</textPath></text>";
                        m.css("font-size", parseInt(t.o.fontSize) / 2), parseInt(t.o.letterSpacing) > 0 && m.css("letter-spacing", parseInt(t.o.letterSpacing)), m.append(u);
                        var f = /(^.+?)L/.exec(l)[1];
                        if (!0 !== t.o.textArc) {
                            var y = /(^.+?)A/.exec(f),
                                v = f.replace(y[0], ""),
                                S = /(^.+?),/.exec(v),
                                x = v.replace(S[1], 0);
                            f = f.replace(v, x);
                        }
                        w.append(t.SVG("path", { "stroke-width": 0, fill: "none", id: "ew-text-" + i, d: f }));
                    }
                    var I = e("<div/>");
                    I.html(a), I.appendTo(h), (n += r);
                });
            var x = parseInt(t.o.sliceLineWidth);
            if (("v" !== t.o.textLine || t.o.textLine, parseInt(t.o.centerWidth) > x)) {
                var I = t.SVG("circle", { class: "centerCircle", cx: "100", cy: "100", r: parseInt(t.o.centerWidth) + 1, stroke: t.o.centerLineColor, "stroke-width": parseInt(t.o.centerLineWidth), fill: t.o.centerBackground });
                e(I).appendTo(c);
            }
            var W = t.SVG("circle", { cx: "100", cy: "100", r: 100 - parseInt(t.o.outerLineWidth) / 2, stroke: t.o.outerLineColor, "stroke-width": parseInt(t.o.outerLineWidth), "fill-opacity": 0, fill: "#fff0" });
            e(W).appendTo(c), l.html(l.html());
        }),
        (t.prototype.toNumber = function (e) {
            return NaN === Number(e) ? 0 : Number(e);
        }),
        (t.prototype.SVG = function (e, t) {
            var r = document.createElementNS("http://www.w3.org/2000/svg", e);
            for (var n in t) r.setAttribute(n, t[n]);
            return r;
        }),
        (t.prototype.annularSector = function (e, t) {
            var r = this,
                n = parseInt(r.o.sliceLineWidth),
                o = r.oWithDefaults(e),
                i = [
                    [o.cx + o.r2 * Math.cos(((e.startDegrees + n / 4) * Math.PI) / 180), o.cy + o.r2 * Math.sin(((e.startDegrees + n / 4) * Math.PI) / 180)],
                    [o.cx + o.r2 * Math.cos(((e.endDegrees - n / 4) * Math.PI) / 180), o.cy + o.r2 * Math.sin(((e.endDegrees - n / 4) * Math.PI) / 180)],
                    [o.cx + o.r1 * Math.cos(((e.endDegrees - n) * Math.PI) / 180), o.cy + o.r1 * Math.sin(((e.endDegrees - n) * Math.PI) / 180)],
                    [o.cx + o.r1 * Math.cos(((e.startDegrees + n) * Math.PI) / 180), o.cy + o.r1 * Math.sin(((e.startDegrees + n) * Math.PI) / 180)],
                ],
                a = (o.closeRadians - o.startRadians) % (2 * Math.PI) > Math.PI ? 1 : 0,
                s = 1,
                l = 0;
            !0 === t && n >= parseInt(r.o.centerWidth) ? ((s = 0), (l = 1)) : !0 !== t && n >= parseInt(r.o.centerWidth) && ((s = 1), (l = 1));
            var c = [];
            return c.push("M" + i[0].join()), c.push("A" + [o.r2, o.r2, 0, a, s, i[1]].join()), c.push("L" + i[2].join()), c.push("A" + [o.r1, o.r1, 0, a, l, i[3]].join()), c.push("z"), c.join(" ");
        }),
        (t.prototype.oWithDefaults = function (e) {
            var t = { cx: e.centerX || 0, cy: e.centerY || 0, startRadians: ((e.startDegrees || 0) * Math.PI) / 180, closeRadians: ((e.endDegrees || 0) * Math.PI) / 180 },
                r = void 0 !== e.thickness ? e.thickness : 100;
            return (
                void 0 !== e.innerRadius ? (t.r1 = e.innerRadius) : void 0 !== e.outerRadius ? (t.r1 = e.outerRadius - r) : (t.r1 = 200 - r),
                void 0 !== e.outerRadius ? (t.r2 = e.outerRadius) : (t.r2 = t.r1 + r),
                t.r1 < 0 && (t.r1 = 0),
                t.r2 < 0 && (t.r2 = 0),
                t
            );
        }),
        (t.prototype.brightness = function (e) {
            var t, r, n;
            return (
                e.match(/^rgb/)
                    ? ((t = (e = (e = e.match(/rgba?\(([^)]+)\)/)[1]).split(/ *, */).map(Number))[0]), (r = e[1]), (n = e[2]))
                    : "#" == e[0] && 7 == e.length
                    ? ((t = parseInt(e.slice(1, 3), 16)), (r = parseInt(e.slice(3, 5), 16)), (n = parseInt(e.slice(5, 7), 16)))
                    : "#" == e[0] && 4 == e.length && ((t = parseInt(e[1] + e[1], 16)), (r = parseInt(e[2] + e[2], 16)), (n = parseInt(e[3] + e[3], 16))),
                (299 * t + 587 * r + 114 * n) / 1e3 < 125 ? "#fff" : "#333"
            );
        }),
        (t.prototype.guid = function (e) {
            var t = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ",
                r = "";
            e || (e = 8);
            for (var n = 0; n < e; n++) r += t.charAt(Math.floor(Math.random() * t.length));
            return r;
        }),
        (t.prototype.randomColor = function () {
            for (var e = "#", t = 0; t < 6; t++) e += "0123456789ABCDEF"[Math.floor(16 * Math.random())];
            return e;
        }),
        (t.prototype.FontScale = function (e) {
            var t = this,
                r = 1 + (1 * (t.$wheel.width() - parseInt(t.o.width))) / parseInt(t.o.width);
            r > 4 ? (r = 4) : r < 0.1 && (r = 0.1), t.$wheel.find(".eWheel-wrapper").css("font-size", 100 * r + "%");
        }),
        (t.prototype.numberToArray = function (e) {
            var t,
                r = [];
            for (t = 0; t < e; t++) r[t] = t;
            return r;
        }),
        (t.prototype.totalSlices = function () {
            return this.items.length;
        }),
        (t.prototype.getDegree = function (e) {
            return 360 / this.totalSlices();
        }),
        (t.prototype.degStart = function (e) {
            return 360 - this.getDegree() * e;
        }),
        (t.prototype.degEnd = function (e) {
            return 360 - (this.getDegree() * e + this.getDegree());
        }),
        (t.prototype.getRandomInt = function (e, t) {
            return Math.floor(Math.random() * (t - e + 1) + e);
        }),
        (t.prototype.calcSliceSize = function (e) {
            var t = this,
                r = t.degStart(e) - (parseInt(t.o.sliceLineWidth) + 2),
                n = t.degEnd(e) + (parseInt(t.o.sliceLineWidth) + 2),
                o = [];
            return (o.start = r), (o.end = n), o;
        }),
        (t.prototype.toObject = function (e) {
            for (var t = {}, r = 0; r < e.length; ++r) void 0 !== e[r] && (t[r] = e[r]);
            return t;
        }),
        (t.prototype.WinnerSelector = function () {
            var t = this,
                r = {};
            return (
                "string" == typeof t.o.selector &&
                (e.each(t.items, function (e, n) {
                    if ("object" == typeof n[t.o.selector] || "array" == typeof n[t.o.selector] || void 0 === n[t.o.selector]) return !1;
                    r[e] = n[t.o.selector];
                }),
                r)
            );
        }),
        (t.prototype.findWinner = function (t, r) {
            var n = this,
                o = void 0;
            if ("custom" !== r && ("string" != typeof n.o.selector || "number" == typeof t)) {
                if (void 0 === n.items[t]) return;
                return t;
            }
            return (
                e.each(n.items, function (e, r) {
                    "object" != typeof r[n.o.selector] && "array" != typeof r[n.o.selector] && void 0 !== r[n.o.selector] && r[n.o.selector] === t && (o = e);
                }),
                o
            );
        }),
        (t.prototype.selectedSliceID = function (t) {
            var r = this,
                n = r.WinnerSelector();
            if (((r.selected = r.o.selected), "object" === e.type(r.selected))) {
                if (void 0 !== r.selected[0] && void 0 !== r.selected[0].selectedIndex) return r.selected[0].selectedIndex;
            } else if ("array" === e.type(r.selected))
                !1 !== r.o.selector
                    ? (r.selected = e.map(n, function (e, n) {
                          if (e === r.o.selected[t]) return n;
                      }))
                    : (r.selected = r.selected[t]);
            else if ("string" === e.type(r.selected) && !1 !== r.o.selector) r.selected = r.findWinner(r.selected);
            else if ("number" !== e.type(r.selected)) return;
            if (void 0 !== r.findWinner(parseInt(r.selected))) return parseInt(r.selected);
        }),
        (t.prototype.ajax = function (t) {
            var r = this;
            (t.dataType = "json"),
                (t.cache = !1),
                void 0 === t.data && (t.data = {}),
                !0 === t.nonce && ((t.data.nonce = r.guid(8)), (r.nonce = t.data.nonce)),
                0 !== r.counter ? (t.data.lastSpin = r.slice.results) : (t.data.lastSpin = !1),
                e.ajax(t).done(function (t) {
                    e.isArray(t) && (t = r.toObject(t)),
                        r.nonce && ("string" != typeof t.nonce && console.log("error", "Nonce Type Incorrect try to use POST Methode with nonce id"), t.nonce !== r.nonce)
                            ? r.o.onFail.call(r.$wheel, r.slice.results, r.spinCount, r.now)
                            : (void 0 !== t.selector && ((r.o.selector = t.selector), (r.o.selected = [t.winner])), (void 0 === t.stop || (!0 !== t.stop && "true" !== t.stop)) && r.run(t.winner));
                });
        }),
        (t.prototype.start = function () {
            var t = this;
            e.isPlainObject(t.o.ajax) && !e.isEmptyObject(t.o.ajax) ? t.ajax(t.o.ajax) : t.run();
        }),
        (t.prototype.run = function (t) {
            var r = this;
            if (!r.inProgress) {
                if (t || 0 === t) {
                    var n = r.findWinner(t, "custom");
                    if (void 0 === n) return;
                    r.slice.id = n;
                } else {
                    if (0 !== r.o.max && r.counter >= r.o.max) return;
                    if (!1 !== r.o.selector) r.slice.id = r.selectedSliceID(r.resetCount);
                    else {
                        if (!0 !== r.o.random) return;
                        r.slice.id = r.getRandomInt(0, r.totalSlices() - 1);
                    }
                    if (!0 !== r.o.random && r.totalSlices() <= r.resetCount) return;
                    if ((!0 === r.o.random && r.totalSlices() <= r.resetCount && (r.resetCount = 0), void 0 === r.slice.id)) return r.resetCount++, void r.run(t);
                }
                if (((r.inProgress = !0), void 0 !== r.items[r.slice.id])) {
                    (r.slice.results = r.items[r.slice.id]), (r.slice.length = r.slice.id), r.o.onStart.call(r.$wheel, r.slice.results, r.spinCount, r.now);
                    var o = r.calcSliceSize(r.slice.id),
                        i = r.getRandomInt(o.start, o.end),
                        a = 360 * parseInt(r.rotates) + i;
                    (r.lastStep = -1), (r.currentStep = 0);
                    var s = !1,
                        l = r.numberToArray(r.totalSlices()).reverse();
                    if (0 !== parseInt(r.o.frame)) {
                        var c = e.fx.interval;
                        e.fx.interval = parseInt(r.o.frame);
                    }
                    (r.spinning = e({ deg: r.now }).animate(
                        { deg: a },
                        {
                            duration: parseInt(r.o.duration),
                            easing: e.trim(r.o.easing),
                            step: function (t, n) {
                                0 !== parseInt(r.o.frame) && (e.fx.interval = parseInt(r.o.frame)),
                                    (r.now = t % 360),
                                    "color" !== e.trim(r.o.type) &&
                                        r.$wheel
                                            .find(".eWheel")
                                            .css({
                                                "-webkit-transform": "rotate(" + r.now + "deg)",
                                                "-moz-transform": "rotate(" + r.now + "deg)",
                                                "-ms-transform": "rotate(" + r.now + "deg)",
                                                "-o-transform": "rotate(" + r.now + "deg)",
                                                transform: "rotate(" + r.now + "deg)",
                                            }),
                                    (r.currentStep = Math.floor(t / (360 / r.totalSlices()))),
                                    (r.currentSlice = l[r.currentStep % r.totalSlices()]);
                                var o = 1600 / r.totalSlices(),
                                    i = (((1600 / 360) * r.now) / 1600) * 100,
                                    a = (((r.currentSlice + 1) * o - (1600 - (1600 / 360) * r.now)) / o) * 100;
                                if (((r.slicePercent = a), (r.circlePercent = i), r.o.onProgress.call(r.$wheel, r.slicePercent, r.circlePercent), r.lastStep !== r.currentStep)) {
                                    if (
                                        ((r.lastStep = r.currentStep),
                                        !0 === r.o.markerAnimation &&
                                            -1 === e.inArray(e.trim(r.o.easing), ["easeInElastic", "easeInBack", "easeInBounce", "easeOutElastic", "easeOutBack", "easeOutBounce", "easeInOutElastic", "easeInOutBack", "easeInOutBounce"]))
                                    ) {
                                        var d = parseInt(r.o.duration) / r.totalSlices();
                                        -38,
                                            s && s.stop(),
                                            (s = e({ deg: 0 }).animate(
                                                { deg: -38 },
                                                {
                                                    easing: "MarkerEasing",
                                                    duration: d / 2,
                                                    step: function (t) {
                                                        e(".eWheel-marker").css({
                                                            "-webkit-transform": "rotate(" + t + "deg)",
                                                            "-moz-transform": "rotate(" + t + "deg)",
                                                            "-ms-transform": "rotate(" + t + "deg)",
                                                            "-o-transform": "rotate(" + t + "deg)",
                                                            transform: "rotate(" + t + "deg)",
                                                        });
                                                    },
                                                }
                                            ));
                                    }
                                    "color" === e.trim(r.o.type)
                                        ? (r.$wheel.find("svg>g.ew-slicesGroup>path").each(function (t) {
                                              e(this).attr("class", "").attr("fill", e(this).attr("data-fill"));
                                          }),
                                          r.$wheel.find("svg>g.ew-slicesGroup>path").eq(r.currentSlice).attr("class", "ew-ccurrent").attr("fill", r.o.selectedSliceColor),
                                          r.$wheel.find(".eWheel-txt>.eWheel-title").removeClass("ew-ccurrent"),
                                          r.$wheel.find(".eWheel-txt>.eWheel-title").eq(r.currentSlice).addClass("ew-ccurrent"))
                                        : (r.$wheel.find("svg>g.ew-slicesGroup>path").attr("class", ""),
                                          r.$wheel.find("svg>g.ew-slicesGroup>path").eq(r.currentSlice).attr("class", "ew-current"),
                                          r.$wheel.find(".eWheel-txt>.eWheel-title").removeClass("ew-current"),
                                          r.$wheel.find(".eWheel-txt>.eWheel-title").eq(r.currentSlice).addClass("ew-current")),
                                        (r.currentSliceData.id = r.currentSlice),
                                        (r.currentSliceData.results = r.items[r.currentSliceData.id]),
                                        (r.currentSliceData.results.length = r.currentSliceData.id),
                                        r.o.onStep.call(r.$wheel, r.currentSliceData.results, r.slicePercent, r.circlePercent);
                                }
                                0 !== parseInt(r.o.frame) && (e.fx.interval = c);
                            },
                            fail: function (e, t, n) {
                                (r.inProgress = !1), r.o.onFail.call(r.$wheel, r.slice.results, r.spinCount, r.now);
                            },
                            complete: function (e, t, n) {
                                (r.inProgress = !1), r.o.onComplete.call(r.$wheel, r.slice.results, r.spinCount, r.now);
                            },
                        }
                    )),
                        r.counter++,
                        r.spinCount++,
                        r.resetCount++;
                }
            }
        }),
        (t.prototype.execute = function () {
            var t = this;
            (t.currentSlice = t.totalSlices() - 1),
                "string" == typeof t.o.button &&
                    "" !== e.trim(t.o.button) &&
                    e(document).on("click." + t.instanceUid, t.o.button, function (e) {
                        e.preventDefault(), t.start();
                    }),
                t.$wheel.css("font-size", parseInt(t.o.fontSize)),
                t.$wheel.width(parseInt(t.o.width)),
                t.$wheel.height(t.$wheel.width()),
                t.$wheel.find(".eWheel-wrapper").width(t.$wheel.width()),
                t.$wheel.find(".eWheel-wrapper").height(t.$wheel.width()),
                t.FontScale(),
                e(window).on("resize." + t.instanceUid, function () {
                    t.$wheel.height(t.$wheel.width()), t.$wheel.find(".eWheel-wrapper").width(t.$wheel.width()), t.$wheel.find(".eWheel-wrapper").height(t.$wheel.width()), t.FontScale();
                });
        }),
        (e.fn.easyWheel = function () {
            var r,
                n,
                o = this,
                i = arguments[0],
                a = Array.prototype.slice.call(arguments, 1),
                s = Array.prototype.slice.call(arguments, 2),
                l = o.length,
                c = ["destroy", "start", "finish", "option"];
            for (r = 0; r < l; r++)
                if (
                    ("object" == typeof i || void 0 === i
                        ? (o[r].easyWheel = new t(o[r], i))
                        : -1 !== e.inArray(e.trim(i), c) && (n = "option" === e.trim(i) ? o[r].easyWheel[i].apply(o[r].easyWheel, a, s) : o[r].easyWheel[i].apply(o[r].easyWheel, a)),
                    void 0 !== n)
                )
                    return n;
            return o;
        });
});
