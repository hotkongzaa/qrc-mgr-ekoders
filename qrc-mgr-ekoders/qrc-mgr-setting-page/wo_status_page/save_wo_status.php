<?php

$firstname = $_REQUEST['A_S_NAME'];
//$lastname = $_REQUEST['lastname'];
//$phone = $_REQUEST['phone'];
//$email = $_REQUEST['email'];

include 'conn.php';

$sqlGenerateID = "select max(A_S_ID) as A_S_ID from QRC_ASSIGN_STATUS;";
$resultSet = mysql_query($sqlGenerateID);
$row = mysql_fetch_array($resultSet);
if ($row['A_S_ID'] == null) {
    $sql = "insert into QRC_ASSIGN_STATUS(A_S_ID,A_S_NAME) values('80001','$firstname')";
} else {
    $sql = "insert into QRC_ASSIGN_STATUS(A_S_ID,A_S_NAME) values('" . ($row['A_S_ID'] + 1) . "','$firstname')";
}
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>