/*!
 //Description: //Core scripts to handle the entire theme// This file should be included in all pages
 !**/

function swapStyle(e) {
    document.getElementById("qstyle").setAttribute("href", e);
    var t = e;
    localStorage.setItem("ektheme", t)
}
if ($(document).ready(function() {
    localStorage.getItem("fixedTop") && ($(".navbar-top").addClass("fixed"), $("#fixed-navbar").prop("checked", !0)), $("#fixed-navbar").click(function() {
        if (this.checked) {
            $(".navbar-top").addClass("fixed");
            var e = "fixed"
        } else if (!this.checked) {
            $(".navbar-top").removeClass("fixed");
            var e = ""
        }
        localStorage.setItem("fixedTop", e)
    }), "" != localStorage.getItem("fixedsiderbar") && ($(".navbar-top, .navbar-side, #page-wrapper, .breadcrumbs").addClass("fixed"), $("#fixed-sidebar").prop("checked", !0), $("#fixed-navbar").prop("checked", !0)), $("#fixed-sidebar").click(function() {
        if (this.checked) {
            $(".navbar-top, .navbar-side, #page-wrapper, .breadcrumbs").addClass("fixed");
            var e = "fixed"
        } else if (!this.checked) {
            $(".navbar-side,  #page-wrapper, .breadcrumbs").removeClass("fixed");
            var e = ""
        }
        localStorage.setItem("fixedsiderbar", e)
    }), localStorage.getItem("sidetoggle") && ($(".navbar-side, #page-wrapper, .footer-inner, .breadcrumbs").addClass("collapsed"), $("#sidebar-toggle").prop("checked", !0)), $("#sidebar-toggle").click(function() {
        if (this.checked) {
            $(".navbar-side, #page-wrapper, .footer-inner, .breadcrumbs").addClass("collapsed");
            var e = "collapsed"
        } else if (!this.checked) {
            $(".navbar-side, #page-wrapper, .footer-inner, .breadcrumbs").removeClass("collapsed");
            var e = ""
        }
        localStorage.setItem("sidetoggle", e)
    }), localStorage.getItem("insidecontainer") && ($("#main-container, .navbar-top").addClass("container"), $("#in-container").prop("checked", !0)), $("#in-container").click(function() {
        if (this.checked) {
            $("#main-container, .navbar-top").addClass("container");
            var e = "container"
        } else if (!this.checked) {
            $("#main-container, .navbar-top").removeClass("container");
            var e = ""
        }
        localStorage.setItem("insidecontainer", e)
    }), localStorage.getItem("SideBarLight") && ($(".navbar-side").addClass("sidebar-light"), $("#side-bar-color").prop("checked", !0)), $("#side-bar-color").click(function() {
        if (this.checked) {
            $(".navbar-side").addClass("sidebar-light");
            var e = "sidebar-light"
        } else if (!this.checked) {
            $(".navbar-side").removeClass("sidebar-light");
            var e = ""
        }
        localStorage.setItem("SideBarLight", e)
    }), $(function() {
        function e() {
            windowHeight = $(window).height(), jQuery(window).width() < 991 ? $(".sidebar-collapse").css("max-height", windowHeight - 110) : $(".navbar-side").hasClass("fixed") ? $(".sidebar-collapse").css("max-height", windowHeight) : $(".sidebar-collapse").css("max-height", 5e3)
        }
        e(), $(window).resize(function() {
            e()
        }), $(".sidebar-collapse").slimScroll({height: "100%", width: "100%", size: "1px"})
    }), $(".portlet-widgets .fa-chevron-down, .portlet-widgets .fa-chevron-up").click(function() {
        $(this).toggleClass("fa-chevron-down fa-chevron-up")
    }), $(".box-close").click(function() {
        $(this).closest(".portlet").hide("slow")
    }), $(function() {
        $("[data-rel='tooltip']").tooltip()
    }), $("[data-toggle=popover]").popover({html: !0}), $("#qs-setting-btn").click(function() {
        $(this).toggleClass("open"), $("#qs-setting-box").toggleClass("open")
    }), $("#fo-btn").click(function(e) {
        e.preventDefault(), $(".footer-warp").toggleClass("open")
    }), $(".task-lists li input").on("click", function() {
        $(this).parent().toggleClass("todo-done")
    }), $(".collapse").on("show.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").addClass("accordion-active"), $('a[href="#' + e + '"] .panel-title span').html('<i class="fa fa-angle-down bigger-110"></i>')
    }), $(".collapse").on("hide.bs.collapse", function() {
        var e = $(this).attr("id");
        $('a[href="#' + e + '"]').closest(".panel-heading").removeClass("accordion-active"), $('a[href="#' + e + '"] .panel-title span').html('<i class="fa fa-angle-right bigger-110"></i>')
    }), $("body").on("click", ".dropdown-menu.hold-on-click", function(e) {
        e.stopPropagation()
    }), $(function() {
        $("#btn-loading").click(function() {
            $(this).button("loading").delay(2e3).queue(function() {
                $(this).button("reset"), $(this).dequeue()
            })
        })
    }), $("li.dropdown").addClass("show-on-hover"), $(window).scroll(function() {
        $(this).scrollTop() > 50 ? $("#back-to-top").fadeIn() : $("#back-to-top").fadeOut()
    }), $("#back-to-top").click(function() {
        return $("body,html").animate({scrollTop: 0}, 800), !1
    }), $(function() {
        $("#input-items").on("keyup", function() {
            var e = new RegExp($(this).val(), "i");
            $(".side-nav li").hide(), $(".side-nav li").filter(function() {
                return e.test($(this).text())
            }).show()
        })
    }), $(function() {
        $("#side").eKMenu()
    })
}), function(e) {
    function t(t, a) {
        this.element = t, this.settings = e.extend({}, i, a), this._defaults = i, this._name = n, this.init()
    }
    var n = "eKMenu", i = {toggle: !0};
    t.prototype = {init: function() {
            var t = e(this.element), n = this.settings.toggle;
            t.find("li.open").has("ul").children("ul").addClass("collapse in"), t.find("li").not(".open").has("ul").children("ul").addClass("collapse"), t.find("li").has("ul").children("a").on("click", function(t) {
                t.preventDefault(), e(this).parent("li").toggleClass("open").children("ul").collapse("toggle"), n && e(this).parent("li").siblings().removeClass("open").children("ul.in").collapse("hide")
            })
        }}, e.fn[n] = function(i) {
        return this.each(function() {
            e.data(this, "plugin_" + n) || e.data(this, "plugin_" + n, new t(this, i))
        })
    }
}(jQuery, window, document), localStorage.getItem("ektheme")) {
    var sheet = localStorage.getItem("ektheme");
    $("#qstyle").attr("href", sheet)
}
var App = function() {
    var e = [];
    if ("webkitSpeechRecognition"in window)
        var t = new webkitSpeechRecognition;
    var n = function(n) {
        if ("webkitSpeechRecognition"in window)
            if ("start" == n)
                t.start();
            else if ("stop" == n)
                t.stop();
            else {
                var i = {continuous: !0, interim: !0, lang: !1, onEnd: !1, onResult: !1, onNoMatch: !1, onSpeechStart: !1, onSpeechEnd: !1};
                $.extend(i, n), i.continuous && (t.continuous = !0), i.interim && (t.interimResults = !0), i.lang && (t.lang = i.lang);
                var a = !1, o = "";
                t.onresult = function(t) {
                    for (var n = t.resultIndex; n < t.results.length; ++n)
                        if (t.results[n].isFinal) {
                            var s = t.results[n][0].transcript;
                            s = s.toLowerCase(), s = s.replace(/^\s+|\s+$/g, ""), console.log(s), i.onResult && i.onResult(s), $.each(e, function(e, t) {
                                a ? o == t.command && (t.dictation ? s == t.dictationEndCommand ? (a = !1, t.dictationEnd(s)) : t.listen(s) : (a = !1, t.listen(s))) : t.command == s && (t.action(s), t.listen && (a = !0, o = t.command))
                            })
                        } else {
                            var c = t.results[n][0].transcript;
                            $.each(e, function(e, t) {
                                t.interim !== !1 && a && o == t.command && t.interim(c)
                            })
                        }
                }, i.onNoMatch && (t.onnomatch = function() {
                    i.onNoMatch()
                }), i.onSpeechStart && (t.onspeechstart = function() {
                    i.onSpeechStart()
                }), i.onSpeechEnd && (t.onspeechend = function() {
                    i.onSpeechEnd()
                }), t.onaudiostart = function() {
                    $(".speech-button i").addClass("blur")
                }, t.onend = function() {
                    $(".speech-button i").removeClass("blur"), i.onEnd && i.onEnd()
                }
            }
        else
            alert("Only Chrome25+ browser support voice recognition.")
    }, i = function(t, n) {
        var i = {action: !1, dictation: !1, interim: !1, dictationEnd: !1, dictationEndCommand: "final.", listen: !1};
        $.extend(i, n), t ? i.action ? e.push({command: t, dictation: i.dictation, dictationEnd: i.dictationEnd, dictationEndCommand: i.dictationEndCommand, interim: i.interim, action: i.action, listen: i.listen}) : alert("Must have an action function") : alert("Must have a command text")
    };
    return{speech: function(e) {
            n(e)
        }, speechCommand: function(e, t) {
            i(e, t)
        }}
}(), Apps = function() {
    return{init: function() {
            handleNavTopBar()
        }, initNavTopBar: function() {
            $(window).scroll(function() {
                $(".top-navbar").offset().top > 50 ? $(".navbar-fixed-top, .navbar-brand").addClass("top-nav-collapse") : $(".navbar-fixed-top, .navbar-brand").removeClass("top-nav-collapse")
            })
        }}
}();
/*!
 //end
 !**/