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
        error_reporting(0);
    }
}
?>
<script type="text/javascript" src="../assets/js/jquery.uploadfile.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/uploadfile.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.multiselect.css" />
<script src="../assets/js/jquery.maskedinput.js"></script>
<script src="../assets/js/jquery.multiselect.js"></script>
<script src="../assets/js/jquery.numeric.min.js"></script>
<table width="100%">
    <tr>
        <td align="right" style="width:250px">Project Name (ชื่อโครงการ)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px">
            <!--<input type="text" class="form-control" id="team_code_search">-->
            <select class="form-control required" id="po_project_name_form" name="po_project_name_form">
                <option value=""></option>
                <?php
                $sqlSelectMemType = "SELECT * FROM QRC_PROJECT;";
                $resultSets = mysql_query($sqlSelectMemType);
                if (!$resultSets) {
                    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                }
                while ($row = mysql_fetch_array($resultSets)) {
                    echo '<option value="' . $row['project_name'] . '">' . $row['project_name'] . '</option>';
                }
                ?>
            </select>
        </td>
        <td align="right" style="width:250px">Project Code (หมายเลขโครงการ):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" name="po_project_code_form" id="po_project_code_form" disabled="true"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px" >PO Name. (ชื่อ PO)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px">
            <input type="text" class="form-control" id="po_name" name="po_name">
        </td>
        <td align="right" style="width:250px">PO Status. (สถานะ PO):</td>
        <td align="left" style="width:250px">
            <select class="form-control required" id="project_order_status" name="project_order_status" disabled="true">
                <?php
                $sqlSelectProjectType = "SELECT * FROM QRC_ASSIGN_STATUS;";
                $resultSet = mysql_query($sqlSelectProjectType);
                if (!$resultSet) {
                    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                }
                while ($row = mysql_fetch_array($resultSet)) {
                    echo '<option value="' . $row['A_S_NAME'] . '">' . $row['A_S_NAME'] . '</option>';
                }
                ?>      
            </select>
        </td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Ref No. (เลขที่)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px">           
            <?php
            $sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_PO WHERE PO_DOCUMENT_NO LIKE 'REF%'";
            $resultSet = mysql_query($sqlSelectMaxValue);
            if (!$resultSet) {
                $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
            }
            $row = mysql_fetch_assoc($resultSet);
            if ($row['total'] == 0) {
                $strResult = "REF0000001";
            } else {
                $sqlSelectCodeValue = "SELECT PO_DOCUMENT_NO as code FROM QRC_PO WHERE PO_DOCUMENT_NO LIKE 'REF%' ORDER BY PO_CREATED_DATE_TIME DESC";
                $resultSets = mysql_query($sqlSelectCodeValue);
                if (!$resultSets) {
                    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                }
                $row = mysql_fetch_assoc($resultSets);
                $prefix = "REF";
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
            ?>            
            <input type="text" class="form-control required" id="po_document_no_form" value="<?= $strResult ?>" disabled="true">
        </td>
        <td align="right" style="width:250px">PO No. (เลขที่ใบสั่งจ้าง)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px"><input type="text" class="form-control required" id="po_po_no_form"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Plan (แบบบ้าน)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px">
            <input type="text" class="form-control required" id="po_home_plan_form" name="po_home_plan_form">
        </td>
        <td align="right" style="width:250px">Plot (แปลงบ้าน)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px">
            <input type="text" class="form-control required" id="po_home_plot_form" name="po_home_plot_form">
        </td>
    </tr>
    <tr>
        <td align="right" style="width:250px">PO Owner (เจ้าของ PO):</td>
        <td align="left" style="width:250px">
            <input type="text" class="form-control required" id="po_owner_form">
        </td>
        <td align="right" style="width:250px">PO Sender (จนท. PO):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control required" id="po_sender_form"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Issue Date (วันที่)<span style="color:red">*</span>:</td>
        <td align="left" style="width:250px"><input type="text" class="form-control search_date required" id="po_issue_date_form" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"></td>
        <td align="right" style="width:250px">Order Type (ประเภทงาน)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px">
            <select class="form-control required" id="po_order_type_form" name="po_order_type_form">
                <option value=""></option>
                <?php
                $sqlSelectMemType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                $resultSets = mysql_query($sqlSelectMemType);
                if (!$resultSets) {
                    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                }
                while ($row = mysql_fetch_array($resultSets)) {
                    echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Quantity (จำนวน)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px"><input type="text" class="form-control xxxx required" id="po_quantity_form"></td>
        <td align="right" style="width:250px">Plan Size (ขนาด ตร.ม.)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px"><input type="text" class="form-control xxxx required" id="po_plan_size_form"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Unit Price (ราคาต่อหน่วย)<span style="color:red">*</span>:</td>
        <td align="left" style="width:250px"><input type="text" class="form-control xxxx required" id="po_unit_price_form" ></td>
        <td align="right" style="width:250px">Amount (ราคารวม)<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px"><input type="text" class="form-control xxxx required" id="po_amount_form"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Grand Total included VAT 7%<span style="color:red">*</span>: </td>
        <td align="left" style="width:250px"><input type="text" class="form-control xxxx required" id="po_vat_form"></td>
        <td align="right" style="width:250px">Supervisor Control (ผู้ควบคุมงานของลูกค้า):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="po_project_supervisor_form" disabled="true"></td>

    </tr>
    <tr>
        <td align="right" style="width:250px;">Project Manager (ผู้จัดการโครงการ):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control required" id="po_project_manager_form" disabled="true"></td>
        <td align="right" style="width:250px;">Project Foreman (ผู้ควบคุมงานของโครงการ):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control required" id="po_project_foreman_form" disabled="true"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Retention:</td>
        <td align="left" style="width:250px"><input type="text" class="form-control xxxx" id="po_retention"></td>
        <td align="right" style="width:250px">Retention Reason:</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="po_retention_reason"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Remark:</td>
        <td align="left" colspan="3"><input type="text" class="form-control" id="remark_inform"></td>

    </tr>    
</table>
<br/>
<div class="row">
    <?php
    $isEdit = $_GET['isEdit'];
    if ($isEdit == "Edit") {
        ?>
        <div class="col-sm-6" id="uploadpart">
            <ul class="list-group">
                <li href="#" class="list-group-item active">Image Upload</li>
                <li class = "list-group-item">
                    <div id="mulitplefileuploader">Upload</div>
                    <div id="status"></div>
                </li>
            </ul>
        </div>
        <div id="edit_image"></div>
        <style type="text/css">
            .ajax-upload-dragdrop {width: 300px !important}
            .ajax-file-upload-statusbar {width: 340px !important}
        </style>
    <?php } else { ?>
        <div class="col-sm-12" id="uploadpart">
            <ul class="list-group">
                <li href="#" class="list-group-item active">Image Upload</li>
                <li class = "list-group-item">
                    <div id="mulitplefileuploader">Upload</div>
                    <div id="status"></div>
                </li>
            </ul>
        </div>
    <?php } ?>
</div>
<script src="../assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script>
    var poNo = "";
    var settings;
    $(document).ready(function () {
        initialTextBox();
        $(".search_date").datepicker();
        $("#uploadpart").hide();
        $('#po_po_no_form').keyup(function () {
            if ($("#po_po_no_form").val() === "") {
                $("#uploadpart").hide();
            } else {
                $("#uploadpart").show();
                poNo = $("#po_po_no_form").val();
            }
        });
        settings = {
            url: "../model/upload_po_attach.php",
            dragDrop: true,
            fileName: "myfile",
            allowedTypes: "jpg,png,gif,doc,pdf,zip",
            returnType: "json",
            onSuccess: function (files, data, xhr)
            {

            },
            showDelete: true,
            deleteCallback: function (data, pd)
            {
                for (var i = 0; i < data.length; i++)
                {
                    $.post("../model/delete_po_attach.php", {op: "delete", name: data[i]},
                    function (resp, textStatus, jqXHR)
                    {

                    });
                }
                pd.statusbar.hide(); //You choice to hide/not.

            }
        };
        var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
        $("#po_project_name_form").change(function () {
            // blockPage();
            var tCode = $("#po_project_name_form").val();
            var jqxhr = $.post("../model/GetTeamObject.php?tCode=" + tCode);
            jqxhr.success(function (data) {
                obj = JSON.parse(data);
                $("#po_project_code_form").val(obj.project_code);
                $("#po_project_manager_form").val(obj.project_manager);
                $("#po_project_supervisor_form").val(obj.supervisor);
                $("#po_project_foreman_form").val(obj.project_foreman);
                // $.unblockUI();
            });
            jqxhr.error(function (data) {
                alert("เกิดข้อผิดพลาด");
                //window.location.replace("error.php?error_msg=" + data);
            });
        });

    });
    function initialTextBox() {
        $(".xxxx").numeric();
        document.getElementById("po_document_no_form").maxLength = "20";
        document.getElementById("po_po_no_form").maxLength = "20";
        document.getElementById("po_home_plan_form").maxLength = "20";
        document.getElementById("po_owner_form").maxLength = "64";
        document.getElementById("po_home_plot_form").maxLength = "20";
        document.getElementById("po_sender_form").maxLength = "64";
        document.getElementById("remark_inform").maxLength = "256";
        document.getElementById("po_quantity_form").maxLength = "7";
        document.getElementById("po_plan_size_form").maxLength = "10";
        document.getElementById("po_amount_form").maxLength = "13";

        document.getElementById("po_unit_price_form").maxLength = "13";
        document.getElementById("po_vat_form").maxLength = "13";


        $("#po_issue_date_form").mask("9999-99-99");
    }
</script>