<?php

$id = intval($_REQUEST['id']);
$service_name = $_REQUEST['project_status_name'];
include 'conn.php';

$sql = "update PROJECT_STATUS set project_status_name='$service_name' where project_status_id=$id";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>