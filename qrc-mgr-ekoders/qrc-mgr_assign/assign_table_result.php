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
        $projectCodes = $_GET['projectCode'];
        $woID = $_GET['woID'];
        $startSearch = $_GET['startSearch'];
        $endSearch = $_GET['endSearch'];
        $searchLimit = $_GET['searchLimit'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/plugins/jqueryui/jquery-ui-1.10.4.full.min.css" />
<!-- core JavaScript -->
<script src="../assets/js/jquery.min.js"></script>
<!-- PAGE LEVEL PLUGINS JS -->
<script src="../assets/js/plugins/footable/footable.min.js"></script>
<script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/datatables/datatables.js"></script>
<script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>

<script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.full.min.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>

<!-- initial page level scripts for examples -->
<script src="../assets/js/plugins/footable/footable.init.js"></script>
<script src="../assets/js/plugins/datatables/datatables.init.js"></script>

<table id="SampleDT" class="datatable table table-hover table-striped table-bordered tc-table footable">

    <!-- Table heading -->
    <thead>
        <tr>
            <th data-class="expand" class="center">WO Code</th>
            <th data-class="expand" class="center">Project Code</th>
            <th data-class="expand" class="center">Project Name</th>
            <th data-hide="phone,tablet">Document No.</th>
            <th data-hide="phone,tablet">PO No.</th>              
            <th class="center">WO Status</th>
            <th class="center">Plan</th>
            <th class="center">Plot</th>
            <th class="center">Plan Size</th>
            <th class="center"></th>
        </tr>
    </thead>
    <!-- // Table heading END -->
    <!-- Table body -->
    <tbody>
        <?php
        if ($search_condition == "search_all") {
            $sqlSelectAllProjectRecord = "SELECT qpo.project_code as project_code,
                        qpo.project_order_id as order_id,
                        qpo.project_order_plan as project_plan,
                        qpo.project_order_plot as project_plot,
                        qpo.document_no as document_no,
                        qpo.po_no as po_no,
                        qpo.po_owner as po_owner,
                        qpo.po_sender as po_sender,
                        qpo.created_date_time as created_date_time,
                        qpot.service_name as order_type,
                        qpo.plan_size as plan_size,
                        qpo.unit_price as unit_price,
                        qpo.amount as amount,
                        qpo.include_vat as vat,
                        qpo.image_name as imgName,
                        qpo.project_status as project_status,
                         qp.project_name as project_name,
                        qpo.remark as project_order_remark
                        FROM QRC_PROJECT_ORDER qpo
                        LEFT JOIN QRC_TYPE_OF_SERVICE qpot ON qpo.order_type = qpot.service_id
                        LEFT JOIN QRC_PROJECT qp ON qpo.project_code = qp.project_code
                        ORDER BY qpo.created_date_time DESC
                        LIMIT 100;";
        } else {
            if ($searchLimit == "All") {
                $limit = "";
            } else {
                $limit = " LIMIT " . $searchLimit . ";";
            }
            $checkProjectStatus = !empty($woID) ? " AND qas.A_S_ID like '$woID'" : "";
            $checkProjectCode = !empty($projectCodes) ? " AND qpo.project_code like '$projectCodes'" : "";
            $checkStartDate = !empty($startSearch) ? " AND qpo.created_date_time >= '$startSearch' AND qpo.created_date_time < '$endSearch'" : "";

            $sqlSelectAllProjectRecord = "SELECT qpo.project_code as project_code,
                        qpo.project_order_id as order_id,
                        qpo.project_order_plan as project_plan,
                        qpo.project_order_plot as project_plot,
                        qpo.document_no as document_no,
                        qpo.po_no as po_no,
                        qpo.po_owner as po_owner,
                        qpo.po_sender as po_sender,
                        qpo.created_date_time as created_date_time,
                        qpot.service_name as order_type,
                        qpo.plan_size as plan_size,
                        qpo.unit_price as unit_price,
                        qpo.amount as amount,
                        qpo.include_vat as vat,
                        qpo.image_name as imgName,
                        qpo.project_status as project_status,
                        qp.project_name as project_name,
                        qpo.remark as project_order_remark                        
                        FROM QRC_PROJECT_ORDER qpo
                        LEFT JOIN QRC_TYPE_OF_SERVICE qpot ON qpo.order_type = qpot.service_id
                        LEFT JOIN QRC_ASSIGN_STATUS qas ON qpo.project_status = qas.A_S_NAME
                        LEFT JOIN QRC_PROJECT qp ON qpo.project_code = qp.project_code
                        WHERE 1=1"
                    . $checkProjectStatus
                    . $checkProjectCode
                    . $checkStartDate
                    . " ORDER BY qpo.created_date_time DESC"
                    . $limit;
        }

        $sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
        if (mysql_num_rows($sqlGetAllData) >= 1) {
            while ($row = mysql_fetch_assoc($sqlGetAllData)) {

                echo '<tr class = "gradeX">';
                echo '<td>' . $row['order_id'] . '</td>';
                echo '<td>' . $row['project_code'] . '</td>';
                echo '<td>' . $row['project_name'] . '</td>';
                echo '<td>' . $row['document_no'] . '</td>';
                echo '<td>' . $row['po_no'] . '</td>';

                $selectImageFromQRCPOIMG = "SELECT IMAGE_PATH AS IMAGE_PATH FROM QRC_PO_IMAGE WHERE TEMP_PO_ID LIKE '" . $row['imgName'] . "'";
                $sqlGetAllDatas = mysql_query($selectImageFromQRCPOIMG);
                while ($rop = mysql_fetch_assoc($sqlGetAllDatas)) {
                    //echo '<td><d class="fancybox-effects-d" href="images/uploads/' . $rop['IMAGE_PATH'] . '" title="' . $rop['IMAGE_PATH'] . '" onlick="changeAttrHref()"><img src="images/uploads/' . $rop['IMAGE_PATH'] . '" alt="Smiley face" width="200"></d></td>';
                }
                if ($row['project_status'] == "New") {
                    echo '<td class = "center" style="color: blue;">' . $row['project_status'] . '</td>';
                } else if ($row['project_status'] == "Complete") {
                    echo '<td class = "center" style="color: green;">' . $row['project_status'] . '</td>';
                } else if ($row['project_status'] == "Assign") {
                    echo '<td class = "center" style="color: orange;">' . $row['project_status'] . '</td>';
                } else if ($row['project_status'] == "Cancel") {
                    echo '<td class = "center" style="color: red;">' . $row['project_status'] . '</td>';
                } else {
                    echo '<td class = "center">' . $row['project_status'] . '</td>';
                }
                echo '<td class = "center">' . $row['project_plan'] . '</td>';
                echo '<td class = "center">' . $row['project_plot'] . '</td>';
                echo '<td class = "center">' . $row['plan_size'] . '</td>';



                echo '<td>';

                echo '<div class = "btn-group margin-bottom-20">';
                echo '<button type = "button" class = "btn btn-primary dropdown-toggle btn-xs" data-toggle = "dropdown">Actions <span class = "caret"></span></button>';

                echo '<ul class = "dropdown-menu dropdown-primary" role = "menu">';
                echo '<li><a href = "#modal-project-order" class="btn-xs" data-toggle = "modal" onclick=editPO("' . $row['project_code'] . '","' . $row['order_id'] . '")><i class = "fa fa-edit"></i> Edit (แก้ไข)</a></li>';
                echo '<li><a href = "#modal-project-order" class="btn-xs" data-toggle = "modal" onclick=copyWO("' . $row['project_code'] . '","' . $row['order_id'] . '")><i class = "fa fa-copy"></i> Copy (คัดลอก)</a></li>';
                echo '<li><a href = "#" class="btn-xs" onclick=viewClick("' . $row['order_id'] . '")><i class = "fa fa-eye"></i> View (ดูข้อมูล)</a></li>';
                echo '<li class = "divider"></li>';
                echo '<li><a href = "#" class="btn-xs" onclick=deletePO("' . $row['order_id'] . '","' . $row['project_code'] . '","' . $row['imgName'] . '")><i class = "fa fa-trash-o"></i> Delete (ลบ)</a></li>';
                echo '</ul>';
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
    <!-- // Table body END -->
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
                    height: 600,
                    width: 600
                });
            }, millisecondsToWait);
        });
        jqxhr.error(function() {
            alert("ไม่สามารถติดต่อกับ Server ได้");
        });

    }
</script>
<div id="dialog" title="Project Detail" class="hide">
    <div id="dialog_Content"></div>

</div>