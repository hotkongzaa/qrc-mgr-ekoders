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
    }
}
?>
<div class="form-group">
    <div id="project_name_div status">
        <select class="form-control" id="po_project_name_search" name="po_project_name_search">
            <option value="0">-- Select Project --</option>
            <?php
            $sqlSelectMemType = "SELECT * FROM QRC_PROJECT;";
            $resultSets = mysql_query($sqlSelectMemType);
            while ($row = mysql_fetch_array($resultSets)) {
                echo '<option value="' . $row['project_code'] . '">' . $row['project_name'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control" id="po_document_no_search" placeholder="Document No. (เลขที่)">
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control" id="po_po_no_search" placeholder="PO No. (เลขที่ใบสั่งจ้าง)">
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control" id="po_owner_search" placeholder="PO Owner (เจ้าของ PO)">        
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control" id="po_sender_search" placeholder="PO Sender (จนท. PO)">         
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control date_selecter search_date" id="po_issue_date_search" data-date-format="yyyy-mm-dd" placeholder="Issue Date (วันที่)">
    </div>
    <div id="project_name_div status">
        <select class="form-control" id="po_order_type_search" name="po_order_type_search">
            <option value="0">-- Select Order Type --</option>
            <?php
            $sqlSelectMemType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
            $resultSets = mysql_query($sqlSelectMemType);
            while ($row = mysql_fetch_array($resultSets)) {
                echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div id="project_name_div status">
        <select class="form-control" id="po_status_search" name="po_status_search">
            <option value="0">-- Select PO Status --</option>
            <?php
            $sel = "SELECT * FROM QRC_ASSIGN_STATUS;";
            $resulSet = mysql_query($sel);
            while ($row = mysql_fetch_array($resulSet)) {
                echo '<option value="' . $row['A_S_NAME'] . '">' . $row['A_S_NAME'] . '</option>';
            }
            ?>
        </select>
    </div>
    
</div>
<script src="../assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".search_date").datepicker();
    });
</script>
