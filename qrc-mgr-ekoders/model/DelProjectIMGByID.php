<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$imageID = $_GET['imageID'];
$img_name = $_GET['img_name'];
$sqlSelectMemberAll = "DELETE FROM QRC_PROJECT_IMAGE WHERE IMAGE_ID like '$imageID'";
$sqlGetAllData = mysql_query($sqlSelectMemberAll);
unlink("../images/uploads/" . $img_name);
if ($sqlGetAllData) {
    echo 200;
} else {
    echo 503;
}