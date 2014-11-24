<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$tCode = $_GET['tCode'];

$sqlGetTname = "SELECT tCode AS teamName FROM QRC_TEAM_BUILDER WHERE tCode ='$tCode'";
$sqlGetAmountData = mysql_query($sqlGetTname);
$AmountResult = mysql_fetch_assoc($sqlGetAmountData);

echo $AmountResult['teamName'];
