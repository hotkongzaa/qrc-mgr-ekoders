<?php

require '../model-db-connection/config.php';
$inv_id = $_GET['inv_id'];

$sqlDeleteProjectById = "DELETE FROM QRC_INVOICE_DETAIL WHERE ref_invoice_id='$inv_id';";
mysql_query($sqlDeleteProjectById);

$sqlDeletePGSDetail = "DELETE FROM QRC_PGS_DETAIL WHERE ref_invoice_id='$inv_id';";
mysql_query($sqlDeletePGSDetail);

$sqlDeleteOutOfTeam = "DELETE FROM QRC_INVOICE WHERE inv_id='$inv_id';";
$hh = mysql_query($sqlDeleteOutOfTeam);
if ($hh) {
    echo '1';
} else {
    echo '2';
}

