<?php
require '../model-db-connection/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$projectCode = $_GET['tCode'];

$sqlGetTname = "SELECT qp.project_code as project_code,"
        . " qp.project_name as project_name,"
        . " qp.project_manager as project_manager,"
        . " qp.supervisor_control as supervisor,"
        . " qp.project_foreman as project_foreman"
        . " FROM QRC_PROJECT qp"
        . " WHERE qp.project_name like '$projectCode';";
$sqlGetAmountData = mysql_query($sqlGetTname);
$AmountResult = mysql_fetch_assoc($sqlGetAmountData);

echo json_encode($AmountResult);
