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
    $projectCode = $_GET['project_id'];
    $poCode = $_GET['poCode'];
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
                            <!-- BEGIN COMPONENTS DROPDOWN -->
                            <li class="panel">
                                <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#components">
                                    <i class="fa fa-bar-chart-o"></i> Builder (ทีมช่าง) <span class="fa arrow"></span>
                                </a>
                                <ul class="collapse nav" id="components">
                                    <li>
                                        <a href="portlet.html">
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
                                <a class="active"  href="assign-index.php">
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
                                <a href="../qrc-mgr_reports/reports-index.php" >
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
                                    <li><a href="assign-index.php">Work Order (มอบหมาย)</a></li>
                                    <li class="active">New Work Order(สร้างมอบหมายใหม่)</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->	

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1>New Work Order(สร้างมอบหมายใหม่)  <span class="sub-title">Content Overview</span></h1>									
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
                                    <div class="col-lg-9">

                                        <div class="portlet">
                                            <div class="portlet-heading dark">
                                                <div class="portlet-title">
                                                    <h4><i class="fa fa-list-ul"></i> Create WO Assignment</h4>
                                                </div>
                                                <div class="portlet-widgets">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#create" class=""><i class="fa fa-chevron-down"></i></a>

                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div id="create" class="panel-collapse collapse in">
                                                <div class="portlet-body">
                                                    <div class="alert alert-danger" id="alert_inform">
                                                        <strong>Please enter/select require fields</strong> 
                                                        <span id="alert_information">Change a few things up and try submitting again.</span>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <div >
                                                            <label for="project_plan_size">WO Name (ชื่องาน)</label>
                                                            <input type="text" id="wo_name" name="wo_name" class="form-control" disabled="true"/>
                                                            <div class="separator"></div>
                                                        </div>
                                                        <div >
                                                            <label for="project_code">Project Code (หมายเลขโครงการ)</label>
                                                            <!-- <input type="text" id="project_code_orderPage" name="project_code" class="col-md-6 form-control" disabled="true" /> -->
                                                            <select class="form-control" id="project_code_orderPage" name="project_code_orderPage">
                                                                <option value="0"></option>
                                                                <?php
                                                                $sqlSelectProjectType = "SELECT * FROM QRC_PROJECT;";
                                                                $resultSet = mysql_query($sqlSelectProjectType);
                                                                while ($row = mysql_fetch_array($resultSet)) {
                                                                    echo '<option value="' . $row['project_code'] . '">' . $row['project_name'] . '</option>';
                                                                }
                                                                ?>      
                                                            </select>
                                                            <div class="separator"></div>
                                                        </div>
                                                        <div >
                                                            <label for="project_order_status">Status (สถานะ)</label>
                                                            <select class="form-control" id="project_order_status" name="project_order_status" disabled="true">
                                                                <option value="New">New</option>
                                                                <option value="Assign">Assign</option>
                                                                <option value="Pending">Pending</option>
                                                                <option value="Cancel">Cancel</option>
                                                                <option value="Complete">Complete</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                            <div class="separator"></div>
                                                        </div>
                                                        <div class="separator"></div>
                                                        <div id="assign_case">

                                                            <form id="assign_detail_in_order_page">
                                                                <div >
                                                                    <label for="project_plan_size">Project Manager (ผู้จัดการโครงการ)</label>
                                                                    <input type="text" id="wo_project_managers" name="project_plan_size" class="col-md-6 form-control" disabled="true"/>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div >
                                                                    <label for="project_unit_price">Project Foreman (ผู้ควบคุมงานของโครงการ)</label>
                                                                    <input type="text" id="wo_project_foreman" name="wo_project_foreman" class="col-md-6 form-control" disabled="true"/>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div >
                                                                    <label for="project_amount">Supervisor Control (ผู้ควบคุมงานของลูกค้า)</label>
                                                                    <input type="text" id="wo_supervisor_control" name="wo_supervisor_control" class="col-md-6 form-control" disabled="true"/>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div  id="team_code_error">
                                                                    <label for="project_vat">Team Code (หมายเลขทีมช่าง) *</label>
                                                                    <!--<input type="text" id="wo_team_code" name="wo_team_code" class="col-md-6 form-control"/>-->
                                                                    <select class="form-control" id="wo_team_code" name="wo_team_code">
                                                                        <option value="0"></option>
                                                                        <?php
                                                                        $sqlSelectProjectType = "SELECT * FROM QRC_TEAM_BUILDER;";
                                                                        $resultSet = mysql_query($sqlSelectProjectType);
                                                                        while ($row = mysql_fetch_array($resultSet)) {
                                                                            echo '<option value="' . $row['tCode'] . '">' . $row['tCode'] . '</option>';
                                                                        }
                                                                        ?>      
                                                                    </select>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div >
                                                                    <label for="project_vat">Team Name (ชื่อทีม) *</label>
                                                                    <input type="text" id="wo_team_name" name="wo_team_name" class="col-md-6 form-control" disabled="true"/>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div >
                                                                    <label for="project_vat">Assign Date (วันที่)</label>
                                                                    <input type="text" id="wo_assign_date" name="wo_assign_date" class="col-md-6 form-control" disabled="true"/>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div >
                                                                    <label for="project_vat">Target Date (วันที่)</label>
                                                                    <input type="text" id="wo_target_date" name="wo_target_date" class="col-md-6 form-control search_date" data-date-format="yyyy-mm-dd"/>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div >
                                                                    <label for="project_vat">Remark</label>
                                                                    <input type="text" id="wo_remark" name="wo_remark" class="col-md-6 form-control"/>
                                                                    <div class="separator"></div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div id="complete_case">
                                                            <form id="complete_detail_in_order_page">
                                                                <div >
                                                                    <label for="inspection_order_type_form">Inspection No. (เลขที่ใบสั่งจ้าง):</label>
                                                                    <select class="form-control" id="inspection_order_type_form" name="inspection_order_type_form">
                                                                        <option value=""></option>
                                                                        <?php
                                                                        $sqlSelectMemType = "SELECT * FROM QRC_INSPECTION;";
                                                                        $resultSets = mysql_query($sqlSelectMemType);
                                                                        while ($row = mysql_fetch_array($resultSets)) {
                                                                            echo '<option value="' . $row['INS_ID'] . '">' . $row['INS_INSPECTION_NO'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <div class="separator"></div>
                                                                </div>
                                                                <div >
                                                                    <label for="project_unit_price">Inspection Date (วันที่):</label>
                                                                    <input type="text" class="form-control" id="inspection_date_form" name="inspection_date_form" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" disabled="true">
                                                                    <div class="separator"></div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div >
                                                            <label for="wo_order_type">WO. Order Type</label>
                                                            <select class="form-control" id="wo_order_type" name="wo_order_type">
                                                                <option value="ติดตั้ง">ติดตั้ง</option>
                                                                <option value="แก้ไข">แก้ไข</option>
                                                                <option value="ซ่อมแซม">ซ่อมแซม</option>
                                                                <option value="รื้อถอน">รื้อถอน</option>
                                                            </select>
                                                            <div class="separator"></div>
                                                        </div>
                                                        <div >
                                                            <label for="project_po_no">PO Code. (เลขที่ใบสั่งจ้าง)</label>

                                                            <select class="form-control" id="po_no_no" name="po_no_no">

                                                            </select>
                                                            <div class="separator"></div>
                                                        </div>
                                                        <div >
                                                            <label for="project_document_no">WO Price</label>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon">฿</span>
                                                                <input type="text" id="wo_price" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div >
                                                            <label for="project_plan">% Of PO</label>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon">%</span>
                                                                <input type="text" id="perc_of_po" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div  id="shown_remark">
                                                            <label for="project_order_remark">Remark</label>
                                                            <textarea rows="4" cols="30" class="form-control" id="project_order_remark" name="project_order_remark"></textarea>
                                                            <div class="separator"></div>
                                                        </div>
                                                        <div>
                                                            <button class = "btn btn-primary " style="margin-top: 10px; margin-right: 10px;" id="save_wo_form">Save (บันทึก)</button>                                                                                
                                                            <button class = "btn btn-red " style="margin-top: 10px;" id="reset_wo_form">Cancel (ยกเลิก)</button> 

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">

                                        <div class="portlet">
                                            <div class="portlet-heading dark">
                                                <div class="portlet-title">
                                                    <h4><i class="fa fa-list-ul"></i> PO Detai</h4>
                                                </div>
                                                <div class="portlet-widgets">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#recent" class=""><i class="fa fa-chevron-down"></i></a>

                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div id="recent" class="panel-collapse collapse in">
                                                <div class="portlet-body">
                                                    <div >
                                                        <label for="project_document_no">Document No. (เลขที่)</label>
                                                        <input type="text" id="project_document_no" name="project_document_no" class="col-md-6 form-control" disabled="true"/>
                                                        <div class="separator"></div>
                                                    </div>
                                                    <div >
                                                        <label for="project_plan">Plan (แบบบ้าน)*</label>
                                                        <input type="text" id="project_plan" name="project_plan" class="col-md-6 form-control" disabled="true"/>
                                                        <div class="separator"></div>
                                                    </div>
                                                    <div >
                                                        <label for="project_plot">Plot (แปลงบ้าน)*</label>
                                                        <input type="text" id="project_plot" name="project_plot" class="col-md-6 form-control" disabled="true"/>
                                                        <div class="separator"></div>
                                                    </div>
                                                    <div >
                                                        <label for="project_po_owner">PO Owner. (เจ้าของ PO)</label>
                                                        <input type="text" id="project_po_owner" name="project_po_owner" class="col-md-6 form-control" disabled="true"/>
                                                        <div class="separator"></div>
                                                    </div>
                                                    <div >
                                                        <label for="project_po_sender">PO Sender. (จนท. PO)</label>
                                                        <input type="text" id="project_po_sender" name="project_po_sender" class="col-md-6 form-control" disabled="true"/>
                                                        <div class="separator"></div>
                                                    </div>
                                                    <div >
                                                        <label for="project_issue_date">Issue Date (วันที่)</label>
                                                        <input type="text" id="project_issue_date" name="project_issue_date" class="col-md-6 form-control" disabled="true"/>
                                                        <div class="separator"></div>
                                                    </div>
                                                    <div >
                                                        <label for="project_order_type">Order Type (ประเภทงาน)</label>
                                                        <select class="form-control" id="project_order_type" name="project_order_type" disabled="true">
                                                            <option value="0">---Please select---</option>
                                                            <?php
                                                            $sqlSelectProjectType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                                                            $resultSet = mysql_query($sqlSelectProjectType);
                                                            while ($row = mysql_fetch_array($resultSet)) {
                                                                echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                                                            }
                                                            ?>      
                                                        </select>
                                                        <div class="separator"></div>
                                                    </div>
                                                    <div >
                                                        <label for="project_plan_size">Plan Size (ขนาด ตร.ม.)</label>
                                                        <input type="text" id="project_plan_size" name="project_plan_size" class="form-control" disabled="true"/>
                                                        <div class="separator"></div>
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
            <div class="col-md-12" style="visibility: hidden;">
                <label for="project_unit_price">Unit Price (ราคาต่อหน่วย)</label>
                <input type="text" id="project_unit_price" name="project_unit_price" class="col-md-6 form-control" disabled="true"/>
                <div class="separator"></div>
            </div>
            <div class="col-md-12" style="visibility: hidden;">
                <label for="project_amount">Amount (ราคารวม)</label>
                <input type="text" id="project_amount" name="project_amount" class="col-md-6 form-control" disabled="true"/>
                <div class="separator"></div>
            </div>
            <div class="col-md-12" style="visibility: hidden;">
                <label for="project_vat">Grand Total included VAT 7%</label>
                <input type="text" id="project_vat" name="project_vat" class="col-md-6 form-control" disabled="true"/>
                <div class="separator"></div>
            </div>
        </div>
        <input type="hidden" id="project_po_no_name">
        <input type="hidden" id="project_oid">
        <input type='hidden' id='service_name_value'/>

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
            $(document).ready(function() {

                $("#alert_inform").hide();
                $("#left-menu-load").load("../leftmenu-page/index-left-menu.php");
                var m_names = new Array("มกราคม", "กุมภาพันธ์", "มีนาคม",
                        "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน",
                        "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                var d = new Date();
                var curr_date = d.getDate();
                var curr_month = d.getMonth();
                var curr_year = d.getFullYear();
                $("#project_issue_date").val(curr_date + " " + m_names[curr_month]
                        + " " + (curr_year + 543));
                $("#wo_assign_date").val(curr_date + " " + m_names[curr_month]
                        + " " + (curr_year + 543));
                $("#assign_case, #complete_case").hide();
                $(".search_date").datepicker();
                $("#update_project_status").load("../menu-page/project_menu_page.php", function() {
                    $(".spinner").hide();
                });
                $("#reset_wo_form").click(function() {
                    window.location.assign("assign-index.php");
                });
                $("#wo_team_code").change(function() {
                    var tCode = $("#wo_team_code").val();
                    var jqxhr = $.post("../model/GetAllTeamForEdit.php?teamID=" + tCode);
                    jqxhr.success(function(data) {
                        //$.unblockUI();
                        obj = JSON.parse(data);
                        $("#wo_team_name").val(obj.t_Name);
                    });
                    jqxhr.error(function(data) {
                        window.location.replace("error.php?error_msg=" + data);
                    });
                });

                $("#wo_price").change(function() {
                    if ($("#project_amount").val() == "") {
                        $("#alert_inform").show();
                        $("#alert_information").html('<br/>- Please select PO Code(เลขที่ใบสั่งจ้าง)');
                        $('html,body').animate({scrollTop: $('#alert_inform').offset().top}, 400);
                    } else {
                        $("#alert_inform").hide();
                        var result = ($("#wo_price").val() * 100) / $("#project_amount").val();
                        $("#perc_of_po").val(result);
                    }
                });
                $("#perc_of_po").change(function() {
                    if ($("#project_amount").val() == "") {
                        $("#alert_inform").show();
                        $("#alert_information").html('<br/>- Please select PO Code(เลขที่ใบสั่งจ้าง)');
                        $('html,body').animate({scrollTop: $('#alert_inform').offset().top}, 400);
                    } else {
                        $("#alert_inform").hide();
                        var result = ($("#perc_of_po").val() * $("#project_amount").val()) / 100;
                        $("#wo_price").val(result);
                    }
                });
                $("#po_no_no").change(function() {
                    var po_id = $("#po_no_no").val();
                    var jqxhr = $.post("../model/GetWorkOrderByPOID.php?po_id=" + po_id);
                    jqxhr.success(function(data) {
                        obj = JSON.parse(data);
                        $("#project_plan").val(obj.PO_HOME_PLAN);
                        $("#project_plot").val(obj.PO_HOME_PLOT);
                        $("#project_document_no").val(obj.PO_DOCUMENT_NO);
                        $("#project_po_owner").val(obj.PO_OWNER);
                        $("#project_po_sender").val(obj.PO_SENDER);
                        $("#project_order_type").val(obj.order_type_name);
                        $("#project_plan_size").val(obj.PO_PLAN_SIZE);
                        $("#project_unit_price").val(obj.PO_UNIT_PRICE);
                        $("#project_amount").val(obj.PO_AMOUNT);
                        $("#project_vat").val(obj.PO_VAT);
                        $("#project_po_no_name").val(obj.PO_PO_NO);
                        $("#project_po_no_id").val(obj.po_id);
                        //$.unblockUI();
                        var orderType = $("#wo_order_type").val();
                        if ($("#po_no_no").val() == 0 || $("#po_no_no").val() == "0") {
                            $("#wo_name").val("");
                        } else {
                            $("#wo_name").val(orderType + obj.service_name + " Plan:" + obj.PO_HOME_PLAN + ", Plot:" + obj.PO_HOME_PLOT);
                        }
                        $("#service_name_value").val(obj.service_name);
                    });
                    jqxhr.error(function(data) {
                        window.location.replace("error.php?error_msg=" + data);
                    });
                });
                $("#wo_order_type").change(function() {
                    var orderType = $("#wo_order_type").val();
                    var po_value = $("#po_no_no").val();
                    if (po_value == "null" || po_value == null) {

                    } else {
                        if (po_value != 0 || po_value != "0") {
                            $("#wo_name").val($("#wo_order_type").val() + $("#service_name_value").val() + " " + $("#project_plan").val() + $("#project_plot").val());
                        }
                    }

                });
                $("#inspection_order_type_form").change(function() {
                    var insID = $(this).val();
                    var jqxhr = $.post("../model/GetInspectionByID.php?ins_id=" + insID);
                    jqxhr.success(function(data) {
                        obj = JSON.parse(data);
                        $("#inspection_date_form").val(obj.INS_DATE);
                    });
                    jqxhr.error(function(data) {
                        window.location.replace("error.php?error_msg=" + data);
                    });
                });

                if ("<?= $projectCode ?>" != "") {
                    $("#project_code_orderPage").val("<?= $projectCode ?>");
                    var jqxhr = $.post("../model/GetPoByProjectID.php?project_code=" + "<?= $projectCode ?>");
                    jqxhr.success(function(data) {
                        if ("<?= $poCode ?>" != "") {
                            $("#po_no_no").html(data);
                            $("#po_no_no").val("<?= $poCode ?>");
                            var jqxhr = $.post("../model/GetWorkOrderByPOID.php?po_id=" + "<?= $poCode ?>");
                            jqxhr.success(function(data) {
                                obj = JSON.parse(data);
                                $("#project_plan").val(obj.PO_HOME_PLAN);
                                $("#project_plot").val(obj.PO_HOME_PLOT);
                                $("#project_document_no").val(obj.PO_DOCUMENT_NO);
                                $("#project_po_owner").val(obj.PO_OWNER);
                                $("#project_po_sender").val(obj.PO_SENDER);
                                $("#project_order_type").val(obj.order_type_name);
                                $("#project_plan_size").val(obj.PO_PLAN_SIZE);
                                $("#project_unit_price").val(obj.PO_UNIT_PRICE);
                                $("#project_amount").val(obj.PO_AMOUNT);
                                $("#project_vat").val(obj.PO_VAT);
                                $("#project_po_no_name").val(obj.PO_PO_NO);
                                $("#project_po_no_id").val(obj.po_id);
                                //$.unblockUI();
                                var orderType = $("#wo_order_type").val();
                                if ($("#po_no_no").val() == 0 || $("#po_no_no").val() == "0") {
                                    $("#wo_name").val("");
                                } else {
                                    $("#wo_name").val(orderType + obj.service_name + " Plan:" + obj.PO_HOME_PLAN + ", Plot:" + obj.PO_HOME_PLOT);
                                }
                                $("#service_name_value").val(obj.service_name);
                            });
                            jqxhr.error(function(data) {
                                window.location.replace("error.php?error_msg=" + data);
                            });
                        }
                    });
                    jqxhr.error(function(data) {
                        window.location.replace("error.php?error_msg=" + data);
                    });
                }
                $("#project_code_orderPage").change(function() {
                    var projectCodeVal = $("#project_code_orderPage").val();
                    var jqxhr = $.post("../model/GetPoByProjectID.php?project_code=" + projectCodeVal);
                    jqxhr.success(function(data) {
                        $("#po_no_no").html(data);
                    });
                    jqxhr.error(function(data) {
                        window.location.replace("error.php?error_msg=" + data);
                    });
                });


                $("#project_order_status").change(function() {
                    if ($(this).val() == "Assign") {
                        var project_code = $("#project_code_orderPage").val();
                        var jqxhr = $.post("../model/GetAllProjectForEdit.php?project_code=" + project_code);
                        jqxhr.success(function(data) {
                            //$.unblockUI();
                            obj = JSON.parse(data);
                            $("#wo_project_managers").val(obj.project_manager);
                            $("#wo_project_foreman").val(obj.project_foreman);
                            $("#wo_supervisor_control").val(obj.supervisor_control);
                            setTimeout(function()
                            {
                                $("#assign_case").show("fast");
                            }
                            , 300);
                        });
                        jqxhr.error(function(data) {
                            window.location.replace("error.php?error_msg=" + data);
                        });
                        $("#assign_case").show("fast");
                        $("#complete_case").hide("fast");
                    } else if ($(this).val() == "Complete") {
                        $("#assign_case").hide("fast");
                        $("#complete_case").show("fast");
                    } else {
                        $("#assign_case").hide("fast");
                        $("#complete_case").hide("fast");
                    }
                });
            });
            $("#save_wo_form").click(function() {
                var project_code = $("#project_code_orderPage").val();
                var project_order_status = $("#project_order_status").val();
                var project_home_plan = $("#project_plan").val();
                var project_home_plot = $("#project_plot").val();
                var project_document_no = $("#project_document_no").val();
                var project_po_no = $("#project_po_no_name").val();
                var project_po_owner = $("#project_po_owner").val();
                var project_po_sender = $("#project_po_sender").val();
                var project_order_type = $("#project_order_type").val();
                var project_plan_size = $("#project_plan_size").val();
                var project_unit_price = $("#project_unit_price").val();
                var project_amount = $("#project_amount").val();
                var project_vat = $("#project_vat").val();
                var poid = $("#project_po_no_id").val();
                var poForEdit = $("#po_no_no").val();
                var project_order_remark = $("#project_order_remark").val();
                var order_id = $("#project_oid").val();
                var wo_name = $("#wo_name").val();
                var wo_team_code = $("#wo_team_code").val();
                var teamCode = $("#wo_team_code").val();
                var wo_assign_date = $("#wo_assign_date").val();
                var wo_target_date = $("#wo_target_date").val();
                var wo_remark = $("#wo_remark").val();
                var orderType = $("#wo_order_type").val();
//            alert(orderType);
                var wo_price = $("#wo_price").val();
                var perc_of_po = $("#perc_of_po").val();
                // alert(project_order_status);
                //Save State
                if (project_code == 0) {
                    $("#alert_inform").show();
                    $("#alert_information").html('<br/>- Please select project Code(หมายเลขโครงการ)');
                    //$('html,body').animate({scrollTop: $('#alert_inform').offset().top}, 400);
                }
                if ($("#po_no_no").val() == 0) {
                    $("#alert_inform").show();
                    $("#alert_information").html('<br/>- Please select PO Code(เลขที่ใบสั่งจ้าง)');
                    //$('html,body').animate({scrollTop: $('#alert_inform').offset().top}, 400);
                }
                if ($("#wo_price").val() == "" || $("#perc_of_po").val() == "" || $("#wo_price").val() == "0" || $("#perc_of_po").val() == "0") {
                    $("#alert_inform").show();
                    $("#alert_information").html('<br/>- Please enter WO Price or % Of PO');
                    //$('html,body').animate({scrollTop: $('#alert_inform').offset().top}, 400);
                }
                if (project_code != 0 && $("#po_no_no").val() != 0 && $("#wo_price").val() != "" && $("#perc_of_po").val() != "" && $("#wo_price").val() != "0" && $("#perc_of_po").val() != "0") {
                    if (project_order_status == "New") {

                        var jqxhr = $.post("../model/SavingProjectOrder.php?project_code=" + project_code +
                                "&project_order_status=" + project_order_status +
                                "&project_home_plan=" + project_home_plan +
                                "&project_home_plot=" + project_home_plot +
                                "&project_document_no=" + project_document_no +
                                "&project_po_no=" + project_po_no +
                                "&project_po_owner=" + project_po_owner +
                                "&project_po_sender=" + project_po_sender +
                                "&project_order_type=" + project_order_type +
                                "&project_plan_size=" + project_plan_size +
                                "&project_unit_price=" + project_unit_price +
                                "&project_amount=" + project_amount +
                                "&project_image_path=" + poForEdit +
                                "&wo_name=" + wo_name +
                                "&orderType=" + orderType +
                                "&project_vat=" + project_vat +
                                "&wo_price=" + wo_price +
                                "&perc_of_po=" + perc_of_po);
                        jqxhr.success(function(data) {
                            if (data == 1) {
                                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                                //$().toastmessage('showSuccessToast', 'บันทึกข้อมูลเรียบร้อยแล้ว');
                                window.location.assign("assign-index.php");
                            } else {
                                alert('ไม่สามารถบันทึกข้อมูลได้');
                                //$().toastmessage('showErrorToast', 'ไม่สามารถบันทึกข้อมูลได้');
                            }
                        });
                        jqxhr.error(function(data) {
                            window.location.replace("error.php?error_msg=" + data);
                        });
                    }
                }


            });
        </script>
    </body>

</html>
