<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
} else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo '<script type="text/javascript">var r=confirm("Session expire (30 mins)!"); if(r==true){window.location.href="../index.php";}else{window.location.href="index.php";}</script>';
    } else {
        require '../model-db-connection/config.php';
        $config = require '../model-db-connection/qrc_conf.properties.php';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            #address_detail {
                display: block;
            }
            .inner-tbl {
                border-collapse: collapse;
            }
            .inner-tbl {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>

        <div id="showcase">
            <table>
                <tr>
                    <td colspan="3">
                        <table width="100%" border="1" class="inner-tbl">
                            <tr style="background-color: #d8e4bc;">
                                <td align="center" width="50px"><font size="1" style="font-weight: bold;">ลำดับที่<br/>ITEM</font></td>
                                <td align="center" ><font size="1" style="font-weight: bold;">รายการสินค้า/บริการ<br/>DESCRIPTION</font></td>
                                <td align="center" width="50px"><font size="1" style="font-weight: bold;">จำนวน<br/>QUANTITY</font></td>
                                <td align="center" width="50px"><font size="1" style="font-weight: bold;">หน่วย<br/>UNIT</font></td>
                                <td align="center" width="69px"><font size="1" style="font-weight: bold;">ราคา/หน่วย<br/>PRICE/UNIT</font></td>
                                <td align="center" width="90px"><font size="1" style="font-weight: bold;">จำนวนเงิน/บาท<br/>AMOUNT/BAHT</font></td>

                            </tr>
                            <!--Header-->
                            <?php
                            $sqlSelectProject = "SELECT * FROM QRC_INVOICE_DETAIL_TMP WHERE detail_type like 'PR' order by create_date_time asc;";
                            $sqlQuery = mysql_query($sqlSelectProject);
                            $rowCount = 1;
                            $totalAmountResult = 0;
                            while ($rowProject = mysql_fetch_array($sqlQuery)) {
                                echo '<tr>';
                                echo '<td align="center" width="50px"><font size="1" style="font-weight: bold;">' . $rowCount . '</font></td>';
                                echo '<td align="left" ><font size="1" style="font-weight: bold;">' . $rowProject['detail_description'] . '</font></td>';
                                echo '<td align="center" width="50px"><font size="1"></font></td>';
                                echo '<td align="center" width="50px"><font size="1"></font></td>';
                                echo '<td align="right" width="90px"><font size="1"></font></td>';
                                echo '<td align="right" width="90px"><font size="1"></font></td>';
                                echo '<td align="right"><a href = "#" class="btn-xs" onclick=deleteFirstLevel("' . $rowProject['detail_id'] . '")><i class = "fa fa-trash-o"></i> ลบ</a></td>';
                                echo '</tr>';

                                $sqlSelectSubProject = "SELECT * FROM QRC_INVOICE_DETAIL_TMP WHERE detail_type like 'PO' and ref_po_project like '" . $rowProject['detail_id'] . "' order by create_date_time asc;";
                                $sqlQuerySub = mysql_query($sqlSelectSubProject);
                                while ($rowSubProject = mysql_fetch_array($sqlQuerySub)) {
                                    echo '<tr>';
                                    echo '<td align = "center" width = "50px"><font size = "1"></font></td>';
                                    echo '<td align = "left" ><font size = "1">' . $rowSubProject['detail_description'] . '</font></td>';
                                    echo '<td align = "center" width = "50px"><font size = "1">' . $rowSubProject['detail_quantity'] . '</font></td>';
                                    echo '<td align = "center" width = "50px"><font size = "1">' . $rowSubProject['detail_unit'] . '</font></td>';
                                    echo '<td align = "right"><font size = "1">' . number_format($rowSubProject['detail_price_per_unit'], 2, '.', '') . '</font></td>';
                                    echo '<td align = "right" width = "90px"><font size = "1">' . number_format($rowSubProject['detail_amount_baht'], 2, '.', '') . '</font></td>';
                                    echo '<td align="right"><a href = "#" class="btn-xs" onclick=deleteSubLevel("' . $rowSubProject['detail_id'] . '")><i class = "fa fa-trash-o"></i> ลบ</a></td>';
                                    echo '</tr>';
                                    $totalAmountResult +=$rowSubProject['detail_amount_baht'];
                                }

                                $rowCount++;
                            }
                            $vatCalculation = ($totalAmountResult * 7) / 100;
                            $totalExpense = $totalAmountResult + $vatCalculation;
                            ?>
                            <!--Footer-->
                            <tr>
                                <td align="center" width="50px">&nbsp;</td>
                                <td colspan="4" align="left" width="50px" style="background-color: #d8e4bc;font-weight: bold;" ><font size="1">จำนวนเงินรวมทั้งสิ้น (Sub Total)</font></td>
                                <td align="right" width="90px" style="font-weight: bold;"><font size="1"><?php echo number_format($totalAmountResult, 2, '.', ''); ?></font></td>
                            </tr>
                            <tr>
                                <td align="center" width="50px">&nbsp;</td>
                                <td colspan="4" align="left" width="50px" style="background-color: #d8e4bc;font-weight: bold;" ><font size="1">ภาษีมูลค่าเพิ่ม 7% (VALUE ADD TAX)</font></td>
                                <td align="right" width="90px" style="font-weight: bold;"><font size="1"><?php echo number_format($vatCalculation, 2, '.', ''); ?></font></td>
                            </tr>  
                            <tr>
                                <td align="center" width="50px">&nbsp;</td>
                                <td colspan="4" align="left" width="50px" style="background-color: #d8e4bc;font-weight: bold;" ><font size="1">รวมเงินสุทธิ (GRAND TOTAL)</font></td>
                                <td align="right" width="90px" ><font size="1" style="font-weight: bold;"><?php echo number_format($totalExpense, 2, '.', ''); ?></font></td>
                            </tr>  
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
