<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceServiceImple
 *
 * @author krisada.thiangtham
 */
class InvoiceServiceImpl {

    //put your code here
    private $dispatcher;

    public function __construct(InvoiceDao $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function action($action) {
        $this->dispatcher->dispatch($action);
    }

    public function insertIntoInvoiceHeader(InvoiceHeaderVO $invoiceHeader) {
        return $this->dispatcher->insertToInvoiceHeader($invoiceHeader);
    }

    public function copyTemp() {
        return $this->dispatcher->copyTemp();
    }

    public function deleteAllData($tableName) {
        return $this->dispatcher->deleteAllData($tableName);
    }

    public function updateIndexINVDetail($invCode) {
        return $this->dispatcher->updateIndexINVDetail($invCode);
    }

    public function countNoRowTemp() {
        return $this->dispatcher->countNoRowTemp();
    }

    public function getAllInvoiceDetail($inv_code) {
        return $this->dispatcher->getAllInvoiceDetail($inv_code);
    }

    public function updateProjectOrderTbl($invStatus, $inv_code, $woid) {
        return $this->dispatcher->updateProjectOrderTbl($invStatus, $inv_code, $woid);
    }

}
