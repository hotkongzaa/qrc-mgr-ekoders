<?php

$id = intval($_REQUEST['id']);
$wo_name = $_REQUEST['A_S_NAME'];
include 'conn.php';

$sql = "update QRC_ASSIGN_STATUS set A_S_NAME='$wo_name' where A_S_ID=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>