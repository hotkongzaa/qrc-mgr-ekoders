<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../model-db-connection/config.php';

$sqlGetLatestOrderId = "SELECT project_order_id
FROM QRC_PROJECT_ORDER
ORDER BY created_date_time DESC
LIMIT 1;";
$res = mysql_query($sqlGetLatestOrderId);
$row = mysql_fetch_assoc($res);
echo $row['project_order_id'];