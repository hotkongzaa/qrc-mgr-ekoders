<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
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
                                    <img class="img-circle" src="../assets/images/user.jpg" alt=""> <span class="user-info"> <?= $_SESSION['username']; ?></span> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li>
                                        <a href="profile.html">
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
                                <li><a href="../qrc-mgr_project/project-index.php">Home</a></li>

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
                                <a href="../qrc-mgr_project/project-index.php">
                                    <i class="fa fa-desktop"></i> Project (โครงการ)
                                </a>
                            </li>
                            <li class="panel open">
                                <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#po-inspection">
                                    <i class="fa fa-bar-chart-o"></i> PO / Inspection <span class="fa arrow"></span>
                                </a>
                                <ul class="collapse nav" id="po-inspection">
                                    <li>
                                        <a class="active" href="po-index.php">
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
                            <!-- BEGIN FORMS DROPDOWN -->
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
                                    <li class="active">PO </li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>PO <span class="sub-title">Content Overview</span></h1>									
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
                                    <button type="button" class="btn btn-primary" id="create_new_po_btn"><i class="fa fa-bar-chart-o"></i> Create PO</button>
                                    <!-- Server Info Charts .morris -->
                                    <div class="row" >
                                        <div class="col-lg-10">
                                            <div class="portlet" id="create_edit_panel">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> Create/Edit PO (สร้าง/แก้ไข PO)</h4>
                                                    </div>
                                                    <div class="portlet-widgets">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#m-charts"><i class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="m-charts" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="alert alert-danger" id="alert_inform">                                                            
                                                            <span id="alert_information">Change a few things up and try submitting again.</span>
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
                                        <div class="col-lg-3">
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
                                                            <button id="search_po_button" class="btn btn-inverse">Search <i class="fa fa-arrow-right icon-on-right"></i></button>
                                                        </div>
                                                        <div class="pull-left">
                                                            <button id="reset_search" class="btn btn-primary"><i class="fa fa-arrow-left icon-on-left"></i> Reset </button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">

                                            <div class="portlet">
                                                <div class="portlet-heading dark">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-list-ul"></i> All PO (PO ทั้งหมด)</h4>
                                                    </div>
                                                    <div class="portlet-widgets">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#recent" class=""><i class="fa fa-chevron-down"></i></a>

                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="recent" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="note bg-success" id="alert_success_inform">
                                                            <h4><i class="fa fa-bell"></i> Success !!</h4>
                                                            <hr class="separator">
                                                            <span id="alert_success_information"><strong>Please enter/select require fields</strong></span>
                                                        </div>
                                                        <div id="loading_project" class="row">

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
        <input type="hidden" id="hideMemSkill"/>
        <input type="hidden" id="hidePoID"/>

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
        <!-- Themes Core Scripts -->	
        <script src="../assets/js/main.js"></script>

        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <script src="../assets/js/speech-commands.js"></script>
        <script src="../assets/js/plugins/gritter/jquery.gritter.min.js"></script>		

        <!-- initial page level scripts for examples -->
        <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
        <script src="../assets/js/home-page.init.js"></script>
        <script src="../assets/js/plugins/jquery-sparkline/jquery.sparkline.init.js"></script>
        <!-- qrc-mgr javascript init-->
        <script src="../assets/js/qrc-mgr_configuration.js"></script>



        <script type="text/javascript">
                                        var createOrEditState = "Save";
                                        $(document).ready(function () {

                                            $("#alert_inform").hide();
                                            $("#alert_information").html();
                                            $("#alert_success_inform").hide();
                                            $("#alert_success_information").html();
                                            $("#create_edit_panel").hide();
                                            $("#search_project").load("po_search_page.php");
                                            $("#loading_project").load("po_table_result.php?searchCondition=All");
                                            $("#create_new_po_btn").click(function () {
                                                $("#loading_ce_form").load("create-edit_form.php", function () {
                                                    $("#create_edit_panel").show();
                                                    $("#create_new_po_btn").hide();
                                                });
                                            });
                                            $("#reset_search").click(function () {
                                                $("#search_project").load("po_search_page.php");
                                                $("#loading_project").load("po_table_result.php?searchCondition=All");
                                            });
                                            $("#cancel_form").click(function () {
                                                $("#create_edit_panel").hide();
                                                $("#create_new_po_btn").show();
                                                $("#alert_inform").hide();
                                            });
                                            $("#search_po_button").click(function () {
                                                var project_id = $("#po_project_name_search").val();
                                                var document_no = $("#po_document_no_search").val();
                                                var po_no = $("#po_po_no_search").val();
                                                var po_owner = $("#po_owner_search").val();
                                                var po_sender = $("#po_sender_search").val();
                                                var po_issue_date = $("#po_issue_date_search").val();
                                                var po_order_type = $("#po_order_type_search").val();
                                                var po_status = $("#po_status_search").val();
                                                var po_end_issue_date = $("#po_end_issue_date_search").val();
                                                var po_is_retention = $("#po_is_retention").val();
                                                var data = "project_id=" + project_id +
                                                        "&document_no=" + document_no +
                                                        "&po_no=" + po_no +
                                                        "&po_owner=" + po_owner +
                                                        "&po_sender=" + po_sender +
                                                        "&po_issue_date=" + po_issue_date +
                                                        "&po_end_issue_date=" + po_end_issue_date +
                                                        "&po_status=" + po_status +
                                                        "&po_is_retention=" + po_is_retention +
                                                        "&po_order_type=" + po_order_type;
                                                if (project_id != 0 ||
                                                        $.trim(project_id).length != 0 ||
                                                        $.trim(document_no).length != 0 ||
                                                        $.trim(po_no).length != 0 ||
                                                        $.trim(po_owner).length != 0 ||
                                                        $.trim(po_sender).length != 0 ||
                                                        $.trim(po_issue_date).length != 0 ||
                                                        $.trim(po_end_issue_date).length != 0 ||
                                                        $.trim(po_is_retention) != 0 ||
                                                        po_order_type != 0 ||
                                                        po_status != 0) {
                                                    $("#loading_project").load("po_table_result.php?searchCondition=Condition&" + data, function () {
                                                    });
                                                } else {
                                                    $("#loading_project").load("po_table_result.php?searchCondition=search_all", function () {
                                                    });
                                                }
                                            });
                                            $("#save_create_panel").click(function () {
                                                var project_name = $("#po_project_name_form").val();
                                                var project_code = $("#po_project_code_form").val();
                                                var doc_no = $("#po_document_no_form").val();
                                                var po_no = $("#po_po_no_form").val();
                                                var home_plan = $("#po_home_plan_form").val();
                                                var home_plot = $("#po_home_plot_form").val();
                                                var po_owner = $("#po_owner_form").val();
                                                var po_sender = $("#po_sender_form").val();
                                                var issue_date = $("#po_issue_date_form").val();
                                                var order_type = $("#po_order_type_form").val();
                                                var quantity = $("#po_quantity_form").val();
                                                var plan_size = $("#po_plan_size_form").val();
                                                var unit_price = $("#po_unit_price_form").val();
                                                var amount = $("#po_amount_form").val();
                                                var vat7 = $("#po_vat_form").val();
                                                var supervisor = $("#po_project_supervisor_form").val();
                                                var project_manager = $("#po_project_manager_form").val();
                                                var projectforeman = $("#po_project_foreman_form").val();
                                                var project_remark = $("#remark_inform").val();
                                                var po_name = $("#po_name").val();
                                                var po_status = $("#project_order_status").val();
                                                var po_retention = $("#po_retention").val();
                                                var po_retention_reason = $("#po_retention_reason").val();

                                                var data = "project_name=" + project_name
                                                        + "&project_code=" + project_code
                                                        + "&doc_no=" + doc_no
                                                        + "&po_no=" + po_no
                                                        + "&home_plan=" + home_plan
                                                        + "&home_plot=" + home_plot
                                                        + "&po_owner=" + po_owner
                                                        + "&po_sender=" + po_sender
                                                        + "&issue_date=" + issue_date
                                                        + "&order_type=" + order_type
                                                        + "&quantity=" + quantity
                                                        + "&plan_size=" + plan_size
                                                        + "&unit_price=" + unit_price
                                                        + "&amount=" + amount
                                                        + "&vat7=" + vat7
                                                        + "&supervisor=" + supervisor
                                                        + "&project_manager=" + project_manager
                                                        + "&projectforeman=" + projectforeman
                                                        + "&project_remark=" + project_remark
                                                        + "&po_status=" + po_status
                                                        + "&po_retention=" + po_retention
                                                        + "&po_retention_reason=" + po_retention_reason
                                                        + "&po_name=" + po_name;
                                                if (createOrEditState == "Edit") {
                                                    if (project_name == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please select Project Name");
                                                    } else if (po_name == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please enter PO Name");
                                                    } else if (doc_no == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Document No");
                                                    } else if (po_no == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter PO No.");
                                                    } else if (home_plan == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Home Plan");
                                                    } else if (home_plot == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Home Plot");
                                                    } else if (issue_date == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please select Issue Date");
                                                    } else if (order_type == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please select Order Type");
                                                    } else if (quantity == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Quantity");
                                                    } else if (plan_size == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Plan Size");
                                                    } else if (unit_price == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Unit Price");
                                                    } else if (amount == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Amount");
                                                    } else if (vat7 == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Amount");
                                                    } else if ($("#remark_inform").val() == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Remark");
                                                    } else {
                                                        var isUploadImage = $.post("../model/CheckImageUpload.php");
                                                        isUploadImage.success(function (resp) {
                                                            if (resp == "NO_DATA") {
                                                                var po_id = $("#hideMemSkill").val();
                                                                var updateWithSameImage = $.post("../model/UpdatePoWithSameImage.php?" + data + "&po_id=" + po_id);
                                                                updateWithSameImage.success(function (updateResp) {
                                                                    if (updateResp == 1) {
                                                                        $("#loading_project").load("po_table_result.php?searchCondition=search_all", function () {
                                                                            $(".spinner").hide();
                                                                            $("#create_edit_panel").hide();
                                                                            $("#loading_ce_form").empty();
                                                                            $("html, body").animate({scrollTop: 0}, "fast");
                                                                            $("#create_new_po_btn").show();
                                                                            createOrEditState = "Save";
                                                                            $("#alert_success_inform").show();
                                                                            $("#alert_success_information").html("แก้ไขข้อมูลPOเรียบร้อยแล้ว");
                                                                            setTimeout(function () {
                                                                                $("#alert_success_inform").hide("fast");
                                                                                $("#alert_success_information").html("");
                                                                            }, 3000);
                                                                        });

                                                                    } else {
                                                                        alert("ไม่สามารถแก้ไขข้อมูลPOได้");
                                                                    }
                                                                });
                                                            } else {
                                                                var po_id = $("#hideMemSkill").val();
                                                                var updateWithDifferImage = $.post("../model/UpdatePoWithDifferImage.php?" + data + "&po_id=" + po_id);
                                                                updateWithDifferImage.success(function (updateResp) {
                                                                    if (updateResp == 1) {
                                                                        $("#loading_project").load("po_table_result.php?searchCondition=search_all", function () {
                                                                            $(".spinner").hide();
                                                                            $("#create_edit_panel").hide();
                                                                            $("#loading_ce_form").empty();
                                                                            $("html, body").animate({scrollTop: 0}, "fast");
                                                                            createOrEditState = "Save";
                                                                            $("#create_new_po_btn").show();
                                                                            $("#alert_success_inform").show();
                                                                            $("#alert_success_information").html("แก้ไขข้อมูลPOเรียบร้อยแล้ว");
                                                                            setTimeout(function () {
                                                                                $("#alert_success_inform").hide("fast");
                                                                                $("#alert_success_information").html("");
                                                                            }, 3000);
                                                                        });

                                                                    } else {
                                                                        alert("ไม่สามารถแก้ไขข้อมูลPOได้");
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }
                                                } else {
                                                    if (project_name == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please select Project Name");

                                                    } else if (po_name == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please enter PO Name");

                                                    } else if (doc_no == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Document No");

                                                    } else if (po_no == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter PO No.");

                                                    } else if (home_plan == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Home Plan");

                                                    } else if (home_plot == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Home Plot");

                                                    } else if (issue_date == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please select Issue Date");

                                                    } else if (order_type == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please select Order Type");

                                                    } else if (quantity == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Quantity");

                                                    } else if (plan_size == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Plan Size");

                                                    } else if (unit_price == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Unit Price");

                                                    } else if (amount == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Amount");

                                                    } else if (vat7 == "") {
                                                        $("html, body").animate({scrollTop: 0}, "fast");
                                                        $("#alert_inform").show();
                                                        $("#alert_information").html("- Please Enter Amount");

                                                    } else {
                                                        var jqxhr = $.post("../model/SavingPo.php?" + data);
                                                        jqxhr.success(function (data) {
                                                            $("html, body").animate({scrollTop: 0}, "fast");
                                                            $("#alert_inform").hide();
                                                            $("#alert_information").html("");
                                                            if (data == 1) {
                                                                $("#loading_project").load("po_table_result.php?searchCondition=search_all", function () {
                                                                    $(".spinner").hide();
                                                                    $("#create_edit_panel").hide();
                                                                    $("#loading_ce_form").empty();
                                                                    $("#create_new_po_btn").show();
                                                                    $("html, body").animate({scrollTop: 0}, "fast");
                                                                    $("#alert_success_inform").show();
                                                                    $("#alert_success_information").html("บันทึกข้อมูลPOเรียบร้อยแล้ว");
                                                                    setTimeout(function () {
                                                                        $("#alert_success_inform").hide("fast");
                                                                        $("#alert_success_information").html("");
                                                                    }, 3000);
                                                                });

                                                            } else {
                                                                alert("ไม่สามารถบันทึกข้อมูลPOได้");
                                                            }
                                                        });
                                                    }
                                                }
                                            });
                                        });
                                        function loadOrder(projectCode, poCode) {
                                            window.location.replace("../qrc-mgr_assign/assign-wo-new.php?project_id=" + projectCode + "&poCode=" + poCode);
                                        }
                                        function editPO(po_id) {
                                            $("#create_edit_panel").show();
                                            $("#spinnerCE").show();
                                            var jqxhr = $.post("create-edit_form.php?isEdit=Edit");
                                            jqxhr.success(function (cedata) {
                                                $("#loading_ce_form").html(cedata);
                                                $("#spinnerCE").hide();
                                                $('html,body').animate({scrollTop: $('#create_edit_panel').offset().top}, 'slow');
                                            });
                                            jqxhr.error(function (result) {
                                                $().toastmessage('showWarningToast', "Cannot connect server with: " + result);
                                            });
                                            var millisecondsToWait = 500;
                                            setTimeout(function () {
                                                createOrEditState = "Edit";
                                                var jqxhr = $.post("../model/GetPoByIDForEdit.php?po_id=" + po_id);
                                                jqxhr.success(function (data) {
                                                    $("#uploadpart").show();
                                                    obj = JSON.parse(data);
                                                    $("#hideMemSkill").val(po_id);
                                                    $("#uploadWarning").append("Leave empty for no change");
                                                    $("#po_project_name_form").val(obj.PO_PROJECT_NAME);
                                                    $("#po_project_code_form").val(obj.PO_PROJECT_CODE);
                                                    $("#po_document_no_form").val(obj.PO_DOCUMENT_NO);
                                                    $("#po_po_no_form").val(obj.PO_PO_NO);
                                                    $("#po_home_plan_form").val(obj.PO_HOME_PLAN);
                                                    $("#po_home_plot_form").val(obj.PO_HOME_PLOT);
                                                    $("#po_owner_form").val(obj.PO_OWNER);
                                                    $("#po_sender_form").val(obj.PO_SENDER);
                                                    $("#po_issue_date_form").val(obj.PO_ISSUE_DATE);
                                                    $("#po_order_type_form").val(obj.order_type_name);
                                                    $("#po_quantity_form").val(obj.PO_QUANTITY);
                                                    $("#po_plan_size_form").val(obj.PO_PLAN_SIZE);
                                                    $("#po_unit_price_form").val(obj.PO_UNIT_PRICE);
                                                    $("#po_amount_form").val(obj.PO_AMOUNT);
                                                    $("#po_vat_form").val(obj.PO_VAT);
                                                    $("#po_project_supervisor_form").val(obj.PO_SUPERVISOR_ID);
                                                    $("#po_project_manager_form").val(obj.PO_PROJECT_MANAGER_ID);
                                                    $("#po_project_foreman_form").val(obj.PO_PROJECT_FOREMAN_ID);
                                                    $("#remark_inform").val(obj.PO_REMARK);
                                                    $("#po_name").val(obj.PO_NAME);
                                                    $("#project_order_status").val(obj.PO_STATUS);
                                                    $("#po_retention").val(obj.PO_RETENTION);
                                                    $("#po_retention_reason").val(obj.PO_RETENTION_REASON);
                                                    $("#hidePoID").val(po_id);
                                                    var jqxhr = $.post("../model/GetPOIMGByID.php?po_id=" + po_id);
                                                    jqxhr.success(function (imgData) {
                                                        $("#edit_image").html(imgData);
                                                    });
                                                });
                                                jqxhr.error(function (data) {
                                                    window.location.replace("error.php?error_msg=" + data);
                                                });
                                            }, millisecondsToWait);
                                        }
                                        function deletePO(PO_ID) {
                                            if (confirm("Are you sure?"))
                                            {
                                                var jqxhr = $.post("../model/DeletePO.php?PO_ID=" + PO_ID);
                                                jqxhr.success(function (data) {

                                                    setTimeout(function ()
                                                    {
                                                        if (data == 1) {
                                                            $("#loading_project").load("po_table_result.php?searchCondition=search_all", function () {
                                                                $(".spinner").hide();
                                                                $("#create_edit_panel").hide();
                                                                $("#loading_ce_form").empty();
                                                                $("html, body").animate({scrollTop: 0}, "fast");

                                                                $("#alert_success_inform").show();
                                                                $("#alert_success_information").html("ลบข้อมูลPOเรียบร้อยแล้ว");
                                                                setTimeout(function () {
                                                                    $("#alert_success_inform").hide("fast");
                                                                    $("#alert_success_information").html("");
                                                                }, 3000);

                                                            });

                                                        } else {
                                                            alert("ไม่สามารถลบข้อมูลPOได้");
                                                        }
                                                    }
                                                    , 500);
                                                });
                                                jqxhr.error(function (data) {
                                                    window.location.replace("error.php?error_msg=" + data);
                                                });
                                            }
                                            else
                                            {
                                                e.preventDefault();
                                            }
                                        }
                                        function delImage(imageID, po_id, img_name) {
                                            if (confirm("Are you sure?"))
                                            {
                                                var jqxhr = $.post("../model/DelPoImageByID.php?imageID=" + imageID + "&img_name=" + img_name);
                                                jqxhr.success(function (data) {
                                                    if (data == 200) {
                                                        $("#edit_image").load("../model/GetPOIMGByID.php?po_id=" + po_id, function () {

                                                        });
                                                    } else {
//                            $().toastmessage('showWarningToast', "ไม่สามารถลบรูปภาพได้");
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
