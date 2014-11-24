<?php

require '../model-db-connection/config.php';

$project_code = $_GET['inspection_project_name_form'];
$documentNo = $_GET['inspection_document_no_form'];
$inspectionNo = $_GET['inspection_no_form'];
$insDate = $_GET['inspection_date_form'];
$insOrderType = $_GET['inspection_order_type_form'];
$insRemark = $_GET['inspection_remark_form'];

//$INS_ID = md5(date('m/d/Y h:i:s a', time()) . $inspectionNo);

$sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_INSPECTION";
$resultSet = mysql_query($sqlSelectMaxValue);
$row = mysql_fetch_assoc($resultSet);
if ($row['total'] == 0) {
//    echo '<p class="form-control-static" id="projectCode">PR00001</p>';
//    echo '<input type="hidden" name="project_code" id="project_code" value="PR00001"/>';
    $strResult = "IN0000001";
} else {
    $sqlSelectCodeValue = "SELECT INS_ID as code FROM QRC_INSPECTION ORDER BY INS_CREATED_DATE_TIME DESC";
    $resultSets = mysql_query($sqlSelectCodeValue);
    $row = mysql_fetch_assoc($resultSets);
    $prefix = "IN";
    $pieces = explode("IN", $row[code]);
    if (strlen(intval($pieces[1])) == 1) {
        if (intval($pieces[1]) == 9) {
            $strResult = $prefix . "00000" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "000000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 2) {
        if (intval($pieces[1]) == 99) {
            $strResult = $prefix . "0000" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "00000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 3) {
        if (intval($pieces[1]) == 999) {
            $strResult = $prefix . "000" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "0000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 4) {
        if (intval($pieces[1]) == 9999) {
            $strResult = $prefix . "00" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "000" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 5) {
        if (intval($pieces[1]) == 99999) {
            $strResult = $prefix . "0" . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "00" . (intval($pieces[1] + 1));
        }
    } else if (strlen(intval($pieces[1])) == 6) {
        if (intval($pieces[1]) == 999999) {
            $strResult = $prefix . (intval($pieces[1] + 1));
        } else {
            $strResult = $prefix . "0" . (intval($pieces[1] + 1));
        }
    } else {
        $strResult = $prefix . (intval($pieces[1] + 1));
    }
}


$sqlInsertIntoMember = "INSERT INTO QRC_INSPECTION (INS_ID,INS_PROJECT_CODE,INS_DOCUMENT_NO,INS_INSPECTION_NO,INS_DATE,INS_ORDER_TYPE,INS_REMARK,INS_IMAGE_PATH,INS_CREATED_DATE_TIME)"
        . " VALUES ('$strResult','$project_code','$documentNo','$inspectionNo','$insDate','$insOrderType','$insRemark','$insImagePath',NOW())";
$resultSet = mysql_query($sqlInsertIntoMember);

$updateINSImg = "UPDATE QRC_INSPECTION_IMAGE"
        . " SET TEMP_INS_ID = '$strResult'"
        . " WHERE TEMP_INS_ID IS NULL;";
mysql_query($updateINSImg);

if ($resultSet) {
    echo 1;
} else {
    echo 0;
}