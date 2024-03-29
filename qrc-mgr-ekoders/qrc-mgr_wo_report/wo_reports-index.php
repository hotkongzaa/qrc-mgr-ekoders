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
        <link rel="stylesheet" type="text/css" href="../assets/css/plugins/daterangepicker/daterangepicker-bs3.css" />

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
                                    <i class="fa fa-sitemap"></i> Team Report (รายงาน)
                                </a>
                            </li>
                            <li class="panel">
                                <a class="active" href="wo_reports-index.php" >
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
                                        <a href="../qrc-mgr_project/project-index.php">Home</a>
                                    </li>
                                    <li class="active">WO Reports(รายงาน)</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>Reports (รายงาน) <span class="sub-title">Content Overview</span></h1>									
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
                                    <div class="row" id="row_html">
                                        <div class="col-lg-3">
                                            <div class="portlet" id="create_edit_panel">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> Search</h4>
                                                    </div>
                                                    <div class="portlet-widgets">

                                                        <a data-toggle="collapse" data-parent="#accordion" href="#m-charts"><i class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="m-charts" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label>Search Date (ค้นหาตามวันที่)</label>
                                                                <div class="input-group" id="daterange">
                                                                    <input id="show_date" class="form-control" placeholder="search all">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Search Status (ค้นหาตามสถานะ)</label>
                                                                <select class="form-control" id="wo_status" name="project_order_status">
                                                                    <?php
                                                                    $sqlSelectProjectType = "SELECT * FROM QRC_ASSIGN_STATUS;";
                                                                    $resultSet = mysql_query($sqlSelectProjectType);
                                                                    echo '<option value="">--- All ---</option>';
                                                                    while ($row = mysql_fetch_array($resultSet)) {
                                                                        echo '<option value="' . $row['A_S_NAME'] . '">' . $row['A_S_NAME'] . '</option>';
                                                                    }
                                                                    ?>      
                                                                </select>
                                                                <div class="separator"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Search Type (ค้นหาตามประเภท)</label>
                                                                <select class="form-control" id="wo_order_type" name="wo_order_type">
                                                                    <option value="">--- All ---</option>
                                                                    <option value="ติดตั้ง">ติดตั้ง</option>
                                                                    <option value="แก้ไข">แก้ไข</option>
                                                                    <option value="ซ่อมแซม">ซ่อมแซม</option>
                                                                    <option value="รื้อถอน">รื้อถอน</option>
                                                                </select>
                                                                <div class="separator"></div>
                                                            </div>
                                                            <div class="portlet">
                                                                <div class="portlet-heading inverse">
                                                                    <div class="portlet-title">
                                                                        <h4><i class="fa fa-edit"></i> To Do</h4>
                                                                    </div>
                                                                    <div class="portlet-widgets">
                                                                        <a href="javascript:;"><span class="badge badge-primary">6</span></a>
                                                                        <span class="divider"></span>
                                                                        <a href="#" class="tooltip-primary" data-placement="left" data-rel="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="portlet-body">
                                                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 95px;"><ul id="todo-sortlist" class="task-widget list-group task-lists ui-sortable" style="overflow: hidden; width: auto; height: 95px;">
                                                                            <li class="list-group-item">
                                                                                <div class="tcb">
                                                                                    <label>
                                                                                        <input type="checkbox" class="tc" id="checkbox">
                                                                                        <span id="#checkbox" class="labels">
                                                                                            Updating server software <i class="fa fa-warning text-danger"></i>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <div class="tcb">
                                                                                    <label>
                                                                                        <input type="checkbox" class="tc" id="checkbox1">
                                                                                        <span id="#checkbox1" class="labels">
                                                                                            Fixing bugs
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </li>

                                                                            <li class="list-group-item">
                                                                                <div class="tcb">
                                                                                    <label>
                                                                                        <input type="checkbox" class="tc" id="checkbox4">
                                                                                        <span id="#checkbox4" class="labels">
                                                                                            Pending Orders <span class="badge badge-success">3</span>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <div class="tcb">
                                                                                    <label>
                                                                                        <input type="checkbox" class="tc" id="checkbox5">
                                                                                        <span id="#checkbox5" class="labels">
                                                                                            Call to John Smith
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </li>
                                                                        </ul><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 51.57142857142857px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button id="search_click"  class="btn btn-primary">Search </button>
                                                        </div>
                                                        <div class="pull-left">
                                                            <button id="reset_click" class="btn ">Reset <i class="fa fa-arrow-cross"></i></button>
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
                                                        <h4><i class="fa fa-list-ul"></i> WO Report (รายงาน)</h4>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="recent" class="panel-collapse collapse in">
                                                    <div class="portlet-body" class="row">
                                                        <div id="report_loader"></div>
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
        <input type="hidden" id="start_date">
        <input type="hidden" id="end_date">

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
        <script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>
        <script src="../assets/js/plugins/jquery.blockUI.js"></script>
        <script src="../assets/js/highcharts.js"></script>
        <script src="../assets/js/exporting.js"></script>
        <script src="../assets/js/data.js"></script>

        <script src="../assets/js/highcharts.js"></script>
        <script src="../assets/js/exporting.js"></script>
        <script src="../assets/js/data.js"></script>
        <!-- Themes Core Scripts -->	
        <script src="../assets/js/main.js"></script>

        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <script src="../assets/js/plugins/gritter/jquery.gritter.min.js"></script>		

        <!-- initial page level scripts for examples -->
        <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
        <!-- qrc-mgr javascript init-->
        <script src="../assets/js/qrc-mgr_configuration.js"></script>

        <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#daterange').daterangepicker({
                                                startDate: moment().subtract('days', 29),
                                                endDate: moment(),
                                                showDropdowns: true,
                                                showWeekNumbers: true,
                                                timePicker: false,
                                                timePickerIncrement: 1,
                                                timePicker12Hour: true,
                                                ranges: {
                                                    'Today': [moment(), moment()],
                                                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                                                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                                                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                                                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                                                },
                                                opens: 'right',
                                                buttonClasses: ['btn btn-primary'],
                                                applyClass: 'btn-sm btn-inverse',
                                                cancelClass: 'btn-sm',
                                                format: 'DD/MM/YYYY',
                                                separator: ' to ',
                                                locale: {
                                                    applyLabel: 'Submit',
                                                    fromLabel: 'From',
                                                    toLabel: 'To',
                                                    customRangeLabel: 'Custom Range',
                                                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                                                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                                    firstDay: 1
                                                }
                                            },
                                            function (start, end) {
                                                $("#show_date").val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                                                $("#start_date").val(start.format('YYYY-MM-DD'));
                                                $("#end_date").val(end.format('YYYY-MM-DD'));
                                            }
                                            );
                                            //Set the initial state of the picker label
