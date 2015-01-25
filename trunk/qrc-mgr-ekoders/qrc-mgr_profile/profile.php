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
        require '../model/com.qrc.mgr.model/UserVO.php';
        $config = require '../model-db-connection/qrc_conf.properties.php';
        $sqlVerifyUser = "SELECT *"
                . " FROM QRC_USERS qu"
                . " WHERE qu.username='" . $_SESSION['username'] . "';";
        $userVO = new UserVO();
        $sqlGetUser = mysql_query($sqlVerifyUser);
        if (mysql_num_rows($sqlGetUser) == 1) {
            $row = mysql_fetch_assoc($sqlGetUser);
            $userVO->setUsername($row['username']);
            $userVO->setPassword($row['password']);
            $userVO->setFirstName($row['fName']);
            $userVO->setLastName($row['lName']);
            $userVO->setEmail($row['email']);
            $userVO->setPermissionType($row['permission_id']);
            $userVO->setCompanyName($row['company']);
            $userVO->setDetailAboutMe($row['about_me']);
            $userVO->setAddress($row['address']);
            $userVO->setCity($row['city']);
            $userVO->setState($row['state']);
            $userVO->setZipcode($row['zipcode']);
            $userVO->setCountry($row['country']);
            $userVO->setPhonenumber($row['phonenumber']);
            $userVO->setImgUrl($row['img_url']);
        }
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
        <link rel="stylesheet" href="../assets/css/plugins/bootstrap-wysihtml/bootstrap-wysihtml5.css">
        <link rel="stylesheet" href="../assets/css/plugins/bootstrap-editable/bootstrap-editable.css">
        <link rel="stylesheet" href="../assets/css/plugins/bootstrap-datepicker/datepicker.css">
        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <link rel="stylesheet" type="text/css" href="../assets/css/plugins/gritter/jquery.gritter.css" />

        <!-- Tc core CSS -->
        <link id="qstyle" rel="stylesheet" href="../assets/css/themes/style.css">	
        <!--[if lte IE 8]>
                <link rel="stylesheet" href="../assets/css/ie-fix.css" />
        <![endif]-->


        <!-- Add custom CSS here -->

        <!-- End custom CSS here -->

        <!--[if lt IE 9]>
        <script src="../assets/js/html5shiv.js"></script>
        <script src="../assets/js/respond.min.js"></script>
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
                                    <img class="img-circle" src="../images/uploads/<?= $userVO->getImgUrl() ?>" alt=""> <span class="user-info"> <?= $_SESSION['username']; ?></span> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li>
                                        <a href="profile.php">
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
                                    <li class="active">User Profile</li>
                                </ul>
                            </div>
                            <!-- END BREADCRUMB -->

                            <div class="page-header title">
                                <!-- PAGE TITLE ROW -->
                                <h1><?= $userVO->getFirstName(); ?><span class="sub-title">Profile</span></h1>									
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

                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                    <!-- END PAGE HEADING ROW -->					
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- START YOUR CONTENT HERE -->
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="well well-sm white">

                                        <div class="profile-pic">
                                            <a href="#">
                                                <img src="../images/uploads/<?= $userVO->getImgUrl() ?>" class="img-responsive"  alt="">
                                            </a>
                                        </div>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                        <button type="button" class="btn btn-file" id="uploadImage">Upload Image</button>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <div class="tc-tabs"><!-- Nav tabs style 1 -->
                                        <ul class="nav nav-tabs tab-lg-button tab-color-dark background-dark white">
                                            <li class="active"><a href="#p2" data-toggle="tab"><i class="fa fa-desktop bigger-130"></i>Edit Account</a></li>

                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">                                            
                                            <div class="tab-pane fade in active" id="p2">
                                                <h2>Account details</h2>
                                                <div class="hr hr-12 hr-double"></div>
                                                <form class="form-horizontal" role="form" method="post">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">User name:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?= $userVO->getUsername() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">First Name:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?= $userVO->getFirstName() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Last Name:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?= $userVO->getLastName() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Company:</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" value="<?= $userVO->getCompanyName() ?>">
                                                        </div>
                                                    </div>													
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Email</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                                <input type="email" class="form-control" value="<?= $userVO->getEmail() ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="separator">

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"></label>
                                                        <div class="col-sm-9">
                                                            <div class="tcb">
                                                                <label>
                                                                    <input type="checkbox" class="tc tc-red">
                                                                    <span class="labels"> Tick to Pasword Modifaction</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="myPassword" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Existing Password:</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" id="form-field-1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">New Password:</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" id="form-field-2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Confirm New Password:</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" id="form-field-3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="separator">

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">About Me:</label>
                                                        <div class="col-sm-9">
                                                            <textarea id="about-editor" class="form-control" rows="10"><?= $userVO->getDetailAboutMe() ?></textarea>
                                                        </div>
                                                    </div>													
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Address:</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" value="<?= $userVO->getAddress() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">City:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?= $userVO->getCity() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">State/Region:</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" value="<?= $userVO->getState() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Zip code:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?= $userVO->getZipcode() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Country:</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" value="<?= $userVO->getCountry() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Phone Number:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" value="<?= $userVO->getPhonenumber() ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-3 col-sm-9">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                <button type="submit" class="btn btn-inverse">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!--nav-tabs style 1-->
                                </div>
                            </div>		
                            <!-- END YOUR CONTENT HERE -->

                        </div>
                    </div>

                    <!-- BEGIN FOOTER CONTENT -->		
                    <div class="footer">
                        <div class="footer-inner">
                            <!-- basics/footer -->
                            <div class="footer-content">
                                &copy; 2014 <a href="http://qrc.co.th">qrc-building</a>, All Rights Reserved.
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
        <script src="../assets/js/plugins/bootstrap-wysihtml/wysihtml.min.js"></script>
        <script src="../assets/js/plugins/bootstrap-wysihtml/bootstrap-wysihtml.js"></script>
        <script src="../assets/js/plugins/bootstrap-editable/bootstrap-editable.min.js"></script>
        <script src="../assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

        <!-- Themes Core Scripts -->	
        <script src="../assets/js/main.js"></script>

        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <script src="../assets/js/speech-commands.js"></script>
        <script src="../assets/js/plugins/gritter/jquery.gritter.min.js"></script>

        <!-- initial page level scripts for examples -->
        <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.init.js"></script>
        <script src="../assets/js/qrc-mgr_configuration.js"></script>
        <script type="text/javascript" src="../assets/js/jquery.uploadfile.js"></script>
        <link rel="stylesheet" type="text/css" href="../assets/css/uploadfile.css" media="screen" />
        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#uploadImage").on('click', function () {
                                                    var file_data = $('#fileToUpload').prop('files')[0];
                                                    var form_data = new FormData();
                                                    form_data.append('file', file_data);
                                                    $.ajax({
                                                        url: '../model/com.qrc.mgr.controller/UploadProfileImage.php?userID=' + "<?= $row['id'] ?>",
                                                        dataType: 'text',
                                                        cache: false,
                                                        contentType: false,
                                                        processData: false,
                                                        data: form_data,
                                                        type: 'post',
                                                        success: function (php_script_response) {
                                                            if (php_script_response == 200) {
                                                                window.location = "profile.php";
                                                            } else {
                                                                alert(php_script_response);
                                                            }
                                                        }
                                                    });
                                                });
                                                $(":checkbox").click(function (event) {
                                                    if ($(this).is(":checked"))
                                                        $(".myPassword").show();
                                                    else
                                                        $(".myPassword").hide();
                                                });

                                                // wysihtml editor
                                                $('#about-editor').wysihtml5();

                                                //toggle `popup` / `inline` mode
                                                $.fn.editable.defaults.mode = 'inline';

                                                //make email editable
                                                $(function () {
                                                    $('#email').editable({
                                                        //uncomment bellow lines to send data on server
                                                        //pk: 1,
                                                        //url: '/post',
                                                        title: 'Update your email',
                                                        mode: 'inline', //can also use popup
                                                    });
                                                });
                                                //make date editable with bootstrap datepicker plugin
                                                $(function () {
                                                    $('#dob').editable({
                                                        type: 'date',
                                                        format: 'yyyy-mm-dd',
                                                        viewformat: 'dd/mm/yyyy',
                                                        title: 'Date of Birth',
                                                        placement: 'right',
                                                        datepicker: {
                                                            weekStart: 1
                                                        }
                                                    });
                                                });
                                                //custome button style for editable			
                                                $.fn.editableform.buttons =
                                                        '<button type="submit" class="btn btn-primary editable-submit btn-sm"><i class="fa fa-check icon-only"></i></button>' +
                                                        '<button type="button" class="btn editable-cancel btn-inverse btn-sm"><i class="fa fa-times icon-only"></i></button>';

                                                // for more document http://vitalets.github.io/x-editable/docs.html

                                                $('.datepicker').datepicker();
                                            });
        </script>	
    </body>
</html>