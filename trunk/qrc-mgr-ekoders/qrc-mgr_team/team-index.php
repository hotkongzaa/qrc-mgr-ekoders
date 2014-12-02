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
                            <!-- BEGIN COMPONENTS DROPDOWN -->
                            <li class="panel open">
                                <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#components">
                                    <i class="fa fa-bar-chart-o"></i> Builder (ทีมช่าง) <span class="fa arrow"></span>
                                </a>
                                <ul class="collapse nav" id="components">
                                    <li>
                                        <a class="active" href="team-index.php">
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
                            <!-- END COMPONENTS DROPDOWN -->							
                            <li>
                                <a href="../qrc-mgr_assign/assign-index.php">
                                    <i class="fa fa-tasks"></i> Work Order (มอบหมาย)
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
                                    <li class="active">Team(ทีม)</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>Team(ทีม) <span class="sub-title">Content Overview</span></h1>									
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
                                    <button type="button" class="btn btn-primary" id="create_new_team_btn"><i class="fa fa-bar-chart-o"></i> Create Team</button>
                                    <!-- Server Info Charts .morris -->
                                    <div class="row" >
                                        <div class="col-lg-9">
                                            <div class="portlet" id="create_edit_panel">
                                                <div class="portlet-heading inverse">
                                                    <div class="portlet-title">
                                                        <h4><i class="fa fa-bar-chart-o"></i> Create/Edit Team (สร้าง/แก้ไข ทีม)</h4>
                                                    </div>
                                                    <div class="portlet-widgets">

                                                        <a data-toggle="collapse" data-parent="#accordion" href="#m-charts"><i class="fa fa-chevron-down"></i></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div id="m-charts" class="panel-collapse collapse in">
                                                    <div class="portlet-body">
                                                        <div class="alert alert-danger" id="alert_inform">
                                                            <strong>Please enter/select require fields</strong>
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
                                                        <div>
                                                            <input type="text" class="form-control" id="team_code_search" placeholder="Team Code (หมายเลขทีมช่าง)">
                                                        </div>
                                                        <div>
                                                            <input type="text" class="form-control" id="team_name_search" placeholder="Team Name (ชื่อทีม)">
                                                        </div>
                                                        <div>
                                                            <select class="form-control" id="team_lead_search" name="team_lead_search">
                                                                <option value="">-- Select Team Lead --</option>
                                                                <?php
                                                                $sqlSelectMemType = "SELECT * FROM QRC_MEMBERS WHERE memRole ='60004';";
                                                                $resultSets = mysql_query($sqlSelectMemType);
                                                                while ($row = mysql_fetch_array($resultSets)) {
                                                                    echo '<option value="' . $row['memID'] . '">' . $row['memName'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <select multiple="multiple" name="type_of_service" id="select2_2" size="5" style="width:239px;">
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
                                                            <select class="form-control" id="team_type_search" name="team_type_search">
                                                                <option value="">-- Select Team Type --</option>
                                                                <option value="M">M (Main team)</option>
                                                                <option value="S">S (Sub team)</option>
                                                                <option value="T">T (Temporary)</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <select class="form-control" id="team_t_manager_search" name="team_t_manager_search">
                                                                <option value="">-- Select Team Manager --</option>
                                                                <?php
                                                                $sqlSelectMemType = "SELECT * FROM QRC_MEMBERS WHERE memRole ='60003';";
                                                                $resultSets = mysql_query($sqlSelectMemType);
                                                                while ($row = mysql_fetch_array($resultSets)) {
                                                                    echo '<option value="' . $row['memID'] . '">' . $row['memName'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div>
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
                                                            <button id="search_team_button" class="btn btn-inverse">Search <i class="fa fa-arrow-right icon-on-right"></i></button>
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
                                                        <h4><i class="fa fa-list-ul"></i>  All Team (ทีมทั้งหมด)</h4>
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
        <!--<link rel="stylesheet" type="text/css" href="../assets/css/jquery.multiselect.css" />-->
        <script src="../assets/js/jquery.maskedinput.js"></script>
        <!--<script src="../assets/js/jquery.multiselect.js"></script>-->
        <script src="../assets/js/plugins/select2/select2.min.js"></script>
        <script type="text/javascript">
            var createOrEditStateTeam = "Create";
            $(document).ready(function () {
                $("#alert_inform").hide();
                $("#alert_information").html();
                $("#select2_2").select2({
                    placeholder: "Select a Services",
                    allowClear: true
                });
                $("#create_edit_panel").hide();
                $("#loading_project").load("team_table_result.php?searchCondition=search_all");
                $("#create_new_team_btn").click(function () {
                    $("#loading_ce_form").load("team-edit_form.php?mID=new", function () {
                        $("#create_edit_panel").show("fast");
                        $("#create_new_team_btn").hide();
                    });
                    createOrEditStateTeam = "Create";
                });
                $("#cancel_form").click(function () {
                    $("#alert_inform").hide();
                    $("#alert_information").html("");
                    $("#loading_ce_form").empty();
                    $("#create_edit_panel").hide("fast");
                    $("#create_new_team_btn").show("fast");
                    createOrEditStateTeam = "Create";
                });
                $("#save_create_panel").click(function () {
                    var teamCode = $("#team_code_form").val();
                    var teamName = $("#team_name_form").val();
                    var teamLeadId = $("#team_lead_form").val();
                    var tSkill = $("#select2_2_form").val();
                    var tType = $("#team_type_form").val();
                    var tManagerID = $("#team_t_manager_form").val();
                    var tRemark = $("#team_remark_in_form").val();
                    if (createOrEditStateTeam == "Edit") {
                        if (tRemark == "" || tRemark == null) {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please enter remark");
                        } else if (teamName == "" && teamLeadId == "" && tManagerID == "" && $("#select2_2_form").val() == null && tType == "") {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please enter team name\n\
                        <br/> - Please select Team Leader and Team Manager\n\
                        <br/> - Please select Team Skill\n\
                        <br/> - Please select Team Type");
                        } else if (teamName == "") {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please enter team name");
                        } else if ($("#select2_2_form").val() == null) {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please select Team Skill");
                        } else if (teamLeadId == "" || teamLeadId == null || tManagerID == "" || tManagerID == null) {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please select Team Leader and Team Manager");
                        } else if (tType == "") {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please select Team Type");
                        } else {
                            if (tSkill == null || tSkill == "") {
                                tSkill = $("#hideTeamSkill").val();
                                $(".spinner").show();
                                var jqxhr = $.post("../model/EditTeamBuilder.php?teamCode=" + teamCode + "&teamName=" + teamName + "&teamLeadId=" + teamLeadId + "&tSkill=" + tSkill + "&tType=" + tType + "&tManagerID=" + tManagerID + "&tRemark=" + tRemark);
                                jqxhr.success(function (data) {
                                    if (data == 1) {
                                        $("#alert_inform").show();
                                        $("#alert_information").html("");
                                        $("#loading_project").load("team_table_result.php?searchCondition=search_all", function () {
                                            $(".spinner").hide();
                                            $("#create_edit_panel").hide();
                                            $("#loading_ce_form").empty();
                                            $("#create_new_team_btn").show("fast");
                                            createOrEditStateTeam = "Create";
                                        });
                                        alert("แกไขข้อมูลทีมเรียบร้อยแล้ว");

                                    } else {
                                        alert("ไม่สามารถแก้ไขข้อมูลทีมได้");
                                    }
                                });
                            } else {
                                var jqxhr = $.post("../model/EditTeamBuilder.php?teamCode=" + teamCode + "&teamName=" + teamName + "&teamLeadId=" + teamLeadId + "&tSkill=" + tSkill + "&tType=" + tType + "&tManagerID=" + tManagerID + "&tRemark=" + tRemark);
                                jqxhr.success(function (data) {
                                    if (data == 1) {
                                        $("#alert_inform").hide();
                                        $("#alert_information").html("");
                                        $("#loading_project").load("team_table_result.php?searchCondition=search_all", function () {
                                            $(".spinner").hide();
                                            $("#create_edit_panel").hide();
                                            $("#loading_ce_form").empty();
                                            $("#create_new_team_btn").show("fast");
                                            $('html,body').animate({scrollTop: $('#loading_project').offset().top}, 'slow');
                                            createOrEditStateTeam = "Create";
                                        });
                                        alert("แกไขข้อมูลทีมเรียบร้อยแล้ว");

                                    } else {
                                        alert("ไม่สามารถแก้ไขข้อมูลทีมได้");
                                    }
                                });

                            }
                        }
                    } else {
                        if (teamName == "" && teamLeadId == "" && tManagerID == "" && $("#select2_2_form").val() == null && tType == "") {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please enter team name\n\
                        <br/> - Please select Team Leader and Team Manager\n\
                        <br/> - Please select Team Skill\n\
                        <br/> - Please select Team Type");
                        } else if (teamName == "") {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please enter team name");
                        } else if (teamLeadId == "" || teamLeadId == null || tManagerID == "" || tManagerID == null) {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please select Team Leader and Team Manager");
                        } else if ($("#select2_2_form").val() == null) {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please select Team Skill");
                        } else if (tType == "") {
                            $("#alert_inform").show();
                            $("#alert_information").html("<br> - Please select Team Type");
                        } else {
                            var jqxhr = $.post("../model/SavingTeamBuilding.php?teamCode=" + teamCode + "&teamName=" + teamName + "&teamLeadId=" + teamLeadId + "&tSkill=" + tSkill + "&tType=" + tType + "&tManagerID=" + tManagerID + "&tRemark=" + tRemark);
                            jqxhr.success(function (data) {
                                $("#alert_inform").hide();
                                $("#alert_information").html("");
                                if (data == 1) {
                                    $("#loading_project").load("team_table_result.php?searchCondition=search_all", function () {
                                        $(".spinner").hide();
                                        $("#create_edit_panel").hide();
                                        $("#loading_ce_form").empty();
                                        $("#create_new_team_btn").show("fast");
                                        $('html,body').animate({scrollTop: $('#loading_project').offset().top}, 'slow');
                                    });
                                    alert("บันทึกข้อมูลทีมเรียบร้อยแล้ว");

                                } else {
                                    alert("ไม่สามารถบันทึกข้อมูลทีมได้");
                                }
                            });
                        }
                    }
                });
                $("#search_team_button").click(function () {
                    var teamCode = $("#team_code_search").val();
                    var teamName = $("#team_name_search").val();
                    var teamLead = $("#team_lead_search").val();
                    var tSkill = $("#select2_2").val();
                    var teamType = $("#team_type_search").val();
                    var teamManager = $("#team_t_manager_search").val();
                    var limit = $("#project_limit_search").val();
                    if ($.trim(teamCode).length !== 0 ||
                            $.trim(teamName).length !== 0 ||
                            $.trim(teamLead).length !== 0 ||
                            tSkill !== null ||
                            $.trim(teamType).length !== 0 ||
                            $.trim(teamManager).length !== 0 ||
                            limit != 100) {

                        //window.location.assign("index-builder-search-result.php?searchCondition=condition&teamCode=" + teamCode + "&teamName=" + teamName + "&teamLead=" + teamLead + "&teamSkill=" + tSkill + "&teamType=" + teamType + "&teamManager=" + teamManager);
                        $("#loading_project").load("team_table_result.php?searchCondition=condition&teamCode=" + teamCode + "&teamName=" + teamName + "&teamLead=" + teamLead + "&teamSkill=" + tSkill + "&teamType=" + teamType + "&teamManager=" + teamManager + "&searchLimit=" + limit, function () {
                            //$(".spinner").hide();
                            $('html,body').animate({scrollTop: $('#team_tbl_content').offset().top}, 'slow');
                        });
                    } else {
                        //window.location.assign("index-builder-search-result.php?searchCondition=search_all");
                        $("#loading_project").load("team_table_result.php?searchCondition=search_all", function () {
                            //$(".spinner").hide();
                            $('html,body').animate({scrollTop: $('#team_tbl_content').offset().top}, 'slow');
                        });
                    }
                });
            });
            function deleteTeam(tID, memID) {


                if (confirm("Are you sure?"))
                {
                    var jqxhr = $.post("../model/DeleteTeam.php?t_code=" + tID + "&memID=" + memID);
                    jqxhr.success(function (data) {
                        if (data == 1) {
                            $("#loading_project").load("team_table_result.php?searchCondition=search_all", function () {

                                $("#create_edit_panel").hide();
                                $("#loading_ce_form").empty();
                            });
                            alert("ลบข้อมูลทีมเรียบร้อยแล้ว");

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
            function editTeam(tID, amount) {
                $("#create_edit_panel").show();
                $("#spinnerCE").show();
                var jqxhr = $.post("team-edit_form.php?mID=" + tID);
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
                    createOrEditStateTeam = "Edit";
                    var jqxhr = $.post("../model/GetAllTeamForEdit.php?teamID=" + tID);
                    jqxhr.success(function (data) {
                        obj = JSON.parse(data);
                        $("#team_code_form").val(obj.t_code);
                        $("#team_name_form").val(obj.t_Name);
                        $("#team_lead_form").val(obj.t_lead_id);
                        $("#hideTeamSkill").val(obj.tSkill);
                        $("#no_of_member_form").val(amount);
                        $("#team_type_form").val(obj.t_type);
                        $("#team_t_manager_form").val(obj.t_manager_id);
                        $("#team_remark_in_form").val(obj.t_remark);
                    });

                    jqxhr.error(function (data) {
                        window.location.replace("error.php?error_msg=" + data);
                    });
                }, millisecondsToWait);
            }
        </script>
    </body>

</html>
