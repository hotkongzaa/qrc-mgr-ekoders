<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceHeaderVO
 *
 * @author krisada.thiangtham
 */
class InvoiceHeaderVO {

    //put your code here
    private $invID;
    private $customer_id;
    private $project_id;
    private $wo_status_id;
    private $order_type;
    private $create_type;
    private $invoice_status;
    private $create_receipt;
    private $create_progressive;
    private $create_date_time;

    public function __construct() {
        
    }

    public function getInvID() {
        return $this->invID;
    }

    public function getCustomer_id() {
        return $this->customer_id;
    }

    public function getProject_id() {
        return $this->project_id;
    }

    public function getWo_status_id() {
        return $this->wo_status_id;
    }

    public function getOrder_type() {
        return $this->order_type;
    }

    public function getCreate_type() {
        return $this->create_type;
    }

    public function getInvoice_status() {
        return $this->invoice_status;
    }

    public function getCreate_receipt() {
        return $this->create_receipt;
    }

    public function getCreate_progressive() {
        return $this->create_progressive;
    }

    public function getCreate_date_time() {
        return $this->create_date_time;
    }

    public function setInvID($invID) {
        $this->invID = $invID;
    }

    public function setCustomer_id($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function setProject_id($project_id) {
        $this->project_id = $project_id;
    }

    public function setWo_status_id($wo_status_id) {
        $this->wo_status_id = $wo_status_id;
    }

    public function setOrder_type($order_type) {
        $this->order_type = $order_type;
    }

    public function setCreate_type($create_type) {
        $this->create_type = $create_type;
    }

    public function setInvoice_status($invoice_status) {
        $this->invoice_status = $invoice_status;
    }

    public function setCreate_receipt($create_receipt) {
        $this->create_receipt = $create_receipt;
    }

    public function setCreate_progressive($create_progressive) {
        $this->create_progressive = $create_progressive;
    }

    public function setCreate_date_time($create_date_time) {
        $this->create_date_time = $create_date_time;
    }

}
