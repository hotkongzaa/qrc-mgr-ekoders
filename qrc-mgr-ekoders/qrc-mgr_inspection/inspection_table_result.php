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
        $project_name_code = $_GET['project_name'];
        $project_code = $_GET['project_code'];
        $ins_document_no = $_GET['ins_document_no'];
        $ins_ins_no = $_GET['ins_ins_no'];
        $ins_date = $_GET['ins_date'];
        $ins_ins_ordertype = $_GET['ins_ins_ordertype'];
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
                <th data-class="expand" class="center">Inspection Code</th>
                <th data-class="expand" class="center">Project Name</th>
                <th class = "center">Project Code</th>
                <th class = "center">Document No</th>
                <th class = "center">Inspection No.</th>
                <th class = "center">Inspection Date</th>
                <th class = "center">Order Type</th>
                <th data-hide="phone,tablet">Project Foreman</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($searchCondition == md5("Condition")) {
                $checkProjectCode = !empty($project_name_code) ? " AND qp.project_code LIKE '%$project_name_code%'" : "";
                $checkProjectCode2 = !empty($project_code) ? " AND qp.project_code LIKE '%$project_code%'" : "";
                $checkInspectionDocNo = !empty($ins_document_no) ? " AND qpo.PO_DOCUMENT_NO LIKE '%$ins_document_no%'" : "";
                $checkInspectionNo = !empty($ins_ins_no) ? " AND qi.INS_INSPECTION_NO LIKE '%$ins_ins_no%'" : "";
                $checkOrderType = !empty($ins_ins_ordertype) ? " AND qi.INS_ORDER_TYPE LIKE '%$ins_ins_ordertype%'" : "";
                $checkINSDate = !empty($ins_date) ? " AND qpo.PO_ISSUE_DATE BETWEEN '$ins_date' and 'NOW()' " : "";

                $sqlSelectInspectionAll = "SELECT qp.project_name as project_name,"
                        . "qi.INS_ID as INS_ID,"
                        . "qpo.PO_DOCUMENT_NO as PO_DOCUMENT_NO,"
                        . "qp.project_code as project_code,"
                        . "qi.INS_INSPECTION_NO as INS_INSPECTION_NO,"
                        . "qi.INS_DATE as INS_DATE,"
                        . "qi.INS_ORDER_TYPE as INS_ORDER_TYPE,"
                        . "qpo.PO_HOME_PLAN as PO_HOME_PLAN,"
                        . "qpo.PO_HOME_PLOT as PO_HOME_PLOT,"
                        . "qpo.PO_PO_NO as PO_PO_NO,"
                        . "qpo.PO_ISSUE_DATE as PO_ISSUE_DATE,"
                        . "qpo.PO_QUANTITY as PO_QUANTITY,"
                        . "qpo.PO_PLAN_SIZE as PO_PLAN_SIZE,"
                        . "qi.INS_IMAGE_PATH as INS_IMAGE_PATH,"
                        . "qp.project_manager as project_manager,"
                        . "qp.project_foreman as project_foreman,"
                        . "qp.supervisor_control as supervisor_control,"
                        . "qos.service_name as service_name,"
                        . "qi.INS_REMARK as INS_REMARK"
                        . " FROM QRC_INSPECTION qi"
                        . " LEFT JOIN QRC_PROJECT qp ON qp.project_code = qi.INS_PROJECT_CODE"
                        . " LEFT JOIN QRC_PO qpo ON qpo.PO_ID = qi.INS_DOCUMENT_NO"
                        . " LEFT JOIN QRC_TYPE_OF_SERVICE qos ON qi.INS_ORDER_TYPE = qos.service_id"
                        . " WHERE 1=1"
                        . $checkProjectCode
                        . $checkProjectCode2
                        . $checkInspectionNo
                        . $checkInspectionDocNo
                        . $checkOrderType
                        . $checkINSDate
                        . " ORDER By INS_CREATED_DATE_TIME DESC;";
            } else {
                $sqlSelectInspectionAll = "SELECT qp.project_name as project_name,"
                        . "qi.INS_ID as INS_ID,"
                        . "qpo.PO_DOCUMENT_NO as PO_DOCUMENT_NO,"
                        . "qp.project_code as project_code,"
                        . "qi.INS_INSPECTION_NO as INS_INSPECTION_NO,"
                        . "qi.INS_DATE as INS_DATE,"
                        . "qi.INS_ORDER_TYPE as INS_ORDER_TYPE,"
                        . "qpo.PO_HOME_PLAN as PO_HOME_PLAN,"
                        . "qpo.PO_HOME_PLOT as PO_HOME_PLOT,"
                        . "qpo.PO_PO_NO as PO_PO_NO,"
                        . "qpo.PO_ISSUE_DATE as PO_ISSUE_DATE,"
                        . "qpo.PO_QUANTITY as PO_QUANTITY,"
                        . "qpo.PO_PLAN_SIZE as PO_PLAN_SIZE,"
                        . "qi.INS_IMAGE_PATH as INS_IMAGE_PATH,"
                        . "qp.project_manager as project_manager,"
                        . "qp.project_foreman as project_foreman,"
                        . "qp.supervisor_control as supervisor_control,"
                        . "qos.service_name as service_name,"
                        . "qi.INS_REMARK as INS_REMARK"
                        . " FROM QRC_INSPECTION qi"
                        . " LEFT JOIN QRC_PROJECT qp ON qp.project_code = qi.INS_PROJECT_CODE"
                        . " LEFT JOIN QRC_PO qpo ON qpo.PO_ID = qi.INS_DOCUMENT_NO"
                        . " LEFT JOIN QRC_TYPE_OF_SERVICE qos ON qi.INS_ORDER_TYPE = qos.service_id"
                        . " WHERE 1=1"
                        . " ORDER By INS_CREATED_DATE_TIME DESC;";
            }
