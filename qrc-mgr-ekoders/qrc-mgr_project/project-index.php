<?php
session_start();
require '../model/com.qrc.mgr.controller/VerifySessionTimeOut.php';
$verifySessionTimeOut = new VerifySessionTimeOut();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else {
    if ($verifySessionTimeOut->checkTimeOut(time()) == "TIMEOUT") {
        session_destroy();
        echo '<script type="text/javascript">var r=confirm("Session expire (30 mins)!"); if(r==true){window.location.href="../index.php";}else{window.location.href="../index.php";}</script>';
    } else {
        require '../model-db-connection/config.php';
        $config = require '../model-db-connection/qrc_conf.properties.php';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>QRC - Building Management</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/fonts.css">
        <link rel="stylesheet" href="../assets/css/jquery.toastmessage.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">

        <!-- PAGE LEVEL PLUGINS STYLES -->	
        <link rel="stylesheet" type="text/css" href="assets/css/plugins/gritter/jquery.gritter.css" />	
        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <link rel="stylesheet" type="text/css" href="../assets/css/plugins/gritter/jquery.gritter.css" />

        <!-- Tc core CSS -->
        <link id="qstyle" rel="stylesheet" href="../assets/css/themes/style.css">	
        <!--[if lte IE 8]>
                <link rel="stylesheet" href="../assets/css/ie-fix.css" />
        <![endif]-->


        <!-- Add custom CSS here -->
        <link rel="stylesheet" href="../assets/css/only-for-demos.css">

        <!-- End custom CSS here -->

        <!--[if lt IE 9]>
        <script src="../assets/js/html5shiv.js"></script>
        <script src="../assets/js/respond.min.js"></script>
        <![endif]-->

        <!--[if lte IE 8]>
        <script src="../assets/js/plugins/easypiechart/easypiechart.ie-fix.js"></script>
        <![endif]-->

    </head>

    <body>
        <div id="wrapper">
            <div id="main-container">		
                <!-- BEGIN TOP NAVIGATION -->
                <nav class="navbar-top" role="navigation">
                    <!-- BEGIN BRAND HEADING -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".top-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="navbar-brand">
                            <a href=".php">

                            </a>
                        </div>
                    </div>
                    <!-- END BRAND HEADING -->
                    <div class="nav-top">
                        <!-- BEGIN RIGHT SIDE DROPDOWN BUTTONS -->
                        <ul class="nav navbar-right">
                            <li class="dropdown">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </li>
                            <!--Speech Icon-->
                            <li class="dropdown user-box">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="img-circle" src="../images/uploads/<?= $_SESSION['IMAGE_URL'] ?>" alt=""> <span class="user-info"> <?= $_SESSION['username']; ?></span> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li>
                                        <a href="#" id="profile_Page">
                                            <i class="fa fa-user"></i> My Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../qrc-mgr-setting-page/index-setting.php">
                                            <i class="fa fa-gear"></i> Settings
                                        </a>
                                    </li>											
                                    <li>
                                        <a href="#" id="logout_click">
                                            <i class="fa fa-power-off"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--Search Box-->
                        </ul>
                        <!-- END RIGHT SIDE DROPDOWN BUTTONS -->

                        <!-- BEGIN TOP MENU -->
                        <div class="collapse navbar-collapse top-collapse">
                            <!-- .nav -->
                            <ul class="nav navbar-left navbar-nav">
                                <li><a href="project-index.php">Home</a></li>

                            </ul><!-- /.nav -->
                        </div>
                        <!-- END TOP MENU -->

                    </div><!-- /.nav-top -->
                </nav><!-- /.navbar-top -->
                <!-- END TOP NAVIGATION -->


                <!-- BEGIN SIDE NAVIGATION -->				
                <nav class="navbar-side" role="navigation">							
                    <div class="navbar-collapse sidebar-collapse collapse">

                        <!-- BEGIN FIND MENU ITEM INPUT -->
                        <div class="media-search">	

                        </div>						
                        <!-- END FIND MENU ITEM INPUT -->

                        <ul id="side" class="nav navbar-nav side-nav">
                            <!-- BEGIN SIDE NAV MENU -->							
                            <!-- Navigation category -->
                            <li>
                                <h4>Navigation</h4> 								
                            </li>
                            <!-- END Navigation category -->

                            <li>
                                <a class="active" href="../qrc-mgr_project/project-index.php">
                                    <i class="fa fa-desktop"></i> Project (โครงการ)
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#po-inspection">
                                    <i class="fa fa-bar-chart-o"></i> PO / Inspection <span class="fa arrow"></span>
                                </a>
                                <ul class="collapse nav" id="po-inspection">
                                    <li>
                                        <a href="../qrc-mgr_po/po-index.php">
                                            <i class="fa fa-paper-plane"></i> PO
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../qrc-mgr_inspection/inspection-index.php">
                                            <i class="fa fa-puzzle-piece"></i> Inspection 
                                        </a>
                                    </li>										

                                </ul>
                            </li>
                            <li>
                                <a href="../qrc-mgr_assign/assign-index.php">
                                    <i class="fa fa-tasks"></i> Work Order (มอบหมาย)
                                </a>
                            </li>
                            <li class="panel">
                                <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#components">
                                    <i class="fa fa-bar-chart-o"></i> Staff (ทีมช่าง) <span class="fa arrow"></span>
                                </a>
                                <ul class="collapse nav" id="components">
                                    <li>
                                        <a href="../qrc-mgr_team/team-index.php">
                                            <i class="fa fa-angle-double-right"></i> Team (ทีม)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../qrc-mgr_member/member-index.php">
                                            <i class="fa fa-angle-double-right"></i> Member (ลูกทีม)
                                        </a>
                                    </li>
                                    <!-- ENDTHREE LEVEL MENU -->
                                </ul>
                            </li>
                            <li class="panel">
                                <a href="../qrc-mgr_billing/billing-index.php">
                                    <i class="fa fa-edit"></i> Billing (PO/PR/ใบเสร็จ)
                                </a>

                            </li>
                            <!-- END FORMS DROPDOWN -->
                            <li>
                                <h4>Reports</h4> 								
                            </li>
                            <!-- BEGIN CHARTS DROPDOWN -->
                            <li class="panel">
                                <a href="../qrc-mgr_reports/reports-index.php" >
                                    <i class="fa fa-sitemap"></i>Team Report (รายงาน)
                                </a>
                            </li>
                            <li class="panel">
                                <a href="../qrc-mgr_wo_report/wo_reports-index.php" >
                                    <i class="fa fa-sitemap"></i> WO Report (รายงาน)
                                </a>
                            </li>
                        </ul><!-- /.side-nav -->                                              
                    </div><!-- /.navbar-collapse -->
                </nav><!-- /.navbar-side -->
                <!-- END SIDE NAVIGATION -->


                <!-- BEGIN MAIN PAGE CONTENT -->
                <div id="page-wrapper">
                    <!-- BEGIN PAGE HEADING ROW -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- BEGIN BREADCRUMB -->
                            <div class="breadcrumbs">
                                <ul class="breadcrumb">
                                    <li>
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="active">Project(โครงการ)</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>Projects (โครงการ) <span class="sub-title">Content Overview</span></h1>									
                            </div>

                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                    <!-- END PAGE HEADING ROW -->					
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- START YOUR CONTENT HERE -->
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">

                                    <div class="row" id="upper_menu">

                                    </div>
                                    <button type="button" class="btn btn-primary" id="create_new_project_btn"><i class="fa fa-bar-chart-o"></i> Create Project</button>
                                    <!-- Server Info Charts .morris -->
                                    <div class="row" >
                                        <div class="col-lg-9">
                                            <div class="portlet" id="create_edit_panel">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> Create/Edit Projects (สร้าง/แก้ไข โครงการ)</h4>
                                                    </div>
                                                    <div class="portlet-widgets">

                                                        <a data-toggle="collapse" data-parent="#accordion" href="#m-charts"><i class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="m-charts" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="alert alert-danger" id="alert_inform">                                                            
                                                            <span>Change/Select a few things down and try submitting again.</span><br/>
                                                            <span id="alert_information"></span>
                                                        </div>
                                                        <div class="row" id="loading_ce_form">

                                                        </div>
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button id="save_create_panel"  class="btn btn-primary">Save (บันทึก) </button>
                                                        </div>
                                                        <div class="pull-left">
                                                            <button id="cancel_form" class="btn ">Cancel (ยกเลิก) <i class="fa fa-arrow-cross"></i></button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Server Info Charts .morris -->
                                    <div class="row" id="row_html">
                                        <div class="col-lg-2">
                                            <div class="portlet">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="glyphicon glyphicon-sort-by-attributes"></i> Search..</h4>
                                                    </div>
                                                    <div class="portlet-widgets">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#jq-spark" class=""><i class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="jq-spark" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="row" id="search_project">

                                                        </div>										
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button id="search_project_button" class="btn btn-inverse">Search <i class="fa fa-arrow-right icon-on-right"></i></button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">

                                            <div class="portlet">
                                                <div class="portlet-heading dark">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-list-ul"></i> All Project (โครงการทั้งหมด)</h4>
                                                    </div>
                                                    <div class="portlet-widgets">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#recent" class=""><i class="fa fa-chevron-down"></i></a>

                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="recent" class="panel-collapse collapse in">
                                                    <div class="portlet-body" class="row">
                                                        <div id="loading_project">

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- //col-lg-12 -->

                            </div>			
                            <!-- END YOUR CONTENT HERE -->

                        </div>
                        <!-- /#ek-layout-button -->	
                        <div class="qs-layout-menu">
                            <div class="btn btn-gray qs-setting-btn" id="qs-setting-btn">
                                <i class="fa fa-cog bigger-150 icon-only"></i>
                            </div>
                            <div class="qs-setting-box" id="qs-setting-box">

                                <div class="hidden-xs hidden-sm">
                                    <span class="bigger-120">Layout Options</span>

                                    <div class="hr hr-dotted hr-8"></div>
                                    <label>
                                        <input type="checkbox" class="tc" id="fixed-navbar" />
                                        <span id="#fixed-navbar" class="labels"> Fixed NavBar</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" class="tc" id="fixed-sidebar" />
                                        <span id="#fixed-sidebar" class="labels"> Fixed NavBar+SideBar</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" class="tc" id="sidebar-toggle" />
                                        <span id="#sidebar-toggle" class="labels"> Sidebar Toggle</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" class="tc" id="in-container" />
                                        <span id="#in-container" class="labels"> Inside<strong>.container</strong></span>
                                    </label>

                                    <div class="space-4"></div>
                                </div>

                                <span class="bigger-120">Color Options</span>

                                <div class="hr hr-dotted hr-8"></div>

                                <label>
                                    <input type="checkbox" class="tc" id="side-bar-color" />
                                    <span id="#side-bar-color" class="labels"> SideBar (Light)</span>
                                </label>

                                <ul>									
                                    <li><button class="btn" style="background-color:#d15050;" onclick="swapStyle('../assets/css/themes/style.css')"></button></li>
                                    <li><button class="btn" style="background-color:#86618f;" onclick="swapStyle('../assets/css/themes/style-1.css')"></button></li> 
                                    <li><button class="btn" style="background-color:#ba5d32;" onclick="swapStyle('../assets/css/themes/style-2.css')"></button></li>
                                    <li><button class="btn" style="background-color:#488075;" onclick="swapStyle('../assets/css/themes/style-3.css')"></button></li>
                                    <li><button class="btn" style="background-color:#4e72c2;" onclick="swapStyle('../assets/css/themes/style-4.css')"></button></li>
                                </ul>

                            </div>
                        </div>
                        <!-- /#ek-layout-button -->	
                    </div>
                    <!-- BEGIN FOOTER CONTENT -->		
                    <div class="footer">
                        <div class="footer-inner">
                            <!-- basics/footer -->
                            <div class="footer-content">
                                &copy; 2014 <a href="#">qrc-building</a>, All Rights Reserved.
                            </div>
                            <!-- /basics/footer -->
                        </div>
                    </div>
                    <button type="button" id="back-to-top" class="btn btn-primary btn-sm back-to-top">
                        <i class="fa fa-angle-double-up icon-only bigger-110"></i>
                    </button>
                    <!-- END FOOTER CONTENT -->


                </div><!-- /#page-wrapper -->	  
                <!-- END MAIN PAGE CONTENT -->
            </div>  
        </div>


        <!-- core JavaScript -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/plugins/pace/pace.min.js"></script>

        <!-- PAGE LEVEL PLUGINS JS -->
        <script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="../assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>	
        <script src="../assets/js/plugins/daterangepicker/moment.js"></script>
        <script src="../assets/js/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="../assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script src="../assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>
        <script src="../assets/js/plugins/jquery.toastmessage.js"></script>
        <!-- Themes Core Scripts -->	
        <script src="../assets/js/main.js"></script>

        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <script src="../assets/js/speech-commands.js"></script>
        <script src="../assets/js/plugins/gritter/jquery.gritter.min.js"></script>
        <script src="../assets/js/plugins/jquery.blockUI.js"></script>		

        <!-- initial page level scripts for examples -->
        <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
        <script src="../assets/js/home-page.init.js"></script>
        <script src="../assets/js/plugins/jquery-sparkline/jquery.sparkline.init.js"></script>
        <!-- qrc-mgr javascript init-->
        <script src="../assets/js/qrc-mgr_configuration.js"></script>
        <script type="text/javascript">
                                        var createOrEditState = "Create";
                                        $(document).ready(function () {
                                            updateSessionTimeOutCallBack();
                                            $("#alert_inform").hide();
                                            $("#create_edit_panel").hide();
                                            $.ajax({
                                                url: "project_table_result.php?search_condition=search_all",
                                                type: 'POST',
                                                beforeSend: function (xhr) {
                                                    $.blockUI({css: {
                                                            border: 'none',
                                                            padding: '15px',
                                                            backgroundColor: '#fff',
                                                            '-webkit-border-radius': '10px',
                                                            '-moz-border-radius': '10px',
                                                            opacity: .5,
                                                            color: '#fff'
                                                        }, message: '<img src="../images/gears.gif" width="120px" height="120px"/>'});
                                                },
                                                success: function (data, textStatus, jqXHR) {
                                                    $("#loading_project").html(data);
                                                    setTimeout($.unblockUI, 100);
                                                },
                                                statusCode: {
                                                    404: function () {
                                                        alert("page not found");
                                                    },
                                                    500: function () {
                                                        alert("Cannot load page with error");
                                                    }
                                                }
                                            });

                                            var jqxhr = $.post("project_search_page.php");
                                            jqxhr.success(function (data) {
                                                $("#search_project").html(data);
                                            });
                                            jqxhr.error(function () {
                                                alert("Cannot load page");
                                            });


                                            $("#cancel_form").click(function () {
                                                updateSessionTimeOutCallBack();
                                                $("#alert_inform").hide();
                                                $("#create_edit_panel").hide();
                                                $("#loading_ce_form").empty();
                                                $("#create_new_project_btn").show();

                                            });
                                            $("#create_new_project_btn").click(function () {
                                                updateSessionTimeOutCallBack();
                                                createOrEditState = "Create";
                                                $("#create_edit_panel").show("fast");
                                                var jqxhr = $.post("create-edit_form.php");
                                                jqxhr.success(function (cedata) {
                                                    $("#loading_ce_form").html(cedata);
                                                    $("#create_new_project_btn").hide();
                                                });
                                            });
                                            $("#search_project_button").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var projectCodeSearch = $("#project_code_search").val();
                                                var projectNameSearch = $("#project_name_search").val();
                                                var projectTypeSearch = $("#project_type_search").val();
                                                var projectStatusSearch = $("#project_status_search").val();
                                                var projectOwnerSearch = $("#project_owner_search").val();
                                                var projectCustomerSearch = $("#project_customer_search").val();
                                                var startSearchDate = $("#start_search_date").val();
                                                var endSearchDate = $("#end_search_date").val();
                                                var searchLimit = $("#project_limit_search").val();
                                                if (!$.trim(projectCodeSearch).length &&
                                                        !$.trim(projectNameSearch).length &&
                                                        !$.trim(projectTypeSearch).length &&
                                                        !$.trim(projectStatusSearch).length &&
                                                        !$.trim(projectOwnerSearch).length &&
                                                        !$.trim(projectCustomerSearch) &&
                                                        !$.trim(startSearchDate).length &&
                                                        !$.trim(endSearchDate).length &&
                                                        searchLimit == 100) {

                                                    $.ajax({
                                                        url: "project_table_result.php?search_condition=search_all",
                                                        type: 'POST',
                                                        beforeSend: function (xhr) {
                                                            $.blockUI({css: {
                                                                    border: 'none',
                                                                    padding: '15px',
                                                                    backgroundColor: '#fff',
                                                                    '-webkit-border-radius': '10px',
                                                                    '-moz-border-radius': '10px',
                                                                    opacity: .5,
                                                                    color: '#fff'
                                                                }, message: '<img src="../images/gears.gif" width="120px" height="120px"/>'});
                                                        },
                                                        success: function (data, textStatus, jqXHR) {
                                                            $("#loading_project").html(data);
                                                            setTimeout($.unblockUI, 100);
                                                        },
                                                        statusCode: {
                                                            404: function () {
                                                                alert("page not found");
                                                            },
                                                            500: function () {
                                                                alert("Cannot load page with error");
                                                            }
                                                        }
                                                    });
                                                } else {
                                                    if (startSearchDate != "" && endSearchDate == "") {
                                                        alert("Please enter end date");
                                                    }
                                                    else if (startSearchDate == "" && endSearchDate != "") {
                                                        alert("Please enter start date");
                                                    }
                                                    else {
                                                        var dateAr = endSearchDate.split('-');
                                                        endSearchDate = dateAr[0] + '-' + dateAr[1] + '-' + (parseInt(dateAr[2]) + 1);
                                                        $.ajax({
                                                            url: "project_table_result.php?search_condition=search_criteria&projectCodeSearch=" + projectCodeSearch + "&projectNameSearch=" + projectNameSearch + "&projectTypeSearch=" + projectTypeSearch + "&projectStatusSearch=" + projectStatusSearch + "&projectOwnerSearch=" + projectOwnerSearch + "&projectCustomerSearch=" + projectCustomerSearch + "&startSearchDate=" + startSearchDate + "&endSearchDate=" + endSearchDate + "&searchLimit=" + searchLimit,
                                                            type: 'POST',
                                                            beforeSend: function (xhr) {
                                                                $.blockUI({css: {
                                                                        border: 'none',
                                                                        padding: '15px',
                                                                        backgroundColor: '#fff',
                                                                        '-webkit-border-radius': '10px',
                                                                        '-moz-border-radius': '10px',
                                                                        opacity: .5,
                                                                        color: '#fff'
                                                                    }, message: '<img src="../images/gears.gif" width="120px" height="120px"/>'});
                                                            },
                                                            success: function (data, textStatus, jqXHR) {
                                                                $("#loading_project").html(data);
                                                                setTimeout($.unblockUI, 100);
                                                            },
                                                            statusCode: {
                                                                404: function () {
                                                                    alert("page not found");
                                                                },
                                                                500: function () {
                                                                    alert("Cannot load page with error");
                                                                }
                                                            }
                                                        });
                                                    }
                                                }
                                            });
                                            $("#save_create_panel").click(function () {
                                                updateSessionTimeOutCallBack();
                                                if ($("#project_name").val() == "") {
                                                    $("#alert_inform").show();
                                                    $("#alert_information").html("<br/>- Please enter project name");
                                                } else {
                                                    $("#alert_inform").hide();
                                                }
                                                if ($("#project_type_select").val() == 0) {
                                                    $("#alert_inform").show();
                                                    $("#alert_information").html("<br/>- Please enter project type");
                                                } else {
                                                    $("#alert_inform").hide();
                                                }

                                                if ($("#project_status_select").val() == 0) {
                                                    $("#alert_inform").show();
                                                    $("#alert_information").html("<br/>- Please enter project status");
                                                } else {
                                                    $("#alert_inform").hide();
                                                }

                                                if ($("#project_owner_select").val() == 0) {
                                                    $("#alert_inform").show();
                                                    $("#alert_information").html("<br/>- Please enter project owner");
                                                } else {
                                                    $("#alert_inform").hide();
                                                }
                                                if ($("#project_customer_select").val() == 0) {
                                                    $("#alert_inform").show();
                                                    $("#alert_information").html("<br/>- Please enter project customer");
                                                } else {
                                                    $("#alert_inform").hide();
                                                }
                                                if ($("#project_name").val() != "" && $("#project_type_select").val() != 0 && $("#project_status_select").val() != 0 && $("#project_owner_select").val() != 0 && $("#project_customer_select").val() != 0) {
                                                    $("#project_customer_div").removeClass("has-error");
                                                    $("#project_owner_div").removeClass("has-error");
                                                    $("#project_status_div").removeClass("has-error");
                                                    $("#project_type_div").removeClass("has-error");
                                                    $("#project_name_div").removeClass("has-error");
                                                    var data = "?project_code=" + $("#project_code").val()
                                                            + "&project_name=" + $("#project_name").val()
                                                            + "&project_type=" + $("#project_type_select").val()
                                                            + "&project_status=" + $("#project_status_select").val()
                                                            + "&project_owner=" + $("#project_owner_select").val()
                                                            + "&project_customer=" + $("#project_customer_select").val()
                                                            + "&project_manager=" + $("#project_manager").val()
                                                            + "&project_foreman=" + $("#project_foreman").val()
                                                            + "&supervisor_control=" + $("#supervisor_control").val()
                                                            + "&qa_inspectors=" + $("#qa_inspectors").val()
                                                            + "&address_location=" + $("#address_location").val()
                                                            + "&project_remark=" + $("#project_remark").val()
                                                            + "&team_owner=" + $("#team_owner").val();
                                                    $("#alert_inform").hide();
                                                    if (createOrEditState == "Create") {

                                                        var jqxhr = $.post("../model/SavingProject.php" + data);
                                                        jqxhr.success(function (reslut) {
                                                            if (reslut == 1) {
                                                                clearProjectInsertFields();
                                                                $("#create_edit_panel").hide();
                                                                $(".spinner").show();

                                                                $.ajax({
                                                                    url: "project_table_result.php?search_condition=search_all",
                                                                    type: 'POST',
                                                                    beforeSend: function (xhr) {
                                                                        $.blockUI({css: {
                                                                                border: 'none',
                                                                                padding: '15px',
                                                                                backgroundColor: '#fff',
                                                                                '-webkit-border-radius': '10px',
                                                                                '-moz-border-radius': '10px',
                                                                                opacity: .5,
                                                                                color: '#fff'
                                                                            }, message: '<img src="../images/gears.gif" width="120px" height="120px"/>'});
                                                                    },
                                                                    success: function (data, textStatus, jqXHR) {
                                                                        $("#loading_project").html(data);
                                                                        $("#create_new_project_btn").show();
                                                                        alert("บันทึกเรียบร้อยแล้ว");
                                                                        setTimeout($.unblockUI, 100);
                                                                    },
                                                                    statusCode: {
                                                                        404: function () {
                                                                            alert("page not found");
                                                                        },
                                                                        500: function () {
                                                                            alert("Cannot load page with error");
                                                                        }
                                                                    }
                                                                });
                                                            } else {
                                                                alert("ไม่สามารถบันทึกได้");
                                                            }
                                                        });
                                                        jqxhr.error(function (resultFail) {
                                                            alert("Cannot connect server with: " + resultFail);
                                                        });
                                                    } else {
                                                        if ($("#project_remark").val() == "") {
                                                            alert('กรุณาใส่ Remark');
                                                        } else {
                                                            var isUploadImage = $.post("../model/CheckProjectIMGUpload.php");
                                                            isUploadImage.success(function (resp) {
                                                                if (resp == "NO_DATA") {
                                                                    var jqxhr = $.post("../model/EditProject.php" + data);
                                                                    jqxhr.success(function (result) {
                                                                        if (result == 1) {
                                                                            clearProjectInsertFields();
                                                                            $("#create_edit_panel").hide();

                                                                            $.ajax({
                                                                                url: "project_table_result.php?search_condition=search_all",
                                                                                type: 'POST',
                                                                                beforeSend: function (xhr) {
                                                                                    $.blockUI({css: {
                                                                                            border: 'none',
                                                                                            padding: '15px',
                                                                                            backgroundColor: '#fff',
                                                                                            '-webkit-border-radius': '10px',
                                                                                            '-moz-border-radius': '10px',
                                                                                            opacity: .5,
                                                                                            color: '#fff'
                                                                                        }, message: '<img src="../images/gears.gif" width="120px" height="120px"/>'});
                                                                                },
                                                                                success: function (data, textStatus, jqXHR) {
                                                                                    $("#loading_project").html(data);
                                                                                    $("#create_new_project_btn").show();
                                                                                    alert('แก้ไขเรียบร้อยแล้ว');
                                                                                    createOrEditState = "Create";
                                                                                    setTimeout($.unblockUI, 100);
                                                                                },
                                                                                statusCode: {
                                                                                    404: function () {
                                                                                        alert("page not found");
                                                                                    },
                                                                                    500: function () {
                                                                                        alert("Cannot load page with error");
                                                                                    }
                                                                                }
                                                                            });
                                                                        } else {
                                                                            alert('ไม่สามารถแก้ไขได้');
                                                                        }
                                                                    });
                                                                    jqxhr.error(function (resultFail) {
                                                                        alert("Cannot connect server with: " + resultFail);
                                                                    });
                                                                } else {
                                                                    var jqxhr = $.post("../model/EditProject.php" + data + "&isDiffImg=diff");
                                                                    jqxhr.success(function (result) {
                                                                        if (result == 1) {
                                                                            clearProjectInsertFields();
                                                                            $("#create_edit_panel").hide();
                                                                            $.ajax({
                                                                                url: "project_table_result.php?search_condition=search_all",
                                                                                type: 'POST',
                                                                                beforeSend: function (xhr) {
                                                                                    $.blockUI({css: {
                                                                                            border: 'none',
                                                                                            padding: '15px',
                                                                                            backgroundColor: '#fff',
                                                                                            '-webkit-border-radius': '10px',
                                                                                            '-moz-border-radius': '10px',
                                                                                            opacity: .5,
                                                                                            color: '#fff'
                                                                                        }, message: '<img src="../images/gears.gif" width="120px" height="120px"/>'});
                                                                                },
                                                                                success: function (data, textStatus, jqXHR) {
                                                                                    $("#loading_project").html(data);
                                                                                    $("#create_new_project_btn").show();
                                                                                    alert('แก้ไขเรียบร้อยแล้ว');
                                                                                    createOrEditState = "Create";
                                                                                    setTimeout($.unblockUI, 100);
                                                                                },
                                                                                statusCode: {
                                                                                    404: function () {
                                                                                        alert("page not found");
                                                                                    },
                                                                                    500: function () {
                                                                                        alert("Cannot load page with error");
                                                                                    }
                                                                                }
                                                                            });
                                                                        } else {
                                                                            alert('ไม่สามารถแก้ไขได้');
                                                                        }
                                                                    });
                                                                    jqxhr.error(function (resultFail) {
                                                                        alert("Cannot connect server with: " + resultFail);
                                                                    });
                                                                }
                                                            });
                                                        }
                                                    }
                                                }
                                            });
                                        });
                                        function deleteProject(projectCode) {
                                            updateSessionTimeOutCallBack();
                                            if (confirm("Are you sure?"))
                                            {
                                                $(".spinner").show();
                                                var jqxhr = $.post("../model/DeleteProject.php?project_code=" + projectCode);
                                                jqxhr.success(function (data) {
                                                    if (data == 1) {
                                                        setTimeout(function ()
                                                        {
                                                            $("#loading_project").load("project_table_result.php?search_condition=search_all", function () {

                                                            });

                                                            alert("ลบข้อมูลเรียบร้อยแล้ว");
                                                        }
                                                        , 100);
                                                    } else {

                                                        alert("ไม่สามารถลบข้อมูลได้");
                                                    }
                                                });
                                                jqxhr.error(function (data) {
                                                    $().toastmessage('showWarningToast', "Cannot connect server with: " + data);
                                                });
                                            }
                                            else {
                                                e.preventDefault();
                                            }
                                        }
                                        function clearProjectInsertFields() {
                                            updateSessionTimeOutCallBack();
                                            $("#project_code").val("");
                                            $("#project_name").val("");
                                            $("#project_type_select").val("0");
                                            $("#project_status_select").val("0");
                                            $("#project_owner_select").val("0");
                                            $("#project_customer_select").val("0");
                                            $("#project_manager").val("");
                                            $("#project_foreman").val("");
                                            $("#supervisor_control").val("");
                                            $("#qa_inspectors").val("");
                                            $("#address_location").val("");
                                            $("#project_remark").val("");
                                            $("#team_owner").val("");
                                        }
                                        function loadProjectOrder(projectCode) {
                                            updateSessionTimeOutCallBack();
                                            window.location.replace("../qrc-mgr_assign/assign-wo-new.php?project_id=" + projectCode);
                                        }
                                        function editProject(projectCode) {
                                            updateSessionTimeOutCallBack();
                                            $("#create_new_project_btn").hide();
                                            createOrEditState = "Edit";
                                            $("#create_edit_panel").show();
                                            $("#loading_ce_form").load("create-edit_form.php?isEdit=Edit", function () {
                                                $("#spinnerCE").hide();
                                            });
                                            var millisecondsToWait = 100;
                                            setTimeout(function () {
                                                $.ajax({
                                                    url: "../model/GetAllProjectForEdit.php?project_code=" + projectCode,
                                                    type: 'POST',
                                                    beforeSend: function (xhr) {
                                                        $.blockUI({css: {
                                                                border: 'none',
                                                                padding: '15px',
                                                                backgroundColor: '#fff',
                                                                '-webkit-border-radius': '10px',
                                                                '-moz-border-radius': '10px',
                                                                opacity: .5,
                                                                color: '#fff'
                                                            }, message: '<img src="../images/gears.gif" width="120px" height="120px"/>'});
                                                    },
                                                    success: function (data, textStatus, jqXHR) {
                                                        obj = JSON.parse(data);
                                                        $("#projectCodeShowForEdit").html(obj.project_code);
                                                        $("#projectCode").hide();
                                                        $("#project_code").val(obj.project_code);
                                                        $("#project_name").val(obj.project_name);
                                                        $("#project_type_select").val(obj.project_type);
                                                        $("#project_status_select").val(obj.project_status);
                                                        $("#project_owner_select").val(obj.project_owner);
                                                        $("#project_customer_select").val(obj.customer_name);
                                                        $("#project_manager").val(obj.project_manager);
                                                        $("#project_foreman").val(obj.project_foreman);
                                                        $("#supervisor_control").val(obj.supervisor_control);
                                                        $("#team_owner").val(obj.team_owner);
                                                        $("#qa_inspectors").val(obj.quality_inspectors);
                                                        $("#project_remark").val(obj.remark);
                                                        $("#created_date").val(obj.created_date_time);
                                                        $("#last_update").val(obj.updated_date_time);
                                                        $("#address_location").val(obj.address_location);
                                                        var jqxhr = $.post("../model/GetProjectIMGByID.php?project_code=" + obj.project_code);
                                                        jqxhr.success(function (imgData) {
                                                            $("#edit_image").html(imgData);
                                                        });
                                                        setTimeout($.unblockUI, 100);
                                                    },
                                                    statusCode: {
                                                        404: function () {
                                                            alert("page not found");
                                                        },
                                                        500: function () {
                                                            alert("Cannot load page with error");
                                                        }
                                                    }
                                                });

                                            }, millisecondsToWait);
                                        }
                                        function delImage(imageID, po_id, img_name) {
                                            updateSessionTimeOutCallBack();
                                            if (confirm("Are you sure?"))
                                            {
                                                var jqxhr = $.post("../model/DelProjectIMGByID.php?imageID=" + imageID + "&img_name=" + img_name);
                                                jqxhr.success(function (data) {
                                                    if (data == 200) {
                                                        $("#edit_image").load("../model/GetProjectIMGByID.php?project_code=" + po_id, function () {

                                                        });
                                                    } else {
                                                        alert("ไม่สามารถลบรูปภาพได้: " + data);
                                                    }
                                                });
                                            }
                                            else
                                            {
                                                e.preventDefault();
                                            }

                                        }
        </script>
    </body>

</html>