//                                            $("#show_date").val(moment().subtract('days', 29).format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));                                           
//                                            $("#start_date").val(moment().subtract('days', 29).format('YYYY-MM-DD'));
//                                            $("#end_date").val(moment().format('YYYY-MM-DD'));
                                            $.ajax({
                                                url: "report_table_result.php",
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
                                                    $("#report_loader").html(data);
                                                    setTimeout($.unblockUI, 100);
                                                }
                                            });
                                            $("#search_click").click(function () {
                                                var startDate = "";
                                                var endDate = "";
                                                if ($("#show_date").val() != "") {
                                                    startDate = $("#start_date").val();
                                                    endDate = $("#end_date").val();
                                                }
                                                var wo_status = $("#wo_status").val();
                                                $.ajax({
                                                    url: "report_table_result.php?start_date=" + startDate + "&end_date=" + endDate + "&wo_status=" + wo_status,
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
                                                        $("#report_loader").html(data);
                                                        setTimeout($.unblockUI, 100);
                                                    }
                                                });
                                            });
                                            $("#reset_click").click(function () {
                                                $.ajax({
                                                    url: "report_table_result.php",
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
                                                        $("#report_loader").html(data);
                                                        $("#show_date").val("");
                                                        $("#wo_status").val("");
                                                        setTimeout($.unblockUI, 100);
                                                    }
                                                });
                                            });
                                        });

        </script>
    </body>

</html>
