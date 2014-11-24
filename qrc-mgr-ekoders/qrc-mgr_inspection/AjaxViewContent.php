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
        $po_id = $_GET['po_id'];
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
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Inspection Detail Panel</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <?php
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
                                        . " AND qi.INS_ID = '" . $po_id . "'"
                                        . " ORDER By INS_CREATED_DATE_TIME DESC;";

                                $sqlGetAllData = mysql_query($sqlSelectInspectionAll);
                                if (mysql_num_rows($sqlGetAllData) >= 1) {
                                    while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                                        ?>
                                        <tr>
                                            <td>Inpection ID:</td>
                                            <td><?= $row['INS_ID']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Name (ชื่อโครงการ):</td>
                                            <td><?= $row['project_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td >Project Code (หมายเลขโครงการ):</td>
                                            <td><?= $row['project_code']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Inspection No. (เลขที่ใบตรวจรับงาน):</td>
                                            <td><?= $row['INS_INSPECTION_NO']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Inspection Date (วันที่):</td>
                                            <td><?= $row['INS_DATE']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Order Type (ประเภทงาน):</td>
                                            <td><?= $row['service_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Plan (แบบบ้าน):</td>
                                            <td><?= $row['PO_HOME_PLAN']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Plot (แปลงบ้าน):</td>
                                            <td><?= $row['PO_HOME_PLOT']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO Issue Date (วันที่):</td>
                                            <td><?= $row['PO_ISSUE_DATE']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Quantity (จำนวน):</td>
                                            <td><?= $row['PO_QUANTITY']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Plan Size (ขนาด ตร.ม.):</td>
                                            <td><?= $row['PO_PLAN_SIZE']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Supervisor Control (ผู้ควบคุมงานของลูกค้า):</td>
                                            <td><?= $row['supervisor_control']; ?></td>
                                        </tr>
                                        <tr>
                                            <td >Project Manager (ผู้จัดการโครงการ):</td>
                                            <td><?= $row['project_manager']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Foreman (ผู้ควบคุมงานของโครงการ):</td>
                                            <td><?= $row['project_foreman']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Remark:</td>
                                            <td><?= $row['INS_REMARK']; ?></td>
                                        </tr>

                                        <?php
                                        $sqlSelectImageByID = "SELECT IMAGE_PATH as IMAGE_PATH FROM qrc_inspection_image WHERE TEMP_INS_ID LIKE '" . $row['INS_ID'] . "'";
                                        $queryGetFilePath = mysql_query($sqlSelectImageByID);
                                        $strBuilding = "";

                                        while ($rowq = mysql_fetch_assoc($queryGetFilePath)) {

                                            $strCheckType = substr($rowq['IMAGE_PATH'], -3);
                                            if ($strCheckType == "pdf") {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/pdf_icon.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else if ($strCheckType == "doc" || $strCheckType == "docx") {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/doc_icon.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else if ($strCheckType == "xls" || $strCheckType == "lsx") {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/xl_icons.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else if ($strCheckType == "jpg" || $strCheckType == "JPG" || $strCheckType == "png" || $strCheckType == "gif") {
                                                $strBuilding.='<div class="list-group-item"><d class="fancybox-effects-d" href="../images/uploads/' . $rowq['IMAGE_PATH'] . '" title="' . $rowq['IMAGE_PATH'] . '" onlick="changeAttrHref()">'
                                                        . '<img src="../images/uploads/' . $rowq['IMAGE_PATH'] . '" alt="Smiley face" height="100px"></d>'
                                                        . '<a href="http://localhost/qrc-mgr/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
                                            } else {
                                                $strBuilding.='<div class="list-group-item"><img src="../images/file_icon.png" height="50px"/>' . $rowq['IMAGE_PATH']
                                                        . '<br/><a href="http://localhost/qrc-mgr/images/uploads/' . $rowq['IMAGE_PATH'] . '" target="_blank">Download</a></div>';
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
                        <h3 class="panel-title"><i class="fa fa-image"></i> Inspection Images Panel</h3>
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
