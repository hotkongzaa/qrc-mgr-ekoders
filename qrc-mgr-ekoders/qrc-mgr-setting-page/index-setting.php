<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>QRC - Building Management</title>
        <link rel="icon" type="image/ico" href="../images/favicon.ico" />
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            .spinner {
                width: 70px;
                text-align: center;
            }
            #spinnerCE {
                width: 70px;
                text-align: center;
            }
            #spinnerCE > div {
                width: 18px;
                height: 18px;
                background-color: #333;

                border-radius: 100%;
                display: inline-block;
                -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
                animation: bouncedelay 1.4s infinite ease-in-out;
                /* Prevent first frame from flickering when animation starts */
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
            }
            .spinner > div {
                width: 18px;
                height: 18px;
                background-color: #333;

                border-radius: 100%;
                display: inline-block;
                -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
                animation: bouncedelay 1.4s infinite ease-in-out;
                /* Prevent first frame from flickering when animation starts */
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
            }
            #spinnerCE .bounce1 {
                -webkit-animation-delay: -0.32s;
                animation-delay: -0.32s;
            }

            #spinnerCE .bounce2 {
                -webkit-animation-delay: -0.16s;
                animation-delay: -0.16s;
            }
            .spinner .bounce1 {
                -webkit-animation-delay: -0.32s;
                animation-delay: -0.32s;
            }

            .spinner .bounce2 {
                -webkit-animation-delay: -0.16s;
                animation-delay: -0.16s;
            }
            @-webkit-keyframes bouncedelay {
                0%, 80%, 100% { -webkit-transform: scale(0.0) }
                40% { -webkit-transform: scale(1.0) }
            }

            @keyframes bouncedelay {
                0%, 80%, 100% { 
                    transform: scale(0.0);
                    -webkit-transform: scale(0.0);
                } 40% { 
                    transform: scale(1.0);
                    -webkit-transform: scale(1.0);
                }
            }

        </style>
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index-setting.php">QRC-Building Configuration</a><a class="navbar-brand" href="../qrc-mgr_project/project-index.php">back(กลับ)</a>
                </div>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="type_of_service_page/type_of_service_page.php">ประเภทของบริการ</a>
                            </li>
                            <li>
                                <a href="project_status_page/project_status_page.php">สถานะโปรเจค</a>
                            </li>
                            <li>
                                <a href="wo_status_page/wo_status_page.php">สถานะของ Work Order</a>
                            </li>
                            <li>
                                <a href="project_owner_page/project_owner_page.php">เจ้าของโครงการ</a>
                            </li>
                            <li>
                                <a href="project_type_page/project_type_page.php">ประเภทของโครงการ</a>
                            </li>
                            <li>
                                <a href="customer_page/customer_page.php">ชื่อลูกค้า</a>
                            </li>
                            <li>
                                <a href="member_role_page/mem_role_page.php">ตำแหน่ง</a>
                            </li>
                            <li>
                                <a href="invoice_status_page/inv_status_page.php">สถานะของใบเสร็จ</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div id="loader"><br/></div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>
        <style type="text/css">
            .status {
                padding-top: 2px;
                padding-left: 8px;
                vertical-align: top;
                width: 246px;
                white-space: nowrap;
            }
            .textfield {
                width: 150px;
            }
            label.error {
                background:url("../images/unchecked.gif") no-repeat 0px 0px;
                padding-left: 16px;
                padding-bottom: 2px;
                font-weight: bold;
                color: #EA5200;
            }
            label.checked {
                background:url("../images/checked.gif") no-repeat 0px 0px;
            }
            .success_msg {
                font-weight: bold;
                color: #0060BF;
                margin-left: 19px;
            }
        </style>
        <script>

        </script>
    </body>

</html>
