<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$inv_id = $_GET['inv_id'];
$sqlSelectAllProjectRecord = "select *"
        . " from QRC_INVOICE qi"
        . " LEFT JOIN QRC_CUSTOMER_NAME qc on qc.customer_id = qi.customer_id"
        . " LEFT JOIN QRC_TYPE_OF_SERVICE qt on qi.order_type = qt.service_id"
        . " LEFT JOIN QRC_INVOICE_STATUS qis on qi.invoice_status = qis.inv_staus_id"
        . " WHERE qi.inv_id like '" . $inv_id . "'";
$sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
$row = mysql_fetch_array($sqlGetAllData);
echo json_encode($row);
