<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$ins_id = $_GET['ins_id'];
$sqlSelectInspectionAll = "SELECT qp.project_name as project_name,"
        . "qi.INS_ID as INS_ID,"
        . "qpo.PO_DOCUMENT_NO as PO_DOCUMENT_NO,"
        . "qpo.PO_ID as PO_ID,"
        . "qp.project_code as project_code,"
        . "qi.INS_INSPECTION_NO as INS_INSPECTION_NO,"
        . "qi.INS_DATE as INS_DATE,"
        . "qi.INS_ORDER_TYPE as INS_ORDER_TYPE,"
        . "qpo.PO_HOME_PLAN as PO_HOME_PLAN,"
        . "qpo.PO_HOME_PLOT as PO_HOME_PLOT,"
        . "qpo.PO_PO_NO as PO_PO_NO,"
        . "qpo.PO_ISSUE_DATE as PO_ISSUE_DATE,"
        . "qpo.PO_QUANTITY as PO_QUANTITY,"
        . "qpo.PO_PLAN_SIZE as PO_PLAN_SIZE,"
        . "qi.INS_IMAGE_PATH as INS_IMAGE_PATH,"
        . "qp.project_manager as project_manager,"
        . "qp.project_foreman as project_foreman,"
        . "qp.supervisor_control as supervisor_control,"
        . "qi.INS_REMARK as INS_REMARK"
        . " FROM QRC_INSPECTION qi"
        . " LEFT JOIN QRC_PROJECT qp ON qp.project_code = qi.INS_PROJECT_CODE"
        . " LEFT JOIN QRC_PO qpo ON qpo.PO_ID = qi.INS_DOCUMENT_NO"
        . " LEFT JOIN QRC_TYPE_OF_SERVICE qos ON qi.INS_ORDER_TYPE = qos.service_id"
        . " WHERE qi.INS_ID like '$ins_id';";
$sqlGetAllData = mysql_query($sqlSelectInspectionAll);
$row = mysql_fetch_array($sqlGetAllData);
echo json_encode($row);
