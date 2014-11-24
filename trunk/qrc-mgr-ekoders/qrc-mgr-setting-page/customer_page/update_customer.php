<?php

$id = intval($_REQUEST['id']);
$service_name = $_REQUEST['customer_name'];
$customer_address = $_REQUEST['customer_address'];
$customer_tel = $_REQUEST['customer_tel'];
$customer_fax = $_REQUEST['customer_fax'];
include 'conn.php';

$sql = "update QRC_CUSTOMER_NAME set customer_name='$service_name',customer_address='$customer_address',customer_tel='$customer_tel',customer_fax='$customer_fax' where customer_id=$id";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>