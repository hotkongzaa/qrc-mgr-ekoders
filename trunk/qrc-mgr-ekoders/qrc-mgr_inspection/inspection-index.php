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
                                        <a  href="../qrc-mgr_po/po-index.php">
                                            <i class="fa fa-paper-plane"></i> PO
                                        </a>
                                    </li>
                                    <li>
                                        <a class="active" href="inspection-index.php">
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
                                        <a href="../qrc-mgr_project/project-index.php">Home</a>
                                    </li>
                                    <li class="active">Inspection (ใบตรวจรับงาน) </li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>Inspection (ใบตรวจรับงาน) <span class="sub-title">Content Overview</span></h1>									
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
                                    <button type="button" class="btn btn-primary" id="create_new_ins_btn"><i class="fa fa-bar-chart-o"></i> Create Inspection</button>
                                    <!-- Server Info Charts .morris -->
                                    <div class="row" >
                                        <div class="col-lg-10">
                                            <div class="portlet" id="create_edit_panel">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> Create/Edit Inspection (สร้าง/แก้ไข ใบตรวจรับงาน)</h4>
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
                                                            <button id="search_ins_button" class="btn btn-inverse">Search <i class="fa fa-arrow-right icon-on-right"></i></button>
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
                                                        <h4><i class="fa fa-list-ul"></i> All Inspection (ใบตรวจรับงานทั้งหมด)</h4>
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
        <input type="hidden" id="hideMemSkill"/>
        <input type="hidden" id="insID"/>

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
        <script src="../assets/js/md5.js"></script>
        <!-- qrc-mgr javascript init-->
        <script src="../assets/js/qrc-mgr_configuration.js"></script>



        <script type="text/javascript">
                                        var createOrEditState = "Save";
                                        $(document).ready(function () {
                                            updateSessionTimeOutCallBack();
                                            $(".search_date").datepicker();
                                            $("#create_edit_panel").hide();
                                            $("#loading_project").load("inspection_table_result.php");
                                            $("#search_project").load("inspection_search_page.php");
                                            $("#create_new_ins_btn").click(function () {
                                                updateSessionTimeOutCallBack();
                                                createOrEditState = "Save";
                                                $("#loading_ce_form").load("create-edit_form.php", function () {
                                                    $("#create_edit_panel").show("fast");
                                                    $("#create_new_ins_btn").hide("fast");
                                                });
                                            });
                                            $("#reset_search").click(function () {
                                                updateSessionTimeOutCallBack();
                                                $("#search_project").load("inspection_search_page.php");
                                                $("#loading_project").load("inspection_table_result.php");
                                            });
                                            $("#cancel_form").click(function () {
                                                updateSessionTimeOutCallBack();
                                                $("#create_edit_panel").hide("fast");
                                                $("#create_new_ins_btn").show("fast");
                                            });
                                            $("#search_ins_button").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var ins_project_name = $("#inspection_project_name_search").val();
                                                var ins_document_no = $("#inspection_document_no_search").val();
                                                var ins_ins_no = $("#inspection_no_search").val();
                                                var ins_date = $("#inspection_date_search").val();
                                                var ins_ins_ordertype = $("#inspection_order_type_search").val();
                                                var data = "project_name=" + ins_project_name +
                                                        "&ins_document_no=" + ins_document_no +
                                                        "&ins_ins_no=" + ins_ins_no +
                                                        "&ins_date=" + ins_date +
                                                        "&ins_ins_ordertype=" + ins_ins_ordertype;
                                                if (ins_project_name !== 0 ||
                                                        $.trim(ins_document_no).length !== 0 ||
                                                        $.trim(ins_ins_no).length !== 0 ||
                                                        $.trim(ins_date).length !== 0 ||
                                                        ins_ins_ordertype !== 0) {
                                                    var inspection_condition_condition = CryptoJS.MD5("Condition").toString();
                                                    $("#loading_project").load("inspection_table_result.php?searchCondition=" + inspection_condition_condition + "&" + data, function () {
                                                        //$(".spinner").hide();
                                                        $('html,body').animate({scrollTop: $('#inspection_table_result').offset().top}, 'slow');
                                                    });
                                                } else {
                                                    $("#loading_project").load("inspection_table_result.php?searchCondition=search_all", function () {
                                                        //$(".spinner").hide();
                                                        $('html,body').animate({scrollTop: $('#inspection_table_result').offset().top}, 'slow');
                                                    });
                                                }
                                            });
                                            $("#save_create_panel").click(function () {
                                                updateSessionTimeOutCallBack();
                                                if ($("#inspection_project_name_form").val() == "") {
//                        $().toastmessage('showWarningToast', "Please select Project name (ชื่อโครงการ)");
                                                    alert("Please select Project name (ชื่อโครงการ)");
                                                } else if ($("#inspection_document_no_form").val() == 0) {
//                        $().toastmessage('showWarningToast', "Please select Document No. (เลขที่)");
                                                    alert("Please select Document No. (เลขที่)");
                                                } else if ($("#inspection_no_form").val() == "") {
//                        $().toastmessage('showWarningToast', "Please select Inspection No. (เลขที่ใบสั่งจ้าง)");
                                                    alert("Please select Inspection No. (เลขที่ใบตรวจรับงาน)");
                                                } else if ($("#inspection_date_form").val() == "") {
//                        $().toastmessage('showWarningToast', "Please select Inspection Date (วันที่)");
                                                    alert("Please select Inspection Date (วันที่)");
                                                } else if ($("#inspection_order_type_form").val() == "") {
//                        $().toastmessage('showWarningToast', "Please select Order Type (ประเภทงาน)");
                                                    alert("Please select Order Type (ประเภทงาน)");
                                                } else {
                                                    var data = $("#inspectionForm").serialize();
                                                    //alert($("#inspection_attached_form").val());                   
                                                    if (createOrEditState == "Save") {
                                                        //alert(data);
                                                        var jqxhr = $.post("../model/SavingInspection.php?" + data);
                                                        jqxhr.success(function (resp) {
                                                            //alert(resp);
                                                            if (resp == 1) {
                                                                $("#loading_project").load("inspection_table_result.php?searchCondition=search_all", function () {
                                                                    $(".spinner").hide();
                                                                    $("#create_edit_panel").hide();
                                                                    $("#loading_ce_form").empty();
                                                                    $("#create_new_ins_btn").show("fast");
                                                                    $('html,body').animate({scrollTop: $('#loading_project').offset().top}, 'slow');
                                                                });
//                                    $().toastmessage('showSuccessToast', 'บันทึกข้อมูล Inspection เรียบร้อยแล้ว');
                                                                alert("บันทึกข้อมูล Inspection เรียบร้อยแล้ว");
                                                            } else {
//                                    $().toastmessage('showWarningToast', "ไม่สามารถบันทึกข้อมูล Inspection ได้");
                                                                alert("ไม่สามารถบันทึกข้อมูล Inspection ได้");
                                                            }

                                                        });
                                                    } else {
                                                        var remark = $("#inspection_remark_form").val();
                                                        if (remark == "" || remark == null) {
                                                            alert("กรุณาใส่ Remark");
                                                        } else {
                                                            var insIDD = $("#insID").val();

                                                            var jqxhr = $.post("../model/UpdateInsWithDifferImage.php?INS_ID=" + insIDD + "&" + data);
                                                            jqxhr.success(function (resp) {
                                                                // alert(resp);
                                                                //window.location.assign("index.php")
                                                                $("#loading_project").load("inspection_table_result.php?searchCondition=search_all", function () {
                                                                    $(".spinner").hide();
                                                                    $("#create_edit_panel").hide();
                                                                    $("#loading_ce_form").empty();
                                                                    $("#create_new_ins_btn").show("fast");
                                                                    $('html,body').animate({scrollTop: $('#loading_project').offset().top}, 'slow');
                                                                });
//                                    $().toastmessage('showSuccessToast', 'แก้ไขข้อมูลใบตรวจรับเรียบร้อยแล้ว');
                                                                alert("แก้ไขข้อมูลใบตรวจรับเรียบร้อยแล้ว");
                                                            });
                                                        }
                                                    }
                                                }
                                            });
                                        });

                                        function deleteInspection(INS_ID) {
                                            updateSessionTimeOutCallBack();
                                            if (confirm("Are you sure?"))
                                            {
                                                // blockPage();
                                                var jqxhr = $.post("../model/DeleteInspection.php?INS_ID=" + INS_ID);
                                                jqxhr.success(function (data) {
                                                    setTimeout(function ()
                                                    {
                                                        if (data == 1) {
                                                            $("#loading_project").load("inspection_table_result.php?searchCondition=search_all", function () {
                                                                $(".spinner").hide();
                                                                $("#create_edit_panel").hide();
                                                                $("#loading_ce_form").empty();
                                                                $('html,body').animate({scrollTop: $('#loading_project').offset().top}, 'slow');

                                                            });
//                                $().toastmessage('showSuccessToast', 'ลบข้อมูล Inspection เรียบร้อยแล้ว');
                                                            alert('ลบข้อมูล Inspection เรียบร้อยแล้ว');

                                                        } else {
//                                $().toastmessage('showWarningToast', "ไม่สามารถลบข้อมูลPOได้");
                                                            alert("ไม่สามารถลบข้อมูลPOได้");
                                                        }
                                                    }
                                                    , 300);
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
                                        function editInspection(ins_id) {
                                            updateSessionTimeOutCallBack();
                                            $("#create_new_ins_btn").hide("fast");
                                            $("#create_edit_panel").show();
                                            $("#spinnerCE").show();
                                            var jqxhr = $.post("create-edit_form.php?isEdit=Edit");
                                            jqxhr.success(function (cedata) {
                                                $("#loading_ce_form").html(cedata);
                                            });
                                            jqxhr.error(function (result) {
                                                $().toastmessage('showWarningToast', "Cannot connect server with: " + result);
                                            });
                                            var millisecondsToWait = 500;
                                            setTimeout(function () {
                                                $("#insID").val(ins_id);
                                                createOrEditState = "Edit";
                                                var jqxhr = $.post("../model/GetInspectionByID.php?ins_id=" + ins_id);
                                                jqxhr.success(function (data) {
                                                    obj = JSON.parse(data);
                                                    $("#inspection_no_form").val(obj.INS_INSPECTION_NO);
                                                    $("#inspection_date_form").val(obj.INS_DATE);
                                                    $("#inspection_order_type_form").val(obj.INS_ORDER_TYPE);
                                                    $("#inspection_remark_form").val(obj.INS_REMARK);

                                                    $("#inspection_project_name_form").val(obj.project_code);
                                                    var jqxhr = $.post("../model/GetAllProjectForEdit.php?project_code=" + obj.project_code);
                                                    jqxhr.success(function (data) {
                                                        obj = JSON.parse(data);
                                                        $("#inspection_project_code_form").val(obj.project_code);
                                                        $("#inspection_project_manager_form").val(obj.project_manager);
                                                        $("#inspection_project_foreman_form").val(obj.project_foreman);
                                                        $("#inspection_project_supervisor_form").val(obj.supervisor_control);
                                                    });
                                                    var jqxhr = $.post("../model/GetPoDocumentByProjectID.php?project_code=" + obj.project_code + "&isEdit=edit&po_id=" + obj.PO_ID);
                                                    jqxhr.success(function (data2) {
                                                        $("#inspection_document_no_form").html(data2);
                                                        setTimeout(function () {
                                                            $("#inspection_document_no_form").val(obj.PO_ID);
                                                        }, 100);
                                                    });



                                                    var jqxhr = $.post("../model/GetPoByIDForEdit.php?po_id=" + obj.PO_ID);
                                                    jqxhr.success(function (resp) {
                                                        obj = JSON.parse(resp);
                                                        $("#inspection_home_plan_form").val(obj.PO_HOME_PLAN);
                                                        $("#inspection_home_plot_form").val(obj.PO_HOME_PLOT);
                                                        $("#inspection_po_no_form").val(obj.PO_PO_NO);
                                                        $("#inspection_po_issue_date_form").val(obj.PO_ISSUE_DATE);
                                                        $("#inspection_quantity_form").val(obj.PO_QUANTITY);
                                                        $("#inspection_plan_size_form").val(obj.PO_PLAN_SIZE);

                                                    });

                                                    var jqxhrCkImage = $.post("../model/GetINSIMGByID.php?po_id=" + ins_id);
                                                    jqxhrCkImage.success(function (imgData) {
                                                        $("#edit_image").html(imgData);
                                                    });
                                                });
                                                jqxhr.error(function (data) {
                                                    window.location.replace("error.php?error_msg=" + data);
                                                });

                                            }, millisecondsToWait);
                                        }
                                        function delImage(imageID, po_id, img_name) {
                                            updateSessionTimeOutCallBack();
                                            if (confirm("Are you sure?"))
                                            {
                                                var jqxhr = $.post("../model/DelINSImageByID.php?imageID=" + imageID + "&img_name=" + img_name);
                                                jqxhr.success(function (data) {
                                                    if (data == 200) {
                                                        $("#edit_image").load("../model/GetINSIMGByID.php?po_id=" + po_id, function () {

                                                        });
                                                    } else {
                                                        //$().toastmessage('showWarningToast', "ไม่สามารถลบรูปภาพได้");
                                                        alert("ไม่สามารถลบรูปภาพได้");
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
