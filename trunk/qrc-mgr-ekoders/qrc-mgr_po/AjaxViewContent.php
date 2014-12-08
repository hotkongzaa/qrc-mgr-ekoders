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
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> PO Detail Panel</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <?php
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
                                        . "qp.PO_REMARK as PO_REMARK,"
                                        . "qp.PO_STATUS as PO_STATUS,"
                                        . "qp.PO_RETENTION as WO_RETENTION,"
                                        . "qp.PO_RETENTION_REASON as WO_RETENTION_REASON,"
                                        . "qp.PO_NAME as PO_NAME"
                                        . " FROM QRC_PO qp"
                                        . " LEFT JOIN qrc_type_of_service qts on qp.po_order_type_id = qts.service_id"
                                        . " WHERE QP.PO_ID like '" . $po_id . "'"
                                        . " ORDER BY qp.PO_PROJECT_CODE DESC;";

                                $sqlGetAllData = mysql_query($sqlSelectMemberAll);
                                if (mysql_num_rows($sqlGetAllData) >= 1) {
                                    while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                                        ?>
                                        <tr>
                                            <td>PO Status (สถานะของ PO):</td>
                                            <td><?= $row['PO_STATUS']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO Name (ชื่อ PO):</td>
                                            <td><?= $row['PO_NAME']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Name (ชื่อโครงการ):</td>
                                            <td><?= $row['PO_PROJECT_NAME']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Code (หมายเลขโครงการ): </td>
                                            <td><?= $row['PO_PROJECT_CODE']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Document No. (เลขที่): </td>
                                            <td><?= $row['PO_DOCUMENT_NO']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO No. (เลขที่ใบสั่งจ้าง): </td>
                                            <td><?= $row['PO_PO_NO']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO Owner (เจ้าของ PO): </td>
                                            <td><?= $row['PO_OWNER']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO Sender (จนท. PO): </td>
                                            <td><?= $row['PO_SENDER']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Plan (แบบบ้าน): </td>
                                            <td><?= $row['PO_HOME_PLAN']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Plot (แปลงบ้าน): </td>
                                            <td><?= $row['PO_HOME_PLOT']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Issue Date (วันที่): </td>
                                            <td><?= $row['PO_ISSUE_DATE']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Order Type (ประเภทงาน): </td>
                                            <td><?= $row['order_type_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Quantity (จำนวน): </td>
                                            <td><?= $row['PO_QUANTITY']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Plan Size (ขนาด ตร.ม.): </td>
                                            <td><?= $row['PO_PLAN_SIZE']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Unit Price (ราคาต่อหน่วย): </td>
                                            <td><?= $row['PO_UNIT_PRICE']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount (ราคารวม): </td>
                                            <td><?= $row['PO_AMOUNT']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total included VAT 7%: </td>
                                            <td><?= $row['PO_VAT']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Supervisor Control (ผู้ควบคุมงานของลูกค้า): </td>
                                            <td><?= $row['PO_SUPERVISOR_ID']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Manager (ผู้จัดการโครงการ): </td>
                                            <td><?= $row['PO_PROJECT_MANAGER_ID']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Foreman (ผู้ควบคุมงานของโครงการ): </td>
                                            <td><?= $row['PO_PROJECT_FOREMAN_ID']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Retention: </td>
                                            <td><?= $row['WO_RETENTION']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Retention Reason: </td>
                                            <td><?= $row['WO_RETENTION_REASON']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Remark: </td>
                                            <td><?= $row['PO_REMARK']; ?></td>
                                        </tr>
                                        <?php
                                        $sqlSelectImageByID = "SELECT IMAGE_PATH as IMAGE_PATH FROM qrc_po_image WHERE TEMP_PO_ID LIKE '" . $row['PO_ID'] . "'";
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