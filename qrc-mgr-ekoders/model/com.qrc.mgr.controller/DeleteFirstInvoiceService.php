<?php

require '../../model-db-connection/config.php';
include '../com.qrc.mgr.dao/BillingDaoImpl.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$tempDetailId = $_GET['tempDetailId'];
$initialBillingDaoImpl = new BillingDaoImpl();
echo $initialBillingDaoImpl->deleteFirstLevel($tempDetailId);
