<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BillingDao
 *
 * @author krisada.thiangtham
 */
interface BillingDao {

    public function prepareToTblTmp($setProjectCode, $start_date, $end_date, $wo_status, $customer_id, $order_type_id);

    public function deleteInvoiceDetailTable();

    public function insertSubProject($start_date, $end_date, $projects, $wo_status, $customer_id, $order_type_id, $i);

    public function getPreBillingForCheckByCondition($start_date, $end_date, $multi_sel_project_name, $wo_status, $customer_id, $order_type_id);

    public function deleteSubProjectLevelOne($tempDetailID);

    public function deleteFirstLevel($tempDetailID);

    public function getCustomerDetail($id);

    public function getAllInvoiceDetailTemp();
}
