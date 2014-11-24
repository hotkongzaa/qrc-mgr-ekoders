<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$username = $_GET['username'];
$sqlGetUser = mysql_query("SELECT * FROM QRC_USERS WHERE USERNAME='$username'");
$row = mysql_fetch_array($sqlGetUser);
echo json_encode($row);

