<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$project_code = $_GET['project_code'];
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
$order_id = $_GET['order_id'];
$project_image_path = $_GET['project_image_path'];
$project_remark = $_GET['project_remark'];
$wo_name = $_GET['wo_name'];
$orderType = $_GET['orderType'];
$wo_price = $_GET['wo_price'];
$perc_po_price = $_GET['prc_po_price'];



//$sqlSubQueryDelete = "DELETE FROM QRC_ASSIGN_ORDER"
//        . " WHERE ASSIGN_ID LIKE (SELECT assign_id FROM QRC_PROJECT_ORDER WHERE project_order_id='$order_id');";
//mysql_query($sqlSubQueryDelete);
$sqlUpdateProjectById = "UPDATE QRC_PROJECT_ORDER"
        . " SET WO_PERC_OF_PO='$perc_po_price',WO_PRICE='$wo_price',WO_ORDER_TYPE='$orderType',project_order_name='$wo_name',project_order_plan='$project_home_plan',project_order_plot='$project_home_plot',document_no='$project_document_no',po_no='$project_po_no',po_owner='$project_po_owner',po_sender='$project_po_sender',order_type='$project_order_type',plan_size='$project_plan_size',unit_price='$project_unit_price',amount='$project_amount',include_vat='$project_vat',image_name='$project_image_path',project_status='$project_order_status',updated_date_time=NOW(),remark='$project_remark'"
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