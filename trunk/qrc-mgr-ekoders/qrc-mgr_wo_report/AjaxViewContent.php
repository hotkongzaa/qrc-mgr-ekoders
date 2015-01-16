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
        $teamCode = $_GET['teamCode'];
        $start_date = $_GET['startDate'];
        $end_date = $_GET['endDate'];
        $wo_status = $_GET['woStatus'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/plugins/jqueryui/jquery-ui-1.10.4.full.min.css" />
<script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.full.min.js"></script>

<script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/datatables/datatables.js"></script>
<script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>
<script src="../assets/js/jquery.quickfit.js"></script>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12">
                <table id="teamDetail" class="datatable table table-hover table-striped table-bordered tc-table footable">
                    <!-- Table heading -->
                    <thead>
                        <tr>
                            <th data-class="expand" class="center">WO Code</th>
                            <th data-class="expand" class="center">Project Name</th>
                            <th data-hide="phone,tablet">Document No.</th>
                            <th data-hide="phone,tablet">PO No.</th>              
                            <th class="center">WO Status</th>
                            <th class="center">Plan</th>
                            <th class="center">Plot</th>
                            <th class="center">Plan Size</th>
                        </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody>
                        <?php
                        $checkStatus = empty($wo_status) ? "" : " and qpo.project_status like '$wo_status'";
                        $checkDate = empty($start_date) ? "" : " and qpo.created_date_time between '$start_date' and '$end_date'";
                        $sqlSelectAllProjectRecord = "SELECT qpo.project_code as project_code,"
                                . "qpo.project_order_id as order_id,"
                                . "qpo.project_order_plan as project_plan,"
                                . "qpo.project_order_plot as project_plot,"
                                . "qpo.document_no as document_no,"
                                . "qpo.po_no as po_no,"
                                . "qpo.po_owner as po_owner,"
                                . "qpo.po_sender as po_sender,"
                                . "qpo.created_date_time as created_date_time,"
                                . "qpot.service_name as order_type,"
                                . "qpo.plan_size as plan_size,"
                                . "qpo.unit_price as unit_price,"
                                . "qpo.amount as amount,"
                                . "qpo.include_vat as vat,"
                                . "qpo.image_name as imgName,"
                                . "qpo.project_status as project_status,"
                                . "qp.project_name as project_name,"
                                . "qpo.remark as project_order_remark"
                                . " FROM QRC_PROJECT_ORDER qpo"
                                . " LEFT JOIN QRC_TYPE_OF_SERVICE qpot ON qpo.order_type = qpot.service_id"
                                . " LEFT JOIN QRC_PROJECT qp ON qpo.project_code = qp.project_code"
                                . " LEFT join qrc_assign_order on qpo.assign_id = qrc_assign_order.ASSIGN_ID"
                                . " LEFT join qrc_team_builder on qrc_assign_order.TEAM_CODE = qrc_team_builder.tCode"
                                . " WHERE 1=1"
                                . " AND qpo.assign_id is not null"
                                . " AND qrc_assign_order.TEAM_CODE like '$teamCode'"
                                . $checkStatus
                                . $checkDate
                                . " ORDER BY qpo.created_date_time DESC";
//                        echo $sqlSelectAllProjectRecord;
                        $sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
                        if (mysql_num_rows($sqlGetAllData) >= 1) {
                            while ($row = mysql_fetch_assoc($sqlGetAllData)) {

                                echo '<tr class = "gradeX">';
                                echo '<td>' . $row['order_id'] . '</td>';
                                echo '<td><div class="wordrap">' . $row['project_name'] . '</div></td>';
                                echo '<td>' . $row['document_no'] . '</td>';
                                echo '<td>' . $row['po_no'] . '</td>';
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
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                    <!-- // Table body END -->
                </table>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        var responsiveHelper = undefined;
        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };
        var tableElement = $('#teamDetail');

        tableElement.dataTable({
            "order": [[0, "desc"]],
            autoWidth: false,
            preDrawCallback: function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper) {
                    responsiveHelper = new ResponsiveDatatablesHelper(tableElement, breakpointDefinition);
                }
            },
            rowCallback: function (nRow) {
                responsiveHelper.createExpandIcon(nRow);
            },
            drawCallback: function (oSettings) {
                responsiveHelper.respond();
            }
        });
    });
</script>

