<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../model-db-connection/config.php';
$sqlSelectImageWhereNull = "SELECT COUNT(*) as total FROM QRC_PROJECT_IMAGE WHERE TEMP_PROJECT_ID IS NULL;";
$sqlResult = mysql_query($sqlSelectImageWhereNull);
$data = mysql_fetch_assoc($sqlResult);
if ($data['total'] == 0) {
    echo 'NO_DATA';
} else {
    echo 'FOUND_DATA';
}
