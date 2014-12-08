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
        $searchCondition = $_GET['searchCondition'];
        $project_id = $_GET['project_id'];
        $project_code = $_GET['project_code'];
        $document_no = $_GET['document_no'];
        $po_no = $_GET['po_no'];
        $po_owner = $_GET['po_owner'];
        $po_sender = $_GET['po_sender'];
        $po_issue_date = $_GET['po_issue_date'];
        $po_order_type = $_GET['po_order_type'];
        $po_status = $_GET['po_status'];
        $po_end_issue_date = $_GET['po_end_issue_date'];
        $po_is_retention = $_GET['po_is_retention'];
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

<!-- initial page level scripts for examples -->
<!--<script src="../assets/js/plugins/footable/footable.init.js"></script>-->
<script src="../assets/js/plugins/datatables/datatables.init.js"></script>
<!-- Start jQuery Datatable -->
<div class="well white">
    <table id="SampleDT" class="datatable table table-hover table-striped table-bordered tc-table footable">
        <thead>
            <tr>
                <th data-class="expand" class="center">PO Code</th>
                <th data-class="expand" class="center">Project Name</th>
                <th class = "center">Project Code</th>
                <th class = "center">Document No</th>
                <th class = "center">PO No.</th>
                <th class = "center">PO Owner</th>
                <th class = "center">PO Sender</th>
                <th data-hide="phone,tablet">Amount</th>
                <th data-hide="phone,tablet">Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($searchCondition == "All") {
                $sqlSelectMemberAll = "SELECT qp.PO_PROJECT_NAME as PO_PROJECT_NAME,"
                        . "qp.PO_PROJECT_CODE as PO_PROJECT_CODE,"
                        . "qp.PO_DOCUMENT_NO as PO_DOCUMENT_NO,"
                        . "qp.PO_PO_NO as PO_PO_NO,"
                        . "qp.PO_HOME_PLAN as PO_HOME_PLAN,"
                        . "qp.PO_HOME_PLOT as PO_HOME_PLOT,"
                        . "qp.PO_OWNER as PO_OWNER,"
                        . "qp.PO_SENDER as PO_SENDER,"
                        . "qp.PO_ISSUE_DATE as PO_ISSUE_DATE,"
                        . "qts.service_name as order_type_name,"
                        . "qp.PO_QUANTITY as PO_QUANTITY,"
                        . "qp.PO_PLAN_SIZE as PO_PLAN_SIZE,"
                        . "qp.PO_UNIT_PRICE as PO_UNIT_PRICE,"
                        . "qp.PO_AMOUNT as PO_AMOUNT,"
                        . "qp.PO_VAT as  PO_VAT,"
                        . "qp.PO_SUPERVISOR_ID as PO_SUPERVISOR_ID,"
                        . "qp.PO_PROJECT_MANAGER_ID as PO_PROJECT_MANAGER_ID,"
                        . "qp.PO_PROJECT_FOREMAN_ID as PO_PROJECT_FOREMAN_ID,"
                        . "qp.PO_ID as PO_ID,"
                        . "qp.PO_STATUS as PO_STATUS,"
                        . "qp.PO_REMARK as PO_REMARK"
                        . " FROM QRC_PO qp"
                        . " LEFT JOIN QRC_TYPE_OF_SERVICE qts on qp.po_order_type_id = qts.service_id"
                        . " ORDER BY qp.PO_PROJECT_CODE DESC;";
            } else {
                $checkProjectid = !empty($project_id) ? " AND qp.PO_PROJECT_CODE LIKE '%$project_id%'" : "";
                $checkProjecCode = !empty($project_code) ? " AND qp.PO_PROJECT_CODE LIKE '%$project_code%'" : "";
                $checkDocNo = !empty($document_no) ? " AND qp.PO_DOCUMENT_NO LIKE '%$document_no%'" : "";
                $checkPoNo = !empty($po_no) ? " AND qp.PO_PO_NO LIKE '%$po_no%'" : "";
                $checkPoOwner = !empty($po_owner) ? " AND qp.PO_OWNER LIKE '%$po_owner%'" : "";
                $checkPoSender = !empty($po_sender) ? " AND qp.PO_SENDER LIKE '%$po_sender%'" : "";
                $checkPOStatus = !empty($po_status) ? " AND qp.PO_STATUS LIKE '%$po_status%'" : "";
                if ($po_end_issue_date == "") {
                    $checkPoIssueDate = !empty($po_issue_date) ? " AND qp.PO_ISSUE_DATE BETWEEN '$po_issue_date' AND '$po_issue_date'" : "";
                } else {
                    $checkPoIssueDate = !empty($po_issue_date) ? " AND qp.PO_ISSUE_DATE BETWEEN '$po_issue_date' AND '$po_end_issue_date'" : "";
                }
                if ($po_is_retention == "yes") {
                    $chekIsRetention = !empty($po_is_retention) ? " AND qp.PO_RETENTION is not null AND qp.PO_RETENTION !=''" : "";
                } else {
                    $chekIsRetention = !empty($po_is_retention) ? " AND qp.PO_RETENTION is null OR qp.PO_RETENTION =''" : "";
                }
                $checkPoOrderType = !empty($po_order_type) ? " AND qp.PO_ORDER_TYPE_ID LIKE '$po_order_type'" : "";
                $sqlSelectMemberAll = "SELECT qp.PO_PROJECT_NAME as PO_PROJECT_NAME,"
                        . "qp.PO_PROJECT_CODE as PO_PROJECT_CODE,"
                        . "qp.PO_DOCUMENT_NO as PO_DOCUMENT_NO,"
                        . "qp.PO_PO_NO as PO_PO_NO,"
                        . "qp.PO_HOME_PLAN as PO_HOME_PLAN,"
                        . "qp.PO_HOME_PLOT as PO_HOME_PLOT,"
                        . "qp.PO_OWNER as PO_OWNER,"
                        . "qp.PO_SENDER as PO_SENDER,"
                        . "qp.PO_ISSUE_DATE as PO_ISSUE_DATE,"
                        . "qts.service_name as order_type_name,"
                        . "qp.PO_QUANTITY as PO_QUANTITY,"
                        . "qp.PO_PLAN_SIZE as PO_PLAN_SIZE,"
                        . "qp.PO_UNIT_PRICE as PO_UNIT_PRICE,"
                        . "qp.PO_AMOUNT as PO_AMOUNT,"
                        . "qp.PO_VAT as  PO_VAT,"
                        . "qp.PO_SUPERVISOR_ID as PO_SUPERVISOR_ID,"
                        . "qp.PO_PROJECT_MANAGER_ID as PO_PROJECT_MANAGER_ID,"
                        . "qp.PO_PROJECT_FOREMAN_ID as PO_PROJECT_FOREMAN_ID,"
                        . "qp.PO_ID as PO_ID,"
                        . "qp.PO_STATUS as PO_STATUS,"
                        . "qp.PO_REMARK as PO_REMARK"
                        . " FROM QRC_PO qp"
                        . " LEFT JOIN qrc_type_of_service qts on qp.po_order_type_id = qts.service_id"
                        . " WHERE 1=1"
                        . $checkProjectid
                        . $checkProjecCode
                        . $checkDocNo
                        . $checkPOStatus
                        . $checkPoNo
                        . $checkPoOwner
                        . $checkPoSender
                        . $checkPoIssueDate
                        . $checkPoOrderType
                        . $chekIsRetention;
            }
            $sqlGetAllData = mysql_query($sqlSelectMemberAll);
            if (mysql_num_rows($sqlGetAllData) >= 1) {
                while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                    echo '<tr class = "gradeX">';
                    echo '<td>' . $row['PO_ID'] . '</td>';
                    echo '<td title="' . $row['PO_PROJECT_NAME'] . '"><div class="wordrap">' . $row['PO_PROJECT_NAME'] . '</div></td>';
                    echo '<td>' . $row['PO_PROJECT_CODE'] . '</td>';
                    echo '<td title="' . $row['PO_DOCUMENT_NO'] . '"><div class="wordrap">' . $row['PO_DOCUMENT_NO'] . '</td>';
                    echo '<td>' . $row['PO_PO_NO'] . '</td>';
                    echo '<td>' . $row['PO_OWNER'] . '</td>';
                    echo '<td>' . $row['PO_SENDER'] . '</td>';
                    echo '<td>' . $row['PO_AMOUNT'] . '</td>';
                    echo '<td>' . $row['PO_STATUS'] . '</td>';
                    echo '<td>';
                    echo '<div class = "btn-group margin-bottom-20">';
                    echo '<button type = "button" class = "btn btn-primary dropdown-toggle btn-xs" data-toggle = "dropdown">Actions <span class = "caret"></span></button>';
                    echo '<ul class = "dropdown-menu" role = "menu">';
                    if ($row['PO_STATUS'] == "Complete" || $row['PO_STATUS'] == "Cancel" || $row['PO_STATUS'] == "Close") {
                        
                    } else {
                        echo '<li><a href = "#" class="btn-xs" onclick=loadOrder("' . $row['PO_PROJECT_CODE'] . '","' . $row['PO_ID'] . '")><i class = "fa fa-rss"></i> Assign (มอบหมาย)</a></li>';
                    }
                    echo '<li><a href = "#modal-po" class="btn-xs " onclick=editPO("' . $row['PO_ID'] . '")><i class = "fa fa-edit"></i> Edit (แก้ไข)</a></li>';
                    echo '<li><a href = "#" onclick=viewClick("' . $row['PO_ID'] . '") class="btn-xs")><i class = "fa fa-eye"></i> View (ดูข้อมูล)</a></li>';
                    echo '<li class = "divider"></li>';
                    echo '<li><a href = "#" onclick=deletePO("' . $row['PO_ID'] . '","' . $row['PO_PO_NO'] . '")><i class = "fa fa-trash-o"></i> Delete (ลบ)</a></li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                    $strBuilding = "";
                }
            }
            ?>                                 
        </tbody>
    </table>
    <script>
        $("#dialog").hide();
        function viewClick(po_id) {
            var jqxhr = $.post("AjaxViewContent.php?po_id=" + po_id);
            jqxhr.success(function (data) {
                $("#dialog_Content").html(data);
                var millisecondsToWait = 200;
                setTimeout(function () {
                    $("#dialog").removeClass("hide").dialog({
                        height: 500,
                        width: 900
                    });
                }, millisecondsToWait);
            });
            jqxhr.error(function () {
                alert("ไม่สามารถติดต่อกับ Server ได้");
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
    <div id="dialog" title="Project Detail" class="hide">
        <div id="dialog_Content"></div>

    </div>