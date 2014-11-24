<?php

require '../model-db-connection/config.php';
$project_code = $_GET['project_code'];
$sqlDeleteProjectById = "DELETE FROM QRC_PROJECT"
        . " WHERE project_code='$project_code';";

$sqlDeleteProjectOrder = "DELETE FROM QRC_PROJECT_ORDER WHERE PROJECT_CODE ='$project_code'";
$result2 = mysql_query($sqlDeleteProjectOrder);
$result = mysql_query($sqlDeleteProjectById);
if ($result && $result2) {
    echo '1';
} else {
    echo '2';
}

