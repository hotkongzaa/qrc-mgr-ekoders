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
        <input type="text" class="form-control" id="project_code_search" name="project_code_search" placeholder="Project Code (หมายเลขโครงการ)">            
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control" id="project_name_search" name="project_name_search" placeholder="Project Name (โครงการ)">            
    </div>
    <div id="project_name_div status">
        <select class="form-control" id="project_type_search" name="project_type_search">
            <option value="">-Project Type-</option>
            <?php
            $sqlSelectProjectType = "SELECT * FROM PROJECT_TYPE;";
            $resultSet = mysql_query($sqlSelectProjectType);
            while ($row = mysql_fetch_array($resultSet)) {
                echo '<option value="' . $row['project_type_id'] . '">' . $row['project_type_name'] . '</option>';
            }
            ?>                                           
        </select>
    </div>
    <div id="project_name_div status">
        <select class="form-control" id="project_status_search" name="project_status_search">
            <option value="">-Project status-</option>
            <?php
            $sqlSelectProjectType = "SELECT * FROM PROJECT_STATUS;";
            $resultSet = mysql_query($sqlSelectProjectType);
            while ($row = mysql_fetch_array($resultSet)) {
                echo '<option value="' . $row['project_status_id'] . '">' . $row['project_status_name'] . '</option>';
            }
            ?>                                           
        </select>            
    </div>
    <div id="project_name_div status">
        <select class="form-control" id="project_owner_search" name="project_owner_search">
            <option value="">-Project Owner-</option>
            <?php
            $sqlSelectProjectType = "SELECT * FROM PROJECT_OWNER;";
            $resultSet = mysql_query($sqlSelectProjectType);
            while ($row = mysql_fetch_array($resultSet)) {
                echo '<option value="' . $row['project_owner_id'] . '">' . $row['project_owner_name'] . '</option>';
            }
            ?>                                           
        </select>            
    </div>
    <div id="project_name_div status">
        <select class="form-control" id="project_customer_search" name="project_customer_search">
            <option value="">-Customer Name-</option>
            <?php
            $sqlSelectProjectType = "SELECT * FROM QRC_CUSTOMER_NAME;";
            $resultSet = mysql_query($sqlSelectProjectType);
            while ($row = mysql_fetch_array($resultSet)) {
                echo '<option value="' . $row['customer_id'] . '">' . $row['customer_name'] . '</option>';
            }
            ?>                                           
        </select>
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control search_date" id="start_search_date" data-date-format="yyyy-mm-dd" placeholder="Start date">
    </div>
    <div id="project_name_div status">
        <input type="text" class="form-control search_date" id="end_search_date" data-date-format="yyyy-mm-dd" placeholder="End date">
    </div>
    <div id="project_name_div status">
        <select class="form-control" id="project_limit_search" name="project_limit_search">
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
            <option value="All">--All--</option>                                                       
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
