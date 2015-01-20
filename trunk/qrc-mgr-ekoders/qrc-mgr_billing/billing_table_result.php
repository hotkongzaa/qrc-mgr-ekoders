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
        $searchCondition = $_GET['search_condition'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/plugins/bootstrap-editable/bootstrap-editable.css">
<link rel="stylesheet" href="../assets/css/plugins/jqueryui/jquery-ui-1.10.4.full.min.css" />
<!-- core JavaScript -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<!-- PAGE LEVEL PLUGINS JS -->
<script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/datatables/datatables.js"></script>
<script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>
<script src="../assets/js/jquery.quickfit.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.full.min.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/plugins/bootstrap-editable/bootstrap-editable.min.js"></script>


<!-- initial page level scripts for examples -->
<script src="../assets/js/plugins/datatables/datatables.init.js"></script>
<!-- Start jQuery Datatable -->
<div class="well white">
    <table id="SampleDT" class="datatable table table-hover table-striped table-bordered tc-table footable">
        <thead>
            <tr>

                <th data-class="expand" class="center">INV Code.</th>
                <th class="center">Customer Name</th>
                <th class="center">Create Time</th>
                <th class="center">Status</th>
                <th class="center"></th>

            </tr>
        </thead>
        <tbody>
            <?php
            $ryearThai = date('Y') + 543;
            if ($searchCondition == "Condition") {
                $invId = $_GET['invoice_id_search'];
                $checkINV_ID = !empty($invId) ? " AND qi.INV_ID LIKE '$invId'" : "";
                $customer_search = $_GET['customer_search'];
                $checkCustomer = !empty($customer_search) ? " AND qi.customer_id LIKE '$customer_search'" : "";
                $startSearchDate = $_GET['start_search_date'];
                $endSearchDate = $_GET['end_search_date'];
                $checkDate = !empty($startSearchDate) ? " AND qi.create_date_time BETWEEN '$startSearchDate' AND '$endSearchDate'" : "";
                $invoiceStatus = $_GET['invoice_status_search'];
                $checkInvStatus = !empty($invoiceStatus) ? " AND qi.INVOICE_STATUS LIKE '$invoiceStatus'" : "";
                $sqlSelectAllProjectRecord = "select *"
                        . " from QRC_INVOICE qi"
                        . " LEFT JOIN QRC_CUSTOMER_NAME qc on qc.customer_id = qi.customer_id"
                        . " LEFT JOIN QRC_TYPE_OF_SERVICE qt on qi.order_type = qt.service_id"
                        . " LEFT JOIN QRC_INVOICE_STATUS qis on qi.invoice_status = qis.inv_staus_id"
                        . " WHERE 1=1"
                        . $checkINV_ID
                        . $checkCustomer
                        . $checkDate
                        . $checkInvStatus
                        . " ORDER BY create_date_time DESC;";
            } else {
                $sqlSelectAllProjectRecord = "select *"
                        . " from QRC_INVOICE qi"
                        . " LEFT JOIN QRC_CUSTOMER_NAME qc on qc.customer_id = qi.customer_id"
                        . " LEFT JOIN QRC_TYPE_OF_SERVICE qt on qi.order_type = qt.service_id"
                        . " LEFT JOIN QRC_INVOICE_STATUS qis on qi.invoice_status = qis.inv_staus_id"
                        . " ORDER BY create_date_time DESC;";
            }
            $sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
            if (mysql_num_rows($sqlGetAllData) >= 1) {
                while ($row = mysql_fetch_assoc($sqlGetAllData)) {

                    echo '<tr class = "gradeX">';

                    echo '<td>' . $row['inv_id'] . '</td>';
                    echo '<td>' . $row['customer_name'] . '</td>';
                    echo '<td>' . $row['create_date_time'] . '</td>';
                    $prefix = 'QRC' . substr($ryearThai, -2) . '-INV';
                    if (substr($row['inv_id'], 0, -7) == $prefix) {
                        echo '<td><a href="#" title="Edit status" style="display: inline;" class="editable editable-click" data-type="select" data-pk="' . $row['inv_id'] . '" data-value="' . $row['inv_staus_id'] . '" id="' . $row['inv_id'] . '" onclick=editTable("' . $row['inv_id'] . '")>' . $row['inv_staus_name'] . '</a></td>';
                    } else {
                        echo '<td></td>';
                    }
                    echo '<td align="center">';
                    echo '<div class = "btn-group margin-bottom-20">';
                    echo '<a href = "#" class="btn btn-primary btn-xs" onclick=viewClick("' . $row['inv_id'] . '",' . $row['customer_id'] . ',"' . $row['create_receipt'] . '")><i class = "fa fa-download"></i> Actions</a>';
//                    echo '<input type = "button" class = "btn btn-primary btn-xs" onclick=viewClick("' . $row['inv_id'] . '", ' . $row['customer_id'] . ', "' . $row['create_receipt'] . '") value="Actions"/>';
//                    echo '<ul class = "dropdown-menu" role = "menu">';
//                    echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $row['inv_id'] . '",' . $row['customer_id'] . ',"Copy")><i class = "fa fa-download"></i> Download Invoice Copy</a></li>';
//                    echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $row['inv_id'] . '",' . $row['customer_id'] . ',"Original")><i class = "fa fa-download"></i> Download Invoice Original</a></li>';
//                    echo '<li class = "divider"></li>';
//                    echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $row['create_receipt'] . '",' . $row['customer_id'] . ',"Copy")><i class = "fa fa-download"></i> Download Receipt Copy</a></li>';
//                    echo '<li><a href = "#" class="btn-xs" onclick=generateBilling("' . $row['create_receipt'] . '",' . $row['customer_id'] . ',"Original")><i class = "fa fa-download"></i> Download Receipt Original</a></li>';
//                    echo '<li class = "divider"></li>';
//                    echo '<li><a href = "#" class="btn-xs" onclick=generateProgressive("' . $row['inv_id'] . '",' . $row['customer_id'] . ',"Copy")><i class = "fa fa-download"></i> Download progressive Copy</a></li>';
//                    echo '<li><a href = "#" class="btn-xs" onclick=generateProgressive("' . $row['inv_id'] . '",' . $row['customer_id'] . ',"Original")><i class = "fa fa-download"></i> Download progressive Original</a></li>';
//                    echo '<li class = "divider"></li>';
                    echo '<a href = "#" class="btn-xs" onclick=deleteBilling("' . $row['inv_id'] . '")><i class = "fa fa-trash-o"></i> Delete </a>';
//                    echo '</ul>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>                              
        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            $("#dialog").hide();
            $.fn.editable.defaults.mode = 'inline';
        });
        function editTable(inv_id) {
            updateSessionTimeOutCallBack();
            $("#" + inv_id).editable({
                value: 2,
                source: [
                    {value: 44001, text: 'New'},
                    {value: 44002, text: 'Open'},
                    {value: 44003, text: 'Pending'},
                    {value: 44004, text: 'In progress'},
                    {value: 44005, text: 'Closed'}
                ],
                url: '../model/com.qrc.mgr.controller/UpdateInvStatus.php'
            });
        }
        function viewClick(invId, custId, create_receipt) {
            updateSessionTimeOutCallBack();
            var jqxhr = $.post("AjaxViewContent.php?inv_id=" + invId + "&customer_id=" + custId + "&create_receipt=" + create_receipt);
            jqxhr.success(function (data) {
                $("#dialog_Content").html(data);
                var millisecondsToWait = 200;
                setTimeout(function () {
                    $("#dialog").removeClass("hide").dialog({
                        height: 350,
                        width: 600
                    });
                }, millisecondsToWait);
            });
            jqxhr.error(function () {
                alert("ไม่สามารถติดต่อกับ Server ได้");
            });

        }

    </script>
    <div id="dialog" title="Download Detail" class="hide">
        <div id="dialog_Content"></div>

    </div>