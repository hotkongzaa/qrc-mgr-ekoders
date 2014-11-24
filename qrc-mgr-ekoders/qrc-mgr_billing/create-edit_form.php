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

<script type="text/javascript" src="../assets/js/jquery.uploadfile.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/uploadfile.css" media="screen" />
<link href="../assets/css/plugins/select2/select2.css" rel="stylesheet">
<link href="../assets/css/plugins/select2/select2.custom.min.css" rel="stylesheet">

<script src="../assets/js/jquery.maskedinput.js"></script>

<div id="tabs-1">
    <table width="100%">
        <tr>
            <td align="right" style="width:250px">หมายเลขใบวางบิล:</td>
            <td align="left" style="width:250px">
                <!--<input type="text" class="form-control" id="inv_code" disabled="true">QRC56-R010002-->
                <?php
                $ryearThai = date('Y') + 543;
                $sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_INVOICE where inv_id like 'QRC" . substr($ryearThai, -2) . "-INV%'";

                $resultSet = mysql_query($sqlSelectMaxValue);
                $row = mysql_fetch_assoc($resultSet);
                if ($row['total'] == 0) {
                    echo '<input type="text" class="form-control" id="inv_code" disabled="true" value="QRC' . substr($ryearThai, -2) . '-INV0000001">';
                } else {
                    $sqlSelectCodeValue = "SELECT inv_id as code FROM QRC_INVOICE where inv_id like 'QRC" . substr($ryearThai, -2) . "-INV%' ORDER BY create_date_time DESC";
                    $resultSets = mysql_query($sqlSelectCodeValue);
                    $row = mysql_fetch_assoc($resultSets);
                    $prefix = 'QRC' . substr($ryearThai, -2) . '-INV';
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
                    echo '<input type="text" class="form-control" id="inv_code" disabled="true" value="' . $strResult . '">';
                }
                ?>
            </td>
            <td align="right" style="width:250px">Customer Name (ชื่อลูกค้า) *:</td>
            <td align="left" style="width:250px">
                <select class="form-control" id="customer_id" name="customer_id">
                    <option value=""></option>
                    <?php
                    $sqlSelectMemType = "SELECT * FROM QRC_CUSTOMER_NAME;";
                    $resultSets = mysql_query($sqlSelectMemType);
                    while ($row = mysql_fetch_array($resultSets)) {
                        echo '<option value="' . $row['customer_id'] . '">' . $row['customer_name'] . '</option>';
                    }
                    ?>
                </select>
                <!--<input type="text" class="form-control" id="team_name_form">-->
            </td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Project Name (ชื่อโครงการ) *:</td>
            <td align="left" colspan="3">
                <select title="Basic example"  style="width:300px" multiple class="form-control" id="multi_sel_project_name" name="multi_sel_project_name" size="5">                
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Start Date:</td>
            <td align="left" style="width:250px"><input type="text" class="form-control search_date" id="start_date" data-date-format="yyyy-mm-dd"></td>
            <td align="right" style="width:250px">End Date:</td>
            <td align="left" style="width:250px"><input type="text" class="form-control search_date" id="end_date" data-date-format="yyyy-mm-dd"></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">WO. Status:</td>
            <td align="left" style="width:250px">
                <select class="form-control" id="wo_status" name="wo_status" size="5" multiple="multiple">
                    <?php
                    $sqlSelectMemType = "SELECT * FROM QRC_ASSIGN_STATUS;";
                    $resultSets = mysql_query($sqlSelectMemType);
                    while ($row = mysql_fetch_array($resultSets)) {
                        echo '<option value="' . $row['A_S_ID'] . '">' . $row['A_S_NAME'] . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td align="right" style="width:250px">Order Type:</td>
            <td align="left" style="width:250px">
                <select class="form-control" id="order_type_id" name="order_type_id">
                    <option value=""></option>
                    <?php
                    $sqlSelectMemType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                    $resultSets = mysql_query($sqlSelectMemType);
                    while ($row = mysql_fetch_array($resultSets)) {
                        echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Invoice Type:</td>
            <td align="left" style="width:250px">
                <input type="radio" name="create_type" style="margin-left: 10px;" value="Original" checked="checked"/> Original
                <input type="radio" name="create_type" value="Copy"/> Copy
            </td>
            <td align="right" style="width:250px">INV Status:</td>
            <td align="left" style="width:250px">
                <select class="form-control" id="inv_status" name="inv_status">
                    <option value="">N/A</option>
                    <?php
                    $sqlSelectMemType = "SELECT * FROM QRC_INVOICE_STATUS;";
                    $resultSets = mysql_query($sqlSelectMemType);
                    while ($row = mysql_fetch_array($resultSets)) {
                        echo '<option value="' . $row['inv_staus_id'] . '">' . $row['inv_staus_name'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
</div>

<script src="../assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../assets/js/plugins/select2/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $("#tabs").tabs();
        $("input:radio[name=create_type]").click(function() {
            create_type = $(this).val();
        });
        $("input:radio[name=create_type_rep]").click(function() {
            create_receipt = $(this).val();
        });
        $("input:radio[name=create_type_pgs]").click(function() {
            create_progressive = $(this).val();
        });
        $(".search_date").datepicker();
        $("#multi_sel_project_name").select2({
            placeholder: "Select a Option",
            allowClear: true
        });
        $("#wo_status").select2({
            placeholder: "Select a Option",
            allowClear: true
        });
        $("#customer_id").change(function() {
            var cusID = $(this).val();
            var jqxhr = $.post("../model/GetProjectNameByCustomerID.php?cusID=" + cusID);
            jqxhr.success(function(data2) {
                $("#multi_sel_project_name").html(data2).select2({
                    placeholder: "Select a Option",
                    allowClear: true
                });
            });
            jqxhr.error(function(data2) {
                window.location.replace("error.php?error_msg=" + data2);
            });
        });
        $("#customer_id_rep").change(function() {
            var cusID = $(this).val();
            var jqxhr = $.post("../model/GetProjectNameByCustomerID.php?cusID=" + cusID);
            jqxhr.success(function(data2) {
                $("#multi_sel_project_name_rep").html(data2).multiselect("refresh");
            });
            jqxhr.error(function(data2) {
                window.location.replace("error.php?error_msg=" + data2);
            });
        });
        $("#customer_id_pgs").change(function() {
            var cusID = $(this).val();
            var jqxhr = $.post("../model/GetProjectNameByCustomerID.php?cusID=" + cusID);
            jqxhr.success(function(data2) {
                $("#multi_sel_project_name_pgs").html(data2).multiselect("refresh");
            });
            jqxhr.error(function(data2) {
                window.location.replace("error.php?error_msg=" + data2);
            });
        });
    });
</script>