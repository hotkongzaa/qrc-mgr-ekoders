<?php

$id = intval($_REQUEST['id']);
$service_name = $_REQUEST['service_name'];
include 'conn.php';

$sql = "update QRC_TYPE_OF_SERVICE set service_name='$service_name' where service_id=$id";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>