/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*Default Configuration*/
$(document).ready(function () {
//    $("#main-container, .navbar-top").addClass("container");
//    $(".navbar-side, #page-wrapper, .footer-inner, .breadcrumbs").addClass("collapsed");
    $(".navbar-top").addClass("fixed");
    $(".navbar-top, .navbar-side, #page-wrapper, .breadcrumbs").addClass("fixed");
    setInterval(function () {
        $.ajax({
            url: "../model/com.qrc.mgr.controller/VerifySessionTimeOutCallBack.php",
            type: "POST",
            success: function (data, textStatus, jqXHR) {
                if (data == "TIMEOUT") {
                    var r = confirm("Session expire (30 mins), Please login again!");
                    if (r == true) {
                        window.location.href = "../index.php";
                    } else {
                        window.location.href = "../index.php";
                    }
                }
            }
        });
    }, 3000);

    $.ajax({
        url: "../upper_menu/UperMenu.php",
        type: 'POST',
        success: function (data, textStatus, jqXHR) {
            $("#upper_menu").html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("ไม่สามารถโหลด Upper Menu ได้");
        }
    });

    $("#logout_click").click(function () {
        $.ajax({
            url: "../model/LogoutDesSession.php",
            type: 'POST',
            success: function (data, textStatus, jqXHR) {
                alert(data);
                window.location.assign("../index.php");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("ไม่สามารถติดต่อกับ Server ได้");
            }
        });
    });
    $("#profile_Page").click(function () {
        window.location.assign("../qrc-mgr_profile/profile.php");
    });
});
function updateSessionTimeOutCallBack() {
    $.ajax({
        url: "../model/com.qrc.mgr.controller/UpdateSessionTimeOutCallBack.php",
        type: "POST",
        success: function (data, textStatus, jqXHR) {
            return textStatus;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            return textStatus;
        }
    });
}