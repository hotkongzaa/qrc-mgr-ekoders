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
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> WO Detail Panel</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                                <?php
                                $sqlSelectAllProjectRecord = "SELECT qpo.project_code as project_code,"
                                        . "qpo.project_order_id as order_id,"
                                        . "qpo.project_order_name as order_name,"
                                        . "qpo.project_order_plan as project_plan,"
                                        . "qpo.project_order_plot as project_plot,"
                                        . "qpo.document_no as document_no,"
                                        . "qpo.image_name as po_id,"
                                        . "qpo.po_no as po_no,"
                                        . "qpo.po_owner as po_owner,"
                                        . "qpo.po_sender as po_sender,"
                                        . "qpo.created_date_time as created_date_time,"
                                        . "qpot.service_name as order_type,"
                                        . "qpo.plan_size as plan_size,"
                                        . "qpo.unit_price as unit_price,"
                                        . "qpo.amount as amount,"
                                        . "qpo.include_vat as vat,"
                                        . "qis.inv_staus_name as inv_status_name,"
                                        . "qpo.inv_rep_pgs_id as inv_rep_pgs_id,"
                                        . "qpo.image_name as imgName,"
                                        . "qpo.project_status as project_status,"
                                        . "qpo.remark as project_order_remark"
                                        . " FROM QRC_PROJECT_ORDER qpo"
                                        . " LEFT JOIN QRC_TYPE_OF_SERVICE qpot ON qpo.order_type = qpot.service_id"
                                        . " LEFT JOIN QRC_INVOICE_STATUS qis ON qpo.inv_rep_pgs_status_id = qis.inv_staus_id"
                                        . " WHERE qpo.project_order_id = '" . $po_id . "'"
                                        . " ORDER BY qpo.created_date_time DESC;";

                                $sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
                                if (mysql_num_rows($sqlGetAllData) >= 1) {
                                    while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                                        ?>
                                        <tr>
                                            <td>PO Status:</td>
                                            <td><?= $row['project_status']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO ID:</td>
                                            <td><?= $row['po_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Code:</td>
                                            <td><?= $row['project_code']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Order ID:</td>
                                            <td><?= $row['order_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Order Name:</td>
                                            <td><?= $row['order_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Plan: </td>
                                            <td><?= $row['project_plan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Plot: </td>
                                            <td><?= $row['project_plot']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO Document No.: </td>
                                            <td><?= $row['document_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO No.: </td>
                                            <td><?= $row['po_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO Owner: </td>
                                            <td><?= $row['po_owner']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>PO Sender: </td>
                                            <td><?= $row['po_sender']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Create Date Time: </td>
                                            <td><?= $row['created_date_time']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Order Type: </td>
                                            <td><?= $row['order_type']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Plan Size: </td>
                                            <td><?= $row['plan_size']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Unit Price: </td>
                                            <td><?= $row['unit_price']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount: </td>
                                            <td><?= $row['amount']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>VAT 7%: </td>
                                            <td><?= $row['vat']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Reamrk: </td>
                                            <td><?= $row['project_order_remark']; ?></td>
                                        </tr>
                                        <?php
                                        $sqlSelectImageByID = "SELECT IMAGE_PATH as IMAGE_PATH FROM qrc_po_image WHERE TEMP_PO_ID LIKE '" . $row['po_id'] . "'";
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
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
//$sqlSelectAllProjectRecord = "SELECT qpo.project_code as project_code,
//                        qpo.project_order_id as order_id,
//                        qpo.project_order_name as order_name,
//            qpo.project_order_plan as project_plan,
//            qpo.project_order_plot as project_plot,
//            qpo.document_no as document_no,
//            qpo.po_no as po_no,
//            qpo.po_owner as po_owner,
//            qpo.po_sender as po_sender,
//            qpo.created_date_time as created_date_time,
//            qpot.service_name as order_type,
//            qpo.plan_size as plan_size,
//            qpo.unit_price as unit_price,
//            qpo.amount as amount,
//            qpo.include_vat as vat,
//            qis.inv_staus_name as inv_status_name,
//            qpo.inv_rep_pgs_id as inv_rep_pgs_id,
//            qpo.image_name as imgName,
//                        qpo.project_status as project_status,
//                        qpo.remark as project_order_remark
//                        FROM QRC_PROJECT_ORDER qpo
//                        LEFT JOIN QRC_TYPE_OF_SERVICE qpot ON qpo.order_type = qpot.service_id
//                        LEFT JOIN QRC_INVOICE_STATUS qis ON qpo.inv_rep_pgs_status_id = qis.inv_staus_id
//                        WHERE qpo.project_order_id = '" . $po_id . "'
//                        ORDER BY qpo.created_date_time DESC;";
//
//$sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
//if (mysql_num_rows($sqlGetAllData) >= 1) {
//    while ($row = mysql_fetch_assoc($sqlGetAllData)) {
//        echo '<div class="note"><b>WO Name: </b>' . $row['order_name'] . '</div>';
//        if ($row['inv_status_name'] == null || $row['inv_status_name'] == "") {
//            
//        } else {
//            echo '<div class="note"><b>WO Status: </b>' . $row['inv_status_name'] . '</div>';
//            echo '<div class="note"><b>Invoice ID: </b>' . $row['inv_rep_pgs_id'] . '</div>';
//        }
//        echo '<div class="note"><b>Project Status: </b>' . $row['project_status'] . '</div>';
//        echo '<div class="note"><b>Project Code: </b>' . $row['project_code'] . '</div>';
//        echo '<div class="note"><b>Document No. : </b>' . $row['document_no'] . '</div>';
//        echo '<div class="note"><b>PO No. : </b>' . $row['po_no'] . '</div>';
//        echo '<div class="note"><b>PO Owner: </b>' . $row['po_owner'] . '</div>';
//        echo '<div class="note"><b>PO Sender: </b>' . $row['po_sender'] . '</div>';
//        echo '<div class="note"><b>Created Date Time: </b>' . $row['created_date_time'] . '</div>';
//        echo '<div class="note"><b>Order Type: </b>' . $row['order_type'] . '</div>';
//        $selectImageFromQRCPOIMG = "SELECT IMAGE_PATH AS IMAGE_PATH FROM QRC_PO_IMAGE WHERE TEMP_PO_ID LIKE '" . $row['imgName'] . "'";
//        $sqlGetAllDatas = mysql_query($selectImageFromQRCPOIMG);
//
//        echo '<div class="note"><b>Plan (แบบบ้าน)*: </b>' . $row['project_plan'] . '</div>';
//        echo '<div class="note"><b>Plot (แปลงบ้าน)*: </b>' . $row['project_plot'] . '</div>';
//        echo '<div class="note"><b>Plan Size (ขนาด ตร.ม.): </b>' . $row['plan_size'] . '</div>';
////echo '<div class="note"><b>Unit Price (ราคาต่อหน่วย): </b>' . $row['unit_price'] . '</div>';
////echo '<div class="note"><b>Amount (ราคารวม): </b>' . $row['amount'] . '</div>';
////echo '<div class="note"><b>Grand Total included VAT 7%: </b>' . $row['vat'] . '</div>';
//        echo '<div class="note"><b>Remark: </b>' . $row['project_order_remark'] . '</div>';
//        while ($rop = mysql_fetch_assoc($sqlGetAllDatas)) {
//            echo '<d class="fancybox-effects-d" href="../images/uploads/' . $rop['IMAGE_PATH'] . '" title="' . $rop['IMAGE_PATH'] . '" onlick="changeAttrHref()"><img src="../images/uploads/' . $rop['IMAGE_PATH'] . '" alt="Smiley face" width="100px" height="100px"></d>';
//        }
//    }
//} else {
//    echo 'No Records found';
//}
?>
    </body>
</html>-->