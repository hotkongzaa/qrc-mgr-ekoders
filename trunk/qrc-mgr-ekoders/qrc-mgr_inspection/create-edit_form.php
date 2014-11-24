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
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.multiselect.css" />
<script src="../assets/js/jquery.maskedinput.js"></script>
<script src="../assets/js/jquery.multiselect.js"></script>

<form method="post" id="inspectionForm">
    <table width="95%">
        <tr>
            <td align="right" style="width:250px">Project Name (ชื่อโครงการ):</td>
            <td align="left" style="width:250px">
                <!--<input type="text" class="form-control" id="team_code_search">-->
                <select class="form-control" id="inspection_project_name_form" name="inspection_project_name_form">
                    <option value=""></option>
                    <?php
                    $sqlSelectMemType = "SELECT * FROM QRC_PROJECT;";
                    $resultSets = mysql_query($sqlSelectMemType);
                    while ($row = mysql_fetch_array($resultSets)) {
                        echo '<option value="' . $row['project_code'] . '">' . $row['project_name'] . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td align="right" style="width:250px">Project Code (หมายเลขโครงการ):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_project_code_form" name="inspection_project_code_form" disabled="true"></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Document No. (เลขที่):</td>
            <td align="left" style="width:250px">
                <!-- <input type="text" class="form-control" id="inspection_document_no_form" name="inspection_document_no_form"> -->
                <select class="form-control" id="inspection_document_no_form" name="inspection_document_no_form">
                    <!--<option value=""></option>-->
                    <?php
//                    $sqlSelectPO = "SELECT * FROM QRC_PO;";
//                    $resultSetss = mysql_query($sqlSelectPO);
//                    while ($rowsss = mysql_fetch_array($resultSetss)) {
//                        echo '<option value="' . $rowsss['PO_ID'] . '">' . $rowsss['PO_DOCUMENT_NO'] . '</option>';
//                    }
//                    
                    ?>
                </select>
            </td>
            <td align="right" style="width:250px">Inspection No. (เลขที่ใบตรวจรับงาน):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_no_form" name="inspection_no_form"></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Inspection Date (วันที่):</td>
            <td align="left" style="width:250px">
                <input type="text" class="form-control search_date" id="inspection_date_form" name="inspection_date_form" data-date-format="yyyy-mm-dd">
            </td>
            <td align="right" style="width:250px">Order Type (ประเภทงาน):</td>
            <td align="left" style="width:250px">
                <select class="form-control" id="inspection_order_type_form" name="inspection_order_type_form">
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
            <td align="right" style="width:250px">Plan (แบบบ้าน):</td>
            <td align="left" style="width:250px">
                <input type="text" class="form-control" id="inspection_home_plan_form" name="inspection_home_plan_form" disabled="true">
            </td>
            <td align="right" style="width:250px">Plot (แปลงบ้าน):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_home_plot_form" name="inspection_home_plot_form" disabled="true"></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">PO No. (เลขที่ใบสั่งจ้าง):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_po_no_form" name="inspection_po_no_form" disabled="true"></td>

            <td align="right" style="width:250px">PO Issue Date (วันที่):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control date_sel" id="inspection_po_issue_date_form" name="inspection_po_issue_date_form" disabled="true" ></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Quantity (จำนวน):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_quantity_form" name="inspection_quantity_form" disabled="true"></td>
            <td align="right" style="width:250px">Plan Size (ขนาด ตร.ม.):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_plan_size_form" name="inspection_plan_size_form" disabled="true"></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Project Manager (ผู้จัดการโครงการ):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_project_manager_form" name="inspection_project_manager_form" disabled="true"></td>
            <td align="right" style="width:250px">Project Foreman (ผู้ควบคุมงานของโครงการ):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_project_foreman_form" name="inspection_project_foreman_form" disabled="true"></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Supervisor Control (ผู้ควบคุมงานของลูกค้า):</td>
            <td align="left" style="width:250px"><input type="text" class="form-control" id="inspection_project_supervisor_form" name="inspection_project_supervisor_form" disabled="true"></td>
            <td align="right" style="width:250px"></td>
            <td align="left" style="width:250px"></td>
        </tr>
        <tr>
            <td align="right" style="width:250px">Remark:</td>
            <td align="left" colspan="3"><input type="text" class="form-control" id="inspection_remark_form" name="inspection_remark_form"></td>

        </tr>
<!--        <tr>
            <td align="center" colspan="4">

                <div id="mulitplefileuploader">Upload</div>
                <div id="status"></div>
                <span id="uploadWarning" style="color:red"></span>
                <br/>
            </td>

        </tr>-->
    </table>
</form>
<br/>
<div class="row">
    <?php
    $isEdit = $_GET['isEdit'];
    if ($isEdit == "Edit") {
        ?>
        <div class="col-sm-6">
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
        <div class="col-sm-12">
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
    $(document).ready(function() {
        initialTextBox();
        $(".search_date").datepicker();
        $("#uploadpart").hide();
//        $("d.fancybox-effects-d").fancybox();
        $('#po_po_no_form').keyup(function() {
            if ($("#po_po_no_form").val() === "") {
                $("#uploadpart").hide();
            } else {
                $("#uploadpart").show();
                poNo = $("#po_po_no_form").val();
            }
        });
        settings = {
            url: "../model/upload_inspection_attach.php",
            dragDrop: true,
            fileName: "myfile",
            allowedTypes: "jpg,png,gif,doc,pdf,zip,xls,xlsx",
            returnType: "json",
            onSuccess: function(files, data, xhr)
            {
                //alert("Upload file: " + data + " complete !!");
            },
            showDelete: true,
            deleteCallback: function(data, pd)
            {
                for (var i = 0; i < data.length; i++)
                {
                    $.post("../model/delete_inspection_attach.php", {op: "delete", name: data[i]},
                    function(resp, textStatus, jqXHR)
                    {
                        //alert(resp);
                    });
                }
                pd.statusbar.hide(); //You choice to hide/not.

            }
        };
        var uploadObj = $("#mulitplefileuploader").uploadFile(settings);

        $("#inspection_document_no_form").change(function() {
            var insPOSelect = $(this).val();
            var jqxhr = $.post("../model/GetPoByIDForEdit.php?po_id=" + insPOSelect);
            jqxhr.success(function(data) {
                obj = JSON.parse(data);
                $("#inspection_home_plan_form").val(obj.PO_HOME_PLAN);
                $("#inspection_home_plot_form").val(obj.PO_HOME_PLOT);
                $("#inspection_po_no_form").val(obj.PO_PO_NO);
                $("#inspection_po_issue_date_form").val(obj.PO_ISSUE_DATE);
                $("#inspection_quantity_form").val(obj.PO_QUANTITY);
                $("#inspection_plan_size_form").val(obj.PO_PLAN_SIZE);
            });
            jqxhr.error(function() {
                alert("ไม่สามารถติดต่อกับ Server ได้");
            });
        });

        $("#inspection_project_name_form").change(function() {
            var insProjectSelect = $(this).val();
            var jqxhr = $.post("../model/GetAllProjectForEdit.php?project_code=" + insProjectSelect);
            jqxhr.success(function(data) {
                obj = JSON.parse(data);
                $("#inspection_project_code_form").val(obj.project_code);
                $("#inspection_project_manager_form").val(obj.project_manager);
                $("#inspection_project_foreman_form").val(obj.project_foreman);
                $("#inspection_project_supervisor_form").val(obj.supervisor_control);

                var jqxhr = $.post("../model/GetPoDocumentByProjectID.php?project_code=" + insProjectSelect);
                jqxhr.success(function(data2) {
                    $("#inspection_document_no_form").html(data2);
                    if ($("#inspection_document_no_form").val() == 0) {
                        $("#inspection_home_plan_form").val("");
                        $("#inspection_home_plot_form").val("");
                        $("#inspection_po_no_form").val("");
                        $("#inspection_po_issue_date_form").val("");
                        $("#inspection_quantity_form").val("");
                        $("#inspection_plan_size_form").val("");
                    }
                });
                jqxhr.error(function(data2) {
                    window.location.replace("error.php?error_msg=" + data2);
                });
            });
            jqxhr.error(function() {
                alert("ไม่สามารถติดต่อกับ Server ได้");
            });
        });

    });
    function initialTextBox() {
        document.getElementById("inspection_no_form").maxLength = "64";
        document.getElementById("inspection_remark_form").maxLength = "256";
        $("#inspection_date_form").mask("9999-99-99");
    }
</script>