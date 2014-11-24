<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../model-db-connection/config.php';
$project_code = $_GET['project_code'];
$project_name = $_GET['project_name'];
$project_type = $_GET['project_type'];
$project_status = $_GET['project_status'];
$project_owner = $_GET['project_owner'];
$project_customer = $_GET['project_customer'];
$project_manager = $_GET['project_manager'];
$project_foreman = $_GET['project_foreman'];
$supervisor_control = $_GET['supervisor_control'];
$qa_inspectors = $_GET['qa_inspectors'];
$address_location = $_GET['address_location'];
$project_remark = $_GET['project_remark'];
$team_owner = $_GET['team_owner'];
$sqlInsertIntoProjectTbl = "INSERT INTO QRC_PROJECT "
        . "(project_code,project_name,project_status,project_owner,project_type,customer_id,project_manager,project_foreman,supervisor_control,team_owner,quality_inspectors,address_location,created_date_time,project_remark,updated_date_time)"
        . " values"
        . " ('$project_code','$project_name','$project_status','$project_owner','$project_type','$project_customer','$project_manager','$project_foreman','$supervisor_control','$team_owner','$qa_inspectors','$address_location',NOW(),'$project_remark','')";
$resultSet = mysql_query($sqlInsertIntoProjectTbl);
if ($resultSet) {
    echo '1';
} else {
    echo mysql_error();
}