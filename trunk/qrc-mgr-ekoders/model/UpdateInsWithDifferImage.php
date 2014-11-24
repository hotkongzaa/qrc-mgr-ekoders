<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$INS_ID = $_GET['INS_ID'];
$project_code = $_GET['inspection_project_name_form'];
$documentNo = $_GET['inspection_document_no_form'];
$inspectionNo = $_GET['inspection_no_form'];
$insDate = $_GET['inspection_date_form'];
$insOrderType = $_GET['inspection_order_type_form'];
$insRemark = $_GET['inspection_remark_form'];

$sqlGetFilePath = "SELECT IMAGE_PATH AS IMAGE_PATHS  FROM QRC_INSPECTION_IMAGE WHERE TEMP_INS_ID LIKE '$INS_ID'";
$queryGetFilePath = mysql_query($sqlGetFilePath);
while ($row = mysql_fetch_assoc($queryGetFilePath)) {
    $strRealFilePath = "../image/uploads/" . $row['IMAGE_PATHS'];
    if (file_exists($strRealFilePath)) {
        unlink($strRealFilePath);
    }
}

$sqlUpdatePOById = "UPDATE QRC_INSPECTION"
        . " SET INS_PROJECT_CODE='$project_code',"
        . "INS_DOCUMENT_NO='$documentNo',"
        . "INS_INSPECTION_NO='$inspectionNo',"
        . "INS_DATE='$insDate',"
        . "INS_ORDER_TYPE='$insOrderType',"
        . "INS_REMARK='$insRemark'"
        . " WHERE INS_ID='$INS_ID'";
$resultSet = mysql_query($sqlUpdatePOById);

$sqlUpdateWithNullImage = "UPDATE QRC_INSPECTION_IMAGE"
        . " SET TEMP_INS_ID = '$INS_ID'"
        . " WHERE TEMP_INS_ID IS NULL;";
mysql_query($sqlUpdateWithNullImage);


if ($resultSet) {
    echo '1';
} else {
    echo '0';
}