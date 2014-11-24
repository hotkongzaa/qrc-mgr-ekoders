<?php

$id = intval($_REQUEST['id']);
$service_name = $_REQUEST['role_name'];
include 'conn.php';

$sql = "update QRC_MEMBER_ROLE set role_name='$service_name' where role_id=$id";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>