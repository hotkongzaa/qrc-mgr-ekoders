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
        <!--<link rel="stylesheet" type="text/css" href="assets/css/plugins/gritter/jquery.gritter.css" />-->	
        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <!--<link rel="stylesheet" type="text/css" href="../assets/css/plugins/gritter/jquery.gritter.css" />-->

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
                                <a href="../qrc-mgr_project/project-index.php">
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

                            <!-- END COMPONENTS DROPDOWN -->							
                            <li>
                                <a href="../qrc-mgr_assign/assign-index.php">
                                    <i class="fa fa-tasks"></i> Work Order (มอบหมาย)
                                </a>
                            </li>
                            <!-- BEGIN COMPONENTS DROPDOWN -->
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
                                <a class="active" href="../qrc-mgr_billing/billing-index.php">
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
                                    <li class="active">Billing (ใบเสร็จ)</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>Billing (ใบเสร็จ) <span class="sub-title">Content Overview</span></h1>									
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
                                    <button type="button" class="btn btn-primary" id="create_new_billing_btn"><i class="fa fa-bar-chart-o"></i> Create Billing</button>
                                    <!-- Server Info Charts .morris -->
                                    <div class="row" >
                                        <div class="col-lg-9">
                                            <div class="portlet" id="create_edit_panel">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> Generate Billing</h4>
                                                    </div>
                                                    <div class="portlet-widgets">

                                                        <a data-toggle="collapse" data-parent="#accordion" href="#m-charts"><i class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="m-charts" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="row" id="loading_ce_form">

                                                        </div>
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button id="create_billing"  class="btn btn-primary">Generate </button>
                                                        </div>
                                                        <div class="pull-left">
                                                            <button id="close_search_panel" class="btn ">Close (ปิด) <i class="fa fa-arrow-cross"></i></button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="portlet" id="show_temp_tble">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> View/Edit Invoice</h4>
                                                    </div>
                                                    <div class="portlet-widgets">

                                                        <a data-toggle="collapse" data-parent="#accordion" href="#m-charts"><i class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="m-charts" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="row" id="loading_viewedit_table">

                                                        </div>
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button type="button" class="btn btn-primary " style="width: 150px" data-toggle="dropdown" id="create_invoice_press">Download Invoice</button>
                                                        </div>
                                                        <div class="pull-left">
                                                            <button type="button" id="close_viewedit_tbl" class="btn btn-default" style="width: 100px" data-toggle="dropdown">Close (ปิด)</button>
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
                                                        <form id="form_search">
                                                            <div>
                                                                <select class="form-control" id="invoice_id_search" name="invoice_id_search">
                                                                    <option value="">-- Select Invoice --</option>
                                                                    <?php
                                                                    $sqlSelectProjectType = "SELECT * FROM QRC_INVOICE;";
                                                                    $resultSet = mysql_query($sqlSelectProjectType);
                                                                    while ($row = mysql_fetch_array($resultSet)) {
                                                                        echo '<option value="' . $row['inv_id'] . '">' . $row['inv_id'] . '</option>';
                                                                    }
                                                                    ?>                                           
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <select class="form-control" id="customer_search" name="customer_search">
                                                                    <option value="">-- Select Customer Name --</option>
                                                                    <?php
                                                                    $sqlSelectProjectType = "SELECT * FROM QRC_CUSTOMER_NAME;";
                                                                    $resultSet = mysql_query($sqlSelectProjectType);
                                                                    while ($row = mysql_fetch_array($resultSet)) {
                                                                        echo '<option value="' . $row['customer_id'] . '">' . $row['customer_name'] . '</option>';
                                                                    }
                                                                    ?>                                           
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <select class="form-control" id="invoice_status_search" name="invoice_status_search">
                                                                    <option value="">-- Select Invoice Status --</option>
                                                                    <?php
                                                                    $sqlSelectProjectType = "SELECT * FROM QRC_INVOICE_STATUS;";
                                                                    $resultSet = mysql_query($sqlSelectProjectType);
                                                                    while ($row = mysql_fetch_array($resultSet)) {
                                                                        echo '<option value="' . $row['inv_staus_id'] . '">' . $row['inv_staus_name'] . '</option>';
                                                                    }
                                                                    ?>                                           
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <input type="text" class="form-control search_date" id="start_search_date" name="start_search_date" data-date-format="yyyy-mm-dd" placeholder="Start date">
                                                            </div>
                                                            <div>
                                                                <input type="text" class="form-control search_date" id="end_search_date" name="end_search_date" data-date-format="yyyy-mm-dd" placeholder="End date">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button id="search_button" class="btn btn-inverse">Search <i class="fa fa-arrow-right icon-on-right"></i></button>
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
                                                        <h4><i class="fa fa-list-ul"></i> All Generate Billing</h4>
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


        <!-- Themes Core Scripts -->	
        <script src="../assets/js/main.js"></script>

        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <script src="../assets/js/speech-commands.js"></script>
        <!--<script src="../assets/js/plugins/gritter/jquery.gritter.min.js"></script>-->		

        <!-- initial page level scripts for examples -->
        <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
        <script src="../assets/js/home-page.init.js"></script>
        <script src="../assets/js/plugins/jquery-sparkline/jquery.sparkline.init.js"></script>
        <!-- qrc-mgr javascript init-->
        <script src="../assets/js/qrc-mgr_configuration.js"></script>
        <!--<script src="../assets/js/jquery.blockUI.js"></script>-->
        <style type="text/css">
            #overlay {
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                right: 0;
                background: #000;
                opacity: 0.8;
                filter: alpha(opacity=80);
            }
            #loading {
                width: 50px;
                height: 57px;
                position: absolute;
                top: 50%;
                left: 50%;
                margin: -28px 0 0 -25px;
            }
        </style>

        <script type="text/javascript">
                                        var statusNa = 1;
                                        var isCreate = 1;
                                        var create_type = "";
                                        var create_receipt = "";
                                        var create_progressive = "";
                                        $(document).ready(function () {
                                            updateSessionTimeOutCallBack();
                                            $(".search_date").datepicker();
                                            $("#show_temp_tble").hide();
                                            $("#create_edit_panel").hide();
                                            $("#loading_project").load("billing_table_result.php?search_condition=All");
                                            $("#create_new_billing_btn").click(function () {
                                                updateSessionTimeOutCallBack();
                                                $("#loading_ce_form").load("create-edit_form.php", function () {
                                                    $("#create_edit_panel").show("fast");
                                                    $("#create_new_billing_btn").hide("fast");
                                                });
                                            });
                                            $("#close_search_panel").click(function () {
                                                updateSessionTimeOutCallBack();
                                                $("#create_edit_panel").hide("fast");
                                                $("#create_new_billing_btn").show("fast");
                                            });
                                            $("#close_viewedit_tbl").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var jqxhr = $.post("../model/com.qrc.mgr.controller/DeleteInvoiceDetailTemp.php");
                                                jqxhr.success(function (resp) {
                                                    if (resp == 1) {
                                                        $("#loading_viewedit_table").empty();
                                                        $("#show_temp_tble").hide();
                                                    } else {
                                                        alert(resp + "");
                                                    }
                                                });

                                            });
                                            $("#search_button").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var searchInfo = $("#form_search").serialize();
                                                $("#loading_project").load("billing_table_result.php?search_condition=Condition&" + searchInfo);
                                            });
                                            $("#create_billing").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var data = "";
                                                $("#create_invoice_press").prop('disabled', false);
                                                $("#create_receipt_press").prop('disabled', true);
                                                $("#create_progressive_press").prop('disabled', true);

                                                if ($("#inv_status").val() == "") {
                                                    //inv_status always open
                                                    data = "inv_code=" + $("#inv_code").val() + "&" +
                                                            "customer_id=" + $("#customer_id").val() + "&" +
                                                            "multi_sel_project_name=" + $("#multi_sel_project_name").val() + "&" +
                                                            "wo_status=" + $("#wo_status").val() + "&" +
                                                            "order_type_id=" + $("#order_type_id").val() + "&" +
                                                            "create_type=" + create_type + "&" +
                                                            "inv_status=44002&" +
                                                            "create_receive=" + create_receipt + "&" +
                                                            "create_progressive=" + create_progressive + "&" +
                                                            "start_date=" + $("#start_date").val() + "&" +
                                                            "end_date=" + $("#end_date").val() + "&" +
                                                            "isCreate=" + isCreate;
                                                } else {
                                                    data = "inv_code=" + $("#inv_code").val() + "&" +
                                                            "customer_id=" + $("#customer_id").val() + "&" +
                                                            "multi_sel_project_name=" + $("#multi_sel_project_name").val() + "&" +
                                                            "wo_status=" + $("#wo_status").val() + "&" +
                                                            "order_type_id=" + $("#order_type_id").val() + "&" +
                                                            "create_type=" + create_type + "&" +
                                                            "inv_status=" + $("#inv_status").val() + "&" +
                                                            "create_receive=" + create_receipt + "&" +
                                                            "create_progressive=" + create_progressive + "&" +
                                                            "start_date=" + $("#start_date").val() + "&" +
                                                            "end_date=" + $("#end_date").val() + "&" +
                                                            "isCreate=" + isCreate;
                                                }
                                                var jqxhr = $.post("../model/com.qrc.mgr.controller/SaveBillingHeader.php?" + data);
                                                jqxhr.success(function (resp) {
                                                    if (resp == 1) {
                                                        $("#loading_viewedit_table").load("billing_page_generate.php", function () {
                                                            $("#show_temp_tble").show();
                                                            $('html,body').animate({scrollTop: $('#loading_viewedit_table').offset().top}, 'slow');
                                                        });
                                                    } else if (resp == "") {
                                                        alert("No Data Found");
                                                        $("#loading_viewedit_table").empty();
                                                        $("#show_temp_tble").hide();
                                                    } else if (resp == "406") {
                                                        alert("Please select project");
                                                        $("#loading_viewedit_table").empty();
                                                        $("#show_temp_tble").hide();
                                                    } else {
                                                        alert(resp);
                                                    }
                                                });



                                            });
                                            $("#create_invoice_press").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var over = '<div id="overlay">' +
                                                        '<img id="loading" src="http://bit.ly/pMtW1K">' +
                                                        '</div>';
                                                $(over).appendTo('body');
                                                $('html,body').animate({scrollTop: $('#overlay').offset().top}, 'slow');
