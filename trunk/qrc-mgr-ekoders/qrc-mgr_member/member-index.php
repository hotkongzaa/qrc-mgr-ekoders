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
        <link rel="stylesheet" type="text/css" href="../assets/css/plugins/gritter/jquery.gritter.css" />
        <link rel="stylesheet" type="text/css" href="../assets/css/jquery.toastmessage.css" />

        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <link rel="stylesheet" type="text/css" href="../assets/css/plugins/gritter/jquery.gritter.css" />

        <!-- Tc core CSS -->
        <link id="qstyle" rel="stylesheet" href="../assets/css/themes/style.css">	
        <!--[if lte IE 8]>
                <link rel="stylesheet" href="../assets/css/ie-fix.css" />
        <![endif]-->
        <link href="../assets/css/plugins/select2/select2.css" rel="stylesheet">
        <link href="../assets/css/plugins/select2/select2.custom.min.css" rel="stylesheet">

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
                            <li class="panel open">
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
                                        <a class="active" href="../qrc-mgr_member/member-index.php">
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
                                    <li class="active">Members(ลูกทีม)</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>Members(ลูกทีม) <span class="sub-title">Content Overview</span></h1>									
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
                                    <button type="button" class="btn btn-primary" id="create_new_member_btn"><i class="fa fa-bar-chart-o"></i> Create Member</button>
                                    <!-- Server Info Charts .morris -->
                                    <div class="row" >
                                        <div class="col-lg-9">
                                            <div class="portlet" id="create_edit_panel">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> Create/Edit Team Builder (สร้าง/แก้ไข ลูกทีม)</h4>
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
                                                        <div>
                                                            <input type="text" class="form-control" id="member_id" placeholder="Member ID (หมายเลขประจำตัว)">
                                                        </div>
                                                        <div>
                                                            <input type="text" class="form-control" id="member_name" placeholder="Member Name (ชื่อ-สกุล)">
                                                        </div>
                                                        <div>
                                                            <select class="form-control" id="role" name="role">
                                                                <option value="">-- Select Row --</option>
                                                                <?php
                                                                $sqlSelectProjectType = "SELECT * FROM QRC_MEMBER_ROLE;";
                                                                $resultSet = mysql_query($sqlSelectProjectType);
                                                                while ($row = mysql_fetch_array($resultSet)) {
                                                                    echo '<option value="' . $row['role_id'] . '">' . $row['role_name'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>	
                                                        <div>
                                                            <select multiple name="skill" id="select3_2" style="width:239px;" size="5">
                                                                <?php
                                                                $sqlSelectProjectType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                                                                $resultSet = mysql_query($sqlSelectProjectType);
                                                                while ($row = mysql_fetch_array($resultSet)) {
                                                                    echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                                                                }
                                                                ?> 
                                                            </select>
                                                        </div>	
                                                        <div>
                                                            <select class="form-control" id="team_code_in_member_form" name="team_code_in_member_form">
                                                                <option value="">-- Select Team --</option>
                                                                <?php
                                                                $sqlSelectProjectType = "SELECT * FROM QRC_TEAM_BUILDER;";
                                                                $resultSet = mysql_query($sqlSelectProjectType);
                                                                while ($row = mysql_fetch_array($resultSet)) {
                                                                    echo '<option value="' . $row['tCode'] . '">' . $row['tName'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-footer">
                                                        <div class="pull-right">
                                                            <button id="search_member_button" class="btn btn-inverse">Search <i class="fa fa-arrow-right icon-on-right"></i></button>
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
                                                        <h4><i class="fa fa-list-ul"></i>  All Team members (ลูกทีมมั้งหมด)</h4>
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
        <script src="../assets/js/jquery.toastmessage.js"></script>
        <!-- qrc-mgr javascript init-->
        <script src="../assets/js/qrc-mgr_configuration.js"></script>
        <script src="../assets/js/jquery.maskedinput.js"></script>
        <!--<script src="../assets/js/jquery.multiselect.js"></script>-->
        <script src="../assets/js/plugins/select2/select2.min.js"></script>
        <script type="text/javascript">
                                        var createOrEditState = "Create";
                                        $(document).ready(function () {
                                            updateSessionTimeOutCallBack();
                                            $("#select3_2").select2({
                                                placeholder: "Select a Services",
                                                allowClear: true
                                            });

                                            $("#create_edit_panel").hide();
                                            $("#loading_project").load("member_table_result.php?searchCondition=search_all");
                                            $("#create_new_member_btn").click(function () {
                                                updateSessionTimeOutCallBack();
                                                $("#loading_ce_form").load("member-edit_form.php?mID=new", function () {
                                                    $("#create_edit_panel").show("fast");
                                                    $("#create_new_member_btn").hide();
                                                });
                                            });
                                            $("#cancel_form").click(function () {
                                                updateSessionTimeOutCallBack();
                                                $("#loading_ce_form").empty();
                                                $("#create_new_member_btn").show();
                                                $("#create_edit_panel").hide("fast");
                                            });
                                            $("#save_create_panel").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var memId = $("#member_id_form").val();
                                                var memName = $("#member_name_form").val();
                                                var memRole = $("#member_role_form").val();
                                                var memberSkill = $("#member_skill_form").val();
                                                var teamCode = $("#team_code_in_member_form2").val();
                                                var teamName = $("#team_name_in_member_form2").val();
                                                var tel = $("#tel_in_member_form").val();
                                                var email = $("#email_in_member_form").val();
                                                var remark_inform = $("#remark_inform").val();

                                                if (createOrEditState == "Edit") {
                                                    if (remark_inform == "") {
                                                        alert("กรุณาระบุ Remark");
                                                    } else if ($("#member_skill_form").val() == null) {
                                                        alert("กรุณาระบุ ความสามารถของวมาชิก");
                                                    } else {
                                                        if (memberSkill == null || memberSkill == "") {
                                                            memberSkill = $("#hideMemSkill").val();
                                                            var jqxhr = $.post("../model/EditMember.php?memId=" + memId + "&memName=" + memName + "&memRole=" + memRole + "&memberSkill=" + memberSkill + "&teamCode=" + teamCode + "&teamName=" + teamName + "&tel=" + tel + "&email=" + email + "&remark=" + remark_inform);
                                                            jqxhr.success(function (data) {
                                                                if (data == 1) {
                                                                    $("#loading_project").load("member_table_result.php?searchCondition=search_all", function () {
                                                                        $(".spinner").hide();
                                                                        $("#create_edit_panel").hide();
                                                                        $("#loading_ce_form").empty();
                                                                        $("#create_new_member_btn").show();
                                                                        createOrEditState = "Create";
                                                                    });
                                                                    alert('แกไขข้อมูลทีมเรียบร้อยแล้ว');

                                                                } else {
                                                                    alert("ไม่สามารถแก้ไขข้อมูลทีมได้");
                                                                }
                                                            });
                                                        } else {
                                                            var jqxhr = $.post("../model/EditMember.php?memId=" + memId + "&memName=" + memName + "&memRole=" + memRole + "&memberSkill=" + memberSkill + "&teamCode=" + teamCode + "&teamName=" + teamName + "&tel=" + tel + "&email=" + email + "&remark=" + remark_inform);
                                                            jqxhr.success(function (data) {
                                                                if (data == 1) {
                                                                    $("#loading_project").load("member_table_result.php?searchCondition=search_all", function () {
                                                                        $(".spinner").hide();
                                                                        $("#create_edit_panel").hide();
                                                                        $("#loading_ce_form").empty();
                                                                        $("#create_new_member_btn").show();
                                                                        createOrEditState = "Create";
                                                                    });
                                                                    alert('แกไขข้อมูลทีมเรียบร้อยแล้ว');

                                                                } else {
                                                                    alert("ไม่สามารถแก้ไขข้อมูลทีมได้");
                                                                }
                                                            });
                                                        }

                                                    }
                                                } else {
                                                    if (memName == "" || memName == null) {
                                                        alert("กรุณาระบุ ชื่อของสมาชิก");
                                                    } else if ($("#member_skill_form").val() == null) {
                                                        alert("กรุณาระบุ ความสามารถของวมาชิก");
                                                    } else {
                                                        var jqxhr = $.post("../model/SavingMember.php?memId=" + memId + "&memName=" + memName + "&memRole=" + memRole + "&memberSkill=" + memberSkill + "&teamCode=" + teamCode + "&teamName=" + teamName + "&tel=" + tel + "&email=" + email + "&remark=" + remark_inform);
                                                        jqxhr.success(function (data) {
                                                            if (data == 1) {
                                                                //$("#modal-team").modal('hide');
                                                                $("#loading_project").load("member_table_result.php?searchCondition=search_all", function () {
                                                                    $(".spinner").hide();
                                                                    $("#create_edit_panel").hide();
                                                                    $("#loading_ce_form").empty();
                                                                    $("#create_new_member_btn").show();
                                                                    $('html,body').animate({scrollTop: $('#loading_project').offset().top}, 'slow');
                                                                });
//                                    $().toastmessage('showSuccessToast', 'บันทึกข้อมูลทีมเรียบร้อยแล้ว');
                                                                alert("บันทึกข้อมูลทีมเรียบร้อยแล้ว");

                                                            } else {
//                                    $().toastmessage('showWarningToast', "ไม่สามารถบันทึกข้อมูลทีมได้");
                                                                alert("ไม่สามารถบันทึกข้อมูลทีมได้");
                                                            }
                                                        });
                                                    }
                                                }
                                            });
                                            $("#search_member_button").click(function () {
                                                updateSessionTimeOutCallBack();
                                                var member_id = $("#member_id").val();
                                                var member_name = $("#member_name").val();
                                                var role = $("#role").val();
                                                var team_code_in_member_form = $("#team_code_in_member_form").val();
//                    var t_name_in_search = $("#t_name_in_search").val();
                                                var select3_2 = $("#select3_2").val();

                                                if (!$.trim(member_id).length &&
                                                        !$.trim(member_name).length &&
                                                        !$.trim(role).length &&
                                                        !$.trim(team_code_in_member_form).length &&
//                            !$.trim(t_name_in_search).length &&
                                                        !$.trim(select3_2)) {
                                                    $("#loading_project").load("member_table_result.php?searchCondition=search_all", function () {
                                                        //$(".spinner").hide();
                                                        $('html,body').animate({scrollTop: $('#team_tbl_content').offset().top}, 'slow');
                                                    });
                                                } else {
                                                    $("#loading_project").load("member_table_result.php?searchCondition=condition&memId=" + member_id + "&memName=" + member_name + "&memRole=" + role + "&memberSkill=" + select3_2 + "&teamCode=" + team_code_in_member_form, function () {
                                                        //$(".spinner").hide();
                                                        $('html,body').animate({scrollTop: $('#team_tbl_content').offset().top}, 'slow');
                                                    });
                                                    //window.location.assign("index-member-search-result.php?searchCondition=condition&memId=" + member_id + "&memName=" + member_name + "&memRole=" + role + "&memberSkill=" + select3_2 + "&teamCode=" + team_code_in_member_form + "&teamName=" + t_name_in_search);
                                                }
                                            });
                                        });
                                        function editMember(memID) {
                                            updateSessionTimeOutCallBack();
                                            $("#create_edit_panel").show();
                                            $("#spinnerCE").show();
                                            var jqxhr = $.post("member-edit_form.php?mID=" + memID);
                                            jqxhr.success(function (cedata) {
                                                $("#loading_ce_form").html(cedata);
//                    $("#spinnerCE").hide();
//                    $('html,body').animate({scrollTop: $('#create_edit_panel').offset().top}, 'slow');
                                            });
                                            var millisecondsToWait = 500;
                                            setTimeout(function () {
                                                createOrEditState = "Edit";
                                                var jqxhr = $.post("../model/GetAllMemberForEdit.php?mem_id=" + memID);
                                                jqxhr.success(function (data) {
//                        $("#waringmsg").append("Leave empty for no change");
                                                    obj = JSON.parse(data);
                                                    $("#member_id_form").val(obj.mem_id);
                                                    $("#member_name_form").val(obj.mem_name);
                                                    $("#member_role_form").val(obj.mem_role);
                                                    $("#hideMemSkill").val(obj.mem_skill);
                                                    $("#team_code_in_member_form2").val(obj.mem_t_code);
                                                    $("#team_name_in_member_form2").val(obj.mem_t_name);
                                                    $("#tel_in_member_form").val(obj.mem_tel);
                                                    $("#email_in_member_form").val(obj.mem_email);
                                                    $("#remark_inform").val(obj.mem_remark);

                                                });
                                                jqxhr.error(function (data) {
                                                    window.location.replace("error.php?error_msg=" + data);
                                                });
                                            }, millisecondsToWait);
                                        }
                                        function deleteMember(memID) {
                                            updateSessionTimeOutCallBack();
                                            if (confirm("Are you sure?"))
                                            {
                                                // blockPage();
                                                var jqxhr = $.post("../model/DeleteMember.php?mem_id=" + memID);
                                                jqxhr.success(function (data) {
                                                    if (data == 1) {
                                                        $("#loading_project").load("member_table_result.php?searchCondition=search_all", function () {

                                                            $("#loading_ce_form").empty();

                                                        });
                                                        alert('ลบข้อมูลทีมเรียบร้อยแล้ว');

                                                    } else {
                                                        alert("ไม่สามารถลบข้อมูลทีมได้");

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
        </script>
    </body>

</html>
