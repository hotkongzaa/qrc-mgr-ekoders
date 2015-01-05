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
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Project Detail Panel</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
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
                                        ?>
                                        <tr>
                                            <td>Project Code:</td>
                                            <td><?= $row['project_code']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Name:</td>
                                            <td><?= $row['project_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Manager(ผู้ดูแลโครงการ):</td>
                                            <td><?= $row['project_manager']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Foreman(ผู้ควบคุมงานของโครงการ): </td>
                                            <td><?= $row['project_foreman']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Supervisor Control(ผู้ควบคุมงานของลูกค้า): </td>
                                            <td><?= $row['supervisor_control']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Team Owner (ทีมที่ดูแลโครงการ): </td>
                                            <td><?= $row['team_owner']; ?></td>
                                        </tr>
                                        <tr>


                                            <td>Quality Inspection(ผู้ตรวจสอบคุณภาพ) : </td>
                                            <td><?php
                                                $data = $row['quality_inspectors'];
                                                $sqlSelectSeletedMembers = "SELECT memName FROM QRC_MEMBERS WHERE memID like '$data';";
                                                $sqlGetQI = mysql_query($sqlSelectSeletedMembers);
                                                $rows = mysql_fetch_assoc($sqlGetQI);
                                                echo $rows['memName'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address/Location : </td>
                                            <td><?= $row['address_location']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Type (ประเภทโครงการ): </td>
                                            <td><?= $row['project_type']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Status (สถานะโครงการ): </td>
                                            <td><?= $row['project_status']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Owner: </td>
                                            <td><?= $row['project_owner']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Customer Name: </td>
                                            <td><?= $row['customer_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Remark: </td>
                                            <td><?= $row['remark']; ?></td>
                                        </tr>
                                        <?php
                                        $sqlSelectImageByID = "SELECT IMAGE_PATH as IMAGE_PATH FROM qrc_project_image WHERE TEMP_PROJECT_ID LIKE '" . $proID . "'";
                                        $queryGetFilePath = mysql_query($sqlSelectImageByID);
                                        $strBuilding = "";

                                        while ($rowq = mysql_fetch_assoc($queryGetFilePath)) {

                                            $strCheckType = substr($rowq['IMAGE_PATH'], -3);
                                            if ($strCheckType == "pdf") {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/pdf_icon.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr-ekoders/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else if ($strCheckType == "doc" || $strCheckType == "docx") {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/doc_icon.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr-ekoders/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else if ($strCheckType == "xls" || $strCheckType == "lsx") {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/xl_icons.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr-ekoders/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else if ($strCheckType == "jpg" || $strCheckType == "JPG" || $strCheckType == "png" || $strCheckType == "gif") {
                                                $strBuilding.='<div class="list-group-item"><d class="fancybox-effects-d" href="../images/uploads/' . $rowq['IMAGE_PATH'] . '" title="' . $rowq['IMAGE_PATH'] . '" onlick="changeAttrHref()">'
                                                        . '<img src="../images/uploads/' . $rowq['IMAGE_PATH'] . '" alt="Smiley face" height="100px"></d>'
                                                        . '<a href="http://localhost/qrc-mgr-ekoders/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/file_icon.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr-ekoders/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            }
                                        }
                                    }
                                } else {
                                    echo 'No Data found';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-image"></i> PO Images Panel</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php
                            if ($strBuilding == "") {
                                echo '<div class="list-group-item">No images/files found</div>';
                            } else {
                                echo $strBuilding;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    function OpenInNewTab(url) {
        var win = window.open("../images/uploads/" + url, '_blank');
        win.focus();
    }
</script>

