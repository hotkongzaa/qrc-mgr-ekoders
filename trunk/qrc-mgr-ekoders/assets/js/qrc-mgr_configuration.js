/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*Default Configuration*/
$(document).ready(function() {

//    $("#main-container, .navbar-top").addClass("container");
    $(".navbar-top").addClass("fixed");
    $(".navbar-top, .navbar-side, #page-wrapper, .breadcrumbs").addClass("fixed");
//    $(".navbar-side, #page-wrapper, .footer-inner, .breadcrumbs").addClass("collapsed");

    $("#logout_click").click(function() {
        var jqxhr = $.post("../model/LogoutDesSession.php");
        jqxhr.success(function(data) {
            alert(data);
            window.location.assign("../index.php")
        });
        jqxhr.error(function() {
            alert("ไม่สามารถติดต่อกับ Server ได้");
        });
    });

    var jqxhr = $.post("../upper_menu/UperMenu.php");
    jqxhr.success(function(data) {
        $("#upper_menu").html(data);
//        $("#upper_menu_project").click(function() {
//            window.location = "../qrc-mgr_project/project-index.php";
//        });
    });
    jqxhr.error(function() {
        alert("ไม่สามารถติดต่อกับ Server ได้");
    });

});