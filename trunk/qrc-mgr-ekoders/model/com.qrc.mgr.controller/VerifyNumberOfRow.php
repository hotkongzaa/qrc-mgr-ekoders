<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';
include '../com.qrc.mgr.service/InvoiceServiceImpl.php';
include '../com.qrc.mgr.dao/InvoiceDaoImpl.php';

$daoImpl = new InvoiceDaoImpl();
$invServiceImpl = new InvoiceServiceImpl($daoImpl);

echo $invServiceImpl->countNoRowTemp();
