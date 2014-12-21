<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

$sqlUpdateProjectById = "UPDATE QRC_PROJECT"
        . " SET project_name='$project_name',"
        . "project_status='$project_status',"
        . "project_owner='$project_owner',"
        . "project_type='$project_type',"
        . "customer_id='$project_customer',"
        . "project_manager='$project_manager',"
        . "project_foreman='$project_foreman',"
        . "supervisor_control='$supervisor_control',"
        . "team_owner='$team_owner',"
        . "quality_inspectors='$qa_inspectors',"
        . "address_location='$address_location',"
        . "project_remark='$project_remark',"
        . "updated_date_time=NOW()"
        . " WHERE project_code='$project_code'";

$resultSet = mysql_query($sqlUpdateProjectById);

if ($_GET['isDiffImg'] == "diff") {
    $sqlUpdateWithNullImage = "UPDATE QRC_PROJECT_IMAGE"
            . " SET TEMP_PROJECT_ID = '$project_code'"
            . " WHERE TEMP_PROJECT_ID IS NULL;";
    mysql_query($sqlUpdateWithNullImage);
}

if ($resultSet) {
    echo '1';
} else {
    echo '0';
}