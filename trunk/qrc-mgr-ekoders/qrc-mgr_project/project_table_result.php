<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo '<script type="text/javascript">var r=confirm("Session expire (30 mins)!"); if(r==true){window.location.href="../index.php";}else{window.location.href="index.php";}</script>';
    } else {
        require '../model-db-connection/config.php';
        $config = require '../model-db-connection/qrc_conf.properties.php';
        $search_condition = $_GET['search_condition'];
        $memId = $_GET['memId'];
        $memName = $_GET['memName'];
        $memRole = $_GET['memRole'];
        $memberSkill = $_GET['memberSkill'];
        $teamCode = $_GET['teamCode'];
        $teamName = $_GET['teamName'];
        $searchLimit = $_GET['searchLimit'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/plugins/jqueryui/jquery-ui-1.10.4.full.min.css" />
<!-- core JavaScript -->
<script src="../assets/js/jquery.min.js"></script>
<!-- PAGE LEVEL PLUGINS JS -->
<!--<script src="../assets/js/plugins/footable/footable.min.js"></script>-->
<script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/datatables/datatables.js"></script>
<script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>
<script src="../assets/js/jquery.quickfit.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.full.min.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/plugins/jquery.blockUI.js"></script>

<!-- initial page level scripts for examples -->
<!--<script src="../assets/js/plugins/footable/footable.init.js"></script>-->
<script src="../assets/js/plugins/datatables/datatables.init.js"></script>
<!-- Start jQuery Datatable -->
<div class="well white">
    <table id="SampleDT" class="datatable table table-hover table-striped table-bordered tc-table footable">
        <thead>
            <tr>
                <th data-class="expand" class="center"><font size="2">Project Code</font></th>
                <th class="center">Project Name</th>
                <th data-hide="phone,tablet">Project Manager</th>
                <th data-hide="phone,tablet">Team Owner</th>
                <th data-hide="phone,tablet">Project Type</th>
                <th data-hide="phone,tablet">Project Status</th>
                <th data-hide="phone,tablet">Project Owner</th>                                                        
                <th data-hide="phone,tablet">Customer Name</th>
                <th class="center"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($search_condition == "search_all") {

                $sqlSelectAllProjectRecord = "SELECT qp.project_code as project_code,"
                        . "qp.project_name as project_name,"
                        . "ps.project_status_name as project_status,"
                        . "po.project_owner_name as project_owner,"
                        . "pt.project_type_name as project_type,"
                        . "qcn.customer_name as customer_name,"
                        . "qp.project_manager as project_manager,"
                        . "qp.project_foreman as project_foreman,"
                        . "qp.supervisor_control as supervisor_control,"
                        . "qtb.tName as team_owner,"
                        . "qp.quality_inspectors as quality_inspectors,"
                        . "qp.project_remark as remark,"
                        . "qp.address_location as address_location"
                        . " FROM QRC_PROJECT qp"
                        . " LEFT JOIN PROJECT_STATUS ps ON qp.project_status = ps.project_status_id"
                        . " LEFT JOIN PROJECT_OWNER po ON qp.project_owner = po.project_owner_id"
                        . " LEFT JOIN PROJECT_TYPE pt on qp.project_type = pt.project_type_id"
                        . " LEFT JOIN QRC_CUSTOMER_NAME qcn on qp.customer_id = qcn.customer_id"
                        . " LEFT JOIN QRC_TEAM_BUILDER qtb ON qp.team_owner = qtb.tCode"
                        . " ORDER BY qp.created_date_time DESC"
                        . " LIMIT 100;";
            } else {
                if ($searchLimit == "All") {
                    $limit = "";
                } else {
                    $limit = " LIMIT " . $searchLimit . ";";
                }
                $checkProjectCode = !empty($projectCodeSearch) ? " AND qp.project_code LIKE '%$projectCodeSearch%'" : "";
                $checkProjectName = !empty($projectNameSearch) ? " AND qp.project_name LIKE '%$projectNameSearch%'" : "";
                $checkProjectType = !empty($projectTypeSearch) ? " AND pt.project_type_id LIKE '$projectTypeSearch'" : "";
                $checkProjectStatus = !empty($projectStatusSearch) ? " AND qp.project_status LIKE '$projectStatusSearch'" : "";
                $checkProjectOwner = !empty($projectOwnerSearch) ? " AND qp.project_owner LIKE '$projectOwnerSearch'" : "";
                $checkProjectCustomer = !empty($projectCustomerSearch) ? " AND qp.customer_id LIKE '$projectCustomerSearch'" : "";
                //$checkStartDate = !empty($startSearchDate) ? " AND qp.created_date_time BETWEEN '$startSearchDate' AND '$endSearchDate'" : "";
                $checkStartDate = !empty($startSearchDate) ? " AND qp.created_date_time >= '$startSearchDate' AND qp.created_date_time < '$endSearchDate'" : "";
                $sqlSelectAllProjectRecord = "SELECT qp.project_code as project_code,"
                        . "qp.project_name as project_name,"
                        . "ps.project_status_name as project_status,"
                        . "po.project_owner_name as project_owner,"
                        . "pt.project_type_name as project_type,"
                        . "pt.project_type_id as project_type_id,"
                        . "qcn.customer_name as customer_name,"
                        . "qp.project_manager as project_manager,"
                        . "qp.project_foreman as project_foreman,"
                        . "qp.supervisor_control as supervisor_control,"
                        . "qtb.tName as team_owner,"
                        . "qp.quality_inspectors as quality_inspectors,"
                        . "qp.project_remark as remark,"
                        . "qp.address_location as address_location"
                        . " FROM QRC_PROJECT qp"
                        . " LEFT JOIN PROJECT_STATUS ps ON qp.project_status = ps.project_status_id"
                        . " LEFT JOIN PROJECT_OWNER po ON qp.project_owner = po.project_owner_id"
                        . " LEFT JOIN PROJECT_TYPE pt on qp.project_type = pt.project_type_id"
                        . " LEFT JOIN QRC_CUSTOMER_NAME qcn on qp.customer_id = qcn.customer_id"
                        . " LEFT JOIN QRC_TEAM_BUILDER qtb ON qp.team_owner = qtb.tCode"
                        . " WHERE 1=1"
                        . $checkProjectCode
                        . $checkProjectName
                        . $checkProjectType
                        . $checkProjectStatus
                        . $checkProjectOwner
                        . $checkProjectCustomer
                        . $checkStartDate
                        . " ORDER BY qp.created_date_time DESC"
                        . $limit;
            }
            $sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
            if (mysql_num_rows($sqlGetAllData) >= 1) {
                while ($row = mysql_fetch_assoc($sqlGetAllData)) {

                    echo '<tr class = "gradeX">';
                    echo '<td>' . $row['project_code'] . '</td>';
                    echo '<td class = "center" title="' . $row['project_name'] . '"><div class="wordrap">' . $row['project_name'] . '</div></td>';
                    echo '<td title="' . $row['project_manager'] . '"><div class="wordrap">' . $row['project_manager'] . '</div></td>';
                    //echo '<td>' . $row['project_foreman'] . '</td>';
                    //echo '<td>' . $row['supervisor_control'] . '</td>';
                    echo '<td title="' . $row['team_owner'] . '"><div class="wordrap">' . $row['team_owner'] . '</div></td>';
                    $data = $row['quality_inspectors'];
                    $sqlSelectSeletedMembers = "SELECT memName FROM QRC_MEMBERS WHERE memID like '$data';";
                    $sqlGetQI = mysql_query($sqlSelectSeletedMembers);
                    $rows = mysql_fetch_assoc($sqlGetQI);
                    //echo '<td>' . $rows['memName'] . '</td>';
                    //echo '<td>' . $row['address_location'] . '</td>';
                    //echo '<td>' . $row['remark'] . '</td>';
                    echo '<td class = "center">' . $row['project_type'] . '</td>';
                    echo '<td class = "center">' . $row['project_status'] . '</td>';
                    echo '<td class = "center">' . $row['project_owner'] . '</td>';
                    echo '<td title="' . $row['customer_name'] . '"><div class="wordrap">' . $row['customer_name'] . '</di></td>';


                    echo '<td>';

                    echo '<div class = "btn-group margin-bottom-20">';
                    echo '<button type = "button" class = "btn btn-primary dropdown-toggle btn-xs" data-toggle = "dropdown">Actions <span class = "caret"></span></button>';

                    echo '<ul class = "dropdown-menu dropdown-primary" role = "menu">';
                    echo '<li><a href = "#" class="btn-xs"  onclick=loadProjectOrder("' . $row['project_code'] . '")><i class = "fa fa-rss"></i> Work Order</a></li>';
                    echo '<li><a href = "#modal-login" class="btn-xs" data-toggle = "modal" onclick=editProject("' . $row['project_code'] . '")><i class = "fa fa-edit"></i> Edit (แก้ไข)</a></li>';
                    echo '<li><a href = "#" class="btn-xs" onclick=viewClick("' . $row['project_code'] . '") ><i class = "fa fa-eye"></i> View (ดูข้อมูล)</a></li>';
                    echo '<li class = "divider"></li>';
                    echo '<li><a href = "#" class="btn-xs" onclick=deleteProject("' . $row['project_code'] . '")><i class = "fa fa-trash-o"></i> Delete (ลบ)</a></li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>                                          
        </tbody>
    </table>
    <script>
        $("#dialog").hide();
        function viewClick(po_id) {
            $.ajax({
                url: "AjaxViewContent.php?po_id=" + po_id,
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
                    $("#dialog_Content").html(data);
                    var millisecondsToWait = 200;
                    setTimeout(function () {
                        $("#dialog").removeClass("hide").dialog({
                            height: 500,
                            width: 900
                        });
                    }, millisecondsToWait);
                    setTimeout($.unblockUI, 100);
                },
                statusCode: {
                    404: function () {
                        alert("page not found");
                    },
                    500: function () {
                        alert("Cannot load page with error");
                    }
                }
            });

        }
        $(document).tooltip({
            open: function (event, ui) {
                ui.tooltip.css("max-width", "600px");
                ui.tooltip.css("font-size", "12px");
            },
            track: true
        });
        $('.wordrap').quickfit({max: 14, min: 12, truncate: true});
    </script>
    <div id="dialog" class="hide">
        <div id="dialog_Content"></div>

    </div>