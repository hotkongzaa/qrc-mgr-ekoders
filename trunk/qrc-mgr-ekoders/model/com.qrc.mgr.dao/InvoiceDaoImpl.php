<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceDaoImpl
 *
 * @author krisada.thiangtham
 */
include '../com.qrc.mgr.utils/Utils.php';
include '../com.qrc.mgr.model/InvoiceDetailVO.php';
include '../com.qrc.mgr.model/InvoiceHeaderVO.php';
include '../com.qrc.mgr.utils/ArrayList.php';
include '../com.qrc.mgr.dao/InvoiceDao.php';

class InvoiceDaoImpl implements InvoiceDao {

    public function findInvoiceDetailById($invoiceHeaderId) {
        $sqlGetInvoiceDetail = "SELECT * FROM QRC_INVOICE_DETAIL WHERE detail_id like '$invoiceHeaderId'";
        $query = mysql_query($sqlGetInvoiceDetail);
        $row = mysql_fetch_assoc($query);
        $invoiceDetail = new InvoiceDetailVO();
        $invoiceDetail->setDetailId($row['detail_id']);
        $invoiceDetail->setDetailDescription($row['detail_description']);
        $invoiceDetail->setDetailQuantity($row['detail_quantity']);
        $invoiceDetail->setDetailUnit($row['detail_unit']);
        $invoiceDetail->setDetailPrice_per_unit($row['detail_price_per_unit']);
        $invoiceDetail->setDetailAmount_baht($row['detail_amount_baht']);
        $invoiceDetail->setDetailType($row['detail_type']);
        $invoiceDetail->setRefInvoiceId($row['ref_invoice_id']);
        $invoiceDetail->setRefPoProject($row['ref_po_project']);
        $invoiceDetail->setCreateDateTime($row['create_date_time']);
        $invoiceDetail->setRef_project_order_id($row['ref_project_order_id']);

        return $invoiceDetail;
    }

    public function findInvoiceHeaderById($invoiceHeaderID) {
        
    }

    public function getAllInvoiceDetail($inv_code) {
        $sqlGetInvoiceDetail = "SELECT * FROM QRC_INVOICE_DETAIL WHERE ref_invoice_id like '$inv_code' AND detail_type = 'PO'";
        $query = mysql_query($sqlGetInvoiceDetail);
        $detailList = new ArrayList();
        while ($row = mysql_fetch_array($query)) {
            $invoiceDetail = new InvoiceDetailVO();
            $invoiceDetail->setDetailId($row['detail_id']);
            $invoiceDetail->setDetailDescription($row['detail_description']);
            $invoiceDetail->setDetailQuantity($row['detail_quantity']);
            $invoiceDetail->setDetailUnit($row['detail_unit']);
            $invoiceDetail->setDetailPrice_per_unit($row['detail_price_per_unit']);
            $invoiceDetail->setDetailAmount_baht($row['detail_amount_baht']);
            $invoiceDetail->setDetailType($row['detail_type']);
            $invoiceDetail->setRefInvoiceId($row['ref_invoice_id']);
            $invoiceDetail->setRefPoProject($row['ref_po_project']);
            $invoiceDetail->setCreateDateTime($row['create_date_time']);
            $invoiceDetail->setRef_project_order_id($row['ref_project_order_id']);
            $detailList->Add($invoiceDetail);
        }
        return $detailList;
    }

    public function getAllInvoiceHeader() {
        
    }

    public function insertToInvoiceDetail($invoiceDetail) {
        
    }

    public function insertToInvoiceHeader($invoiceHeader) {
        $sqlInsertInToInvoiceHeader = "INSERT INTO QRC_INVOICE (inv_id,customer_id,project_id,wo_status_id,order_type,create_type,invoice_status,create_receipt,create_progressive,create_date_time) "
                . "VALUES "
                . "('" . $invoiceHeader->getInvID() . "','" . $invoiceHeader->getCustomer_id() . "','" . $invoiceHeader->getProject_id() . "','" . $invoiceHeader->getWo_status_id() . "','" . $invoiceHeader->getOrder_type() . "','" . $invoiceHeader->getCreate_type() . "','" . $invoiceHeader->getInvoice_status() . "','" . $invoiceHeader->getCreate_receipt() . "','" . $invoiceHeader->getCreate_progressive() . "',NOW());";

        $query = mysql_query($sqlInsertInToInvoiceHeader);
        if ($query) {
            return 200;
        } else {
            return "503: Internal Error (Cannot insert to INVOICE_HEADER)";
        }
    }

    public function copyTemp() {

        $sqlSelectDetailTmp = "SELECT * from QRC_INVOICE_DETAIL_TMP WHERE DETAIL_TYPE LIKE 'PO'";
        $resultset = mysql_query($sqlSelectDetailTmp);
        while ($ros = mysql_fetch_array($resultset)) {
            $sqlInsertToTbl = "INSERT INTO QRC_PGS_DETAIL"
                    . " (PGS_ID,PGS_description,PGS_quantity,PGS_unit,PGS_price_per_unit,PGS_amount_baht,PGS_type,ref_invoice_id,ref_po_project,ref_project_order_id,ref_invoice_main_id,create_date_time)"
                    . " VALUES"
                    . " ('" . $this->getPGSID() . "','" . $ros['detail_description'] . "','" . $ros['detail_quantity'] . "','" . $ros['detail_unit'] . "','" . $ros['detail_price_per_unit'] . "','" . $ros['detail_amount_baht'] . "','" . $ros['detail_type'] . "',null,'" . $ros['ref_po_project'] . "','" . $ros['ref_project_order_id'] . "','" . $ros['ref_invoice_main_id'] . "',NOW());";
            sleep(1);
            mysql_query($sqlInsertToTbl);
        }

        $sqlCopyFromTemp = "INSERT INTO QRC_INVOICE_DETAIL SELECT * FROM QRC_INVOICE_DETAIL_TMP;";
        $query = mysql_query($sqlCopyFromTemp);
        if ($query) {
            return 200;
        } else {
            return "503: Internal ERROR (Cannot Copy from QRC_INVOICE_DETAIL_TMP)";
        }
    }

