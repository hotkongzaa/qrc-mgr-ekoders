<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$allTeamID = $_GET['teamCodeSet'];

$cateArray = "";
$strTeamSplit = explode(",", $allTeamID);
$isFirst = true;
for ($i = 0; $i < count($strTeamSplit); $i++) {
    $sqlGetCate = "select tName as tName
                    from qrc_team_builder
                    where tCode like '" . $strTeamSplit[$i] . "';";
    $result = mysql_query($sqlGetCate);
    $row_result = mysql_fetch_assoc($result);
    if($isFirst){
        $cateArray .= $row_result['tName'];
        $isFirst = false;
    }else{
        $cateArray .= ",".$row_result['tName'];
    }
    
}

echo $cateArray;
