<?php

require '../model-db-connection/config.php';
include '../model/com.qrc.mgr.model/BillingVO.php';
include '../model/com.qrc.mgr.utils/ArrayList.php';
$config = require '../model-db-connection/qrc_conf.properties.php';

$customerId = $_GET['customer_id'];
$inv_type_eng = $_GET['inv_type'];
$inv_code = $_GET['inv_code'];
if ($inv_type_eng == "Original") {
    $inv_type_thai = "ต้นฉบับ";
} else {
    $inv_type_thai = "สำเนา";
}

$sqlGetCustDetail = "SELECT * FROM QRC_CUSTOMER_NAME WHERE customer_id like '$customerId';";
$detailResultSet = mysql_query($sqlGetCustDetail);
$custDetail = mysql_fetch_assoc($detailResultSet);


$sqlSelectAllToCount = "SELECT * from QRC_INVOICE_DETAIL where ref_invoice_id like '$inv_code';";
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
$totalPage = 0;
$fistPages = $listBillingDto->Size() / 23;
if ($listBillingDto->Size() % 23 != 0) {
    $totalPage = intval($fistPages) + 1;
}


if ($listBillingDto->Size() <= 23) {
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=" . $inv_code . "_invoice_" . $inv_type_eng . ".doc");
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<meta charset = "UTF-8">';
    echo '<title></title>';
    echo '<style type = "text/css">';
    echo '#address_detail {';
    echo 'display: block;';
    echo '}';
    echo '.inner-tbl {';
    echo 'border-collapse: collapse;';
    echo '}';
    echo '.inner-tbl {';
    echo 'border: 1px solid black;';
    echo '}';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    echo '<div id = "showcase">';
    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo '<img src = "http://localhost/' . $config['root_path'] . '/images/qrc_logo.JPG">';
    echo '</td>';
    echo '<td>';
    echo '<font size = "2" style = "font-weight: bold;">บริษัท ควอลิตี้ รูฟ แอนด์ คอนสตรัคชั่น จำกัด <br/>';
    echo 'QUALITY ROOF & CONSTRUCTION CO., LTD';
    echo '</font><br/>';
    echo '<font id = "address_detail" size = "1">33/103 หมู่ 3 ตำบลคลองสาม อำเภอคลองหลวง<br/>';
    echo 'จังหวัดปทุมธานี 12120<br/>';
    echo '33/103 Moo 3, T. Klongsam, A. Klong Luang, Pathumthani 12120<br/>';
    echo 'E-Mail : qtruss.qrc@gmail.com TEL/Fax : 0-2504-0908';
    echo '</font>';
    echo '</td>';
    echo '<td>';
    echo '<div align = "center" style = "background-color: #d8e4bc; width: 150px; height: 50px; margin-left: 15px; margin-top: -25px;">';
    echo '<font size = "3" style = "font-weight: bold; vertical-align: middle;">' . $inv_type_thai . '<br/>' . $inv_type_eng . '</font>';
    echo '</div>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan = "3" align = "right">';
    echo '<font size = "1" style = "font-weight: bold;">เลขประจำตัวผู้เสียภาษีอากร 0-1355-55011-91-1</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan = "3" align = "center" style = "background-color: #d8e4bc;border:1px solid;">';
    echo '<font size = "1" style = "font-weight: bold;">ใบวางบิล/ใบแจ้งหนี้<br/>BILLING/INVOICE</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan = "3">';
    echo '<table width = "100%" border = "1" class="inner-tbl">';
    echo '<tr>';
    echo '<td width = "300px"><font size = "1">ลูกค้า (CUSTOMER NAME): ' . $custDetail['customer_name'] . '</font></td>';
    echo '<td><font size = "1">เลขที่ใบกำกับภาษี/NO : ' . $inv_code . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td rowspan = "2"><font size = "1">ที่อยู่ (ADDRESS): ' . $custDetail['customer_address'] . '</font></td>';
    echo '<td><font size = "1">วันที่/DATE : ' . date("d/m/Y") . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><font size = "1">วันครบกำหนด (DUE DATE) :</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><font size = "1">TEL: ' . $custDetail['customer_tel'] . ' FAX: ' . $custDetail['customer_fax'] . '</font></td>';
    echo '<td><font size = "1">อ้างอิง (REFER): </font></td>';
    echo '</tr>';
    echo '</table>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan = "3">';
    echo '<table width = "100%" border = "1" class="inner-tbl">';
    echo '<tr style = "background-color: #d8e4bc;">';
    echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">ลำดับที่<br/>ITEM</font></td>';
    echo '<td align = "center" ><font size = "1" style = "font-weight: bold;">รายการสินค้า/บริการ<br/>DESCRIPTION</font></td>';
    echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">จำนวน<br/>QUANTITY</font></td>';
    echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">หน่วย<br/>UNIT</font></td>';
    echo '<td align = "center" width = "69px"><font size = "1" style = "font-weight: bold;">ราคา/หน่วย<br/>PRICE/UNIT</font></td>';
    echo '<td align = "center" width = "90px"><font size = "1" style = "font-weight: bold;">จำนวนเงิน/บาท<br/>AMOUNT/BAHT</font></td>';
    echo '</tr>';
    $rowCount = 1;
    for ($no = 0; $no < $listBillingDto->Size(); $no++) {
        $data = $listBillingDto->GetObj($no);
        if ($data->getDetail_type() == "PR") {
            echo '<tr>';
            echo '<td align="center" width="50px"><font size="1" style="font-weight: bold;">' . $rowCount++ . '</font></td>';
            echo '<td align="left" ><font size="1" style="font-weight: bold;">' . $data->getDetail_description() . '</font></td>';
            echo '<td align="center" width="50px"><font size="1"></font></td>';
            echo '<td align="center" width="50px"><font size="1"></font></td>';
            echo '<td align="right" width="90px"><font size="1"></font></td>';
            echo '<td align="right" width="90px"><font size="1"></font></td>';
            echo '</tr>';
            for ($sub = 0; $sub < $listBillingDto->Size(); $sub++) {
                $dataSub = $listBillingDto->GetObj($sub);
                if ($dataSub->getDetail_Type() == "PO" && $dataSub->getRef_po_project() == $data->getDetail_id()) {
                    echo '<tr>';
                    echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
                    echo '<td align = "left" ><font size = "1">' . $dataSub->getDetail_description() . '</font></td>';
                    echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_quantity() . '</font></td>';
                    echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_unit() . '</font></td>';
                    echo '<td align = "right"><font size = "1">' . number_format($dataSub->getDetail_price_per_unit(), 2, '.', '') . '</font></td>';
                    echo '<td align = "right" width = "90px"><font size = "1">' . number_format($dataSub->getDetail_amount_baht(), 2, '.', '') . '</font></td>';
                    echo '</tr>';
                    $totalAmountResult +=$dataSub->getDetail_amount_baht();
                }
            }
        }
    }
    $vatCalculation = ($totalAmountResult * 7) / 100;
    $totalExpense = $totalAmountResult + $vatCalculation;
    for ($i = 0; $i < 23 - $listBillingDto->Size(); $i++) {
        echo '<tr>';
        echo '<td align = "center" width = "50px"><font size = "2" style = "font-weight: bold;"></font></td>';
        echo '<td align = "left" ><font size = "2" style = "font-weight: bold;"></font></td>';
        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
        echo '<td align = "right" width = "90px"><font size = "1"></font></td>';
        echo '</tr>';
    }
    echo '<!--Footer-->';
    echo '<tr>';
    echo '<td align = "center" width = "50px">&nbsp;';
    echo '</td>';
    echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">จำนวนเงินรวมทั้งสิ้น (Sub Total)</font></td>';
    echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . number_format($totalAmountResult, 2, '.', '') . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center" width = "50px">&nbsp;';
    echo '</td>';
    echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">ภาษีมูลค่าเพิ่ม 7% (VALUE ADD TAX)</font></td>';
    echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . number_format($vatCalculation, 2, '.', '') . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center" width = "50px">&nbsp;';
    echo '</td>';
    echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">รวมเงินสุทธิ (GRAND TOTAL)</font></td>';
    echo '<td align = "right" width = "90px" ><font size = "1" style = "font-weight: bold;">' . number_format($totalExpense, 2, '.', '') . '</font></td>';
    echo '</tr>';
    echo '</table>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan = "3">';
    echo '<table width = "100%" border = "1" class="inner-tbl">';
    echo '<tr>';
    echo '<td width = "50%" height = "100px" align="center">';
    echo '<table>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '......................................';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">(นางสาวชรินญาภัทร สาริโส)</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">วันที่/DATE 31/01/2556</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">ผู้วางบิล</font>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</td>';
    echo '<td width = "50%" align="center">';
    echo '<table>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '......................................';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">(..........................................)</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">วันที่/DATE 31/01/2556</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">ผู้รับวางบิล</font>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</td>';
    echo'</td>';
    echo '</tr>';
    echo '</table>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan = "3">';
    echo '<font size = "1" style = "font-weight: bold;">หมายเหตุ : กรณีชำระเงินด้วยเช็ค กรุณาสั่งจ่ายในนาม "บริษัทควอลิตี้ รูฟ แอนด์ คอนสตรัคชั่น จำกัด" หรือ';
    echo 'โอนเงินเข้าบัญชี ธนาคารไทยพาณิชย์ จำกัด สาขาถนนเลียบคลองสาม เลขที่บัญชี 293-212364-1</font>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
} else {
//    $noOfPage = 0;
//    $noPage = $listBillingDto->Size() / 23;
//    if ($listBillingDto->Size() % 23 != 0) {
//        $noOfPage = (int) $noPage + 1;
//    }
//    for ($loopPage = 0; $loopPage < $noOfPage; $loopPage++) {
//        echo '<!DOCTYPE html>';
//        echo '<html>';
//        echo '<head>';
//        echo '<meta charset = "UTF-8">';
//        echo '<title></title>';
//        echo '<style type = "text/css">';
//        echo '#address_detail {';
//        echo 'display: block;';
//        echo '}';
//        echo '.inner-tbl {';
//        echo 'border-collapse: collapse;';
//        echo '}';
//        echo '.inner-tbl {';
//        echo 'border: 1px solid black;';
//        echo '}';
//        echo '</style>';
//        echo '</head>';
//        echo '<body>';
//        echo '<div id = "showcase">';
//        echo '<table>';
//        echo '<tr>';
//        echo '<td style = "vertical-align: middle">';
//        echo '<img src = "http://localhost/qrc-mgr/images/qrc_logo.JPG">';
//        echo '</td>';
//        echo '<td>';
//        echo '<font size = "2" style = "font-weight: bold;">บริษัท ควอลิตี้ รูฟ แอนด์ คอนสตรัคชั่น จำกัด <br/>';
//        echo 'QUALITY ROOF & CONSTRUCTION CO., LTD';
//        echo '</font><br/>';
//        echo '<font id = "address_detail" size = "1">33/103 หมู่ 3 ตำบลคลองสาม อำเภอคลองหลวง<br/>';
//        echo 'จังหวัดปทุมธานี 12120<br/>';
//        echo '33/103 Moo 3, T. Klongsam, A. Klong Luang, Pathumthani 12120<br/>';
//        echo 'E-Mail : qtruss.qrc@gmail.com TEL/Fax : 0-2504-0908';
//        echo '</font>';
//        echo '</td>';
//        echo '<td>';
//        echo '<div align = "center" style = "background-color: #d8e4bc; width: 150px; height: 50px; margin-left: 15px; margin-top: -25px;">';
//        echo '<font size = "3" style = "font-weight: bold; vertical-align: middle;">' . $inv_type_thai . '<br/>' . $inv_type_eng . '</font>';
//        echo '</div>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td colspan = "3" align = "right">';
//        echo '<font size = "1" style = "font-weight: bold;">เลขประจำตัวผู้เสียภาษีอากร 0-1355-55011-91-1</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td colspan = "3" align = "center" style = "background-color: #d8e4bc;border:1px solid;">';
//        echo '<font size = "1" style = "font-weight: bold;">ใบวางบิล/ใบแจ้งหนี้<br/>BILLING/INVOICE</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td colspan = "3">';
//        echo '<table width = "100%" border = "1" class="inner-tbl">';
//        echo '<tr>';
//        echo '<td width = "300px"><font size = "1">ลูกค้า (CUSTOMER NAME): ' . $custDetail['customer_name'] . '</font></td>';
//        echo '<td><font size = "1">เลขที่ใบกำกับภาษี/NO : QRC56-REP0100002</font></td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td rowspan = "2"><font size = "1">ที่อยู่ (ADDRESS): ' . $custDetail['customer_address'] . '</font></td>';
//        echo '<td><font size = "1">วันที่/DATE : ' . date("d/m/Y") . '</font></td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td><font size = "1">วันครบกำหนด (DUE DATE) :</font></td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td><font size = "1">TEL: ' . $custDetail['customer_tel'] . ' FAX: ' . $custDetail['customer_fax'] . '</font></td>';
//        echo '<td><font size = "1">อ้างอิง (REFER): </font></td>';
//        echo '</tr>';
//        echo '</table>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td colspan = "3">';
//        echo '<table width = "100%" border = "1" class="inner-tbl">';
//        echo '<tr style = "background-color: #d8e4bc;">';
//        echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">ลำดับที่<br/>ITEM</font></td>';
//        echo '<td align = "center" ><font size = "1" style = "font-weight: bold;">รายการสินค้า/บริการ<br/>DESCRIPTION</font></td>';
//        echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">จำนวน<br/>QUANTITY</font></td>';
//        echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">หน่วย<br/>UNIT</font></td>';
//        echo '<td align = "center" width = "69px"><font size = "1" style = "font-weight: bold;">ราคา/หน่วย<br/>PRICE/UNIT</font></td>';
//        echo '<td align = "center" width = "90px"><font size = "1" style = "font-weight: bold;">จำนวนเงิน/บาท<br/>AMOUNT/BAHT</font></td>';
//        echo '</tr>';
//        $rowCount = 1;
//        $data = new BillingVO();
//        error_reporting(E_ERROR);
//        for ($no = ($loopPage * 23); $no < 23 * ($loopPage + 1); $no++) {
//            if ($no >= 23) {
//                $data = $listBillingDto->GetObj($no);
//                if ($data->getDetail_type() == "PR") {
//                    echo '<tr>';
//                    echo '<td align="center" width="50px"><font size="1" style="font-weight: bold;">' . $rowCount++ . '</font></td>';
//                    echo '<td align="left" ><font size="1" style="font-weight: bold;">' . $data->getDetail_description() . '</font></td>';
//                    echo '<td align="center" width="50px"><font size="1"></font></td>';
//                    echo '<td align="center" width="50px"><font size="1"></font></td>';
//                    echo '<td align="right" width="90px"><font size="1"></font></td>';
//                    echo '<td align="right" width="90px"><font size="1"></font></td>';
//                    echo '</tr>';
//                    for ($o = $no; $o < ((23 * $noOfPage) * $loopPage); $o++) {
//                        $dataSub = $listBillingDto->GetObj($sub);
//                        if ($dataSub->getDetail_Type() == "PO" && $dataSub->getRef_po_project() == $data->getDetail_id()) {
//                            echo '<tr>';
//                            echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//                            echo '<td align = "left" ><font size = "1">' . $dataSub->getDetail_description() . '</font></td>';
//                            echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_quantity() . '</font></td>';
//                            echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_unit() . '</font></td>';
//                            echo '<td align = "right"><font size = "1">' . number_format($dataSub->getDetail_price_per_unit(), 2, '.', '') . '</font></td>';
//                            echo '<td align = "right" width = "90px"><font size = "1">' . number_format($dataSub->getDetail_amount_baht(), 2, '.', '') . '</font></td>';
//                            echo '</tr>';
//                            $totalAmountResult +=$dataSub->getDetail_amount_baht();
//                        }
//                    }
//                } else {
//
//                    $dataSub2 = new BillingVO();
//                    for ($o = $no; $o < ((23 * $noOfPage) * $loopPage); $o++) {
//                        $dataSub2 = $listBillingDto->GetObj($o);
//                        echo '<tr>';
//                        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//                        echo '<td align = "left" ><font size = "1">' . $dataSub2->getDetail_description() . '</font></td>';
//                        echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub2->getDetail_quantity() . '</font></td>';
//                        echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub2->getDetail_unit() . '</font></td>';
//                        echo '<td align = "right"><font size = "1">' . number_format($dataSub2->getDetail_price_per_unit(), 2, '.', '') . '</font></td>';
//                        echo '<td align = "right" width = "90px"><font size = "1">' . number_format($dataSub2->getDetail_amount_baht(), 2, '.', '') . '</font></td>';
//                        echo '</tr>';
//                    }
//                }
//            } else {
//                $totalAmountResult = 0;
//                $data = $listBillingDto->GetObj($no);
//                if ($data->getDetail_type() == "PR") {
//                    echo '<tr>';
//                    echo '<td align="center" width="50px"><font size="1" style="font-weight: bold;">' . $rowCount++ . '</font></td>';
//                    echo '<td align="left" ><font size="1" style="font-weight: bold;">' . $data->getDetail_description() . '</font></td>';
//                    echo '<td align="center" width="50px"><font size="1"></font></td>';
//                    echo '<td align="center" width="50px"><font size="1"></font></td>';
//                    echo '<td align="right" width="90px"><font size="1"></font></td>';
//                    echo '<td align="right" width="90px"><font size="1"></font></td>';
//                    echo '</tr>';
//                    for ($sub = 0; $sub < 23 * ($loopPage + 1); $sub++) {
//                        $dataSub = $listBillingDto->GetObj($sub);
//                        if ($dataSub->getDetail_Type() == "PO" && $dataSub->getRef_po_project() == $data->getDetail_id()) {
//                            echo '<tr>';
//                            echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//                            echo '<td align = "left" ><font size = "1">' . $dataSub->getDetail_description() . '</font></td>';
//                            echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_quantity() . '</font></td>';
//                            echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_unit() . '</font></td>';
//                            echo '<td align = "right"><font size = "1">' . number_format($dataSub->getDetail_price_per_unit(), 2, '.', '') . '</font></td>';
//                            echo '<td align = "right" width = "90px"><font size = "1">' . number_format($dataSub->getDetail_amount_baht(), 2, '.', '') . '</font></td>';
//                            echo '</tr>';
//                            $totalAmountResult +=$dataSub->getDetail_amount_baht();
//                        }
//                    }
//                }
//            }
//        }
//        $vatCalculation = ($totalAmountResult * 7) / 100;
//        $totalExpense = $totalAmountResult + $vatCalculation;
//        for ($i = 0; $i < 23 - $listBillingDto->Size(); $i++) {
//            echo '<tr>';
//            echo '<td align = "center" width = "50px"><font size = "2" style = "font-weight: bold;"></font></td>';
//            echo '<td align = "left" ><font size = "2" style = "font-weight: bold;"></font></td>';
//            echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//            echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//            echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//            echo '<td align = "right" width = "90px"><font size = "1"></font></td>';
//            echo '</tr>';
//        }
//        echo '<!--Footer-->';
//        echo '<tr>';
//        echo '<td align = "center" width = "50px">&nbsp;';
//        echo '</td>';
//        echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">จำนวนเงินรวมทั้งสิ้น (Sub Total)</font></td>';
//        echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . $totalAmountResult . '</font></td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center" width = "50px">&nbsp;';
//        echo '</td>';
//        echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">ภาษีมูลค่าเพิ่ม 7% (VALUE ADD TAX)</font></td>';
//        echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . $vatCalculation . '</font></td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center" width = "50px">&nbsp;';
//        echo '</td>';
//        echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">รวมเงินสุทธิ (GRAND TOTAL)</font></td>';
//        echo '<td align = "right" width = "90px" ><font size = "1" style = "font-weight: bold;">' . $totalExpense . '</font></td>';
//        echo '</tr>';
//        echo '</table>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td colspan = "3">';
//        echo '<table width = "100%" border = "1" class="inner-tbl">';
//        echo '<tr>';
//        echo '<td width = "50%" height = "100px" align="center">';
//        echo '<table>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '......................................';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '<font size = "1">(นางสาวชรินญาภัทร สาริโส)</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '<font size = "1">วันที่/DATE 31/01/2556</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '<font size = "1">ผู้วางบิล</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '</table>';
//        echo '</td>';
//        echo '<td width = "50%" align="center">';
//        echo '<table>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '......................................';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '<font size = "1">(..........................................)</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '<font size = "1">วันที่/DATE 31/01/2556</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td align = "center">';
//        echo '<font size = "1">ผู้รับวางบิล</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '</table>';
//        echo '</td>';
//        echo'</td>';
//        echo '</tr>';
//        echo '</table>';
//        echo '</td>';
//        echo '</tr>';
//        echo '<tr>';
//        echo '<td colspan = "3">';
//        echo '<font size = "1" style = "font-weight: bold;">หมายเหตุ : กรณีชำระเงินด้วยเช็ค กรุณาสั่งจ่ายในนาม "บริษัทควอลิตี้ รูฟ แอนด์ คอนสตรัคชั่น จำกัด" หรือ';
//        echo 'โอนเงินเข้าบัญชี ธนาคารไทยพาณิชย์ จำกัด สาขาถนนเลียบคลองสาม เลขที่บัญชี 293-212364-1</font>';
//        echo '</td>';
//        echo '</tr>';
//        echo '</table>';
//        echo '</div>';
//        echo '</body>';
//        echo '</html>';
//    }
}

