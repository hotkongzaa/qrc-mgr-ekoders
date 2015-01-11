<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../model-db-connection/config.php';

$po_id = $_GET['po_id'];

$sqlGetPORetention = "SELECT PO_RETENTION AS retention, PO_RETENTION_REASON as retention_reason"
        . " FROM QRC_PO"
        . " WHERE PO_ID like '$po_id';";

$getPoSet = mysql_query($sqlGetPORetention);
if (!$getPoSet) {
    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
}
$result = mysql_fetch_array($getPoSet);
echo json_encode($result);

