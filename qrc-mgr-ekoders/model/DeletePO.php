<?php

require '../model-db-connection/config.php';
$PO_ID = $_GET['PO_ID'];

$sqlGetFilePath = "SELECT IMAGE_PATH AS IMAGE_PATHS  FROM QRC_PO_IMAGE WHERE TEMP_PO_ID LIKE '$PO_ID'";
$queryGetFilePath = mysql_query($sqlGetFilePath);
while ($row = mysql_fetch_assoc($queryGetFilePath)) {
    $strRealFilePath = "../images/uploads/".$row['IMAGE_PATHS'];
    if (file_exists($strRealFilePath)) {
        unlink($strRealFilePath);
    }
}
$sqlDeletePOById = "DELETE FROM QRC_PO"
        . " WHERE PO_ID like '$PO_ID';";
$sqlDeleteMemAttr = "DELETE FROM QRC_PO_IMAGE"
        . " WHERE TEMP_PO_ID like '$PO_ID';";
$result = mysql_query($sqlDeletePOById);
$result2 = mysql_query($sqlDeleteMemAttr);
if ($result) {
    echo '1';
} else {
    echo '2';
}

