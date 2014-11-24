<?php

require '../../model-db-connection/config.php';
$inv_code = $_GET['inv_code'];

$sqlCheckExisting = "SELECT COUNT(*) as numbers FROM QRC_INVOICE WHERE INV_ID LIKE '$inv_code'";
$query = mysql_query($sqlCheckExisting);
$result = mysql_fetch_assoc($query);
if($result['numbers']>0){
    return 0;
}else{
    return 1;
}