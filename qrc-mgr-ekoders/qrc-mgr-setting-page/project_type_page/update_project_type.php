<?php

$id = intval($_REQUEST['id']);
$service_name = $_REQUEST['project_type_name'];
include 'conn.php';

$sql = "update PROJECT_TYPE set project_type_name='$service_name' where project_type_id=$id";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>