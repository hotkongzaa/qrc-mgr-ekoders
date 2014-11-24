<?php

require '../model-db-connection/config.php';
include '../model/com.qrc.mgr.model/BillingVO.php';
include '../model/com.qrc.mgr.utils/ArrayList.php';

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


$sqlSelectAllToCount = "SELECT * from QRC_PGS_DETAIL where ref_invoice_id like '$inv_code';";
$resultSet = mysql_query($sqlSelectAllToCount);
$listBillingDto = new ArrayList();
while ($row = mysql_fetch_array($resultSet)) {
    $billingObj = new BillingVO();
    //Setting parameter to object
    $billingObj->setDetail_id($row['PGS_ID']);
    $billingObj->setDetail_description($row['PGS_description']);
    $billingObj->setDetail_quantity($row['PGS_quantity']);
    $billingObj->setDetail_unit($row['PGS_unit']);
    $billingObj->setDetail_price_per_unit($row['PGS_price_per_unit']);
    $billingObj->setDetail_amount_baht($row['PGS_amount_baht']);
    $billingObj->setDetail_type($row['PGS_type']);
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
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Progressive_" . $inv_type_eng . ".doc");
$sqlSelectProjectDetail = "SELECT * FROM QRC_PROJECT WHERE PROJECT_CODE LIKE (SELECT PROJECT_ID FROM qrc_invoice WHERE INV_ID LIKE '$inv_code');";
$resultProjectSet = mysql_query($sqlSelectProjectDetail);
$projectSet = mysql_fetch_assoc($resultProjectSet);

$sqlGetProjectOwner = "SELECT * FROM project_owner where project_owner_id like '" . $projectSet['project_owner'] . "'";
$resultOwnerSet = mysql_query($sqlGetProjectOwner);
$ownerSet = mysql_fetch_assoc($resultOwnerSet);


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

for ($sub = 0; $sub < $listBillingDto->Size(); $sub++) {
    $dataSub = $listBillingDto->GetObj($sub);
    $totalAmountResult = 0;
    $vatCalculation = 0;
    $totalExpense = 0;
    echo '<table>';
    echo '<tr>';
    echo '<td style = "vertical-align: middle">';
    echo '<img src = "http://localhost/qrc-mgr/images/qrc_logo.JPG">';
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
    echo '<td colspan = "3" align = "center" style = "background-color: #d8e4bc;border:1px solid;">';
    echo '<font size = "1" style = "font-weight: bold;">ใบส่งมอบงาน / PROGRESSIVE REPORT</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan = "3">';
    echo '<table width = "100%" border = "1" class="inner-tbl">';
    echo '<tr>';
    echo '<td width = "300px"><font size = "1">โครงการ (PROJECT): ' . $projectSet['project_name'] . '</font></td>';
    echo '<td><font size = "1">เลขที่/NO : ' . $dataSub->getDetail_Id() . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><font size = "1">ที่ตั้ง (LOCATION): ' . $custDetail['customer_address'] . '</font></td>';
    echo '<td><font size = "1">วันที่/DATE : ' . date("d/m/Y") . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><font size = "1">เจ้าของโครงการ (OWNER) :' . $ownerSet['project_owner_name'] . '</font></td>';
    echo '<td rowspan="2" style="vertical-align: top;"><font size = "1">หมายเหตุ/REMARK :</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><font size = "1">ช่างติดตั้ง/หัวหน้างาน :  โทร/TEL: </font></td>';
    echo '</tr>';
    echo '</table>';
    echo '<font size = "1">รายการส่งมอบงานติดตั้งโครงหลังคา ' . $custDetail['customer_name'] . '</font>';
    echo '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td colspan = "3">';
    echo '<table width = "100%" border = "1" class="inner-tbl">';
    echo '<tr style = "background-color: #d8e4bc;">';
    echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">ลำดับที่<br/>ITEM</font></td>';
    echo '<td align = "center" ><font size = "1" style = "font-weight: bold;">รายการ<br/>DESCRIPTION</font></td>';
    echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">จำนวน<br/>QUANTITY</font></td>';
    echo '<td align = "center" width = "50px"><font size = "1" style = "font-weight: bold;">หน่วย<br/>UNIT</font></td>';
    echo '<td align = "center" width = "90px"><font size = "1" style = "font-weight: bold;">ราคา/บาท<br/>PRICE/BAHT</font></td>';
    echo '</tr>';
    $rowCount = 1;
    if ($dataSub->getDetail_Type() == "PO") {
        echo '<tr>';
        echo '<td align = "center" width = "50px"><font size = "1">' . $rowCount . '</font></td>';
        echo '<td align = "left" ><font size = "1">' . $dataSub->getDetail_description() . '</font></td>';
        echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_quantity() . '</font></td>';
        echo '<td align = "center" width = "50px"><font size = "1">' . $dataSub->getDetail_unit() . '</font></td>';
        echo '<td align = "right" width = "90px"><font size = "1">' . number_format($dataSub->getDetail_amount_baht(), 2, '.', '') . '</font></td>';
        echo '</tr>';
        $totalAmountResult +=$dataSub->getDetail_amount_baht();
    }
    $vatCalculation = ($totalAmountResult * 7) / 100;
    $totalExpense = $totalAmountResult + $vatCalculation;
    for ($i = 0; $i < 23 - $listBillingDto->Size(); $i++) {
        echo '<tr>';
        echo '<td align = "center" width = "50px"><font size = "2" style = "font-weight: bold;"></font></td>';
        echo '<td align = "left" ><font size = "2" style = "font-weight: bold;"></font></td>';
        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
        echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
        echo '<td align = "right" width = "90px"><font size = "1"></font></td>';
        echo '</tr>';
    }
    echo '<!--Footer-->';
    echo '<tr>';
    echo '<td align = "center" width = "50px">&nbsp;';
    echo '</td>';
    echo '<td colspan = "3" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">จำนวนเงินรวมทั้งสิ้น</font></td>';
    echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . $totalAmountResult . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center" width = "50px">&nbsp;';
    echo '</td>';
    echo '<td colspan = "3" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">ภาษีมูลค่าเพิ่ม 7%</font></td>';
    echo '<td align = "right" width = "90px" style = "font-weight: bold;"><font size = "1">' . $vatCalculation . '</font></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center" width = "50px">&nbsp;';
    echo '</td>';
    echo '<td colspan = "3" align = "left" width = "50px" style = "background-color: #d8e4bc;font-weight: bold;" ><font size = "1">รวมเงินสุทธิ</font></td>';
    echo '<td align = "right" width = "90px" ><font size = "1" style = "font-weight: bold;">' . $totalExpense . '</font></td>';
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
    echo '<font size = "1">วันที่/DATE ....../......./..........</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">ผู้ส่งมอบ</font>';
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
    echo '<font size = "1">วันที่/DATE ....../......./..........</font>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align = "center">';
    echo '<font size = "1">ผู้ตรวจสอบ/อนุมัติ</font>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</td>';
    echo'</td>';
    echo '</tr>';
    echo '</table>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '<br/><br/><br/><br/><br/><br/>';
}
echo '</div>';
echo '</body>';
echo '</html>';

