<?php

require '../model-db-connection/config.php';

$order_id = $_GET['order_id'];
$project_id = $_GET['project_id'];
$team_code = $_GET['team_code'];
$assign_date = $_GET['assign_date'];

$old_po_no_no = $_GET['old_po_no_no'];
$current_po_no_no = $_GET['current_po_no_no'];

$originalDate = $_GET['target_date'];
$target_date = date("Y-m-d", strtotime($originalDate));

$remark = $_GET['remark'];
$project_order_remark = $_GET['project_order_remark'];
$project_order_status = $_GET['project_order_status'];
$wo_price = $_GET['wo_price'];
$perc_po_price = $_GET['prc_po_price'];

//$assignID = md5(date('l jS \of F Y h:i:s A') . "_" . $project_code);

$sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_ASSIGN_ORDER";
$resultSet = mysql_query($sqlSelectMaxValue);
$row = mysql_fetch_assoc($resultSet);
if ($row['total'] == 0) {
    $strResult = "AS0000001";
} else {
    $sqlSelectCodeValue = "SELECT ASSIGN_ID as code FROM QRC_ASSIGN_ORDER ORDER BY ASSIGN_DATE DESC";
    $resultSets = mysql_query($sqlSelectCodeValue);
    $row = mysql_fetch_assoc($resultSets);
    $prefix = "AS";
    $pieces = explode("AS", $row[code]);
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


$sqlInsertIntoProjectOrderTbl = "INSERT INTO QRC_ASSIGN_ORDER (ASSIGN_ID,WO_ID,PROJECT_ID,TEAM_CODE,ASSIGN_DATE,TARGET_DATE,REMARK)"
        . " VALUES "
        . "('$strResult','$order_id','$project_id','$team_code',NOW(),'$target_date','$remark');";

$resultSets = mysql_query($sqlInsertIntoProjectOrderTbl);

$sqlUpdateProjectOrder = "UPDATE QRC_PROJECT_ORDER"
        . " SET image_name='$current_po_no_no',WO_PERC_OF_PO='$perc_po_price',WO_PRICE='$wo_price',assign_id = '$strResult',project_status = 'Assign', remark = '$project_order_remark'"
        . " WHERE project_order_id LIKE '$order_id';";
mysql_query($sqlUpdateProjectOrder);
$sqlUpdatePO = "";
if ($old_po_no_no == $current_po_no_no) {
    $sqlUpdatePO = "update qrc_po"
            . " set po_status = '$project_order_status'"
            . " where po_id like '$current_po_no_no'";
    mysql_query($sqlUpdatePO);
} else {
    $sqlUpdatePO = "update qrc_po"
            . " set po_status = 'New'"
            . " where po_id like '$old_po_no_no'";
    mysql_query($sqlUpdatePO);

    $sqlUpdatePO2 = "update qrc_po"
            . " set po_status = '$project_order_status'"
            . " where po_id like '$current_po_no_no'";
    mysql_query($sqlUpdatePO2);
}


if ($resultSets) {
    echo 1;
} else {
    echo $target_date;
}