<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$project_code = $_GET['project_code'];
$project_order_status = $_GET['project_order_status'];
$inspectionID = $_GET['inspection_id'];
$project_order_remark = $_GET['project_order_remark'];
$order_id = $_GET['order_id'];
$wo_price = $_GET['wo_price'];
$perc_po_price = $_GET['prc_po_price'];
$complete_date = $_GET['complete_date'];

//$sqlSubQueryDelete = "DELETE FROM QRC_ASSIGN_ORDER"
//        . " WHERE ASSIGN_ID LIKE (SELECT assign_id FROM QRC_PROJECT_ORDER WHERE project_order_id='$order_id');";
//mysql_query($sqlSubQueryDelete);
$sqlUpdateProjectById = "UPDATE QRC_PROJECT_ORDER"
        . " SET REAL_WO_PRICE='" . $_GET['realWOPrice'] . "',COMPLETE_DATE='" . date("Y-m-d H:i:s", strtotime($complete_date)) . "',WO_PERC_OF_PO='$perc_po_price',WO_PRICE='$wo_price',project_status='$project_order_status',updated_date_time=NOW(),remark='$project_order_remark',po_inspection_id='$inspectionID'"
        . " WHERE project_order_id='$order_id'";

$resultSet = mysql_query($sqlUpdateProjectById);

$sqlUpdatePO = "update qrc_po"
        . " set po_status = '$project_order_status'"
        . " where po_id like '" . $_GET['poForEdit'] . "'";
mysql_query($sqlUpdatePO);

if ($resultSet) {
    echo '1';
} else {
    echo '0';
}