//        echo $sqlSelectInspectionAll;
            $sqlGetAllData = mysql_query($sqlSelectInspectionAll);
            if (mysql_num_rows($sqlGetAllData) >= 1) {
                while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                    echo '<tr class = "gradeX">';
                    echo '<td>' . $row['INS_ID'] . '</td>';
                    echo '<td title="' . $row['project_name'] . '"><div class="wordrap">' . $row['project_name'] . '</div></td>';
                    echo '<td>' . $row['project_code'] . '</td>';
                    echo '<td>' . $row['PO_DOCUMENT_NO'] . '</td>';
                    echo '<td>' . $row['INS_INSPECTION_NO'] . '</td>';
                    echo '<td>' . $row['INS_DATE'] . '</td>';
                    echo '<td title="' . $row['service_name'] . '"><div class="wordrap">' . $row['service_name'] . '</div></td>';
                    echo '<td title="' . $row['project_foreman'] . '"><div class="wordrap">' . $row['project_foreman'] . '</div></td>';
                    $sqlSelectImageByID = "SELECT IMAGE_PATH as IMAGE_PATH FROM qrc_inspection_image WHERE TEMP_INS_ID LIKE '" . $row['INS_ID'] . "'";
                    $queryGetFilePath = mysql_query($sqlSelectImageByID);
                    $strBuilding = "";
                    while ($rowq = mysql_fetch_assoc($queryGetFilePath)) {
                        $strBuilding.='<d class="fancybox-effects-d" href="images/uploads/' . $rowq['IMAGE_PATH'] . '" title="' . $rowq['IMAGE_PATH'] . '" onlick="changeAttrHref()"><img src="images/uploads/' . $rowq['IMAGE_PATH'] . '" alt="Smiley face" width="200"></d>';
                    }

                    echo '<td>';

                    echo '<div class = "btn-group margin-bottom-20">';
                    echo '<button type = "button" class = "btn btn-primary dropdown-toggle btn-xs" data-toggle = "dropdown">Actions <span class = "caret"></span></button>';

                    echo '<ul class = "dropdown-menu" role = "menu">';
                    echo '<li><a href = "#modal-inspection" data-toggle = "modal" onclick=editInspection("' . $row['INS_ID'] . '")><i class = "fa fa-edit"></i> Edit (แก้ไข)</a></li>';
                    echo '<li><a href = "#" class="btn-xs" onclick=viewClick("' . $row['INS_ID'] . '")><i class = "fa fa-eye"></i> View (ดูข้อมูล)</a></li>';
                    echo '<li class = "divider"></li>';
                    echo '<li><a href = "#" onclick=deleteInspection("' . $row['INS_ID'] . '")><i class = "fa fa-trash-o btn-xs"></i> Delete (ลบ)</a></li>';
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
            jqxhr.success(function(data) {
                $("#dialog_Content").html(data);
                var millisecondsToWait = 200;
                setTimeout(function() {
                    $("#dialog").removeClass("hide").dialog({
                        height: 500,
                        width: 900
                    });
                }, millisecondsToWait);
            });
            jqxhr.error(function() {
                alert("ไม่สามารถติดต่อกับ Server ได้");
            });

        }
        $(document).tooltip({
            open: function(event, ui) {
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