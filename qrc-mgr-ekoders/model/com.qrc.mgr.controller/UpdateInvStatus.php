<?php

require '../../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$pk = $_POST['pk'];
$name = $_POST['name'];
$value = $_POST['value'];

if (!empty($value)) {
    $sqlUpdateProjectOrder = "UPDATE QRC_PROJECT_ORDER SET INV_REP_PGS_STATUS_ID = $value WHERE INV_REP_PGS_ID LIKE '$pk'";
    mysql_query($sqlUpdateProjectOrder);
    $sqlUpdateINVStatus = "UPDATE QRC_INVOICE SET INVOICE_STATUS = $value WHERE INV_ID LIKE '$pk';";
    mysql_query($sqlUpdateINVStatus);
} else {
    header('HTTP 400 Bad Request', true, 400);
    echo "This field is required!";
}
