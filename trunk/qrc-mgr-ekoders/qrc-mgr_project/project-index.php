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
                            <!-- BEGIN COMPONENTS DROPDOWN -->
                            <li class="panel">
                                <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#components">
                                    <i class="fa fa-bar-chart-o"></i> Builder (ทีมช่าง) <span class="fa arrow"></span>
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

                            <!-- BEGIN CHARTS DROPDOWN -->
                            <li class="panel">
                                <a href="#" >
                                    <i class="fa fa-sitemap"></i> Report (รายงาน)
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
            var createOrEditState = "Create";
            $(document).ready(function () {
                $("#create_edit_panel").hide();
                var jqxhr = $.post("project_table_result.php?search_condition=search_all");
                jqxhr.success(function (data) {
                    $("#loading_project").html(data);
                    $(".spinner").hide();
                });
                jqxhr.error(function () {
                    alert("Cannot load page");
                });
                var jqxhr = $.post("project_search_page.php");
                jqxhr.success(function (data) {
                    $("#search_project").html(data);
                });
                jqxhr.error(function () {
                    alert("Cannot load page");
                });
                $("#cancel_form").click(function () {
                    $("#create_edit_panel").hide();
                    $("#loading_ce_form").empty();
                    $("#create_new_project_btn").show();
                });
                $("#create_new_project_btn").click(function () {
                    createOrEditState = "Create";
                    $("#create_edit_panel").show("fast");
                    var jqxhr = $.post("create-edit_form.php");
                    jqxhr.success(function (cedata) {
                        $("#loading_ce_form").html(cedata);
                        $("#create_new_project_btn").hide();
                        $('html,body').animate({scrollTop: $('#create_new_project_btn').offset().top}, 'slow');
                    });
                });
                $("#search_project_button").click(function () {

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

                        $("#loading_project").load("project_table_result.php?search_condition=search_all", function () {

                        });
                    } else {
                        if (startSearchDate != "" && endSearchDate == "") {
                            //$().toastmessage('showWarningToast', "Please enter end date");
                            alert("Please enter end date");

                        }
                        else if (startSearchDate == "" && endSearchDate != "") {
//                            $().toastmessage('showWarningToast', "Please enter start date");
                            alert("Please enter start date");
                        }
                        else {
                            var dateAr = endSearchDate.split('-');
                            endSearchDate = dateAr[0] + '-' + dateAr[1] + '-' + (parseInt(dateAr[2]) + 1);
                            $("#loading_project").load("project_table_result.php?search_condition=search_criteria&projectCodeSearch=" + projectCodeSearch + "&projectNameSearch=" + projectNameSearch + "&projectTypeSearch=" + projectTypeSearch + "&projectStatusSearch=" + projectStatusSearch + "&projectOwnerSearch=" + projectOwnerSearch + "&projectCustomerSearch=" + projectCustomerSearch + "&startSearchDate=" + startSearchDate + "&endSearchDate=" + endSearchDate + "&searchLimit=" + searchLimit, function () {

                            });

                        }
                    }


                });
                $("#save_create_panel").click(function () {
                    if ($("#project_name").val() == "") {
                        $("#project_name_div").addClass("has-error");
                    } else {
                        $("#project_name_div").removeClass("has-error");
                    }
                    if ($("#project_type_select").val() == 0) {
                        $("#project_type_div").addClass("has-error");
                    } else {
                        $("#project_type_div").removeClass("has-error");
                    }

                    if ($("#project_status_select").val() == 0) {
                        $("#project_status_div").addClass("has-error");
                    } else {
                        $("#project_status_div").removeClass("has-error");
                    }

                    if ($("#project_owner_select").val() == 0) {
                        $("#project_owner_div").addClass("has-error");
                    } else {
                        $("#project_owner_div").removeClass("has-error");
                    }
                    if ($("#project_customer_select").val() == 0) {
                        $("#project_customer_div").addClass("has-error");
                    } else {
                        $("#project_customer_div").removeClass("has-error");
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
                        if (createOrEditState == "Create") {

                            var jqxhr = $.post("../model/SavingProject.php" + data);
                            jqxhr.success(function (reslut) {
                                if (reslut == 1) {
                                    clearProjectInsertFields();
                                    //$('html,body').animate({scrollTop: $('#project_tbl_content').offset().top}, 'slow');
                                    $("#create_edit_panel").hide();
                                    $(".spinner").show();
                                    $("#loading_project").load("project_table_result.php?search_condition=search_all", function () {
                                        $("#create_new_project_btn").show();
                                    });
                                    //$().toastmessage('showSuccessToast', 'บันทึกเรียบร้อยแล้ว');
                                    alert("บันทึกเรียบร้อยแล้ว");
                                } else {
                                    //$().toastmessage('showErrorToast', 'ไม่สามารถบันทึกได้');
                                }
                            });
                            jqxhr.error(function (resultFail) {
                                //$().toastmessage('showWarningToast', "Cannot connect server with: " + resultFail);
                                alert("Cannot connect server with: " + resultFail);
                            });
                        } else {
                            if ($("#project_remark").val() == "") {
//                                $().toastmessage('showNoticeToast', 'กรุณาใส่ Remark');
                                alert('กรุณาใส่ Remark');
                            } else {
                                var jqxhr = $.post("../model/EditProject.php" + data);
                                jqxhr.success(function (result) {
                                    if (result == 1) {
                                        clearProjectInsertFields();
                                        $("#create_edit_panel").hide();
                                        $("#loading_project").load("project_table_result.php?search_condition=search_all", function () {
                                            $("#create_new_project_btn").show();
                                        });
                                        //$().toastmessage('showSuccessToast', 'แก้ไขเรียบร้อยแล้ว');
                                        alert('แก้ไขเรียบร้อยแล้ว');
                                        createOrEditState = "Create";
                                    } else {
                                        $().toastmessage('showErrorToast', 'ไม่สามารถแก้ไขได้');
                                        alert('ไม่สามารถแก้ไขได้');
                                        //alert("Cannot Edit Project");
                                    }
                                });
                                jqxhr.error(function (resultFail) {
//                                    $().toastmessage('showWarningToast', "Cannot connect server with: " + resultFail);
                                    alert("Cannot connect server with: " + resultFail);
                                });
                            }
                        }
                    }
                });
            });
            function deleteProject(projectCode) {


                if (confirm("Are you sure?"))
                {
                    $(".spinner").show();
                    var jqxhr = $.post("../model/DeleteProject.php?project_code=" + projectCode);
                    jqxhr.success(function (data) {
                        if (data == 1) {
                            setTimeout(function ()
                            {
                                //$('html,body').animate({scrollTop: $('#project_tbl_content').offset().top}, 'slow');
                                $("#loading_project").load("project_table_result.php?search_condition=search_all", function () {

                                });
                                $().toastmessage('showSuccessToast', 'ลบข้อมูลเรียบร้อยแล้ว');
                            }
                            , 100);
                        } else {
                            $().toastmessage('showErrorToast', 'ไม่สามารถลบข้อมูลได้');
                        }
                    });
                    jqxhr.error(function (data) {
                        $().toastmessage('showWarningToast', "Cannot connect server with: " + data);
                    });
                }
                else
                {
                    e.preventDefault();
                }

            }
            function clearProjectInsertFields() {
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
                window.location.replace("../qrc-mgr_assign/assign-wo-new.php?project_id=" + projectCode);
            }
            function editProject(projectCode) {
                $("#create_new_project_btn").hide();
                createOrEditState = "Edit";
                $("#create_edit_panel").show();
                $("#loading_ce_form").load("create-edit_form.php", function () {
                    $("#spinnerCE").hide();
                    $('html,body').animate({scrollTop: $('#create_edit_panel').offset().top}, 'slow');
                });
                var millisecondsToWait = 500;
                setTimeout(function () {
                    var jqxhr = $.post("../model/GetAllProjectForEdit.php?project_code=" + projectCode);
                    jqxhr.success(function (data) {
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
                    });
                    jqxhr.error(function (data) {
                        window.location.replace("error.php?error_msg=" + data);
                    });
                }, millisecondsToWait);
            }
        </script>
    </body>

</html>
