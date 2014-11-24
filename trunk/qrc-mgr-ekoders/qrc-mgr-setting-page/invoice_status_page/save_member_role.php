<?php

$service_name = $_REQUEST['inv_staus_name'];
include 'conn.php';

$sqlGenerateID = "select max(inv_staus_id) as role_id from QRC_INVOICE_STATUS;";
$resultSet = mysql_query($sqlGenerateID);
$row = mysql_fetch_array($resultSet);
if ($row['role_id'] == null) {
    $sql = "insert into QRC_INVOICE_STATUS(inv_staus_id,inv_staus_name) values('44001','$service_name')";
} else {
    $sql = "insert into QRC_INVOICE_STATUS(inv_staus_id,inv_staus_name) values('" . ($row['role_id'] + 1) . "','$service_name')";
}

$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>