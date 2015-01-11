<?php

require '../model-db-connection/config.php';

$project_name = $_GET['project_name'];
$project_code = $_GET['project_code'];
$doc_no = $_GET['doc_no'];
$po_no = $_GET['po_no'];
$home_plan = $_GET['home_plan'];
$home_plot = $_GET['home_plot'];
$po_owner = $_GET['po_owner'];
$po_sender = $_GET['po_sender'];
$issue_date = $_GET['issue_date'];
$order_type = $_GET['order_type'];
$quantity = $_GET['quantity'];
$plan_size = $_GET['plan_size'];
$unit_price = $_GET['unit_price'];
$amount = $_GET['amount'];
$vat7 = $_GET['vat7'];
$supervisor = $_GET['supervisor'];
$project_manager = $_GET['project_manager'];
$projectforeman = $_GET['projectforeman'];
$project_remark = $_GET['project_remark'];
$po_name = $_GET['po_name'];
$po_status = $_GET['po_status'];
$po_retention = $_GET['po_retention'];
$po_retention_reason = $_GET['po_retention_reason'];


//$strAllID = md5(date('m/d/Y h:i:s a', time()));

$sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_PO";
$resultSet = mysql_query($sqlSelectMaxValue);
if (!$resultSet) {
    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
}
$row = mysql_fetch_assoc($resultSet);
if ($row['total'] == 0) {
    $strResult = "PO0000001";
} else {
    $sqlSelectCodeValue = "SELECT PO_ID as code FROM QRC_PO ORDER BY PO_CREATED_DATE_TIME DESC";
    $resultSets = mysql_query($sqlSelectCodeValue);
    if (!$resultSets) {
        $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
        file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
    }
    $row = mysql_fetch_assoc($resultSets);
    $prefix = "PO";
    $pieces = explode("PO", $row[code]);
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
$sqlInsertIntoMember = "INSERT INTO QRC_PO "
        . "(PO_ID,PO_PROJECT_NAME,PO_PROJECT_CODE,PO_DOCUMENT_NO,PO_PO_NO,PO_HOME_PLAN,PO_HOME_PLOT,PO_OWNER,PO_SENDER,"
        . "PO_ISSUE_DATE,PO_ORDER_TYPE_ID,PO_QUANTITY,PO_PLAN_SIZE,PO_UNIT_PRICE,PO_AMOUNT,PO_VAT,PO_FILE_PATH,"
        . "PO_PROJECT_MANAGER_ID,PO_PROJECT_FOREMAN_ID,PO_SUPERVISOR_ID,PO_CREATED_DATE_TIME,PO_REMARK,PO_NAME,PO_RETENTION,PO_RETENTION_REASON,PO_STATUS)"
        . " VALUES "
        . "('$strResult','$project_name','$project_code','$doc_no','$po_no','$home_plan','$home_plot',"
        . "'$po_owner','$po_sender','$issue_date','$order_type','$quantity','$plan_size','$unit_price','$amount',"
        . "'$vat7',NULL,'$project_manager','$projectforeman','$supervisor',NOW(),'$project_remark','$po_name','$po_retention','$po_retention_reason','$po_status');";
$resultSetss = mysql_query($sqlInsertIntoMember);
if (!$resultSetss) {
    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
}
$updatePoImg = "UPDATE QRC_PO_IMAGE"
        . " SET TEMP_PO_ID = '$strResult'"
        . " WHERE TEMP_PO_ID IS NULL;";

$resultUpdateImage = mysql_query($updatePoImg);
if (!$resultUpdateImage) {
    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
}


if ($resultSetss) {
    echo '1';
} else {
    echo '0';
}    