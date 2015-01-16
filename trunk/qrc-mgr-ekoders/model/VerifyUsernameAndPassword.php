<?php

session_start();
require '../model-db-connection/config.php';
require '../model/com.qrc.mgr.controller/VerifySessionTimeOut.php';

$username = $_GET['username'];
$password = md5($_GET['password']);

$sqlVerifyUser = "SELECT qu.username as username, qu.permission_id as permission_id"
        . " FROM QRC_USERS qu"
        . " WHERE qu.username='$username' AND qu.PASSWORD='$password'";

$sqlGetUser = mysql_query($sqlVerifyUser);
if (mysql_num_rows($sqlGetUser) == 1) {
    $row = mysql_fetch_assoc($sqlGetUser);
    $seso = new VerifySessionTimeOut();
    $seso->initiateTimeOut($row['username'], $row['permission_id']);
    echo mysql_num_rows($sqlGetUser);
} else {
    echo "2";
}
