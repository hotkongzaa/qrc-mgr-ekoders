<?php

include '../com.qrc.mgr.utils/Utils.php';
include '../com.qrc.mgr.model/BillingVO.php';
include '../com.qrc.mgr.model/CustomerDetailVO.php';
include '../com.qrc.mgr.utils/ArrayList.php';
include '../com.qrc.mgr.dao/BillingDao.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BillingDaoImpl
 *
 * @author krisada.thiangtham
 */
class BillingDaoImpl implements BillingDao {

    private $status = "";

    public function prepareToTblTmp($setProjectCode, $start_date, $end_date, $wo_status, $customer_id, $order_type_id) {
        $sqlSelectCleanTblTemp = "select count(*) as isClean from QRC_INVOICE_DETAIL_TMP;";
        $sqlClean = mysql_query($sqlSelectCleanTblTemp);
        $resultClean = mysql_fetch_assoc($sqlClean);
        if ($resultClean['isClean'] > 0) {
            $this->deleteInvoiceDetailTable();
        }
        if ($setProjectCode != "null" || $setProjectCode != "") {
            $projects = explode(",", $setProjectCode);
            
            for ($i = 0; $i < count($projects); $i++) {
//                $checkEmptySub = $this->getPreBillingForCheckByCondition($start_date, $end_date, $projects[$i], $wo_status, $customer_id, $order_type_id);
//                if ($checkEmptySub->Size() == 0) {
////                    $this->status = "403";
//                } else {
                    $selAndInINVDetail = "select project_name as project_name from QRC_PROJECT WHERE PROJECT_CODE LIKE '" . $projects[$i] . "'";
                    $getSet = mysql_query($selAndInINVDetail);
                    $resultGetSet = mysql_fetch_assoc($getSet);
                    $sqlInsertDetailWithProject = "INSERT INTO QRC_INVOICE_DETAIL_TMP (detail_id,detail_description,detail_quantity,detail_unit,detail_price_per_unit,detail_amount_baht,detail_type,ref_invoice_id,create_date_time) values ("
                            . "'" . md5(date('m/d/Y h:i:s a', time()) . $i) . "','" . $resultGetSet['project_name'] . "',NULL,NULL,NULL,NULL,'PR',NULL,NOW());";
                    mysql_query($sqlInsertDetailWithProject);
                    $this->insertSubProject($start_date, $end_date, $projects[$i], $wo_status, $customer_id, $order_type_id, $i);

                    $this->status = "1";
//                }
            }
            return $this->status;
        } else {
            return "503: Not found project code";
        }
    }

    public function deleteInvoiceDetailTable() {
        $sqlDelete = "Delete FROM QRC_INVOICE_DETAIL_TMP;";
        $result = mysql_query($sqlDelete);
        if ($result) {
            return "200";
        } else {
            return "503: Cannot delete from QRC_INVOICE_DETAIL_TMP";
        }
    }

    public function insertSubProject($start_date, $end_date, $projects, $wo_status, $customer_id, $order_type_id, $i) {
        $selectPOWOs = $this->getPreBillingForCheckByCondition($start_date, $end_date, $projects, $wo_status, $customer_id, $order_type_id);
        for ($j = 0; $j < $selectPOWOs->Size(); $j++) {
            $tempPO = $selectPOWOs->GetObj($j);
            $insToDetailWithPO = "INSERT INTO QRC_INVOICE_DETAIL_TMP "
                    . "(detail_id,detail_description,detail_quantity,detail_unit,detail_price_per_unit,detail_amount_baht,detail_type,ref_invoice_id,ref_po_project,ref_project_order_id,create_date_time) values ("
                    . "'" . $tempPO->getDetail_id() . "','" . $tempPO->getDetail_description() . "','" . $tempPO->getDetail_quantity() . "','" . $tempPO->getDetail_unit() . "','" . $tempPO->getDetail_price_per_unit() . "','" . $tempPO->getDetail_amount_baht() . "','" . $tempPO->getDetail_type() . "',NULL,'" . md5(date('m/d/Y h:i:s a', time()) . $i) . "','" . $tempPO->getRef_project_order_id() . "', NOW());";
            mysql_query($insToDetailWithPO);
        }
    }

