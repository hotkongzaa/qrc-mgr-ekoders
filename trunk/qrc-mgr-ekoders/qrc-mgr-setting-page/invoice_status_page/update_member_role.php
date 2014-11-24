<?php

$id = intval($_REQUEST['id']);
$service_name = $_REQUEST['inv_staus_name'];
include 'conn.php';

$sql = "update QRC_INVOICE_STATUS set inv_staus_name='$service_name' where inv_staus_id=$id";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>