//                    $("html, body").animate({scrollTop: 0}, "slow");
                                                var data = "";
                                                if (statusNa == 1) {
                                                    var jqxhr = $.post("../model/com.qrc.mgr.controller/VerifyNumberOfRow.php");
                                                    jqxhr.success(function (responseCheck) {
                                                        if (responseCheck == "200") {
                                                            var custId = $("#customer_id").val();
                                                            var inv_type = $("input[name=create_type]:checked").val();
                                                            var inv_code = $("#inv_code").val();
                                                            if ($("#inv_status").val() == "") {
                                                                data = "inv_code=" + $("#inv_code").val() + "&" +
                                                                        "customer_id=" + $("#customer_id").val() + "&" +
                                                                        "multi_sel_project_name=" + $("#multi_sel_project_name").val() + "&" +
                                                                        "wo_status=" + $("#wo_status").val() + "&" +
                                                                        "order_type_id=" + $("#order_type_id").val() + "&" +
                                                                        "inv_status=44002&" +
                                                                        "start_date=" + $("#start_date").val() + "&" +
                                                                        "end_date=" + $("#end_date").val();
                                                            } else {
                                                                data = "inv_code=" + $("#inv_code").val() + "&" +
                                                                        "customer_id=" + $("#customer_id").val() + "&" +
                                                                        "multi_sel_project_name=" + $("#multi_sel_project_name").val() + "&" +
                                                                        "wo_status=" + $("#wo_status").val() + "&" +
                                                                        "order_type_id=" + $("#order_type_id").val() + "&" +
                                                                        "inv_status=" + $("#inv_status").val() + "&" +
                                                                        "start_date=" + $("#start_date").val() + "&" +
                                                                        "end_date=" + $("#end_date").val();
                                                            }

                                                            var jqxhr = $.post("../model/com.qrc.mgr.controller/ManageBillingFile.php?" + data);
                                                            jqxhr.success(function (response) {
                                                                if (response == "200") {
                                                                    $("#loading_project").load("billing_table_result.php", function () {
                                                                        $(".spinner").hide();
                                                                        $("#create_edit_panel").hide();
                                                                        $("#show_temp_tble").hide();
                                                                        $("#create_new_billing_btn").show("fast");
                                                                        $('#overlay').remove();
                                                                        //window.location = 'billing_page_generate_download.php?customer_id=' + custId + "&inv_type=" + inv_type + "&inv_code=" + inv_code;
                                                                        window.location = "billing-index.php";
                                                                    });
                                                                } else {
                                                                    alert("ไม่สามารถสร้างใบเสร็จได้ : " + response);
                                                                }
                                                            });
                                                        } else {
                                                            alert(responseCheck);
                                                        }
                                                    });
                                                }
                                            });
                                        });
                                        function deleteBilling(inv_id) {
                                            updateSessionTimeOutCallBack();
                                            if (confirm("Are you sure?"))
                                            {
                                                // blockPage();
                                                var jqxhr = $.post("../model/DeleteInvoice.php?inv_id=" + inv_id);
                                                jqxhr.success(function (data) {
                                                    if (data == 1) {
                                                        $("#loading_project").load("billing_table_result.php", function () {
                                                            $("#create_edit_panel").hide();
                                                            $("#loading_ce_form").empty();
                                                            window.location = "billing-index.php";
                                                        });

                                                    } else {

                                                        alert("ไม่สามารถลบข้อมูลใบเสร็จได้");
                                                    }
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
                                        function deleteSubLevel(tempDetailID) {
                                            updateSessionTimeOutCallBack();
                                            var jqxhr = $.post("../model/com.qrc.mgr.controller/DeleteSubInvoiceService.php?tempDetailId=" + tempDetailID);
                                            jqxhr.success(function (data) {
                                                if (data == 200) {

                                                    alert("ลบข้อมูลใบเสร็จเรียบร้อยแล้ว");

                                                    $("#loading_viewedit_table").load("billing_page_generate.php", function () {
                                                        $("#show_temp_tble").show();
                                                        $('html,body').animate({scrollTop: $('#loading_viewedit_table').offset().top}, 'fast');
                                                    });
                                                } else {

                                                    alert("ไม่สามารถลบข้อมูลใบเสร็จได้");
                                                }
                                            });
                                            jqxhr.error(function () {
                                                alert("ไม่สามารถติดต่อกับ Server ได้");
                                            });
                                        }
                                        function deleteFirstLevel(tempDetailID) {
                                            updateSessionTimeOutCallBack();
                                            var jqxhr = $.post("../model/com.qrc.mgr.controller/DeleteFirstInvoiceService.php?tempDetailId=" + tempDetailID);
                                            jqxhr.success(function (data) {
                                                if (data == 200) {
                                                    alert("ลบข้อมูลใบเสร็จเรียบร้อยแล้ว");
                                                    $("#loading_viewedit_table").load("billing_page_generate.php", function () {
                                                        $("#show_temp_tble").show();
                                                        $('html,body').animate({scrollTop: $('#loading_viewedit_table').offset().top}, 'slow');
                                                    });
                                                } else {
                                                    alert("ไม่สามารถลบข้อมูลใบเสร็จได้");
                                                }
                                            });
                                            jqxhr.error(function () {
                                                alert("ไม่สามารถติดต่อกับ Server ได้");
                                            });
                                        }
                                        function generateBilling(invCode, custId, inv_type) {
                                            updateSessionTimeOutCallBack();
                                            var check = invCode.split("-")[1].substring(0, 3);
                                            if (check == "INV") {
                                                var jqxhr = $.post("../model/com.qrc.mgr.controller/SavingToInvoiceDetail.php?inv_code=" + invCode);
                                                jqxhr.success(function (respInv) {
                                                    if (respInv == 0) {
//                            if (confirm("This invoice has been generated, Continue to generate this invoice?") == true) {
                                                        window.location = 'billing_page_generate_download.php?customer_id=' + custId + "&inv_type=" + inv_type + "&inv_code=" + invCode;
//                            }
                                                    }
                                                });

                                            }
                                            if (check == "REP") {
//                    if (confirm("This receipt has been generated, Continue to generate this receipt?") == true) {
                                                window.location = 'receipt_page_generate_download.php?customer_id=' + custId + "&inv_type=" + inv_type + "&inv_code=" + invCode;
//                    }
                                            }
                                        }
                                        function generateProgressive(invCode, custId, inv_type) {
//                if (confirm("This progressive has been generated, Continue to generate this progressive?") == true) {
                                            window.location = 'pgs_page_generate_download.php?customer_id=' + custId + "&inv_type=" + inv_type + "&inv_code=" + invCode;
//                }
                                        }
        </script>
    </body>

</html>