    public function getPreBillingForCheckByCondition($start_date, $end_date, $multi_sel_project_name, $wo_status, $customer_id, $order_type_id) {
        $utils = new Utils();
        $checkStartDate = !empty($start_date) ? " AND qrpo.PO_CREATED_DATE_TIME BETWEEN '$start_date' AND '$end_date'" : " ";
        $checkNullOfMultiProject = $multi_sel_project_name == "null" ? " " : " AND qp.project_code in (" . $utils->rebuildMultiProjectSelect($multi_sel_project_name) . ")";
        $checkNullOfProjectStatus = $wo_status == "null" ? " " : " AND qpo.project_status IN (SELECT A_S_NAME FROM qrc_assign_status WHERE A_S_ID in (" . $utils->rebuildWOStatusSelect($wo_status) . "))";
        $checkUnSelectCustomerId = $customer_id == "" ? " " : " AND qcn.customer_id = '$customer_id'";
        $checkUnSelectOrderType = !empty($order_type_id) ? " AND qrpo.po_order_type_id = '$order_type_id';" : " ";
        $sqlSelectForInsert = "SELECT qpo.project_order_name as project_order_name,"
                . "qrpo.po_amount as po_amount,"
                . "qrpo.po_unit_price as po_unit_price,"
                . "qpo.project_order_id as project_order_id,"
                . "qrpo.po_quantity as po_quantity"
                . " FROM qrc_project_order qpo"
                . " LEFT JOIN qrc_project qp ON qpo.project_code = qp.project_code"
                . " LEFT JOIN qrc_customer_name qcn ON qp.customer_id = qcn.customer_id"
                . " LEFT JOIN qrc_po qrpo ON qpo.image_name = qrpo.PO_ID"
                . " WHERE 1=1"
                . $checkUnSelectCustomerId
                . $checkNullOfMultiProject
                . $checkStartDate
                . $checkNullOfProjectStatus
                . $checkUnSelectOrderType;
//        echo $sqlSelectForInsert;
        $resultSet = mysql_query($sqlSelectForInsert);
        $listBillingDto = new ArrayList();
        while ($row = mysql_fetch_array($resultSet)) {
            $billingObj = new BillingVO();

            //Setting parameter to object
            $billingObj->setDetail_description($row['project_order_name']);
            $billingObj->setDetail_id(md5(date('m/d/Y h:i:s a', time()) . uniqid()));
            $billingObj->setDetail_amount_baht($row['po_amount']);
            $billingObj->setDetail_price_per_unit($row['po_unit_price']);
            $billingObj->setDetail_quantity($row['po_quantity']);
            $billingObj->setDetail_unit("หลัง");
            $billingObj->setDetail_type("PO");
            $billingObj->setRef_project_order_id($row['project_order_id']);

            $listBillingDto->Add($billingObj);
        }
        return $listBillingDto;
    }

    public function deleteSubProjectLevelOne($tempDetailID) {
        $sqlDelteTemp = "Delete from QRC_INVOICE_DETAIL_TMP where detail_id like '" . $tempDetailID . "';";
        $results = mysql_query($sqlDelteTemp);
        if ($results) {
            return '200';
        } else {
            return 'Cannot delete temp';
        }
    }

    public function deleteFirstLevel($tempDetailID) {
        $sqlDelteTemp = "Delete from QRC_INVOICE_DETAIL_TMP where detail_id like '" . $tempDetailID . "';";
        $sqlDelteTemp2 = "Delete from QRC_INVOICE_DETAIL_TMP where ref_po_project like '" . $tempDetailID . "';";
        $results = mysql_query($sqlDelteTemp);
        mysql_query($sqlDelteTemp2);
        if ($results) {
            return '200';
        } else {
            return 'Cannot delete temp';
        }
    }

    public function getCustomerDetail($id) {
        $sqlGetCustDetail = "SELECT * FROM QRC_CUSTOMER_NAME WHERE customer_id like '$id';";
        $detailResultSet = mysql_query($sqlGetCustDetail);

        $listCustomerDetailDto = new ArrayList();
        while ($custDetail = mysql_fetch_assoc($detailResultSet)) {
            $customerDetailVO = new CustomerDetailVO();
            $customerDetailVO->setCustomerId($custDetail['customer_id']);
            $customerDetailVO->setCustomerName($custDetail['customer_name']);
            $customerDetailVO->setCustoemrAddress($custDetail['customer_address']);
            $customerDetailVO->setCustomerTel($custDetail['customer_tel']);
            $customerDetailVO->setCustomerFax($custDetail['customer_fax']);
            $listCustomerDetailDto->Add($customerDetailVO);
        }
        return $listCustomerDetailDto;
    }

    public function getAllInvoiceDetailTemp() {
        $sqlSelectAllToCount = "SELECT * from qrc_invoice_detail_tmp;";
        $resultSet = mysql_query($sqlSelectAllToCount);
        $listBillingDto = new ArrayList();
        while ($row = mysql_fetch_array($resultSet)) {
            $billingObj = new BillingVO();
            //Setting parameter to object
            $billingObj->setDetail_id($row['detail_id']);
            $billingObj->setDetail_description($row['detail_description']);
            $billingObj->setDetail_quantity($row['detail_quantity']);
            $billingObj->setDetail_unit($row['detail_unit']);
            $billingObj->setDetail_price_per_unit($row['detail_price_per_unit']);
            $billingObj->setDetail_amount_baht($row['detail_amount_baht']);
            $billingObj->setDetail_type($row['detail_type']);
            $billingObj->setRef_invoice_id($row['ref_invoice_id']);
            $billingObj->setRef_po_project($row['ref_po_project']);
            $billingObj->setCreate_date_time($row['create_date_time']);
            $listBillingDto->Add($billingObj);
        }
        return $listBillingDto;
    }

}
