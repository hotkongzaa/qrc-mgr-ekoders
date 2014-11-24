<?php

require '../model-db-connection/config.php';
$INS_ID = $_GET['INS_ID'];

$sqlGetFilePath = "SELECT IMAGE_PATH AS IMAGE_PATHS  FROM QRC_INSPECTION_IMAGE WHERE TEMP_INS_ID LIKE '$INS_ID'";
$queryGetFilePath = mysql_query($sqlGetFilePath);
while ($row = mysql_fetch_assoc($queryGetFilePath)) {
    $strRealFilePath = "../image/uploads/".$row['IMAGE_PATHS'];
    if (file_exists($strRealFilePath)) {
        unlink($strRealFilePath);
    }
}
$sqlDeletePOById = "DELETE FROM QRC_INSPECTION"
        . " WHERE INS_ID like '$INS_ID';";
$sqlDeleteMemAttr = "DELETE FROM QRC_INSPECTION_IMAGE"
        . " WHERE TEMP_INS_ID like '$INS_ID';";
$result = mysql_query($sqlDeletePOById);
$result2 = mysql_query($sqlDeleteMemAttr);
if ($result) {
    echo '1';
} else {
    echo '2';
}

