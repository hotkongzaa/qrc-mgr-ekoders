<?php include("model-db-connection/DBConnection.inc"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>QRC - Building Management</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/fonts.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

        <!-- PAGE LEVEL PLUGINS STYLES -->
        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <link rel="stylesheet" type="text/css" href="assets/css/plugins/gritter/jquery.gritter.css" />	

        <!-- Tc core CSS -->
        <link id="qstyle" rel="stylesheet" href="assets/css/themes/style.css">	
        <!--[if lte IE 8]>
                <link rel="stylesheet" href="assets/css/ie-fix.css" />
        <![endif]-->


        <!-- Add custom CSS here -->

        <!-- End custom CSS here -->

        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="login">
        <div id="wrapper">
            <!-- BEGIN MAIN PAGE CONTENT -->

            <div class="login-container">

                <!-- BEGIN LOGIN BOX -->
                <div id="login-box" class="login-box visible">					
                    <p class="bigger-110">
                        <i class="fa fa-key"></i> Please Enter Your Information
                    </p>

                    <div class="hr hr-8 hr-double dotted"></div>

                    <form method="post" id="form-signin">
                        <div class="form-group">
                            <div class="input-icon right">
                                <span class="fa fa-key text-gray"></span>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon right">
                                <span class="fa fa-lock text-gray"></span>
                                <input type="password" name="password" id="password" class="form-control" placeholder="your password">
                            </div>
                        </div>
                        <div class="tcb">
                            <label>
                                <input type="checkbox" class="tc">
                                <span class="labels"> Remember me</span>
                            </label>
                            <a href="#" id="submit" class="pull-right btn btn-primary">Login<i class="fa fa-key icon-on-right"></i></a>
                            <div class="clearfix"></div>
                        </div>				

                        <div class="footer-wrap">
                            <span class="pull-left">
                                <a href="#" onclick="show_box('forgot-box');
                                        return false;"><i class="fa fa-angle-double-left"></i> Forgot password?</a>
                            </span>
                            <div class="clearfix"></div>
                        </div>							
                    </form>
                </div>
                <!-- END LOGIN BOX -->

                <!-- BEGIN FORGOT BOX -->
                <div id="forgot-box" class="login-box">				
                    <p class="bigger-110">
                        <i class="fa fa-key"></i> Retrieve Password
                    </p>

                    <div class="hr hr-8 hr-double dotted"></div>

                    <form method="post">
                        <div class="form-group">
                            <div class="input-icon right">
                                <span class="fa fa-envelope text-gray"></span>
                                <input type="email" class="form-control" placeholder="Email">
                                <span class="help-block">Enter your email and to receive instructions</span>
                            </div>
                        </div>
                        <a href="#" class="pull-right btn btn-danger">Submit</a>

                        <div class="clearfix"></div>

                        <div class="footer-wrap">
                            <a href="#" onclick="show_box('login-box');
                                    return false;">Back to login <i class="fa fa-angle-double-right"></i></a>
                        </div>							
                    </form>					
                </div>
                <!-- END FORGOT BOX -->
            </div>

            <!-- Modal For Terms and Conditions -->
            <div class="modal fade" id="Myterms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
                        </div>
                        <div class="modal-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">I Agree</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <!-- END MAIN PAGE CONTENT --> 
        </div> 

        <!-- core JavaScript -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/js/plugins/pace/pace.min.js"></script>

        <!-- PAGE LEVEL PLUGINS JS -->

        <!-- Themes Core Scripts -->	
        <script src="assets/js/main.js"></script>

        <!-- REQUIRE FOR SPEECH COMMANDS -->
        <script src="assets/js/speech-commands.js"></script>
        <script src="assets/js/plugins/gritter/jquery.gritter.min.js"></script>	

        <!-- initial page level scripts for examples -->	
        <script type="text/javascript">
                                $(document).ready(function() {
                                    // alert(login_data);
                                    $("#password").keyup(function(event) {
                                        if (event.keyCode == 13) {
                                            if ($("#username").val() == "" || $("#password").val() == "") {
                                                alert("กรุณาใส่ username หรือ password ให้ถูกต้อง");
                                            } else {
                                                var login_data = $("#form-signin").serialize();
                                                var jqxhr = $.post("model/VerifyUsernameAndPassword.php?" + login_data);
                                                jqxhr.success(function(data) {
                                                    if (data == 1) {
                                                        window.location.assign("qrc-mgr_project/project-index.php");
                                                    }
                                                    if (data == 2) {
                                                        alert("Username หรือ password ไม่ถูกต้อง");
                                                    }
                                                });
                                                jqxhr.error(function() {
                                                    alert("ไม่สามารถเชื่อมต่อกับ Server ได้");
                                                });
                                            }
                                        }
                                    });
                                    $("#submit").click(function() {
                                        if ($("#username").val() == "" || $("#password").val() == "") {
                                            alert("กรุณาใส่ username หรือ password ให้ถูกต้อง");
                                        } else {
                                            var login_data = $("#form-signin").serialize();
                                            var jqxhr = $.post("model/VerifyUsernameAndPassword.php?" + login_data);
                                            jqxhr.success(function(data) {
                                                if (data == 1) {
                                                    window.location.assign("qrc-mgr_project/project-index.php");
                                                }
                                                if (data == 2) {
                                                    alert("Username หรือ password ไม่ถูกต้อง");
                                                }
                                            });
                                            jqxhr.error(function() {
                                                alert("ไม่สามารถเชื่อมต่อกับ Server ได้");
                                            });
                                        }
                                    });
                                });
                                function show_box(id) {
                                    jQuery('.login-box.visible').removeClass('visible');
                                    jQuery('#' + id).addClass('visible');
                                }
        </script>

    </body>
</html>