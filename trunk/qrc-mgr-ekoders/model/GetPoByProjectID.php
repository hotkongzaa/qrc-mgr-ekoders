<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$project_code = $_GET['project_code'];
$OldPONO = $_GET['oldPONO'];

if (!empty($OldPONO)) {
    $strResult = "<option value='0'>---Please select---</option><option value='" . $OldPONO . "' selected>" . $OldPONO . "</option>";
} else {
    $strResult = "<option value='0'>---Please select---</option>";
}
$sqlSelectMemberAll = "SELECT qp.PO_PROJECT_NAME as PO_PROJECT_NAME,"
        . "qp.PO_PROJECT_CODE as PO_PROJECT_CODE,"
        . "qp.PO_DOCUMENT_NO as PO_DOCUMENT_NO,"
        . "qp.PO_PO_NO as PO_PO_NO,"
        . "qp.PO_HOME_PLAN as PO_HOME_PLAN,"
        . "qp.PO_HOME_PLOT as PO_HOME_PLOT,"
        . "qp.PO_OWNER as PO_OWNER,"
        . "qp.PO_SENDER as PO_SENDER,"
        . "qp.PO_ISSUE_DATE as PO_ISSUE_DATE,"
        . "qp.PO_ORDER_TYPE_ID as order_type_name,"
        . "qp.PO_QUANTITY as PO_QUANTITY,"
        . "qp.PO_PLAN_SIZE as PO_PLAN_SIZE,"
        . "qp.PO_UNIT_PRICE as PO_UNIT_PRICE,"
        . "qp.PO_AMOUNT as PO_AMOUNT,"
        . "qp.PO_VAT as  PO_VAT,"
        . "qp.PO_SUPERVISOR_ID as PO_SUPERVISOR_ID,"
        . "qp.PO_PROJECT_MANAGER_ID as PO_PROJECT_MANAGER_ID,"
        . "qp.PO_PROJECT_FOREMAN_ID as PO_PROJECT_FOREMAN_ID,"
        . "qp.PO_ID as PO_ID,"
        . "qp.PO_REMARK as PO_REMARK"
        . " FROM QRC_PO qp"
        . " LEFT JOIN qrc_type_of_service qts on qp.po_order_type_id = qts.service_id"
        . " WHERE qp.PO_PROJECT_CODE LIKE '$project_code' AND qp.PO_STATUS = 'New';";
$sqlGetAllData = mysql_query($sqlSelectMemberAll);
while ($row = mysql_fetch_array($sqlGetAllData)) {
    $strResult.= '<option value="' . $row['PO_ID'] . '">' . $row['PO_ID'] . '</option>';
}
echo $strResult;
$strResult = "";
