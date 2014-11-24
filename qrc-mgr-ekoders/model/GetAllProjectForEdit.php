<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$project_code = $_GET['project_code'];
$sqlSelectAllProjectRecord = "SELECT qp.project_code as project_code,"
        . "qp.project_name as project_name,"
        . "qp.project_status as project_status,"
        . "qp.project_owner as project_owner,"
        . "qp.project_type as project_type,"
        . "qcn.customer_id as customer_name,"
        . "qp.project_manager as project_manager,"
        . "qp.project_foreman as project_foreman,"
        . "qp.supervisor_control as supervisor_control,"
        . "qp.team_owner as team_owner,"
        . "qp.quality_inspectors as quality_inspectors,"
        . "qp.project_remark as remark,"
        . "qp.address_location as address_location,"
        . "qp.created_date_time as created_date_time,"
        . "qp.updated_date_time as updated_date_time"
        . " FROM QRC_PROJECT qp"
        . " LEFT JOIN PROJECT_STATUS ps ON qp.project_status = ps.project_status_id"
        . " LEFT JOIN PROJECT_OWNER po ON qp.project_owner = po.project_owner_id"
        . " LEFT JOIN PROJECT_TYPE pt on qp.project_type = pt.project_type_id"
        . " LEFT JOIN QRC_CUSTOMER_NAME qcn on qp.customer_id = qcn.customer_id"
        . " WHERE qp.project_code like '$project_code';";
$sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
$row = mysql_fetch_array($sqlGetAllData);
echo json_encode($row);
