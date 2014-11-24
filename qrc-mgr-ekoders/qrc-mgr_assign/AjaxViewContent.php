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
        <?php
        $sqlSelectAllProjectRecord = "SELECT qpo.project_code as project_code,
                        qpo.project_order_id as order_id,
                        qpo.project_order_name as order_name,
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
            qis.inv_staus_name as inv_status_name,
            qpo.inv_rep_pgs_id as inv_rep_pgs_id,
            qpo.image_name as imgName,
                        qpo.project_status as project_status,
                        qpo.remark as project_order_remark
                        FROM QRC_PROJECT_ORDER qpo
                        LEFT JOIN QRC_TYPE_OF_SERVICE qpot ON qpo.order_type = qpot.service_id
                        LEFT JOIN QRC_INVOICE_STATUS qis ON qpo.inv_rep_pgs_status_id = qis.inv_staus_id
                        WHERE qpo.project_order_id = '" . $po_id . "'
                        ORDER BY qpo.created_date_time DESC;";

        $sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
        if (mysql_num_rows($sqlGetAllData) >= 1) {
            while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                echo '<div class="note"><b>WO Name: </b>' . $row['order_name'] . '</div>';
                if ($row['inv_status_name'] == null || $row['inv_status_name'] == "") {
                    
                } else {
                    echo '<div class="note"><b>WO Status: </b>' . $row['inv_status_name'] . '</div>';
                    echo '<div class="note"><b>Invoice ID: </b>' . $row['inv_rep_pgs_id'] . '</div>';
                }
                echo '<div class="note"><b>Project Status: </b>' . $row['project_status'] . '</div>';
                echo '<div class="note"><b>Project Code: </b>' . $row['project_code'] . '</div>';
                echo '<div class="note"><b>Document No. : </b>' . $row['document_no'] . '</div>';
                echo '<div class="note"><b>PO No. : </b>' . $row['po_no'] . '</div>';
                echo '<div class="note"><b>PO Owner: </b>' . $row['po_owner'] . '</div>';
                echo '<div class="note"><b>PO Sender: </b>' . $row['po_sender'] . '</div>';
                echo '<div class="note"><b>Created Date Time: </b>' . $row['created_date_time'] . '</div>';
                echo '<div class="note"><b>Order Type: </b>' . $row['order_type'] . '</div>';
                $selectImageFromQRCPOIMG = "SELECT IMAGE_PATH AS IMAGE_PATH FROM QRC_PO_IMAGE WHERE TEMP_PO_ID LIKE '" . $row['imgName'] . "'";
                $sqlGetAllDatas = mysql_query($selectImageFromQRCPOIMG);

                echo '<div class="note"><b>Plan (แบบบ้าน)*: </b>' . $row['project_plan'] . '</div>';
                echo '<div class="note"><b>Plot (แปลงบ้าน)*: </b>' . $row['project_plot'] . '</div>';
                echo '<div class="note"><b>Plan Size (ขนาด ตร.ม.): </b>' . $row['plan_size'] . '</div>';
                //echo '<div class="note"><b>Unit Price (ราคาต่อหน่วย): </b>' . $row['unit_price'] . '</div>';
                //echo '<div class="note"><b>Amount (ราคารวม): </b>' . $row['amount'] . '</div>';
                //echo '<div class="note"><b>Grand Total included VAT 7%: </b>' . $row['vat'] . '</div>';
                echo '<div class="note"><b>Remark: </b>' . $row['project_order_remark'] . '</div>';
                while ($rop = mysql_fetch_assoc($sqlGetAllDatas)) {
                    echo '<d class="fancybox-effects-d" href="../images/uploads/' . $rop['IMAGE_PATH'] . '" title="' . $rop['IMAGE_PATH'] . '" onlick="changeAttrHref()"><img src="../images/uploads/' . $rop['IMAGE_PATH'] . '" alt="Smiley face" width="100px" height="100px"></d>';
                }
            }
        } else {
            echo 'No Records found';
        }
        ?>
    </body>
</html>