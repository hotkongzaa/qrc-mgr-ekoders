<?php

$service_name = $_REQUEST['project_owner_name'];
include 'conn.php';

$sqlGenerateID = "select max(project_owner_id) as project_owner_id from PROJECT_OWNER;";
$resultSet = mysql_query($sqlGenerateID);
$row = mysql_fetch_array($resultSet);
if ($row['project_owner_id'] == null) {
    $sql = "insert into PROJECT_OWNER(project_owner_id,project_owner_name) values('20001','$service_name')";
} else {
    $sql = "insert into PROJECT_OWNER(project_owner_id,project_owner_name) values('" . ($row['project_owner_id'] + 1) . "','$service_name')";
}

$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>