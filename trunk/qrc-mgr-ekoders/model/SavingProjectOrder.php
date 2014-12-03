<?php

require '../model-db-connection/config.php';

$project_order_status = $_GET['project_order_status'];
$project_home_plan = $_GET['project_home_plan'];
$project_home_plot = $_GET['project_home_plot'];
$project_document_no = $_GET['project_document_no'];
$project_po_no = $_GET['project_po_no'];
$project_po_owner = $_GET['project_po_owner'];
$project_po_sender = $_GET['project_po_sender'];
$project_order_type = $_GET['project_order_type'];
$project_plan_size = $_GET['project_plan_size'];
$project_unit_price = $_GET['project_unit_price'];
$project_amount = $_GET['project_amount'];
$project_vat = $_GET['project_vat'];
$project_image_path = $_GET['project_image_path'];
$project_code = $_GET['project_code'];
$wo_name = $_GET['wo_name'];
$orderType = $_GET['orderType'];
$wo_price = $_GET['wo_price'];
$perc_po = $_GET['perc_of_po'];
$realWOPrice = $_GET['realWOPrice'];

//$projectOrderID = md5(date('l jS \of F Y h:i:s A')."_".$project_code);
$sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_PROJECT_ORDER";
$resultSet = mysql_query($sqlSelectMaxValue);
$row = mysql_fetch_assoc($resultSet);
if ($row['total'] == 0) {
    $strResult = "WO0000001";
} else {
    $sqlSelectCodeValue = "SELECT project_order_id as code FROM QRC_PROJECT_ORDER ORDER BY created_date_time DESC";
    $resultSets = mysql_query($sqlSelectCodeValue);
    $row = mysql_fetch_assoc($resultSets);
    $prefix = "WO";
    $pieces = explode("WO", $row[code]);
    if (strlen(intval($pieces[1])) == 1) {
        if (intval($pieces[1]) == 9) {
            $strResult = $prefix . "00000" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "000000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 2) {
        if (intval($pieces[1]) == 99) {
            $strResult = $prefix . "0000" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "00000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 3) {
        if (intval($pieces[1]) == 999) {
            $strResult = $prefix . "000" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "0000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 4) {
        if (intval($pieces[1]) == 9999) {
            $strResult = $prefix . "00" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 5) {
        if (intval($pieces[1]) == 99999) {
            $strResult = $prefix . "0" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "00" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 6) {
        if (intval($pieces[1]) == 999999) {
            $strResult = $prefix . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "0" . (intval($pieces[1] + 1));
        }
    } else {
        $strResult = $prefix . (intval($pieces[1] + 1));
    }
}


$sqlGetRePOToInsert = "SELECT PO_RETENTION,PO_RETENTION_REASON FROM QRC_PO WHERE PO_ID LIKE '$project_image_path'";
$setPODetail = mysql_query($sqlGetRePOToInsert);
while ($poRow = mysql_fetch_assoc($setPODetail)) {
    $sqlInsertIntoProjectOrderTbl = "INSERT INTO QRC_PROJECT_ORDER (project_order_id,project_order_name,project_code,project_order_plan,project_order_plot,document_no,po_no,po_owner,po_sender,created_date_time,order_type,plan_size,unit_price,amount,include_vat,image_name,project_status,wo_order_type,WO_PRICE,WO_PERC_OF_PO,WO_RETENTION,WO_RETENTION_REASON,REAL_WO_PRICE)"
            . " VALUES "
            . "('$strResult','$wo_name','$project_code','$project_home_plan','$project_home_plot','$project_document_no','$project_po_no','$project_po_owner','$project_po_sender',NOW(),'$project_order_type','$project_plan_size','$project_unit_price','$project_amount','$project_vat','$project_image_path','$project_order_status','$orderType','$wo_price','$perc_po','" . $poRow['PO_RETENTION'] . "','" . $poRow['PO_RETENTION_REASON'] . "','$realWOPrice');";
}

$sqlUpdatePO = "update qrc_po"
        . "set po_status = '$project_order_status'"
        . "where po_id like '$project_image_path'";
mysql_query($sqlUpdatePO);
$resultSetss = mysql_query($sqlInsertIntoProjectOrderTbl);
if ($resultSetss) {
    echo '1';
} else {
    echo '0';
}