<?php

$service_name = $_REQUEST['project_type_name'];
include 'conn.php';

$sqlGenerateID = "select max(project_type_id) as project_type_id from PROJECT_TYPE;";
$resultSet = mysql_query($sqlGenerateID);
$row = mysql_fetch_array($resultSet);
if ($row['project_type_id'] == null) {
    $sql = "insert into PROJECT_TYPE(project_type_id,project_type_name) values('10001','$service_name')";
} else {
    $sql = "insert into PROJECT_TYPE(project_type_id,project_type_name) values('" . ($row['project_type_id'] + 1) . "','$service_name')";
}

$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>