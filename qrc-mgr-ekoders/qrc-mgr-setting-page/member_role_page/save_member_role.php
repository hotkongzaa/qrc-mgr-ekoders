<?php

$service_name = $_REQUEST['role_name'];
include 'conn.php';

$sqlGenerateID = "select max(role_id) as role_id from QRC_MEMBER_ROLE;";
$resultSet = mysql_query($sqlGenerateID);
$row = mysql_fetch_array($resultSet);
if ($row['role_id'] == null) {
    $sql = "insert into QRC_MEMBER_ROLE(role_id,role_name) values('60001','$service_name')";
} else {
    $sql = "insert into QRC_MEMBER_ROLE(role_id,role_name) values('" . ($row['role_id'] + 1) . "','$service_name')";
}

$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>