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
        $proID = $_GET['po_id'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
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
                . " WHERE qp.project_code = '" . $proID . "'"
                . " ORDER BY qp.created_date_time DESC"
                . " LIMIT 100;";

        $sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
        if (mysql_num_rows($sqlGetAllData) >= 1) {
            while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                echo '<div class="well no-padding no-border-bottom no-margin-bottom">';
                echo '<ul class="lists">';
                echo '<li><b>Project Code :</b>' . $row['project_code'] . '</li>';
                echo '<li><b>Project Code :</b>' . $row['project_name'] . '</li>';
                echo '<li><b>Project Manager(ผู้ดูแลโครงการ)</b>' . $row['project_manager'] . '</li>';
                echo '<li><b>Project Foreman(ผู้ควบคุมงานของโครงการ) :</b>' . $row['project_foreman'] . '</li>';
                echo '<li><b>Supervisor Control(ผู้ควบคุมงานของลูกค้า) :</b>' . $row['supervisor_control'] . '</li>';
                echo '<li><b>Team Owner (ทีมที่ดูแลโครงการ) :</b>' . $row['team_owner'] . '</li>';
                $data = $row['quality_inspectors'];
                $sqlSelectSeletedMembers = "SELECT memName FROM QRC_MEMBERS WHERE memID like '$data';";
                $sqlGetQI = mysql_query($sqlSelectSeletedMembers);
                $rows = mysql_fetch_assoc($sqlGetQI);
                echo '<li><b>Quality Inspection(ผู้ตรวจสอบคุณภาพ) :</b>' . $rows['memName'] . '</li>';
                echo '<li><b>Address/Location :</b>' . $row['address_location'] . '</li>';
                echo '<li><b>Project Type (ประเภทโครงการ)* :</b>' . $row['project_type'] . '</li>';
                echo '<li><b>Project Status (สถานะโครงการ)* :</b>' . $row['project_status'] . '</li>';
                echo '<li><b>Project Owner (เจ้าของโครงการ)* :</b>' . $row['project_owner'] . '</li>';
                echo '<li><b>Customer Name (ชื่อลูกค้า)* :</b>' . $row['customer_name'] . '</li>';
                echo '<li><b>Remark :</b>' . $row['remark'] . '</li>';
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo 'No Records found';
        }
        ?>
    </body>
</html>
