<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceDetailVO
 *
 * @author krisada.thiangtham
 */
class InvoiceDetailVO {

    //put your codehere
    private $detailId;
    private $detailDescription;
    private $detailQuantity;
    private $detailUnit;
    private $detailPrice_per_unit;
    private $detailAmount_baht;
    private $detailType;
    private $refInvoiceId;
    private $refPoProject;
    private $createDateTime;
    private $ref_project_order_id;

    public function getDetailId() {
        return $this->detailId;
    }

    public function getRef_project_order_id() {
        return $this->ref_project_order_id;
    }

    public function setRef_project_order_id($ref_project_order_id) {
        $this->ref_project_order_id = $ref_project_order_id;
    }

    public function getDetailDescription() {
        return $this->detailDescription;
    }

    public function getDetailQuantity() {
        return $this->detailQuantity;
    }

    public function getDetailUnit() {
        return $this->detailUnit;
    }

    public function getDetailPrice_per_unit() {
        return $this->detailPrice_per_unit;
    }

    public function getDetailAmount_baht() {
        return $this->detailAmount_baht;
    }

    public function getDetailType() {
        return $this->detailType;
    }

    public function getRefInvoiceId() {
        return $this->refInvoiceId;
    }

    public function getRefPoProject() {
        return $this->refPoProject;
    }

    public function getCreateDateTime() {
        return $this->createDateTime;
    }

    public function setDetailId($detailId) {
        $this->detailId = $detailId;
    }

    public function setDetailDescription($detailDescription) {
        $this->detailDescription = $detailDescription;
    }

    public function setDetailQuantity($detailQuantity) {
        $this->detailQuantity = $detailQuantity;
    }

    public function setDetailUnit($detailUnit) {
        $this->detailUnit = $detailUnit;
    }

    public function setDetailPrice_per_unit($detailPrice_per_unit) {
        $this->detailPrice_per_unit = $detailPrice_per_unit;
    }

    public function setDetailAmount_baht($detailAmount_baht) {
        $this->detailAmount_baht = $detailAmount_baht;
    }

    public function setDetailType($detailType) {
        $this->detailType = $detailType;
    }

    public function setRefInvoiceId($refInvoiceId) {
        $this->refInvoiceId = $refInvoiceId;
    }

    public function setRefPoProject($refPoProject) {
        $this->refPoProject = $refPoProject;
    }

    public function setCreateDateTime($createDateTime) {
        $this->createDateTime = $createDateTime;
    }

    public function __construct() {
        
    }

}
