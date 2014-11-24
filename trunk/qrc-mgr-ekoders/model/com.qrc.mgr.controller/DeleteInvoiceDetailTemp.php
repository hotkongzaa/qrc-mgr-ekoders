<?php

require '../../model-db-connection/config.php';
include '../com.qrc.mgr.dao/BillingDaoImpl.php';

$deleteInvoiceTableTemp = new BillingDaoImpl();

$returnResult = $deleteInvoiceTableTemp->deleteInvoiceDetailTable();
if (strcmp($returnResult, "200") == 0) {
    echo '1';
} else {
    echo $returnResult;
}