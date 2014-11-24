<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
$po_id = $_GET['po_id'];
$po_name = $_GET['po_name'];


$sqlUpdatePOById = "UPDATE QRC_PO"
        . " SET PO_PROJECT_NAME='$project_name',"
        . "PO_PROJECT_CODE='$project_code',"
        . "PO_DOCUMENT_NO='$doc_no',"
        . "PO_PO_NO='$po_no',"
        . "PO_NAME='$po_name',"
        . "PO_HOME_PLAN='$home_plan',"
        . "PO_HOME_PLOT='$home_plot',"
        . "PO_OWNER='$po_owner',"
        . "PO_SENDER='$po_sender',"
        . "PO_ISSUE_DATE='$issue_date',"
        . "PO_ORDER_TYPE_ID='$order_type',"
        . "PO_QUANTITY='$quantity',"
        . "PO_PLAN_SIZE='$plan_size',"
        . "PO_UNIT_PRICE='$unit_price',"
        . "PO_AMOUNT='$amount',"
        . "PO_VAT='$vat7',"
        . "PO_PROJECT_MANAGER_ID='$project_manager',"
        . "PO_PROJECT_FOREMAN_ID='$projectforeman',"
        . "PO_SUPERVISOR_ID='$supervisor',"
        . "PO_REMARK='$project_remark'"
        . " WHERE PO_ID='$po_id'";
$resultSet = mysql_query($sqlUpdatePOById);

//$sqlDeletePoImage = "DELETE FROM QRC_PO_IMAGE"
//        . " WHERE TEMP_PO_ID LIKE '$po_id';";
//mysql_query($sqlDeletePoImage);

$sqlUpdateWithNullImage = "UPDATE QRC_PO_IMAGE"
        . " SET TEMP_PO_ID = '$po_id'"
        . " WHERE TEMP_PO_ID IS NULL;";
mysql_query($sqlUpdateWithNullImage);


if ($resultSet) {
    echo '1';
} else {
    echo '0';
}