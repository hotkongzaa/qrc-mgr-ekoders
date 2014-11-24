<?php

require '../../model-db-connection/config.php';
include '../com.qrc.mgr.service/BillingServiceImpl.php';
include '../com.qrc.mgr.dao/BillingDaoImpl.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BillingGeneratorTemplate
 *
 * @author krisada.thiangtham
 */
class BillingGeneratorTemplate {

    public function __construct() {
        
    }

    //put your code here
    public function billingGenerate() {
        //echo '<!DOCTYPE html>';
//echo '<html>';
//echo '<head>';
//echo '<meta charset = "UTF-8">';
//echo '<title></title>';
//echo '<style type = "text/css">';
//echo '#address_detail {';
//echo 'display: block;';
//echo '}';
//echo '.inner-tbl {';
//echo 'border-collapse: collapse;';
//echo '}';
//echo '.inner-tbl {';
//echo 'border: 1px solid black;';
//echo '}';
//echo '</style>';
//echo '</head>';
//echo '<body>';
//echo '<div id = "showcase">';
//echo '<table>';
//echo '<tr>';
//echo '<td style = "vertical-align: middle">';
//echo '<img src = "http://localhost/qrc-mgr/images/qrc_logo.JPG">';
//echo '</td>';
//echo '<td>';
//echo '<font size = "2" style = "font-weight: bold;">บริษัท ควอลิตี้ รูฟ แอนด์ คอนสตรัคชั่น จำกัด <br/>';
//echo 'QUALITY ROOF & CONSTRUCTION CO., LTD';
//echo '</font><br/>';
//echo '<font id = "address_detail" size = "1">33/103 หมู่ 3 ตำบลคลองสาม อำเภอคลองหลวง<br/>';
//echo 'จังหวัดปทุมธานี 12120<br/>';
//echo '33/103 Moo 3, T. Klongsam, A. Klong Luang, Pathumthani 12120<br/>';
//echo 'E-Mail : qtruss.qrc@gmail.com TEL/Fax : 0-2504-0908';
//echo '</font>';
//echo '</td>';
//echo '<td>';
//echo '<div align = "center" style = "background-color: #d8e4bc; width: 150px; height: 50px; margin-left: 15px; margin-top: -25px;">';
//echo '<font size = "3" style = "font-weight: bold; vertical-align: middle;">' . $inv_type_thai . '<br/>' . $inv_type_eng . '</font>';
//echo '</div>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td colspan = "3" align = "right">';
//echo '<font size = "1" style = "font-weight: bold;">เลขประจำตัวผู้เสียภาษีอากร 0-1355-55011-91-1</font>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td colspan = "3" align = "center" style = "background-color: #d8e4bc;border:1px solid;">';
//echo '<font size = "1" style = "font-weight: bold;">ใบวางบิล/ใบแจ้งหนี้<br/>BILLING/INVOICE</font>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td colspan = "3">';
//echo '<table width = "100%" border = "1" class="inner-tbl">';
//echo '<tr>';
//echo '<td width = "300px"><font size = "1">ลูกค้า (CUSTOMER NAME): ' . $custDetail['customer_name'] . '</font></td>';
//echo '<td><font size = "1">เลขที่ใบกำกับภาษี/NO : QRC56-REP0100002</font></td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td rowspan = "2"><font size = "1">ที่อยู่ (ADDRESS): ' . $custDetail['customer_address'] . '</font></td>';
//echo '<td><font size = "1">วันที่/DATE : ' . date("d/m/Y") . '</font></td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td><font size = "1">วันครบกำหนด (DUE DATE) :</font></td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td><font size = "1">TEL: ' . $custDetail['customer_tel'] . ' FAX: ' . $custDetail['customer_fax'] . '</font></td>';
//echo '<td><font size = "1">อ้างอิง (REFER): </font></td>';
//echo '</tr>';
//echo '</table>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td colspan = "3">';
//echo '<table width = "100%" border = "1" class="inner-tbl">';
//echo '<tr style = "background-color: #d8e4bc;">';
//echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">ลำดับที่<br/>ITEM</font></td>';
//echo '<td align = "center" ><font size = "1" style = "font-weight: bold;">รายการสินค้า/บริการ<br/>DESCRIPTION</font></td>';
//echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">จำนวน<br/>QUANTITY</font></td>';
//echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">หน่วย<br/>UNIT</font></td>';
//echo '<td align = "center" width = "69px"><font size = "1" style = "font-weight: bold;">ราคา/หน่วย<br/>PRICE/UNIT</font></td>';
//echo '<td align = "center" width = "90px"><font size = "1" style = "font-weight: bold;">จำนวนเงิน/บาท<br/>AMOUNT/BAHT</font></td>';
//echo '</tr>';
//if ($rowNum['total_record'] <= 23) {
//    $sqlSelectProject = "SELECT * FROM QRC_INVOICE_DETAIL_TMP WHERE detail_type like 'PR' order by create_date_time asc;";
//    $sqlQuery = mysql_query($sqlSelectProject);
//    $rowCount = 1;
//    $totalAmountResult = 0;
//    while ($rowProject = mysql_fetch_array($sqlQuery)) {
//        echo '<tr>';
//        echo '<td align="center" width="50px"><font size="1" style="font-weight: bold;">' . $rowCount . '</font></td>';
//        echo '<td align="left" ><font size="1" style="font-weight: bold;">' . $rowProject['detail_description'] . '</font></td>';
//        echo '<td align="center" width="50px"><font size="1"></font></td>';
//        echo '<td align="center" width="50px"><font size="1"></font></td>';
//        echo '<td align="right" width="90px"><font size="1"></font></td>';
//        echo '<td align="right" width="90px"><font size="1"></font></td>';
//
//        echo '</tr>';
//
//        $sqlSelectSubProject = "SELECT * FROM QRC_INVOICE_DETAIL_TMP WHERE detail_type like 'PO' and ref_po_project like '" . $rowProject['detail_id'] . "' order by create_date_time asc;";
//        $sqlQuerySub = mysql_query($sqlSelectSubProject);
//        while ($rowSubProject = mysql_fetch_array($sqlQuerySub)) {
//            echo '<tr>';
//            echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//            echo '<td align = "left" ><font size = "1">' . $rowSubProject['detail_description'] . '</font></td>';
//            echo '<td align = "center" width = "50px"><font size = "1">' . $rowSubProject['detail_quantity'] . '</font></td>';
//            echo '<td align = "center" width = "50px"><font size = "1">' . $rowSubProject['detail_unit'] . '</font></td>';
//            echo '<td align = "right"><font size = "1">' . number_format($rowSubProject['detail_price_per_unit'], 2, '.', '') . '</font></td>';
//            echo '<td align = "right" width = "90px"><font size = "1">' . number_format($rowSubProject['detail_amount_baht'], 2, '.', '') . '</font></td>';
//
//            echo '</tr>';
//            $totalAmountResult +=$rowSubProject['detail_amount_baht'];
//        }
//
//        $rowCount++;
//    }
//    $vatCalculation = ($totalAmountResult * 7) / 100;
//    $totalExpense = $totalAmountResult + $vatCalculation;
//    for ($i = 0; $i < 23 - $rowNum['total_record']; $i++) {
//        echo '<tr>';
//        echo '<td align = "center" width = "50px"><font size = "2" style = "font-weight: bold;"></font></td>';
//        echo '<td align = "left" ><font size = "2" style = "font-weight: bold;"></font></td>';
//        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
//        echo '<td align = "right" width = "90px"><font size = "1"></font></td>';
//        echo '</tr>';
//    }
//}
//echo '<!--Footer-->';
//echo '<tr>';
//echo '<td align = "center" width = "50px">&nbsp;';
//echo '</td>';
//echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">จำนวนเงินรวมทั้งสิ้น (Sub Total)</font></td>';
//echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . $totalAmountResult . '</font></td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center" width = "50px">&nbsp;';
//echo '</td>';
//echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">ภาษีมูลค่าเพิ่ม 7% (VALUE ADD TAX)</font></td>';
//echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . $vatCalculation . '</font></td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center" width = "50px">&nbsp;';
//echo '</td>';
//echo '<td colspan = "4" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">รวมเงินสุทธิ (GRAND TOTAL)</font></td>';
//echo '<td align = "right" width = "90px" ><font size = "1" style = "font-weight: bold;">' . $totalExpense . '</font></td>';
//echo '</tr>';
//echo '</table>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td colspan = "3">';
//echo '<table width = "100%" border = "1" class="inner-tbl">';
//echo '<tr>';
//echo '<td width = "50%" height = "100px" align="center">';
//echo '<table>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '......................................';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '<font size = "1">(นางสาวชรินญาภัทร สาริโส)</font>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '<font size = "1">วันที่/DATE 31/01/2556</font>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '<font size = "1">ผู้วางบิล</font>';
//echo '</td>';
//echo '</tr>';
//echo '</table>';
//echo '</td>';
//echo '<td width = "50%" align="center">';
//echo '<table>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '......................................';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '<font size = "1">(..........................................)</font>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '<font size = "1">วันที่/DATE 31/01/2556</font>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td align = "center">';
//echo '<font size = "1">ผู้รับวางบิล</font>';
//echo '</td>';
//echo '</tr>';
//echo '</table>';
//echo '</td>';
//echo'</td>';
//echo '</tr>';
//echo '</table>';
//echo '</td>';
//echo '</tr>';
//echo '<tr>';
//echo '<td colspan = "3">';
//echo '<font size = "1" style = "font-weight: bold;">หมายเหตุ : กรณีชำระเงินด้วยเช็ค กรุณาสั่งจ่ายในนาม "บริษัทควอลิตี้ รูฟ แอนด์ คอนสตรัคชั่น จำกัด" หรือ';
//echo 'โอนเงินเข้าบัญชี ธนาคารไทยพาณิชย์ จำกัด สาขาถนนเลียบคลองสาม เลขที่บัญชี 293-212364-1</font>';
//echo '</td>';
//echo '</tr>';
//echo '</table>';
//echo '</div>';
//echo '</body>';
//echo '</html>';
    }

}
