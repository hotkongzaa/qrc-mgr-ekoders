<?php

$id = intval($_REQUEST['id']);

include 'conn.php';

$sql = "delete from QRC_MEMBER_ROLE where role_id=$id";
$result = @mysql_query($sql);
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => 'Some errors occured.'));
}
?>