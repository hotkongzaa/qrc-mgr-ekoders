<?php

require '../model-db-connection/config.php';
$project_order_code = $_GET['project_order_code'];
$imagePath = $_GET['imagePath'];
$sqlDeleteProjectById = "DELETE FROM QRC_PROJECT_ORDER"
        . " WHERE project_order_id='$project_order_code';";
$sqlSubQueryDelete = "DELETE FROM QRC_ASSIGN_ORDER"
        . " WHERE ASSIGN_ID LIKE (SELECT assign_id FROM QRC_PROJECT_ORDER WHERE project_order_id='$project_order_code');";
mysql_query($sqlSubQueryDelete);
$result = mysql_query($sqlDeleteProjectById);
if ($result) {
    echo '1';
} else {
    echo '2';
}

