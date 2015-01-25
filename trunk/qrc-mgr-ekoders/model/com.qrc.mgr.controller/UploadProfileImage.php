<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../model-db-connection/config.php';
$userID = $_GET['userID'];
$saveFileName = uniqid() . "_PROFILE_" . $_FILES['file']['name'];
$output_dir = "../../images/uploads/";
$_SESSION['IMAGE_URL'] = $saveFileName;

$sqlGetPreImageAndDel = "select img_url from QRC_USERS where id = $userID";
$set = mysql_query($sqlGetPreImageAndDel);
$row = mysql_fetch_assoc($set);
if (file_exists($output_dir . $row['img_url'])) {
    unlink($output_dir . $row['img_url']);
}

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
} else {
    $sqlUpdateImageProfile = "UPDATE QRC_USERS"
            . " SET img_url='$saveFileName'"
            . " WHERE id=$userID;";
    $msqlUpdate = mysql_query($sqlUpdateImageProfile);
    if ($msqlUpdate) {
        move_uploaded_file($_FILES['file']['tmp_name'], '../../images/uploads/' . $saveFileName);
        echo 200;
    } else {
        echo "Cannot update and upload file: " . $sqlUpdateImageProfile;
    }
}