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
                            <a href="../qrc-mgr_project/project-index.php">

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
                                <a class="active"  href="assign-index.php">
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
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="active">Work Order(มอบหมาย)</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>Work Order(มอบหมาย) <span class="sub-title">Content Overview</span></h1>									
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
                                    <button type="button" class="btn btn-primary" id="create_new_assign"><i class="fa fa-bar-chart-o"></i> Create Order (สร้างออเดอร์ใหม่)</button>
                                    <!-- Server Info Charts .morris -->

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
                                                        <div>
                                                            <select class="form-control" id="project_name_search" name="project_name_search">
                                                                <option value="">-- Select Project Name --</option>
                                                                <?php
                                                                $sqlSelectProjectType = "SELECT * FROM QRC_PROJECT;";
                                                                $resultSet = mysql_query($sqlSelectProjectType);
                                                                while ($row = mysql_fetch_array($resultSet)) {
                                                                    echo '<option value="' . $row['project_code'] . '">' . $row['project_name'] . '</option>';
                                                                }
                                                                ?>                                           
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <select class="form-control" id="wo_status_search" name="wo_status_search">
                                                                <option value="">-- Select WO ID --</option>
                                                                <?php
                                                                $sqlSelectProjectType = "SELECT * FROM QRC_ASSIGN_STATUS;";
                                                                $resultSet = mysql_query($sqlSelectProjectType);
                                                                while ($row = mysql_fetch_array($resultSet)) {
                                                                    echo '<option value="' . $row['A_S_ID'] . '">' . $row['A_S_NAME'] . '</option>';
                                                                }
                                                                ?>                                           
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <input type="text" class="form-control search_date" id="start_search_date" data-date-format="yyyy-mm-dd" placeholder="-- Start date --">
                                                        </div>
                                                        <div>
                                                            <input type="text" class="form-control search_date" id="end_search_date" data-date-format="yyyy-mm-dd" placeholder="-- End date --">
                                                        </div>
                                                        <div>
                                                            <select class="form-control" id="wo_is_retention">
                                                                <option value="">-- Select Retention --</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>
                                                        <div id="project_name_div status">
                                                            <select class="form-control" id="project_limit_search" name="project_limit_search">
                                                                <option value="100">100</option>
                                                                <option value="500">500</option>
                                                                <option value="1000">1000</option>
                                                                <option value="All">--All--</option>                                                       
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button id="search_WO_button" class="btn btn-inverse">Search <i class="fa fa-arrow-right icon-on-right"></i></button>
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
                                                        <h4><i class="fa fa-list-ul"></i> All Task Assignment (มอบหมายงาน)</h4>
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
        <script src="../assets/js/plugins/gritter/jquery.gritter.min.js"></script>		

        <!-- initial page level scripts for examples -->
        <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
        <script src="../assets/js/home-page.init.js"></script>
        <script src="../assets/js/plugins/jquery-sparkline/jquery.sparkline.init.js"></script>
        <!-- qrc-mgr javascript init-->
        <script src="../assets/js/qrc-mgr_configuration.js"></script>
        <script type="text/javascript">

                                        $(document).ready(function () {
                                            $("#reset_search").click(function () {
                                                window.location = "assign-index.php";
                                            });
                                            $(".search_date").datepicker();
                                            var loadAssigntbl = $.post("assign_table_result.php?search_condition=search_all");
                                            loadAssigntbl.success(function (cedata) {
                                                $("#loading_project").html(cedata);
                                            });
                                            $("#create_new_assign").click(function () {
                                                window.location = "assign-wo-new.php";
                                            });
                                            $("#search_WO_button").click(function () {
                                                var projectCode = $("#project_name_search").val();
                                                var poId = $("#po_id_search").val();
                                                var woID = $("#wo_status_search").val();
                                                var startSearch = $("#start_search_date").val();
                                                var endSearch = $("#end_search_date").val();
                                                var woLimit = $("#project_limit_search").val();
                                                var isRetention = $("#wo_is_retention").val();

                                                if (!$.trim(projectCode).length &&
                                                        !$.trim(poId).length &&
                                                        !$.trim(woID) &&
                                                        !$.trim(startSearch).length &&
                                                        !$.trim(endSearch).length &&
                                                        !$.trim(isRetention).length &&
                                                        woLimit == 100) {

                                                    $("#loading_project").load("assign_table_result.php?search_condition=search_all", function () {

                                                    });
                                                } else {
                                                    if (startSearch != "" && endSearch == "") {
                                                        alert("Please enter end date");

                                                    }
                                                    else if (startSearch == "" && endSearch != "") {
                                                        alert("Please enter start date");
                                                    }
                                                    else {

                                                        $("#loading_project").load("assign_table_result.php?search_condition=search_criteria&projectCode=" + projectCode + "&poId=" + poId + "&woID=" + woID + "&startSearch=" + startSearch + "&endSearch=" + endSearch + "&searchLimit=" + woLimit + "&isRetention=" + isRetention, function () {

                                                        });

                                                    }
                                                }
                                            });
                                        });
                                        function deletePO(POID, project_code, imagePath) {

                                            if (confirm("Are you sure?"))
                                            {
                                                var jqxhr = $.post("../model/DeleteProjectOrder.php?project_order_code=" + POID + "&imagePath=" + imagePath);
                                                jqxhr.success(function (data) {
                                                    if (data == 1) {
                                                        setTimeout(function ()
                                                        {
                                                            //$('html,body').animate({scrollTop: $('#project_tbl_content').offset().top}, 'slow');
                                                            $("#loading_project").load("assign_table_result.php?search_condition=search_all", function () {
                                                                $(".spinner").hide();
                                                            });

                                                        }
                                                        , 100);
                                                    } else {

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
                                        function editPO(project_code, project_order_id) {
                                            //alert(project_order_id);
                                            window.location.assign("assign-wo-edit.php?projectCode=" + project_code + "&projectOrderStatus=Edit&project_order_id=" + project_order_id);
                                        }
                                        function copyWO(project_code, project_order_id) {
                                            window.location.assign("assign-wo-edit.php?projectCode=" + project_code + "&projectOrderStatus=Copy&project_order_id=" + project_order_id);
                                        }
        </script>
    </body>

</html>
