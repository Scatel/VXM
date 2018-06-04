/*! vxm-aio-project - v1.0.0 - 2018-03-06 */
function _classCallCheck(a, b) {
    if (!(a instanceof b)) throw new TypeError("Cannot call a class as a function")
}

function updateViewportDimensions() {
    var a = window,
        b = document,
        c = b.documentElement,
        d = b.getElementsByTagName("body")[0],
        e = a.innerWidth || c.clientWidth || d.clientWidth,
        f = a.innerHeight || c.clientHeight || d.clientHeight;
    return {
        width: e,
        height: f
    }
}

function desktopFunctions() {
    if (viewport = updateViewportDimensions(), viewport.width > 768) {
        jQuery(".comment img[data-gravatar]").each(function() {
            jQuery(this).attr("src", jQuery(this).attr("data-gravatar"))
        }), jQuery(window).stuck();
        var a;
        "undefined" == typeof a && (a = jQuery("body").hasClass("home"))
    }
}

function homeFunctions() {
    var a;
    "undefined" == typeof a && (a = jQuery("body").hasClass("home"))
}

function landingFunctions() {
    var a;
    "undefined" == typeof a && (a = jQuery("body").hasClass("page-template-page-landing"))
}

function initialisePageScrollAnimations() {
    jQuery(".os-animation").each(function() {
        var a = jQuery(this),
            b = a.attr("data-os-animation"),
            c = a.attr("data-os-animation-delay");
        a.css("-webkit-animation-delay", c), a.css("-moz-animation-delay", c), a.css("animation-delay", c), a.waypoint(function() {
            a.addClass("animated").addClass(b)
        }, {
            triggerOnce: !0,
            offset: "80%"
        })
    })
}

function inviewAnimations() {
    jQuery(".os-animation").each(function() {
        var a = jQuery(this),
            b = a.attr("data-os-animation"),
            c = a.attr("data-os-animation-delay");
        a.addClass(b), a.css("-webkit-animation-delay", c), a.css("-moz-animation-delay", c), a.css("animation-delay", c), a.bind("inview", function(b, c) {
            c === !0 ? a.addClass("animated") : a.removeClass("animated")
        })
    })
}


function frontend_faqs_search_ajax_form(){
    jQuery.ajax({
        type: "GET",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_faqs_search"
        },
        beforeSend: function() {
            jQuery("#loading-posts").show()
        },
        success: function(response) {
            jQuery("#loading-posts").hide(),
            console.log(response)
			jQuery("#aio-results").html(response)
        },
        error: function(thrownError) {
            console.log(thrownError)
        }
    })
}

function frontend_faqs_instructores_search_ajax_form(){
    jQuery.ajax({
        type: "GET",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_faqs_instructores_search"
        },
        success: function(response) {
            jQuery("#aio-results-instructores").html(response)
        },
        error: function(thrownError) {
            console.log(thrownError)
        }
    })
}

function frontend_faqs_certificadores_search_ajax_form(){
    jQuery.ajax({
        type: "GET",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_faqs_certificadores_search"
        },
        success: function(response) {
            jQuery("#aio-results-certificadores").html(response)
        },
        error: function(thrownError) {
            console.log(thrownError)
        }
    })
}

function frontend_manual_instructores_search_ajax_form(){
    jQuery.ajax({
        type: "GET",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_manual_instructores_search"
        },
        success: function(response) {
            jQuery("#aio-results-manual-instructores").html(response)
        },
        error: function(thrownError) {
            console.log(thrownError)
        }
    })
}

function frontend_manual_certificadores_search_ajax_form(){
    jQuery.ajax({
        type: "GET",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_manual_certificadores_search"
        },
        success: function(response) {
            console.log(response)
            console.log('success!')
            jQuery("#aio-results-manual-certificadores").html(response)
        },
        error: function(thrownError) {
            console.log(thrownError)
        }
    })
}

function retrieve_page_id(){
    let look_for_id = jQuery('body').attr('class'),
    start = look_for_id.indexOf('page-id-'),
    end = look_for_id.indexOf(' ', start),
    length = end - (start +'page-id-'.length);


    const id = look_for_id.substr(start + 'page-id-'.length, length);

    jQuery('.post-link').each(function(i){
        let url = jQuery(this).attr('href') + 'redirect_id='+id;
        $(this).attr('href', url);
        $(this).attr('data-mfp-src', url);
    })
}




function frontend_instructores_search_ajax_form(a, b, c) {
    var d = a,
        e = b || "DESC",
        f = c || "date",
        g = jQuery("#aspirante-search-input").val();
    jQuery.ajax({
        type: "POST",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_instructores_search",
            search_query: g,
            page: d,
            order: e,
            orderby: f
        },
        beforeSend: function() {
            jQuery("#loading-posts").show(), jQuery(".load-more-wrap").remove()
        },
        success: function(b) {
			jQuery(".lista-alumnos").show(), 
			jQuery("#loading-posts").hide(), 
			1 === a ? jQuery("#aio-results").html(b) : jQuery("#aio-results").append(b)
        },
        error: function(a) {
            console.log(a)
        }
    })
}

function frontend_certificadores_search_ajax_form(a, b, c) {
    var d = a,
        e = b || "DESC",
        f = c || "date",
        g = jQuery("#certificador-search-input").val();
    jQuery.ajax({
        type: "POST",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_certificadores_search",
            search_query: g,
            page: d,
            order: e,
            orderby: f
        },
        beforeSend: function() {
            jQuery("#loading-posts").show(), jQuery(".load-more-wrap").remove()
        },
        success: function(b) {
            jQuery(".lista-alumnos").show(), 
            jQuery("#loading-posts").hide(), 
            1 === a ? jQuery("#aio-results").html(b) : jQuery("#aio-results").append(b)
        },
        error: function(a) {
            console.log(a)
        }
    })
}



function frontend_alumnos_search_ajax_form(page, order, orderby) {
	var pag = page;
	var orde = order || 'DESC';
	var orderb = orderby || 'date';
	var search_query = jQuery("#alumno-search-input").val();

	jQuery.ajax({
		type:"POST",
		url: AIO_Ajax.ajaxurl,
		data: {
			action: 'frontend_alumnos_search',
			search_query: search_query,
			//alumno_cats: alumno_cats,
			page: pag,
			order: orde,
			orderby: orderb
		},
		beforeSend: function() {
			jQuery('#loading-posts').show();
			jQuery(".load-more-wrap").remove();
		},
		success: function(response){

			jQuery('.lista-alumnos').show();
			jQuery('#loading-posts').hide();
			if(page === 1) {
				jQuery('#aio-results').html(response);
			} else {
				jQuery('#aio-results').append(response);
            } 
            retrieve_page_id()
		},
		error: function(errorThrown){
			console.log(errorThrown);
		}
	});   

}


function frontend_instructores_admin_search_ajax_form(a, b, c) {
    var d = a,
        e = b || "DESC",
        f = c || "date",
        g = jQuery("#aspirante-admin-search-input").val(),
        h = jQuery("#pagetemplate").val();
    jQuery.ajax({
        type: "POST",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_instructores_admin_search",
            search_query: g,
            page: d,
            order: e,
            orderby: f,
            pagetemplate: h
        },
        beforeSend: function() {
            jQuery("#loading-posts").show(), jQuery(".load-more-wrap").remove()
        },
        success: function(b) {
            jQuery(".lista-alumnos").show(), 
            jQuery("#loading-posts").hide(), 
            1 === a ? jQuery("#aio-results").html(b) : jQuery("#aio-results").append(b)

            retrieve_page_id()

        },
        error: function(a) {
            console.log(a)
        }
    })
}

function frontend_certificadores_admin_search_ajax_form(a, b, c) {
    var d = a,
        e = b || "DESC",
        f = c || "date",
        g = jQuery("#certificador-admin-search-input").val(),
        h = jQuery("#pagetemplate").val();
    jQuery.ajax({
        type: "POST",
        url: AIO_Ajax.ajaxurl,
        data: {
            action: "frontend_certificadores_admin_search",
            search_query: g,
            page: d,
            order: e,
            orderby: f,
            pagetemplate: h
        },
        beforeSend: function() {
            jQuery("#loading-posts").show(), jQuery(".load-more-wrap").remove()
        },
        success: function(b) {
            jQuery(".lista-alumnos").show(), jQuery("#loading-posts").hide(), 1 === a ? jQuery("#aio-results").html(b) : jQuery("#aio-results").append(b)
            retrieve_page_id()
        },
        error: function(a) {
            console.log(a)
        }
    })
}! function(a) {
    "use strict";

    function b(a) {
        return new RegExp("(^|\\s+)" + a + "(\\s+|$)")
    }

    function c(a, b) {
        var c = d(a, b) ? f : e;
        c(a, b)
    }
    var d, e, f;
    "classList" in document.documentElement ? (d = function(a, b) {
        return a.classList.contains(b)
    }, e = function(a, b) {
        a.classList.add(b)
    }, f = function(a, b) {
        a.classList.remove(b)
    }) : (d = function(a, c) {
        return b(c).test(a.className)
    }, e = function(a, b) {
        d(a, b) || (a.className = a.className + " " + b)
    }, f = function(a, c) {
        a.className = a.className.replace(b(c), " ")
    });
    var g = {
        hasClass: d,
        addClass: e,
        removeClass: f,
        toggleClass: c,
        has: d,
        add: e,
        remove: f,
        toggle: c
    };
    "function" == typeof define && define.amd ? define(g) : a.classie = g
}(window),
function(a) {
    a.fn.flowtype = function(b) {
        var c = a.extend({
                maximum: 9999,
                minimum: 1,
                maxFont: 9999,
                minFont: 1,
                fontRatio: 35
            }, b),
            d = function(b) {
                var d = a(b),
                    e = d.width(),
                    f = e > c.maximum ? c.maximum : e < c.minimum ? c.minimum : e,
                    g = f / c.fontRatio,
                    h = g > c.maxFont ? c.maxFont : g < c.minFont ? c.minFont : g;
                d.css("font-size", h + "px")
            };
        return this.each(function() {
            var b = this;
            a(window).resize(function() {
                d(b)
            }), d(this)
        })
    }
}(jQuery), $.scrollTo = $.fn.scrollTo = function(a, b, c) {
        "use strict";
        return this instanceof $ ? (c = $.extend({}, {
            gap: {
                x: 0,
                y: 0
            },
            animation: {
                easing: "swing",
                duration: 600,
                complete: $.noop,
                step: $.noop
            }
        }, c), this.each(function() {
            var d = $(this);
            d.stop().animate({
                scrollLeft: isNaN(Number(a)) ? $(b).offset().left + c.gap.x : a,
                scrollTop: isNaN(Number(b)) ? $(b).offset().top + c.gap.y : b
            }, c.animation)
        })) : $.fn.scrollTo.apply($("html, body"), arguments)
    }, $(document).ready(function() {
        "use strict";
        $(".easing").click(function(a) {
            a.preventDefault(), $("html,body").scrollTo(this.hash, this.hash)
        });
        for (var a = $("navbar li").children(), b = [], c = 0; c < a.length; c++) {
            var d = a[c],
                e = $(d).attr("href");
            b.push(e)
        }
        $(window).scroll(function() {
            for (var a = $(window).scrollTop(), c = $(window).height(), d = $(document).height(), e = 0; e < b.length; e++) {
                var f = b[e],
                    g = $(f).offset().top,
                    h = $(f).height();
                a >= g && g + h > a ? $("a[href='" + f + "']").addClass("nav-active") : $("a[href='" + f + "']").removeClass("nav-active")
            }
            if (a + c == d && !$("navbar li:last-child a").hasClass("nav-active")) {
                var i = $(".nav-active").attr("href");
                $("a[href='" + i + "']").removeClass("nav-active"), $("navbar li:last-child a").addClass("nav-active")
            }
        })
    }), ! function(a) {
        "use strict";
        "function" == typeof define && define.amd ? define(["jquery"], a) : a("undefined" != typeof jQuery ? jQuery : window.Zepto)
    }(function(a) {
        "use strict";

        function b(b) {
            var c = b.data;
            b.isDefaultPrevented() || (b.preventDefault(), a(b.target).ajaxSubmit(c))
        }

        function c(b) {
            var c = b.target,
                d = a(c);
            if (!d.is("[type=submit],[type=image]")) {
                var e = d.closest("[type=submit]");
                if (0 === e.length) return;
                c = e[0]
            }
            var f = this;
            if (f.clk = c, "image" == c.type)
                if (void 0 !== b.offsetX) f.clk_x = b.offsetX, f.clk_y = b.offsetY;
                else if ("function" == typeof a.fn.offset) {
                var g = d.offset();
                f.clk_x = b.pageX - g.left, f.clk_y = b.pageY - g.top
            } else f.clk_x = b.pageX - c.offsetLeft, f.clk_y = b.pageY - c.offsetTop;
            setTimeout(function() {
                f.clk = f.clk_x = f.clk_y = null
            }, 100)
        }

        function d() {
            if (a.fn.ajaxSubmit.debug) {
                var b = "[jquery.form] " + Array.prototype.join.call(arguments, "");
                window.console && window.console.log ? window.console.log(b) : window.opera && window.opera.postError && window.opera.postError(b)
            }
        }
        var e = {};
        e.fileapi = void 0 !== a("<input type='file'/>").get(0).files, e.formdata = void 0 !== window.FormData;
        var f = !!a.fn.prop;
        a.fn.attr2 = function() {
            if (!f) return this.attr.apply(this, arguments);
            var a = this.prop.apply(this, arguments);
            return a && a.jquery || "string" == typeof a ? a : this.attr.apply(this, arguments)
        }, a.fn.ajaxSubmit = function(b) {
            function c(c) {
                var d, e, f = a.param(c, b.traditional).split("&"),
                    g = f.length,
                    h = [];
                for (d = 0; g > d; d++) f[d] = f[d].replace(/\+/g, " "), e = f[d].split("="), h.push([decodeURIComponent(e[0]), decodeURIComponent(e[1])]);
                return h
            }

            function g(d) {
                for (var e = new FormData, f = 0; f < d.length; f++) e.append(d[f].name, d[f].value);
                if (b.extraData) {
                    var g = c(b.extraData);
                    for (f = 0; f < g.length; f++) g[f] && e.append(g[f][0], g[f][1])
                }
                b.data = null;
                var h = a.extend(!0, {}, a.ajaxSettings, b, {
                    contentType: !1,
                    processData: !1,
                    cache: !1,
                    type: i || "POST"
                });
                b.uploadProgress && (h.xhr = function() {
                    var c = a.ajaxSettings.xhr();
                    return c.upload && c.upload.addEventListener("progress", function(a) {
                        var c = 0,
                            d = a.loaded || a.position,
                            e = a.total;
                        a.lengthComputable && (c = Math.ceil(d / e * 100)), b.uploadProgress(a, d, e, c)
                    }, !1), c
                }), h.data = null;
                var j = h.beforeSend;
                return h.beforeSend = function(a, c) {
                    c.data = b.formData ? b.formData : e, j && j.call(this, a, c)
                }, a.ajax(h)
            }

            function h(c) {
                function e(a) {
                    var b = null;
                    try {
                        a.contentWindow && (b = a.contentWindow.document)
                    } catch (c) {
                        d("cannot get iframe.contentWindow document: " + c)
                    }
                    if (b) return b;
                    try {
                        b = a.contentDocument ? a.contentDocument : a.document
                    } catch (c) {
                        d("cannot get iframe.contentDocument: " + c), b = a.document
                    }
                    return b
                }

                function g() {
                    function b() {
                        try {
                            var a = e(r).readyState;
                            d("state = " + a), a && "uninitialized" == a.toLowerCase() && setTimeout(b, 50)
                        } catch (c) {
                            d("Server abort: ", c, " (", c.name, ")"), h(A), w && clearTimeout(w), w = void 0
                        }
                    }
                    var c = l.attr2("target"),
                        f = l.attr2("action"),
                        g = "multipart/form-data",
                        j = l.attr("enctype") || l.attr("encoding") || g;
                    x.setAttribute("target", o), (!i || /post/i.test(i)) && x.setAttribute("method", "POST"), f != m.url && x.setAttribute("action", m.url), m.skipEncodingOverride || i && !/post/i.test(i) || l.attr({
                        encoding: "multipart/form-data",
                        enctype: "multipart/form-data"
                    }), m.timeout && (w = setTimeout(function() {
                        v = !0, h(z)
                    }, m.timeout));
                    var k = [];
                    try {
                        if (m.extraData)
                            for (var n in m.extraData) m.extraData.hasOwnProperty(n) && k.push(a.isPlainObject(m.extraData[n]) && m.extraData[n].hasOwnProperty("name") && m.extraData[n].hasOwnProperty("value") ? a('<input type="hidden" name="' + m.extraData[n].name + '">').val(m.extraData[n].value).appendTo(x)[0] : a('<input type="hidden" name="' + n + '">').val(m.extraData[n]).appendTo(x)[0]);
                        m.iframeTarget || q.appendTo("body"), r.attachEvent ? r.attachEvent("onload", h) : r.addEventListener("load", h, !1), setTimeout(b, 15);
                        try {
                            x.submit()
                        } catch (p) {
                            var s = document.createElement("form").submit;
                            s.apply(x)
                        }
                    } finally {
                        x.setAttribute("action", f), x.setAttribute("enctype", j), c ? x.setAttribute("target", c) : l.removeAttr("target"), a(k).remove()
                    }
                }

                function h(b) {
                    if (!s.aborted && !F) {
                        if (E = e(r), E || (d("cannot access response document"), b = A), b === z && s) return s.abort("timeout"), void y.reject(s, "timeout");
                        if (b == A && s) return s.abort("server abort"), void y.reject(s, "error", "server abort");
                        if (E && E.location.href != m.iframeSrc || v) {
                            r.detachEvent ? r.detachEvent("onload", h) : r.removeEventListener("load", h, !1);
                            var c, f = "success";
                            try {
                                if (v) throw "timeout";
                                var g = "xml" == m.dataType || E.XMLDocument || a.isXMLDoc(E);
                                if (d("isXml=" + g), !g && window.opera && (null === E.body || !E.body.innerHTML) && --G) return d("requeing onLoad callback, DOM not available"), void setTimeout(h, 250);
                                var i = E.body ? E.body : E.documentElement;
                                s.responseText = i ? i.innerHTML : null, s.responseXML = E.XMLDocument ? E.XMLDocument : E, g && (m.dataType = "xml"), s.getResponseHeader = function(a) {
                                    var b = {
                                        "content-type": m.dataType
                                    };
                                    return b[a.toLowerCase()]
                                }, i && (s.status = Number(i.getAttribute("status")) || s.status, s.statusText = i.getAttribute("statusText") || s.statusText);
                                var j = (m.dataType || "").toLowerCase(),
                                    k = /(json|script|text)/.test(j);
                                if (k || m.textarea) {
                                    var l = E.getElementsByTagName("textarea")[0];
                                    if (l) s.responseText = l.value, s.status = Number(l.getAttribute("status")) || s.status, s.statusText = l.getAttribute("statusText") || s.statusText;
                                    else if (k) {
                                        var o = E.getElementsByTagName("pre")[0],
                                            p = E.getElementsByTagName("body")[0];
                                        o ? s.responseText = o.textContent ? o.textContent : o.innerText : p && (s.responseText = p.textContent ? p.textContent : p.innerText)
                                    }
                                } else "xml" == j && !s.responseXML && s.responseText && (s.responseXML = H(s.responseText));
                                try {
                                    D = J(s, j, m)
                                } catch (t) {
                                    f = "parsererror", s.error = c = t || f
                                }
                            } catch (t) {
                                d("error caught: ", t), f = "error", s.error = c = t || f
                            }
                            s.aborted && (d("upload aborted"), f = null), s.status && (f = s.status >= 200 && s.status < 300 || 304 === s.status ? "success" : "error"), "success" === f ? (m.success && m.success.call(m.context, D, "success", s), y.resolve(s.responseText, "success", s), n && a.event.trigger("ajaxSuccess", [s, m])) : f && (void 0 === c && (c = s.statusText), m.error && m.error.call(m.context, s, f, c), y.reject(s, "error", c), n && a.event.trigger("ajaxError", [s, m, c])), n && a.event.trigger("ajaxComplete", [s, m]), n && !--a.active && a.event.trigger("ajaxStop"), m.complete && m.complete.call(m.context, s, f), F = !0, m.timeout && clearTimeout(w), setTimeout(function() {
                                m.iframeTarget ? q.attr("src", m.iframeSrc) : q.remove(), s.responseXML = null
                            }, 100)
                        }
                    }
                }
                var j, k, m, n, o, q, r, s, t, u, v, w, x = l[0],
                    y = a.Deferred();
                if (y.abort = function(a) {
                        s.abort(a)
                    }, c)
                    for (k = 0; k < p.length; k++) j = a(p[k]), f ? j.prop("disabled", !1) : j.removeAttr("disabled");
                if (m = a.extend(!0, {}, a.ajaxSettings, b), m.context = m.context || m, o = "jqFormIO" + (new Date).getTime(), m.iframeTarget ? (q = a(m.iframeTarget), u = q.attr2("name"), u ? o = u : q.attr2("name", o)) : (q = a('<iframe name="' + o + '" src="' + m.iframeSrc + '" />'), q.css({
                        position: "absolute",
                        top: "-1000px",
                        left: "-1000px"
                    })), r = q[0], s = {
                        aborted: 0,
                        responseText: null,
                        responseXML: null,
                        status: 0,
                        statusText: "n/a",
                        getAllResponseHeaders: function() {},
                        getResponseHeader: function() {},
                        setRequestHeader: function() {},
                        abort: function(b) {
                            var c = "timeout" === b ? "timeout" : "aborted";
                            d("aborting upload... " + c), this.aborted = 1;
                            try {
                                r.contentWindow.document.execCommand && r.contentWindow.document.execCommand("Stop")
                            } catch (e) {}
                            q.attr("src", m.iframeSrc), s.error = c, m.error && m.error.call(m.context, s, c, b), n && a.event.trigger("ajaxError", [s, m, c]), m.complete && m.complete.call(m.context, s, c)
                        }
                    }, n = m.global, n && 0 === a.active++ && a.event.trigger("ajaxStart"), n && a.event.trigger("ajaxSend", [s, m]), m.beforeSend && m.beforeSend.call(m.context, s, m) === !1) return m.global && a.active--, y.reject(), y;
                if (s.aborted) return y.reject(), y;
                t = x.clk, t && (u = t.name, u && !t.disabled && (m.extraData = m.extraData || {}, m.extraData[u] = t.value, "image" == t.type && (m.extraData[u + ".x"] = x.clk_x, m.extraData[u + ".y"] = x.clk_y)));
                var z = 1,
                    A = 2,
                    B = a("meta[name=csrf-token]").attr("content"),
                    C = a("meta[name=csrf-param]").attr("content");
                C && B && (m.extraData = m.extraData || {}, m.extraData[C] = B), m.forceSync ? g() : setTimeout(g, 10);
                var D, E, F, G = 50,
                    H = a.parseXML || function(a, b) {
                        return window.ActiveXObject ? (b = new ActiveXObject("Microsoft.XMLDOM"), b.async = "false", b.loadXML(a)) : b = (new DOMParser).parseFromString(a, "text/xml"), b && b.documentElement && "parsererror" != b.documentElement.nodeName ? b : null
                    },
                    I = a.parseJSON || function(a) {
                        return window.eval("(" + a + ")")
                    },
                    J = function(b, c, d) {
                        var e = b.getResponseHeader("content-type") || "",
                            f = "xml" === c || !c && e.indexOf("xml") >= 0,
                            g = f ? b.responseXML : b.responseText;
                        return f && "parsererror" === g.documentElement.nodeName && a.error && a.error("parsererror"), d && d.dataFilter && (g = d.dataFilter(g, c)), "string" == typeof g && ("json" === c || !c && e.indexOf("json") >= 0 ? g = I(g) : ("script" === c || !c && e.indexOf("javascript") >= 0) && a.globalEval(g)), g
                    };
                return y
            }
            if (!this.length) return d("ajaxSubmit: skipping submit process - no element selected"), this;
            var i, j, k, l = this;
            "function" == typeof b ? b = {
                success: b
            } : void 0 === b && (b = {}), i = b.type || this.attr2("method"), j = b.url || this.attr2("action"), k = "string" == typeof j ? a.trim(j) : "", k = k || window.location.href || "", k && (k = (k.match(/^([^#]+)/) || [])[1]), b = a.extend(!0, {
                url: k,
                success: a.ajaxSettings.success,
                type: i || a.ajaxSettings.type,
                iframeSrc: /^https/i.test(window.location.href || "") ? "javascript:false" : "about:blank"
            }, b);
            var m = {};
            if (this.trigger("form-pre-serialize", [this, b, m]), m.veto) return d("ajaxSubmit: submit vetoed via form-pre-serialize trigger"), this;
            if (b.beforeSerialize && b.beforeSerialize(this, b) === !1) return d("ajaxSubmit: submit aborted via beforeSerialize callback"), this;
            var n = b.traditional;
            void 0 === n && (n = a.ajaxSettings.traditional);
            var o, p = [],
                q = this.formToArray(b.semantic, p);
            if (b.data && (b.extraData = b.data, o = a.param(b.data, n)), b.beforeSubmit && b.beforeSubmit(q, this, b) === !1) return d("ajaxSubmit: submit aborted via beforeSubmit callback"), this;
            if (this.trigger("form-submit-validate", [q, this, b, m]), m.veto) return d("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this;
            var r = a.param(q, n);
            o && (r = r ? r + "&" + o : o), "GET" == b.type.toUpperCase() ? (b.url += (b.url.indexOf("?") >= 0 ? "&" : "?") + r, b.data = null) : b.data = r;
            var s = [];
            if (b.resetForm && s.push(function() {
                    l.resetForm()
                }), b.clearForm && s.push(function() {
                    l.clearForm(b.includeHidden)
                }), !b.dataType && b.target) {
                var t = b.success || function() {};
                s.push(function(c) {
                    var d = b.replaceTarget ? "replaceWith" : "html";
                    a(b.target)[d](c).each(t, arguments)
                })
            } else b.success && s.push(b.success);
            if (b.success = function(a, c, d) {
                    for (var e = b.context || this, f = 0, g = s.length; g > f; f++) s[f].apply(e, [a, c, d || l, l])
                }, b.error) {
                var u = b.error;
                b.error = function(a, c, d) {
                    var e = b.context || this;
                    u.apply(e, [a, c, d, l])
                }
            }
            if (b.complete) {
                var v = b.complete;
                b.complete = function(a, c) {
                    var d = b.context || this;
                    v.apply(d, [a, c, l])
                }
            }
            var w = a("input[type=file]:enabled", this).filter(function() {
                    return "" !== a(this).val()
                }),
                x = w.length > 0,
                y = "multipart/form-data",
                z = l.attr("enctype") == y || l.attr("encoding") == y,
                A = e.fileapi && e.formdata;
            d("fileAPI :" + A);
            var B, C = (x || z) && !A;
            b.iframe !== !1 && (b.iframe || C) ? b.closeKeepAlive ? a.get(b.closeKeepAlive, function() {
                B = h(q)
            }) : B = h(q) : B = (x || z) && A ? g(q) : a.ajax(b), l.removeData("jqxhr").data("jqxhr", B);
            for (var D = 0; D < p.length; D++) p[D] = null;
            return this.trigger("form-submit-notify", [this, b]), this
        }, a.fn.ajaxForm = function(e) {
            if (e = e || {}, e.delegation = e.delegation && a.isFunction(a.fn.on), !e.delegation && 0 === this.length) {
                var f = {
                    s: this.selector,
                    c: this.context
                };
                return !a.isReady && f.s ? (d("DOM not ready, queuing ajaxForm"), a(function() {
                    a(f.s, f.c).ajaxForm(e)
                }), this) : (d("terminating; zero elements found by selector" + (a.isReady ? "" : " (DOM not ready)")), this)
            }
            return e.delegation ? (a(document).off("submit.form-plugin", this.selector, b).off("click.form-plugin", this.selector, c).on("submit.form-plugin", this.selector, e, b).on("click.form-plugin", this.selector, e, c), this) : this.ajaxFormUnbind().bind("submit.form-plugin", e, b).bind("click.form-plugin", e, c)
        }, a.fn.ajaxFormUnbind = function() {
            return this.unbind("submit.form-plugin click.form-plugin")
        }, a.fn.formToArray = function(b, c) {
            var d = [];
            if (0 === this.length) return d;
            var f, g = this[0],
                h = this.attr("id"),
                i = b ? g.getElementsByTagName("*") : g.elements;
            if (i && !/MSIE [678]/.test(navigator.userAgent) && (i = a(i).get()), h && (f = a(':input[form="' + h + '"]').get(), f.length && (i = (i || []).concat(f))), !i || !i.length) return d;
            var j, k, l, m, n, o, p;
            for (j = 0, o = i.length; o > j; j++)
                if (n = i[j], l = n.name, l && !n.disabled)
                    if (b && g.clk && "image" == n.type) g.clk == n && (d.push({
                        name: l,
                        value: a(n).val(),
                        type: n.type
                    }), d.push({
                        name: l + ".x",
                        value: g.clk_x
                    }, {
                        name: l + ".y",
                        value: g.clk_y
                    }));
                    else if (m = a.fieldValue(n, !0), m && m.constructor == Array)
                for (c && c.push(n), k = 0, p = m.length; p > k; k++) d.push({
                    name: l,
                    value: m[k]
                });
            else if (e.fileapi && "file" == n.type) {
                c && c.push(n);
                var q = n.files;
                if (q.length)
                    for (k = 0; k < q.length; k++) d.push({
                        name: l,
                        value: q[k],
                        type: n.type
                    });
                else d.push({
                    name: l,
                    value: "",
                    type: n.type
                })
            } else null !== m && "undefined" != typeof m && (c && c.push(n), d.push({
                name: l,
                value: m,
                type: n.type,
                required: n.required
            }));
            if (!b && g.clk) {
                var r = a(g.clk),
                    s = r[0];
                l = s.name, l && !s.disabled && "image" == s.type && (d.push({
                    name: l,
                    value: r.val()
                }), d.push({
                    name: l + ".x",
                    value: g.clk_x
                }, {
                    name: l + ".y",
                    value: g.clk_y
                }))
            }
            return d
        }, a.fn.formSerialize = function(b) {
            return a.param(this.formToArray(b))
        }, a.fn.fieldSerialize = function(b) {
            var c = [];
            return this.each(function() {
                var d = this.name;
                if (d) {
                    var e = a.fieldValue(this, b);
                    if (e && e.constructor == Array)
                        for (var f = 0, g = e.length; g > f; f++) c.push({
                            name: d,
                            value: e[f]
                        });
                    else null !== e && "undefined" != typeof e && c.push({
                        name: this.name,
                        value: e
                    })
                }
            }), a.param(c)
        }, a.fn.fieldValue = function(b) {
            for (var c = [], d = 0, e = this.length; e > d; d++) {
                var f = this[d],
                    g = a.fieldValue(f, b);
                null === g || "undefined" == typeof g || g.constructor == Array && !g.length || (g.constructor == Array ? a.merge(c, g) : c.push(g))
            }
            return c
        }, a.fieldValue = function(b, c) {
            var d = b.name,
                e = b.type,
                f = b.tagName.toLowerCase();
            if (void 0 === c && (c = !0), c && (!d || b.disabled || "reset" == e || "button" == e || ("checkbox" == e || "radio" == e) && !b.checked || ("submit" == e || "image" == e) && b.form && b.form.clk != b || "select" == f && -1 == b.selectedIndex)) return null;
            if ("select" == f) {
                var g = b.selectedIndex;
                if (0 > g) return null;
                for (var h = [], i = b.options, j = "select-one" == e, k = j ? g + 1 : i.length, l = j ? g : 0; k > l; l++) {
                    var m = i[l];
                    if (m.selected) {
                        var n = m.value;
                        if (n || (n = m.attributes && m.attributes.value && !m.attributes.value.specified ? m.text : m.value), j) return n;
                        h.push(n)
                    }
                }
                return h
            }
            return a(b).val()
        }, a.fn.clearForm = function(b) {
            return this.each(function() {
                a("input,select,textarea", this).clearFields(b)
            })
        }, a.fn.clearFields = a.fn.clearInputs = function(b) {
            var c = /^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;
            return this.each(function() {
                var d = this.type,
                    e = this.tagName.toLowerCase();
                c.test(d) || "textarea" == e ? this.value = "" : "checkbox" == d || "radio" == d ? this.checked = !1 : "select" == e ? this.selectedIndex = -1 : "file" == d ? /MSIE/.test(navigator.userAgent) ? a(this).replaceWith(a(this).clone(!0)) : a(this).val("") : b && (b === !0 && /hidden/.test(d) || "string" == typeof b && a(this).is(b)) && (this.value = "")
            })
        }, a.fn.resetForm = function() {
            return this.each(function() {
                ("function" == typeof this.reset || "object" == typeof this.reset && !this.reset.nodeType) && this.reset()
            })
        }, a.fn.enable = function(a) {
            return void 0 === a && (a = !0), this.each(function() {
                this.disabled = !a
            })
        }, a.fn.selected = function(b) {
            return void 0 === b && (b = !0), this.each(function() {
                var c = this.type;
                if ("checkbox" == c || "radio" == c) this.checked = b;
                else if ("option" == this.tagName.toLowerCase()) {
                    var d = a(this).parent("select");
                    b && d[0] && "select-one" == d[0].type && d.find("option").selected(!1), this.selected = b
                }
            })
        }, a.fn.ajaxSubmit.debug = !1
    }), ! function(a) {
        "use strict";
        a.fn.inlineSVG = function(b) {
            b = a.extend({
                eachAfter: null,
                allAfter: null,
                beforeReplace: null,
                replacedClass: "replaced-svg",
                keepSize: !0,
                keepStyle: !0
            }, b || {});
            var c = this,
                d = 0;
            return c.each(function() {
                var e = a(this),
                    f = e.attr("id"),
                    g = e.attr("class"),
                    h = e.attr("src");
                a.get(h, function(h) {
                    function i(f) {
                        f = "boolean" === a.type(f) ? f : !0, f ? (e.replaceWith(j), b.eachAfter && b.eachAfter.call(j.get(0))) : j.remove(), ++d === c.length && b.allAfter && b.allAfter.call(null)
                    }
                    var j = a(h).find("svg"),
                        k = [];
                    if (f && j.attr("id", f), g && k.push(g), b.replacedClass && k.push(b.replacedClass), j.attr("class", k.join(" ")), j.removeAttr("xmlns:a"), b.keepSize) {
                        var l = e.attr("width"),
                            m = e.attr("height");
                        l && j.attr("width", l), m && j.attr("height", m)
                    }
                    if (b.keepStyle) {
                        var n = e.attr("style");
                        n && j.attr("style", n)
                    }
                    b.beforeReplace ? b.beforeReplace.call(null, e, j, i) : i()
                }, "xml")
            })
        }
    }(jQuery),
    function(a) {
        function b() {
            var b = window.innerHeight;
            if (b) return b;
            var c = document.compatMode;
            return (c || !a.support.boxModel) && (b = "CSS1Compat" === c ? document.documentElement.clientHeight : document.body.clientHeight), b
        }
        var c = function(a, b) {
            function c() {
                null !== e ? d = !0 : (d = !1, a(), e = setTimeout(function() {
                    e = null, d && c()
                }, b))
            }
            var d = !1,
                e = null;
            return c
        }(function() {
            var c = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop,
                d = c + b(),
                e = [];
            a.each(a.cache, function() {
                this.events && this.events.inview && e.push(this.handle.elem)
            }), a(e).each(function() {
                var b, e = a(this);
                b = 0;
                for (var f = this; f; f = f.offsetParent) b += f.offsetTop;
                var f = e.height(),
                    g = b + f,
                    f = e.data("inview") || !1,
                    h = e.data("offset") || 0,
                    i = b > c && d > g,
                    j = g + h > c && c > b,
                    h = d > b - h && g > d;
                i || j || h || c > b && g > d ? (b = h ? "top" : j ? "bottom" : "both", f && f === b || (e.data("inview", b), e.trigger("inview", [!0, b]))) : !i && f && (e.data("inview", !1), e.trigger("inview", [!1]))
            })
        }, 100);
        a(window).on("checkInView.inview click.inview ready.inview scroll.inview resize.inview", c)
    }(jQuery), ! function(a) {
        "function" == typeof define && define.amd ? define(["jquery"], a) : a("object" == typeof exports ? require("jquery") : window.jQuery || window.Zepto)
    }(function(a) {
        var b, c, d, e, f, g, h = "Close",
            i = "BeforeClose",
            j = "AfterClose",
            k = "BeforeAppend",
            l = "MarkupParse",
            m = "Open",
            n = "Change",
            o = "mfp",
            p = "." + o,
            q = "mfp-ready",
            r = "mfp-removing",
            s = "mfp-prevent-close",
            t = function() {},
            u = !!window.jQuery,
            v = a(window),
            w = function(a, c) {
                b.ev.on(o + a + p, c)
            },
            x = function(b, c, d, e) {
                var f = document.createElement("div");
                return f.className = "mfp-" + b, d && (f.innerHTML = d), e ? c && c.appendChild(f) : (f = a(f), c && f.appendTo(c)), f
            },
            y = function(c, d) {
                b.ev.triggerHandler(o + c, d), b.st.callbacks && (c = c.charAt(0).toLowerCase() + c.slice(1), b.st.callbacks[c] && b.st.callbacks[c].apply(b, a.isArray(d) ? d : [d]))
            },
            z = function(c) {
                return c === g && b.currTemplate.closeBtn || (b.currTemplate.closeBtn = a(b.st.closeMarkup.replace("%title%", b.st.tClose)), g = c), b.currTemplate.closeBtn
            },
            A = function() {
                a.magnificPopup.instance || (b = new t, b.init(), a.magnificPopup.instance = b)
            },
            B = function() {
                var a = document.createElement("p").style,
                    b = ["ms", "O", "Moz", "Webkit"];
                if (void 0 !== a.transition) return !0;
                for (; b.length;)
                    if (b.pop() + "Transition" in a) return !0;
                return !1
            };
        t.prototype = {
            constructor: t,
            init: function() {
                var c = navigator.appVersion;
                b.isLowIE = b.isIE8 = document.all && !document.addEventListener, b.isAndroid = /android/gi.test(c), b.isIOS = /iphone|ipad|ipod/gi.test(c), b.supportsTransition = B(), b.probablyMobile = b.isAndroid || b.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent), d = a(document), b.popupsCache = {}
            },
            open: function(c) {
                var e;
                if (c.isObj === !1) {
                    b.items = c.items.toArray(), b.index = 0;
                    var g, h = c.items;
                    for (e = 0; e < h.length; e++)
                        if (g = h[e], g.parsed && (g = g.el[0]), g === c.el[0]) {
                            b.index = e;
                            break
                        }
                } else b.items = a.isArray(c.items) ? c.items : [c.items], b.index = c.index || 0;
                if (b.isOpen) return void b.updateItemHTML();
                b.types = [], f = "", c.mainEl && c.mainEl.length ? b.ev = c.mainEl.eq(0) : b.ev = d, c.key ? (b.popupsCache[c.key] || (b.popupsCache[c.key] = {}), b.currTemplate = b.popupsCache[c.key]) : b.currTemplate = {}, b.st = a.extend(!0, {}, a.magnificPopup.defaults, c), b.fixedContentPos = "auto" === b.st.fixedContentPos ? !b.probablyMobile : b.st.fixedContentPos, b.st.modal && (b.st.closeOnContentClick = !1, b.st.closeOnBgClick = !1, b.st.showCloseBtn = !1, b.st.enableEscapeKey = !1), b.bgOverlay || (b.bgOverlay = x("bg").on("click" + p, function() {
                    b.close()
                }), b.wrap = x("wrap").attr("tabindex", -1).on("click" + p, function(a) {
                    b._checkIfClose(a.target) && b.close()
                }), b.container = x("container", b.wrap)), b.contentContainer = x("content"), b.st.preloader && (b.preloader = x("preloader", b.container, b.st.tLoading));
                var i = a.magnificPopup.modules;
                for (e = 0; e < i.length; e++) {
                    var j = i[e];
                    j = j.charAt(0).toUpperCase() + j.slice(1), b["init" + j].call(b)
                }
                y("BeforeOpen"), b.st.showCloseBtn && (b.st.closeBtnInside ? (w(l, function(a, b, c, d) {
                    c.close_replaceWith = z(d.type)
                }), f += " mfp-close-btn-in") : b.wrap.append(z())), b.st.alignTop && (f += " mfp-align-top"), b.fixedContentPos ? b.wrap.css({
                    overflow: b.st.overflowY,
                    overflowX: "hidden",
                    overflowY: b.st.overflowY
                }) : b.wrap.css({
                    top: v.scrollTop(),
                    position: "absolute"
                }), (b.st.fixedBgPos === !1 || "auto" === b.st.fixedBgPos && !b.fixedContentPos) && b.bgOverlay.css({
                    height: d.height(),
                    position: "absolute"
                }), b.st.enableEscapeKey && d.on("keyup" + p, function(a) {
                    27 === a.keyCode && b.close()
                }), v.on("resize" + p, function() {
                    b.updateSize()
                }), b.st.closeOnContentClick || (f += " mfp-auto-cursor"), f && b.wrap.addClass(f);
                var k = b.wH = v.height(),
                    n = {};
                if (b.fixedContentPos && b._hasScrollBar(k)) {
                    var o = b._getScrollbarSize();
                    o && (n.marginRight = o)
                }
                b.fixedContentPos && (b.isIE7 ? a("body, html").css("overflow", "hidden") : n.overflow = "hidden");
                var r = b.st.mainClass;
                return b.isIE7 && (r += " mfp-ie7"), r && b._addClassToMFP(r), b.updateItemHTML(), y("BuildControls"), a("html").css(n), b.bgOverlay.add(b.wrap).prependTo(b.st.prependTo || a(document.body)), b._lastFocusedEl = document.activeElement, setTimeout(function() {
                    b.content ? (b._addClassToMFP(q), b._setFocus()) : b.bgOverlay.addClass(q), d.on("focusin" + p, b._onFocusIn)
                }, 16), b.isOpen = !0, b.updateSize(k), y(m), c
            },
            close: function() {
                b.isOpen && (y(i), b.isOpen = !1, b.st.removalDelay && !b.isLowIE && b.supportsTransition ? (b._addClassToMFP(r), setTimeout(function() {
                    b._close()
                }, b.st.removalDelay)) : b._close())
            },
            _close: function() {
                y(h);
                var c = r + " " + q + " ";
                if (b.bgOverlay.detach(), b.wrap.detach(), b.container.empty(), b.st.mainClass && (c += b.st.mainClass + " "), b._removeClassFromMFP(c), b.fixedContentPos) {
                    var e = {
                        marginRight: ""
                    };
                    b.isIE7 ? a("body, html").css("overflow", "") : e.overflow = "", a("html").css(e)
                }
                d.off("keyup" + p + " focusin" + p), b.ev.off(p), b.wrap.attr("class", "mfp-wrap").removeAttr("style"), b.bgOverlay.attr("class", "mfp-bg"), b.container.attr("class", "mfp-container"), !b.st.showCloseBtn || b.st.closeBtnInside && b.currTemplate[b.currItem.type] !== !0 || b.currTemplate.closeBtn && b.currTemplate.closeBtn.detach(), b.st.autoFocusLast && b._lastFocusedEl && a(b._lastFocusedEl).focus(), b.currItem = null, b.content = null, b.currTemplate = null, b.prevHeight = 0, y(j)
            },
            updateSize: function(a) {
                if (b.isIOS) {
                    var c = document.documentElement.clientWidth / window.innerWidth,
                        d = window.innerHeight * c;
                    b.wrap.css("height", d), b.wH = d
                } else b.wH = a || v.height();
                b.fixedContentPos || b.wrap.css("height", b.wH), y("Resize")
            },
            updateItemHTML: function() {
                var c = b.items[b.index];
                b.contentContainer.detach(), b.content && b.content.detach(), c.parsed || (c = b.parseEl(b.index));
                var d = c.type;
                if (y("BeforeChange", [b.currItem ? b.currItem.type : "", d]), b.currItem = c, !b.currTemplate[d]) {
                    var f = b.st[d] ? b.st[d].markup : !1;
                    y("FirstMarkupParse", f), f ? b.currTemplate[d] = a(f) : b.currTemplate[d] = !0
                }
                e && e !== c.type && b.container.removeClass("mfp-" + e + "-holder");
                var g = b["get" + d.charAt(0).toUpperCase() + d.slice(1)](c, b.currTemplate[d]);
                b.appendContent(g, d), c.preloaded = !0, y(n, c), e = c.type, b.container.prepend(b.contentContainer), y("AfterChange")
            },
            appendContent: function(a, c) {
                b.content = a, a ? b.st.showCloseBtn && b.st.closeBtnInside && b.currTemplate[c] === !0 ? b.content.find(".mfp-close").length || b.content.append(z()) : b.content = a : b.content = "", y(k), b.container.addClass("mfp-" + c + "-holder"), b.contentContainer.append(b.content)
            },
            parseEl: function(c) {
                var d, e = b.items[c];
                if (e.tagName ? e = {
                        el: a(e)
                    } : (d = e.type, e = {
                        data: e,
                        src: e.src
                    }), e.el) {
                    for (var f = b.types, g = 0; g < f.length; g++)
                        if (e.el.hasClass("mfp-" + f[g])) {
                            d = f[g];
                            break
                        }
                    e.src = e.el.attr("data-mfp-src"), e.src || (e.src = e.el.attr("href"))
                }
                return e.type = d || b.st.type || "inline", e.index = c, e.parsed = !0, b.items[c] = e, y("ElementParse", e), b.items[c]
            },
            addGroup: function(a, c) {
                var d = function(d) {
                    d.mfpEl = this, b._openClick(d, a, c)
                };
                c || (c = {});
                var e = "click.magnificPopup";
                c.mainEl = a, c.items ? (c.isObj = !0, a.off(e).on(e, d)) : (c.isObj = !1, c.delegate ? a.off(e).on(e, c.delegate, d) : (c.items = a, a.off(e).on(e, d)))
            },
            _openClick: function(c, d, e) {
                var f = void 0 !== e.midClick ? e.midClick : a.magnificPopup.defaults.midClick;
                if (f || !(2 === c.which || c.ctrlKey || c.metaKey || c.altKey || c.shiftKey)) {
                    var g = void 0 !== e.disableOn ? e.disableOn : a.magnificPopup.defaults.disableOn;
                    if (g)
                        if (a.isFunction(g)) {
                            if (!g.call(b)) return !0
                        } else if (v.width() < g) return !0;
                    c.type && (c.preventDefault(), b.isOpen && c.stopPropagation()), e.el = a(c.mfpEl), e.delegate && (e.items = d.find(e.delegate)), b.open(e)
                }
            },
            updateStatus: function(a, d) {
                if (b.preloader) {
                    c !== a && b.container.removeClass("mfp-s-" + c), d || "loading" !== a || (d = b.st.tLoading);
                    var e = {
                        status: a,
                        text: d
                    };
                    y("UpdateStatus", e), a = e.status, d = e.text, b.preloader.html(d), b.preloader.find("a").on("click", function(a) {
                        a.stopImmediatePropagation()
                    }), b.container.addClass("mfp-s-" + a), c = a
                }
            },
            _checkIfClose: function(c) {
                if (!a(c).hasClass(s)) {
                    var d = b.st.closeOnContentClick,
                        e = b.st.closeOnBgClick;
                    if (d && e) return !0;
                    if (!b.content || a(c).hasClass("mfp-close") || b.preloader && c === b.preloader[0]) return !0;
                    if (c === b.content[0] || a.contains(b.content[0], c)) {
                        if (d) return !0
                    } else if (e && a.contains(document, c)) return !0;
                    return !1
                }
            },
            _addClassToMFP: function(a) {
                b.bgOverlay.addClass(a), b.wrap.addClass(a)
            },
            _removeClassFromMFP: function(a) {
                this.bgOverlay.removeClass(a), b.wrap.removeClass(a)
            },
            _hasScrollBar: function(a) {
                return (b.isIE7 ? d.height() : document.body.scrollHeight) > (a || v.height())
            },
            _setFocus: function() {
                (b.st.focus ? b.content.find(b.st.focus).eq(0) : b.wrap).focus()
            },
            _onFocusIn: function(c) {
                return c.target === b.wrap[0] || a.contains(b.wrap[0], c.target) ? void 0 : (b._setFocus(), !1)
            },
            _parseMarkup: function(b, c, d) {
                var e;
                d.data && (c = a.extend(d.data, c)), y(l, [b, c, d]), a.each(c, function(c, d) {
                    if (void 0 === d || d === !1) return !0;
                    if (e = c.split("_"), e.length > 1) {
                        var f = b.find(p + "-" + e[0]);
                        if (f.length > 0) {
                            var g = e[1];
                            "replaceWith" === g ? f[0] !== d[0] && f.replaceWith(d) : "img" === g ? f.is("img") ? f.attr("src", d) : f.replaceWith(a("<img>").attr("src", d).attr("class", f.attr("class"))) : f.attr(e[1], d)
                        }
                    } else b.find(p + "-" + c).html(d)
                })
            },
            _getScrollbarSize: function() {
                if (void 0 === b.scrollbarSize) {
                    var a = document.createElement("div");
                    a.style.cssText = "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;", document.body.appendChild(a), b.scrollbarSize = a.offsetWidth - a.clientWidth,
                        document.body.removeChild(a)
                }
                return b.scrollbarSize
            }
        }, a.magnificPopup = {
            instance: null,
            proto: t.prototype,
            modules: [],
            open: function(b, c) {
                return A(), b = b ? a.extend(!0, {}, b) : {}, b.isObj = !0, b.index = c || 0, this.instance.open(b)
            },
            close: function() {
                return a.magnificPopup.instance && a.magnificPopup.instance.close()
            },
            registerModule: function(b, c) {
                c.options && (a.magnificPopup.defaults[b] = c.options), a.extend(this.proto, c.proto), this.modules.push(b)
            },
            defaults: {
                disableOn: 0,
                key: null,
                midClick: !1,
                mainClass: "",
                preloader: !0,
                focus: "",
                closeOnContentClick: !1,
                closeOnBgClick: !0,
                closeBtnInside: !0,
                showCloseBtn: !0,
                enableEscapeKey: !0,
                modal: !1,
                alignTop: !1,
                removalDelay: 0,
                prependTo: null,
                fixedContentPos: "auto",
                fixedBgPos: "auto",
                overflowY: "auto",
                closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',
                tClose: "Close (Esc)",
                tLoading: "Loading...",
                autoFocusLast: !0
            }
        }, a.fn.magnificPopup = function(c) {
            A();
            var d = a(this);
            if ("string" == typeof c)
                if ("open" === c) {
                    var e, f = u ? d.data("magnificPopup") : d[0].magnificPopup,
                        g = parseInt(arguments[1], 10) || 0;
                    f.items ? e = f.items[g] : (e = d, f.delegate && (e = e.find(f.delegate)), e = e.eq(g)), b._openClick({
                        mfpEl: e
                    }, d, f)
                } else b.isOpen && b[c].apply(b, Array.prototype.slice.call(arguments, 1));
            else c = a.extend(!0, {}, c), u ? d.data("magnificPopup", c) : d[0].magnificPopup = c, b.addGroup(d, c);
            return d
        };
        var C, D, E, F = "inline",
            G = function() {
                E && (D.after(E.addClass(C)).detach(), E = null)
            };
        a.magnificPopup.registerModule(F, {
            options: {
                hiddenClass: "hide",
                markup: "",
                tNotFound: "Content not found"
            },
            proto: {
                initInline: function() {
                    b.types.push(F), w(h + "." + F, function() {
                        G()
                    })
                },
                getInline: function(c, d) {
                    if (G(), c.src) {
                        var e = b.st.inline,
                            f = a(c.src);
                        if (f.length) {
                            var g = f[0].parentNode;
                            g && g.tagName && (D || (C = e.hiddenClass, D = x(C), C = "mfp-" + C), E = f.after(D).detach().removeClass(C)), b.updateStatus("ready")
                        } else b.updateStatus("error", e.tNotFound), f = a("<div>");
                        return c.inlineElement = f, f
                    }
                    return b.updateStatus("ready"), b._parseMarkup(d, {}, c), d
                }
            }
        });
        var H, I = "ajax",
            J = function() {
                H && a(document.body).removeClass(H)
            },
            K = function() {
                J(), b.req && b.req.abort()
            };
        a.magnificPopup.registerModule(I, {
            options: {
                settings: null,
                cursor: "mfp-ajax-cur",
                tError: '<a href="%url%">The content</a> could not be loaded.'
            },
            proto: {
                initAjax: function() {
                    b.types.push(I), H = b.st.ajax.cursor, w(h + "." + I, K), w("BeforeChange." + I, K)
                },
                getAjax: function(c) {
                    H && a(document.body).addClass(H), b.updateStatus("loading");
                    var d = a.extend({
                        url: c.src,
                        success: function(d, e, f) {
                            var g = {
                                data: d,
                                xhr: f
                            };
                            y("ParseAjax", g), b.appendContent(a(g.data), I), c.finished = !0, J(), b._setFocus(), setTimeout(function() {
                                b.wrap.addClass(q)
                            }, 16), b.updateStatus("ready"), y("AjaxContentAdded")
                        },
                        error: function() {
                            J(), c.finished = c.loadError = !0, b.updateStatus("error", b.st.ajax.tError.replace("%url%", c.src))
                        }
                    }, b.st.ajax.settings);
                    return b.req = a.ajax(d), ""
                }
            }
        });
        var L, M = function(c) {
            if (c.data && void 0 !== c.data.title) return c.data.title;
            var d = b.st.image.titleSrc;
            if (d) {
                if (a.isFunction(d)) return d.call(b, c);
                if (c.el) return c.el.attr(d) || ""
            }
            return ""
        };
        a.magnificPopup.registerModule("image", {
            options: {
                markup: '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',
                cursor: "mfp-zoom-out-cur",
                titleSrc: "title",
                verticalFit: !0,
                tError: '<a href="%url%">The image</a> could not be loaded.'
            },
            proto: {
                initImage: function() {
                    var c = b.st.image,
                        d = ".image";
                    b.types.push("image"), w(m + d, function() {
                        "image" === b.currItem.type && c.cursor && a(document.body).addClass(c.cursor)
                    }), w(h + d, function() {
                        c.cursor && a(document.body).removeClass(c.cursor), v.off("resize" + p)
                    }), w("Resize" + d, b.resizeImage), b.isLowIE && w("AfterChange", b.resizeImage)
                },
                resizeImage: function() {
                    var a = b.currItem;
                    if (a && a.img && b.st.image.verticalFit) {
                        var c = 0;
                        b.isLowIE && (c = parseInt(a.img.css("padding-top"), 10) + parseInt(a.img.css("padding-bottom"), 10)), a.img.css("max-height", b.wH - c)
                    }
                },
                _onImageHasSize: function(a) {
                    a.img && (a.hasSize = !0, L && clearInterval(L), a.isCheckingImgSize = !1, y("ImageHasSize", a), a.imgHidden && (b.content && b.content.removeClass("mfp-loading"), a.imgHidden = !1))
                },
                findImageSize: function(a) {
                    var c = 0,
                        d = a.img[0],
                        e = function(f) {
                            L && clearInterval(L), L = setInterval(function() {
                                return d.naturalWidth > 0 ? void b._onImageHasSize(a) : (c > 200 && clearInterval(L), c++, void(3 === c ? e(10) : 40 === c ? e(50) : 100 === c && e(500)))
                            }, f)
                        };
                    e(1)
                },
                getImage: function(c, d) {
                    var e = 0,
                        f = function() {
                            c && (c.img[0].complete ? (c.img.off(".mfploader"), c === b.currItem && (b._onImageHasSize(c), b.updateStatus("ready")), c.hasSize = !0, c.loaded = !0, y("ImageLoadComplete")) : (e++, 200 > e ? setTimeout(f, 100) : g()))
                        },
                        g = function() {
                            c && (c.img.off(".mfploader"), c === b.currItem && (b._onImageHasSize(c), b.updateStatus("error", h.tError.replace("%url%", c.src))), c.hasSize = !0, c.loaded = !0, c.loadError = !0)
                        },
                        h = b.st.image,
                        i = d.find(".mfp-img");
                    if (i.length) {
                        var j = document.createElement("img");
                        j.className = "mfp-img", c.el && c.el.find("img").length && (j.alt = c.el.find("img").attr("alt")), c.img = a(j).on("load.mfploader", f).on("error.mfploader", g), j.src = c.src, i.is("img") && (c.img = c.img.clone()), j = c.img[0], j.naturalWidth > 0 ? c.hasSize = !0 : j.width || (c.hasSize = !1)
                    }
                    return b._parseMarkup(d, {
                        title: M(c),
                        img_replaceWith: c.img
                    }, c), b.resizeImage(), c.hasSize ? (L && clearInterval(L), c.loadError ? (d.addClass("mfp-loading"), b.updateStatus("error", h.tError.replace("%url%", c.src))) : (d.removeClass("mfp-loading"), b.updateStatus("ready")), d) : (b.updateStatus("loading"), c.loading = !0, c.hasSize || (c.imgHidden = !0, d.addClass("mfp-loading"), b.findImageSize(c)), d)
                }
            }
        });
        var N, O = function() {
            return void 0 === N && (N = void 0 !== document.createElement("p").style.MozTransform), N
        };
        a.magnificPopup.registerModule("zoom", {
            options: {
                enabled: !1,
                easing: "ease-in-out",
                duration: 300,
                opener: function(a) {
                    return a.is("img") ? a : a.find("img")
                }
            },
            proto: {
                initZoom: function() {
                    var a, c = b.st.zoom,
                        d = ".zoom";
                    if (c.enabled && b.supportsTransition) {
                        var e, f, g = c.duration,
                            j = function(a) {
                                var b = a.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),
                                    d = "all " + c.duration / 1e3 + "s " + c.easing,
                                    e = {
                                        position: "fixed",
                                        zIndex: 9999,
                                        left: 0,
                                        top: 0,
                                        "-webkit-backface-visibility": "hidden"
                                    },
                                    f = "transition";
                                return e["-webkit-" + f] = e["-moz-" + f] = e["-o-" + f] = e[f] = d, b.css(e), b
                            },
                            k = function() {
                                b.content.css("visibility", "visible")
                            };
                        w("BuildControls" + d, function() {
                            if (b._allowZoom()) {
                                if (clearTimeout(e), b.content.css("visibility", "hidden"), a = b._getItemToZoom(), !a) return void k();
                                f = j(a), f.css(b._getOffset()), b.wrap.append(f), e = setTimeout(function() {
                                    f.css(b._getOffset(!0)), e = setTimeout(function() {
                                        k(), setTimeout(function() {
                                            f.remove(), a = f = null, y("ZoomAnimationEnded")
                                        }, 16)
                                    }, g)
                                }, 16)
                            }
                        }), w(i + d, function() {
                            if (b._allowZoom()) {
                                if (clearTimeout(e), b.st.removalDelay = g, !a) {
                                    if (a = b._getItemToZoom(), !a) return;
                                    f = j(a)
                                }
                                f.css(b._getOffset(!0)), b.wrap.append(f), b.content.css("visibility", "hidden"), setTimeout(function() {
                                    f.css(b._getOffset())
                                }, 16)
                            }
                        }), w(h + d, function() {
                            b._allowZoom() && (k(), f && f.remove(), a = null)
                        })
                    }
                },
                _allowZoom: function() {
                    return "image" === b.currItem.type
                },
                _getItemToZoom: function() {
                    return b.currItem.hasSize ? b.currItem.img : !1
                },
                _getOffset: function(c) {
                    var d;
                    d = c ? b.currItem.img : b.st.zoom.opener(b.currItem.el || b.currItem);
                    var e = d.offset(),
                        f = parseInt(d.css("padding-top"), 10),
                        g = parseInt(d.css("padding-bottom"), 10);
                    e.top -= a(window).scrollTop() - f;
                    var h = {
                        width: d.width(),
                        height: (u ? d.innerHeight() : d[0].offsetHeight) - g - f
                    };
                    return O() ? h["-moz-transform"] = h.transform = "translate(" + e.left + "px," + e.top + "px)" : (h.left = e.left, h.top = e.top), h
                }
            }
        });
        var P = "iframe",
            Q = "//about:blank",
            R = function(a) {
                if (b.currTemplate[P]) {
                    var c = b.currTemplate[P].find("iframe");
                    c.length && (a || (c[0].src = Q), b.isIE8 && c.css("display", a ? "block" : "none"))
                }
            };
        a.magnificPopup.registerModule(P, {
            options: {
                markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',
                srcAction: "iframe_src",
                patterns: {
                    youtube: {
                        index: "youtube.com",
                        id: "v=",
                        src: "//www.youtube.com/embed/%id%?autoplay=1"
                    },
                    vimeo: {
                        index: "vimeo.com/",
                        id: "/",
                        src: "//player.vimeo.com/video/%id%?autoplay=1"
                    },
                    gmaps: {
                        index: "//maps.google.",
                        src: "%id%&output=embed"
                    }
                }
            },
            proto: {
                initIframe: function() {
                    b.types.push(P), w("BeforeChange", function(a, b, c) {
                        b !== c && (b === P ? R() : c === P && R(!0))
                    }), w(h + "." + P, function() {
                        R()
                    })
                },
                getIframe: function(c, d) {
                    var e = c.src,
                        f = b.st.iframe;
                    a.each(f.patterns, function() {
                        return e.indexOf(this.index) > -1 ? (this.id && (e = "string" == typeof this.id ? e.substr(e.lastIndexOf(this.id) + this.id.length, e.length) : this.id.call(this, e)), e = this.src.replace("%id%", e), !1) : void 0
                    });
                    var g = {};
                    return f.srcAction && (g[f.srcAction] = e), b._parseMarkup(d, g, c), b.updateStatus("ready"), d
                }
            }
        });
        var S = function(a) {
                var c = b.items.length;
                return a > c - 1 ? a - c : 0 > a ? c + a : a
            },
            T = function(a, b, c) {
                return a.replace(/%curr%/gi, b + 1).replace(/%total%/gi, c)
            };
        a.magnificPopup.registerModule("gallery", {
            options: {
                enabled: !1,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                preload: [0, 2],
                navigateByImgClick: !0,
                arrows: !0,
                tPrev: "Previous (Left arrow key)",
                tNext: "Next (Right arrow key)",
                tCounter: "%curr% of %total%"
            },
            proto: {
                initGallery: function() {
                    var c = b.st.gallery,
                        e = ".mfp-gallery";
                    return b.direction = !0, c && c.enabled ? (f += " mfp-gallery", w(m + e, function() {
                        c.navigateByImgClick && b.wrap.on("click" + e, ".mfp-img", function() {
                            return b.items.length > 1 ? (b.next(), !1) : void 0
                        }), d.on("keydown" + e, function(a) {
                            37 === a.keyCode ? b.prev() : 39 === a.keyCode && b.next()
                        })
                    }), w("UpdateStatus" + e, function(a, c) {
                        c.text && (c.text = T(c.text, b.currItem.index, b.items.length))
                    }), w(l + e, function(a, d, e, f) {
                        var g = b.items.length;
                        e.counter = g > 1 ? T(c.tCounter, f.index, g) : ""
                    }), w("BuildControls" + e, function() {
                        if (b.items.length > 1 && c.arrows && !b.arrowLeft) {
                            var d = c.arrowMarkup,
                                e = b.arrowLeft = a(d.replace(/%title%/gi, c.tPrev).replace(/%dir%/gi, "left")).addClass(s),
                                f = b.arrowRight = a(d.replace(/%title%/gi, c.tNext).replace(/%dir%/gi, "right")).addClass(s);
                            e.click(function() {
                                b.prev()
                            }), f.click(function() {
                                b.next()
                            }), b.container.append(e.add(f))
                        }
                    }), w(n + e, function() {
                        b._preloadTimeout && clearTimeout(b._preloadTimeout), b._preloadTimeout = setTimeout(function() {
                            b.preloadNearbyImages(), b._preloadTimeout = null
                        }, 16)
                    }), void w(h + e, function() {
                        d.off(e), b.wrap.off("click" + e), b.arrowRight = b.arrowLeft = null
                    })) : !1
                },
                next: function() {
                    b.direction = !0, b.index = S(b.index + 1), b.updateItemHTML()
                },
                prev: function() {
                    b.direction = !1, b.index = S(b.index - 1), b.updateItemHTML()
                },
                goTo: function(a) {
                    b.direction = a >= b.index, b.index = a, b.updateItemHTML()
                },
                preloadNearbyImages: function() {
                    var a, c = b.st.gallery.preload,
                        d = Math.min(c[0], b.items.length),
                        e = Math.min(c[1], b.items.length);
                    for (a = 1; a <= (b.direction ? e : d); a++) b._preloadItem(b.index + a);
                    for (a = 1; a <= (b.direction ? d : e); a++) b._preloadItem(b.index - a)
                },
                _preloadItem: function(c) {
                    if (c = S(c), !b.items[c].preloaded) {
                        var d = b.items[c];
                        d.parsed || (d = b.parseEl(c)), y("LazyLoad", d), "image" === d.type && (d.img = a('<img class="mfp-img" />').on("load.mfploader", function() {
                            d.hasSize = !0
                        }).on("error.mfploader", function() {
                            d.hasSize = !0, d.loadError = !0, y("LazyLoadError", d)
                        }).attr("src", d.src)), d.preloaded = !0
                    }
                }
            }
        });
        var U = "retina";
        a.magnificPopup.registerModule(U, {
            options: {
                replaceSrc: function(a) {
                    return a.src.replace(/\.\w+$/, function(a) {
                        return "@2x" + a
                    })
                },
                ratio: 1
            },
            proto: {
                initRetina: function() {
                    if (window.devicePixelRatio > 1) {
                        var a = b.st.retina,
                            c = a.ratio;
                        c = isNaN(c) ? c() : c, c > 1 && (w("ImageHasSize." + U, function(a, b) {
                            b.img.css({
                                "max-width": b.img[0].naturalWidth / c,
                                width: "100%"
                            })
                        }), w("ElementParse." + U, function(b, d) {
                            d.src = a.replaceSrc(d, c)
                        }))
                    }
                }
            }
        }), A()
    }),
    function() {
        ! function(a) {
            return a.fn.stuck = function(b) {
                var c;
                return new(c = function() {
                    function b(b, c) {
                        this.window = b, this.body = a("body"), this.loadElements(), this.calculateTopOffset(), this.isIOS() && this.body.on({
                            touchmove: function(a) {
                                return function() {
                                    return a.update()
                                }
                            }(this)
                        }), this.window.scroll(function(a) {
                            return function() {
                                return a.update()
                            }
                        }(this)), this.window.resize(function(a) {
                            return function() {
                                return a.resize()
                            }
                        }(this)), this.update()
                    }
                    return b.prototype.elements = [], b.prototype.resizing = !1, b.prototype.isIOS = function() {
                        return this._isIOS || (this._isIOS = /(iPad|iPhone|iPod)/g.test(navigator.userAgent))
                    }, b.prototype.resize = function() {
                        this.resizing = !0, this.calculateTopOffset(), this.update()
                    }, b.prototype.loadElements = function() {
                        var b, c, d, e, f, g, h, i, j, k, l;
                        for (d = a(".stuck"), e = d.length, l = 0; e--;) {
                            for (g = d.eq(l), l++, h = !1, c = "", b = g.attr("class").split(/\s+/), i = a("<div/>"), k = b.length; k--;) f = b[k], "release" === f && (h = !0, c = g.closest(".release-container")), "stuck" !== f && "release" !== f && i.addClass(f);
                            i.height(g.outerHeight()).hide().css("background-color", "transparent").insertBefore(g), j = g.offset().top - parseInt(g.css("margin-top")), this.elements.push({
                                node: g,
                                spacer: i,
                                top: j,
                                top_offset: 0,
                                fixed: !1,
                                release: h,
                                container: c,
                                contained: !1
                            })
                        }
                    }, b.prototype.calculateTopOffset = function() {
                        var a, b, c, d, e, f, g, h, i, j, k, l, m;
                        for (g = [], f = this.elements.length, k = 0; f--;)
                            if (d = this.elements[k], k++, l = g.length, 0 === l) d.release || g.push([d]);
                            else {
                                for (a = !1; l-- && !a;)
                                    for (h = 0, e = g[l], m = e.length; m--;) i = e[m], c = this.collide(i.node, d.node), c ? (j = i.top_offset + i.node.outerHeight(!0), j > h && (h = j), a = !0, b = null != g[l + 1] ? l + 1 : -1) : 0 === l && (b = 0);
                                a ? (d.top_offset = h, d.release || (b >= 0 ? g[b].push(d) : g.push([d]))) : (d.top_offset = 0, d.release || g[0].push(d))
                            }
                    }, b.prototype.collide = function(a, b) {
                        var c, d;
                        return c = a.offset().left, d = b.offset().left, c === d ? !0 : d > c ? Math.floor(c) + a.width() > Math.ceil(d) ? !0 : !1 : Math.floor(d) + b.width() > Math.ceil(c) ? !0 : !1
                    }, b.prototype.update = function() {
                        var a, b, c;
                        for (c = this.window.scrollTop(), b = this.elements.length; b--;) a = this.elements[b], this.resizing && (a.fixed ? a.top = a.spacer.offset().top - parseInt(a.spacer.css("margin-top")) : a.top = a.node.offset().top - parseInt(a.node.css("margin-top")), a.fixed && a.node.css({
                            top: a.top_offset,
                            left: a.spacer.offset().left,
                            width: a.spacer.outerWidth()
                        }), a.contained && c > a.container.offset().top + a.container.height() - a.node.height() - a.top_offset && a.node.css({
                            position: "absolute",
                            top: a.container.height() - a.node.height(),
                            left: "",
                            width: "",
                            "z-index": ""
                        })), a.fixed && a.release && !a.contained && c > a.container.offset().top + a.container.height() - a.node.height() - a.top_offset && (a.contained = !0, a.container.css("position", "relative"), a.node.css({
                            position: "absolute",
                            top: a.container.height() - a.node.height(),
                            left: "",
                            width: "",
                            "z-index": ""
                        })), a.contained && c < a.container.offset().top + a.container.height() - a.node.height() - a.top_offset && (a.contained = !1, a.container.css("position", ""), a.node.css({
                            position: "fixed",
                            top: a.top_offset,
                            left: a.spacer.offset().left,
                            width: a.spacer.outerWidth(),
                            "z-index": 99
                        })), !a.fixed && c > a.top - a.top_offset && (a.fixed = !0, a.spacer.show(), a.node.css({
                            position: "fixed",
                            top: a.top_offset,
                            left: a.spacer.offset().left,
                            width: a.spacer.outerWidth(),
                            "z-index": 99
                        })), a.fixed && c < a.top - a.top_offset && (a.fixed = !1, a.spacer.hide(), a.node.css({
                            position: "relative",
                            top: "",
                            left: "",
                            width: "",
                            "z-index": ""
                        }));
                        this.resizing = !1
                    }, b.prototype.destroy = function() {
                        var a;
                        for (a = this.elements.length; a--;) this.elements[a].spacer.remove();
                        this.window.unbind("scroll"), this.window.unbind("resize"), this.window = this.elements = null
                    }, b
                }())(this, b)
            }
        }(jQuery)
    }.call(this), ! function() {
        "use strict";

        function a(d) {
            if (!d) throw new Error("No options passed to Waypoint constructor");
            if (!d.element) throw new Error("No element option passed to Waypoint constructor");
            if (!d.handler) throw new Error("No handler option passed to Waypoint constructor");
            this.key = "waypoint-" + b, this.options = a.Adapter.extend({}, a.defaults, d), this.element = this.options.element, this.adapter = new a.Adapter(this.element), this.callback = d.handler, this.axis = this.options.horizontal ? "horizontal" : "vertical", this.enabled = this.options.enabled, this.triggerPoint = null, this.group = a.Group.findOrCreate({
                name: this.options.group,
                axis: this.axis
            }), this.context = a.Context.findOrCreateByElement(this.options.context), a.offsetAliases[this.options.offset] && (this.options.offset = a.offsetAliases[this.options.offset]), this.group.add(this), this.context.add(this), c[this.key] = this, b += 1
        }
        var b = 0,
            c = {};
        a.prototype.queueTrigger = function(a) {
            this.group.queueTrigger(this, a)
        }, a.prototype.trigger = function(a) {
            this.enabled && this.callback && this.callback.apply(this, a)
        }, a.prototype.destroy = function() {
            this.context.remove(this), this.group.remove(this), delete c[this.key]
        }, a.prototype.disable = function() {
            return this.enabled = !1, this
        }, a.prototype.enable = function() {
            return this.context.refresh(), this.enabled = !0, this
        }, a.prototype.next = function() {
            return this.group.next(this)
        }, a.prototype.previous = function() {
            return this.group.previous(this)
        }, a.invokeAll = function(a) {
            var b = [];
            for (var d in c) b.push(c[d]);
            for (var e = 0, f = b.length; f > e; e++) b[e][a]()
        }, a.destroyAll = function() {
            a.invokeAll("destroy")
        }, a.disableAll = function() {
            a.invokeAll("disable")
        }, a.enableAll = function() {
            a.Context.refreshAll();
            for (var b in c) c[b].enabled = !0;
            return this
        }, a.refreshAll = function() {
            a.Context.refreshAll()
        }, a.viewportHeight = function() {
            return window.innerHeight || document.documentElement.clientHeight
        }, a.viewportWidth = function() {
            return document.documentElement.clientWidth
        }, a.adapters = [], a.defaults = {
            context: window,
            continuous: !0,
            enabled: !0,
            group: "default",
            horizontal: !1,
            offset: 0
        }, a.offsetAliases = {
            "bottom-in-view": function() {
                return this.context.innerHeight() - this.adapter.outerHeight()
            },
            "right-in-view": function() {
                return this.context.innerWidth() - this.adapter.outerWidth()
            }
        }, window.Waypoint = a
    }(),
    function() {
        "use strict";

        function a(a) {
            window.setTimeout(a, 1e3 / 60)
        }

        function b(a) {
            this.element = a, this.Adapter = e.Adapter, this.adapter = new this.Adapter(a), this.key = "waypoint-context-" + c, this.didScroll = !1, this.didResize = !1, this.oldScroll = {
                x: this.adapter.scrollLeft(),
                y: this.adapter.scrollTop()
            }, this.waypoints = {
                vertical: {},
                horizontal: {}
            }, a.waypointContextKey = this.key, d[a.waypointContextKey] = this, c += 1, e.windowContext || (e.windowContext = !0, e.windowContext = new b(window)), this.createThrottledScrollHandler(), this.createThrottledResizeHandler()
        }
        var c = 0,
            d = {},
            e = window.Waypoint,
            f = window.onload;
        b.prototype.add = function(a) {
            var b = a.options.horizontal ? "horizontal" : "vertical";
            this.waypoints[b][a.key] = a, this.refresh()
        }, b.prototype.checkEmpty = function() {
            var a = this.Adapter.isEmptyObject(this.waypoints.horizontal),
                b = this.Adapter.isEmptyObject(this.waypoints.vertical),
                c = this.element == this.element.window;
            a && b && !c && (this.adapter.off(".waypoints"), delete d[this.key])
        }, b.prototype.createThrottledResizeHandler = function() {
            function a() {
                b.handleResize(), b.didResize = !1
            }
            var b = this;
            this.adapter.on("resize.waypoints", function() {
                b.didResize || (b.didResize = !0, e.requestAnimationFrame(a))
            })
        }, b.prototype.createThrottledScrollHandler = function() {
            function a() {
                b.handleScroll(), b.didScroll = !1
            }
            var b = this;
            this.adapter.on("scroll.waypoints", function() {
                (!b.didScroll || e.isTouch) && (b.didScroll = !0, e.requestAnimationFrame(a))
            })
        }, b.prototype.handleResize = function() {
            e.Context.refreshAll()
        }, b.prototype.handleScroll = function() {
            var a = {},
                b = {
                    horizontal: {
                        newScroll: this.adapter.scrollLeft(),
                        oldScroll: this.oldScroll.x,
                        forward: "right",
                        backward: "left"
                    },
                    vertical: {
                        newScroll: this.adapter.scrollTop(),
                        oldScroll: this.oldScroll.y,
                        forward: "down",
                        backward: "up"
                    }
                };
            for (var c in b) {
                var d = b[c],
                    e = d.newScroll > d.oldScroll,
                    f = e ? d.forward : d.backward;
                for (var g in this.waypoints[c]) {
                    var h = this.waypoints[c][g];
                    if (null !== h.triggerPoint) {
                        var i = d.oldScroll < h.triggerPoint,
                            j = d.newScroll >= h.triggerPoint,
                            k = i && j,
                            l = !i && !j;
                        (k || l) && (h.queueTrigger(f), a[h.group.id] = h.group)
                    }
                }
            }
            for (var m in a) a[m].flushTriggers();
            this.oldScroll = {
                x: b.horizontal.newScroll,
                y: b.vertical.newScroll
            }
        }, b.prototype.innerHeight = function() {
            return this.element == this.element.window ? e.viewportHeight() : this.adapter.innerHeight()
        }, b.prototype.remove = function(a) {
            delete this.waypoints[a.axis][a.key], this.checkEmpty()
        }, b.prototype.innerWidth = function() {
            return this.element == this.element.window ? e.viewportWidth() : this.adapter.innerWidth()
        }, b.prototype.destroy = function() {
            var a = [];
            for (var b in this.waypoints)
                for (var c in this.waypoints[b]) a.push(this.waypoints[b][c]);
            for (var d = 0, e = a.length; e > d; d++) a[d].destroy()
        }, b.prototype.refresh = function() {
            var a, b = this.element == this.element.window,
                c = b ? void 0 : this.adapter.offset(),
                d = {};
            this.handleScroll(), a = {
                horizontal: {
                    contextOffset: b ? 0 : c.left,
                    contextScroll: b ? 0 : this.oldScroll.x,
                    contextDimension: this.innerWidth(),
                    oldScroll: this.oldScroll.x,
                    forward: "right",
                    backward: "left",
                    offsetProp: "left"
                },
                vertical: {
                    contextOffset: b ? 0 : c.top,
                    contextScroll: b ? 0 : this.oldScroll.y,
                    contextDimension: this.innerHeight(),
                    oldScroll: this.oldScroll.y,
                    forward: "down",
                    backward: "up",
                    offsetProp: "top"
                }
            };
            for (var f in a) {
                var g = a[f];
                for (var h in this.waypoints[f]) {
                    var i, j, k, l, m, n = this.waypoints[f][h],
                        o = n.options.offset,
                        p = n.triggerPoint,
                        q = 0,
                        r = null == p;
                    n.element !== n.element.window && (q = n.adapter.offset()[g.offsetProp]), "function" == typeof o ? o = o.apply(n) : "string" == typeof o && (o = parseFloat(o), n.options.offset.indexOf("%") > -1 && (o = Math.ceil(g.contextDimension * o / 100))), i = g.contextScroll - g.contextOffset, n.triggerPoint = Math.floor(q + i - o), j = p < g.oldScroll, k = n.triggerPoint >= g.oldScroll, l = j && k, m = !j && !k, !r && l ? (n.queueTrigger(g.backward), d[n.group.id] = n.group) : !r && m ? (n.queueTrigger(g.forward), d[n.group.id] = n.group) : r && g.oldScroll >= n.triggerPoint && (n.queueTrigger(g.forward), d[n.group.id] = n.group)
                }
            }
            return e.requestAnimationFrame(function() {
                for (var a in d) d[a].flushTriggers()
            }), this
        }, b.findOrCreateByElement = function(a) {
            return b.findByElement(a) || new b(a)
        }, b.refreshAll = function() {
            for (var a in d) d[a].refresh()
        }, b.findByElement = function(a) {
            return d[a.waypointContextKey]
        }, window.onload = function() {
            f && f(), b.refreshAll()
        }, e.requestAnimationFrame = function(b) {
            var c = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || a;
            c.call(window, b)
        }, e.Context = b
    }(),
    function() {
        "use strict";

        function a(a, b) {
            return a.triggerPoint - b.triggerPoint
        }

        function b(a, b) {
            return b.triggerPoint - a.triggerPoint
        }

        function c(a) {
            this.name = a.name, this.axis = a.axis, this.id = this.name + "-" + this.axis, this.waypoints = [], this.clearTriggerQueues(), d[this.axis][this.name] = this
        }
        var d = {
                vertical: {},
                horizontal: {}
            },
            e = window.Waypoint;
        c.prototype.add = function(a) {
            this.waypoints.push(a)
        }, c.prototype.clearTriggerQueues = function() {
            this.triggerQueues = {
                up: [],
                down: [],
                left: [],
                right: []
            }
        }, c.prototype.flushTriggers = function() {
            for (var c in this.triggerQueues) {
                var d = this.triggerQueues[c],
                    e = "up" === c || "left" === c;
                d.sort(e ? b : a);
                for (var f = 0, g = d.length; g > f; f += 1) {
                    var h = d[f];
                    (h.options.continuous || f === d.length - 1) && h.trigger([c])
                }
            }
            this.clearTriggerQueues()
        }, c.prototype.next = function(b) {
            this.waypoints.sort(a);
            var c = e.Adapter.inArray(b, this.waypoints),
                d = c === this.waypoints.length - 1;
            return d ? null : this.waypoints[c + 1]
        }, c.prototype.previous = function(b) {
            this.waypoints.sort(a);
            var c = e.Adapter.inArray(b, this.waypoints);
            return c ? this.waypoints[c - 1] : null
        }, c.prototype.queueTrigger = function(a, b) {
            this.triggerQueues[b].push(a)
        }, c.prototype.remove = function(a) {
            var b = e.Adapter.inArray(a, this.waypoints);
            b > -1 && this.waypoints.splice(b, 1)
        }, c.prototype.first = function() {
            return this.waypoints[0]
        }, c.prototype.last = function() {
            return this.waypoints[this.waypoints.length - 1]
        }, c.findOrCreate = function(a) {
            return d[a.axis][a.name] || new c(a)
        }, e.Group = c
    }(),
    function() {
        "use strict";

        function a(a) {
            this.$element = b(a)
        }
        var b = window.jQuery,
            c = window.Waypoint;
        b.each(["innerHeight", "innerWidth", "off", "offset", "on", "outerHeight", "outerWidth", "scrollLeft", "scrollTop"], function(b, c) {
            a.prototype[c] = function() {
                var a = Array.prototype.slice.call(arguments);
                return this.$element[c].apply(this.$element, a)
            }
        }), b.each(["extend", "inArray", "isEmptyObject"], function(c, d) {
            a[d] = b[d]
        }), c.adapters.push({
            name: "jquery",
            Adapter: a
        }), c.Adapter = a
    }(),
    function() {
        "use strict";

        function a(a) {
            return function() {
                var c = [],
                    d = arguments[0];
                return a.isFunction(arguments[0]) && (d = a.extend({}, arguments[1]), d.handler = arguments[0]), this.each(function() {
                    var e = a.extend({}, d, {
                        element: this
                    });
                    "string" == typeof e.context && (e.context = a(this).closest(e.context)[0]), c.push(new b(e))
                }), c
            }
        }
        var b = window.Waypoint;
        window.jQuery && (window.jQuery.fn.waypoint = a(window.jQuery)), window.Zepto && (window.Zepto.fn.waypoint = a(window.Zepto))
    }(),
    function(a) {
        "use strict";

        function b(b, d) {
            var e, g, h = b.data("width"),
                i = b.data("height"),
                j = b.attr("title") || b.data("title"),
                k = b.data("display-title"),
                l = b.data("ratio") ? b.data("ratio") : d.default_ratio,
                m = b.data("display-duration"),
                n = b.data("youtube-id"),
                o = [],
                p = b.text() ? b.text() : d.loading_text,
                q = ["https://www.googleapis.com/youtube/v3/videos?id=", n, "&key=", d.yt_api_key, "&part=snippet"].join(""),
                r = b.data("parameters") || "";
            l = l.split(":"), r += "&" + d.youtube_parameters, "boolean" != typeof k && (k = d.display_title), "boolean" != typeof m && (m = d.display_duration), "number" == typeof h && "number" == typeof i ? (b.width(h), e = i + "px") : "number" == typeof h ? (b.width(h), e = h * l[1] / l[0] + "px") : (h = b.width(), 0 == h && (h = b.parent().width()), e = l[1] / l[0] * 100 + "%"), o.push('<div class="ytp-thumbnail">'), o.push('<button class="ytp-large-play-button ytp-button" tabindex="23" aria-live="assertive"'), 320 >= h ? o.push(' style="transform: scale(0.61);"') : 640 >= h && o.push(' style="transform: scale(0.85);"'), k && j && o.push(' aria-label="', j, '"'), o.push(">"), o.push('<svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%">'), o.push('<path class="ytp-large-play-button-bg" d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z" fill="#1f1f1e" fill-opacity="0.9"></path>'), o.push('<path d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff"></path>'), o.push('<path d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z" fill="#ccc"></path>'), o.push("</svg>"), o.push("</button>"), o.push('<div class="ytp-spinner" data-layer="4">'), o.push('<span class="ytp-spinner-svg">'), o.push('<svg height="100%" version="1.1" viewBox="0 0 22 22" width="100%">'), o.push('<svg x="7" y="1"><circle class="ytp-spinner-dot ytp-spinner-dot-0" cx="4" cy="4" r="2"></circle></svg>'), o.push('<svg x="11" y="3"><circle class="ytp-spinner-dot ytp-spinner-dot-1" cx="4" cy="4" r="2"></circle></svg>'), o.push('<svg x="13" y="7"><circle class="ytp-spinner-dot ytp-spinner-dot-2" cx="4" cy="4" r="2"></circle></svg>'), o.push('<svg x="11" y="11"><circle class="ytp-spinner-dot ytp-spinner-dot-3" cx="4" cy="4" r="2"></circle></svg>'), o.push('<svg x="7" y="13"><circle class="ytp-spinner-dot ytp-spinner-dot-4" cx="4" cy="4" r="2"></circle></svg>'), o.push('<svg x="3" y="11"><circle class="ytp-spinner-dot ytp-spinner-dot-5" cx="4" cy="4" r="2"></circle></svg>'), o.push('<svg x="1" y="7"><circle class="ytp-spinner-dot ytp-spinner-dot-6" cx="4" cy="4" r="2"></circle></svg>'), o.push('<svg x="3" y="3"><circle class="ytp-spinner-dot ytp-spinner-dot-7" cx="4" cy="4" r="2"></circle></svg>'), o.push("</svg>"), o.push("</span>"), o.push('<div class="ytp-spinner-message" style="display: none;">If playback doesn\'t begin shortly, try restarting your device.</div>'), o.push("</div>"), m && o.push('<span class="video-time" style="display:none;"></span>'), o.push("</div>"), k && (o.push('<div class="ytp-gradient-top"></div>'), o.push('<div class="ytp-chrome-top">'), o.push('<div class="ytp-title">'), o.push('<div class="ytp-title-text">'), o.push('<a id="lazyYT-title-', n, '" class="ytp-title-link" tabindex="13" target="_blank" data-sessionlink="feature=player-title" href="https://www.youtube.com/watch?v=', n, '">'), o.push(j ? j : p), o.push("</a>"), o.push("</div>"), o.push("</div>"), o.push("</div>")), b.css({
                "padding-bottom": e
            }).html(o.join("")), g = b.find(".ytp-thumbnail").on("click", function(a) {
                a.preventDefault(), b.hasClass(d.video_loaded_class) || (b.html('<iframe src="https://www.youtube.com/embed/' + n + "?" + r + '&autoplay=1" frameborder="0" allowfullscreen></iframe>').addClass(d.video_loaded_class), "function" == typeof d.callback && d.callback.call(b))
            }), c(n, h, g, q), (!j && k || m) && (m && (q += ",contentDetails"), a.getJSON(q, function(a) {
                var c = a.items[0];
                b.find("#lazyYT-title-" + n).text(c.snippet.title), m && b.find(".video-time").text(f(c.contentDetails.duration, d)).show()
            }))
        }

        function c(b, c, f, g) {
            var h, i, j = new Image;
            0 == c && (c = f.width()), h = c > 640 ? "maxresdefault.jpg" : c > 480 ? "sddefault.jpg" : c > 320 ? "hqdefault.jpg" : c > 120 ? "mqdefault.jpg" : 0 == c ? "hqdefault.jpg" : "default.jpg", i = ["https://img.youtube.com/vi/", b, "/", h].join(""), j.onload = function(b) {
                var h = e(b, "naturalWidth");
                c > h ? a.getJSON(g, function(a) {
                    var b = a.items[0],
                        e = b.snippet.thumbnails;
                    0 == c && (c = f.width()), i = c > 640 && "object" == typeof e.maxres ? e.maxres.url : c > 480 && "object" == typeof e.standard ? e.standard.url : c > 320 && "object" == typeof e.high ? e.high.url : c > 120 && "object" == typeof e.medium ? e.medium.url : e["default"].url, d(f, i)
                }) : d(f, this.src)
            }, j.src = i
        }

        function d(a, b) {
            a.css({
                "background-image": ["url(", b, ")"].join("")
            }).addClass("lazyYT-image-loaded")
        }

        function e(a, b) {
            var c;
            return c = "object" == typeof a.path ? a.path[0] : "object" == typeof a.target ? a.target : a.originalTarget, c.naturalWidth
        }

        function f(a, b) {
            for (var c = [], d = 0, e = a.match(/P(?:(\d*)Y)?(?:(\d*)M)?(?:(\d*)W)?(?:(\d*)D)?T(?:(\d*)H)?(?:(\d*)M)?(?:(\d*)S)?/i), f = [{
                    pos: 1,
                    multiplier: 31536e3
                }, {
                    pos: 2,
                    multiplier: 2592e3
                }, {
                    pos: 3,
                    multiplier: 604800
                }, {
                    pos: 4,
                    multiplier: 86400
                }, {
                    pos: 5,
                    multiplier: 3600
                }, {
                    pos: 6,
                    multiplier: 60
                }, {
                    pos: 7,
                    multiplier: 1
                }], g = 0; g < f.length; g++) "undefined" != typeof e[f[g].pos] && (d += parseInt(e[f[g].pos]) * f[g].multiplier);
            return d > 3599 && (c.push(parseInt(d / 3600)), d %= 3600), c.push(("0" + parseInt(d / 60)).slice(-2)), c.push(("0" + d % 60).slice(-2)), c.join(":")
        }
        a.fn.lazyYT = function(c, d) {
            var e = {
                    yt_api_key: c,
                    youtube_parameters: "rel=0",
                    loading_text: "Loading...",
                    display_title: !0,
                    default_ratio: "16:9",
                    display_duration: !1,
                    callback: null,
                    video_loaded_class: "lazyYT-video-loaded",
                    container_class: "lazyYT-container"
                },
                f = a.extend(e, d);
            return this.each(function() {
                var c = a(this).addClass(f.container_class);
                b(c, f)
            })
        }
    }(jQuery);
var _createClass = function() {
    function a(a, b) {
        for (var c = 0; c < b.length; c++) {
            var d = b[c];
            d.enumerable = d.enumerable || !1, d.configurable = !0, "value" in d && (d.writable = !0), Object.defineProperty(a, d.key, d)
        }
    }
    return function(b, c, d) {
        return c && a(b.prototype, c), d && a(b, d), b
    }
}();
"undefined" == typeof jQuery && ("function" == typeof require ? jQuery = $ = require("jquery") : jQuery = $),
    function(a) {
        "function" == typeof define && define.amd ? define(["jquery"], function(b) {
            return a(b)
        }) : "object" == typeof module && "object" == typeof module.exports ? exports = a(require("jquery")) : a(jQuery)
    }(function(a) {
        function b(a) {
            var b = 7.5625,
                c = 2.75;
            return 1 / c > a ? b * a * a : 2 / c > a ? b * (a -= 1.5 / c) * a + .75 : 2.5 / c > a ? b * (a -= 2.25 / c) * a + .9375 : b * (a -= 2.625 / c) * a + .984375
        }
        a.easing.jswing = a.easing.swing;
        var c = Math.pow,
            d = Math.sqrt,
            e = Math.sin,
            f = Math.cos,
            g = Math.PI,
            h = 1.70158,
            i = 1.525 * h,
            j = h + 1,
            k = 2 * g / 3,
            l = 2 * g / 4.5;
        a.extend(a.easing, {
            def: "easeOutQuad",
            swing: function(b) {
                return a.easing[a.easing.def](b)
            },
            easeInQuad: function(a) {
                return a * a
            },
            easeOutQuad: function(a) {
                return 1 - (1 - a) * (1 - a)
            },
            easeInOutQuad: function(a) {
                return .5 > a ? 2 * a * a : 1 - c(-2 * a + 2, 2) / 2
            },
            easeInCubic: function(a) {
                return a * a * a
            },
            easeOutCubic: function(a) {
                return 1 - c(1 - a, 3)
            },
            easeInOutCubic: function(a) {
                return .5 > a ? 4 * a * a * a : 1 - c(-2 * a + 2, 3) / 2
            },
            easeInQuart: function(a) {
                return a * a * a * a
            },
            easeOutQuart: function(a) {
                return 1 - c(1 - a, 4)
            },
            easeInOutQuart: function(a) {
                return .5 > a ? 8 * a * a * a * a : 1 - c(-2 * a + 2, 4) / 2
            },
            easeInQuint: function(a) {
                return a * a * a * a * a
            },
            easeOutQuint: function(a) {
                return 1 - c(1 - a, 5)
            },
            easeInOutQuint: function(a) {
                return .5 > a ? 16 * a * a * a * a * a : 1 - c(-2 * a + 2, 5) / 2
            },
            easeInSine: function(a) {
                return 1 - f(a * g / 2)
            },
            easeOutSine: function(a) {
                return e(a * g / 2)
            },
            easeInOutSine: function(a) {
                return -(f(g * a) - 1) / 2
            },
            easeInExpo: function(a) {
                return 0 === a ? 0 : c(2, 10 * a - 10)
            },
            easeOutExpo: function(a) {
                return 1 === a ? 1 : 1 - c(2, -10 * a)
            },
            easeInOutExpo: function(a) {
                return 0 === a ? 0 : 1 === a ? 1 : .5 > a ? c(2, 20 * a - 10) / 2 : (2 - c(2, -20 * a + 10)) / 2
            },
            easeInCirc: function(a) {
                return 1 - d(1 - c(a, 2))
            },
            easeOutCirc: function(a) {
                return d(1 - c(a - 1, 2))
            },
            easeInOutCirc: function(a) {
                return .5 > a ? (1 - d(1 - c(2 * a, 2))) / 2 : (d(1 - c(-2 * a + 2, 2)) + 1) / 2
            },
            easeInElastic: function(a) {
                return 0 === a ? 0 : 1 === a ? 1 : -c(2, 10 * a - 10) * e((10 * a - 10.75) * k)
            },
            easeOutElastic: function(a) {
                return 0 === a ? 0 : 1 === a ? 1 : c(2, -10 * a) * e((10 * a - .75) * k) + 1
            },
            easeInOutElastic: function(a) {
                return 0 === a ? 0 : 1 === a ? 1 : .5 > a ? -(c(2, 20 * a - 10) * e((20 * a - 11.125) * l)) / 2 : c(2, -20 * a + 10) * e((20 * a - 11.125) * l) / 2 + 1
            },
            easeInBack: function(a) {
                return j * a * a * a - h * a * a
            },
            easeOutBack: function(a) {
                return 1 + j * c(a - 1, 3) + h * c(a - 1, 2)
            },
            easeInOutBack: function(a) {
                return .5 > a ? c(2 * a, 2) * (2 * (i + 1) * a - i) / 2 : (c(2 * a - 2, 2) * ((i + 1) * (2 * a - 2) + i) + 2) / 2
            },
            easeInBounce: function(a) {
                return 1 - b(1 - a)
            },
            easeOutBounce: b,
            easeInOutBounce: function(a) {
                return .5 > a ? (1 - b(1 - 2 * a)) / 2 : (1 + b(2 * a - 1)) / 2
            }
        })
    }), jQuery.extend(jQuery.easing, {
        easeInOutMaterial: function(a, b, c, d, e) {
            return (b /= e / 2) < 1 ? d / 2 * b * b + c : d / 4 * ((b -= 2) * b * b + 2) + c
        }
    }), jQuery.Velocity ? console.log("Velocity is already loaded. You may be needlessly importing Velocity again; note that Materialize includes Velocity.") : (! function(a) {
        function b(a) {
            var b = a.length,
                d = c.type(a);
            return "function" === d || c.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === d || 0 === b || "number" == typeof b && b > 0 && b - 1 in a
        }
        if (!a.jQuery) {
            var c = function(a, b) {
                return new c.fn.init(a, b)
            };
            c.isWindow = function(a) {
                return null != a && a == a.window
            }, c.type = function(a) {
                return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? e[g.call(a)] || "object" : typeof a
            }, c.isArray = Array.isArray || function(a) {
                return "array" === c.type(a)
            }, c.isPlainObject = function(a) {
                var b;
                if (!a || "object" !== c.type(a) || a.nodeType || c.isWindow(a)) return !1;
                try {
                    if (a.constructor && !f.call(a, "constructor") && !f.call(a.constructor.prototype, "isPrototypeOf")) return !1
                } catch (d) {
                    return !1
                }
                for (b in a);
                return void 0 === b || f.call(a, b)
            }, c.each = function(a, c, d) {
                var e, f = 0,
                    g = a.length,
                    h = b(a);
                if (d) {
                    if (h)
                        for (; g > f && (e = c.apply(a[f], d), e !== !1); f++);
                    else
                        for (f in a)
                            if (e = c.apply(a[f], d), e === !1) break
                } else if (h)
                    for (; g > f && (e = c.call(a[f], f, a[f]), e !== !1); f++);
                else
                    for (f in a)
                        if (e = c.call(a[f], f, a[f]), e === !1) break; return a
            }, c.data = function(a, b, e) {
                if (void 0 === e) {
                    var f = a[c.expando],
                        g = f && d[f];
                    if (void 0 === b) return g;
                    if (g && b in g) return g[b]
                } else if (void 0 !== b) {
                    var f = a[c.expando] || (a[c.expando] = ++c.uuid);
                    return d[f] = d[f] || {}, d[f][b] = e, e
                }
            }, c.removeData = function(a, b) {
                var e = a[c.expando],
                    f = e && d[e];
                f && c.each(b, function(a, b) {
                    delete f[b]
                })
            }, c.extend = function() {
                var a, b, d, e, f, g, h = arguments[0] || {},
                    i = 1,
                    j = arguments.length,
                    k = !1;
                for ("boolean" == typeof h && (k = h, h = arguments[i] || {}, i++), "object" != typeof h && "function" !== c.type(h) && (h = {}), i === j && (h = this, i--); j > i; i++)
                    if (null != (f = arguments[i]))
                        for (e in f) a = h[e], d = f[e], h !== d && (k && d && (c.isPlainObject(d) || (b = c.isArray(d))) ? (b ? (b = !1, g = a && c.isArray(a) ? a : []) : g = a && c.isPlainObject(a) ? a : {}, h[e] = c.extend(k, g, d)) : void 0 !== d && (h[e] = d));
                return h
            }, c.queue = function(a, d, e) {
                function f(a, c) {
                    var d = c || [];
                    return null != a && (b(Object(a)) ? ! function(a, b) {
                        for (var c = +b.length, d = 0, e = a.length; c > d;) a[e++] = b[d++];
                        if (c !== c)
                            for (; void 0 !== b[d];) a[e++] = b[d++];
                        return a.length = e, a
                    }(d, "string" == typeof a ? [a] : a) : [].push.call(d, a)), d
                }
                if (a) {
                    d = (d || "fx") + "queue";
                    var g = c.data(a, d);
                    return e ? (!g || c.isArray(e) ? g = c.data(a, d, f(e)) : g.push(e), g) : g || []
                }
            }, c.dequeue = function(a, b) {
                c.each(a.nodeType ? [a] : a, function(a, d) {
                    b = b || "fx";
                    var e = c.queue(d, b),
                        f = e.shift();
                    "inprogress" === f && (f = e.shift()), f && ("fx" === b && e.unshift("inprogress"), f.call(d, function() {
                        c.dequeue(d, b)
                    }))
                })
            }, c.fn = c.prototype = {
                init: function(a) {
                    if (a.nodeType) return this[0] = a, this;
                    throw new Error("Not a DOM node.")
                },
                offset: function() {
                    var b = this[0].getBoundingClientRect ? this[0].getBoundingClientRect() : {
                        top: 0,
                        left: 0
                    };
                    return {
                        top: b.top + (a.pageYOffset || document.scrollTop || 0) - (document.clientTop || 0),
                        left: b.left + (a.pageXOffset || document.scrollLeft || 0) - (document.clientLeft || 0)
                    }
                },
                position: function() {
                    function a() {
                        for (var a = this.offsetParent || document; a && "html" === !a.nodeType.toLowerCase && "static" === a.style.position;) a = a.offsetParent;
                        return a || document
                    }
                    var b = this[0],
                        a = a.apply(b),
                        d = this.offset(),
                        e = /^(?:body|html)$/i.test(a.nodeName) ? {
                            top: 0,
                            left: 0
                        } : c(a).offset();
                    return d.top -= parseFloat(b.style.marginTop) || 0, d.left -= parseFloat(b.style.marginLeft) || 0, a.style && (e.top += parseFloat(a.style.borderTopWidth) || 0, e.left += parseFloat(a.style.borderLeftWidth) || 0), {
                        top: d.top - e.top,
                        left: d.left - e.left
                    }
                }
            };
            var d = {};
            c.expando = "velocity" + (new Date).getTime(), c.uuid = 0;
            for (var e = {}, f = e.hasOwnProperty, g = e.toString, h = "Boolean Number String Function Array Date RegExp Object Error".split(" "), i = 0; i < h.length; i++) e["[object " + h[i] + "]"] = h[i].toLowerCase();
            c.fn.init.prototype = c.fn, a.Velocity = {
                Utilities: c
            }
        }
    }(window), function(a) {
        "object" == typeof module && "object" == typeof module.exports ? module.exports = a() : "function" == typeof define && define.amd ? define(a) : a()
    }(function() {
        return function(a, b, c, d) {
            function e(a) {
                for (var b = -1, c = a ? a.length : 0, d = []; ++b < c;) {
                    var e = a[b];
                    e && d.push(e)
                }
                return d
            }

            function f(a) {
                return p.isWrapped(a) ? a = [].slice.call(a) : p.isNode(a) && (a = [a]), a
            }

            function g(a) {
                var b = m.data(a, "velocity");
                return null === b ? d : b
            }

            function h(a) {
                return function(b) {
                    return Math.round(b * a) * (1 / a)
                }
            }

            function i(a, c, d, e) {
                function f(a, b) {
                    return 1 - 3 * b + 3 * a
                }

                function g(a, b) {
                    return 3 * b - 6 * a
                }

                function h(a) {
                    return 3 * a
                }

                function i(a, b, c) {
                    return ((f(b, c) * a + g(b, c)) * a + h(b)) * a
                }

                function j(a, b, c) {
                    return 3 * f(b, c) * a * a + 2 * g(b, c) * a + h(b)
                }

                function k(b, c) {
                    for (var e = 0; p > e; ++e) {
                        var f = j(c, a, d);
                        if (0 === f) return c;
                        var g = i(c, a, d) - b;
                        c -= g / f
                    }
                    return c
                }

                function l() {
                    for (var b = 0; t > b; ++b) x[b] = i(b * u, a, d)
                }

                function m(b, c, e) {
                    var f, g, h = 0;
                    do g = c + (e - c) / 2, f = i(g, a, d) - b, f > 0 ? e = g : c = g; while (Math.abs(f) > r && ++h < s);
                    return g
                }

                function n(b) {
                    for (var c = 0, e = 1, f = t - 1; e != f && x[e] <= b; ++e) c += u;
                    --e;
                    var g = (b - x[e]) / (x[e + 1] - x[e]),
                        h = c + g * u,
                        i = j(h, a, d);
                    return i >= q ? k(b, h) : 0 == i ? h : m(b, c, c + u)
                }

                function o() {
                    y = !0, (a != c || d != e) && l()
                }
                var p = 4,
                    q = .001,
                    r = 1e-7,
                    s = 10,
                    t = 11,
                    u = 1 / (t - 1),
                    v = "Float32Array" in b;
                if (4 !== arguments.length) return !1;
                for (var w = 0; 4 > w; ++w)
                    if ("number" != typeof arguments[w] || isNaN(arguments[w]) || !isFinite(arguments[w])) return !1;
                a = Math.min(a, 1), d = Math.min(d, 1), a = Math.max(a, 0), d = Math.max(d, 0);
                var x = v ? new Float32Array(t) : new Array(t),
                    y = !1,
                    z = function(b) {
                        return y || o(), a === c && d === e ? b : 0 === b ? 0 : 1 === b ? 1 : i(n(b), c, e)
                    };
                z.getControlPoints = function() {
                    return [{
                        x: a,
                        y: c
                    }, {
                        x: d,
                        y: e
                    }]
                };
                var A = "generateBezier(" + [a, c, d, e] + ")";
                return z.toString = function() {
                    return A
                }, z
            }

            function j(a, b) {
                var c = a;
                return p.isString(a) ? t.Easings[a] || (c = !1) : c = p.isArray(a) && 1 === a.length ? h.apply(null, a) : p.isArray(a) && 2 === a.length ? u.apply(null, a.concat([b])) : p.isArray(a) && 4 === a.length ? i.apply(null, a) : !1, c === !1 && (c = t.Easings[t.defaults.easing] ? t.defaults.easing : s), c
            }

            function k(a) {
                if (a) {
                    var b = (new Date).getTime(),
                        c = t.State.calls.length;
                    c > 1e4 && (t.State.calls = e(t.State.calls));
                    for (var f = 0; c > f; f++)
                        if (t.State.calls[f]) {
                            var h = t.State.calls[f],
                                i = h[0],
                                j = h[2],
                                n = h[3],
                                o = !!n,
                                q = null;
                            n || (n = t.State.calls[f][3] = b - 16);
                            for (var r = Math.min((b - n) / j.duration, 1), s = 0, u = i.length; u > s; s++) {
                                var w = i[s],
                                    y = w.element;
                                if (g(y)) {
                                    var z = !1;
                                    if (j.display !== d && null !== j.display && "none" !== j.display) {
                                        if ("flex" === j.display) {
                                            var A = ["-webkit-box", "-moz-box", "-ms-flexbox", "-webkit-flex"];
                                            m.each(A, function(a, b) {
                                                v.setPropertyValue(y, "display", b)
                                            })
                                        }
                                        v.setPropertyValue(y, "display", j.display)
                                    }
                                    j.visibility !== d && "hidden" !== j.visibility && v.setPropertyValue(y, "visibility", j.visibility);
                                    for (var B in w)
                                        if ("element" !== B) {
                                            var C, D = w[B],
                                                E = p.isString(D.easing) ? t.Easings[D.easing] : D.easing;
                                            if (1 === r) C = D.endValue;
                                            else {
                                                var F = D.endValue - D.startValue;
                                                if (C = D.startValue + F * E(r, j, F), !o && C === D.currentValue) continue
                                            }
                                            if (D.currentValue = C, "tween" === B) q = C;
                                            else {
                                                if (v.Hooks.registered[B]) {
                                                    var G = v.Hooks.getRoot(B),
                                                        H = g(y).rootPropertyValueCache[G];
                                                    H && (D.rootPropertyValue = H)
                                                }
                                                var I = v.setPropertyValue(y, B, D.currentValue + (0 === parseFloat(C) ? "" : D.unitType), D.rootPropertyValue, D.scrollData);
                                                v.Hooks.registered[B] && (g(y).rootPropertyValueCache[G] = v.Normalizations.registered[G] ? v.Normalizations.registered[G]("extract", null, I[1]) : I[1]), "transform" === I[0] && (z = !0)
                                            }
                                        }
                                    j.mobileHA && g(y).transformCache.translate3d === d && (g(y).transformCache.translate3d = "(0px, 0px, 0px)", z = !0), z && v.flushTransformCache(y)
                                }
                            }
                            j.display !== d && "none" !== j.display && (t.State.calls[f][2].display = !1), j.visibility !== d && "hidden" !== j.visibility && (t.State.calls[f][2].visibility = !1), j.progress && j.progress.call(h[1], h[1], r, Math.max(0, n + j.duration - b), n, q), 1 === r && l(f)
                        }
                }
                t.State.isTicking && x(k)
            }

            function l(a, b) {
                if (!t.State.calls[a]) return !1;
                for (var c = t.State.calls[a][0], e = t.State.calls[a][1], f = t.State.calls[a][2], h = t.State.calls[a][4], i = !1, j = 0, k = c.length; k > j; j++) {
                    var l = c[j].element;
                    if (b || f.loop || ("none" === f.display && v.setPropertyValue(l, "display", f.display), "hidden" === f.visibility && v.setPropertyValue(l, "visibility", f.visibility)), f.loop !== !0 && (m.queue(l)[1] === d || !/\.velocityQueueEntryFlag/i.test(m.queue(l)[1])) && g(l)) {
                        g(l).isAnimating = !1, g(l).rootPropertyValueCache = {};
                        var n = !1;
                        m.each(v.Lists.transforms3D, function(a, b) {
                            var c = /^scale/.test(b) ? 1 : 0,
                                e = g(l).transformCache[b];
                            g(l).transformCache[b] !== d && new RegExp("^\\(" + c + "[^.]").test(e) && (n = !0, delete g(l).transformCache[b])
                        }), f.mobileHA && (n = !0, delete g(l).transformCache.translate3d), n && v.flushTransformCache(l), v.Values.removeClass(l, "velocity-animating")
                    }
                    if (!b && f.complete && !f.loop && j === k - 1) try {
                        f.complete.call(e, e)
                    } catch (o) {
                        setTimeout(function() {
                            throw o
                        }, 1)
                    }
                    h && f.loop !== !0 && h(e), g(l) && f.loop === !0 && !b && (m.each(g(l).tweensContainer, function(a, b) {
                        /^rotate/.test(a) && 360 === parseFloat(b.endValue) && (b.endValue = 0, b.startValue = 360), /^backgroundPosition/.test(a) && 100 === parseFloat(b.endValue) && "%" === b.unitType && (b.endValue = 0, b.startValue = 100)
                    }), t(l, "reverse", {
                        loop: !0,
                        delay: f.delay
                    })), f.queue !== !1 && m.dequeue(l, f.queue)
                }
                t.State.calls[a] = !1;
                for (var p = 0, q = t.State.calls.length; q > p; p++)
                    if (t.State.calls[p] !== !1) {
                        i = !0;
                        break
                    }
                i === !1 && (t.State.isTicking = !1, delete t.State.calls, t.State.calls = [])
            }
            var m, n = function() {
                    if (c.documentMode) return c.documentMode;
                    for (var a = 7; a > 4; a--) {
                        var b = c.createElement("div");
                        if (b.innerHTML = "<!--[if IE " + a + "]><span></span><![endif]-->", b.getElementsByTagName("span").length) return b = null, a
                    }
                    return d
                }(),
                o = function() {
                    var a = 0;
                    return b.webkitRequestAnimationFrame || b.mozRequestAnimationFrame || function(b) {
                        var c, d = (new Date).getTime();
                        return c = Math.max(0, 16 - (d - a)), a = d + c, setTimeout(function() {
                            b(d + c)
                        }, c)
                    }
                }(),
                p = {
                    isString: function(a) {
                        return "string" == typeof a
                    },
                    isArray: Array.isArray || function(a) {
                        return "[object Array]" === Object.prototype.toString.call(a)
                    },
                    isFunction: function(a) {
                        return "[object Function]" === Object.prototype.toString.call(a)
                    },
                    isNode: function(a) {
                        return a && a.nodeType
                    },
                    isNodeList: function(a) {
                        return "object" == typeof a && /^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(a)) && a.length !== d && (0 === a.length || "object" == typeof a[0] && a[0].nodeType > 0)
                    },
                    isWrapped: function(a) {
                        return a && (a.jquery || b.Zepto && b.Zepto.zepto.isZ(a))
                    },
                    isSVG: function(a) {
                        return b.SVGElement && a instanceof b.SVGElement
                    },
                    isEmptyObject: function(a) {
                        for (var b in a) return !1;
                        return !0
                    }
                },
                q = !1;
            if (a.fn && a.fn.jquery ? (m = a, q = !0) : m = b.Velocity.Utilities, 8 >= n && !q) throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");
            if (7 >= n) return void(jQuery.fn.velocity = jQuery.fn.animate);
            var r = 400,
                s = "swing",
                t = {
                    State: {
                        isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
                        isAndroid: /Android/i.test(navigator.userAgent),
                        isGingerbread: /Android 2\.3\.[3-7]/i.test(navigator.userAgent),
                        isChrome: b.chrome,
                        isFirefox: /Firefox/i.test(navigator.userAgent),
                        prefixElement: c.createElement("div"),
                        prefixMatches: {},
                        scrollAnchor: null,
                        scrollPropertyLeft: null,
                        scrollPropertyTop: null,
                        isTicking: !1,
                        calls: []
                    },
                    CSS: {},
                    Utilities: m,
                    Redirects: {},
                    Easings: {},
                    Promise: b.Promise,
                    defaults: {
                        queue: "",
                        duration: r,
                        easing: s,
                        begin: d,
                        complete: d,
                        progress: d,
                        display: d,
                        visibility: d,
                        loop: !1,
                        delay: !1,
                        mobileHA: !0,
                        _cacheValues: !0
                    },
                    init: function(a) {
                        m.data(a, "velocity", {
                            isSVG: p.isSVG(a),
                            isAnimating: !1,
                            computedStyle: null,
                            tweensContainer: null,
                            rootPropertyValueCache: {},
                            transformCache: {}
                        })
                    },
                    hook: null,
                    mock: !1,
                    version: {
                        major: 1,
                        minor: 2,
                        patch: 2
                    },
                    debug: !1
                };
            b.pageYOffset !== d ? (t.State.scrollAnchor = b, t.State.scrollPropertyLeft = "pageXOffset", t.State.scrollPropertyTop = "pageYOffset") : (t.State.scrollAnchor = c.documentElement || c.body.parentNode || c.body, t.State.scrollPropertyLeft = "scrollLeft", t.State.scrollPropertyTop = "scrollTop");
            var u = function() {
                function a(a) {
                    return -a.tension * a.x - a.friction * a.v
                }

                function b(b, c, d) {
                    var e = {
                        x: b.x + d.dx * c,
                        v: b.v + d.dv * c,
                        tension: b.tension,
                        friction: b.friction
                    };
                    return {
                        dx: e.v,
                        dv: a(e)
                    }
                }

                function c(c, d) {
                    var e = {
                            dx: c.v,
                            dv: a(c)
                        },
                        f = b(c, .5 * d, e),
                        g = b(c, .5 * d, f),
                        h = b(c, d, g),
                        i = 1 / 6 * (e.dx + 2 * (f.dx + g.dx) + h.dx),
                        j = 1 / 6 * (e.dv + 2 * (f.dv + g.dv) + h.dv);
                    return c.x = c.x + i * d, c.v = c.v + j * d, c
                }
                return function d(a, b, e) {
                    var f, g, h, i = {
                            x: -1,
                            v: 0,
                            tension: null,
                            friction: null
                        },
                        j = [0],
                        k = 0,
                        l = 1e-4,
                        m = .016;
                    for (a = parseFloat(a) || 500, b = parseFloat(b) || 20, e = e || null, i.tension = a, i.friction = b, f = null !== e, f ? (k = d(a, b), g = k / e * m) : g = m; h = c(h || i, g), j.push(1 + h.x), k += 16, Math.abs(h.x) > l && Math.abs(h.v) > l;);
                    return f ? function(a) {
                        return j[a * (j.length - 1) | 0]
                    } : k
                }
            }();
            t.Easings = {
                linear: function(a) {
                    return a
                },
                swing: function(a) {
                    return .5 - Math.cos(a * Math.PI) / 2
                },
                spring: function(a) {
                    return 1 - Math.cos(4.5 * a * Math.PI) * Math.exp(6 * -a)
                }
            }, m.each([
                ["ease", [.25, .1, .25, 1]],
                ["ease-in", [.42, 0, 1, 1]],
                ["ease-out", [0, 0, .58, 1]],
                ["ease-in-out", [.42, 0, .58, 1]],
                ["easeInSine", [.47, 0, .745, .715]],
                ["easeOutSine", [.39, .575, .565, 1]],
                ["easeInOutSine", [.445, .05, .55, .95]],
                ["easeInQuad", [.55, .085, .68, .53]],
                ["easeOutQuad", [.25, .46, .45, .94]],
                ["easeInOutQuad", [.455, .03, .515, .955]],
                ["easeInCubic", [.55, .055, .675, .19]],
                ["easeOutCubic", [.215, .61, .355, 1]],
                ["easeInOutCubic", [.645, .045, .355, 1]],
                ["easeInQuart", [.895, .03, .685, .22]],
                ["easeOutQuart", [.165, .84, .44, 1]],
                ["easeInOutQuart", [.77, 0, .175, 1]],
                ["easeInQuint", [.755, .05, .855, .06]],
                ["easeOutQuint", [.23, 1, .32, 1]],
                ["easeInOutQuint", [.86, 0, .07, 1]],
                ["easeInExpo", [.95, .05, .795, .035]],
                ["easeOutExpo", [.19, 1, .22, 1]],
                ["easeInOutExpo", [1, 0, 0, 1]],
                ["easeInCirc", [.6, .04, .98, .335]],
                ["easeOutCirc", [.075, .82, .165, 1]],
                ["easeInOutCirc", [.785, .135, .15, .86]]
            ], function(a, b) {
                t.Easings[b[0]] = i.apply(null, b[1])
            });
            var v = t.CSS = {
                RegEx: {
                    isHex: /^#([A-f\d]{3}){1,2}$/i,
                    valueUnwrap: /^[A-z]+\((.*)\)$/i,
                    wrappedValueAlreadyExtracted: /[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,
                    valueSplit: /([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi
                },
                Lists: {
                    colors: ["fill", "stroke", "stopColor", "color", "backgroundColor", "borderColor", "borderTopColor", "borderRightColor", "borderBottomColor", "borderLeftColor", "outlineColor"],
                    transformsBase: ["translateX", "translateY", "scale", "scaleX", "scaleY", "skewX", "skewY", "rotateZ"],
                    transforms3D: ["transformPerspective", "translateZ", "scaleZ", "rotateX", "rotateY"]
                },
                Hooks: {
                    templates: {
                        textShadow: ["Color X Y Blur", "black 0px 0px 0px"],
                        boxShadow: ["Color X Y Blur Spread", "black 0px 0px 0px 0px"],
                        clip: ["Top Right Bottom Left", "0px 0px 0px 0px"],
                        backgroundPosition: ["X Y", "0% 0%"],
                        transformOrigin: ["X Y Z", "50% 50% 0px"],
                        perspectiveOrigin: ["X Y", "50% 50%"]
                    },
                    registered: {},
                    register: function() {
                        for (var a = 0; a < v.Lists.colors.length; a++) {
                            var b = "color" === v.Lists.colors[a] ? "0 0 0 1" : "255 255 255 1";
                            v.Hooks.templates[v.Lists.colors[a]] = ["Red Green Blue Alpha", b]
                        }
                        var c, d, e;
                        if (n)
                            for (c in v.Hooks.templates) {
                                d = v.Hooks.templates[c], e = d[0].split(" ");
                                var f = d[1].match(v.RegEx.valueSplit);
                                "Color" === e[0] && (e.push(e.shift()), f.push(f.shift()), v.Hooks.templates[c] = [e.join(" "), f.join(" ")])
                            }
                        for (c in v.Hooks.templates) {
                            d = v.Hooks.templates[c], e = d[0].split(" ");
                            for (var a in e) {
                                var g = c + e[a],
                                    h = a;
                                v.Hooks.registered[g] = [c, h]
                            }
                        }
                    },
                    getRoot: function(a) {
                        var b = v.Hooks.registered[a];
                        return b ? b[0] : a
                    },
                    cleanRootPropertyValue: function(a, b) {
                        return v.RegEx.valueUnwrap.test(b) && (b = b.match(v.RegEx.valueUnwrap)[1]), v.Values.isCSSNullValue(b) && (b = v.Hooks.templates[a][1]), b
                    },
                    extractValue: function(a, b) {
                        var c = v.Hooks.registered[a];
                        if (c) {
                            var d = c[0],
                                e = c[1];
                            return b = v.Hooks.cleanRootPropertyValue(d, b), b.toString().match(v.RegEx.valueSplit)[e]
                        }
                        return b
                    },
                    injectValue: function(a, b, c) {
                        var d = v.Hooks.registered[a];
                        if (d) {
                            var e, f, g = d[0],
                                h = d[1];
                            return c = v.Hooks.cleanRootPropertyValue(g, c), e = c.toString().match(v.RegEx.valueSplit), e[h] = b, f = e.join(" ")
                        }
                        return c
                    }
                },
                Normalizations: {
                    registered: {
                        clip: function(a, b, c) {
                            switch (a) {
                                case "name":
                                    return "clip";
                                case "extract":
                                    var d;
                                    return v.RegEx.wrappedValueAlreadyExtracted.test(c) ? d = c : (d = c.toString().match(v.RegEx.valueUnwrap), d = d ? d[1].replace(/,(\s+)?/g, " ") : c), d;
                                case "inject":
                                    return "rect(" + c + ")"
                            }
                        },
                        blur: function(a, b, c) {
                            switch (a) {
                                case "name":
                                    return t.State.isFirefox ? "filter" : "-webkit-filter";
                                case "extract":
                                    var d = parseFloat(c);
                                    if (!d && 0 !== d) {
                                        var e = c.toString().match(/blur\(([0-9]+[A-z]+)\)/i);
                                        d = e ? e[1] : 0
                                    }
                                    return d;
                                case "inject":
                                    return parseFloat(c) ? "blur(" + c + ")" : "none"
                            }
                        },
                        opacity: function(a, b, c) {
                            if (8 >= n) switch (a) {
                                case "name":
                                    return "filter";
                                case "extract":
                                    var d = c.toString().match(/alpha\(opacity=(.*)\)/i);
                                    return c = d ? d[1] / 100 : 1;
                                case "inject":
                                    return b.style.zoom = 1, parseFloat(c) >= 1 ? "" : "alpha(opacity=" + parseInt(100 * parseFloat(c), 10) + ")"
                            } else switch (a) {
                                case "name":
                                    return "opacity";
                                case "extract":
                                    return c;
                                case "inject":
                                    return c
                            }
                        }
                    },
                    register: function() {
                        9 >= n || t.State.isGingerbread || (v.Lists.transformsBase = v.Lists.transformsBase.concat(v.Lists.transforms3D));
                        for (var a = 0; a < v.Lists.transformsBase.length; a++) ! function() {
                            var b = v.Lists.transformsBase[a];
                            v.Normalizations.registered[b] = function(a, c, e) {
                                switch (a) {
                                    case "name":
                                        return "transform";
                                    case "extract":
                                        return g(c) === d || g(c).transformCache[b] === d ? /^scale/i.test(b) ? 1 : 0 : g(c).transformCache[b].replace(/[()]/g, "");
                                    case "inject":
                                        var f = !1;
                                        switch (b.substr(0, b.length - 1)) {
                                            case "translate":
                                                f = !/(%|px|em|rem|vw|vh|\d)$/i.test(e);
                                                break;
                                            case "scal":
                                            case "scale":
                                                t.State.isAndroid && g(c).transformCache[b] === d && 1 > e && (e = 1), f = !/(\d)$/i.test(e);
                                                break;
                                            case "skew":
                                                f = !/(deg|\d)$/i.test(e);
                                                break;
                                            case "rotate":
                                                f = !/(deg|\d)$/i.test(e)
                                        }
                                        return f || (g(c).transformCache[b] = "(" + e + ")"), g(c).transformCache[b]
                                }
                            }
                        }();
                        for (var a = 0; a < v.Lists.colors.length; a++) ! function() {
                            var b = v.Lists.colors[a];
                            v.Normalizations.registered[b] = function(a, c, e) {
                                switch (a) {
                                    case "name":
                                        return b;
                                    case "extract":
                                        var f;
                                        if (v.RegEx.wrappedValueAlreadyExtracted.test(e)) f = e;
                                        else {
                                            var g, h = {
                                                black: "rgb(0, 0, 0)",
                                                blue: "rgb(0, 0, 255)",
                                                gray: "rgb(128, 128, 128)",
                                                green: "rgb(0, 128, 0)",
                                                red: "rgb(255, 0, 0)",
                                                white: "rgb(255, 255, 255)"
                                            };
                                            /^[A-z]+$/i.test(e) ? g = h[e] !== d ? h[e] : h.black : v.RegEx.isHex.test(e) ? g = "rgb(" + v.Values.hexToRgb(e).join(" ") + ")" : /^rgba?\(/i.test(e) || (g = h.black), f = (g || e).toString().match(v.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g, " ")
                                        }
                                        return 8 >= n || 3 !== f.split(" ").length || (f += " 1"), f;
                                    case "inject":
                                        return 8 >= n ? 4 === e.split(" ").length && (e = e.split(/\s+/).slice(0, 3).join(" ")) : 3 === e.split(" ").length && (e += " 1"), (8 >= n ? "rgb" : "rgba") + "(" + e.replace(/\s+/g, ",").replace(/\.(\d)+(?=,)/g, "") + ")"
                                }
                            }
                        }()
                    }
                },
                Names: {
                    camelCase: function(a) {
                        return a.replace(/-(\w)/g, function(a, b) {
                            return b.toUpperCase()
                        })
                    },
                    SVGAttribute: function(a) {
                        var b = "width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";
                        return (n || t.State.isAndroid && !t.State.isChrome) && (b += "|transform"), new RegExp("^(" + b + ")$", "i").test(a)
                    },
                    prefixCheck: function(a) {
                        if (t.State.prefixMatches[a]) return [t.State.prefixMatches[a], !0];
                        for (var b = ["", "Webkit", "Moz", "ms", "O"], c = 0, d = b.length; d > c; c++) {
                            var e;
                            if (e = 0 === c ? a : b[c] + a.replace(/^\w/, function(a) {
                                    return a.toUpperCase()
                                }), p.isString(t.State.prefixElement.style[e])) return t.State.prefixMatches[a] = e, [e, !0]
                        }
                        return [a, !1]
                    }
                },
                Values: {
                    hexToRgb: function(a) {
                        var b, c = /^#?([a-f\d])([a-f\d])([a-f\d])$/i,
                            d = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;
                        return a = a.replace(c, function(a, b, c, d) {
                            return b + b + c + c + d + d
                        }), b = d.exec(a), b ? [parseInt(b[1], 16), parseInt(b[2], 16), parseInt(b[3], 16)] : [0, 0, 0]
                    },
                    isCSSNullValue: function(a) {
                        return 0 == a || /^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(a)
                    },
                    getUnitType: function(a) {
                        return /^(rotate|skew)/i.test(a) ? "deg" : /(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(a) ? "" : "px"
                    },
                    getDisplayType: function(a) {
                        var b = a && a.tagName.toString().toLowerCase();
                        return /^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(b) ? "inline" : /^(li)$/i.test(b) ? "list-item" : /^(tr)$/i.test(b) ? "table-row" : /^(table)$/i.test(b) ? "table" : /^(tbody)$/i.test(b) ? "table-row-group" : "block"
                    },
                    addClass: function(a, b) {
                        a.classList ? a.classList.add(b) : a.className += (a.className.length ? " " : "") + b
                    },
                    removeClass: function(a, b) {
                        a.classList ? a.classList.remove(b) : a.className = a.className.toString().replace(new RegExp("(^|\\s)" + b.split(" ").join("|") + "(\\s|$)", "gi"), " ")
                    }
                },
                getPropertyValue: function(a, c, e, f) {
                    function h(a, c) {
                        function e() {
                            j && v.setPropertyValue(a, "display", "none")
                        }
                        var i = 0;
                        if (8 >= n) i = m.css(a, c);
                        else {
                            var j = !1;
                            if (/^(width|height)$/.test(c) && 0 === v.getPropertyValue(a, "display") && (j = !0, v.setPropertyValue(a, "display", v.Values.getDisplayType(a))), !f) {
                                if ("height" === c && "border-box" !== v.getPropertyValue(a, "boxSizing").toString().toLowerCase()) {
                                    var k = a.offsetHeight - (parseFloat(v.getPropertyValue(a, "borderTopWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "borderBottomWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingTop")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingBottom")) || 0);
                                    return e(), k
                                }
                                if ("width" === c && "border-box" !== v.getPropertyValue(a, "boxSizing").toString().toLowerCase()) {
                                    var l = a.offsetWidth - (parseFloat(v.getPropertyValue(a, "borderLeftWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "borderRightWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingLeft")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingRight")) || 0);
                                    return e(), l
                                }
                            }
                            var o;
                            o = g(a) === d ? b.getComputedStyle(a, null) : g(a).computedStyle ? g(a).computedStyle : g(a).computedStyle = b.getComputedStyle(a, null), "borderColor" === c && (c = "borderTopColor"), i = 9 === n && "filter" === c ? o.getPropertyValue(c) : o[c], ("" === i || null === i) && (i = a.style[c]), e()
                        }
                        if ("auto" === i && /^(top|right|bottom|left)$/i.test(c)) {
                            var p = h(a, "position");
                            ("fixed" === p || "absolute" === p && /top|left/i.test(c)) && (i = m(a).position()[c] + "px")
                        }
                        return i
                    }
                    var i;
                    if (v.Hooks.registered[c]) {
                        var j = c,
                            k = v.Hooks.getRoot(j);
                        e === d && (e = v.getPropertyValue(a, v.Names.prefixCheck(k)[0])), v.Normalizations.registered[k] && (e = v.Normalizations.registered[k]("extract", a, e)), i = v.Hooks.extractValue(j, e)
                    } else if (v.Normalizations.registered[c]) {
                        var l, o;
                        l = v.Normalizations.registered[c]("name", a), "transform" !== l && (o = h(a, v.Names.prefixCheck(l)[0]), v.Values.isCSSNullValue(o) && v.Hooks.templates[c] && (o = v.Hooks.templates[c][1])), i = v.Normalizations.registered[c]("extract", a, o)
                    }
                    if (!/^[\d-]/.test(i))
                        if (g(a) && g(a).isSVG && v.Names.SVGAttribute(c))
                            if (/^(height|width)$/i.test(c)) try {
                                i = a.getBBox()[c]
                            } catch (p) {
                                i = 0
                            } else i = a.getAttribute(c);
                            else i = h(a, v.Names.prefixCheck(c)[0]);
                    return v.Values.isCSSNullValue(i) && (i = 0), t.debug >= 2 && console.log("Get " + c + ": " + i), i
                },
                setPropertyValue: function(a, c, d, e, f) {
                    var h = c;
                    if ("scroll" === c) f.container ? f.container["scroll" + f.direction] = d : "Left" === f.direction ? b.scrollTo(d, f.alternateValue) : b.scrollTo(f.alternateValue, d);
                    else if (v.Normalizations.registered[c] && "transform" === v.Normalizations.registered[c]("name", a)) v.Normalizations.registered[c]("inject", a, d), h = "transform", d = g(a).transformCache[c];
                    else {
                        if (v.Hooks.registered[c]) {
                            var i = c,
                                j = v.Hooks.getRoot(c);
                            e = e || v.getPropertyValue(a, j), d = v.Hooks.injectValue(i, d, e), c = j
                        }
                        if (v.Normalizations.registered[c] && (d = v.Normalizations.registered[c]("inject", a, d), c = v.Normalizations.registered[c]("name", a)), h = v.Names.prefixCheck(c)[0], 8 >= n) try {
                            a.style[h] = d
                        } catch (k) {
                            t.debug && console.log("Browser does not support [" + d + "] for [" + h + "]")
                        } else g(a) && g(a).isSVG && v.Names.SVGAttribute(c) ? a.setAttribute(c, d) : a.style[h] = d;
                        t.debug >= 2 && console.log("Set " + c + " (" + h + "): " + d)
                    }
                    return [h, d]
                },
                flushTransformCache: function(a) {
                    function b(b) {
                        return parseFloat(v.getPropertyValue(a, b))
                    }
                    var c = "";
                    if ((n || t.State.isAndroid && !t.State.isChrome) && g(a).isSVG) {
                        var d = {
                            translate: [b("translateX"), b("translateY")],
                            skewX: [b("skewX")],
                            skewY: [b("skewY")],
                            scale: 1 !== b("scale") ? [b("scale"), b("scale")] : [b("scaleX"), b("scaleY")],
                            rotate: [b("rotateZ"), 0, 0]
                        };
                        m.each(g(a).transformCache, function(a) {
                            /^translate/i.test(a) ? a = "translate" : /^scale/i.test(a) ? a = "scale" : /^rotate/i.test(a) && (a = "rotate"), d[a] && (c += a + "(" + d[a].join(" ") + ") ", delete d[a])
                        })
                    } else {
                        var e, f;
                        m.each(g(a).transformCache, function(b) {
                            return e = g(a).transformCache[b], "transformPerspective" === b ? (f = e, !0) : (9 === n && "rotateZ" === b && (b = "rotate"), void(c += b + e + " "))
                        }), f && (c = "perspective" + f + " " + c)
                    }
                    v.setPropertyValue(a, "transform", c)
                }
            };
            v.Hooks.register(), v.Normalizations.register(), t.hook = function(a, b, c) {
                var e = d;
                return a = f(a), m.each(a, function(a, f) {
                    if (g(f) === d && t.init(f), c === d) e === d && (e = t.CSS.getPropertyValue(f, b));
                    else {
                        var h = t.CSS.setPropertyValue(f, b, c);
                        "transform" === h[0] && t.CSS.flushTransformCache(f), e = h
                    }
                }), e
            };
            var w = function() {
                function a() {
                    return h ? B.promise || null : i
                }

                function e() {
                    function a(a) {
                        function l(a, b) {
                            var c = d,
                                e = d,
                                g = d;
                            return p.isArray(a) ? (c = a[0], !p.isArray(a[1]) && /^[\d-]/.test(a[1]) || p.isFunction(a[1]) || v.RegEx.isHex.test(a[1]) ? g = a[1] : (p.isString(a[1]) && !v.RegEx.isHex.test(a[1]) || p.isArray(a[1])) && (e = b ? a[1] : j(a[1], h.duration), a[2] !== d && (g = a[2]))) : c = a, b || (e = e || h.easing), p.isFunction(c) && (c = c.call(f, y, x)), p.isFunction(g) && (g = g.call(f, y, x)), [c || 0, e, g]
                        }

                        function n(a, b) {
                            var c, d;
                            return d = (b || "0").toString().toLowerCase().replace(/[%A-z]+$/, function(a) {
                                return c = a, ""
                            }), c || (c = v.Values.getUnitType(a)), [d, c]
                        }

                        function r() {
                            var a = {
                                    myParent: f.parentNode || c.body,
                                    position: v.getPropertyValue(f, "position"),
                                    fontSize: v.getPropertyValue(f, "fontSize")
                                },
                                d = a.position === I.lastPosition && a.myParent === I.lastParent,
                                e = a.fontSize === I.lastFontSize;
                            I.lastParent = a.myParent, I.lastPosition = a.position, I.lastFontSize = a.fontSize;
                            var h = 100,
                                i = {};
                            if (e && d) i.emToPx = I.lastEmToPx, i.percentToPxWidth = I.lastPercentToPxWidth, i.percentToPxHeight = I.lastPercentToPxHeight;
                            else {
                                var j = g(f).isSVG ? c.createElementNS("http://www.w3.org/2000/svg", "rect") : c.createElement("div");
                                t.init(j), a.myParent.appendChild(j), m.each(["overflow", "overflowX", "overflowY"], function(a, b) {
                                    t.CSS.setPropertyValue(j, b, "hidden")
                                }), t.CSS.setPropertyValue(j, "position", a.position), t.CSS.setPropertyValue(j, "fontSize", a.fontSize), t.CSS.setPropertyValue(j, "boxSizing", "content-box"), m.each(["minWidth", "maxWidth", "width", "minHeight", "maxHeight", "height"], function(a, b) {
                                    t.CSS.setPropertyValue(j, b, h + "%")
                                }), t.CSS.setPropertyValue(j, "paddingLeft", h + "em"), i.percentToPxWidth = I.lastPercentToPxWidth = (parseFloat(v.getPropertyValue(j, "width", null, !0)) || 1) / h, i.percentToPxHeight = I.lastPercentToPxHeight = (parseFloat(v.getPropertyValue(j, "height", null, !0)) || 1) / h, i.emToPx = I.lastEmToPx = (parseFloat(v.getPropertyValue(j, "paddingLeft")) || 1) / h, a.myParent.removeChild(j)
                            }
                            return null === I.remToPx && (I.remToPx = parseFloat(v.getPropertyValue(c.body, "fontSize")) || 16), null === I.vwToPx && (I.vwToPx = parseFloat(b.innerWidth) / 100, I.vhToPx = parseFloat(b.innerHeight) / 100), i.remToPx = I.remToPx, i.vwToPx = I.vwToPx, i.vhToPx = I.vhToPx, t.debug >= 1 && console.log("Unit ratios: " + JSON.stringify(i), f), i
                        }
                        if (h.begin && 0 === y) try {
                            h.begin.call(o, o)
                        } catch (u) {
                            setTimeout(function() {
                                throw u
                            }, 1)
                        }
                        if ("scroll" === C) {
                            var w, z, A, D = /^x$/i.test(h.axis) ? "Left" : "Top",
                                E = parseFloat(h.offset) || 0;
                            h.container ? p.isWrapped(h.container) || p.isNode(h.container) ? (h.container = h.container[0] || h.container, w = h.container["scroll" + D], A = w + m(f).position()[D.toLowerCase()] + E) : h.container = null : (w = t.State.scrollAnchor[t.State["scrollProperty" + D]], z = t.State.scrollAnchor[t.State["scrollProperty" + ("Left" === D ? "Top" : "Left")]], A = m(f).offset()[D.toLowerCase()] + E), i = {
                                scroll: {
                                    rootPropertyValue: !1,
                                    startValue: w,
                                    currentValue: w,
                                    endValue: A,
                                    unitType: "",
                                    easing: h.easing,
                                    scrollData: {
                                        container: h.container,
                                        direction: D,
                                        alternateValue: z
                                    }
                                },
                                element: f
                            }, t.debug && console.log("tweensContainer (scroll): ", i.scroll, f)
                        } else if ("reverse" === C) {
                            if (!g(f).tweensContainer) return void m.dequeue(f, h.queue);
                            "none" === g(f).opts.display && (g(f).opts.display = "auto"), "hidden" === g(f).opts.visibility && (g(f).opts.visibility = "visible"), g(f).opts.loop = !1, g(f).opts.begin = null, g(f).opts.complete = null, s.easing || delete h.easing, s.duration || delete h.duration, h = m.extend({}, g(f).opts, h);
                            var F = m.extend(!0, {}, g(f).tweensContainer);
                            for (var G in F)
                                if ("element" !== G) {
                                    var H = F[G].startValue;
                                    F[G].startValue = F[G].currentValue = F[G].endValue, F[G].endValue = H, p.isEmptyObject(s) || (F[G].easing = h.easing), t.debug && console.log("reverse tweensContainer (" + G + "): " + JSON.stringify(F[G]), f)
                                }
                            i = F
                        } else if ("start" === C) {
                            var F;
                            g(f).tweensContainer && g(f).isAnimating === !0 && (F = g(f).tweensContainer), m.each(q, function(a, b) {
                                if (RegExp("^" + v.Lists.colors.join("$|^") + "$").test(a)) {
                                    var c = l(b, !0),
                                        e = c[0],
                                        f = c[1],
                                        g = c[2];
                                    if (v.RegEx.isHex.test(e)) {
                                        for (var h = ["Red", "Green", "Blue"], i = v.Values.hexToRgb(e), j = g ? v.Values.hexToRgb(g) : d, k = 0; k < h.length; k++) {
                                            var m = [i[k]];
                                            f && m.push(f), j !== d && m.push(j[k]), q[a + h[k]] = m
                                        }
                                        delete q[a]
                                    }
                                }
                            });
                            for (var K in q) {
                                var L = l(q[K]),
                                    M = L[0],
                                    N = L[1],
                                    O = L[2];
                                K = v.Names.camelCase(K);
                                var P = v.Hooks.getRoot(K),
                                    Q = !1;
                                if (g(f).isSVG || "tween" === P || v.Names.prefixCheck(P)[1] !== !1 || v.Normalizations.registered[P] !== d) {
                                    (h.display !== d && null !== h.display && "none" !== h.display || h.visibility !== d && "hidden" !== h.visibility) && /opacity|filter/.test(K) && !O && 0 !== M && (O = 0), h._cacheValues && F && F[K] ? (O === d && (O = F[K].endValue + F[K].unitType), Q = g(f).rootPropertyValueCache[P]) : v.Hooks.registered[K] ? O === d ? (Q = v.getPropertyValue(f, P), O = v.getPropertyValue(f, K, Q)) : Q = v.Hooks.templates[P][1] : O === d && (O = v.getPropertyValue(f, K));
                                    var R, S, T, U = !1;
                                    if (R = n(K, O), O = R[0], T = R[1], R = n(K, M), M = R[0].replace(/^([+-\/*])=/, function(a, b) {
                                            return U = b, ""
                                        }), S = R[1], O = parseFloat(O) || 0, M = parseFloat(M) || 0, "%" === S && (/^(fontSize|lineHeight)$/.test(K) ? (M /= 100, S = "em") : /^scale/.test(K) ? (M /= 100, S = "") : /(Red|Green|Blue)$/i.test(K) && (M = M / 100 * 255, S = "")), /[\/*]/.test(U)) S = T;
                                    else if (T !== S && 0 !== O)
                                        if (0 === M) S = T;
                                        else {
                                            e = e || r();
                                            var V = /margin|padding|left|right|width|text|word|letter/i.test(K) || /X$/.test(K) || "x" === K ? "x" : "y";
                                            switch (T) {
                                                case "%":
                                                    O *= "x" === V ? e.percentToPxWidth : e.percentToPxHeight;
                                                    break;
                                                case "px":
                                                    break;
                                                default:
                                                    O *= e[T + "ToPx"]
                                            }
                                            switch (S) {
                                                case "%":
                                                    O *= 1 / ("x" === V ? e.percentToPxWidth : e.percentToPxHeight);
                                                    break;
                                                case "px":
                                                    break;
                                                default:
                                                    O *= 1 / e[S + "ToPx"]
                                            }
                                        }
                                    switch (U) {
                                        case "+":
                                            M = O + M;
                                            break;
                                        case "-":
                                            M = O - M;
                                            break;
                                        case "*":
                                            M = O * M;
                                            break;
                                        case "/":
                                            M = O / M
                                    }
                                    i[K] = {
                                        rootPropertyValue: Q,
                                        startValue: O,
                                        currentValue: O,
                                        endValue: M,
                                        unitType: S,
                                        easing: N
                                    }, t.debug && console.log("tweensContainer (" + K + "): " + JSON.stringify(i[K]), f)
                                } else t.debug && console.log("Skipping [" + P + "] due to a lack of browser support.")
                            }
                            i.element = f
                        }
                        i.element && (v.Values.addClass(f, "velocity-animating"), J.push(i), "" === h.queue && (g(f).tweensContainer = i, g(f).opts = h), g(f).isAnimating = !0, y === x - 1 ? (t.State.calls.push([J, o, h, null, B.resolver]), t.State.isTicking === !1 && (t.State.isTicking = !0, k())) : y++)
                    }
                    var e, f = this,
                        h = m.extend({}, t.defaults, s),
                        i = {};
                    switch (g(f) === d && t.init(f), parseFloat(h.delay) && h.queue !== !1 && m.queue(f, h.queue, function(a) {
                        t.velocityQueueEntryFlag = !0, g(f).delayTimer = {
                            setTimeout: setTimeout(a, parseFloat(h.delay)),
                            next: a
                        }
                    }), h.duration.toString().toLowerCase()) {
                        case "fast":
                            h.duration = 200;
                            break;
                        case "normal":
                            h.duration = r;
                            break;
                        case "slow":
                            h.duration = 600;
                            break;
                        default:
                            h.duration = parseFloat(h.duration) || 1
                    }
                    t.mock !== !1 && (t.mock === !0 ? h.duration = h.delay = 1 : (h.duration *= parseFloat(t.mock) || 1, h.delay *= parseFloat(t.mock) || 1)), h.easing = j(h.easing, h.duration), h.begin && !p.isFunction(h.begin) && (h.begin = null), h.progress && !p.isFunction(h.progress) && (h.progress = null), h.complete && !p.isFunction(h.complete) && (h.complete = null), h.display !== d && null !== h.display && (h.display = h.display.toString().toLowerCase(), "auto" === h.display && (h.display = t.CSS.Values.getDisplayType(f))), h.visibility !== d && null !== h.visibility && (h.visibility = h.visibility.toString().toLowerCase()), h.mobileHA = h.mobileHA && t.State.isMobile && !t.State.isGingerbread, h.queue === !1 ? h.delay ? setTimeout(a, h.delay) : a() : m.queue(f, h.queue, function(b, c) {
                        return c === !0 ? (B.promise && B.resolver(o), !0) : (t.velocityQueueEntryFlag = !0, void a(b))
                    }), "" !== h.queue && "fx" !== h.queue || "inprogress" === m.queue(f)[0] || m.dequeue(f)
                }
                var h, i, n, o, q, s, u = arguments[0] && (arguments[0].p || m.isPlainObject(arguments[0].properties) && !arguments[0].properties.names || p.isString(arguments[0].properties));
                if (p.isWrapped(this) ? (h = !1, n = 0, o = this, i = this) : (h = !0, n = 1, o = u ? arguments[0].elements || arguments[0].e : arguments[0]), o = f(o)) {
                    u ? (q = arguments[0].properties || arguments[0].p, s = arguments[0].options || arguments[0].o) : (q = arguments[n], s = arguments[n + 1]);
                    var x = o.length,
                        y = 0;
                    if (!/^(stop|finish)$/i.test(q) && !m.isPlainObject(s)) {
                        var z = n + 1;
                        s = {};
                        for (var A = z; A < arguments.length; A++) p.isArray(arguments[A]) || !/^(fast|normal|slow)$/i.test(arguments[A]) && !/^\d/.test(arguments[A]) ? p.isString(arguments[A]) || p.isArray(arguments[A]) ? s.easing = arguments[A] : p.isFunction(arguments[A]) && (s.complete = arguments[A]) : s.duration = arguments[A]
                    }
                    var B = {
                        promise: null,
                        resolver: null,
                        rejecter: null
                    };
                    h && t.Promise && (B.promise = new t.Promise(function(a, b) {
                        B.resolver = a, B.rejecter = b
                    }));
                    var C;
                    switch (q) {
                        case "scroll":
                            C = "scroll";
                            break;
                        case "reverse":
                            C = "reverse";
                            break;
                        case "finish":
                        case "stop":
                            m.each(o, function(a, b) {
                                g(b) && g(b).delayTimer && (clearTimeout(g(b).delayTimer.setTimeout),
                                    g(b).delayTimer.next && g(b).delayTimer.next(), delete g(b).delayTimer)
                            });
                            var D = [];
                            return m.each(t.State.calls, function(a, b) {
                                b && m.each(b[1], function(c, e) {
                                    var f = s === d ? "" : s;
                                    return f === !0 || b[2].queue === f || s === d && b[2].queue === !1 ? void m.each(o, function(c, d) {
                                        d === e && ((s === !0 || p.isString(s)) && (m.each(m.queue(d, p.isString(s) ? s : ""), function(a, b) {
                                            p.isFunction(b) && b(null, !0)
                                        }), m.queue(d, p.isString(s) ? s : "", [])), "stop" === q ? (g(d) && g(d).tweensContainer && f !== !1 && m.each(g(d).tweensContainer, function(a, b) {
                                            b.endValue = b.currentValue
                                        }), D.push(a)) : "finish" === q && (b[2].duration = 1))
                                    }) : !0
                                })
                            }), "stop" === q && (m.each(D, function(a, b) {
                                l(b, !0)
                            }), B.promise && B.resolver(o)), a();
                        default:
                            if (!m.isPlainObject(q) || p.isEmptyObject(q)) {
                                if (p.isString(q) && t.Redirects[q]) {
                                    var E = m.extend({}, s),
                                        F = E.duration,
                                        G = E.delay || 0;
                                    return E.backwards === !0 && (o = m.extend(!0, [], o).reverse()), m.each(o, function(a, b) {
                                        parseFloat(E.stagger) ? E.delay = G + parseFloat(E.stagger) * a : p.isFunction(E.stagger) && (E.delay = G + E.stagger.call(b, a, x)), E.drag && (E.duration = parseFloat(F) || (/^(callout|transition)/.test(q) ? 1e3 : r), E.duration = Math.max(E.duration * (E.backwards ? 1 - a / x : (a + 1) / x), .75 * E.duration, 200)), t.Redirects[q].call(b, b, E || {}, a, x, o, B.promise ? B : d)
                                    }), a()
                                }
                                var H = "Velocity: First argument (" + q + ") was not a property map, a known action, or a registered redirect. Aborting.";
                                return B.promise ? B.rejecter(new Error(H)) : console.log(H), a()
                            }
                            C = "start"
                    }
                    var I = {
                            lastParent: null,
                            lastPosition: null,
                            lastFontSize: null,
                            lastPercentToPxWidth: null,
                            lastPercentToPxHeight: null,
                            lastEmToPx: null,
                            remToPx: null,
                            vwToPx: null,
                            vhToPx: null
                        },
                        J = [];
                    m.each(o, function(a, b) {
                        p.isNode(b) && e.call(b)
                    });
                    var K, E = m.extend({}, t.defaults, s);
                    if (E.loop = parseInt(E.loop), K = 2 * E.loop - 1, E.loop)
                        for (var L = 0; K > L; L++) {
                            var M = {
                                delay: E.delay,
                                progress: E.progress
                            };
                            L === K - 1 && (M.display = E.display, M.visibility = E.visibility, M.complete = E.complete), w(o, "reverse", M)
                        }
                    return a()
                }
            };
            t = m.extend(w, t), t.animate = w;
            var x = b.requestAnimationFrame || o;
            return t.State.isMobile || c.hidden === d || c.addEventListener("visibilitychange", function() {
                c.hidden ? (x = function(a) {
                    return setTimeout(function() {
                        a(!0)
                    }, 16)
                }, k()) : x = b.requestAnimationFrame || o
            }), a.Velocity = t, a !== b && (a.fn.velocity = w, a.fn.velocity.defaults = t.defaults), m.each(["Down", "Up"], function(a, b) {
                t.Redirects["slide" + b] = function(a, c, e, f, g, h) {
                    var i = m.extend({}, c),
                        j = i.begin,
                        k = i.complete,
                        l = {
                            height: "",
                            marginTop: "",
                            marginBottom: "",
                            paddingTop: "",
                            paddingBottom: ""
                        },
                        n = {};
                    i.display === d && (i.display = "Down" === b ? "inline" === t.CSS.Values.getDisplayType(a) ? "inline-block" : "block" : "none"), i.begin = function() {
                        j && j.call(g, g);
                        for (var c in l) {
                            n[c] = a.style[c];
                            var d = t.CSS.getPropertyValue(a, c);
                            l[c] = "Down" === b ? [d, 0] : [0, d]
                        }
                        n.overflow = a.style.overflow, a.style.overflow = "hidden"
                    }, i.complete = function() {
                        for (var b in n) a.style[b] = n[b];
                        k && k.call(g, g), h && h.resolver(g)
                    }, t(a, l, i)
                }
            }), m.each(["In", "Out"], function(a, b) {
                t.Redirects["fade" + b] = function(a, c, e, f, g, h) {
                    var i = m.extend({}, c),
                        j = {
                            opacity: "In" === b ? 1 : 0
                        },
                        k = i.complete;
                    i.complete = e !== f - 1 ? i.begin = null : function() {
                        k && k.call(g, g), h && h.resolver(g)
                    }, i.display === d && (i.display = "In" === b ? "auto" : "none"), t(this, j, i)
                }
            }), t
        }(window.jQuery || window.Zepto || window, window, document)
    })), ! function(a, b, c, d) {
        "use strict";

        function e(a, b, c) {
            return setTimeout(k(a, c), b)
        }

        function f(a, b, c) {
            return Array.isArray(a) ? (g(a, c[b], c), !0) : !1
        }

        function g(a, b, c) {
            var e;
            if (a)
                if (a.forEach) a.forEach(b, c);
                else if (a.length !== d)
                for (e = 0; e < a.length;) b.call(c, a[e], e, a), e++;
            else
                for (e in a) a.hasOwnProperty(e) && b.call(c, a[e], e, a)
        }

        function h(a, b, c) {
            for (var e = Object.keys(b), f = 0; f < e.length;)(!c || c && a[e[f]] === d) && (a[e[f]] = b[e[f]]), f++;
            return a
        }

        function i(a, b) {
            return h(a, b, !0)
        }

        function j(a, b, c) {
            var d, e = b.prototype;
            d = a.prototype = Object.create(e), d.constructor = a, d._super = e, c && h(d, c)
        }

        function k(a, b) {
            return function() {
                return a.apply(b, arguments)
            }
        }

        function l(a, b) {
            return typeof a == ka ? a.apply(b ? b[0] || d : d, b) : a
        }

        function m(a, b) {
            return a === d ? b : a
        }

        function n(a, b, c) {
            g(r(b), function(b) {
                a.addEventListener(b, c, !1)
            })
        }

        function o(a, b, c) {
            g(r(b), function(b) {
                a.removeEventListener(b, c, !1)
            })
        }

        function p(a, b) {
            for (; a;) {
                if (a == b) return !0;
                a = a.parentNode
            }
            return !1
        }

        function q(a, b) {
            return a.indexOf(b) > -1
        }

        function r(a) {
            return a.trim().split(/\s+/g)
        }

        function s(a, b, c) {
            if (a.indexOf && !c) return a.indexOf(b);
            for (var d = 0; d < a.length;) {
                if (c && a[d][c] == b || !c && a[d] === b) return d;
                d++
            }
            return -1
        }

        function t(a) {
            return Array.prototype.slice.call(a, 0)
        }

        function u(a, b, c) {
            for (var d = [], e = [], f = 0; f < a.length;) {
                var g = b ? a[f][b] : a[f];
                s(e, g) < 0 && d.push(a[f]), e[f] = g, f++
            }
            return c && (d = b ? d.sort(function(a, c) {
                return a[b] > c[b]
            }) : d.sort()), d
        }

        function v(a, b) {
            for (var c, e, f = b[0].toUpperCase() + b.slice(1), g = 0; g < ia.length;) {
                if (c = ia[g], e = c ? c + f : b, e in a) return e;
                g++
            }
            return d
        }

        function w() {
            return oa++
        }

        function x(a) {
            var b = a.ownerDocument;
            return b.defaultView || b.parentWindow
        }

        function y(a, b) {
            var c = this;
            this.manager = a, this.callback = b, this.element = a.element, this.target = a.options.inputTarget, this.domHandler = function(b) {
                l(a.options.enable, [a]) && c.handler(b)
            }, this.init()
        }

        function z(a) {
            var b, c = a.options.inputClass;
            return new(b = c ? c : ra ? N : sa ? Q : qa ? S : M)(a, A)
        }

        function A(a, b, c) {
            var d = c.pointers.length,
                e = c.changedPointers.length,
                f = b & ya && 0 === d - e,
                g = b & (Aa | Ba) && 0 === d - e;
            c.isFirst = !!f, c.isFinal = !!g, f && (a.session = {}), c.eventType = b, B(a, c), a.emit("hammer.input", c), a.recognize(c), a.session.prevInput = c
        }

        function B(a, b) {
            var c = a.session,
                d = b.pointers,
                e = d.length;
            c.firstInput || (c.firstInput = E(b)), e > 1 && !c.firstMultiple ? c.firstMultiple = E(b) : 1 === e && (c.firstMultiple = !1);
            var f = c.firstInput,
                g = c.firstMultiple,
                h = g ? g.center : f.center,
                i = b.center = F(d);
            b.timeStamp = na(), b.deltaTime = b.timeStamp - f.timeStamp, b.angle = J(h, i), b.distance = I(h, i), C(c, b), b.offsetDirection = H(b.deltaX, b.deltaY), b.scale = g ? L(g.pointers, d) : 1, b.rotation = g ? K(g.pointers, d) : 0, D(c, b);
            var j = a.element;
            p(b.srcEvent.target, j) && (j = b.srcEvent.target), b.target = j
        }

        function C(a, b) {
            var c = b.center,
                d = a.offsetDelta || {},
                e = a.prevDelta || {},
                f = a.prevInput || {};
            (b.eventType === ya || f.eventType === Aa) && (e = a.prevDelta = {
                x: f.deltaX || 0,
                y: f.deltaY || 0
            }, d = a.offsetDelta = {
                x: c.x,
                y: c.y
            }), b.deltaX = e.x + (c.x - d.x), b.deltaY = e.y + (c.y - d.y)
        }

        function D(a, b) {
            var c, e, f, g, h = a.lastInterval || b,
                i = b.timeStamp - h.timeStamp;
            if (b.eventType != Ba && (i > xa || h.velocity === d)) {
                var j = h.deltaX - b.deltaX,
                    k = h.deltaY - b.deltaY,
                    l = G(i, j, k);
                e = l.x, f = l.y, c = ma(l.x) > ma(l.y) ? l.x : l.y, g = H(j, k), a.lastInterval = b
            } else c = h.velocity, e = h.velocityX, f = h.velocityY, g = h.direction;
            b.velocity = c, b.velocityX = e, b.velocityY = f, b.direction = g
        }

        function E(a) {
            for (var b = [], c = 0; c < a.pointers.length;) b[c] = {
                clientX: la(a.pointers[c].clientX),
                clientY: la(a.pointers[c].clientY)
            }, c++;
            return {
                timeStamp: na(),
                pointers: b,
                center: F(b),
                deltaX: a.deltaX,
                deltaY: a.deltaY
            }
        }

        function F(a) {
            var b = a.length;
            if (1 === b) return {
                x: la(a[0].clientX),
                y: la(a[0].clientY)
            };
            for (var c = 0, d = 0, e = 0; b > e;) c += a[e].clientX, d += a[e].clientY, e++;
            return {
                x: la(c / b),
                y: la(d / b)
            }
        }

        function G(a, b, c) {
            return {
                x: b / a || 0,
                y: c / a || 0
            }
        }

        function H(a, b) {
            return a === b ? Ca : ma(a) >= ma(b) ? a > 0 ? Da : Ea : b > 0 ? Fa : Ga
        }

        function I(a, b, c) {
            c || (c = Ka);
            var d = b[c[0]] - a[c[0]],
                e = b[c[1]] - a[c[1]];
            return Math.sqrt(d * d + e * e)
        }

        function J(a, b, c) {
            c || (c = Ka);
            var d = b[c[0]] - a[c[0]],
                e = b[c[1]] - a[c[1]];
            return 180 * Math.atan2(e, d) / Math.PI
        }

        function K(a, b) {
            return J(b[1], b[0], La) - J(a[1], a[0], La)
        }

        function L(a, b) {
            return I(b[0], b[1], La) / I(a[0], a[1], La)
        }

        function M() {
            this.evEl = Na, this.evWin = Oa, this.allow = !0, this.pressed = !1, y.apply(this, arguments)
        }

        function N() {
            this.evEl = Ra, this.evWin = Sa, y.apply(this, arguments), this.store = this.manager.session.pointerEvents = []
        }

        function O() {
            this.evTarget = Ua, this.evWin = Va, this.started = !1, y.apply(this, arguments)
        }

        function P(a, b) {
            var c = t(a.touches),
                d = t(a.changedTouches);
            return b & (Aa | Ba) && (c = u(c.concat(d), "identifier", !0)), [c, d]
        }

        function Q() {
            this.evTarget = Xa, this.targetIds = {}, y.apply(this, arguments)
        }

        function R(a, b) {
            var c = t(a.touches),
                d = this.targetIds;
            if (b & (ya | za) && 1 === c.length) return d[c[0].identifier] = !0, [c, c];
            var e, f, g = t(a.changedTouches),
                h = [],
                i = this.target;
            if (f = c.filter(function(a) {
                    return p(a.target, i)
                }), b === ya)
                for (e = 0; e < f.length;) d[f[e].identifier] = !0, e++;
            for (e = 0; e < g.length;) d[g[e].identifier] && h.push(g[e]), b & (Aa | Ba) && delete d[g[e].identifier], e++;
            return h.length ? [u(f.concat(h), "identifier", !0), h] : void 0
        }

        function S() {
            y.apply(this, arguments);
            var a = k(this.handler, this);
            this.touch = new Q(this.manager, a), this.mouse = new M(this.manager, a)
        }

        function T(a, b) {
            this.manager = a, this.set(b)
        }

        function U(a) {
            if (q(a, bb)) return bb;
            var b = q(a, cb),
                c = q(a, db);
            return b && c ? cb + " " + db : b || c ? b ? cb : db : q(a, ab) ? ab : _a
        }

        function V(a) {
            this.id = w(), this.manager = null, this.options = i(a || {}, this.defaults), this.options.enable = m(this.options.enable, !0), this.state = eb, this.simultaneous = {}, this.requireFail = []
        }

        function W(a) {
            return a & jb ? "cancel" : a & hb ? "end" : a & gb ? "move" : a & fb ? "start" : ""
        }

        function X(a) {
            return a == Ga ? "down" : a == Fa ? "up" : a == Da ? "left" : a == Ea ? "right" : ""
        }

        function Y(a, b) {
            var c = b.manager;
            return c ? c.get(a) : a
        }

        function Z() {
            V.apply(this, arguments)
        }

        function $() {
            Z.apply(this, arguments), this.pX = null, this.pY = null
        }

        function _() {
            Z.apply(this, arguments)
        }

        function aa() {
            V.apply(this, arguments), this._timer = null, this._input = null
        }

        function ba() {
            Z.apply(this, arguments)
        }

        function ca() {
            Z.apply(this, arguments)
        }

        function da() {
            V.apply(this, arguments), this.pTime = !1, this.pCenter = !1, this._timer = null, this._input = null, this.count = 0
        }

        function ea(a, b) {
            return b = b || {}, b.recognizers = m(b.recognizers, ea.defaults.preset), new fa(a, b)
        }

        function fa(a, b) {
            b = b || {}, this.options = i(b, ea.defaults), this.options.inputTarget = this.options.inputTarget || a, this.handlers = {}, this.session = {}, this.recognizers = [], this.element = a, this.input = z(this), this.touchAction = new T(this, this.options.touchAction), ga(this, !0), g(b.recognizers, function(a) {
                var b = this.add(new a[0](a[1]));
                a[2] && b.recognizeWith(a[2]), a[3] && b.requireFailure(a[3])
            }, this)
        }

        function ga(a, b) {
            var c = a.element;
            g(a.options.cssProps, function(a, d) {
                c.style[v(c.style, d)] = b ? a : ""
            })
        }

        function ha(a, c) {
            var d = b.createEvent("Event");
            d.initEvent(a, !0, !0), d.gesture = c, c.target.dispatchEvent(d)
        }
        var ia = ["", "webkit", "moz", "MS", "ms", "o"],
            ja = b.createElement("div"),
            ka = "function",
            la = Math.round,
            ma = Math.abs,
            na = Date.now,
            oa = 1,
            pa = /mobile|tablet|ip(ad|hone|od)|android/i,
            qa = "ontouchstart" in a,
            ra = v(a, "PointerEvent") !== d,
            sa = qa && pa.test(navigator.userAgent),
            ta = "touch",
            ua = "pen",
            va = "mouse",
            wa = "kinect",
            xa = 25,
            ya = 1,
            za = 2,
            Aa = 4,
            Ba = 8,
            Ca = 1,
            Da = 2,
            Ea = 4,
            Fa = 8,
            Ga = 16,
            Ha = Da | Ea,
            Ia = Fa | Ga,
            Ja = Ha | Ia,
            Ka = ["x", "y"],
            La = ["clientX", "clientY"];
        y.prototype = {
            handler: function() {},
            init: function() {
                this.evEl && n(this.element, this.evEl, this.domHandler), this.evTarget && n(this.target, this.evTarget, this.domHandler), this.evWin && n(x(this.element), this.evWin, this.domHandler)
            },
            destroy: function() {
                this.evEl && o(this.element, this.evEl, this.domHandler), this.evTarget && o(this.target, this.evTarget, this.domHandler), this.evWin && o(x(this.element), this.evWin, this.domHandler)
            }
        };
        var Ma = {
                mousedown: ya,
                mousemove: za,
                mouseup: Aa
            },
            Na = "mousedown",
            Oa = "mousemove mouseup";
        j(M, y, {
            handler: function(a) {
                var b = Ma[a.type];
                b & ya && 0 === a.button && (this.pressed = !0), b & za && 1 !== a.which && (b = Aa), this.pressed && this.allow && (b & Aa && (this.pressed = !1), this.callback(this.manager, b, {
                    pointers: [a],
                    changedPointers: [a],
                    pointerType: va,
                    srcEvent: a
                }))
            }
        });
        var Pa = {
                pointerdown: ya,
                pointermove: za,
                pointerup: Aa,
                pointercancel: Ba,
                pointerout: Ba
            },
            Qa = {
                2: ta,
                3: ua,
                4: va,
                5: wa
            },
            Ra = "pointerdown",
            Sa = "pointermove pointerup pointercancel";
        a.MSPointerEvent && (Ra = "MSPointerDown", Sa = "MSPointerMove MSPointerUp MSPointerCancel"), j(N, y, {
            handler: function(a) {
                var b = this.store,
                    c = !1,
                    d = a.type.toLowerCase().replace("ms", ""),
                    e = Pa[d],
                    f = Qa[a.pointerType] || a.pointerType,
                    g = f == ta,
                    h = s(b, a.pointerId, "pointerId");
                e & ya && (0 === a.button || g) ? 0 > h && (b.push(a), h = b.length - 1) : e & (Aa | Ba) && (c = !0), 0 > h || (b[h] = a, this.callback(this.manager, e, {
                    pointers: b,
                    changedPointers: [a],
                    pointerType: f,
                    srcEvent: a
                }), c && b.splice(h, 1))
            }
        });
        var Ta = {
                touchstart: ya,
                touchmove: za,
                touchend: Aa,
                touchcancel: Ba
            },
            Ua = "touchstart",
            Va = "touchstart touchmove touchend touchcancel";
        j(O, y, {
            handler: function(a) {
                var b = Ta[a.type];
                if (b === ya && (this.started = !0), this.started) {
                    var c = P.call(this, a, b);
                    b & (Aa | Ba) && 0 === c[0].length - c[1].length && (this.started = !1), this.callback(this.manager, b, {
                        pointers: c[0],
                        changedPointers: c[1],
                        pointerType: ta,
                        srcEvent: a
                    })
                }
            }
        });
        var Wa = {
                touchstart: ya,
                touchmove: za,
                touchend: Aa,
                touchcancel: Ba
            },
            Xa = "touchstart touchmove touchend touchcancel";
        j(Q, y, {
            handler: function(a) {
                var b = Wa[a.type],
                    c = R.call(this, a, b);
                c && this.callback(this.manager, b, {
                    pointers: c[0],
                    changedPointers: c[1],
                    pointerType: ta,
                    srcEvent: a
                })
            }
        }), j(S, y, {
            handler: function(a, b, c) {
                var d = c.pointerType == ta,
                    e = c.pointerType == va;
                if (d) this.mouse.allow = !1;
                else if (e && !this.mouse.allow) return;
                b & (Aa | Ba) && (this.mouse.allow = !0), this.callback(a, b, c)
            },
            destroy: function() {
                this.touch.destroy(), this.mouse.destroy()
            }
        });
        var Ya = v(ja.style, "touchAction"),
            Za = Ya !== d,
            $a = "compute",
            _a = "auto",
            ab = "manipulation",
            bb = "none",
            cb = "pan-x",
            db = "pan-y";
        T.prototype = {
            set: function(a) {
                a == $a && (a = this.compute()), Za && (this.manager.element.style[Ya] = a), this.actions = a.toLowerCase().trim()
            },
            update: function() {
                this.set(this.manager.options.touchAction)
            },
            compute: function() {
                var a = [];
                return g(this.manager.recognizers, function(b) {
                    l(b.options.enable, [b]) && (a = a.concat(b.getTouchAction()))
                }), U(a.join(" "))
            },
            preventDefaults: function(a) {
                if (!Za) {
                    var b = a.srcEvent,
                        c = a.offsetDirection;
                    if (this.manager.session.prevented) return void b.preventDefault();
                    var d = this.actions,
                        e = q(d, bb),
                        f = q(d, db),
                        g = q(d, cb);
                    return e || f && c & Ha || g && c & Ia ? this.preventSrc(b) : void 0
                }
            },
            preventSrc: function(a) {
                this.manager.session.prevented = !0, a.preventDefault()
            }
        };
        var eb = 1,
            fb = 2,
            gb = 4,
            hb = 8,
            ib = hb,
            jb = 16,
            kb = 32;
        V.prototype = {
            defaults: {},
            set: function(a) {
                return h(this.options, a), this.manager && this.manager.touchAction.update(), this
            },
            recognizeWith: function(a) {
                if (f(a, "recognizeWith", this)) return this;
                var b = this.simultaneous;
                return a = Y(a, this), b[a.id] || (b[a.id] = a, a.recognizeWith(this)), this
            },
            dropRecognizeWith: function(a) {
                return f(a, "dropRecognizeWith", this) ? this : (a = Y(a, this), delete this.simultaneous[a.id], this)
            },
            requireFailure: function(a) {
                if (f(a, "requireFailure", this)) return this;
                var b = this.requireFail;
                return a = Y(a, this), -1 === s(b, a) && (b.push(a), a.requireFailure(this)), this
            },
            dropRequireFailure: function(a) {
                if (f(a, "dropRequireFailure", this)) return this;
                a = Y(a, this);
                var b = s(this.requireFail, a);
                return b > -1 && this.requireFail.splice(b, 1), this
            },
            hasRequireFailures: function() {
                return this.requireFail.length > 0
            },
            canRecognizeWith: function(a) {
                return !!this.simultaneous[a.id]
            },
            emit: function(a) {
                function b(b) {
                    c.manager.emit(c.options.event + (b ? W(d) : ""), a)
                }
                var c = this,
                    d = this.state;
                hb > d && b(!0), b(), d >= hb && b(!0)
            },
            tryEmit: function(a) {
                return this.canEmit() ? this.emit(a) : void(this.state = kb)
            },
            canEmit: function() {
                for (var a = 0; a < this.requireFail.length;) {
                    if (!(this.requireFail[a].state & (kb | eb))) return !1;
                    a++
                }
                return !0
            },
            recognize: function(a) {
                var b = h({}, a);
                return l(this.options.enable, [this, b]) ? (this.state & (ib | jb | kb) && (this.state = eb), this.state = this.process(b), void(this.state & (fb | gb | hb | jb) && this.tryEmit(b))) : (this.reset(), void(this.state = kb))
            },
            process: function() {},
            getTouchAction: function() {},
            reset: function() {}
        }, j(Z, V, {
            defaults: {
                pointers: 1
            },
            attrTest: function(a) {
                var b = this.options.pointers;
                return 0 === b || a.pointers.length === b
            },
            process: function(a) {
                var b = this.state,
                    c = a.eventType,
                    d = b & (fb | gb),
                    e = this.attrTest(a);
                return d && (c & Ba || !e) ? b | jb : d || e ? c & Aa ? b | hb : b & fb ? b | gb : fb : kb
            }
        }), j($, Z, {
            defaults: {
                event: "pan",
                threshold: 10,
                pointers: 1,
                direction: Ja
            },
            getTouchAction: function() {
                var a = this.options.direction,
                    b = [];
                return a & Ha && b.push(db), a & Ia && b.push(cb), b
            },
            directionTest: function(a) {
                var b = this.options,
                    c = !0,
                    d = a.distance,
                    e = a.direction,
                    f = a.deltaX,
                    g = a.deltaY;
                return e & b.direction || (b.direction & Ha ? (e = 0 === f ? Ca : 0 > f ? Da : Ea, c = f != this.pX, d = Math.abs(a.deltaX)) : (e = 0 === g ? Ca : 0 > g ? Fa : Ga, c = g != this.pY, d = Math.abs(a.deltaY))), a.direction = e, c && d > b.threshold && e & b.direction
            },
            attrTest: function(a) {
                return Z.prototype.attrTest.call(this, a) && (this.state & fb || !(this.state & fb) && this.directionTest(a))
            },
            emit: function(a) {
                this.pX = a.deltaX, this.pY = a.deltaY;
                var b = X(a.direction);
                b && this.manager.emit(this.options.event + b, a), this._super.emit.call(this, a)
            }
        }), j(_, Z, {
            defaults: {
                event: "pinch",
                threshold: 0,
                pointers: 2
            },
            getTouchAction: function() {
                return [bb]
            },
            attrTest: function(a) {
                return this._super.attrTest.call(this, a) && (Math.abs(a.scale - 1) > this.options.threshold || this.state & fb)
            },
            emit: function(a) {
                if (this._super.emit.call(this, a), 1 !== a.scale) {
                    var b = a.scale < 1 ? "in" : "out";
                    this.manager.emit(this.options.event + b, a)
                }
            }
        }), j(aa, V, {
            defaults: {
                event: "press",
                pointers: 1,
                time: 500,
                threshold: 5
            },
            getTouchAction: function() {
                return [_a]
            },
            process: function(a) {
                var b = this.options,
                    c = a.pointers.length === b.pointers,
                    d = a.distance < b.threshold,
                    f = a.deltaTime > b.time;
                if (this._input = a, !d || !c || a.eventType & (Aa | Ba) && !f) this.reset();
                else if (a.eventType & ya) this.reset(), this._timer = e(function() {
                    this.state = ib, this.tryEmit()
                }, b.time, this);
                else if (a.eventType & Aa) return ib;
                return kb
            },
            reset: function() {
                clearTimeout(this._timer)
            },
            emit: function(a) {
                this.state === ib && (a && a.eventType & Aa ? this.manager.emit(this.options.event + "up", a) : (this._input.timeStamp = na(), this.manager.emit(this.options.event, this._input)))
            }
        }), j(ba, Z, {
            defaults: {
                event: "rotate",
                threshold: 0,
                pointers: 2
            },
            getTouchAction: function() {
                return [bb]
            },
            attrTest: function(a) {
                return this._super.attrTest.call(this, a) && (Math.abs(a.rotation) > this.options.threshold || this.state & fb)
            }
        }), j(ca, Z, {
            defaults: {
                event: "swipe",
                threshold: 10,
                velocity: .65,
                direction: Ha | Ia,
                pointers: 1
            },
            getTouchAction: function() {
                return $.prototype.getTouchAction.call(this)
            },
            attrTest: function(a) {
                var b, c = this.options.direction;
                return c & (Ha | Ia) ? b = a.velocity : c & Ha ? b = a.velocityX : c & Ia && (b = a.velocityY), this._super.attrTest.call(this, a) && c & a.direction && a.distance > this.options.threshold && ma(b) > this.options.velocity && a.eventType & Aa
            },
            emit: function(a) {
                var b = X(a.direction);
                b && this.manager.emit(this.options.event + b, a), this.manager.emit(this.options.event, a)
            }
        }), j(da, V, {
            defaults: {
                event: "tap",
                pointers: 1,
                taps: 1,
                interval: 300,
                time: 250,
                threshold: 2,
                posThreshold: 10
            },
            getTouchAction: function() {
                return [ab]
            },
            process: function(a) {
                var b = this.options,
                    c = a.pointers.length === b.pointers,
                    d = a.distance < b.threshold,
                    f = a.deltaTime < b.time;
                if (this.reset(), a.eventType & ya && 0 === this.count) return this.failTimeout();
                if (d && f && c) {
                    if (a.eventType != Aa) return this.failTimeout();
                    var g = this.pTime ? a.timeStamp - this.pTime < b.interval : !0,
                        h = !this.pCenter || I(this.pCenter, a.center) < b.posThreshold;
                    this.pTime = a.timeStamp, this.pCenter = a.center, h && g ? this.count += 1 : this.count = 1, this._input = a;
                    var i = this.count % b.taps;
                    if (0 === i) return this.hasRequireFailures() ? (this._timer = e(function() {
                        this.state = ib, this.tryEmit()
                    }, b.interval, this), fb) : ib
                }
                return kb
            },
            failTimeout: function() {
                return this._timer = e(function() {
                    this.state = kb
                }, this.options.interval, this), kb
            },
            reset: function() {
                clearTimeout(this._timer)
            },
            emit: function() {
                this.state == ib && (this._input.tapCount = this.count, this.manager.emit(this.options.event, this._input))
            }
        }), ea.VERSION = "2.0.4", ea.defaults = {
            domEvents: !1,
            touchAction: $a,
            enable: !0,
            inputTarget: null,
            inputClass: null,
            preset: [
                [ba, {
                    enable: !1
                }],
                [_, {
                        enable: !1
                    },
                    ["rotate"]
                ],
                [ca, {
                    direction: Ha
                }],
                [$, {
                        direction: Ha
                    },
                    ["swipe"]
                ],
                [da],
                [da, {
                        event: "doubletap",
                        taps: 2
                    },
                    ["tap"]
                ],
                [aa]
            ],
            cssProps: {
                userSelect: "default",
                touchSelect: "none",
                touchCallout: "none",
                contentZooming: "none",
                userDrag: "none",
                tapHighlightColor: "rgba(0,0,0,0)"
            }
        };
        var lb = 1,
            mb = 2;
        fa.prototype = {
            set: function(a) {
                return h(this.options, a), a.touchAction && this.touchAction.update(), a.inputTarget && (this.input.destroy(), this.input.target = a.inputTarget, this.input.init()), this
            },
            stop: function(a) {
                this.session.stopped = a ? mb : lb
            },
            recognize: function(a) {
                var b = this.session;
                if (!b.stopped) {
                    this.touchAction.preventDefaults(a);
                    var c, d = this.recognizers,
                        e = b.curRecognizer;
                    (!e || e && e.state & ib) && (e = b.curRecognizer = null);
                    for (var f = 0; f < d.length;) c = d[f], b.stopped === mb || e && c != e && !c.canRecognizeWith(e) ? c.reset() : c.recognize(a), !e && c.state & (fb | gb | hb) && (e = b.curRecognizer = c), f++
                }
            },
            get: function(a) {
                if (a instanceof V) return a;
                for (var b = this.recognizers, c = 0; c < b.length; c++)
                    if (b[c].options.event == a) return b[c];
                return null
            },
            add: function(a) {
                if (f(a, "add", this)) return this;
                var b = this.get(a.options.event);
                return b && this.remove(b), this.recognizers.push(a), a.manager = this, this.touchAction.update(), a
            },
            remove: function(a) {
                if (f(a, "remove", this)) return this;
                var b = this.recognizers;
                return a = this.get(a), b.splice(s(b, a), 1), this.touchAction.update(), this
            },
            on: function(a, b) {
                var c = this.handlers;
                return g(r(a), function(a) {
                    c[a] = c[a] || [], c[a].push(b)
                }), this
            },
            off: function(a, b) {
                var c = this.handlers;
                return g(r(a), function(a) {
                    b ? c[a].splice(s(c[a], b), 1) : delete c[a]
                }), this
            },
            emit: function(a, b) {
                this.options.domEvents && ha(a, b);
                var c = this.handlers[a] && this.handlers[a].slice();
                if (c && c.length) {
                    b.type = a, b.preventDefault = function() {
                        b.srcEvent.preventDefault()
                    };
                    for (var d = 0; d < c.length;) c[d](b), d++
                }
            },
            destroy: function() {
                this.element && ga(this, !1), this.handlers = {}, this.session = {}, this.input.destroy(), this.element = null
            }
        }, h(ea, {
            INPUT_START: ya,
            INPUT_MOVE: za,
            INPUT_END: Aa,
            INPUT_CANCEL: Ba,
            STATE_POSSIBLE: eb,
            STATE_BEGAN: fb,
            STATE_CHANGED: gb,
            STATE_ENDED: hb,
            STATE_RECOGNIZED: ib,
            STATE_CANCELLED: jb,
            STATE_FAILED: kb,
            DIRECTION_NONE: Ca,
            DIRECTION_LEFT: Da,
            DIRECTION_RIGHT: Ea,
            DIRECTION_UP: Fa,
            DIRECTION_DOWN: Ga,
            DIRECTION_HORIZONTAL: Ha,
            DIRECTION_VERTICAL: Ia,
            DIRECTION_ALL: Ja,
            Manager: fa,
            Input: y,
            TouchAction: T,
            TouchInput: Q,
            MouseInput: M,
            PointerEventInput: N,
            TouchMouseInput: S,
            SingleTouchInput: O,
            Recognizer: V,
            AttrRecognizer: Z,
            Tap: da,
            Pan: $,
            Swipe: ca,
            Pinch: _,
            Rotate: ba,
            Press: aa,
            on: n,
            off: o,
            each: g,
            merge: i,
            extend: h,
            inherit: j,
            bindFn: k,
            prefixed: v
        }), typeof define == ka && define.amd ? define(function() {
            return ea
        }) : "undefined" != typeof module && module.exports ? module.exports = ea : a[c] = ea
    }(window, document, "Hammer"),
    function(a) {
        "function" == typeof define && define.amd ? define(["jquery", "hammerjs"], a) : "object" == typeof exports ? a(require("jquery"), require("hammerjs")) : a(jQuery, Hammer)
    }(function(a, b) {
        function c(c, d) {
            var e = a(c);
            e.data("hammer") || e.data("hammer", new b(e[0], d))
        }
        a.fn.hammer = function(a) {
            return this.each(function() {
                c(this, a)
            })
        }, b.Manager.prototype.emit = function(b) {
            return function(c, d) {
                b.call(this, c, d), a(this.element).trigger({
                    type: c,
                    gesture: d
                })
            }
        }(b.Manager.prototype.emit)
    }),
    function(a) {
        a.Package ? Materialize = {} : a.Materialize = {}
    }(window), "undefined" == typeof exports || exports.nodeType || ("undefined" != typeof module && !module.nodeType && module.exports && (exports = module.exports = Materialize), exports["default"] = Materialize),
    function(a) {
        for (var b = 0, c = ["webkit", "moz"], d = a.requestAnimationFrame, e = a.cancelAnimationFrame, f = c.length; --f >= 0 && !d;) d = a[c[f] + "RequestAnimationFrame"], e = a[c[f] + "CancelRequestAnimationFrame"];
        d && e || (d = function(a) {
            var c = +Date.now(),
                d = Math.max(b + 16, c);
            return setTimeout(function() {
                a(b = d)
            }, d - c)
        }, e = clearTimeout), a.requestAnimationFrame = d, a.cancelAnimationFrame = e
    }(window), Materialize.objectSelectorString = function(a) {
        var b = a.prop("tagName") || "",
            c = a.attr("id") || "",
            d = a.attr("class") || "";
        return (b + c + d).replace(/\s/g, "")
    }, Materialize.guid = function() {
        function a() {
            return Math.floor(65536 * (1 + Math.random())).toString(16).substring(1)
        }
        return function() {
            return a() + a() + "-" + a() + "-" + a() + "-" + a() + "-" + a() + a() + a()
        }
    }(), Materialize.escapeHash = function(a) {
        return a.replace(/(:|\.|\[|\]|,|=)/g, "\\$1")
    }, Materialize.elementOrParentIsFixed = function(a) {
        var b = $(a),
            c = b.add(b.parents()),
            d = !1;
        return c.each(function() {
            return "fixed" === $(this).css("position") ? (d = !0, !1) : void 0
        }), d
    };
var getTime = Date.now || function() {
    return (new Date).getTime()
};
Materialize.throttle = function(a, b, c) {
    var d, e, f, g = null,
        h = 0;
    c || (c = {});
    var i = function() {
        h = c.leading === !1 ? 0 : getTime(), g = null, f = a.apply(d, e), d = e = null
    };
    return function() {
        var j = getTime();
        h || c.leading !== !1 || (h = j);
        var k = b - (j - h);
        return d = this, e = arguments, 0 >= k ? (clearTimeout(g), g = null, h = j, f = a.apply(d, e), d = e = null) : g || c.trailing === !1 || (g = setTimeout(i, k)), f
    }
};
var Vel;
Vel = jQuery ? jQuery.Velocity : $ ? $.Velocity : Velocity, Vel ? Materialize.Vel = Vel : Materialize.Vel = Velocity,
    function(a) {
        a.fn.collapsible = function(b, c) {
            var d = {
                    accordion: void 0,
                    onOpen: void 0,
                    onClose: void 0
                },
                e = b;
            return b = a.extend(d, b), this.each(function() {
                function d(b) {
                    m = l.find("> li > .collapsible-header"), b.hasClass("active") ? b.parent().addClass("active") : b.parent().removeClass("active"), b.parent().hasClass("active") ? b.siblings(".collapsible-body").stop(!0, !1).slideDown({
                        duration: 350,
                        easing: "easeOutQuart",
                        queue: !1,
                        complete: function() {
                            a(this).css("height", "")
                        }
                    }) : b.siblings(".collapsible-body").stop(!0, !1).slideUp({
                        duration: 350,
                        easing: "easeOutQuart",
                        queue: !1,
                        complete: function() {
                            a(this).css("height", "")
                        }
                    }), m.not(b).removeClass("active").parent().removeClass("active"), m.not(b).parent().children(".collapsible-body").stop(!0, !1).each(function() {
                        a(this).is(":visible") && a(this).slideUp({
                            duration: 350,
                            easing: "easeOutQuart",
                            queue: !1,
                            complete: function() {
                                a(this).css("height", ""), h(a(this).siblings(".collapsible-header"))
                            }
                        })
                    })
                }

                function f(b) {
                    b.hasClass("active") ? b.parent().addClass("active") : b.parent().removeClass("active"), b.parent().hasClass("active") ? b.siblings(".collapsible-body").stop(!0, !1).slideDown({
                        duration: 350,
                        easing: "easeOutQuart",
                        queue: !1,
                        complete: function() {
                            a(this).css("height", "")
                        }
                    }) : b.siblings(".collapsible-body").stop(!0, !1).slideUp({
                        duration: 350,
                        easing: "easeOutQuart",
                        queue: !1,
                        complete: function() {
                            a(this).css("height", "")
                        }
                    })
                }

                function g(a, c) {
                    c || a.toggleClass("active"), b.accordion || "accordion" === n || void 0 === n ? d(a) : f(a), h(a)
                }

                function h(a) {
                    a.hasClass("active") ? "function" == typeof b.onOpen && b.onOpen.call(this, a.parent()) : "function" == typeof b.onClose && b.onClose.call(this, a.parent())
                }

                function i(a) {
                    var b = j(a);
                    return b.length > 0
                }

                function j(a) {
                    return a.closest("li > .collapsible-header")
                }

                function k() {
                    l.off("click.collapse", "> li > .collapsible-header")
                }
                var l = a(this),
                    m = a(this).find("> li > .collapsible-header"),
                    n = l.data("collapsible");
                if ("destroy" === e) return void k();
                if (c >= 0 && c < m.length) {
                    var o = m.eq(c);
                    return void(o.length && ("open" === e || "close" === e && o.hasClass("active")) && g(o))
                }
                k(), l.on("click.collapse", "> li > .collapsible-header", function(b) {
                    var c = a(b.target);
                    i(c) && (c = j(c)), g(c)
                }), b.accordion || "accordion" === n || void 0 === n ? g(m.filter(".active").first(), !0) : m.filter(".active").each(function() {
                    g(a(this), !0)
                })
            })
        }, a(document).ready(function() {
            a(".collapsible").collapsible()
        })
    }(jQuery),
    function(a) {
        a.fn.scrollTo = function(b) {
            return a(this).scrollTop(a(this).scrollTop() - a(this).offset().top + a(b).offset().top), this
        }, a.fn.dropdown = function(b) {
            var c = {
                inDuration: 300,
                outDuration: 225,
                constrainWidth: !0,
                hover: !1,
                gutter: 0,
                belowOrigin: !1,
                alignment: "left",
                stopPropagation: !1
            };
            return "open" === b ? (this.each(function() {
                a(this).trigger("open")
            }), !1) : "close" === b ? (this.each(function() {
                a(this).trigger("close")
            }), !1) : void this.each(function() {
                function d() {
                    void 0 !== g.data("induration") && (h.inDuration = g.data("induration")), void 0 !== g.data("outduration") && (h.outDuration = g.data("outduration")), void 0 !== g.data("constrainwidth") && (h.constrainWidth = g.data("constrainwidth")), void 0 !== g.data("hover") && (h.hover = g.data("hover")), void 0 !== g.data("gutter") && (h.gutter = g.data("gutter")), void 0 !== g.data("beloworigin") && (h.belowOrigin = g.data("beloworigin")), void 0 !== g.data("alignment") && (h.alignment = g.data("alignment")), void 0 !== g.data("stoppropagation") && (h.stopPropagation = g.data("stoppropagation"))
                }

                function e(b) {
                    "focus" === b && (i = !0), d(), j.addClass("active"), g.addClass("active");
                    var c = g[0].getBoundingClientRect().width;
                    h.constrainWidth === !0 ? j.css("width", c) : j.css("white-space", "nowrap");
                    var e = window.innerHeight,
                        k = g.innerHeight(),
                        l = g.offset().left,
                        m = g.offset().top - a(window).scrollTop(),
                        n = h.alignment,
                        o = 0,
                        p = 0,
                        q = 0;
                    h.belowOrigin === !0 && (q = k);
                    var r = 0,
                        s = 0,
                        t = g.parent();
                    if (t.is("body") || (t[0].scrollHeight > t[0].clientHeight && (r = t[0].scrollTop), t[0].scrollWidth > t[0].clientWidth && (s = t[0].scrollLeft)), l + j.innerWidth() > a(window).width() ? n = "right" : l - j.innerWidth() + g.innerWidth() < 0 && (n = "left"), m + j.innerHeight() > e)
                        if (m + k - j.innerHeight() < 0) {
                            var u = e - m - q;
                            j.css("max-height", u)
                        } else q || (q += k), q -= j.innerHeight();
                    if ("left" === n) o = h.gutter, p = g.position().left + o;
                    else if ("right" === n) {
                        j.stop(!0, !0).css({
                            opacity: 0,
                            left: 0
                        });
                        var v = g.position().left + c - j.width();
                        o = -h.gutter, p = v + o
                    }
                    j.css({
                        position: "absolute",
                        top: g.position().top + q + r,
                        left: p + s
                    }), j.slideDown({
                        queue: !1,
                        duration: h.inDuration,
                        easing: "easeOutCubic",
                        complete: function() {
                            a(this).css("height", "")
                        }
                    }).animate({
                        opacity: 1
                    }, {
                        queue: !1,
                        duration: h.inDuration,
                        easing: "easeOutSine"
                    }), setTimeout(function() {
                        a(document).on("click." + j.attr("id"), function(b) {
                            f(), a(document).off("click." + j.attr("id"))
                        })
                    }, 0)
                }

                function f() {
                    i = !1, j.fadeOut(h.outDuration), j.removeClass("active"), g.removeClass("active"), a(document).off("click." + j.attr("id")), setTimeout(function() {
                        j.css("max-height", "")
                    }, h.outDuration)
                }
                var g = a(this),
                    h = a.extend({}, c, b),
                    i = !1,
                    j = a("#" + g.attr("data-activates"));
                if (d(), g.after(j), h.hover) {
                    var k = !1;
                    g.off("click." + g.attr("id")), g.on("mouseenter", function(a) {
                        k === !1 && (e(), k = !0)
                    }), g.on("mouseleave", function(b) {
                        var c = b.toElement || b.relatedTarget;
                        a(c).closest(".dropdown-content").is(j) || (j.stop(!0, !0), f(), k = !1)
                    }), j.on("mouseleave", function(b) {
                        var c = b.toElement || b.relatedTarget;
                        a(c).closest(".dropdown-button").is(g) || (j.stop(!0, !0), f(), k = !1)
                    })
                } else g.off("click." + g.attr("id")), g.on("click." + g.attr("id"), function(b) {
                    i || (g[0] != b.currentTarget || g.hasClass("active") || 0 !== a(b.target).closest(".dropdown-content").length ? g.hasClass("active") && (f(), a(document).off("click." + j.attr("id"))) : (b.preventDefault(), h.stopPropagation && b.stopPropagation(), e("click")))
                });
                g.on("open", function(a, b) {
                    e(b)
                }), g.on("close", f)
            })
        }, a(document).ready(function() {
            a(".dropdown-button").dropdown()
        })
    }(jQuery),
    function(a) {
        var b = 0,
            c = 0,
            d = function() {
                return c++, "materialize-lean-overlay-" + c
            };
        a.fn.extend({
            openModal: function(c) {
                var e = a("body"),
                    f = e.innerWidth();
                e.css("overflow", "hidden"), e.width(f);
                var g = {
                        opacity: .5,
                        in_duration: 350,
                        out_duration: 250,
                        ready: void 0,
                        complete: void 0,
                        dismissible: !0,
                        starting_top: "4%"
                    },
                    h = a(this);
                h.hasClass("open") || (overlayID = d(), $overlay = a('<div class="lean-overlay"></div>'), lStack = ++b, $overlay.attr("id", overlayID).css("z-index", 1e3 + 2 * lStack), h.data("overlay-id", overlayID).css("z-index", 1e3 + 2 * lStack + 1), h.addClass("open"), a("body").append($overlay), c = a.extend(g, c), c.dismissible && ($overlay.click(function() {
                    h.closeModal(c)
                }), a(document).on("keyup.leanModal" + overlayID, function(a) {
                    27 === a.keyCode && h.closeModal(c)
                })), h.find(".modal-close").on("click.close", function(a) {
                    h.closeModal(c)
                }), $overlay.css({
                    display: "block",
                    opacity: 0
                }), h.css({
                    display: "block",
                    opacity: 0
                }), $overlay.velocity({
                    opacity: c.opacity
                }, {
                    duration: c.in_duration,
                    queue: !1,
                    ease: "easeOutCubic"
                }), h.data("associated-overlay", $overlay[0]), h.hasClass("bottom-sheet") ? h.velocity({
                    bottom: "0",
                    opacity: 1
                }, {
                    duration: c.in_duration,
                    queue: !1,
                    ease: "easeOutCubic",
                    complete: function() {
                        "function" == typeof c.ready && c.ready()
                    }
                }) : (a.Velocity.hook(h, "scaleX", .7), h.css({
                    top: c.starting_top
                }), h.velocity({
                    top: "10%",
                    opacity: 1,
                    scaleX: "1"
                }, {
                    duration: c.in_duration,
                    queue: !1,
                    ease: "easeOutCubic",
                    complete: function() {
                        "function" == typeof c.ready && c.ready()
                    }
                })))
            }
        }), a.fn.extend({
            closeModal: function(c) {
                var d = {
                        out_duration: 250,
                        complete: void 0
                    },
                    e = a(this),
                    f = e.data("overlay-id"),
                    g = a("#" + f);
                e.removeClass("open"), c = a.extend(d, c), a("body").css({
                    overflow: "",
                    width: ""
                }), e.find(".modal-close").off("click.close"), a(document).off("keyup.leanModal" + f), g.velocity({
                    opacity: 0
                }, {
                    duration: c.out_duration,
                    queue: !1,
                    ease: "easeOutQuart"
                }), e.hasClass("bottom-sheet") ? e.velocity({
                    bottom: "-100%",
                    opacity: 0
                }, {
                    duration: c.out_duration,
                    queue: !1,
                    ease: "easeOutCubic",
                    complete: function() {
                        g.css({
                            display: "none"
                        }), "function" == typeof c.complete && c.complete(), g.remove(), b--
                    }
                }) : e.velocity({
                    top: c.starting_top,
                    opacity: 0,
                    scaleX: .7
                }, {
                    duration: c.out_duration,
                    complete: function() {
                        a(this).css("display", "none"), "function" == typeof c.complete && c.complete(), g.remove(), b--
                    }
                })
            }
        }), a.fn.extend({
            leanModal: function(b) {
                return this.each(function() {
                    var c = {
                            starting_top: "4%"
                        },
                        d = a.extend(c, b);
                    a(this).click(function(b) {
                        d.starting_top = (a(this).offset().top - a(window).scrollTop()) / 1.15;
                        var c = a(this).attr("href") || "#" + a(this).data("target");
                        a(c).openModal(d), b.preventDefault()
                    })
                })
            }
        })
    }(jQuery),
    function(a) {
        a.fn.materialbox = function() {
            return this.each(function() {
                function b() {
                    f = !1;
                    var b = i.parent(".material-placeholder"),
                        d = (window.innerWidth, window.innerHeight, i.data("width")),
                        g = i.data("height");
                    i.velocity("stop", !0), a("#materialbox-overlay").velocity("stop", !0), a(".materialbox-caption").velocity("stop", !0), a(window).off("scroll.materialbox"), a(document).off("keyup.materialbox"), a(window).off("resize.materialbox"), a("#materialbox-overlay").velocity({
                        opacity: 0
                    }, {
                        duration: h,
                        queue: !1,
                        easing: "easeOutQuad",
                        complete: function() {
                            e = !1, a(this).remove()
                        }
                    }), i.velocity({
                        width: d,
                        height: g,
                        left: 0,
                        top: 0
                    }, {
                        duration: h,
                        queue: !1,
                        easing: "easeOutQuad",
                        complete: function() {
                            b.css({
                                height: "",
                                width: "",
                                position: "",
                                top: "",
                                left: ""
                            }), i.removeAttr("style"), i.attr("style", k), i.removeClass("active"), f = !0, c && c.css("overflow", "")
                        }
                    }), a(".materialbox-caption").velocity({
                        opacity: 0
                    }, {
                        duration: h,
                        queue: !1,
                        easing: "easeOutQuad",
                        complete: function() {
                            a(this).remove()
                        }
                    })
                }
                if (!a(this).hasClass("initialized")) {
                    a(this).addClass("initialized");
                    var c, d, e = !1,
                        f = !0,
                        g = 275,
                        h = 200,
                        i = a(this),
                        j = a("<div></div>").addClass("material-placeholder"),
                        k = i.attr("style");
                    i.wrap(j), i.on("click", function() {
                        var h = i.parent(".material-placeholder"),
                            j = window.innerWidth,
                            k = window.innerHeight,
                            l = i.width(),
                            m = i.height();
                        if (f === !1) return b(), !1;
                        if (e && f === !0) return b(), !1;
                        f = !1, i.addClass("active"), e = !0, h.css({
                            width: h[0].getBoundingClientRect().width,
                            height: h[0].getBoundingClientRect().height,
                            position: "relative",
                            top: 0,
                            left: 0
                        }), c = void 0, d = h[0].parentNode;
                        for (; null !== d && !a(d).is(document);) {
                            var n = a(d);
                            "visible" !== n.css("overflow") && (n.css("overflow", "visible"), c = void 0 === c ? n : c.add(n)), d = d.parentNode
                        }
                        i.css({
                            position: "absolute",
                            "z-index": 1e3,
                            "will-change": "left, top, width, height"
                        }).data("width", l).data("height", m);
                        var o = a('<div id="materialbox-overlay"></div>').css({
                            opacity: 0
                        }).click(function() {
                            f === !0 && b()
                        });
                        i.before(o);
                        var p = o[0].getBoundingClientRect();
                        if (o.css({
                                width: j,
                                height: k,
                                left: -1 * p.left,
                                top: -1 * p.top
                            }), o.velocity({
                                opacity: 1
                            }, {
                                duration: g,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), "" !== i.data("caption")) {
                            var q = a('<div class="materialbox-caption"></div>');
                            q.text(i.data("caption")), a("body").append(q), q.css({
                                display: "inline"
                            }), q.velocity({
                                opacity: 1
                            }, {
                                duration: g,
                                queue: !1,
                                easing: "easeOutQuad"
                            })
                        }
                        var r = 0,
                            s = l / j,
                            t = m / k,
                            u = 0,
                            v = 0;
                        s > t ? (r = m / l, u = .9 * j, v = .9 * j * r) : (r = l / m, u = .9 * k * r, v = .9 * k), i.hasClass("responsive-img") ? i.velocity({
                            "max-width": u,
                            width: l
                        }, {
                            duration: 0,
                            queue: !1,
                            complete: function() {
                                i.css({
                                    left: 0,
                                    top: 0
                                }).velocity({
                                    height: v,
                                    width: u,
                                    left: a(document).scrollLeft() + j / 2 - i.parent(".material-placeholder").offset().left - u / 2,
                                    top: a(document).scrollTop() + k / 2 - i.parent(".material-placeholder").offset().top - v / 2
                                }, {
                                    duration: g,
                                    queue: !1,
                                    easing: "easeOutQuad",
                                    complete: function() {
                                        f = !0
                                    }
                                })
                            }
                        }) : i.css("left", 0).css("top", 0).velocity({
                            height: v,
                            width: u,
                            left: a(document).scrollLeft() + j / 2 - i.parent(".material-placeholder").offset().left - u / 2,
                            top: a(document).scrollTop() + k / 2 - i.parent(".material-placeholder").offset().top - v / 2
                        }, {
                            duration: g,
                            queue: !1,
                            easing: "easeOutQuad",
                            complete: function() {
                                f = !0
                            }
                        }), a(window).on("scroll.materialbox", function() {
                            e && b()
                        }), a(window).on("resize.materialbox", function() {
                            e && b()
                        }), a(document).on("keyup.materialbox", function(a) {
                            27 === a.keyCode && f === !0 && e && b()
                        })
                    })
                }
            })
        }, a(document).ready(function() {
            a(".materialboxed").materialbox()
        })
    }(jQuery),
    function(a) {
        a.fn.parallax = function() {
            var b = a(window).width();
            return this.each(function(c) {
                function d(c) {
                    var d;
                    d = 601 > b ? e.height() > 0 ? e.height() : e.children("img").height() : e.height() > 0 ? e.height() : 500;
                    var f = e.children("img").first(),
                        g = f.height(),
                        h = g - d,
                        i = e.offset().top + d,
                        j = e.offset().top,
                        k = a(window).scrollTop(),
                        l = window.innerHeight,
                        m = k + l,
                        n = (m - j) / (d + l),
                        o = Math.round(h * n);
                    c && f.css("display", "block"), i > k && k + l > j && f.css("transform", "translate3D(-50%," + o + "px, 0)")
                }
                var e = a(this);
                e.addClass("parallax"), e.children("img").one("load", function() {
                    d(!0)
                }).each(function() {
                    this.complete && a(this).trigger("load")
                }), a(window).scroll(function() {
                    b = a(window).width(), d(!1)
                }), a(window).resize(function() {
                    b = a(window).width(), d(!1)
                })
            })
        }
    }(jQuery),
    function(a) {
        var b = {
            init: function(b) {
                var c = {
                    onShow: null,
                    swipeable: !1,
                    responsiveThreshold: 1 / 0
                };
                b = a.extend(c, b);
                var d = Materialize.objectSelectorString(a(this));
                return this.each(function(c) {
                    var e, f, g, h, i, j = d + c,
                        k = a(this),
                        l = a(window).width(),
                        m = k.find("li.tab a"),
                        n = k.width(),
                        o = a(),
                        p = Math.max(n, k[0].scrollWidth) / m.length,
                        q = 0,
                        r = 0,
                        s = !1,
                        t = 300,
                        u = function(a) {
                            return Math.ceil(n - a.position().left - a[0].getBoundingClientRect().width - k.scrollLeft())
                        },
                        v = function(a) {
                            return Math.floor(a.position().left + k.scrollLeft())
                        },
                        w = function(a) {
                            q - a >= 0 ? (h.velocity({
                                right: u(e)
                            }, {
                                duration: t,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), h.velocity({
                                left: v(e)
                            }, {
                                duration: t,
                                queue: !1,
                                easing: "easeOutQuad",
                                delay: 90
                            })) : (h.velocity({
                                left: v(e)
                            }, {
                                duration: t,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), h.velocity({
                                right: u(e)
                            }, {
                                duration: t,
                                queue: !1,
                                easing: "easeOutQuad",
                                delay: 90
                            }))
                        };
                    b.swipeable && l > b.responsiveThreshold && (b.swipeable = !1), e = a(m.filter('[href="' + location.hash + '"]')), 0 === e.length && (e = a(this).find("li.tab a.active").first()), 0 === e.length && (e = a(this).find("li.tab a").first()), e.addClass("active"), q = m.index(e), 0 > q && (q = 0), void 0 !== e[0] && (f = a(e[0].hash), f.addClass("active")), k.find(".indicator").length || k.append('<li class="indicator"></li>'), h = k.find(".indicator"), k.append(h), k.is(":visible") && setTimeout(function() {
                        h.css({
                            right: u(e)
                        }), h.css({
                            left: v(e)
                        })
                    }, 0), a(window).off("resize.tabs-" + j).on("resize.tabs-" + j, function() {
                        n = k.width(), p = Math.max(n, k[0].scrollWidth) / m.length, 0 > q && (q = 0), 0 !== p && 0 !== n && (h.css({
                            right: u(e)
                        }), h.css({
                            left: v(e)
                        }))
                    }), b.swipeable ? (m.each(function() {
                        var b = a(Materialize.escapeHash(this.hash));
                        b.addClass("carousel-item"), o = o.add(b)
                    }), g = o.wrapAll('<div class="tabs-content carousel"></div>'), o.css("display", ""), a(".tabs-content.carousel").carousel({
                        fullWidth: !0,
                        noWrap: !0,
                        onCycleTo: function(a) {
                            if (!s) {
                                var c = q;
                                q = g.index(a), e.removeClass("active"), e = m.eq(q), e.addClass("active"), w(c), "function" == typeof b.onShow && b.onShow.call(k[0], f)
                            }
                        }
                    })) : m.not(e).each(function() {
                        a(Materialize.escapeHash(this.hash)).hide()
                    }), k.off("click.tabs").on("click.tabs", "a", function(c) {
                        if (a(this).parent().hasClass("disabled")) return void c.preventDefault();
                        if (!a(this).attr("target")) {
                            s = !0, n = k.width(), p = Math.max(n, k[0].scrollWidth) / m.length, e.removeClass("active");
                            var d = f;
                            e = a(this), f = a(Materialize.escapeHash(this.hash)), m = k.find("li.tab a");
                            e.position();
                            e.addClass("active"), r = q, q = m.index(a(this)), 0 > q && (q = 0), window.location.hash = e.attr("href"), b.swipeable ? o.length && o.carousel("set", q, function() {
                                "function" == typeof b.onShow && b.onShow.call(k[0], f)
                            }) : (void 0 !== f && (f.show(), f.addClass("active"), "function" == typeof b.onShow && b.onShow.call(this, f)), void 0 === d || d.is(f) || (d.hide(), d.removeClass("active"))), i = setTimeout(function() {
                                s = !1
                            }, t), w(r), c.preventDefault()
                        }
                    })
                })
            },
            select_tab: function(a) {
                this.find('a[href="#' + a + '"]').trigger("click")
            }
        };
        a.fn.tabs = function(c) {
            return b[c] ? b[c].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof c && c ? void a.error("Method " + c + " does not exist on jQuery.tabs") : b.init.apply(this, arguments)
        }, a(document).ready(function() {
            a("ul.tabs").tabs()
        })
    }(jQuery),
    function(a) {
        a.fn.tooltip = function(c) {
            var d = 5,
                e = {
                    delay: 350,
                    tooltip: "",
                    position: "bottom",
                    html: !1
                };
            return "remove" === c ? (this.each(function() {
                a("#" + a(this).attr("data-tooltip-id")).remove(), a(this).removeAttr("data-tooltip-id"), a(this).off("mouseenter.tooltip mouseleave.tooltip")
            }), !1) : (c = a.extend(e, c), this.each(function() {
                var e = Materialize.guid(),
                    f = a(this);
                f.attr("data-tooltip-id") && a("#" + f.attr("data-tooltip-id")).remove(), f.attr("data-tooltip-id", e);
                var g, h, i, j, k, l, m = function() {
                    g = f.attr("data-html") ? "true" === f.attr("data-html") : c.html, h = f.attr("data-delay"), h = void 0 === h || "" === h ? c.delay : h, i = f.attr("data-position"), i = void 0 === i || "" === i ? c.position : i, j = f.attr("data-tooltip"), j = void 0 === j || "" === j ? c.tooltip : j
                };
                m();
                var n = function() {
                    var b = a('<div class="material-tooltip"></div>');
                    return j = g ? a("<span></span>").html(j) : a("<span></span>").text(j), b.append(j).appendTo(a("body")).attr("id", e), l = a('<div class="backdrop"></div>'), l.appendTo(b), b
                };
                k = n(), f.off("mouseenter.tooltip mouseleave.tooltip");
                var o, p = !1;
                f.on({
                    "mouseenter.tooltip": function(a) {
                        var c = function() {
                            m(), p = !0, k.velocity("stop"), l.velocity("stop"), k.css({
                                visibility: "visible",
                                left: "0px",
                                top: "0px"
                            });
                            var a, c, e, g = f.outerWidth(),
                                h = f.outerHeight(),
                                j = k.outerHeight(),
                                n = k.outerWidth(),
                                o = "0px",
                                q = "0px",
                                r = l[0].offsetWidth,
                                s = l[0].offsetHeight,
                                t = 8,
                                u = 8,
                                v = 0;
                            "top" === i ? (a = f.offset().top - j - d, c = f.offset().left + g / 2 - n / 2, e = b(c, a, n, j), o = "-10px", l.css({
                                bottom: 0,
                                left: 0,
                                borderRadius: "14px 14px 0 0",
                                transformOrigin: "50% 100%",
                                marginTop: j,
                                marginLeft: n / 2 - r / 2
                            })) : "left" === i ? (a = f.offset().top + h / 2 - j / 2, c = f.offset().left - n - d, e = b(c, a, n, j), q = "-10px", l.css({
                                top: "-7px",
                                right: 0,
                                width: "14px",
                                height: "14px",
                                borderRadius: "14px 0 0 14px",
                                transformOrigin: "95% 50%",
                                marginTop: j / 2,
                                marginLeft: n
                            })) : "right" === i ? (a = f.offset().top + h / 2 - j / 2, c = f.offset().left + g + d, e = b(c, a, n, j), q = "+10px", l.css({
                                top: "-7px",
                                left: 0,
                                width: "14px",
                                height: "14px",
                                borderRadius: "0 14px 14px 0",
                                transformOrigin: "5% 50%",
                                marginTop: j / 2,
                                marginLeft: "0px"
                            })) : (a = f.offset().top + f.outerHeight() + d, c = f.offset().left + g / 2 - n / 2, e = b(c, a, n, j), o = "+10px", l.css({
                                top: 0,
                                left: 0,
                                marginLeft: n / 2 - r / 2
                            })), k.css({
                                top: e.y,
                                left: e.x
                            }), t = Math.SQRT2 * n / parseInt(r), u = Math.SQRT2 * j / parseInt(s), v = Math.max(t, u), k.velocity({
                                translateY: o,
                                translateX: q
                            }, {
                                duration: 350,
                                queue: !1
                            }).velocity({
                                opacity: 1
                            }, {
                                duration: 300,
                                delay: 50,
                                queue: !1
                            }), l.css({
                                visibility: "visible"
                            }).velocity({
                                opacity: 1
                            }, {
                                duration: 55,
                                delay: 0,
                                queue: !1
                            }).velocity({
                                scaleX: v,
                                scaleY: v
                            }, {
                                duration: 300,
                                delay: 0,
                                queue: !1,
                                easing: "easeInOutQuad"
                            })
                        };
                        o = setTimeout(c, h)
                    },
                    "mouseleave.tooltip": function() {
                        p = !1, clearTimeout(o), setTimeout(function() {
                            p !== !0 && (k.velocity({
                                opacity: 0,
                                translateY: 0,
                                translateX: 0
                            }, {
                                duration: 225,
                                queue: !1
                            }), l.velocity({
                                opacity: 0,
                                scaleX: 1,
                                scaleY: 1
                            }, {
                                duration: 225,
                                queue: !1,
                                complete: function() {
                                    l.css({
                                        visibility: "hidden"
                                    }), k.css({
                                        visibility: "hidden"
                                    }), p = !1
                                }
                            }))
                        }, 225)
                    }
                })
            }))
        };
        var b = function(b, c, d, e) {
            var f = b,
                g = c;
            return 0 > f ? f = 4 : f + d > window.innerWidth && (f -= f + d - window.innerWidth), 0 > g ? g = 4 : g + e > window.innerHeight + a(window).scrollTop && (g -= g + e - window.innerHeight), {
                x: f,
                y: g
            }
        };
        a(document).ready(function() {
            a(".tooltipped").tooltip()
        })
    }(jQuery),
    function(a) {
        "use strict";

        function b(a) {
            return null !== a && a === a.window
        }

        function c(a) {
            return b(a) ? a : 9 === a.nodeType && a.defaultView
        }

        function d(a) {
            var b, d, e = {
                    top: 0,
                    left: 0
                },
                f = a && a.ownerDocument;
            return b = f.documentElement, "undefined" != typeof a.getBoundingClientRect && (e = a.getBoundingClientRect()), d = c(f), {
                top: e.top + d.pageYOffset - b.clientTop,
                left: e.left + d.pageXOffset - b.clientLeft
            }
        }

        function e(a) {
            var b = "";
            for (var c in a) a.hasOwnProperty(c) && (b += c + ":" + a[c] + ";");
            return b
        }

        function f(a) {
            if (k.allowEvent(a) === !1) return null;
            for (var b = null, c = a.target || a.srcElement; null !== c.parentNode;) {
                if (!(c instanceof SVGElement) && -1 !== c.className.indexOf("waves-effect")) {
                    b = c;
                    break
                }
                c = c.parentNode
            }
            return b
        }

        function g(b) {
            var c = f(b);
            null !== c && (j.show(b, c), "ontouchstart" in a && (c.addEventListener("touchend", j.hide, !1), c.addEventListener("touchcancel", j.hide, !1)), c.addEventListener("mouseup", j.hide, !1), c.addEventListener("mouseleave", j.hide, !1), c.addEventListener("dragend", j.hide, !1))
        }
        var h = h || {},
            i = document.querySelectorAll.bind(document),
            j = {
                duration: 750,
                show: function(a, b) {
                    if (2 === a.button) return !1;
                    var c = b || this,
                        f = document.createElement("div");
                    f.className = "waves-ripple", c.appendChild(f);
                    var g = d(c),
                        h = a.pageY - g.top,
                        i = a.pageX - g.left,
                        k = "scale(" + c.clientWidth / 100 * 10 + ")";
                    "touches" in a && (h = a.touches[0].pageY - g.top, i = a.touches[0].pageX - g.left), f.setAttribute("data-hold", Date.now()), f.setAttribute("data-scale", k), f.setAttribute("data-x", i), f.setAttribute("data-y", h);
                    var l = {
                        top: h + "px",
                        left: i + "px"
                    };
                    f.className = f.className + " waves-notransition", f.setAttribute("style", e(l)), f.className = f.className.replace("waves-notransition", ""), l["-webkit-transform"] = k, l["-moz-transform"] = k, l["-ms-transform"] = k, l["-o-transform"] = k, l.transform = k, l.opacity = "1", l["-webkit-transition-duration"] = j.duration + "ms", l["-moz-transition-duration"] = j.duration + "ms", l["-o-transition-duration"] = j.duration + "ms", l["transition-duration"] = j.duration + "ms", l["-webkit-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", l["-moz-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", l["-o-transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", l["transition-timing-function"] = "cubic-bezier(0.250, 0.460, 0.450, 0.940)", f.setAttribute("style", e(l))
                },
                hide: function(a) {
                    k.touchup(a);
                    var b = this,
                        c = (1.4 * b.clientWidth, null),
                        d = b.getElementsByClassName("waves-ripple");
                    if (!(d.length > 0)) return !1;
                    c = d[d.length - 1];
                    var f = c.getAttribute("data-x"),
                        g = c.getAttribute("data-y"),
                        h = c.getAttribute("data-scale"),
                        i = Date.now() - Number(c.getAttribute("data-hold")),
                        l = 350 - i;
                    0 > l && (l = 0), setTimeout(function() {
                        var a = {
                            top: g + "px",
                            left: f + "px",
                            opacity: "0",
                            "-webkit-transition-duration": j.duration + "ms",
                            "-moz-transition-duration": j.duration + "ms",
                            "-o-transition-duration": j.duration + "ms",
                            "transition-duration": j.duration + "ms",
                            "-webkit-transform": h,
                            "-moz-transform": h,
                            "-ms-transform": h,
                            "-o-transform": h,
                            transform: h
                        };
                        c.setAttribute("style", e(a)), setTimeout(function() {
                            try {
                                b.removeChild(c)
                            } catch (a) {
                                return !1
                            }
                        }, j.duration)
                    }, l)
                },
                wrapInput: function(a) {
                    for (var b = 0; b < a.length; b++) {
                        var c = a[b];
                        if ("input" === c.tagName.toLowerCase()) {
                            var d = c.parentNode;
                            if ("i" === d.tagName.toLowerCase() && -1 !== d.className.indexOf("waves-effect")) continue;
                            var e = document.createElement("i");
                            e.className = c.className + " waves-input-wrapper";
                            var f = c.getAttribute("style");
                            f || (f = ""), e.setAttribute("style", f), c.className = "waves-button-input", c.removeAttribute("style"), d.replaceChild(e, c), e.appendChild(c)
                        }
                    }
                }
            },
            k = {
                touches: 0,
                allowEvent: function(a) {
                    var b = !0;
                    return "touchstart" === a.type ? k.touches += 1 : "touchend" === a.type || "touchcancel" === a.type ? setTimeout(function() {
                        k.touches > 0 && (k.touches -= 1)
                    }, 500) : "mousedown" === a.type && k.touches > 0 && (b = !1), b
                },
                touchup: function(a) {
                    k.allowEvent(a)
                }
            };
        h.displayEffect = function(b) {
            b = b || {}, "duration" in b && (j.duration = b.duration), j.wrapInput(i(".waves-effect")), "ontouchstart" in a && document.body.addEventListener("touchstart", g, !1), document.body.addEventListener("mousedown", g, !1)
        }, h.attach = function(b) {
            "input" === b.tagName.toLowerCase() && (j.wrapInput([b]), b = b.parentNode), "ontouchstart" in a && b.addEventListener("touchstart", g, !1), b.addEventListener("mousedown", g, !1)
        }, a.Waves = h, document.addEventListener("DOMContentLoaded", function() {
            h.displayEffect()
        }, !1)
    }(window),
    function(a, b) {
        "use strict";
        var c = {
                displayLength: 1 / 0,
                inDuration: 300,
                outDuration: 375,
                className: void 0,
                completeCallback: void 0,
                activationPercent: .8
            },
            d = function() {
                function d(b, c, e, f) {
                    if (_classCallCheck(this, d), b) {
                        this.options = {
                            displayLength: c,
                            className: e,
                            completeCallback: f
                        }, this.options = a.extend({}, d.defaults, this.options), this.message = b, this.panning = !1, this.timeRemaining = this.options.displayLength, 0 === d._toasts.length && d._createContainer(), d._toasts.push(this);
                        var g = this.createToast();
                        g.M_Toast = this, this.el = g, this._animateIn(), this.setTimer()
                    }
                }
                return _createClass(d, [{
                    key: "createToast",
                    value: function() {
                        var b = document.createElement("div");
                        if (b.classList.add("toast"), this.options.className) {
                            var c = this.options.className.split(" "),
                                e = void 0,
                                f = void 0;
                            for (e = 0, f = c.length; f > e; e++) b.classList.add(c[e])
                        }
                        return ("object" == typeof HTMLElement ? this.message instanceof HTMLElement : this.message && "object" == typeof this.message && null !== this.message && 1 === this.message.nodeType && "string" == typeof this.message.nodeName) ? b.appendChild(this.message) : this.message instanceof jQuery ? a(b).append(this.message) : b.innerHTML = this.message, d._container.appendChild(b), b
                    }
                }, {
                    key: "_animateIn",
                    value: function() {
                        b(this.el, {
                            top: 0,
                            opacity: 1
                        }, {
                            duration: 300,
                            easing: "easeOutCubic",
                            queue: !1
                        })
                    }
                }, {
                    key: "setTimer",
                    value: function() {
                        var a = this;
                        this.timeRemaining !== 1 / 0 && (this.counterInterval = setInterval(function() {
                            a.panning || (a.timeRemaining -= 20), a.timeRemaining <= 0 && a.remove()
                        }, 20))
                    }
                }, {
                    key: "remove",
                    value: function() {
                        var a = this;
                        window.clearInterval(this.counterInterval);
                        var c = this.el.offsetWidth * this.options.activationPercent;
                        this.wasSwiped && (this.el.style.transition = "transform .05s, opacity .05s", this.el.style.transform = "translateX(" + c + "px)", this.el.style.opacity = 0), b(this.el, {
                            opacity: 0,
                            marginTop: "-40px"
                        }, {
                            duration: this.options.outDuration,
                            easing: "easeOutExpo",
                            queue: !1,
                            complete: function() {
                                "function" == typeof a.options.completeCallback && a.options.completeCallback(), a.el.parentNode.removeChild(a.el), d._toasts.splice(d._toasts.indexOf(a), 1), 0 === d._toasts.length && d._removeContainer()
                            }
                        })
                    }
                }], [{
                    key: "_createContainer",
                    value: function() {
                        var a = document.createElement("div");
                        a.setAttribute("id", "toast-container"), a.addEventListener("touchstart", d._onDragStart), a.addEventListener("touchmove", d._onDragMove), a.addEventListener("touchend", d._onDragEnd), a.addEventListener("mousedown", d._onDragStart), document.addEventListener("mousemove", d._onDragMove), document.addEventListener("mouseup", d._onDragEnd), document.body.appendChild(a), d._container = a
                    }
                }, {
                    key: "_removeContainer",
                    value: function() {
                        document.removeEventListener("mousemove", d._onDragMove), document.removeEventListener("mouseup", d._onDragEnd), d._container.parentNode.removeChild(d._container), d._container = null
                    }
                }, {
                    key: "_onDragStart",
                    value: function(b) {
                        if (b.target && a(b.target).closest(".toast").length) {
                            var c = a(b.target).closest(".toast"),
                                e = c[0].M_Toast;
                            e.panning = !0, d._draggedToast = e, e.el.classList.add("panning"), e.el.style.transition = "", e.startingXPos = d._xPos(b), e.time = Date.now(), e.xPos = d._xPos(b)
                        }
                    }
                }, {
                    key: "_onDragMove",
                    value: function(a) {
                        if (d._draggedToast) {
                            a.preventDefault();
                            var b = d._draggedToast;
                            b.deltaX = Math.abs(b.xPos - d._xPos(a)), b.xPos = d._xPos(a), b.velocityX = b.deltaX / (Date.now() - b.time), b.time = Date.now();
                            var c = b.xPos - b.startingXPos,
                                e = b.el.offsetWidth * b.options.activationPercent;
                            b.el.style.transform = "translateX(" + c + "px)", b.el.style.opacity = 1 - Math.abs(c / e)
                        }
                    }
                }, {
                    key: "_onDragEnd",
                    value: function(a) {
                        if (d._draggedToast) {
                            var b = d._draggedToast;
                            b.panning = !1, b.el.classList.remove("panning");
                            var c = b.xPos - b.startingXPos,
                                e = b.el.offsetWidth * b.options.activationPercent,
                                f = Math.abs(c) > e || b.velocityX > 1;
                            f ? (b.wasSwiped = !0, b.remove()) : (b.el.style.transition = "transform .2s, opacity .2s", b.el.style.transform = "", b.el.style.opacity = ""), d._draggedToast = null
                        }
                    }
                }, {
                    key: "_xPos",
                    value: function(a) {
                        return a.targetTouches && a.targetTouches.length >= 1 ? a.targetTouches[0].clientX : a.clientX
                    }
                }, {
                    key: "removeAll",
                    value: function() {
                        for (var a in d._toasts) d._toasts[a].remove()
                    }
                }, {
                    key: "defaults",
                    get: function() {
                        return c
                    }
                }]), d
            }();
        d._toasts = [], d._container = null, d._draggedToast = null, Materialize.Toast = d, Materialize.toast = function(a, b, c, e) {
            return new d(a, b, c, e)
        }
    }(jQuery, Materialize.Vel),
    function(a) {
        var b = {
            init: function(b) {
                var c = {
                    menuWidth: 300,
                    edge: "left",
                    closeOnClick: !1,
                    draggable: !0,
                    onOpen: null,
                    onClose: null
                };
                b = a.extend(c, b), a(this).each(function() {
                    var c = a(this),
                        d = c.attr("data-activates"),
                        e = a("#" + d);
                    300 != b.menuWidth && e.css("width", b.menuWidth);
                    var f = a('.drag-target[data-sidenav="' + d + '"]');
                    b.draggable ? (f.length && f.remove(), f = a('<div class="drag-target"></div>').attr("data-sidenav", d), a("body").append(f)) : f = a(), "left" == b.edge ? (e.css("transform", "translateX(-100%)"), f.css({
                        left: 0
                    })) : (e.addClass("right-aligned").css("transform", "translateX(100%)"), f.css({
                        right: 0
                    })), e.hasClass("fixed") && window.innerWidth > 992 && e.css("transform", "translateX(0)"), e.hasClass("fixed") && a(window).resize(function() {
                        window.innerWidth > 992 ? 0 !== a("#sidenav-overlay").length && i ? g(!0) : e.css("transform", "translateX(0%)") : i === !1 && ("left" === b.edge ? e.css("transform", "translateX(-100%)") : e.css("transform", "translateX(100%)"))
                    }), b.closeOnClick === !0 && e.on("click.itemclick", "a:not(.collapsible-header)", function() {
                        window.innerWidth > 992 && e.hasClass("fixed") || g()
                    });
                    var g = function(c) {
                            h = !1, i = !1, a("body").css({
                                overflow: "",
                                width: ""
                            }), a("#sidenav-overlay").velocity({
                                opacity: 0
                            }, {
                                duration: 200,
                                queue: !1,
                                easing: "easeOutQuad",
                                complete: function() {
                                    a(this).remove()
                                }
                            }), "left" === b.edge ? (f.css({
                                width: "",
                                right: "",
                                left: "0"
                            }), e.velocity({
                                translateX: "-100%"
                            }, {
                                duration: 200,
                                queue: !1,
                                easing: "easeOutCubic",
                                complete: function() {
                                    c === !0 && (e.removeAttr("style"), e.css("width", b.menuWidth))
                                }
                            })) : (f.css({
                                width: "",
                                right: "0",
                                left: ""
                            }), e.velocity({
                                translateX: "100%"
                            }, {
                                duration: 200,
                                queue: !1,
                                easing: "easeOutCubic",
                                complete: function() {
                                    c === !0 && (e.removeAttr("style"), e.css("width", b.menuWidth))
                                }
                            })), "function" == typeof b.onClose && b.onClose.call(this, e)
                        },
                        h = !1,
                        i = !1;
                    b.draggable && (f.on("click", function() {
                        i && g()
                    }), f.hammer({
                        prevent_default: !1
                    }).on("pan", function(c) {
                        if ("touch" == c.gesture.pointerType) {
                            var d = (c.gesture.direction, c.gesture.center.x),
                                f = c.gesture.center.y;
                            c.gesture.velocityX;
                            if (0 === d && 0 === f) return;
                            var h = a("body"),
                                j = a("#sidenav-overlay"),
                                k = h.innerWidth();
                            if (h.css("overflow", "hidden"), h.width(k), 0 === j.length && (j = a('<div id="sidenav-overlay"></div>'), j.css("opacity", 0).click(function() {
                                    g()
                                }), "function" == typeof b.onOpen && b.onOpen.call(this, e), a("body").append(j)), "left" === b.edge && (d > b.menuWidth ? d = b.menuWidth : 0 > d && (d = 0)), "left" === b.edge) d < b.menuWidth / 2 ? i = !1 : d >= b.menuWidth / 2 && (i = !0), e.css("transform", "translateX(" + (d - b.menuWidth) + "px)");
                            else {
                                d < window.innerWidth - b.menuWidth / 2 ? i = !0 : d >= window.innerWidth - b.menuWidth / 2 && (i = !1);
                                var l = d - b.menuWidth / 2;
                                0 > l && (l = 0), e.css("transform", "translateX(" + l + "px)")
                            }
                            var m;
                            "left" === b.edge ? (m = d / b.menuWidth, j.velocity({
                                opacity: m
                            }, {
                                duration: 10,
                                queue: !1,
                                easing: "easeOutQuad"
                            })) : (m = Math.abs((d - window.innerWidth) / b.menuWidth), j.velocity({
                                opacity: m
                            }, {
                                duration: 10,
                                queue: !1,
                                easing: "easeOutQuad"
                            }))
                        }
                    }).on("panend", function(c) {
                        if ("touch" == c.gesture.pointerType) {
                            var d = a("#sidenav-overlay"),
                                g = c.gesture.velocityX,
                                j = c.gesture.center.x,
                                k = j - b.menuWidth,
                                l = j - b.menuWidth / 2;
                            k > 0 && (k = 0), 0 > l && (l = 0), h = !1, "left" === b.edge ? i && .3 >= g || -.5 > g ? (0 !== k && e.velocity({
                                translateX: [0, k]
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), d.velocity({
                                opacity: 1
                            }, {
                                duration: 50,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), f.css({
                                width: "50%",
                                right: 0,
                                left: ""
                            }), i = !0) : (!i || g > .3) && (a("body").css({
                                overflow: "",
                                width: ""
                            }), e.velocity({
                                translateX: [-1 * b.menuWidth - 10, k]
                            }, {
                                duration: 200,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), d.velocity({
                                opacity: 0
                            }, {
                                duration: 200,
                                queue: !1,
                                easing: "easeOutQuad",
                                complete: function() {
                                    "function" == typeof b.onClose && b.onClose.call(this, e), a(this).remove()
                                }
                            }), f.css({
                                width: "10px",
                                right: "",
                                left: 0
                            })) : i && g >= -.3 || g > .5 ? (0 !== l && e.velocity({
                                translateX: [0, l]
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), d.velocity({
                                opacity: 1
                            }, {
                                duration: 50,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), f.css({
                                width: "50%",
                                right: "",
                                left: 0
                            }), i = !0) : (!i || -.3 > g) && (a("body").css({
                                overflow: "",
                                width: ""
                            }), e.velocity({
                                translateX: [b.menuWidth + 10, l]
                            }, {
                                duration: 200,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), d.velocity({
                                opacity: 0
                            }, {
                                duration: 200,
                                queue: !1,
                                easing: "easeOutQuad",
                                complete: function() {
                                    "function" == typeof b.onClose && b.onClose.call(this, e), a(this).remove()
                                }
                            }), f.css({
                                width: "10px",
                                right: 0,
                                left: ""
                            }))
                        }
                    })), c.off("click.sidenav").on("click.sidenav", function() {
                        if (i === !0) i = !1, h = !1, g();
                        else {
                            var c = a("body"),
                                d = a('<div id="sidenav-overlay"></div>'),
                                j = c.innerWidth();
                            c.css("overflow", "hidden"), c.width(j), a("body").append(f), "left" === b.edge ? (f.css({
                                width: "50%",
                                right: 0,
                                left: ""
                            }), e.velocity({
                                translateX: [0, -1 * b.menuWidth]
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad"
                            })) : (f.css({
                                width: "50%",
                                right: "",
                                left: 0
                            }), e.velocity({
                                translateX: [0, b.menuWidth]
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad"
                            })), d.css("opacity", 0).click(function() {
                                i = !1, h = !1, g(), d.velocity({
                                    opacity: 0
                                }, {
                                    duration: 300,
                                    queue: !1,
                                    easing: "easeOutQuad",
                                    complete: function() {
                                        a(this).remove()
                                    }
                                })
                            }), a("body").append(d), d.velocity({
                                opacity: 1
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad",
                                complete: function() {
                                    i = !0, h = !1
                                }
                            }), "function" == typeof b.onOpen && b.onOpen.call(this, e)
                        }
                        return !1
                    })
                })
            },
            destroy: function() {
                var b = a("#sidenav-overlay"),
                    c = a('.drag-target[data-sidenav="' + a(this).attr("data-activates") + '"]');
                b.trigger("click"), c.remove(), a(this).off("click"), b.remove()
            },
            show: function() {
                this.trigger("click")
            },
            hide: function() {
                a("#sidenav-overlay").trigger("click")
            }
        };
        a.fn.sideNav = function(c) {
            return b[c] ? b[c].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof c && c ? void a.error("Method " + c + " does not exist on jQuery.sideNav") : b.init.apply(this, arguments)
        }
    }(jQuery),
    function(a) {
        function b(b, c, d, e) {
            var g = a();
            return a.each(f, function(a, f) {
                if (f.height() > 0) {
                    var h = f.offset().top,
                        i = f.offset().left,
                        j = i + f.width(),
                        k = h + f.height(),
                        l = !(i > c || e > j || h > d || b > k);
                    l && g.push(f)
                }
            }), g
        }

        function c(c) {
            ++i;
            var d = e.scrollTop(),
                f = e.scrollLeft(),
                h = f + e.width(),
                k = d + e.height(),
                l = b(d + j.top + c || 200, h + j.right, k + j.bottom, f + j.left);
            a.each(l, function(a, b) {
                var c = b.data("scrollSpy:ticks");
                "number" != typeof c && b.triggerHandler("scrollSpy:enter"), b.data("scrollSpy:ticks", i)
            }), a.each(g, function(a, b) {
                var c = b.data("scrollSpy:ticks");
                "number" == typeof c && c !== i && (b.triggerHandler("scrollSpy:exit"), b.data("scrollSpy:ticks", null))
            }), g = l
        }

        function d() {
            e.trigger("scrollSpy:winSize")
        }
        var e = a(window),
            f = [],
            g = [],
            h = !1,
            i = 0,
            j = {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            };
        a.scrollSpy = function(b, d) {
            var g = {
                throttle: 100,
                scrollOffset: 200,
                activeClass: "active",
                getActiveElement: function(a) {
                    return 'a[href="#' + a + '"]'
                }
            };
            d = a.extend(g, d);
            var i = [];
            b = a(b), b.each(function(b, c) {
                f.push(a(c)), a(c).data("scrollSpy:id", b), a('a[href="#' + a(c).attr("id") + '"]').click(function(b) {
                    b.preventDefault();
                    var c = a(Materialize.escapeHash(this.hash)).offset().top + 1;
                    a("html, body").animate({
                        scrollTop: c - d.scrollOffset
                    }, {
                        duration: 400,
                        queue: !1,
                        easing: "easeOutCubic"
                    })
                })
            }), j.top = d.offsetTop || 0, j.right = d.offsetRight || 0, j.bottom = d.offsetBottom || 0, j.left = d.offsetLeft || 0;
            var k = Materialize.throttle(function() {
                    c(d.scrollOffset)
                }, d.throttle || 100),
                l = function() {
                    a(document).ready(k)
                };
            return h || (e.on("scroll", l), e.on("resize", l), h = !0), setTimeout(l, 0), b.on("scrollSpy:enter", function() {
                i = a.grep(i, function(a) {
                    return 0 != a.height()
                });
                var b = a(this);
                i[0] ? (a(d.getActiveElement(i[0].attr("id"))).removeClass(d.activeClass), b.data("scrollSpy:id") < i[0].data("scrollSpy:id") ? i.unshift(a(this)) : i.push(a(this))) : i.push(a(this)), a(d.getActiveElement(i[0].attr("id"))).addClass(d.activeClass)
            }), b.on("scrollSpy:exit", function() {
                if (i = a.grep(i, function(a) {
                        return 0 != a.height()
                    }), i[0]) {
                    a(d.getActiveElement(i[0].attr("id"))).removeClass(d.activeClass);
                    var b = a(this);
                    i = a.grep(i, function(a) {
                        return a.attr("id") != b.attr("id")
                    }), i[0] && a(d.getActiveElement(i[0].attr("id"))).addClass(d.activeClass)
                }
            }), b
        }, a.winSizeSpy = function(b) {
            return a.winSizeSpy = function() {
                return e
            }, b = b || {
                throttle: 100
            }, e.on("resize", Materialize.throttle(d, b.throttle || 100))
        }, a.fn.scrollSpy = function(b) {
            return a.scrollSpy(a(this), b)
        }
    }(jQuery),
    function(a) {
        a(document).ready(function() {
            function b(b) {
                var c = b.css("font-family"),
                    d = b.css("font-size"),
                    f = b.css("line-height"),
                    g = b.css("padding");
                d && e.css("font-size", d), c && e.css("font-family", c), f && e.css("line-height", f), g && e.css("padding", g), b.data("original-height") || b.data("original-height", b.height()), "off" === b.attr("wrap") && e.css("overflow-wrap", "normal").css("white-space", "pre"), e.text(b.val() + "\n");
                var h = e.html().replace(/\n/g, "<br>");
                e.html(h), b.is(":visible") ? e.css("width", b.width()) : e.css("width", a(window).width() / 2), b.data("original-height") <= e.height() ? b.css("height", e.height()) : b.val().length < b.data("previous-length") && b.css("height", b.data("original-height")), b.data("previous-length", b.val().length)
            }
            Materialize.updateTextFields = function() {
                var b = "input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], textarea";
                a(b).each(function(b, c) {
                    var d = a(this);
                    a(c).val().length > 0 || a(c).is(":focus") || c.autofocus || void 0 !== d.attr("placeholder") ? d.siblings("label").addClass("active") : a(c)[0].validity ? d.siblings("label").toggleClass("active", a(c)[0].validity.badInput === !0) : d.siblings("label").removeClass("active")
                })
            };
            var c = "input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], textarea";
            a(document).on("change", c, function() {
                (0 !== a(this).val().length || void 0 !== a(this).attr("placeholder")) && a(this).siblings("label").addClass("active"), validate_field(a(this))
            }), a(document).ready(function() {
                Materialize.updateTextFields()
            }), a(document).on("reset", function(b) {
                var d = a(b.target);
                d.is("form") && (d.find(c).removeClass("valid").removeClass("invalid"), d.find(c).each(function() {
                    "" === a(this).attr("value") && a(this).siblings("label").removeClass("active")
                }), d.find("select.initialized").each(function() {
                    var a = d.find("option[selected]").text();
                    d.siblings("input.select-dropdown").val(a)
                }))
            }), a(document).on("focus", c, function() {
                a(this).siblings("label, .prefix").addClass("active")
            }), a(document).on("blur", c, function() {
                var b = a(this),
                    c = ".prefix";
                0 === b.val().length && b[0].validity.badInput !== !0 && void 0 === b.attr("placeholder") && (c += ", label"), b.siblings(c).removeClass("active"), validate_field(b)
            }), window.validate_field = function(a) {
                var b = void 0 !== a.attr("data-length"),
                    c = parseInt(a.attr("data-length")),
                    d = a.val().length;
                0 !== a.val().length || a[0].validity.badInput !== !1 || a.is(":required") ? a.hasClass("validate") && (a.is(":valid") && b && c >= d || a.is(":valid") && !b ? (a.removeClass("invalid"), a.addClass("valid")) : (a.removeClass("valid"), a.addClass("invalid"))) : a.hasClass("validate") && (a.removeClass("valid"), a.removeClass("invalid"))
            };
            var d = "input[type=radio], input[type=checkbox]";
            a(document).on("keyup.radio", d, function(b) {
                if (9 === b.which) {
                    a(this).addClass("tabbed");
                    var c = a(this);
                    return void c.one("blur", function(b) {
                        a(this).removeClass("tabbed")
                    })
                }
            });
            var e = a(".hiddendiv").first();
            e.length || (e = a('<div class="hiddendiv common"></div>'), a("body").append(e));
            var f = ".materialize-textarea";
            a(f).each(function() {
                var b = a(this);
                b.data("original-height", b.height()), b.data("previous-length", b.val().length)
            }), a("body").on("keyup keydown autoresize", f, function() {
                b(a(this))
            }), a(document).on("change", '.file-field input[type="file"]', function() {
                for (var b = a(this).closest(".file-field"), c = b.find("input.file-path"), d = a(this)[0].files, e = [], f = 0; f < d.length; f++) e.push(d[f].name);
                c.val(e.join(", ")), c.trigger("change")
            });
            var g = "input[type=range]",
                h = !1;
            a(g).each(function() {
                var b = a('<span class="thumb"><span class="value"></span></span>');
                a(this).after(b)
            });
            var i = function(a) {
                    var b = parseInt(a.parent().css("padding-left")),
                        c = -7 + b + "px";
                    a.velocity({
                        height: "30px",
                        width: "30px",
                        top: "-30px",
                        marginLeft: c
                    }, {
                        duration: 300,
                        easing: "easeOutExpo"
                    })
                },
                j = function(a) {
                    var b = a.width() - 15,
                        c = parseFloat(a.attr("max")),
                        d = parseFloat(a.attr("min")),
                        e = (parseFloat(a.val()) - d) / (c - d);
                    return e * b
                },
                k = ".range-field";
            a(document).on("change", g, function(b) {
                var c = a(this).siblings(".thumb");
                c.find(".value").html(a(this).val()), c.hasClass("active") || i(c);
                var d = j(a(this));
                c.addClass("active").css("left", d)
            }), a(document).on("mousedown touchstart", g, function(b) {
                var c = a(this).siblings(".thumb");
                if (c.length <= 0 && (c = a('<span class="thumb"><span class="value"></span></span>'), a(this).after(c)), c.find(".value").html(a(this).val()), h = !0, a(this).addClass("active"), c.hasClass("active") || i(c), "input" !== b.type) {
                    var d = j(a(this));
                    c.addClass("active").css("left", d)
                }
            }), a(document).on("mouseup touchend", k, function() {
                h = !1, a(this).removeClass("active")
            }), a(document).on("input mousemove touchmove", k, function(b) {
                var c = a(this).children(".thumb"),
                    d = a(this).find(g);
                if (h) {
                    c.hasClass("active") || i(c);
                    var e = j(d);
                    c.addClass("active").css("left", e), c.find(".value").html(c.siblings(g).val())
                }
            }), a(document).on("mouseout touchleave", k, function() {
                if (!h) {
                    var b = a(this).children(".thumb"),
                        c = parseInt(a(this).css("padding-left")),
                        d = 7 + c + "px";
                    b.hasClass("active") && b.velocity({
                        height: "0",
                        width: "0",
                        top: "10px",
                        marginLeft: d
                    }, {
                        duration: 100
                    }), b.removeClass("active")
                }
            }), a.fn.autocomplete = function(b) {
                var c = {
                    data: {},
                    limit: 1 / 0,
                    onAutocomplete: null,
                    minLength: 1
                };
                return b = a.extend(c, b), this.each(function() {
                    var c, d = a(this),
                        e = b.data,
                        f = 0,
                        g = -1,
                        h = d.closest(".input-field");
                    if (a.isEmptyObject(e)) d.off("keyup.autocomplete focus.autocomplete");
                    else {
                        var i, j = a('<ul class="autocomplete-content dropdown-content"></ul>');
                        h.length ? (i = h.children(".autocomplete-content.dropdown-content").first(), i.length || h.append(j)) : (i = d.next(".autocomplete-content.dropdown-content"), i.length || d.after(j)), i.length && (j = i);
                        var k = function(a, b) {
                                var c = b.find("img"),
                                    d = b.text().toLowerCase().indexOf("" + a.toLowerCase()),
                                    e = d + a.length - 1,
                                    f = b.text().slice(0, d),
                                    g = b.text().slice(d, e + 1),
                                    h = b.text().slice(e + 1);
                                b.html("<span>" + f + "<span class='highlight'>" + g + "</span>" + h + "</span>"), c.length && b.prepend(c)
                            },
                            l = function() {
                                g = -1, j.find(".active").removeClass("active")
                            },
                            m = function() {
                                j.empty(), l(), c = void 0
                            };
                        d.off("blur.autocomplete").on("blur.autocomplete", function() {
                            m()
                        }), d.off("keyup.autocomplete focus.autocomplete").on("keyup.autocomplete focus.autocomplete", function(g) {
                            f = 0;
                            var h = d.val().toLowerCase();
                            if (13 !== g.which && 38 !== g.which && 40 !== g.which) {
                                if (c !== h && (m(),
                                        h.length >= b.minLength))
                                    for (var i in e)
                                        if (e.hasOwnProperty(i) && -1 !== i.toLowerCase().indexOf(h)) {
                                            if (f >= b.limit) break;
                                            var l = a("<li></li>");
                                            e[i] ? l.append('<img src="' + e[i] + '" class="right circle"><span>' + i + "</span>") : l.append("<span>" + i + "</span>"), j.append(l), k(h, l), f++
                                        }
                                c = h
                            }
                        }), d.off("keydown.autocomplete").on("keydown.autocomplete", function(a) {
                            var b, c = a.which,
                                d = j.children("li").length,
                                e = j.children(".active").first();
                            return 13 === c && g >= 0 ? (b = j.children("li").eq(g), void(b.length && (b.trigger("mousedown.autocomplete"), a.preventDefault()))) : void((38 === c || 40 === c) && (a.preventDefault(), 38 === c && g > 0 && g--, 40 === c && d - 1 > g && g++, e.removeClass("active"), g >= 0 && j.children("li").eq(g).addClass("active")))
                        }), j.off("mousedown.autocomplete touchstart.autocomplete").on("mousedown.autocomplete touchstart.autocomplete", "li", function() {
                            var c = a(this).text().trim();
                            d.val(c), d.trigger("change"), m(), "function" == typeof b.onAutocomplete && b.onAutocomplete.call(this, c)
                        })
                    }
                })
            }
        }), a.fn.material_select = function(b) {
            function c(a, b, c) {
                var e = a.indexOf(b),
                    f = -1 === e;
                return f ? a.push(b) : a.splice(e, 1), c.siblings("ul.dropdown-content").find("li:not(.optgroup)").eq(b).toggleClass("active"), c.find("option").eq(b).prop("selected", f), d(a, c), f
            }

            function d(a, b) {
                for (var c = "", d = 0, e = a.length; e > d; d++) {
                    var f = b.find("option").eq(a[d]).text();
                    c += 0 === d ? f : ", " + f
                }
                "" === c && (c = b.find("option:disabled").eq(0).text()), b.siblings("input.select-dropdown").val(c)
            }
            a(this).each(function() {
                var d = a(this);
                if (!d.hasClass("browser-default")) {
                    var e = d.attr("multiple") ? !0 : !1,
                        f = d.attr("data-select-id");
                    if (f && (d.parent().find("span.caret").remove(), d.parent().find("input").remove(), d.unwrap(), a("ul#select-options-" + f).remove()), "destroy" === b) return d.removeAttr("data-select-id").removeClass("initialized"), void a(window).off("click.select");
                    var g = Materialize.guid();
                    d.attr("data-select-id", g);
                    var h = a('<div class="select-wrapper"></div>');
                    h.addClass(d.attr("class")), d.is(":disabled") && h.addClass("disabled");
                    var i = a('<ul id="select-options-' + g + '" class="dropdown-content select-dropdown ' + (e ? "multiple-select-dropdown" : "") + '"></ul>'),
                        j = d.children("option, optgroup"),
                        k = [],
                        l = !1,
                        m = d.find("option:selected").html() || d.find("option:first").html() || "",
                        n = function(b, c, d) {
                            var f = c.is(":disabled") ? "disabled " : "",
                                g = "optgroup-option" === d ? "optgroup-option " : "",
                                h = e ? '<input type="checkbox"' + f + "/><label></label>" : "",
                                j = c.data("icon"),
                                k = c.attr("class");
                            if (j) {
                                var l = "";
                                return k && (l = ' class="' + k + '"'), i.append(a('<li class="' + f + g + '"><img alt="" src="' + j + '"' + l + "><span>" + h + c.html() + "</span></li>")), !0
                            }
                            i.append(a('<li class="' + f + g + '"><span>' + h + c.html() + "</span></li>"))
                        };
                    j.length && j.each(function() {
                        if (a(this).is("option")) e ? n(d, a(this), "multiple") : n(d, a(this));
                        else if (a(this).is("optgroup")) {
                            var b = a(this).children("option");
                            i.append(a('<li class="optgroup"><span>' + a(this).attr("label") + "</span></li>")), b.each(function() {
                                n(d, a(this), "optgroup-option")
                            })
                        }
                    }), i.find("li:not(.optgroup)").each(function(f) {
                        a(this).click(function(g) {
                            if (!a(this).hasClass("disabled") && !a(this).hasClass("optgroup")) {
                                var h = !0;
                                e ? (a('input[type="checkbox"]', this).prop("checked", function(a, b) {
                                    return !b
                                }), h = c(k, f, d), q.trigger("focus")) : (i.find("li").removeClass("active"), a(this).toggleClass("active"), q.val(a(this).text())), r(i, a(this)), d.find("option").eq(f).prop("selected", h), d.trigger("change"), "undefined" != typeof b && b()
                            }
                            g.stopPropagation()
                        })
                    }), d.wrap(h);
                    var o = a('<span class="caret">&#9660;</span>'),
                        p = m.replace(/"/g, "&quot;"),
                        q = a('<input type="text" class="select-dropdown" readonly="true" ' + (d.is(":disabled") ? "disabled" : "") + ' data-activates="select-options-' + g + '" value="' + p + '"/>');
                    d.before(q), q.before(o), q.after(i), d.is(":disabled") || q.dropdown({
                        hover: !1
                    }), d.attr("tabindex") && a(q[0]).attr("tabindex", d.attr("tabindex")), d.addClass("initialized"), q.on({
                        focus: function() {
                            if (a("ul.select-dropdown").not(i[0]).is(":visible") && (a("input.select-dropdown").trigger("close"), a(window).off("click.select")), !i.is(":visible")) {
                                a(this).trigger("open", ["focus"]);
                                var b = a(this).val();
                                e && b.indexOf(",") >= 0 && (b = b.split(",")[0]);
                                var c = i.find("li").filter(function() {
                                    return a(this).text().toLowerCase() === b.toLowerCase()
                                })[0];
                                r(i, c, !0), a(window).off("click.select").on("click.select", function() {
                                    e && (l || q.trigger("close")), a(window).off("click.select")
                                })
                            }
                        },
                        click: function(a) {
                            a.stopPropagation()
                        }
                    }), q.on("blur", function() {
                        e || (a(this).trigger("close"), a(window).off("click.select")), i.find("li.selected").removeClass("selected")
                    }), i.hover(function() {
                        l = !0
                    }, function() {
                        l = !1
                    }), e && d.find("option:selected:not(:disabled)").each(function() {
                        var a = this.index;
                        c(k, a, d), i.find("li:not(.optgroup)").eq(a).find(":checkbox").prop("checked", !0)
                    });
                    var r = function(b, c, d) {
                            if (c) {
                                b.find("li.selected").removeClass("selected");
                                var f = a(c);
                                f.addClass("selected"), (!e || d) && i.scrollTo(f)
                            }
                        },
                        s = [],
                        t = function(b) {
                            if (9 == b.which) return void q.trigger("close");
                            if (40 == b.which && !i.is(":visible")) return void q.trigger("open");
                            if (13 != b.which || i.is(":visible")) {
                                b.preventDefault();
                                var c = String.fromCharCode(b.which).toLowerCase(),
                                    d = [9, 13, 27, 38, 40];
                                if (c && -1 === d.indexOf(b.which)) {
                                    s.push(c);
                                    var f = s.join(""),
                                        g = i.find("li").filter(function() {
                                            return 0 === a(this).text().toLowerCase().indexOf(f)
                                        })[0];
                                    g && r(i, g)
                                }
                                if (13 == b.which) {
                                    var h = i.find("li.selected:not(.disabled)")[0];
                                    h && (a(h).trigger("click"), e || q.trigger("close"))
                                }
                                40 == b.which && (g = i.find("li.selected").length ? i.find("li.selected").next("li:not(.disabled)")[0] : i.find("li:not(.disabled)")[0], r(i, g)), 27 == b.which && q.trigger("close"), 38 == b.which && (g = i.find("li.selected").prev("li:not(.disabled)")[0], g && r(i, g)), setTimeout(function() {
                                    s = []
                                }, 1e3)
                            }
                        };
                    q.on("keydown", t)
                }
            })
        }
    }(jQuery),
    function(a) {
        var b = {
            init: function(b) {
                var c = {
                    indicators: !0,
                    height: 400,
                    transition: 500,
                    interval: 6e3
                };
                return b = a.extend(c, b), this.each(function() {
                    function c(a, b) {
                        a.hasClass("center-align") ? a.velocity({
                            opacity: 0,
                            translateY: -100
                        }, {
                            duration: b,
                            queue: !1
                        }) : a.hasClass("right-align") ? a.velocity({
                            opacity: 0,
                            translateX: 100
                        }, {
                            duration: b,
                            queue: !1
                        }) : a.hasClass("left-align") && a.velocity({
                            opacity: 0,
                            translateX: -100
                        }, {
                            duration: b,
                            queue: !1
                        })
                    }

                    function d(a) {
                        a >= j.length ? a = 0 : 0 > a && (a = j.length - 1), k = i.find(".active").index(), k != a && (e = j.eq(k), $caption = e.find(".caption"), e.removeClass("active"), e.velocity({
                            opacity: 0
                        }, {
                            duration: b.transition,
                            queue: !1,
                            easing: "easeOutQuad",
                            complete: function() {
                                j.not(".active").velocity({
                                    opacity: 0,
                                    translateX: 0,
                                    translateY: 0
                                }, {
                                    duration: 0,
                                    queue: !1
                                })
                            }
                        }), c($caption, b.transition), b.indicators && f.eq(k).removeClass("active"), j.eq(a).velocity({
                            opacity: 1
                        }, {
                            duration: b.transition,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), j.eq(a).find(".caption").velocity({
                            opacity: 1,
                            translateX: 0,
                            translateY: 0
                        }, {
                            duration: b.transition,
                            delay: b.transition,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), j.eq(a).addClass("active"), b.indicators && f.eq(a).addClass("active"))
                    }
                    var e, f, g, h = a(this),
                        i = h.find("ul.slides").first(),
                        j = i.find("> li"),
                        k = i.find(".active").index(); - 1 != k && (e = j.eq(k)), h.hasClass("fullscreen") || (b.indicators ? h.height(b.height + 40) : h.height(b.height), i.height(b.height)), j.find(".caption").each(function() {
                        c(a(this), 0)
                    }), j.find("img").each(function() {
                        var b = "data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
                        a(this).attr("src") !== b && (a(this).css("background-image", 'url("' + a(this).attr("src") + '")'), a(this).attr("src", b))
                    }), b.indicators && (f = a('<ul class="indicators"></ul>'), j.each(function(c) {
                        var e = a('<li class="indicator-item"></li>');
                        e.click(function() {
                            var c = i.parent(),
                                e = c.find(a(this)).index();
                            d(e), clearInterval(g), g = setInterval(function() {
                                k = i.find(".active").index(), j.length == k + 1 ? k = 0 : k += 1, d(k)
                            }, b.transition + b.interval)
                        }), f.append(e)
                    }), h.append(f), f = h.find("ul.indicators").find("li.indicator-item")), e ? e.show() : (j.first().addClass("active").velocity({
                        opacity: 1
                    }, {
                        duration: b.transition,
                        queue: !1,
                        easing: "easeOutQuad"
                    }), k = 0, e = j.eq(k), b.indicators && f.eq(k).addClass("active")), e.find("img").each(function() {
                        e.find(".caption").velocity({
                            opacity: 1,
                            translateX: 0,
                            translateY: 0
                        }, {
                            duration: b.transition,
                            queue: !1,
                            easing: "easeOutQuad"
                        })
                    }), g = setInterval(function() {
                        k = i.find(".active").index(), d(k + 1)
                    }, b.transition + b.interval);
                    var l = !1,
                        m = !1,
                        n = !1;
                    h.hammer({
                        prevent_default: !1
                    }).on("pan", function(a) {
                        if ("touch" === a.gesture.pointerType) {
                            clearInterval(g);
                            var b = a.gesture.direction,
                                c = a.gesture.deltaX,
                                d = a.gesture.velocityX,
                                e = a.gesture.velocityY;
                            $curr_slide = i.find(".active"), Math.abs(d) > Math.abs(e) && $curr_slide.velocity({
                                translateX: c
                            }, {
                                duration: 50,
                                queue: !1,
                                easing: "easeOutQuad"
                            }), 4 === b && (c > h.innerWidth() / 2 || -.65 > d) ? n = !0 : 2 === b && (c < -1 * h.innerWidth() / 2 || d > .65) && (m = !0);
                            var f;
                            m && (f = $curr_slide.next(), 0 === f.length && (f = j.first()), f.velocity({
                                opacity: 1
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad"
                            })), n && (f = $curr_slide.prev(), 0 === f.length && (f = j.last()), f.velocity({
                                opacity: 1
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad"
                            }))
                        }
                    }).on("panend", function(a) {
                        "touch" === a.gesture.pointerType && ($curr_slide = i.find(".active"), l = !1, curr_index = i.find(".active").index(), !n && !m || j.length <= 1 ? $curr_slide.velocity({
                            translateX: 0
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad"
                        }) : m ? (d(curr_index + 1), $curr_slide.velocity({
                            translateX: -1 * h.innerWidth()
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad",
                            complete: function() {
                                $curr_slide.velocity({
                                    opacity: 0,
                                    translateX: 0
                                }, {
                                    duration: 0,
                                    queue: !1
                                })
                            }
                        })) : n && (d(curr_index - 1), $curr_slide.velocity({
                            translateX: h.innerWidth()
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad",
                            complete: function() {
                                $curr_slide.velocity({
                                    opacity: 0,
                                    translateX: 0
                                }, {
                                    duration: 0,
                                    queue: !1
                                })
                            }
                        })), m = !1, n = !1, clearInterval(g), g = setInterval(function() {
                            k = i.find(".active").index(), j.length == k + 1 ? k = 0 : k += 1, d(k)
                        }, b.transition + b.interval))
                    }), h.on("sliderPause", function() {
                        clearInterval(g)
                    }), h.on("sliderStart", function() {
                        clearInterval(g), g = setInterval(function() {
                            k = i.find(".active").index(), j.length == k + 1 ? k = 0 : k += 1, d(k)
                        }, b.transition + b.interval)
                    }), h.on("sliderNext", function() {
                        k = i.find(".active").index(), d(k + 1)
                    }), h.on("sliderPrev", function() {
                        k = i.find(".active").index(), d(k - 1)
                    })
                })
            },
            pause: function() {
                a(this).trigger("sliderPause")
            },
            start: function() {
                a(this).trigger("sliderStart")
            },
            next: function() {
                a(this).trigger("sliderNext")
            },
            prev: function() {
                a(this).trigger("sliderPrev")
            }
        };
        a.fn.slider = function(c) {
            return b[c] ? b[c].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof c && c ? void a.error("Method " + c + " does not exist on jQuery.tooltip") : b.init.apply(this, arguments)
        }
    }(jQuery),
    function(a) {
        a(document).ready(function() {
            a(document).on("click.card", ".card", function(b) {
                if (a(this).find("> .card-reveal").length) {
                    var c = a(b.target).closest(".card");
                    void 0 === c.data("initialOverflow") && c.data("initialOverflow", void 0 === c.css("overflow") ? "" : c.css("overflow")), a(b.target).is(a(".card-reveal .card-title")) || a(b.target).is(a(".card-reveal .card-title i")) ? a(this).find(".card-reveal").velocity({
                        translateY: 0
                    }, {
                        duration: 225,
                        queue: !1,
                        easing: "easeInOutQuad",
                        complete: function() {
                            a(this).css({
                                display: "none"
                            }), c.css("overflow", c.data("initialOverflow"))
                        }
                    }) : (a(b.target).is(a(".card .activator")) || a(b.target).is(a(".card .activator i"))) && (c.css("overflow", "hidden"), a(this).find(".card-reveal").css({
                        display: "block"
                    }).velocity("stop", !1).velocity({
                        translateY: "-100%"
                    }, {
                        duration: 300,
                        queue: !1,
                        easing: "easeInOutQuad"
                    }))
                }
            })
        })
    }(jQuery),
    function(a) {
        var b = {
            data: [],
            placeholder: "",
            secondaryPlaceholder: "",
            autocompleteOptions: {}
        };
        a(document).ready(function() {
            a(document).on("click", ".chip .close", function(b) {
                var c = a(this).closest(".chips");
                c.attr("data-initialized") || a(this).closest(".chip").remove()
            })
        }), a.fn.material_chip = function(c) {
            var d = this;
            if (this.$el = a(this), this.$document = a(document), this.SELS = {
                    CHIPS: ".chips",
                    CHIP: ".chip",
                    INPUT: "input",
                    DELETE: ".material-icons",
                    SELECTED_CHIP: ".selected"
                }, "data" === c) return this.$el.data("chips");
            var e = a.extend({}, b, c);
            d.hasAutocomplete = !a.isEmptyObject(e.autocompleteOptions.data), this.init = function() {
                var b = 0;
                d.$el.each(function() {
                    var c = a(this),
                        f = Materialize.guid();
                    d.chipId = f, e.data && e.data instanceof Array || (e.data = []), c.data("chips", e.data), c.attr("data-index", b), c.attr("data-initialized", !0), c.hasClass(d.SELS.CHIPS) || c.addClass("chips"), d.chips(c, f), b++
                })
            }, this.handleEvents = function() {
                var b = d.SELS;
                d.$document.off("click.chips-focus", b.CHIPS).on("click.chips-focus", b.CHIPS, function(c) {
                    a(c.target).find(b.INPUT).focus()
                }), d.$document.off("click.chips-select", b.CHIP).on("click.chips-select", b.CHIP, function(c) {
                    var e = a(c.target);
                    if (e.length) {
                        var f = e.hasClass("selected"),
                            g = e.closest(b.CHIPS);
                        a(b.CHIP).removeClass("selected"), f || d.selectChip(e.index(), g)
                    }
                }), d.$document.off("keydown.chips").on("keydown.chips", function(c) {
                    if (!a(c.target).is("input, textarea")) {
                        var e, f = d.$document.find(b.CHIP + b.SELECTED_CHIP),
                            g = f.closest(b.CHIPS),
                            h = f.siblings(b.CHIP).length;
                        if (f.length)
                            if (8 === c.which || 46 === c.which) {
                                c.preventDefault(), e = f.index(), d.deleteChip(e, g);
                                var i = null;
                                h > e + 1 ? i = e : (e === h || e + 1 === h) && (i = h - 1), 0 > i && (i = null), null !== i && d.selectChip(i, g), h || g.find("input").focus()
                            } else if (37 === c.which) {
                            if (e = f.index() - 1, 0 > e) return;
                            a(b.CHIP).removeClass("selected"), d.selectChip(e, g)
                        } else if (39 === c.which) {
                            if (e = f.index() + 1, a(b.CHIP).removeClass("selected"), e > h) return void g.find("input").focus();
                            d.selectChip(e, g)
                        }
                    }
                }), d.$document.off("focusin.chips", b.CHIPS + " " + b.INPUT).on("focusin.chips", b.CHIPS + " " + b.INPUT, function(c) {
                    var d = a(c.target).closest(b.CHIPS);
                    d.addClass("focus"), d.siblings("label, .prefix").addClass("active"), a(b.CHIP).removeClass("selected")
                }), d.$document.off("focusout.chips", b.CHIPS + " " + b.INPUT).on("focusout.chips", b.CHIPS + " " + b.INPUT, function(c) {
                    var d = a(c.target).closest(b.CHIPS);
                    d.removeClass("focus"), void 0 !== d.data("chips") && d.data("chips").length || d.siblings("label").removeClass("active"), d.siblings(".prefix").removeClass("active")
                }), d.$document.off("keydown.chips-add", b.CHIPS + " " + b.INPUT).on("keydown.chips-add", b.CHIPS + " " + b.INPUT, function(c) {
                    var e = a(c.target),
                        f = e.closest(b.CHIPS),
                        g = f.children(b.CHIP).length;
                    if (13 === c.which) {
                        if (d.hasAutocomplete && f.find(".autocomplete-content.dropdown-content").length && f.find(".autocomplete-content.dropdown-content").children().length) return;
                        return c.preventDefault(), d.addChip({
                            tag: e.val()
                        }, f), void e.val("")
                    }
                    return 8 !== c.keyCode && 37 !== c.keyCode || "" !== e.val() || !g ? void 0 : (c.preventDefault(), d.selectChip(g - 1, f), void e.blur())
                }), d.$document.off("click.chips-delete", b.CHIPS + " " + b.DELETE).on("click.chips-delete", b.CHIPS + " " + b.DELETE, function(c) {
                    var e = a(c.target),
                        f = e.closest(b.CHIPS),
                        g = e.closest(b.CHIP);
                    c.stopPropagation(), d.deleteChip(g.index(), f), f.find("input").focus()
                })
            }, this.chips = function(b, c) {
                b.empty(), b.data("chips").forEach(function(a) {
                    b.append(d.renderChip(a))
                }), b.append(a('<input id="' + c + '" class="input" placeholder="">')), d.setPlaceholder(b);
                var f = b.next("label");
                f.length && (f.attr("for", c), void 0 !== b.data("chips") && b.data("chips").length && f.addClass("active"));
                var g = a("#" + c);
                d.hasAutocomplete && (e.autocompleteOptions.onAutocomplete = function(a) {
                    d.addChip({
                        tag: a
                    }, b), g.val(""), g.focus()
                }, g.autocomplete(e.autocompleteOptions))
            }, this.renderChip = function(b) {
                if (b.tag) {
                    var c = a('<div class="chip"></div>');
                    return c.text(b.tag), b.image && c.prepend(a("<img />").attr("src", b.image)), c.append(a('<i class="material-icons close">close</i>')), c
                }
            }, this.setPlaceholder = function(a) {
                void 0 !== a.data("chips") && !a.data("chips").length && e.placeholder ? a.find("input").prop("placeholder", e.placeholder) : (void 0 === a.data("chips") || a.data("chips").length) && e.secondaryPlaceholder && a.find("input").prop("placeholder", e.secondaryPlaceholder)
            }, this.isValid = function(a, b) {
                for (var c = a.data("chips"), d = !1, e = 0; e < c.length; e++)
                    if (c[e].tag === b.tag) return void(d = !0);
                return "" !== b.tag && !d
            }, this.addChip = function(a, b) {
                if (d.isValid(b, a)) {
                    for (var c = d.renderChip(a), e = [], f = b.data("chips"), g = 0; g < f.length; g++) e.push(f[g]);
                    e.push(a), b.data("chips", e), c.insertBefore(b.find("input")), b.trigger("chip.add", a), d.setPlaceholder(b)
                }
            }, this.deleteChip = function(a, b) {
                var c = b.data("chips")[a];
                b.find(".chip").eq(a).remove();
                for (var e = [], f = b.data("chips"), g = 0; g < f.length; g++) g !== a && e.push(f[g]);
                b.data("chips", e), b.trigger("chip.delete", c), d.setPlaceholder(b)
            }, this.selectChip = function(a, b) {
                var c = b.find(".chip").eq(a);
                c && !1 === c.hasClass("selected") && (c.addClass("selected"), b.trigger("chip.select", b.data("chips")[a]))
            }, this.getChipsElement = function(a, b) {
                return b.eq(a)
            }, this.init(), this.handleEvents()
        }
    }(jQuery),
    function(a) {
        a.fn.pushpin = function(b) {
            var c = {
                top: 0,
                bottom: 1 / 0,
                offset: 0
            };
            return "remove" === b ? (this.each(function() {
                (id = a(this).data("pushpin-id")) && (a(window).off("scroll." + id), a(this).removeData("pushpin-id").removeClass("pin-top pinned pin-bottom").removeAttr("style"))
            }), !1) : (b = a.extend(c, b), $index = 0, this.each(function() {
                function c(a) {
                    a.removeClass("pin-top"), a.removeClass("pinned"), a.removeClass("pin-bottom")
                }

                function d(d, e) {
                    d.each(function() {
                        b.top <= e && b.bottom >= e && !a(this).hasClass("pinned") && (c(a(this)), a(this).css("top", b.offset), a(this).addClass("pinned")), e < b.top && !a(this).hasClass("pin-top") && (c(a(this)), a(this).css("top", 0), a(this).addClass("pin-top")), e > b.bottom && !a(this).hasClass("pin-bottom") && (c(a(this)), a(this).addClass("pin-bottom"), a(this).css("top", b.bottom - g))
                    })
                }
                var e = Materialize.guid(),
                    f = a(this),
                    g = a(this).offset().top;
                a(this).data("pushpin-id", e), d(f, a(window).scrollTop()), a(window).on("scroll." + e, function() {
                    var c = a(window).scrollTop() + b.offset;
                    d(f, c)
                })
            }))
        }
    }(jQuery),
    function(a) {
        a(document).ready(function() {
            a.fn.reverse = [].reverse, a(document).on("mouseenter.fixedActionBtn", ".fixed-action-btn:not(.click-to-toggle):not(.toolbar)", function(c) {
                var d = a(this);
                b(d)
            }), a(document).on("mouseleave.fixedActionBtn", ".fixed-action-btn:not(.click-to-toggle):not(.toolbar)", function(b) {
                var d = a(this);
                c(d)
            }), a(document).on("click.fabClickToggle", ".fixed-action-btn.click-to-toggle > a", function(d) {
                var e = a(this),
                    f = e.parent();
                f.hasClass("active") ? c(f) : b(f)
            }), a(document).on("click.fabToolbar", ".fixed-action-btn.toolbar > a", function(b) {
                var c = a(this),
                    e = c.parent();
                d(e)
            })
        }), a.fn.extend({
            openFAB: function() {
                b(a(this))
            },
            closeFAB: function() {
                c(a(this))
            },
            openToolbar: function() {
                d(a(this))
            },
            closeToolbar: function() {
                e(a(this))
            }
        });
        var b = function(b) {
                var c = b;
                if (c.hasClass("active") === !1) {
                    var d, e, f = c.hasClass("horizontal");
                    f === !0 ? e = 40 : d = 40, c.addClass("active"), c.find("ul .btn-floating").velocity({
                        scaleY: ".4",
                        scaleX: ".4",
                        translateY: d + "px",
                        translateX: e + "px"
                    }, {
                        duration: 0
                    });
                    var g = 0;
                    c.find("ul .btn-floating").reverse().each(function() {
                        a(this).velocity({
                            opacity: "1",
                            scaleX: "1",
                            scaleY: "1",
                            translateY: "0",
                            translateX: "0"
                        }, {
                            duration: 80,
                            delay: g
                        }), g += 40
                    })
                }
            },
            c = function(a) {
                var b, c, d = a,
                    e = d.hasClass("horizontal");
                e === !0 ? c = 40 : b = 40, d.removeClass("active");
                d.find("ul .btn-floating").velocity("stop", !0), d.find("ul .btn-floating").velocity({
                    opacity: "0",
                    scaleX: ".4",
                    scaleY: ".4",
                    translateY: b + "px",
                    translateX: c + "px"
                }, {
                    duration: 80
                })
            },
            d = function(b) {
                if ("true" !== b.attr("data-open")) {
                    var c, d, f, g = window.innerWidth,
                        h = window.innerHeight,
                        i = b[0].getBoundingClientRect(),
                        j = b.find("> a").first(),
                        k = b.find("> ul").first(),
                        l = a('<div class="fab-backdrop"></div>'),
                        m = j.css("background-color");
                    j.append(l), c = i.left - g / 2 + i.width / 2, d = h - i.bottom, f = g / l.width(), b.attr("data-origin-bottom", i.bottom), b.attr("data-origin-left", i.left), b.attr("data-origin-width", i.width), b.addClass("active"), b.attr("data-open", !0), b.css({
                        "text-align": "center",
                        width: "100%",
                        bottom: 0,
                        left: 0,
                        transform: "translateX(" + c + "px)",
                        transition: "none"
                    }), j.css({
                        transform: "translateY(" + -d + "px)",
                        transition: "none"
                    }), l.css({
                        "background-color": m
                    }), setTimeout(function() {
                        b.css({
                            transform: "",
                            transition: "transform .2s cubic-bezier(0.550, 0.085, 0.680, 0.530), background-color 0s linear .2s"
                        }), j.css({
                            overflow: "visible",
                            transform: "",
                            transition: "transform .2s"
                        }), setTimeout(function() {
                            b.css({
                                overflow: "hidden",
                                "background-color": m
                            }), l.css({
                                transform: "scale(" + f + ")",
                                transition: "transform .2s cubic-bezier(0.550, 0.055, 0.675, 0.190)"
                            }), k.find("> li > a").css({
                                opacity: 1
                            }), a(window).on("scroll.fabToolbarClose", function() {
                                e(b), a(window).off("scroll.fabToolbarClose"), a(document).off("click.fabToolbarClose")
                            }), a(document).on("click.fabToolbarClose", function(c) {
                                a(c.target).closest(k).length || (e(b), a(window).off("scroll.fabToolbarClose"), a(document).off("click.fabToolbarClose"))
                            })
                        }, 100)
                    }, 0)
                }
            },
            e = function(a) {
                if ("true" === a.attr("data-open")) {
                    var b, c, d, e = window.innerWidth,
                        f = window.innerHeight,
                        g = a.attr("data-origin-width"),
                        h = a.attr("data-origin-bottom"),
                        i = a.attr("data-origin-left"),
                        j = a.find("> .btn-floating").first(),
                        k = a.find("> ul").first(),
                        l = a.find(".fab-backdrop"),
                        m = j.css("background-color");
                    b = i - e / 2 + g / 2, c = f - h, d = e / l.width(), a.removeClass("active"), a.attr("data-open", !1), a.css({
                        "background-color": "transparent",
                        transition: "none"
                    }), j.css({
                        transition: "none"
                    }), l.css({
                        transform: "scale(0)",
                        "background-color": m
                    }), k.find("> li > a").css({
                        opacity: ""
                    }), setTimeout(function() {
                        l.remove(), a.css({
                            "text-align": "",
                            width: "",
                            bottom: "",
                            left: "",
                            overflow: "",
                            "background-color": "",
                            transform: "translate3d(" + -b + "px,0,0)"
                        }), j.css({
                            overflow: "",
                            transform: "translate3d(0," + c + "px,0)"
                        }), setTimeout(function() {
                            a.css({
                                transform: "translate3d(0,0,0)",
                                transition: "transform .2s"
                            }), j.css({
                                transform: "translate3d(0,0,0)",
                                transition: "transform .2s cubic-bezier(0.550, 0.055, 0.675, 0.190)"
                            })
                        }, 20)
                    }, 200)
                }
            }
    }(jQuery),
    function(a) {
        Materialize.fadeInImage = function(b) {
            var c;
            if ("string" == typeof b) c = a(b);
            else {
                if ("object" != typeof b) return;
                c = b
            }
            c.css({
                opacity: 0
            }), a(c).velocity({
                opacity: 1
            }, {
                duration: 650,
                queue: !1,
                easing: "easeOutSine"
            }), a(c).velocity({
                opacity: 1
            }, {
                duration: 1300,
                queue: !1,
                easing: "swing",
                step: function(b, c) {
                    c.start = 100;
                    var d = b / 100,
                        e = 150 - (100 - b) / 1.75;
                    100 > e && (e = 100), b >= 0 && a(this).css({
                        "-webkit-filter": "grayscale(" + d + ")brightness(" + e + "%)",
                        filter: "grayscale(" + d + ")brightness(" + e + "%)"
                    })
                }
            })
        }, Materialize.showStaggeredList = function(b) {
            var c;
            if ("string" == typeof b) c = a(b);
            else {
                if ("object" != typeof b) return;
                c = b
            }
            var d = 0;
            c.find("li").velocity({
                translateX: "-100px"
            }, {
                duration: 0
            }), c.find("li").each(function() {
                a(this).velocity({
                    opacity: "1",
                    translateX: "0"
                }, {
                    duration: 800,
                    delay: d,
                    easing: [60, 10]
                }), d += 120
            })
        }, a(document).ready(function() {
            var b = !1,
                c = !1;
            a(".dismissable").each(function() {
                a(this).hammer({
                    prevent_default: !1
                }).on("pan", function(d) {
                    if ("touch" === d.gesture.pointerType) {
                        var e = a(this),
                            f = d.gesture.direction,
                            g = d.gesture.deltaX,
                            h = d.gesture.velocityX;
                        e.velocity({
                            translateX: g
                        }, {
                            duration: 50,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), 4 === f && (g > e.innerWidth() / 2 || -.75 > h) && (b = !0), 2 === f && (g < -1 * e.innerWidth() / 2 || h > .75) && (c = !0)
                    }
                }).on("panend", function(d) {
                    if (Math.abs(d.gesture.deltaX) < a(this).innerWidth() / 2 && (c = !1, b = !1), "touch" === d.gesture.pointerType) {
                        var e = a(this);
                        if (b || c) {
                            var f;
                            f = b ? e.innerWidth() : -1 * e.innerWidth(), e.velocity({
                                translateX: f
                            }, {
                                duration: 100,
                                queue: !1,
                                easing: "easeOutQuad",
                                complete: function() {
                                    e.css("border", "none"), e.velocity({
                                        height: 0,
                                        padding: 0
                                    }, {
                                        duration: 200,
                                        queue: !1,
                                        easing: "easeOutQuad",
                                        complete: function() {
                                            e.remove()
                                        }
                                    })
                                }
                            })
                        } else e.velocity({
                            translateX: 0
                        }, {
                            duration: 100,
                            queue: !1,
                            easing: "easeOutQuad"
                        });
                        b = !1, c = !1
                    }
                })
            })
        })
    }(jQuery),
    function(a) {
        var b = !1;
        Materialize.scrollFire = function(a) {
            var c = function() {
                    for (var b = window.pageYOffset + window.innerHeight, c = 0; c < a.length; c++) {
                        var d = a[c],
                            e = d.selector,
                            f = d.offset,
                            g = d.callback,
                            h = document.querySelector(e);
                        if (null !== h) {
                            var i = h.getBoundingClientRect().top + window.pageYOffset;
                            if (b > i + f && d.done !== !0) {
                                if ("function" == typeof g) g.call(this, h);
                                else if ("string" == typeof g) {
                                    var j = new Function(g);
                                    j(h)
                                }
                                d.done = !0
                            }
                        }
                    }
                },
                d = Materialize.throttle(function() {
                    c()
                }, a.throttle || 100);
            b || (window.addEventListener("scroll", d), window.addEventListener("resize", d), b = !0), setTimeout(d, 0)
        }
    }(jQuery),
    function(a) {
        Materialize.Picker = a(jQuery)
    }(function(a) {
        function b(f, g, i, l) {
            function m() {
                return b._.node("div", b._.node("div", b._.node("div", b._.node("div", y.component.nodes(t.open), v.box), v.wrap), v.frame), v.holder)
            }

            function n() {
                w.data(g, y).addClass(v.input).attr("tabindex", -1).val(w.data("value") ? y.get("select", u.format) : f.value), u.editable || w.on("focus." + t.id + " click." + t.id, function(a) {
                    a.preventDefault(), y.$root.eq(0).focus()
                }).on("keydown." + t.id, q), e(f, {
                    haspopup: !0,
                    expanded: !1,
                    readonly: !1,
                    owns: f.id + "_root"
                })
            }

            function o() {
                y.$root.on({
                    keydown: q,
                    focusin: function(a) {
                        y.$root.removeClass(v.focused), a.stopPropagation()
                    },
                    "mousedown click": function(b) {
                        var c = b.target;
                        c != y.$root.children()[0] && (b.stopPropagation(), "mousedown" != b.type || a(c).is("input, select, textarea, button, option") || (b.preventDefault(), y.$root.eq(0).focus()))
                    }
                }).on({
                    focus: function() {
                        w.addClass(v.target)
                    },
                    blur: function() {
                        w.removeClass(v.target)
                    }
                }).on("focus.toOpen", r).on("click", "[data-pick], [data-nav], [data-clear], [data-close]", function() {
                    var b = a(this),
                        c = b.data(),
                        d = b.hasClass(v.navDisabled) || b.hasClass(v.disabled),
                        e = h();
                    e = e && (e.type || e.href) && e, (d || e && !a.contains(y.$root[0], e)) && y.$root.eq(0).focus(), !d && c.nav ? y.set("highlight", y.component.item.highlight, {
                        nav: c.nav
                    }) : !d && "pick" in c ? (y.set("select", c.pick), u.closeOnSelect && y.close(!0)) : c.clear ? (y.clear(), u.closeOnSelect && y.close(!0)) : c.close && y.close(!0)
                }), e(y.$root[0], "hidden", !0)
            }

            function p() {
                var b;
                u.hiddenName === !0 ? (b = f.name, f.name = "") : (b = ["string" == typeof u.hiddenPrefix ? u.hiddenPrefix : "", "string" == typeof u.hiddenSuffix ? u.hiddenSuffix : "_submit"], b = b[0] + f.name + b[1]), y._hidden = a('<input type=hidden name="' + b + '"' + (w.data("value") || f.value ? ' value="' + y.get("select", u.formatSubmit) + '"' : "") + ">")[0], w.on("change." + t.id, function() {
                    y._hidden.value = f.value ? y.get("select", u.formatSubmit) : ""
                }), u.container ? a(u.container).append(y._hidden) : w.before(y._hidden)
            }

            function q(a) {
                var b = a.keyCode,
                    c = /^(8|46)$/.test(b);
                return 27 == b ? (y.close(), !1) : void((32 == b || c || !t.open && y.component.key[b]) && (a.preventDefault(), a.stopPropagation(), c ? y.clear().close() : y.open()))
            }

            function r(a) {
                a.stopPropagation(), "focus" == a.type && y.$root.addClass(v.focused), y.open()
            }
            if (!f) return b;
            var s = !1,
                t = {
                    id: f.id || "P" + Math.abs(~~(Math.random() * new Date))
                },
                u = i ? a.extend(!0, {}, i.defaults, l) : l || {},
                v = a.extend({}, b.klasses(), u.klass),
                w = a(f),
                x = function() {
                    return this.start()
                },
                y = x.prototype = {
                    constructor: x,
                    $node: w,
                    start: function() {
                        return t && t.start ? y : (t.methods = {}, t.start = !0, t.open = !1, t.type = f.type, f.autofocus = f == h(), f.readOnly = !u.editable, f.id = f.id || t.id, "text" != f.type && (f.type = "text"), y.component = new i(y, u), y.$root = a(b._.node("div", m(), v.picker, 'id="' + f.id + '_root" tabindex="0"')), o(), u.formatSubmit && p(), n(), u.container ? a(u.container).append(y.$root) : w.before(y.$root), y.on({
                            start: y.component.onStart,
                            render: y.component.onRender,
                            stop: y.component.onStop,
                            open: y.component.onOpen,
                            close: y.component.onClose,
                            set: y.component.onSet
                        }).on({
                            start: u.onStart,
                            render: u.onRender,
                            stop: u.onStop,
                            open: u.onOpen,
                            close: u.onClose,
                            set: u.onSet
                        }), s = c(y.$root.children()[0]), f.autofocus && y.open(), y.trigger("start").trigger("render"))
                    },
                    render: function(a) {
                        return a ? y.$root.html(m()) : y.$root.find("." + v.box).html(y.component.nodes(t.open)), y.trigger("render")
                    },
                    stop: function() {
                        return t.start ? (y.close(), y._hidden && y._hidden.parentNode.removeChild(y._hidden), y.$root.remove(), w.removeClass(v.input).removeData(g), setTimeout(function() {
                            w.off("." + t.id)
                        }, 0), f.type = t.type, f.readOnly = !1, y.trigger("stop"), t.methods = {}, t.start = !1, y) : y
                    },
                    open: function(c) {
                        return t.open ? y : (w.addClass(v.active), e(f, "expanded", !0), setTimeout(function() {
                            y.$root.addClass(v.opened), e(y.$root[0], "hidden", !1)
                        }, 0), c !== !1 && (t.open = !0, s && k.css("overflow", "hidden").css("padding-right", "+=" + d()), y.$root.eq(0).focus(), j.on("click." + t.id + " focusin." + t.id, function(a) {
                            var b = a.target;
                            b != f && b != document && 3 != a.which && y.close(b === y.$root.children()[0])
                        }).on("keydown." + t.id, function(c) {
                            var d = c.keyCode,
                                e = y.component.key[d],
                                f = c.target;
                            27 == d ? y.close(!0) : f != y.$root[0] || !e && 13 != d ? a.contains(y.$root[0], f) && 13 == d && (c.preventDefault(), f.click()) : (c.preventDefault(), e ? b._.trigger(y.component.key.go, y, [b._.trigger(e)]) : y.$root.find("." + v.highlighted).hasClass(v.disabled) || (y.set("select", y.component.item.highlight), u.closeOnSelect && y.close(!0)))
                        })), y.trigger("open"))
                    },
                    close: function(a) {
                        return a && (y.$root.off("focus.toOpen").eq(0).focus(), setTimeout(function() {
                            y.$root.on("focus.toOpen", r)
                        }, 0)), w.removeClass(v.active), e(f, "expanded", !1), setTimeout(function() {
                            y.$root.removeClass(v.opened + " " + v.focused), e(y.$root[0], "hidden", !0)
                        }, 0), t.open ? (t.open = !1, s && k.css("overflow", "").css("padding-right", "-=" + d()), j.off("." + t.id), y.trigger("close")) : y
                    },
                    clear: function(a) {
                        return y.set("clear", null, a)
                    },
                    set: function(b, c, d) {
                        var e, f, g = a.isPlainObject(b),
                            h = g ? b : {};
                        if (d = g && a.isPlainObject(c) ? c : d || {}, b) {
                            g || (h[b] = c);
                            for (e in h) f = h[e], e in y.component.item && (void 0 === f && (f = null), y.component.set(e, f, d)), ("select" == e || "clear" == e) && w.val("clear" == e ? "" : y.get(e, u.format)).trigger("change");
                            y.render()
                        }
                        return d.muted ? y : y.trigger("set", h)
                    },
                    get: function(a, c) {
                        if (a = a || "value", null != t[a]) return t[a];
                        if ("valueSubmit" == a) {
                            if (y._hidden) return y._hidden.value;
                            a = "value"
                        }
                        if ("value" == a) return f.value;
                        if (a in y.component.item) {
                            if ("string" == typeof c) {
                                var d = y.component.get(a);
                                return d ? b._.trigger(y.component.formats.toString, y.component, [c, d]) : ""
                            }
                            return y.component.get(a)
                        }
                    },
                    on: function(b, c, d) {
                        var e, f, g = a.isPlainObject(b),
                            h = g ? b : {};
                        if (b) {
                            g || (h[b] = c);
                            for (e in h) f = h[e], d && (e = "_" + e), t.methods[e] = t.methods[e] || [], t.methods[e].push(f)
                        }
                        return y
                    },
                    off: function() {
                        var a, b, c = arguments;
                        for (a = 0, namesCount = c.length; a < namesCount; a += 1) b = c[a], b in t.methods && delete t.methods[b];
                        return y
                    },
                    trigger: function(a, c) {
                        var d = function(a) {
                            var d = t.methods[a];
                            d && d.map(function(a) {
                                b._.trigger(a, y, [c])
                            })
                        };
                        return d("_" + a), d(a), y
                    }
                };
            return new x
        }

        function c(a) {
            var b, c = "position";
            return a.currentStyle ? b = a.currentStyle[c] : window.getComputedStyle && (b = getComputedStyle(a)[c]), "fixed" == b
        }

        function d() {
            if (k.height() <= i.height()) return 0;
            var b = a('<div style="visibility:hidden;width:100px" />').appendTo("body"),
                c = b[0].offsetWidth;
            b.css("overflow", "scroll");
            var d = a('<div style="width:100%" />').appendTo(b),
                e = d[0].offsetWidth;
            return b.remove(), c - e
        }

        function e(b, c, d) {
            if (a.isPlainObject(c))
                for (var e in c) f(b, e, c[e]);
            else f(b, c, d)
        }

        function f(a, b, c) {
            a.setAttribute(("role" == b ? "" : "aria-") + b, c)
        }

        function g(b, c) {
            a.isPlainObject(b) || (b = {
                attribute: c
            }), c = "";
            for (var d in b) {
                var e = ("role" == d ? "" : "aria-") + d,
                    f = b[d];
                c += null == f ? "" : e + '="' + b[d] + '"'
            }
            return c
        }

        function h() {
            try {
                return document.activeElement
            } catch (a) {}
        }
        var i = a(window),
            j = a(document),
            k = a(document.documentElement);
        return b.klasses = function(a) {
            return a = a || "picker", {
                picker: a,
                opened: a + "--opened",
                focused: a + "--focused",
                input: a + "__input",
                active: a + "__input--active",
                target: a + "__input--target",
                holder: a + "__holder",
                frame: a + "__frame",
                wrap: a + "__wrap",
                box: a + "__box"
            }
        }, b._ = {
            group: function(a) {
                for (var c, d = "", e = b._.trigger(a.min, a); e <= b._.trigger(a.max, a, [e]); e += a.i) c = b._.trigger(a.item, a, [e]), d += b._.node(a.node, c[0], c[1], c[2]);
                return d
            },
            node: function(b, c, d, e) {
                return c ? (c = a.isArray(c) ? c.join("") : c, d = d ? ' class="' + d + '"' : "", e = e ? " " + e : "", "<" + b + d + e + ">" + c + "</" + b + ">") : ""
            },
            lead: function(a) {
                return (10 > a ? "0" : "") + a
            },
            trigger: function(a, b, c) {
                return "function" == typeof a ? a.apply(b, c || []) : a
            },
            digits: function(a) {
                return /\d/.test(a[1]) ? 2 : 1
            },
            isDate: function(a) {
                return {}.toString.call(a).indexOf("Date") > -1 && this.isInteger(a.getDate())
            },
            isInteger: function(a) {
                return {}.toString.call(a).indexOf("Number") > -1 && a % 1 === 0
            },
            ariaAttr: g
        }, b.extend = function(c, d) {
            a.fn[c] = function(e, f) {
                var g = this.data(c);
                return "picker" == e ? g : g && "string" == typeof e ? b._.trigger(g[e], g, [f]) : this.each(function() {
                    var f = a(this);
                    f.data(c) || new b(this, c, d, e)
                })
            }, a.fn[c].defaults = d.defaults
        }, b
    }),
    function(a) {
        a(Materialize.Picker, jQuery)
    }(function(a, b) {
        function c(a, b) {
            var c = this,
                d = a.$node[0],
                e = d.value,
                f = a.$node.data("value"),
                g = f || e,
                h = f ? b.formatSubmit : b.format,
                i = function() {
                    return d.currentStyle ? "rtl" == d.currentStyle.direction : "rtl" == getComputedStyle(a.$root[0]).direction
                };
            c.settings = b, c.$node = a.$node, c.queue = {
                min: "measure create",
                max: "measure create",
                now: "now create",
                select: "parse create validate",
                highlight: "parse navigate create validate",
                view: "parse create validate viewset",
                disable: "deactivate",
                enable: "activate"
            }, c.item = {}, c.item.clear = null, c.item.disable = (b.disable || []).slice(0), c.item.enable = - function(a) {
                return a[0] === !0 ? a.shift() : -1
            }(c.item.disable), c.set("min", b.min).set("max", b.max).set("now"), g ? c.set("select", g, {
                format: h
            }) : c.set("select", null).set("highlight", c.item.now), c.key = {
                40: 7,
                38: -7,
                39: function() {
                    return i() ? -1 : 1
                },
                37: function() {
                    return i() ? 1 : -1
                },
                go: function(a) {
                    var b = c.item.highlight,
                        d = new Date(b.year, b.month, b.date + a);
                    c.set("highlight", d, {
                        interval: a
                    }), this.render()
                }
            }, a.on("render", function() {
                a.$root.find("." + b.klass.selectMonth).on("change", function() {
                    var c = this.value;
                    c && (a.set("highlight", [a.get("view").year, c, a.get("highlight").date]), a.$root.find("." + b.klass.selectMonth).trigger("focus"))
                }), a.$root.find("." + b.klass.selectYear).on("change", function() {
                    var c = this.value;
                    c && (a.set("highlight", [c, a.get("view").month, a.get("highlight").date]), a.$root.find("." + b.klass.selectYear).trigger("focus"))
                })
            }, 1).on("open", function() {
                var d = "";
                c.disabled(c.get("now")) && (d = ":not(." + b.klass.buttonToday + ")"), a.$root.find("button" + d + ", select").attr("disabled", !1)
            }, 1).on("close", function() {
                a.$root.find("button, select").attr("disabled", !0)
            }, 1)
        }
        var d = 7,
            e = 6,
            f = a._;
        c.prototype.set = function(a, b, c) {
            var d = this,
                e = d.item;
            return null === b ? ("clear" == a && (a = "select"), e[a] = b, d) : (e["enable" == a ? "disable" : "flip" == a ? "enable" : a] = d.queue[a].split(" ").map(function(e) {
                return b = d[e](a, b, c)
            }).pop(), "select" == a ? d.set("highlight", e.select, c) : "highlight" == a ? d.set("view", e.highlight, c) : a.match(/^(flip|min|max|disable|enable)$/) && (e.select && d.disabled(e.select) && d.set("select", e.select, c), e.highlight && d.disabled(e.highlight) && d.set("highlight", e.highlight, c)), d)
        }, c.prototype.get = function(a) {
            return this.item[a]
        }, c.prototype.create = function(a, c, d) {
            var e, g = this;
            return c = void 0 === c ? a : c, c == -(1 / 0) || c == 1 / 0 ? e = c : b.isPlainObject(c) && f.isInteger(c.pick) ? c = c.obj : b.isArray(c) ? (c = new Date(c[0], c[1], c[2]), c = f.isDate(c) ? c : g.create().obj) : c = f.isInteger(c) || f.isDate(c) ? g.normalize(new Date(c), d) : g.now(a, c, d), {
                year: e || c.getFullYear(),
                month: e || c.getMonth(),
                date: e || c.getDate(),
                day: e || c.getDay(),
                obj: e || c,
                pick: e || c.getTime()
            }
        }, c.prototype.createRange = function(a, c) {
            var d = this,
                e = function(a) {
                    return a === !0 || b.isArray(a) || f.isDate(a) ? d.create(a) : a
                };
            return f.isInteger(a) || (a = e(a)), f.isInteger(c) || (c = e(c)), f.isInteger(a) && b.isPlainObject(c) ? a = [c.year, c.month, c.date + a] : f.isInteger(c) && b.isPlainObject(a) && (c = [a.year, a.month, a.date + c]), {
                from: e(a),
                to: e(c)
            }
        }, c.prototype.withinRange = function(a, b) {
            return a = this.createRange(a.from, a.to), b.pick >= a.from.pick && b.pick <= a.to.pick
        }, c.prototype.overlapRanges = function(a, b) {
            var c = this;
            return a = c.createRange(a.from, a.to), b = c.createRange(b.from, b.to), c.withinRange(a, b.from) || c.withinRange(a, b.to) || c.withinRange(b, a.from) || c.withinRange(b, a.to)
        }, c.prototype.now = function(a, b, c) {
            return b = new Date, c && c.rel && b.setDate(b.getDate() + c.rel), this.normalize(b, c)
        }, c.prototype.navigate = function(a, c, d) {
            var e, f, g, h, i = b.isArray(c),
                j = b.isPlainObject(c),
                k = this.item.view;
            if (i || j) {
                for (j ? (f = c.year, g = c.month, h = c.date) : (f = +c[0], g = +c[1], h = +c[2]), d && d.nav && k && k.month !== g && (f = k.year, g = k.month), e = new Date(f, g + (d && d.nav ? d.nav : 0), 1), f = e.getFullYear(), g = e.getMonth(); new Date(f, g, h).getMonth() !== g;) h -= 1;
                c = [f, g, h]
            }
            return c
        }, c.prototype.normalize = function(a) {
            return a.setHours(0, 0, 0, 0), a
        }, c.prototype.measure = function(a, b) {
            var c = this;
            return b ? "string" == typeof b ? b = c.parse(a, b) : f.isInteger(b) && (b = c.now(a, b, {
                rel: b
            })) : b = "min" == a ? -(1 / 0) : 1 / 0, b
        }, c.prototype.viewset = function(a, b) {
            return this.create([b.year, b.month, 1])
        }, c.prototype.validate = function(a, c, d) {
            var e, g, h, i, j = this,
                k = c,
                l = d && d.interval ? d.interval : 1,
                m = -1 === j.item.enable,
                n = j.item.min,
                o = j.item.max,
                p = m && j.item.disable.filter(function(a) {
                    if (b.isArray(a)) {
                        var d = j.create(a).pick;
                        d < c.pick ? e = !0 : d > c.pick && (g = !0)
                    }
                    return f.isInteger(a)
                }).length;
            if ((!d || !d.nav) && (!m && j.disabled(c) || m && j.disabled(c) && (p || e || g) || !m && (c.pick <= n.pick || c.pick >= o.pick)))
                for (m && !p && (!g && l > 0 || !e && 0 > l) && (l *= -1); j.disabled(c) && (Math.abs(l) > 1 && (c.month < k.month || c.month > k.month) && (c = k, l = l > 0 ? 1 : -1), c.pick <= n.pick ? (h = !0, l = 1, c = j.create([n.year, n.month, n.date + (c.pick === n.pick ? 0 : -1)])) : c.pick >= o.pick && (i = !0, l = -1, c = j.create([o.year, o.month, o.date + (c.pick === o.pick ? 0 : 1)])), !h || !i);) c = j.create([c.year, c.month, c.date + l]);
            return c
        }, c.prototype.disabled = function(a) {
            var c = this,
                d = c.item.disable.filter(function(d) {
                    return f.isInteger(d) ? a.day === (c.settings.firstDay ? d : d - 1) % 7 : b.isArray(d) || f.isDate(d) ? a.pick === c.create(d).pick : b.isPlainObject(d) ? c.withinRange(d, a) : void 0
                });
            return d = d.length && !d.filter(function(a) {
                return b.isArray(a) && "inverted" == a[3] || b.isPlainObject(a) && a.inverted
            }).length, -1 === c.item.enable ? !d : d || a.pick < c.item.min.pick || a.pick > c.item.max.pick
        }, c.prototype.parse = function(a, b, c) {
            var d = this,
                e = {};
            return b && "string" == typeof b ? (c && c.format || (c = c || {}, c.format = d.settings.format), d.formats.toArray(c.format).map(function(a) {
                var c = d.formats[a],
                    g = c ? f.trigger(c, d, [b, e]) : a.replace(/^!/, "").length;
                c && (e[a] = b.substr(0, g)), b = b.substr(g)
            }), [e.yyyy || e.yy, +(e.mm || e.m) - 1, e.dd || e.d]) : b
        }, c.prototype.formats = function() {
            function a(a, b, c) {
                var d = a.match(/\w+/)[0];
                return c.mm || c.m || (c.m = b.indexOf(d) + 1), d.length
            }

            function b(a) {
                return a.match(/\w+/)[0].length
            }
            return {
                d: function(a, b) {
                    return a ? f.digits(a) : b.date
                },
                dd: function(a, b) {
                    return a ? 2 : f.lead(b.date)
                },
                ddd: function(a, c) {
                    return a ? b(a) : this.settings.weekdaysShort[c.day]
                },
                dddd: function(a, c) {
                    return a ? b(a) : this.settings.weekdaysFull[c.day]
                },
                m: function(a, b) {
                    return a ? f.digits(a) : b.month + 1
                },
                mm: function(a, b) {
                    return a ? 2 : f.lead(b.month + 1)
                },
                mmm: function(b, c) {
                    var d = this.settings.monthsShort;
                    return b ? a(b, d, c) : d[c.month]
                },
                mmmm: function(b, c) {
                    var d = this.settings.monthsFull;
                    return b ? a(b, d, c) : d[c.month]
                },
                yy: function(a, b) {
                    return a ? 2 : ("" + b.year).slice(2)
                },
                yyyy: function(a, b) {
                    return a ? 4 : b.year
                },
                toArray: function(a) {
                    return a.split(/(d{1,4}|m{1,4}|y{4}|yy|!.)/g)
                },
                toString: function(a, b) {
                    var c = this;
                    return c.formats.toArray(a).map(function(a) {
                        return f.trigger(c.formats[a], c, [0, b]) || a.replace(/^!/, "")
                    }).join("")
                }
            }
        }(), c.prototype.isDateExact = function(a, c) {
            var d = this;
            return f.isInteger(a) && f.isInteger(c) || "boolean" == typeof a && "boolean" == typeof c ? a === c : (f.isDate(a) || b.isArray(a)) && (f.isDate(c) || b.isArray(c)) ? d.create(a).pick === d.create(c).pick : b.isPlainObject(a) && b.isPlainObject(c) ? d.isDateExact(a.from, c.from) && d.isDateExact(a.to, c.to) : !1
        }, c.prototype.isDateOverlap = function(a, c) {
            var d = this,
                e = d.settings.firstDay ? 1 : 0;
            return f.isInteger(a) && (f.isDate(c) || b.isArray(c)) ? (a = a % 7 + e, a === d.create(c).day + 1) : f.isInteger(c) && (f.isDate(a) || b.isArray(a)) ? (c = c % 7 + e, c === d.create(a).day + 1) : b.isPlainObject(a) && b.isPlainObject(c) ? d.overlapRanges(a, c) : !1
        }, c.prototype.flipEnable = function(a) {
            var b = this.item;
            b.enable = a || (-1 == b.enable ? 1 : -1)
        }, c.prototype.deactivate = function(a, c) {
            var d = this,
                e = d.item.disable.slice(0);
            return "flip" == c ? d.flipEnable() : c === !1 ? (d.flipEnable(1), e = []) : c === !0 ? (d.flipEnable(-1), e = []) : c.map(function(a) {
                for (var c, g = 0; g < e.length; g += 1)
                    if (d.isDateExact(a, e[g])) {
                        c = !0;
                        break
                    }
                c || (f.isInteger(a) || f.isDate(a) || b.isArray(a) || b.isPlainObject(a) && a.from && a.to) && e.push(a)
            }), e
        }, c.prototype.activate = function(a, c) {
            var d = this,
                e = d.item.disable,
                g = e.length;
            return "flip" == c ? d.flipEnable() : c === !0 ? (d.flipEnable(1), e = []) : c === !1 ? (d.flipEnable(-1), e = []) : c.map(function(a) {
                var c, h, i, j;
                for (i = 0; g > i; i += 1) {
                    if (h = e[i], d.isDateExact(h, a)) {
                        c = e[i] = null, j = !0;
                        break
                    }
                    if (d.isDateOverlap(h, a)) {
                        b.isPlainObject(a) ? (a.inverted = !0, c = a) : b.isArray(a) ? (c = a, c[3] || c.push("inverted")) : f.isDate(a) && (c = [a.getFullYear(), a.getMonth(), a.getDate(), "inverted"]);
                        break
                    }
                }
                if (c)
                    for (i = 0; g > i; i += 1)
                        if (d.isDateExact(e[i], a)) {
                            e[i] = null;
                            break
                        }
                if (j)
                    for (i = 0; g > i; i += 1)
                        if (d.isDateOverlap(e[i], a)) {
                            e[i] = null;
                            break
                        }
                c && e.push(c)
            }), e.filter(function(a) {
                return null != a
            })
        }, c.prototype.nodes = function(a) {
            var b = this,
                c = b.settings,
                g = b.item,
                h = g.now,
                i = g.select,
                j = g.highlight,
                k = g.view,
                l = g.disable,
                m = g.min,
                n = g.max,
                o = function(a, b) {
                    return c.firstDay && (a.push(a.shift()), b.push(b.shift())), f.node("thead", f.node("tr", f.group({
                        min: 0,
                        max: d - 1,
                        i: 1,
                        node: "th",
                        item: function(d) {
                            return [a[d], c.klass.weekdays, 'scope=col title="' + b[d] + '"']
                        }
                    })))
                }((c.showWeekdaysFull ? c.weekdaysFull : c.weekdaysLetter).slice(0), c.weekdaysFull.slice(0)),
                p = function(a) {
                    return f.node("div", " ", c.klass["nav" + (a ? "Next" : "Prev")] + (a && k.year >= n.year && k.month >= n.month || !a && k.year <= m.year && k.month <= m.month ? " " + c.klass.navDisabled : ""), "data-nav=" + (a || -1) + " " + f.ariaAttr({
                        role: "button",
                        controls: b.$node[0].id + "_table"
                    }) + ' title="' + (a ? c.labelMonthNext : c.labelMonthPrev) + '"')
                },
                q = function(d) {
                    var e = c.showMonthsShort ? c.monthsShort : c.monthsFull;
                    return "short_months" == d && (e = c.monthsShort), c.selectMonths && void 0 == d ? f.node("select", f.group({
                        min: 0,
                        max: 11,
                        i: 1,
                        node: "option",
                        item: function(a) {
                            return [e[a], 0, "value=" + a + (k.month == a ? " selected" : "") + (k.year == m.year && a < m.month || k.year == n.year && a > n.month ? " disabled" : "")]
                        }
                    }), c.klass.selectMonth + " browser-default", (a ? "" : "disabled") + " " + f.ariaAttr({
                        controls: b.$node[0].id + "_table"
                    }) + ' title="' + c.labelMonthSelect + '"') : "short_months" == d ? null != i ? e[i.month] : e[k.month] : f.node("div", e[k.month], c.klass.month)
                },
                r = function(d) {
                    var e = k.year,
                        g = c.selectYears === !0 ? 5 : ~~(c.selectYears / 2);
                    if (g) {
                        var h = m.year,
                            j = n.year,
                            l = e - g,
                            o = e + g;
                        if (h > l && (o += h - l, l = h), o > j) {
                            var p = l - h,
                                q = o - j;
                            l -= p > q ? q : p, o = j
                        }
                        if (c.selectYears && void 0 == d) return f.node("select", f.group({
                            min: l,
                            max: o,
                            i: 1,
                            node: "option",
                            item: function(a) {
                                return [a, 0, "value=" + a + (e == a ? " selected" : "")]
                            }
                        }), c.klass.selectYear + " browser-default", (a ? "" : "disabled") + " " + f.ariaAttr({
                            controls: b.$node[0].id + "_table"
                        }) + ' title="' + c.labelYearSelect + '"')
                    }
                    return "raw" === d && null != i ? f.node("div", i.year) : f.node("div", e, c.klass.year)
                };
            return createDayLabel = function() {
                return null != i ? i.date : h.date
            }, createWeekdayLabel = function() {
                var a;
                a = null != i ? i.day : h.day;
                var b = c.weekdaysShort[a];
                return b
            }, f.node("div", f.node("div", r("raw"), c.klass.year_display) + f.node("span", createWeekdayLabel() + ", ", "picker__weekday-display") + f.node("span", q("short_months") + " ", c.klass.month_display) + f.node("span", createDayLabel(), c.klass.day_display), c.klass.date_display) + f.node("div", f.node("div", f.node("div", (c.selectYears ? q() + r() : q() + r()) + p() + p(1), c.klass.header) + f.node("table", o + f.node("tbody", f.group({
                min: 0,
                max: e - 1,
                i: 1,
                node: "tr",
                item: function(a) {
                    var e = c.firstDay && 0 === b.create([k.year, k.month, 1]).day ? -7 : 0;
                    return [f.group({
                        min: d * a - k.day + e + 1,
                        max: function() {
                            return this.min + d - 1
                        },
                        i: 1,
                        node: "td",
                        item: function(a) {
                            a = b.create([k.year, k.month, a + (c.firstDay ? 1 : 0)]);
                            var d = i && i.pick == a.pick,
                                e = j && j.pick == a.pick,
                                g = l && b.disabled(a) || a.pick < m.pick || a.pick > n.pick,
                                o = f.trigger(b.formats.toString, b, [c.format, a]);
                            return [f.node("div", a.date, function(b) {
                                return b.push(k.month == a.month ? c.klass.infocus : c.klass.outfocus), h.pick == a.pick && b.push(c.klass.now), d && b.push(c.klass.selected), e && b.push(c.klass.highlighted), g && b.push(c.klass.disabled), b.join(" ")
                            }([c.klass.day]), "data-pick=" + a.pick + " " + f.ariaAttr({
                                role: "gridcell",
                                label: o,
                                selected: d && b.$node.val() === o ? !0 : null,
                                activedescendant: e ? !0 : null,
                                disabled: g ? !0 : null
                            }) + " " + (g ? "" : 'tabindex="0"')), "", f.ariaAttr({
                                role: "presentation"
                            })]
                        }
                    })]
                }
            })), c.klass.table, 'id="' + b.$node[0].id + '_table" ' + f.ariaAttr({
                role: "grid",
                controls: b.$node[0].id,
                readonly: !0
            })), c.klass.calendar_container) + f.node("div", f.node("button", c.today, "btn-flat picker__today waves-effect", "type=button data-pick=" + h.pick + (a && !b.disabled(h) ? "" : " disabled") + " " + f.ariaAttr({
                controls: b.$node[0].id
            })) + f.node("button", c.clear, "btn-flat picker__clear waves-effect", "type=button data-clear=1" + (a ? "" : " disabled") + " " + f.ariaAttr({
                controls: b.$node[0].id
            })) + f.node("button", c.close, "btn-flat picker__close waves-effect", "type=button data-close=true " + (a ? "" : " disabled") + " " + f.ariaAttr({
                controls: b.$node[0].id
            })), c.klass.footer), "picker__container__wrapper")
        }, c.defaults = function(a) {
            return {
                labelMonthNext: "Next month",
                labelMonthPrev: "Previous month",
                labelMonthSelect: "Select a month",
                labelYearSelect: "Select a year",
                monthsFull: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                weekdaysFull: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                weekdaysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                weekdaysLetter: ["S", "M", "T", "W", "T", "F", "S"],
                today: "Today",
                clear: "Clear",
                close: "Ok",
                closeOnSelect: !1,
                format: "d mmmm, yyyy",
                klass: {
                    table: a + "table",
                    header: a + "header",
                    date_display: a + "date-display",
                    day_display: a + "day-display",
                    month_display: a + "month-display",
                    year_display: a + "year-display",
                    calendar_container: a + "calendar-container",
                    navPrev: a + "nav--prev",
                    navNext: a + "nav--next",
                    navDisabled: a + "nav--disabled",
                    month: a + "month",
                    year: a + "year",
                    selectMonth: a + "select--month",
                    selectYear: a + "select--year",
                    weekdays: a + "weekday",
                    day: a + "day",
                    disabled: a + "day--disabled",
                    selected: a + "day--selected",
                    highlighted: a + "day--highlighted",
                    now: a + "day--today",
                    infocus: a + "day--infocus",
                    outfocus: a + "day--outfocus",
                    footer: a + "footer",
                    buttonClear: a + "button--clear",
                    buttonToday: a + "button--today",
                    buttonClose: a + "button--close"
                }
            }
        }(a.klasses().picker + "__"), a.extend("pickadate", c)
    }),
    function(a) {
        function b(a) {
            return document.createElementNS(i, a)
        }

        function c(a) {
            return (10 > a ? "0" : "") + a
        }

        function d(a) {
            var b = ++q + "";
            return a ? a + b : b
        }

        function e(e, g) {
            function i(a, b) {
                var c = l.offset(),
                    d = /^touch/.test(a.type),
                    e = c.left + r,
                    f = c.top + r,
                    i = (d ? a.originalEvent.touches[0] : a).pageX - e,
                    j = (d ? a.originalEvent.touches[0] : a).pageY - f,
                    k = Math.sqrt(i * i + j * j),
                    m = !1;
                if (!b || !(s - u > k || k > s + u)) {
                    a.preventDefault();
                    var p = setTimeout(function() {
                        D.popover.addClass("clockpicker-moving")
                    }, 200);
                    D.setHand(i, j, !b, !0), h.off(n).on(n, function(a) {
                        a.preventDefault();
                        var b = /^touch/.test(a.type),
                            c = (b ? a.originalEvent.touches[0] : a).pageX - e,
                            d = (b ? a.originalEvent.touches[0] : a).pageY - f;
                        (m || c !== i || d !== j) && (m = !0, D.setHand(c, d, !1, !0))
                    }), h.off(o).on(o, function(a) {
                        h.off(o), a.preventDefault();
                        var c = /^touch/.test(a.type),
                            d = (c ? a.originalEvent.changedTouches[0] : a).pageX - e,
                            k = (c ? a.originalEvent.changedTouches[0] : a).pageY - f;
                        (b || m) && d === i && k === j && D.setHand(d, k), "hours" === D.currentView ? D.toggleView("minutes", w / 2) : g.autoclose && (D.minutesView.addClass("clockpicker-dial-out"), setTimeout(function() {
                            D.done()
                        }, w / 2)), l.prepend(K), clearTimeout(p), D.popover.removeClass("clockpicker-moving"), h.off(n)
                    })
                }
            }
            var k = a(x),
                l = k.find(".clockpicker-plate"),
                p = k.find(".picker__holder"),
                q = k.find(".clockpicker-hours"),
                y = k.find(".clockpicker-minutes"),
                z = k.find(".clockpicker-am-pm-block"),
                A = "INPUT" === e.prop("tagName"),
                B = A ? e : e.find("input"),
                C = a("label[for=" + B.attr("id") + "]"),
                D = this;
            this.id = d("cp"), this.element = e, this.holder = p, this.options = g, this.isAppended = !1, this.isShown = !1, this.currentView = "hours", this.isInput = A, this.input = B, this.label = C, this.popover = k, this.plate = l, this.hoursView = q, this.minutesView = y, this.amPmBlock = z, this.spanHours = k.find(".clockpicker-span-hours"), this.spanMinutes = k.find(".clockpicker-span-minutes"), this.spanAmPm = k.find(".clockpicker-span-am-pm"), this.footer = k.find(".picker__footer"), this.amOrPm = "PM", g.twelvehour && (g.ampmclickable ? (this.spanAmPm.empty(), a('<div id="click-am">AM</div>').on("click", function() {
                D.spanAmPm.children("#click-am").addClass("text-primary"), D.spanAmPm.children("#click-pm").removeClass("text-primary"), D.amOrPm = "AM"
            }).appendTo(this.spanAmPm), a('<div id="click-pm">PM</div>').on("click", function() {
                D.spanAmPm.children("#click-pm").addClass("text-primary"), D.spanAmPm.children("#click-am").removeClass("text-primary"), D.amOrPm = "PM"
            }).appendTo(this.spanAmPm)) : (this.spanAmPm.empty(), a('<div id="click-am">AM</div>').appendTo(this.spanAmPm), a('<div id="click-pm">PM</div>').appendTo(this.spanAmPm))), a('<button type="button" class="btn-flat picker__clear" tabindex="' + (g.twelvehour ? "3" : "1") + '">' + g.cleartext + "</button>").click(a.proxy(this.clear, this)).appendTo(this.footer), a('<button type="button" class="btn-flat picker__close" tabindex="' + (g.twelvehour ? "3" : "1") + '">' + g.canceltext + "</button>").click(a.proxy(this.hide, this)).appendTo(this.footer), a('<button type="button" class="btn-flat picker__close" tabindex="' + (g.twelvehour ? "3" : "1") + '">' + g.donetext + "</button>").click(a.proxy(this.done, this)).appendTo(this.footer), this.spanHours.click(a.proxy(this.toggleView, this, "hours")), this.spanMinutes.click(a.proxy(this.toggleView, this, "minutes")), B.on("focus.clockpicker click.clockpicker", a.proxy(this.show, this));
            var E, F, G, H, I = a('<div class="clockpicker-tick"></div>');
            if (g.twelvehour)
                for (E = 1; 13 > E; E += 1) F = I.clone(), G = E / 6 * Math.PI, H = s, F.css({
                    left: r + Math.sin(G) * H - u,
                    top: r - Math.cos(G) * H - u
                }), F.html(0 === E ? "00" : E), q.append(F), F.on(m, i);
            else
                for (E = 0; 24 > E; E += 1) {
                    F = I.clone(), G = E / 6 * Math.PI;
                    var J = E > 0 && 13 > E;
                    H = J ? t : s, F.css({
                        left: r + Math.sin(G) * H - u,
                        top: r - Math.cos(G) * H - u
                    }), F.html(0 === E ? "00" : E), q.append(F), F.on(m, i)
                }
            for (E = 0; 60 > E; E += 5) F = I.clone(), G = E / 30 * Math.PI, F.css({
                left: r + Math.sin(G) * s - u,
                top: r - Math.cos(G) * s - u
            }), F.html(c(E)), y.append(F), F.on(m, i);
            if (l.on(m, function(b) {
                    0 === a(b.target).closest(".clockpicker-tick").length && i(b, !0)
                }), j) {
                var K = k.find(".clockpicker-canvas"),
                    L = b("svg");
                L.setAttribute("class", "clockpicker-svg"), L.setAttribute("width", v), L.setAttribute("height", v);
                var M = b("g");
                M.setAttribute("transform", "translate(" + r + "," + r + ")");
                var N = b("circle");
                N.setAttribute("class", "clockpicker-canvas-bearing"), N.setAttribute("cx", 0), N.setAttribute("cy", 0), N.setAttribute("r", 4);
                var O = b("line");
                O.setAttribute("x1", 0), O.setAttribute("y1", 0);
                var P = b("circle");
                P.setAttribute("class", "clockpicker-canvas-bg"), P.setAttribute("r", u), M.appendChild(O), M.appendChild(P), M.appendChild(N), L.appendChild(M), K.append(L), this.hand = O, this.bg = P, this.bearing = N, this.g = M, this.canvas = K
            }
            f(this.options.init)
        }

        function f(a) {
            a && "function" == typeof a && a()
        }
        var g = a(window),
            h = a(document),
            i = "http://www.w3.org/2000/svg",
            j = "SVGAngle" in window && function() {
                var a, b = document.createElement("div");
                return b.innerHTML = "<svg/>", a = (b.firstChild && b.firstChild.namespaceURI) == i, b.innerHTML = "", a
            }(),
            k = function() {
                var a = document.createElement("div").style;
                return "transition" in a || "WebkitTransition" in a || "MozTransition" in a || "msTransition" in a || "OTransition" in a
            }(),
            l = "ontouchstart" in window,
            m = "mousedown" + (l ? " touchstart" : ""),
            n = "mousemove.clockpicker" + (l ? " touchmove.clockpicker" : ""),
            o = "mouseup.clockpicker" + (l ? " touchend.clockpicker" : ""),
            p = navigator.vibrate ? "vibrate" : navigator.webkitVibrate ? "webkitVibrate" : null,
            q = 0,
            r = 135,
            s = 105,
            t = 70,
            u = 20,
            v = 2 * r,
            w = k ? 350 : 1,
            x = ['<div class="clockpicker picker">', '<div class="picker__holder">', '<div class="picker__frame">', '<div class="picker__wrap">', '<div class="picker__box">', '<div class="picker__date-display">', '<div class="clockpicker-display">', '<div class="clockpicker-display-column">', '<span class="clockpicker-span-hours text-primary"></span>', ":", '<span class="clockpicker-span-minutes"></span>', "</div>", '<div class="clockpicker-display-column clockpicker-display-am-pm">', '<div class="clockpicker-span-am-pm"></div>', "</div>", "</div>", "</div>", '<div class="picker__container__wrapper">', '<div class="picker__calendar-container">', '<div class="clockpicker-plate">', '<div class="clockpicker-canvas"></div>', '<div class="clockpicker-dial clockpicker-hours"></div>', '<div class="clockpicker-dial clockpicker-minutes clockpicker-dial-out"></div>', "</div>", '<div class="clockpicker-am-pm-block">', "</div>", "</div>", '<div class="picker__footer">', "</div>", "</div>", "</div>", "</div>", "</div>", "</div>", "</div>"].join("");
        e.DEFAULTS = {
            "default": "",
            fromnow: 0,
            donetext: "Ok",
            cleartext: "Clear",
            canceltext: "Cancel",
            autoclose: !1,
            ampmclickable: !0,
            darktheme: !1,
            twelvehour: !0,
            vibrate: !0
        }, e.prototype.toggle = function() {
            this[this.isShown ? "hide" : "show"]()
        }, e.prototype.locate = function() {
            var a = this.element,
                b = this.popover;
            a.offset(), a.outerWidth(), a.outerHeight(), this.options.align;
            b.show()
        }, e.prototype.show = function(b) {
            if (!this.isShown) {
                f(this.options.beforeShow), a(":input").each(function() {
                    a(this).attr("tabindex", -1)
                });
                var d = this;
                this.input.blur(), this.popover.addClass("picker--opened"), this.input.addClass("picker__input picker__input--active"), a(document.body).css("overflow", "hidden");
                var e = ((this.input.prop("value") || this.options["default"] || "") + "").split(":");
                if (this.options.twelvehour && "undefined" != typeof e[1] && (e[1].indexOf("AM") > 0 ? this.amOrPm = "AM" : this.amOrPm = "PM", e[1] = e[1].replace("AM", "").replace("PM", "")), "now" === e[0]) {
                    var i = new Date(+new Date + this.options.fromnow);
                    e = [i.getHours(), i.getMinutes()], this.options.twelvehour && (this.amOrPm = e[0] >= 12 && e[0] < 24 ? "PM" : "AM")
                }
                if (this.hours = +e[0] || 0, this.minutes = +e[1] || 0, this.spanHours.html(this.hours), this.spanMinutes.html(c(this.minutes)), !this.isAppended) {
                    var j = document.querySelector(this.options.container);
                    this.options.container && j ? j.appendChild(this.popover[0]) : this.popover.insertAfter(this.input), this.options.twelvehour && ("PM" === this.amOrPm ? (this.spanAmPm.children("#click-pm").addClass("text-primary"), this.spanAmPm.children("#click-am").removeClass("text-primary")) : (this.spanAmPm.children("#click-am").addClass("text-primary"), this.spanAmPm.children("#click-pm").removeClass("text-primary"))), g.on("resize.clockpicker" + this.id, function() {
                        d.isShown && d.locate()
                    }), this.isAppended = !0
                }
                this.toggleView("hours"), this.locate(), this.isShown = !0, h.on("click.clockpicker." + this.id + " focusin.clockpicker." + this.id, function(b) {
                    var c = a(b.target);
                    0 === c.closest(d.popover.find(".picker__wrap")).length && 0 === c.closest(d.input).length && d.hide()
                }), h.on("keyup.clockpicker." + this.id, function(a) {
                    27 === a.keyCode && d.hide()
                }), f(this.options.afterShow)
            }
        }, e.prototype.hide = function() {
            f(this.options.beforeHide), this.input.removeClass("picker__input picker__input--active"), this.popover.removeClass("picker--opened"), a(document.body).css("overflow", "visible"), this.isShown = !1, a(":input").each(function(b) {
                a(this).attr("tabindex", b + 1)
            }), h.off("click.clockpicker." + this.id + " focusin.clockpicker." + this.id), h.off("keyup.clockpicker." + this.id), this.popover.hide(), f(this.options.afterHide)
        }, e.prototype.toggleView = function(b, c) {
            var d = !1;
            "minutes" === b && "visible" === a(this.hoursView).css("visibility") && (f(this.options.beforeHourSelect), d = !0);
            var e = "hours" === b,
                g = e ? this.hoursView : this.minutesView,
                h = e ? this.minutesView : this.hoursView;
            this.currentView = b, this.spanHours.toggleClass("text-primary", e), this.spanMinutes.toggleClass("text-primary", !e), h.addClass("clockpicker-dial-out"), g.css("visibility", "visible").removeClass("clockpicker-dial-out"), this.resetClock(c), clearTimeout(this.toggleViewTimer), this.toggleViewTimer = setTimeout(function() {
                h.css("visibility", "hidden")
            }, w), d && f(this.options.afterHourSelect)
        }, e.prototype.resetClock = function(a) {
            var b = this.currentView,
                c = this[b],
                d = "hours" === b,
                e = Math.PI / (d ? 6 : 30),
                f = c * e,
                g = d && c > 0 && 13 > c ? t : s,
                h = Math.sin(f) * g,
                i = -Math.cos(f) * g,
                k = this;
            j && a ? (k.canvas.addClass("clockpicker-canvas-out"), setTimeout(function() {
                k.canvas.removeClass("clockpicker-canvas-out"), k.setHand(h, i)
            }, a)) : this.setHand(h, i)
        }, e.prototype.setHand = function(b, d, e, f) {
            var g, h = Math.atan2(b, -d),
                i = "hours" === this.currentView,
                k = Math.PI / (i || e ? 6 : 30),
                l = Math.sqrt(b * b + d * d),
                m = this.options,
                n = i && (s + t) / 2 > l,
                o = n ? t : s;
            if (m.twelvehour && (o = s), 0 > h && (h = 2 * Math.PI + h), g = Math.round(h / k), h = g * k, m.twelvehour ? i ? 0 === g && (g = 12) : (e && (g *= 5), 60 === g && (g = 0)) : i ? (12 === g && (g = 0), g = n ? 0 === g ? 12 : g : 0 === g ? 0 : g + 12) : (e && (g *= 5), 60 === g && (g = 0)), this[this.currentView] !== g && p && this.options.vibrate && (this.vibrateTimer || (navigator[p](10), this.vibrateTimer = setTimeout(a.proxy(function() {
                    this.vibrateTimer = null
                }, this), 100))), this[this.currentView] = g, i ? this.spanHours.html(g) : this.spanMinutes.html(c(g)), !j) return void this[i ? "hoursView" : "minutesView"].find(".clockpicker-tick").each(function() {
                var b = a(this);
                b.toggleClass("active", g === +b.html())
            });
            var q = Math.sin(h) * (o - u),
                r = -Math.cos(h) * (o - u),
                v = Math.sin(h) * o,
                w = -Math.cos(h) * o;
            this.hand.setAttribute("x2", q), this.hand.setAttribute("y2", r), this.bg.setAttribute("cx", v), this.bg.setAttribute("cy", w)
        }, e.prototype.done = function() {
            f(this.options.beforeDone), this.hide(), this.label.addClass("active");
            var a = this.input.prop("value"),
                b = c(this.hours) + ":" + c(this.minutes);
            this.options.twelvehour && (b += this.amOrPm), this.input.prop("value", b), b !== a && (this.input.triggerHandler("change"), this.isInput || this.element.trigger("change")), this.options.autoclose && this.input.trigger("blur"), f(this.options.afterDone)
        }, e.prototype.clear = function() {
            this.hide(), this.label.removeClass("active");
            var a = this.input.prop("value"),
                b = "";
            this.input.prop("value", b), b !== a && (this.input.triggerHandler("change"), this.isInput || this.element.trigger("change")), this.options.autoclose && this.input.trigger("blur")
        }, e.prototype.remove = function() {
            this.element.removeData("clockpicker"), this.input.off("focus.clockpicker click.clockpicker"), this.isShown && this.hide(), this.isAppended && (g.off("resize.clockpicker" + this.id), this.popover.remove())
        }, a.fn.pickatime = function(b) {
            var c = Array.prototype.slice.call(arguments, 1);
            return this.each(function() {
                var d = a(this),
                    f = d.data("clockpicker");
                if (f) "function" == typeof f[b] && f[b].apply(f, c);
                else {
                    var g = a.extend({}, e.DEFAULTS, d.data(), "object" == typeof b && b);
                    d.data("clockpicker", new e(d, g))
                }
            })
        }
    }(jQuery),
    function(a) {
        function b() {
            var b = +a(this).attr("data-length"),
                c = +a(this).val().length,
                d = b >= c;
            a(this).parent().find('span[class="character-counter"]').html(c + "/" + b), e(d, a(this))
        }

        function c(b) {
            var c = b.parent().find('span[class="character-counter"]');
            c.length || (c = a("<span/>").addClass("character-counter").css("float", "right").css("font-size", "12px").css("height", 1), b.parent().append(c))
        }

        function d() {
            a(this).parent().find('span[class="character-counter"]').html("")
        }

        function e(a, b) {
            var c = b.hasClass("invalid");
            a && c ? b.removeClass("invalid") : a || c || (b.removeClass("valid"), b.addClass("invalid"))
        }
        a.fn.characterCounter = function() {
            return this.each(function() {
                var e = a(this),
                    f = e.parent().find('span[class="character-counter"]');
                if (!f.length) {
                    var g = void 0 !== e.attr("data-length");
                    g && (e.on("input", b), e.on("focus", b), e.on("blur", d), c(e))
                }
            })
        }, a(document).ready(function() {
            a("input, textarea").characterCounter()
        })
    }(jQuery),
    function(a) {
        var b = {
            init: function(b) {
                var c = {
                    duration: 200,
                    dist: -100,
                    shift: 0,
                    padding: 0,
                    fullWidth: !1,
                    indicators: !1,
                    noWrap: !1,
                    onCycleTo: null
                };
                b = a.extend(c, b);
                var d = Materialize.objectSelectorString(a(this));
                return this.each(function(c) {
                    function e() {
                        "undefined" != typeof window.ontouchstart && (O.on("touchstart.carousel", n), O.on("touchmove.carousel", o), O.on("touchend.carousel", p)), O.on("mousedown.carousel", n), O.on("mousemove.carousel", o), O.on("mouseup.carousel", p), O.on("mouseleave.carousel", p), O.on("click.carousel", l)
                    }

                    function f(a) {
                        return a.targetTouches && a.targetTouches.length >= 1 ? a.targetTouches[0].clientX : a.clientX
                    }

                    function g(a) {
                        return a.targetTouches && a.targetTouches.length >= 1 ? a.targetTouches[0].clientY : a.clientY
                    }

                    function h(a) {
                        return a >= x ? a % x : 0 > a ? h(x + a % x) : a
                    }

                    function i(c) {
                        E = !0, O.hasClass("scrolling") || O.addClass("scrolling"), null != M && window.clearTimeout(M), M = window.setTimeout(function() {
                            E = !1, O.removeClass("scrolling")
                        }, b.duration);
                        var d, e, f, g, i, j, k, l = u;
                        if (t = "number" == typeof c ? c : t, u = Math.floor((t + w / 2) / w), f = t - u * w, g = 0 > f ? 1 : -1, i = -g * f * 2 / w, e = x >> 1, b.fullWidth ? k = "translateX(0)" : (k = "translateX(" + (O[0].clientWidth - r) / 2 + "px) ", k += "translateY(" + (O[0].clientHeight - s) / 2 + "px)"), Q) {
                            var m = u % x,
                                n = L.find(".indicator-item.active");
                            n.index() !== m && (n.removeClass("active"), L.find(".indicator-item").eq(m).addClass("active"))
                        }
                        for ((!R || u >= 0 && x > u) && (j = q[h(u)], a(j).hasClass("active") || (O.find(".carousel-item").removeClass("active"), a(j).addClass("active")), j.style[F] = k + " translateX(" + -f / 2 + "px) translateX(" + g * b.shift * i * d + "px) translateZ(" + b.dist * i + "px)", j.style.zIndex = 0, b.fullWidth ? tweenedOpacity = 1 : tweenedOpacity = 1 - .2 * i, j.style.opacity = tweenedOpacity, j.style.display = "block"), d = 1; e >= d; ++d) b.fullWidth ? (zTranslation = b.dist, tweenedOpacity = d === e && 0 > f ? 1 - i : 1) : (zTranslation = b.dist * (2 * d + i * g), tweenedOpacity = 1 - .2 * (2 * d + i * g)), (!R || x > u + d) && (j = q[h(u + d)], j.style[F] = k + " translateX(" + (b.shift + (w * d - f) / 2) + "px) translateZ(" + zTranslation + "px)", j.style.zIndex = -d, j.style.opacity = tweenedOpacity, j.style.display = "block"), b.fullWidth ? (zTranslation = b.dist, tweenedOpacity = d === e && f > 0 ? 1 - i : 1) : (zTranslation = b.dist * (2 * d - i * g), tweenedOpacity = 1 - .2 * (2 * d - i * g)), (!R || u - d >= 0) && (j = q[h(u - d)], j.style[F] = k + " translateX(" + (-b.shift + (-w * d - f) / 2) + "px) translateZ(" + zTranslation + "px)", j.style.zIndex = -d, j.style.opacity = tweenedOpacity, j.style.display = "block");
                        if ((!R || u >= 0 && x > u) && (j = q[h(u)], j.style[F] = k + " translateX(" + -f / 2 + "px) translateX(" + g * b.shift * i + "px) translateZ(" + b.dist * i + "px)", j.style.zIndex = 0, b.fullWidth ? tweenedOpacity = 1 : tweenedOpacity = 1 - .2 * i, j.style.opacity = tweenedOpacity, j.style.display = "block"), l !== u && "function" == typeof b.onCycleTo) {
                            var o = O.find(".carousel-item").eq(h(u));
                            b.onCycleTo.call(this, o, J)
                        }
                        "function" == typeof N && (N.call(this, o, J), N = null)
                    }

                    function j() {
                        var a, b, c, d;
                        a = Date.now(), b = a - H, H = a, c = t - G, G = t, d = 1e3 * c / (1 + b), D = .8 * d + .2 * D
                    }

                    function k() {
                        var a, c;
                        B && (a = Date.now() - H, c = B * Math.exp(-a / b.duration), c > 2 || -2 > c ? (i(C - c), requestAnimationFrame(k)) : i(C))
                    }

                    function l(c) {
                        if (J) return c.preventDefault(), c.stopPropagation(), !1;
                        if (!b.fullWidth) {
                            var d = a(c.target).closest(".carousel-item").index(),
                                e = h(u) - d;
                            0 !== e && (c.preventDefault(), c.stopPropagation()), m(d)
                        }
                    }

                    function m(a) {
                        var b = u % x - a;
                        R || (0 > b ? Math.abs(b + x) < Math.abs(b) && (b += x) : b > 0 && Math.abs(b - x) < b && (b -= x)), 0 > b ? O.trigger("carouselNext", [Math.abs(b)]) : b > 0 && O.trigger("carouselPrev", [b])
                    }

                    function n(b) {
                        "mousedown" === b.type && a(b.target).is("img") && b.preventDefault(), v = !0, J = !1, K = !1, z = f(b), A = g(b), D = B = 0, G = t, H = Date.now(), clearInterval(I), I = setInterval(j, 100)
                    }

                    function o(a) {
                        var b, c, d;
                        if (v)
                            if (b = f(a), y = g(a), c = z - b, d = Math.abs(A - y), 30 > d && !K)(c > 2 || -2 > c) && (J = !0, z = b, i(t + c));
                            else {
                                if (J) return a.preventDefault(), a.stopPropagation(), !1;
                                K = !0
                            }
                        return J ? (a.preventDefault(), a.stopPropagation(), !1) : void 0
                    }

                    function p(a) {
                        return v ? (v = !1, clearInterval(I), C = t, (D > 10 || -10 > D) && (B = .9 * D, C = t + B), C = Math.round(C / w) * w, R && (C >= w * (x - 1) ? C = w * (x - 1) : 0 > C && (C = 0)), B = C - t, H = Date.now(), requestAnimationFrame(k), J && (a.preventDefault(), a.stopPropagation()), !1) : void 0
                    }
                    var q, r, s, t, u, v, w, x, z, A, B, C, D, E, F, G, H, I, J, K, L = a('<ul class="indicators"></ul>'),
                        M = null,
                        N = null,
                        O = a(this),
                        P = O.find(".carousel-item").length > 1,
                        Q = (O.attr("data-indicators") || b.indicators) && P,
                        R = O.attr("data-no-wrap") || b.noWrap || !P,
                        S = O.attr("data-namespace") || d + c;
                    O.attr("data-namespace", S);
                    var T = function(b) {
                        var c = O.find(".carousel-item.active").length ? O.find(".carousel-item.active").first() : O.find(".carousel-item").first(),
                            d = c.find("img").first();
                        if (d.length)
                            if (d[0].complete) {
                                var e = d.height();
                                if (e > 0) O.css("height", d.height());
                                else {
                                    var f = d[0].naturalWidth,
                                        g = d[0].naturalHeight,
                                        h = O.width() / f * g;
                                    O.css("height", h)
                                }
                            } else d.on("load", function() {
                                O.css("height", a(this).height())
                            });
                        else if (!b) {
                            var i = c.height();
                            O.css("height", i)
                        }
                    };
                    if (b.fullWidth && (b.dist = 0, T(), Q && O.find(".carousel-fixed-item").addClass("with-indicators")), O.hasClass("initialized")) return a(window).trigger("resize"), O.trigger("carouselNext", [1e-6]), !0;
                    O.addClass("initialized"), v = !1, t = C = 0, q = [], r = O.find(".carousel-item").first().innerWidth(), s = O.find(".carousel-item").first().innerHeight(), w = 2 * r + b.padding, O.find(".carousel-item").each(function(b) {
                        if (q.push(a(this)[0]), Q) {
                            var c = a('<li class="indicator-item"></li>');
                            0 === b && c.addClass("active"), c.click(function(b) {
                                b.stopPropagation();
                                var c = a(this).index();
                                m(c)
                            }), L.append(c)
                        }
                    }), Q && O.append(L), x = q.length, F = "transform", ["webkit", "Moz", "O", "ms"].every(function(a) {
                        var b = a + "Transform";
                        return "undefined" != typeof document.body.style[b] ? (F = b, !1) : !0
                    });
                    var U = Materialize.throttle(function() {
                        if (b.fullWidth) {
                            r = O.find(".carousel-item").first().innerWidth();
                            O.find(".carousel-item.active").height();
                            w = 2 * r + b.padding, t = 2 * u * r, C = t, T(!0)
                        } else i()
                    }, 200);
                    a(window).off("resize.carousel-" + S).on("resize.carousel-" + S, U), e(), i(t), a(this).on("carouselNext", function(a, b, c) {
                        void 0 === b && (b = 1), "function" == typeof c && (N = c), C = w * Math.round(t / w) + w * b, t !== C && (B = C - t, H = Date.now(), requestAnimationFrame(k))
                    }), a(this).on("carouselPrev", function(a, b, c) {
                        void 0 === b && (b = 1), "function" == typeof c && (N = c), C = w * Math.round(t / w) - w * b, t !== C && (B = C - t, H = Date.now(), requestAnimationFrame(k))
                    }), a(this).on("carouselSet", function(a, b, c) {
                        void 0 === b && (b = 0), "function" == typeof c && (N = c), m(b)
                    })
                })
            },
            next: function(b, c) {
                a(this).trigger("carouselNext", [b, c])
            },
            prev: function(b, c) {
                a(this).trigger("carouselPrev", [b, c])
            },
            set: function(b, c) {
                a(this).trigger("carouselSet", [b, c])
            },
            destroy: function() {
                var b = a(this).attr("data-namespace");
                a(this).removeAttr("data-namespace"), a(this).removeClass("initialized"), a(this).find(".indicators").remove(), a(this).off("carouselNext carouselPrev carouselSet"), a(window).off("resize.carousel-" + b), "undefined" != typeof window.ontouchstart && a(this).off("touchstart.carousel touchmove.carousel touchend.carousel"), a(this).off("mousedown.carousel mousemove.carousel mouseup.carousel mouseleave.carousel click.carousel")
            }
        };
        a.fn.carousel = function(c) {
            return b[c] ? b[c].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof c && c ? void a.error("Method " + c + " does not exist on jQuery.carousel") : b.init.apply(this, arguments);
        }
    }(jQuery),
    function(a) {
        var b = {
            init: function(b) {
                return this.each(function() {
                    var c = a("#" + a(this).attr("data-activates")),
                        d = (a("body"), a(this)),
                        e = d.parent(".tap-target-wrapper"),
                        f = e.find(".tap-target-wave"),
                        g = e.find(".tap-target-origin"),
                        h = d.find(".tap-target-content");
                    e.length || (e = d.wrap(a('<div class="tap-target-wrapper"></div>')).parent()), h.length || (h = a('<div class="tap-target-content"></div>'), d.append(h)), f.length || (f = a('<div class="tap-target-wave"></div>'), g.length || (g = c.clone(!0, !0), g.addClass("tap-target-origin"), g.removeAttr("id"), g.removeAttr("style"), f.append(g)), e.append(f));
                    var i = function() {
                            e.is(".open") || (e.addClass("open"), setTimeout(function() {
                                g.off("click.tapTarget").on("click.tapTarget", function(a) {
                                    j(), g.off("click.tapTarget")
                                }), a(document).off("click.tapTarget").on("click.tapTarget", function(b) {
                                    j(), a(document).off("click.tapTarget")
                                });
                                var b = Materialize.throttle(function() {
                                    k()
                                }, 200);
                                a(window).off("resize.tapTarget").on("resize.tapTarget", b)
                            }, 0))
                        },
                        j = function() {
                            e.is(".open") && (e.removeClass("open"), g.off("click.tapTarget"), a(document).off("click.tapTarget"), a(window).off("resize.tapTarget"))
                        },
                        k = function() {
                            var b = "fixed" === c.css("position");
                            if (!b)
                                for (var g = c.parents(), i = 0; i < g.length && !(b = "fixed" == a(g[i]).css("position")); i++);
                            var j = c.outerWidth(),
                                k = c.outerHeight(),
                                l = b ? c.offset().top - a(document).scrollTop() : c.offset().top,
                                m = b ? c.offset().left - a(document).scrollLeft() : c.offset().left,
                                n = a(window).width(),
                                o = a(window).height(),
                                p = n / 2,
                                q = o / 2,
                                r = p >= m,
                                s = m > p,
                                t = q >= l,
                                u = l > q,
                                v = m >= .25 * n && .75 * n >= m,
                                w = d.outerWidth(),
                                x = d.outerHeight(),
                                y = l + k / 2 - x / 2,
                                z = m + j / 2 - w / 2,
                                A = b ? "fixed" : "absolute",
                                B = v ? w : w / 2 + j,
                                C = x / 2,
                                D = t ? x / 2 : 0,
                                E = 0,
                                F = r && !v ? w / 2 - j : 0,
                                G = 0,
                                H = j,
                                I = u ? "bottom" : "top",
                                J = j > k ? 2 * j : 2 * j,
                                K = J,
                                L = x / 2 - K / 2,
                                M = w / 2 - J / 2,
                                N = {};
                            N.top = t ? y : "", N.right = s ? n - z - w : "", N.bottom = u ? o - y - x : "", N.left = r ? z : "", N.position = A, e.css(N), h.css({
                                width: B,
                                height: C,
                                top: D,
                                right: G,
                                bottom: E,
                                left: F,
                                padding: H,
                                verticalAlign: I
                            }), f.css({
                                top: L,
                                left: M,
                                width: J,
                                height: K
                            })
                        };
                    "open" == b && (k(), i()), "close" == b && j()
                })
            },
            open: function() {},
            close: function() {}
        };
        a.fn.tapTarget = function(c) {
            return b[c] || "object" == typeof c ? b.init.apply(this, arguments) : void a.error("Method " + c + " does not exist on jQuery.tap-target")
        }
    }(jQuery),
    function(a) {
        jQuery.fn.menuzord = function(b) {
            function c(b) {
                "fade" == n.effect ? a(b).children(".dropdown, .megamenu").stop(!0, !0).delay(n.showDelay).fadeIn(n.showSpeed).addClass(n.animation) : a(b).children(".dropdown, .megamenu").stop(!0, !0).delay(n.showDelay).slideDown(n.showSpeed).addClass(n.animation)
            }

            function d(b) {
                "fade" == n.effect ? a(b).children(".dropdown, .megamenu").stop(!0, !0).delay(n.hideDelay).fadeOut(n.hideSpeed).removeClass(n.animation) : a(b).children(".dropdown, .megamenu").stop(!0, !0).delay(n.hideDelay).slideUp(n.hideSpeed).removeClass(n.animation), a(b).children(".dropdown, .megamenu").find(".dropdown, .megamenu").stop(!0, !0).delay(n.hideDelay).fadeOut(n.hideSpeed)
            }

            function e() {
                a(q).find(".dropdown, .megamenu").hide(0), navigator.userAgent.match(/Mobi/i) || window.navigator.msMaxTouchPoints > 0 || "click" == n.trigger ? (a(".menuzord-menu > li > a, .menuzord-menu ul.dropdown li a").bind("click touchstart", function(b) {
                    return b.stopPropagation(), b.preventDefault(), a(this).parent("li").siblings("li").find(".dropdown, .megamenu").stop(!0, !0).fadeOut(300), "none" == a(this).siblings(".dropdown, .megamenu").css("display") ? (c(a(this).parent("li")), !1) : (d(a(this).parent("li")), void(window.location.href = a(this).attr("href")))
                }), a(document).bind("click.menu touchstart.menu", function(b) {
                    0 == a(b.target).closest(".menuzord").length && a(".menuzord-menu").find(".dropdown, .megamenu").fadeOut(300)
                })) : a(r).bind("mouseenter", function() {
                    c(this)
                }).bind("mouseleave", function() {
                    d(this)
                })
            }

            function f() {
                a(q).find(".dropdown, .megamenu").hide(0), a(q).find(".indicator").each(function() {
                    a(this).parent("a").siblings(".dropdown, .megamenu").length > 0 && a(this).bind("click", function(b) {
                        a(q).scrollTo({
                            top: 45,
                            left: 0
                        }, 600), "A" == a(this).parent().prop("tagName") && b.preventDefault(), "none" == a(this).parent("a").siblings(".dropdown, .megamenu").css("display") ? (a(this).parent("a").siblings(".dropdown, .megamenu").delay(n.showDelay).slideDown(n.showSpeed), a(this).parent("a").parent("li").siblings("li").find(".dropdown, .megamenu").slideUp(n.hideSpeed)) : a(this).parent("a").siblings(".dropdown, .megamenu").slideUp(n.hideSpeed)
                    })
                })
            }

            function g() {
                var b = a(q).children("li").children(".dropdown, .megamenu");
                if (a(window).innerWidth() > s)
                    for (var c = a(p).outerWidth(!0), d = 0; d < b.length; d++) a(b[d]).parent("li").position().left + a(b[d]).outerWidth() > c ? a(b[d]).css("right", 0) : ((c == a(b[d]).outerWidth() || c - a(b[d]).outerWidth() < 20) && a(b[d]).css("left", 0), a(b[d]).parent("li").position().left + a(b[d]).outerWidth() < c && a(b[d]).css("right", "auto"))
            }

            function h() {
                a(q).hide(0), a(o).show(0).click(function() {
                    "none" == a(q).css("display") ? a(q).slideDown(n.showSpeed) : a(q).slideUp(n.hideSpeed).find(".dropdown, .megamenu").hide(n.hideSpeed)
                })
            }

            function i() {
                a(q).show(0), a(o).hide(0)
            }

            function j() {
                a(p).find("li, a").unbind(), a(document).unbind("click.menu touchstart.menu")
            }

            function k() {
                function b(b) {
                    var c = a(b).find(".menuzord-tabs-nav > li"),
                        d = a(b).find(".menuzord-tabs-content");
                    a(c).bind("click touchstart", function(b) {
                        b.stopPropagation(), b.preventDefault(), a(c).removeClass("active"), a(this).addClass("active"), a(d).hide(0), a(d[a(this).index()]).show(0)
                    })
                }
                if (a(q).find(".menuzord-tabs").length > 0)
                    for (var c = a(q).find(".menuzord-tabs"), d = 0; d < c.length; d++) b(c[d])
            }

            function l() {
                return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth
            }

            function m() {
                if (g(), l() <= s && t > s && (j(), n.responsive ? (h(), f()) : e()), l() > s && s >= u && (j(), i(), e()), t = l(), u = l(), k(), /MSIE (\d+\.\d+);/.test(navigator.userAgent) && l() < s) {
                    var b = new Number(RegExp.$1);
                    8 == b && (a(o).hide(0), a(q).show(0), j(), e())
                }
            }
            var n;
            a.extend(n = {
                showSpeed: 300,
                hideSpeed: 300,
                trigger: "hover",
                showDelay: 0,
                hideDelay: 0,
                effect: "fade",
                align: "left",
                responsive: !0,
                animation: "none",
                indentChildren: !0,
                indicatorFirstLevel: "+",
                indicatorSecondLevel: "+",
                scrollable: !0,
                scrollableMaxHeight: 400
            }, b);
            var o, p = a(this),
                q = a(p).children(".menuzord-menu"),
                r = a(q).find("li"),
                s = 768,
                t = 2e3,
                u = 200;
            a(q).children("li").children("a").each(function() {
                a(this).siblings(".dropdown, .megamenu").length > 0 && a(this).append("<span class='indicator'>" + n.indicatorFirstLevel + "</span>")
            }), a(q).find(".dropdown").children("li").children("a").each(function() {
                a(this).siblings(".dropdown").length > 0 && a(this).append("<span class='indicator'>" + n.indicatorSecondLevel + "</span>")
            }), "right" == n.align && a(q).addClass("menuzord-right"), n.indentChildren && a(q).addClass("menuzord-indented"), n.responsive && (a(p).addClass("menuzord-responsive").prepend("<a href='javascript:void(0)' class='showhide'><em></em><em></em><em></em></a>"), o = a(p).children(".showhide")), n.scrollable && n.responsive && a(q).css("max-height", n.scrollableMaxHeight).addClass("scrollable").append("<li class='scrollable-fix'></li>"), m(), a(window).resize(function() {
                m(), g()
            })
        }
    }(jQuery),
    function(a) {
        "use strict";
        a(["jquery"], function(a) {
            function b(b) {
                return a.isFunction(b) || "object" == typeof b ? b : {
                    top: b,
                    left: b
                }
            }
            var c = a.scrollTo = function(b, c, d) {
                return a(window).scrollTo(b, c, d)
            };
            return c.defaults = {
                axis: "xy",
                duration: parseFloat(a.fn.jquery) >= 1.3 ? 0 : 1,
                limit: !0
            }, c.window = function(b) {
                return a(window)._scrollable()
            }, a.fn._scrollable = function() {
                return this.map(function() {
                    var b = this,
                        c = !b.nodeName || -1 != a.inArray(b.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]);
                    if (!c) return b;
                    var d = (b.contentWindow || b).document || b.ownerDocument || b;
                    return /webkit/i.test(navigator.userAgent) || "BackCompat" == d.compatMode ? d.body : d.documentElement
                })
            }, a.fn.scrollTo = function(d, e, f) {
                return "object" == typeof e && (f = e, e = 0), "function" == typeof f && (f = {
                    onAfter: f
                }), "max" == d && (d = 9e9), f = a.extend({}, c.defaults, f), e = e || f.duration, f.queue = f.queue && f.axis.length > 1, f.queue && (e /= 2), f.offset = b(f.offset), f.over = b(f.over), this._scrollable().each(function() {
                    function g(a) {
                        j.animate(l, e, f.easing, a && function() {
                            a.call(this, k, f)
                        })
                    }
                    if (null != d) {
                        var h, i = this,
                            j = a(i),
                            k = d,
                            l = {},
                            m = j.is("html,body");
                        switch (typeof k) {
                            case "number":
                            case "string":
                                if (/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(k)) {
                                    k = b(k);
                                    break
                                }
                                if (k = m ? a(k) : a(k, this), !k.length) return;
                            case "object":
                                (k.is || k.style) && (h = (k = a(k)).offset())
                        }
                        var n = a.isFunction(f.offset) && f.offset(i, k) || f.offset;
                        a.each(f.axis.split(""), function(a, b) {
                            var d = "x" == b ? "Left" : "Top",
                                e = d.toLowerCase(),
                                o = "scroll" + d,
                                p = i[o],
                                q = c.max(i, b);
                            if (h) l[o] = h[e] + (m ? 0 : p - j.offset()[e]), f.margin && (l[o] -= parseInt(k.css("margin" + d)) || 0, l[o] -= parseInt(k.css("border" + d + "Width")) || 0), l[o] += n[e] || 0, f.over[e] && (l[o] += k["x" == b ? "width" : "height"]() * f.over[e]);
                            else {
                                var r = k[e];
                                l[o] = r.slice && "%" == r.slice(-1) ? parseFloat(r) / 100 * q : r
                            }
                            f.limit && /^\d+$/.test(l[o]) && (l[o] = l[o] <= 0 ? 0 : Math.min(l[o], q)), !a && f.queue && (p != l[o] && g(f.onAfterFirst), delete l[o])
                        }), g(f.onAfter)
                    }
                }).end()
            }, c.max = function(b, c) {
                var d = "x" == c ? "Width" : "Height",
                    e = "scroll" + d;
                if (!a(b).is("html,body")) return b[e] - a(b)[d.toLowerCase()]();
                var f = "client" + d,
                    g = b.ownerDocument.documentElement,
                    h = b.ownerDocument.body;
                return Math.max(g[e], h[e]) - Math.min(g[f], h[f])
            }, c
        })
    }("function" == typeof define && define.amd ? define : function(a, b) {
        "undefined" != typeof module && module.exports ? module.exports = b(require("jquery")) : b(jQuery)
    });
var wpcf7 = {
    apiSettings: {
        root: "http://localhost/vxm/wp-json/contact-form-7/v1",
        namespace: "contact-form-7/v1"  
    },
    recaptcha: {
        messages: {
            empty: "Por favor, prueba que no eres un robot."
        }
    },
    cached: "1"
};
! function($) {
    "use strict";
    "undefined" != typeof wpcf7 && null !== wpcf7 && (wpcf7 = $.extend({
        cached: 0,
        inputs: []
    }, wpcf7), $(function() {
        wpcf7.supportHtml5 = function() {
            var a = {},
                b = document.createElement("input");
            a.placeholder = "placeholder" in b;
            var c = ["email", "url", "tel", "number", "range", "date"];
            return $.each(c, function(c, d) {
                b.setAttribute("type", d), a[d] = "text" !== b.type
            }), a
        }(), $("div.wpcf7 > form").each(function() {
            var a = $(this);
            wpcf7.initForm(a), wpcf7.cached && wpcf7.refill(a)
        })
    }), wpcf7.getId = function(a) {
        return parseInt($('input[name="_wpcf7"]', a).val(), 10)
    }, wpcf7.initForm = function(a) {
        var b = $(a);
        b.submit(function(a) {
            "function" == typeof window.FormData && (wpcf7.submit(b), a.preventDefault())
        }), $(".wpcf7-submit", b).after('<span class="ajax-loader"></span>'), wpcf7.toggleSubmit(b), b.on("click", ".wpcf7-acceptance", function() {
            wpcf7.toggleSubmit(b)
        }), $(".wpcf7-exclusive-checkbox", b).on("click", "input:checkbox", function() {
            var a = $(this).attr("name");
            b.find('input:checkbox[name="' + a + '"]').not(this).prop("checked", !1)
        }), $(".wpcf7-list-item.has-free-text", b).each(function() {
            var a = $(":input.wpcf7-free-text", this),
                b = $(this).closest(".wpcf7-form-control");
            $(":checkbox, :radio", this).is(":checked") ? a.prop("disabled", !1) : a.prop("disabled", !0), b.on("change", ":checkbox, :radio", function() {
                var c = $(".has-free-text", b).find(":checkbox, :radio");
                c.is(":checked") ? a.prop("disabled", !1).focus() : a.prop("disabled", !0)
            })
        }), wpcf7.supportHtml5.placeholder || $("[placeholder]", b).each(function() {
            $(this).val($(this).attr("placeholder")), $(this).addClass("placeheld"), $(this).focus(function() {
                $(this).hasClass("placeheld") && $(this).val("").removeClass("placeheld")
            }), $(this).blur(function() {
                "" === $(this).val() && ($(this).val($(this).attr("placeholder")), $(this).addClass("placeheld"))
            })
        }), wpcf7.jqueryUi && !wpcf7.supportHtml5.date && b.find('input.wpcf7-date[type="date"]').each(function() {
            $(this).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: new Date($(this).attr("min")),
                maxDate: new Date($(this).attr("max"))
            })
        }), wpcf7.jqueryUi && !wpcf7.supportHtml5.number && b.find('input.wpcf7-number[type="number"]').each(function() {
            $(this).spinner({
                min: $(this).attr("min"),
                max: $(this).attr("max"),
                step: $(this).attr("step")
            })
        }), $(".wpcf7-character-count", b).each(function() {
            var a = $(this),
                c = a.attr("data-target-name"),
                d = a.hasClass("down"),
                e = parseInt(a.attr("data-starting-value"), 10),
                f = parseInt(a.attr("data-maximum-value"), 10),
                g = parseInt(a.attr("data-minimum-value"), 10),
                h = function(b) {
                    var c = $(b),
                        h = c.val().length,
                        i = d ? e - h : h;
                    a.attr("data-current-value", i), a.text(i), f && h > f ? a.addClass("too-long") : a.removeClass("too-long"), g && g > h ? a.addClass("too-short") : a.removeClass("too-short")
                };
            $(':input[name="' + c + '"]', b).each(function() {
                h(this), $(this).keyup(function() {
                    h(this)
                })
            })
        }), b.on("change", ".wpcf7-validates-as-url", function() {
            var a = $.trim($(this).val());
            a && !a.match(/^[a-z][a-z0-9.+-]*:/i) && -1 !== a.indexOf(".") && (a = a.replace(/^\/+/, ""), a = "http://" + a), $(this).val(a)
        })
    }, wpcf7.submit = function(form) {
        if ("function" == typeof window.FormData) {
            var $form = $(form);
            $(".ajax-loader", $form).addClass("is-active"), $(".wpcf7-submit", $form).prop("disabled", !0), $(".wpcf7-submit", $form).prop("value", "Espere un momento..."), $("[placeholder].placeheld", $form).each(function(a, b) {
                $(b).val("")
            }), wpcf7.clearResponse($form);
            var formData = new FormData($form.get(0)),
                detail = {
                    id: $form.closest("div.wpcf7").attr("id"),
                    status: "init",
                    inputs: [],
                    formData: formData
                };
            $.each($form.serializeArray(), function(a, b) {
                if ("_wpcf7" == b.name) detail.contactFormId = b.value;
                else if ("_wpcf7_version" == b.name) detail.pluginVersion = b.value;
                else if ("_wpcf7_locale" == b.name) detail.contactFormLocale = b.value;
                else if ("_wpcf7_unit_tag" == b.name) detail.unitTag = b.value;
                else if ("_wpcf7_container_post" == b.name) detail.containerPostId = b.value;
                else if (b.name.match(/^_wpcf7_\w+_free_text_/)) {
                    var c = b.name.replace(/^_wpcf7_\w+_free_text_/, "");
                    detail.inputs.push({
                        name: c + "-free-text",
                        value: b.value
                    })
                } else b.name.match(/^_/) || detail.inputs.push(b)
            }), wpcf7.triggerEvent($form.closest("div.wpcf7"), "beforesubmit", detail);
            var ajaxSuccess = function(data, status, xhr, $form) {
                detail.id = $(data.into).attr("id"), detail.status = data.status;
                var $message = $(".wpcf7-response-output", $form);
                switch (data.status) {
                    case "validation_failed":
                        $.each(data.invalidFields, function(a, b) {
                            $(b.into, $form).each(function() {
                                wpcf7.notValidTip(this, b.message), $(".wpcf7-form-control", this).addClass("wpcf7-not-valid"), $("[aria-invalid]", this).attr("aria-invalid", "true")
                            })
                        }), $message.addClass("wpcf7-validation-errors"), $form.addClass("invalid"), wpcf7.triggerEvent(data.into, "invalid", detail);
                        break;
                    case "spam":
                        $message.addClass("wpcf7-spam-blocked"), $form.addClass("spam"), $('[name="g-recaptcha-response"]', $form).each(function() {
                            if ("" === $(this).val()) {
                                var a = $(this).closest(".wpcf7-form-control-wrap");
                                wpcf7.notValidTip(a, wpcf7.recaptcha.messages.empty)
                            }
                        }), wpcf7.triggerEvent(data.into, "spam", detail);
                        break;
                    case "mail_sent":
                        $message.addClass("wpcf7-mail-sent-ok"), $form.addClass("sent"), data.onSentOk && $.each(data.onSentOk, function(i, n) {
                            eval(n)
                        }), wpcf7.triggerEvent(data.into, "mailsent", detail);
                        break;
                    case "mail_failed":
                    case "acceptance_missing":
                    default:
                        $message.addClass("wpcf7-mail-sent-ng"), $form.addClass("failed"), wpcf7.triggerEvent(data.into, "mailfailed", detail)
                }
                wpcf7.refill($form, data), data.onSubmit && $.each(data.onSubmit, function(i, n) {
                    eval(n)
                }), wpcf7.triggerEvent(data.into, "submit", detail), "mail_sent" == data.status && $form.each(function() {
                    this.reset()
                }), $form.find("[placeholder].placeheld").each(function(a, b) {
                    $(b).val($(b).attr("placeholder"))
                }), $message.html("").append(data.message).slideDown("fast"), $message.attr("role", "alert"), $(".screen-reader-response", $form.closest(".wpcf7")).each(function() {
                    var a = $(this);
                    if (a.html("").attr("role", "").append(data.message), data.invalidFields) {
                        var b = $("<ul></ul>");
                        $.each(data.invalidFields, function(a, c) {
                            if (c.idref) var d = $("<li></li>").append($("<a></a>").attr("href", "#" + c.idref).append(c.message));
                            else var d = $("<li></li>").append(c.message);
                            b.append(d)
                        }), a.append(b)
                    }
                    a.attr("role", "alert").focus()
                })
            };
            $.ajax({
                type: "POST",
                url: wpcf7.apiSettings.getRoute("/contact-forms/" + wpcf7.getId($form) + "/feedback"),
                data: formData,
                dataType: "json",
                processData: !1,
                contentType: !1
            }).done(function(a, b, c) {
                ajaxSuccess(a, b, c, $form), $(".ajax-loader", $form).removeClass("is-active"), $(".wpcf7-submit", $form).prop("disabled", !1), $(".wpcf7-submit", $form).prop("value", "Enviar")
            }).fail(function(a, b, c) {
                var d = $('<div class="ajax-error"></div>').text(c.message);
                $form.after(d)
            })
        }
    }, wpcf7.triggerEvent = function(a, b, c) {
        var d = $(a),
            e = new CustomEvent("wpcf7" + b, {
                bubbles: !0,
                detail: c
            });
        d.get(0).dispatchEvent(e), d.trigger("wpcf7:" + b, c), d.trigger(b + ".wpcf7", c)
    }, wpcf7.toggleSubmit = function(a, b) {
        var c = $(a),
            d = $("input:submit", c);
        return "undefined" != typeof b ? void d.prop("disabled", !b) : void(c.hasClass("wpcf7-acceptance-as-validation") || (d.prop("disabled", !1), $("input:checkbox.wpcf7-acceptance", c).each(function() {
            var a = $(this);
            return a.hasClass("wpcf7-invert") && a.is(":checked") || !a.hasClass("wpcf7-invert") && !a.is(":checked") ? (d.prop("disabled", !0), !1) : void 0
        })))
    }, wpcf7.notValidTip = function(a, b) {
        var c = $(a);
        if ($(".wpcf7-not-valid-tip", c).remove(), $('<span role="alert" class="wpcf7-not-valid-tip"></span>').text(b).appendTo(c), c.is(".use-floating-validation-tip *")) {
            var d = function(a) {
                $(a).not(":hidden").animate({
                    opacity: 0
                }, "fast", function() {
                    $(this).css({
                        "z-index": -100
                    })
                })
            };
            c.on("mouseover", ".wpcf7-not-valid-tip", function() {
                d(this)
            }), c.on("focus", ":input", function() {
                d($(".wpcf7-not-valid-tip", c))
            })
        }
    }, wpcf7.refill = function(a, b) {
        var c = $(a),
            d = function(a, b) {
                $.each(b, function(b, c) {
                    a.find(':input[name="' + b + '"]').val(""), a.find("img.wpcf7-captcha-" + b).attr("src", c);
                    var d = /([0-9]+)\.(png|gif|jpeg)$/.exec(c);
                    a.find('input:hidden[name="_wpcf7_captcha_challenge_' + b + '"]').attr("value", d[1])
                })
            },
            e = function(a, b) {
                $.each(b, function(b, c) {
                    a.find(':input[name="' + b + '"]').val(""), a.find(':input[name="' + b + '"]').siblings("span.wpcf7-quiz-label").text(c[0]), a.find('input:hidden[name="_wpcf7_quiz_answer_' + b + '"]').attr("value", c[1])
                })
            };
        "undefined" == typeof b ? $.ajax({
            type: "GET",
            url: wpcf7.apiSettings.getRoute("/contact-forms/" + wpcf7.getId(c) + "/refill"),
            dataType: "json"
        }).done(function(a, b, f) {
            a.captcha && d(c, a.captcha), a.quiz && e(c, a.quiz)
        }) : (b.captcha && d(c, b.captcha), b.quiz && e(c, b.quiz))
    }, wpcf7.clearResponse = function(a) {
        var b = $(a);
        b.removeClass("invalid spam sent failed"), b.siblings(".screen-reader-response").html("").attr("role", ""), $(".wpcf7-not-valid-tip", b).remove(), $("[aria-invalid]", b).attr("aria-invalid", "false"), $(".wpcf7-form-control", b).removeClass("wpcf7-not-valid"), $(".wpcf7-response-output", b).hide().empty().removeAttr("role").removeClass("wpcf7-mail-sent-ok wpcf7-mail-sent-ng wpcf7-validation-errors wpcf7-spam-blocked")
    }, wpcf7.apiSettings.getRoute = function(a) {
        var b = wpcf7.apiSettings.root;
        return b = b.replace(wpcf7.apiSettings.namespace, wpcf7.apiSettings.namespace + a)
    })
}(jQuery),
function() {
    function a(a, b) {
        b = b || {
            bubbles: !1,
            cancelable: !1,
            detail: void 0
        };
        var c = document.createEvent("CustomEvent");
        return c.initCustomEvent(a, b.bubbles, b.cancelable, b.detail), c
    }
    return "function" == typeof window.CustomEvent ? !1 : (a.prototype = window.Event.prototype, void(window.CustomEvent = a))
}(),
function(a, b) {
    function c(a) {
        a.hasOwnProperty("data-simple-scrollbar") || Object.defineProperty(a, "data-simple-scrollbar", new SimpleScrollbar(a))
    }

    function d(a, c) {
        function d(a) {
            var b = a.pageY - f;
            f = a.pageY, g(function() {
                c.el.scrollTop += b / c.scrollRatio
            })
        }

        function e() {
            a.classList.remove("ss-grabbed"), b.body.classList.remove("ss-grabbed"), b.removeEventListener("mousemove", d), b.removeEventListener("mouseup", e)
        }
        var f;
        a.addEventListener("mousedown", function(c) {
            return f = c.pageY, a.classList.add("ss-grabbed"), b.body.classList.add("ss-grabbed"), b.addEventListener("mousemove", d), b.addEventListener("mouseup", e), !1
        })
    }

    function e(a) {
        for (this.target = a, this.direction = window.getComputedStyle(this.target).direction, this.bar = '<div class="ss-scroll">', this.wrapper = b.createElement("div"), this.wrapper.setAttribute("class", "ss-wrapper"), this.el = b.createElement("div"), this.el.setAttribute("class", "ss-content"), "rtl" === this.direction && this.el.classList.add("rtl"), this.wrapper.appendChild(this.el); this.target.firstChild;) this.el.appendChild(this.target.firstChild);
        this.target.appendChild(this.wrapper), this.target.insertAdjacentHTML("beforeend", this.bar), this.bar = this.target.lastChild, d(this.bar, this), this.moveBar(), this.el.addEventListener("scroll", this.moveBar.bind(this)), this.el.addEventListener("mouseenter", this.moveBar.bind(this)), this.target.classList.add("ss-container");
        var c = window.getComputedStyle(a);
        "0px" === c.height && "0px" !== c["max-height"] && (a.style.height = c["max-height"])
    }

    function f() {
        for (var a = b.querySelectorAll("*[ss-container]"), d = 0; d < a.length; d++) c(a[d])
    }
    var g = a.requestAnimationFrame || a.setImmediate || function(a) {
        return setTimeout(a, 0)
    };
    e.prototype = {
        moveBar: function(a) {
            var b = this.el.scrollHeight,
                c = this;
            this.scrollRatio = this.el.clientHeight / b;
            var d = "rtl" === c.direction ? c.target.clientWidth - c.bar.clientWidth + 18 : -1 * (c.target.clientWidth - c.bar.clientWidth);
            g(function() {
                1 <= c.scrollRatio ? c.bar.classList.add("ss-hidden") : (c.bar.classList.remove("ss-hidden"), c.bar.style.cssText = "height:" + Math.max(100 * c.scrollRatio, 10) + "%; top:" + c.el.scrollTop / b * 100 + "%;right:" + d + "px;")
            })
        }
    }, b.addEventListener("DOMContentLoaded", f), e.initEl = c, e.initAll = f, a.SimpleScrollbar = e
}(window, document),
function() {
    var a, b, c, d, e, f = function(a, b) {
            return function() {
                return a.apply(b, arguments)
            }
        },
        g = [].indexOf || function(a) {
            for (var b = 0, c = this.length; c > b; b++)
                if (b in this && this[b] === a) return b;
            return -1
        };
    b = function() {
        function a() {}
        return a.prototype.extend = function(a, b) {
            var c, d;
            for (c in b) d = b[c], null == a[c] && (a[c] = d);
            return a
        }, a.prototype.isMobile = function(a) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a)
        }, a.prototype.createEvent = function(a, b, c, d) {
            var e;
            return null == b && (b = !1), null == c && (c = !1), null == d && (d = null), null != document.createEvent ? (e = document.createEvent("CustomEvent"), e.initCustomEvent(a, b, c, d)) : null != document.createEventObject ? (e = document.createEventObject(), e.eventType = a) : e.eventName = a, e
        }, a.prototype.emitEvent = function(a, b) {
            return null != a.dispatchEvent ? a.dispatchEvent(b) : b in (null != a) ? a[b]() : "on" + b in (null != a) ? a["on" + b]() : void 0
        }, a.prototype.addEvent = function(a, b, c) {
            return null != a.addEventListener ? a.addEventListener(b, c, !1) : null != a.attachEvent ? a.attachEvent("on" + b, c) : a[b] = c
        }, a.prototype.removeEvent = function(a, b, c) {
            return null != a.removeEventListener ? a.removeEventListener(b, c, !1) : null != a.detachEvent ? a.detachEvent("on" + b, c) : delete a[b]
        }, a.prototype.innerHeight = function() {
            return "innerHeight" in window ? window.innerHeight : document.documentElement.clientHeight
        }, a
    }(), c = this.WeakMap || this.MozWeakMap || (c = function() {
        function a() {
            this.keys = [], this.values = []
        }
        return a.prototype.get = function(a) {
            var b, c, d, e, f;
            for (f = this.keys, b = d = 0, e = f.length; e > d; b = ++d)
                if (c = f[b], c === a) return this.values[b]
        }, a.prototype.set = function(a, b) {
            var c, d, e, f, g;
            for (g = this.keys, c = e = 0, f = g.length; f > e; c = ++e)
                if (d = g[c], d === a) return void(this.values[c] = b);
            return this.keys.push(a), this.values.push(b)
        }, a
    }()), a = this.MutationObserver || this.WebkitMutationObserver || this.MozMutationObserver || (a = function() {
        function a() {
            "undefined" != typeof console && null !== console && console.warn("MutationObserver is not supported by your browser."), "undefined" != typeof console && null !== console && console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content.")
        }
        return a.notSupported = !0, a.prototype.observe = function() {}, a
    }()), d = this.getComputedStyle || function(a) {
        return this.getPropertyValue = function(b) {
            var c;
            return "float" === b && (b = "styleFloat"), e.test(b) && b.replace(e, function(a, b) {
                return b.toUpperCase()
            }), (null != (c = a.currentStyle) ? c[b] : void 0) || null
        }, this
    }, e = /(\-([a-z]){1})/g, this.WOW = function() {
        function e(a) {
            null == a && (a = {}), this.scrollCallback = f(this.scrollCallback, this), this.scrollHandler = f(this.scrollHandler, this), this.resetAnimation = f(this.resetAnimation, this), this.start = f(this.start, this), this.scrolled = !0, this.config = this.util().extend(a, this.defaults), null != a.scrollContainer && (this.config.scrollContainer = document.querySelector(a.scrollContainer)), this.animationNameCache = new c, this.wowEvent = this.util().createEvent(this.config.boxClass)
        }
        return e.prototype.defaults = {
            boxClass: "wow",
            animateClass: "animated",
            offset: 0,
            mobile: !0,
            live: !0,
            callback: null,
            scrollContainer: null
        }, e.prototype.init = function() {
            var a;
            return this.element = window.document.documentElement, "interactive" === (a = document.readyState) || "complete" === a ? this.start() : this.util().addEvent(document, "DOMContentLoaded", this.start), this.finished = []
        }, e.prototype.start = function() {
            var b, c, d, e;
            if (this.stopped = !1, this.boxes = function() {
                    var a, c, d, e;
                    for (d = this.element.querySelectorAll("." + this.config.boxClass), e = [], a = 0, c = d.length; c > a; a++) b = d[a], e.push(b);
                    return e
                }.call(this), this.all = function() {
                    var a, c, d, e;
                    for (d = this.boxes, e = [], a = 0, c = d.length; c > a; a++) b = d[a], e.push(b);
                    return e
                }.call(this), this.boxes.length)
                if (this.disabled()) this.resetStyle();
                else
                    for (e = this.boxes, c = 0, d = e.length; d > c; c++) b = e[c], this.applyStyle(b, !0);
            return this.disabled() || (this.util().addEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().addEvent(window, "resize", this.scrollHandler), this.interval = setInterval(this.scrollCallback, 50)), this.config.live ? new a(function(a) {
                return function(b) {
                    var c, d, e, f, g;
                    for (g = [], c = 0, d = b.length; d > c; c++) f = b[c], g.push(function() {
                        var a, b, c, d;
                        for (c = f.addedNodes || [], d = [], a = 0, b = c.length; b > a; a++) e = c[a], d.push(this.doSync(e));
                        return d
                    }.call(a));
                    return g
                }
            }(this)).observe(document.body, {
                childList: !0,
                subtree: !0
            }) : void 0
        }, e.prototype.stop = function() {
            return this.stopped = !0, this.util().removeEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().removeEvent(window, "resize", this.scrollHandler), null != this.interval ? clearInterval(this.interval) : void 0
        }, e.prototype.sync = function() {
            return a.notSupported ? this.doSync(this.element) : void 0
        }, e.prototype.doSync = function(a) {
            var b, c, d, e, f;
            if (null == a && (a = this.element), 1 === a.nodeType) {
                for (a = a.parentNode || a, e = a.querySelectorAll("." + this.config.boxClass), f = [], c = 0, d = e.length; d > c; c++) b = e[c], g.call(this.all, b) < 0 ? (this.boxes.push(b), this.all.push(b), this.stopped || this.disabled() ? this.resetStyle() : this.applyStyle(b, !0), f.push(this.scrolled = !0)) : f.push(void 0);
                return f
            }
        }, e.prototype.show = function(a) {
            return this.applyStyle(a), a.className = a.className + " " + this.config.animateClass, null != this.config.callback && this.config.callback(a), this.util().emitEvent(a, this.wowEvent), this.util().addEvent(a, "animationend", this.resetAnimation), this.util().addEvent(a, "oanimationend", this.resetAnimation), this.util().addEvent(a, "webkitAnimationEnd", this.resetAnimation), this.util().addEvent(a, "MSAnimationEnd", this.resetAnimation), a
        }, e.prototype.applyStyle = function(a, b) {
            var c, d, e;
            return d = a.getAttribute("data-wow-duration"), c = a.getAttribute("data-wow-delay"), e = a.getAttribute("data-wow-iteration"), this.animate(function(f) {
                return function() {
                    return f.customStyle(a, b, d, c, e)
                }
            }(this))
        }, e.prototype.animate = function() {
            return "requestAnimationFrame" in window ? function(a) {
                return window.requestAnimationFrame(a)
            } : function(a) {
                return a()
            }
        }(), e.prototype.resetStyle = function() {
            var a, b, c, d, e;
            for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b], e.push(a.style.visibility = "visible");
            return e
        }, e.prototype.resetAnimation = function(a) {
            var b;
            return a.type.toLowerCase().indexOf("animationend") >= 0 ? (b = a.target || a.srcElement, b.className = b.className.replace(this.config.animateClass, "").trim()) : void 0
        }, e.prototype.customStyle = function(a, b, c, d, e) {
            return b && this.cacheAnimationName(a), a.style.visibility = b ? "hidden" : "visible", c && this.vendorSet(a.style, {
                animationDuration: c
            }), d && this.vendorSet(a.style, {
                animationDelay: d
            }), e && this.vendorSet(a.style, {
                animationIterationCount: e
            }), this.vendorSet(a.style, {
                animationName: b ? "none" : this.cachedAnimationName(a)
            }), a
        }, e.prototype.vendors = ["moz", "webkit"], e.prototype.vendorSet = function(a, b) {
            var c, d, e, f;
            d = [];
            for (c in b) e = b[c], a["" + c] = e, d.push(function() {
                var b, d, g, h;
                for (g = this.vendors, h = [], b = 0, d = g.length; d > b; b++) f = g[b], h.push(a["" + f + c.charAt(0).toUpperCase() + c.substr(1)] = e);
                return h
            }.call(this));
            return d
        }, e.prototype.vendorCSS = function(a, b) {
            var c, e, f, g, h, i;
            for (h = d(a), g = h.getPropertyCSSValue(b), f = this.vendors, c = 0, e = f.length; e > c; c++) i = f[c], g = g || h.getPropertyCSSValue("-" + i + "-" + b);
            return g
        }, e.prototype.animationName = function(a) {
            var b;
            try {
                b = this.vendorCSS(a, "animation-name").cssText
            } catch (c) {
                b = d(a).getPropertyValue("animation-name")
            }
            return "none" === b ? "" : b
        }, e.prototype.cacheAnimationName = function(a) {
            return this.animationNameCache.set(a, this.animationName(a))
        }, e.prototype.cachedAnimationName = function(a) {
            return this.animationNameCache.get(a)
        }, e.prototype.scrollHandler = function() {
            return this.scrolled = !0
        }, e.prototype.scrollCallback = function() {
            var a;
            return !this.scrolled || (this.scrolled = !1, this.boxes = function() {
                var b, c, d, e;
                for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b], a && (this.isVisible(a) ? this.show(a) : e.push(a));
                return e
            }.call(this), this.boxes.length || this.config.live) ? void 0 : this.stop()
        }, e.prototype.offsetTop = function(a) {
            for (var b; void 0 === a.offsetTop;) a = a.parentNode;
            for (b = a.offsetTop; a = a.offsetParent;) b += a.offsetTop;
            return b
        }, e.prototype.isVisible = function(a) {
            var b, c, d, e, f;
            return c = a.getAttribute("data-wow-offset") || this.config.offset, f = this.config.scrollContainer && this.config.scrollContainer.scrollTop || window.pageYOffset, e = f + Math.min(this.element.clientHeight, this.util().innerHeight()) - c, d = this.offsetTop(a), b = d + a.clientHeight, e >= d && b >= f
        }, e.prototype.util = function() {
            return null != this._util ? this._util : this._util = new b
        }, e.prototype.disabled = function() {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent)
        }, e
    }()
}.call(this);
var viewport = updateViewportDimensions(),
    waitForFinalEvent = function() {
        var a = {};
        return function(b, c, d) {
            d || (d = "Don't call this twice without a uniqueId"), a[d] && clearTimeout(a[d]), a[d] = setTimeout(b, c)
        }
    }(),
    timeToWaitForLast = 100;
// THIS IS WHERE MAGIC HAPPENS
jQuery(document).ready(function(a) {
        desktopFunctions(), 
        a(".phone").text(function(a, b) {
            return b.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2-$3")
        }), 
        a(".wpcf7-form-control").unwrap(), 
        a(".parallax").parallax(), 
        a("select").material_select(), 
        a(".tooltipped").tooltip({
            delay: 50
        }), 
        a(".modal-trigger").leanModal(), 
        a(".collapsible").collapsible(), 
        a(".content-tab").fadeIn("slow"),
        a("ul#ofatabs").tabs({
            onShow: function(b) {
                "#alumnos" === b.selector && (a(".load-more-wrap").remove(), 
                a(".lista-alumnos").fadeOut("fast"), 
                frontend_alumnos_search_ajax_form(1), 
                console.log("No mames con los alumnos")), 
                "#instructores" === b.selector && (a(".load-more-wrap").remove(), 
                a(".lista-alumnos").fadeOut("fast"), 
                frontend_instructores_admin_search_ajax_form(1), 
                console.log("No mames con los instructores")), 
                "#certificadores" === b.selector && (a(".load-more-wrap").remove(), 
                a(".lista-alumnos").fadeOut("fast"), 
                frontend_certificadores_admin_search_ajax_form(1), 
                console.log("No mames con los certificadores")), 
                "#certificadores-senior" === b.selector && (a(".load-more-wrap").remove(), 
                a(".lista-alumnos").fadeOut("fast"), 
                console.log("No mames con los certificadores senior"))
            }
        }), a(".materialboxed").materialbox(), a(".carousel").carousel({
            indicators: !0,
            full_width: !0
        }), a(".slider").slider({
            full_width: !1,
            height: 350,
            interval: 6e4
        }), a("#nav-mobile").prepend('<div class="menu-logo-wrap"><img src="' + templateUrl + '/library/img/vxm-menu-head.png" class="responsive-img"></div>');
        var b = '<div id="wpas-loading-img" class="preloader-wrapper active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
        a("#wpas-load div:first-child").html(b), a("#wpas-load-btn").addClass("btn"), a("#search_query").focus(function() {
            a("#wpas-search_query").addClass("focused")
        }), a("#search_query").blur(function() {
            a("#wpas-search_query").removeClass("focused")
        }), a(".flow-type-h1").flowtype({
            minFont: 30,
            maxFont: 90
        }), a(".acf-form-submit").prepend('<a href="javascript:void(0)" class="btn-flat" onclick="$.magnificPopup.close();">Cancelar</a> '), a(".inline-popup-link").magnificPopup({
            type: "inline",
            midClick: !0,
            removalDelay: 500,
            fixedBgPos: !0,
            callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = this.st.el.attr("data-effect")
                },
                close: function() {}
            }
        }), jQuery(".menuzord-nav").menuzord({
            responsive: !1,
            effect: "fade",
            showDelay: 200,
            hideDelay: 200,
            indicatorFirstLevel: '<span class="ti-angle-down"></span>'
        }), jQuery("#menu-idioma>li>a>.title").prepend('<i class="ti-world"></i> '), a(".js-lazyYT").lazyYT("AIzaSyDJuFjaWSp2GSTeeVKkubheMQd6x3cz0nw", {
            loading_text: "Cargando video..."
        }), a(".dropdown-button").dropdown({
            inDuration: 300,
            outDuration: 225,
            constrainWidth: !1,
            hover: !0,
            gutter: 0,
            belowOrigin: !0,
            alignment: "right",
            stopPropagation: !1
        })
    }), jQuery(window).on("scroll", function() {
        var a = jQuery(window).scrollTop();
        a > 200 ? setTimeout(function() {
            jQuery(".title-appear").addClass("appear")
        }, 200) : setTimeout(function() {
            jQuery(".title-appear").removeClass("appear")
        }, 100)
    }), jQuery(window).load(function() {
        jQuery("#pageloader2 .pageloaderbg").velocity({
            scaleY: 0
        }, {
            duration: 1500,
            easing: "easeOutExpo",
            delay: 500,
            begin: function() {
                jQuery("#pageloader2 .loader").velocity({
                    translateY: "1000px",
                    opacity: 0
                }, {
                    duration: 1200,
                    easing: [.95, -.35, .42, .85],
                    delay: 100
                })
            },
            complete: function() {
                jQuery("#pageloader2 .loader").remove(), initialisePageScrollAnimations(), inviewAnimations()
            }
        })
    }), (new WOW).init(),
    function() {
        function a(a) {
            classie.add(a.target.parentNode, "input--filled")
        }

        function b(a) {
            "" === a.target.value.trim() && classie.remove(a.target.parentNode, "input--filled")
        }
        String.prototype.trim || ! function() {
            var a = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
                return this.replace(a, "")
            }
        }(), [].slice.call(document.querySelectorAll("input.input__field")).forEach(function(c) {
            "" !== c.value.trim() && classie.add(c.parentNode, "input--filled"), c.addEventListener("focus", a), c.addEventListener("blur", b)
        })
    }(), jQuery(document).on("click", ".personal-data-toggle", function() {
        $toggle = jQuery(this), $pdata = $toggle.next(), $pdata.slideToggle(400, function() {})
    }), jQuery(document).on("click", ".pdt", function() {
        $toggle = jQuery(this), $pdata = $toggle.next().next().next(), $pdata.slideToggle(400, function() {})
    }), $(function() {
        var a = 0,
            b = 5;
        $(window).scroll(function(c) {
            var d = $(this).scrollTop();
            Math.abs(a - d) <= b || (a = d)
        })
    }), document.addEventListener("wpcf7submit", function(a) {
        console.log("CF7 Submit!"), setTimeout(function() {
            jQuery(".wpcf7-response-output").slideUp()
        }, 4500)
    }, !1), document.addEventListener("wpcf7mailsent", function(a) {
        console.log("CF7 Sent!"), ga("send", "event", "Contacto", "Mensaje Enviado", "Pagina de Contacto")
    }, !1),
    function(a) {
        a(function() {
            a(".button-collapse").sideNav({
                menuWidth: 240,
                edge: "left",
                closeOnClick: !0
            })
        })
    }(jQuery), jQuery(document).on("click", "#aspirante-search-submit", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide();
        var b = jQuery("#aspirante-order").attr("value"),
            c = jQuery("#aspirante-orderby").attr("value");
        frontend_instructores_search_ajax_form(1, b, c)
    }), jQuery(document).on("click", "#aspirante-search-reset", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide(), jQuery(this).parents("form")[0].reset(), frontend_instructores_search_ajax_form(1)
    }), jQuery(document).on("click", "#load-more-aspirantes", function(a) {
        a.preventDefault();
        var b = jQuery(this).attr("href"),
            c = b.split("paged=");
        frontend_instructores_search_ajax_form(c[1]), console.log(c[1])
    }), jQuery(document).on("click", "#certificador-search-submit", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide();
        var b = jQuery("#certificador-order").attr("value"),
            c = jQuery("#certificador-orderby").attr("value");
        frontend_certificadores_search_ajax_form(1, b, c)
    }), jQuery(document).on("click", "#certificador-search-reset", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide(), jQuery(this).parents("form")[0].reset(), frontend_certificadores_search_ajax_form(1)
    }), jQuery(document).on("click", "#load-more-certificadores", function(a) {
        a.preventDefault();
        var b = jQuery(this).attr("href"),
            c = b.split("paged=");
        frontend_certificadores_search_ajax_form(c[1]), console.log(c[1])
    }), jQuery(document).on("click", "#alumno-search-submit", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide();
        var b = jQuery("#alumno-order").attr("value"),
            c = jQuery("#alumno-orderby").attr("value");
        frontend_alumnos_search_ajax_form(1, b, c)
    }), jQuery(document).on("click", "#alumno-search-reset", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide(), jQuery(this).parents("form")[0].reset(), frontend_alumnos_search_ajax_form(1)
    }), jQuery(document).on("click", "#load-more-alumnos", function(a) {
        a.preventDefault();
        var b = jQuery(this).attr("href"),
            c = b.split("paged=");
        frontend_alumnos_search_ajax_form(c[1]), console.log(c[1])
    }), jQuery(document).on("click", "#aspirante-admin-search-submit", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide();
        var b = jQuery("#aspirante-admin-order").attr("value"),
            c = jQuery("#aspirante-admin-orderby").attr("value");
        frontend_instructores_admin_search_ajax_form(1, b, c)
    }), jQuery(document).on("click", "#aspirante-admin-search-reset", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide(), jQuery(this).parents("form")[0].reset(), frontend_instructores_admin_search_ajax_form(1)
    }), jQuery(document).on("click", "#load-more-aspirantes-admin", function(a) {
        a.preventDefault();
        var b = jQuery(this).attr("href"),
            c = b.split("paged=");
        frontend_instructores_admin_search_ajax_form(c[1]), console.log(c[1])
    }), jQuery(document).on("click", "#certificador-admin-search-submit", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide();
        var b = jQuery("#certificador-admin-order").attr("value"),
            c = jQuery("#certificador-admin-orderby").attr("value");
        frontend_certificadores_admin_search_ajax_form(1, b, c)
    }), jQuery(document).on("click", "#certificador-admin-search-reset", function(a) {
        a.preventDefault(), jQuery(".lista-alumnos").hide(), jQuery(this).parents("form")[0].reset(), frontend_certificadores_admin_search_ajax_form(1)
    }), jQuery(document).on("click", "#load-more-certificadores-admin", function(a) {
        a.preventDefault();
        var b = jQuery(this).attr("href"),
            c = b.split("paged=");
        frontend_certificadores_admin_search_ajax_form(c[1]), console.log(c[1])
    }),
    function(a) {
        var b, c, d, e, f, g;
        if (
            "undefined" == typeof b && (b = jQuery("body").hasClass("page-template-page-instructores-aiosearch")), 
            "undefined" == typeof c && (c = jQuery("body").hasClass("page-template-page-certificadores-aiosearch")), 
            "undefined" == typeof d && (d = jQuery("body").hasClass("page-template-page-ofi")), 
            "undefined" == typeof e && (e = jQuery("body").hasClass("page-template-page-ofc")), 
            "undefined" == typeof f && (f = jQuery("body").hasClass("page-template-page-ofcs")), 
            "undefined" == typeof g && (g = jQuery("body").hasClass("page-template-page-ofa")), 
            b
        ){          frontend_instructores_search_ajax_form(1);         } 
        else if (c) frontend_certificadores_search_ajax_form(1);
        else if (d) frontend_alumnos_search_ajax_form(1);
        else if (e) frontend_instructores_admin_search_ajax_form(1);
        else if (f) frontend_certificadores_admin_search_ajax_form(1);
        else if (g) {
            var h = window.location.hash;
            switch (h) {
                case "#alumnos":
                    frontend_alumnos_search_ajax_form(1);
                    break;
                case "#instructores":
                    frontend_instructores_admin_search_ajax_form(1);
                    break;
                case "#certificadores":
                    frontend_certificadores_admin_search_ajax_form(1);
                    break;
                case "#certificadores-senior":
                    break;
                default:
                    frontend_alumnos_search_ajax_form(1)
            }
        }
    }(jQuery);



jQuery(document).ready(function() {

    if(jQuery("body").hasClass("page-id-10")){
        frontend_faqs_search_ajax_form();
    }

    if(jQuery("body").hasClass("page-id-92")){
        frontend_faqs_instructores_search_ajax_form();
        frontend_manual_instructores_search_ajax_form();
    }

    if(jQuery("body").hasClass("page-id-125")){
        frontend_faqs_certificadores_search_ajax_form();
        frontend_manual_certificadores_search_ajax_form();
    }
})