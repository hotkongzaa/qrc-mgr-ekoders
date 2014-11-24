<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../model-db-connection/config.php';
include '../com.qrc.mgr.service/InvoiceServiceImpl.php';
include '../com.qrc.mgr.dao/InvoiceDaoImpl.php';

$strResult = "";
$ryearThaiRep = date('Y') + 543;
$sqlSelectMaxValueRep = "SELECT count(*) as total FROM QRC_INVOICE where inv_id like 'QRC" . substr($ryearThai, -2) . "-REP%'";
$resultSetRep = mysql_query($sqlSelectMaxValueRep);
$rowRep = mysql_fetch_assoc($resultSetRep);
if ($rowRep['total'] == 0) {
    $strResult = "QRC" . substr($ryearThaiRep, -2) . "-REP0000001";
} else {
    $sqlSelectCodeValue = "SELECT inv_id as code FROM QRC_INVOICE where inv_id like 'QRC" . substr($ryearThai, -2) . "-REP%' ORDER BY create_date_time DESC";
    $resultSets = mysql_query($sqlSelectCodeValue);
    $row = mysql_fetch_assoc($resultSets);
    $prefix = 'QRC' . substr($ryearThai, -2) . '-REP';
    $pieces = explode($prefix, $row[code]);
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
$pgsID = md5(date('Y-m-d H:i:s'));
$invoiceHeaderObj = new InvoiceHeaderVO();
$invoiceHeaderObj->setInvID($_GET['inv_code']);
$invoiceHeaderObj->setCustomer_id($_GET['customer_id']);
$invoiceHeaderObj->setInvoice_status($_GET['inv_status']);
$invoiceHeaderObj->setOrder_type($_GET['order_type_id']);
$invoiceHeaderObj->setProject_id($_GET['multi_sel_project_name']);
$invoiceHeaderObj->setWo_status_id($_GET['wo_status']);
$invoiceHeaderObj->setCreate_receipt($strResult);
$invoiceHeaderObj->setCreate_progressive($pgsID);

$daoImpl = new InvoiceDaoImpl();
$invServiceImpl = new InvoiceServiceImpl($daoImpl);
$result = $invServiceImpl->insertIntoInvoiceHeader($invoiceHeaderObj);
if ($result == 200) {
    //Copy Data from temp
    $copy = $invServiceImpl->copyTemp();
    if ($copy == 200) {
        //Update ref inv_code from copy data
        $update = $invServiceImpl->updateIndexINVDetail($_GET['inv_code']);
        if ($update == 200) {
            $listDetail = $invServiceImpl->getAllInvoiceDetail($_GET['inv_code']);
            $status = 0;
            for ($i = 0; $i < $listDetail->Size(); $i++) {
                $obj = $listDetail->getObj($i);
                $invServiceImpl->updateProjectOrderTbl($_GET['inv_status'], $_GET['inv_code'], $obj->getRef_project_order_id());
                $status++;
            }
            if ($status == $listDetail->Size()) {
                echo 200;
            } else {
                echo '505 Cannot update';
            }
        } else {
            echo $update;
        }
    } else {
        echo $copy;
    }
} else {
    echo $result;
}



    