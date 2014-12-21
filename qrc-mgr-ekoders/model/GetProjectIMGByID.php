<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$po_id = $_GET['project_code'];
$strBuilding = "";
$sqlSelectMemberAll = "select * from QRC_PROJECT_IMAGE where TEMP_PROJECT_ID like '$po_id'";
$sqlGetAllData = mysql_query($sqlSelectMemberAll);
while ($row = mysql_fetch_array($sqlGetAllData)) {
//    $strBuilding .= '<li class = "list-group-item"><img src="../images/uploads/' . $row['IMAGE_PATH'] . '" width="100px"/> <a href="#" onclick=delImage("' . $row['IMAGE_ID'] . '","' . $row['TEMP_PO_ID'] . '","' . $row['IMAGE_PATH'] . '")>ลบ (Delete)</a></li>';
    $strCheckType = substr($row['IMAGE_PATH'], -3);
    if ($strCheckType == "pdf") {
        $strBuilding .= '<li class = "list-group-item">'
                . '<img src="../images/pdf_icon.png" width="50px"/> <a href="#" onclick=delImage("' . $row['IMAGE_ID'] . '","' . $row['TEMP_PROJECT_ID'] . '","' . $row['IMAGE_PATH'] . '")>ลบ (Delete)</a>'
                . '</li>';
    } else if ($strCheckType == "doc" || $strCheckType == "docx") {
        $strBuilding .= '<li class = "list-group-item">'
                . '<img src="../images/doc_icon.png" width="50px"/> <a href="#" onclick=delImage("' . $row['IMAGE_ID'] . '","' . $row['TEMP_PROJECT_ID'] . '","' . $row['IMAGE_PATH'] . '")>ลบ (Delete)</a>'
                . '</li>';
    } else if ($strCheckType == "xls" || $strCheckType == "lsx") {
        $strBuilding .= '<li class = "list-group-item">'
                . '<img src="../images/xl_icons.png" width="50px"/> <a href="#" onclick=delImage("' . $row['IMAGE_ID'] . '","' . $row['TEMP_PROJECT_ID'] . '","' . $row['IMAGE_PATH'] . '")>ลบ (Delete)</a>'
                . '</li>';
    } else if ($strCheckType == "jpg" || $strCheckType == "JPG" || $strCheckType == "png" || $strCheckType == "gif") {
        $strBuilding .= '<li class = "list-group-item"><img src="../images/uploads/' . $row['IMAGE_PATH'] . '" width="100px"/><a href="#" onclick=delImage("' . $row['IMAGE_ID'] . '","' . $row['TEMP_PROJECT_ID'] . '","' . $row['IMAGE_PATH'] . '")>ลบ (Delete)</a></li>';
    } else {

        $strBuilding .= '<li class = "list-group-item">'
                . '<img src="../images/file_icon.png" width="50px"/> <a href="#" onclick=delImage("' . $row['IMAGE_ID'] . '","' . $row['TEMP_PROJECT_ID'] . '","' . $row['IMAGE_PATH'] . '")>ลบ (Delete)</a>'
                . '</li>';
    }
}
if ($strBuilding == "") {
    $strBuilding = '<li class = "list-group-item">No image found</li>';
}
echo '<div class="col-sm-6"><ul class="list-group"><li href="#" class="list-group-item active">Image Delete</li>' . $strBuilding . '</ul></div> ';
