<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BillingVO
 *
 * @author krisada.thiangtham
 */
class BillingVO {

    //put your code here
    private $detail_id;
    private $detail_description;
    private $detail_quantity;
    private $detail_unit;
    private $detail_price_per_unit;
    private $detail_amount_baht;
    private $detail_type;
    private $ref_invoice_id;
    private $ref_po_project;
    private $create_date_time;
    private $ref_project_order_id;

    public function __construct() {
        
    }
    public function getRef_project_order_id() {
        return $this->ref_project_order_id;
    }

    public function setRef_project_order_id($ref_project_order_id) {
        $this->ref_project_order_id = $ref_project_order_id;
    }

        public function getDetail_id() {
        return $this->detail_id;
    }

    public function getDetail_description() {
        return $this->detail_description;
    }

    public function getDetail_quantity() {
        return $this->detail_quantity;
    }

    public function getDetail_unit() {
        return $this->detail_unit;
    }

    public function getDetail_price_per_unit() {
        return $this->detail_price_per_unit;
    }

    public function getDetail_amount_baht() {
        return $this->detail_amount_baht;
    }

    public function getDetail_type() {
        return $this->detail_type;
    }

    public function getRef_invoice_id() {
        return $this->ref_invoice_id;
    }

    public function getRef_po_project() {
        return $this->ref_po_project;
    }

    public function getCreate_date_time() {
        return $this->create_date_time;
    }

    public function setDetail_id($detail_id) {
        $this->detail_id = $detail_id;
    }

    public function setDetail_description($detail_description) {
        $this->detail_description = $detail_description;
    }

    public function setDetail_quantity($detail_quantity) {
        $this->detail_quantity = $detail_quantity;
    }

    public function setDetail_unit($detail_unit) {
        $this->detail_unit = $detail_unit;
    }

    public function setDetail_price_per_unit($detail_price_per_unit) {
        $this->detail_price_per_unit = $detail_price_per_unit;
    }

    public function setDetail_amount_baht($detail_amount_baht) {
        $this->detail_amount_baht = $detail_amount_baht;
    }

    public function setDetail_type($detail_type) {
        $this->detail_type = $detail_type;
    }

    public function setRef_invoice_id($ref_invoice_id) {
        $this->ref_invoice_id = $ref_invoice_id;
    }

    public function setRef_po_project($ref_po_project) {
        $this->ref_po_project = $ref_po_project;
    }

    public function setCreate_date_time($create_date_time) {
        $this->create_date_time = $create_date_time;
    }

}
