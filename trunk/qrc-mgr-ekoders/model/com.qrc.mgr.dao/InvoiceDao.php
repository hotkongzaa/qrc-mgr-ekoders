<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceDao
 *
 * @author krisada.thiangtham
 */
interface InvoiceDao {

    //put your code here
    public function insertToInvoiceHeader($invoiceHeader);

    public function insertToInvoiceDetail($invoiceDetail);

    public function findInvoiceHeaderById($invoiceHeaderID);

    public function findInvoiceDetailById($invoiceHeaderId);

    public function getAllInvoiceHeader();

    public function getAllInvoiceDetail($inv_code);

    public function copyTemp();

    public function deleteAllData($tableName);

    public function updateIndexINVDetail($invCode);

    public function countNoRowTemp();

    public function updateProjectOrderTbl($invStatus, $inv_code, $woid);
}
