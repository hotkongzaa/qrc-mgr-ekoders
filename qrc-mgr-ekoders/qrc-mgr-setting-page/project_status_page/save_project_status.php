<?php

$service_name = $_REQUEST['project_status_name'];
include 'conn.php';

$sqlGenerateID = "select max(project_status_id) as project_status_id from PROJECT_STATUS;";
$resultSet = mysql_query($sqlGenerateID);
$row = mysql_fetch_array($resultSet);
$sql = "insert into PROJECT_STATUS(project_status_id,project_status_name) values('" . ($row['project_status_id'] + 1) . "','$service_name')";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>