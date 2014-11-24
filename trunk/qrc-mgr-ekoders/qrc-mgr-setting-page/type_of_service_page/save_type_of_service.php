<?php

$service_name = $_REQUEST['service_name'];
include 'conn.php';

$sqlGenerateID = "select max(service_id) as service_id from QRC_TYPE_OF_SERVICE;";
$resultSet = mysql_query($sqlGenerateID);
$row = mysql_fetch_array($resultSet);
$sql = "insert into QRC_TYPE_OF_SERVICE(service_id,service_name) values('" . ($row['service_id'] + 1) . "','$service_name')";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>