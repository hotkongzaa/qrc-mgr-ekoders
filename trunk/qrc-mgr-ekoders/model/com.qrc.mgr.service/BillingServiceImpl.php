<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BillingServiceImpl
 *
 * @author krisada.thiangtham
 */
class BillingServiceImpl {

    //put your code here
    private $dispatcher;

    public function __construct(BillingDao $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function action($action) {
        $this->dispatcher->dispatch($action);
    }

    public function getResultBilling($setProjectCode, $start_date, $end_date, $wo_status, $customer_id, $order_type_id) {
        return $this->dispatcher->prepareToTblTmp($setProjectCode, $start_date, $end_date, $wo_status, $customer_id, $order_type_id);
    }

    public function deleteInvoiceDetailTableService() {
        return $this->dispatcher->deleteInvoiceDetailTable();
    }

    public function deleteSubProjectLevelOneService($tempDetailID) {
        return $this->dispatcher->deleteSubProjectLevelOne($tempDetailID);
    }

    public function deleteFirstLevelService($tempDetailID) {
        return $this->dispatcher->deleteFirstLevel($tempDetailID);
    }

    public function getCustomerDetail($id) {
        return $this->dispatcher->getCustomerDetail($id);
    }

    public function getAllInvoiceDetailTemp() {
        return $this->dispatcher->getAllInvoiceDetailTemp();
    }

}
