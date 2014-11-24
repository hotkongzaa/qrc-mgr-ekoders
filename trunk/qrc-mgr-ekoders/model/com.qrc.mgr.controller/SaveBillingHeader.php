<?php

require '../../model-db-connection/config.php';
include '../com.qrc.mgr.service/BillingServiceImpl.php';
include '../com.qrc.mgr.dao/BillingDaoImpl.php';

$inv_code = $_GET['inv_code'];
$customer_id = $_GET['customer_id'];
$multi_sel_project_name = $_REQUEST['multi_sel_project_name'];
$wo_status = $_REQUEST['wo_status'];
$order_type_id = $_GET['order_type_id'];
$create_type = $_GET['create_type'];
$inv_status = $_GET['inv_status'];
$create_receive = $_GET['create_receive'];
$create_progressive = $_GET['create_progressive'];
$isCreate = $_GET['isCreate'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];


$daoImpl = new BillingDaoImpl();
$sqlGetPreBiling = new BillingServiceImpl($daoImpl);
$result = $sqlGetPreBiling->getResultBilling($multi_sel_project_name, $start_date, $end_date, $wo_status, $customer_id, $order_type_id);
echo $result;