    public function deleteAllData($tableName) {
        $sqlDeleteAllData = "DELETE FROM " . $tableName;
        $query = mysql_query($sqlDeleteAllData);
        if ($query) {
            return 200;
        } else {
            return "503: Internal ERROR (Cannot Delete from table " . $tableName . ")";
        }
    }

    public function updateIndexINVDetail($invCode) {
        $sqlUpdatePGSDetail = "UPDATE QRC_PGS_DETAIL SET ref_invoice_id='$invCode' WHERE ref_invoice_id IS NULL;";
        mysql_query($sqlUpdatePGSDetail);
        $sqlUpdateIndex = "UPDATE QRC_INVOICE_DETAIL SET ref_invoice_id='$invCode' WHERE ref_invoice_id IS NULL;";
        $query = mysql_query($sqlUpdateIndex);
        if ($query) {
            return 200;
        } else {
            return "503: Internal ERROR (Cannot Update status index)";
        }
    }

    public function countNoRowTemp() {
        $sqlCoutRow = "SELECT COUNT(*) AS rows FROM QRC_INVOICE_DETAIL_TMP;";
        $query = mysql_query($sqlCoutRow);
        $result = mysql_fetch_assoc($query);
        if ($result['rows'] > 23) {
            return "ไม่สามารถสร้างใบเสร็จได้ จำนวนบรรทัดเกินที่กำหนด (24)";
        } else {
            return 200;
        }
    }

    public function updateProjectOrderTbl($invStatus, $inv_code, $woid) {
        $sqlUpdate = "UPDATE QRC_PROJECT_ORDER SET INV_REP_PGS_ID = '$inv_code', INV_REP_PGS_STATUS_ID='$invStatus' WHERE project_order_id like '$woid';";
        $query = mysql_query($sqlUpdate);
        if ($query) {
            return 200;
        } else {
            return "503: Internal ERROR (Cannot Update WO when index is : " . $woid . ")";
        }
    }

    public function getPGSID() {
        $strResult = "";
        $ryearThaiRep = date('Y') + 543;
        $sqlSelectMaxValueRep = "SELECT count(*) as total FROM QRC_PGS_DETAIL where PGS_ID like 'QRC" . substr($ryearThaiRep, -2) . "-PGS%'";
        $resultSetRep = mysql_query($sqlSelectMaxValueRep);
        $rowRep = mysql_fetch_assoc($resultSetRep);
        if ($rowRep['total'] == 0) {
            $strResult = 'QRC' . substr($ryearThaiRep, -2) . '-PGS0000001';
        } else {
            $sqlSelectCodeValue = "SELECT PGS_ID as code FROM QRC_PGS_DETAIL where PGS_ID like 'QRC" . substr($ryearThaiRep, -2) . "-PGS%' ORDER BY create_date_time DESC";
            $resultSets = mysql_query($sqlSelectCodeValue);
            $row = mysql_fetch_assoc($resultSets);
            $prefix = 'QRC' . substr($ryearThaiRep, -2) . '-PGS';
            $pieces = explode($prefix, $row['code']);
            if (strlen(intval($pieces[1])) == 1) {
                if (intval($pieces[1]) == 9) {
                    $strResult = $prefix . "00000" . (intval($pieces[1] + 1));
                } else {
                    $strResult = $prefix . "000000" . (intval($pieces[1] + 1));
                }
            } else if (strlen(intval($pieces[1])) == 2) {
                if (intval($pieces[1]) == 99) {
                    $strResult = $prefix . "0000" . (intval($pieces[1] + 1));
                } else {
                    $strResult = $prefix . "00000" . (intval($pieces[1] + 1));
                }
            } else if (strlen(intval($pieces[1])) == 3) {
                if (intval($pieces[1]) == 999) {
                    $strResult = $prefix . "000" . (intval($pieces[1] + 1));
                } else {
                    $strResult = $prefix . "0000" . (intval($pieces[1] + 1));
                }
            } else if (strlen(intval($pieces[1])) == 4) {
                if (intval($pieces[1]) == 9999) {
                    $strResult = $prefix . "00" . (intval($pieces[1] + 1));
                } else {
                    $strResult = $prefix . "000" . (intval($pieces[1] + 1));
                }
            } else if (strlen(intval($pieces[1])) == 5) {
                if (intval($pieces[1]) == 99999) {
                    $strResult = $prefix . "0" . (intval($pieces[1] + 1));
                } else {
                    $strResult = $prefix . "00" . (intval($pieces[1] + 1));
                }
            } else if (strlen(intval($pieces[1])) == 6) {
                if (intval($pieces[1]) == 999999) {
                    $strResult = $prefix . (intval($pieces[1] + 1));
                } else {
                    $strResult = $prefix . "0" . (intval($pieces[1] + 1));
                }
            } else {
                $strResult = $prefix . (intval($pieces[1] + 1));
            }
        }
        return $strResult;
    }

}
