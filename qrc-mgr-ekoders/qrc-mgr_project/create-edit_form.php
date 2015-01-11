<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script type="text/javascript">window.location.href="index.php";</script>';
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
<form id="regis_proj">
    <div class="form-group">
        <label class="col-sm-5 control-label">Project Code :</label>
        <div class="col-sm-5">
            <?php
            $sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_PROJECT";
            $resultSet = mysql_query($sqlSelectMaxValue);
            if (!$resultSet) {
                $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
            }
            $row = mysql_fetch_assoc($resultSet);
            if ($row['total'] == 0) {
                echo '<p class="form-control-static" id="projectCode">PR00001</p>';
                echo '<input type="hidden" name="project_code" id="project_code" value="PR00001"/>';
            } else {
                $sqlSelectCodeValue = "SELECT project_code as code FROM QRC_PROJECT ORDER BY CREATED_DATE_TIME DESC";
                $resultSets = mysql_query($sqlSelectCodeValue);
                if (!$resultSets) {
                    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                }
                $row = mysql_fetch_assoc($resultSets);
                $prefix = "PR";
                $pieces = explode("PR", $row[code]);
                if (strlen(intval($pieces[1])) == 1) {
                    if (intval($pieces[1]) == 9) {
                        $strResult = $prefix . "000" . (intval($pieces[1] + 1));
                    } else {
                        $strResult = $prefix . "0000" . (intval($pieces[1] + 1));
                    }
                } else if (strlen(intval($pieces[1])) == 2) {
                    if (intval($pieces[1]) == 99) {
                        $strResult = $prefix . "00" . (intval($pieces[1] + 1));
                    } else {
                        $strResult = $prefix . "000" . (intval($pieces[1] + 1));
                    }
                } else if (strlen(intval($pieces[1])) == 3) {
                    if (intval($pieces[1]) == 999) {
                        $strResult = $prefix . "0" . (intval($pieces[1] + 1));
                    } else {
                        $strResult = $prefix . "00" . (intval($pieces[1] + 1));
                    }
                } else if (strlen(intval($pieces[1])) == 4) {
                    if (intval($pieces[1]) == 9999) {
                        $strResult = $prefix . (intval($pieces[1] + 1));
                    } else {
                        $strResult = $prefix . "0" . (intval($pieces[1] + 1));
                    }
                } else {
                    $strResult = $prefix . (intval($pieces[1] + 1));
                }
                echo '<p class="form-control-static" id="projectCode">' . $strResult . '</p>';
                echo '<p class="form-control-static" id="projectCodeShowForEdit"></p>';
                echo '<input type="hidden" name="project_code" id="project_code" value="' . $strResult . '"/>';
            }
            ?>

        </div>
    </div>
    <div class="form-group">
        <label for="project_name" class="col-sm-5 control-label">Project Name (โครงการ)* :</label>
        <div class="col-sm-5" id="project_name_div status">
            <input type="text" class="form-control" id="project_name" name="project_name">            
        </div>
    </div>
    <div class="form-group">
        <label for="project_type" class="col-sm-5 control-label">Project Type (ประเภทโครงการ)* :</label>
        <div class="col-sm-5">
            <div class="btn-group" id="project_type_div">
                <select class="form-control" id="project_type_select" name="project_type">
                    <option value="0">---Please select---</option>
                    <?php
                    $sqlSelectProjectType = "SELECT * FROM PROJECT_TYPE;";
                    $resultSet = mysql_query($sqlSelectProjectType);
                    if (!$resultSet) {
                        $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                        file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                    }
                    while ($row = mysql_fetch_array($resultSet)) {
                        echo '<option value="' . $row['project_type_id'] . '">' . $row['project_type_name'] . '</option>';
                    }
                    ?>                                           
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="project_type" class="col-sm-5 control-label">Project Status (สถานะโครงการ)* :</label>
        <div class="col-sm-5">
            <div class="btn-group" id="project_status_div">
                <select class="form-control" id="project_status_select" name="project_status">
                    <option value="0">---Please select---</option>
                    <?php
                    $sqlSelectProjectType = "SELECT * FROM PROJECT_STATUS;";
                    $resultSet = mysql_query($sqlSelectProjectType);
                    if (!$resultSet) {
                        $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                        file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                    }
                    while ($row = mysql_fetch_array($resultSet)) {
                        echo '<option value="' . $row['project_status_id'] . '">' . $row['project_status_name'] . '</option>';
                    }
                    ?>                                           
                </select>
            </div>

        </div>

    </div>
    <div class="form-group">
        <label for="project_type" class="col-sm-5 control-label">Project Owner (เจ้าของโครงการ)* :</label>
        <div class="col-sm-5">
            <div class="btn-group" id="project_owner_div">
                <select class="form-control" id="project_owner_select" name="project_owner">
                    <option value="0">---Please select---</option>
                    <?php
                    $sqlSelectProjectType = "SELECT * FROM PROJECT_OWNER;";
                    $resultSet = mysql_query($sqlSelectProjectType);
                    if (!$resultSet) {
                        $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                        file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                    }
                    while ($row = mysql_fetch_array($resultSet)) {
                        echo '<option value="' . $row['project_owner_id'] . '">' . $row['project_owner_name'] . '</option>';
                    }
                    ?>                                           
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="project_type" class="col-sm-5 control-label">Customer Name (ชื่อลูกค้า)* :</label>
        <div class="col-sm-5">
            <div class="btn-group" id="project_customer_div">
                <select class="form-control" id="project_customer_select" name="project_customer">
                    <option value="0">---Please select---</option>
                    <?php
                    $sqlSelectProjectType = "SELECT * FROM QRC_CUSTOMER_NAME;";
                    $resultSet = mysql_query($sqlSelectProjectType);
                    if (!$resultSet) {
                        $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                        file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                    }
                    while ($row = mysql_fetch_array($resultSet)) {
                        echo '<option value="' . $row['customer_id'] . '">' . $row['customer_name'] . '</option>';
                    }
                    ?>                                           
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="project_manager" class="col-sm-5 control-label">Project Manager (ผู้ดูแลโครงการ) :</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="project_manager" name="project_manager">
        </div>
    </div>
    <div class="form-group">
        <label for="project_foreman" class="col-sm-5 control-label">Project Foreman(ผู้ควบคุมงานของโครงการ) :</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="project_foreman" name="project_foreman">
        </div>
    </div>
    <div class="form-group">
        <label for="supervisor_control" class="col-sm-5 control-label">Supervisor Control (ผู้ควบคุมงานของลูกค้า) :</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="supervisor_control" name="supervisor_control">
        </div>
    </div>
    <div class="form-group">
        <label for="project_supervisor_tel" class="col-sm-5 control-label">Team Owner (ทีมที่ดูแลโครงการ) :</label>
        <div class="col-sm-5">
            <select class="form-control" id="team_owner" name="team_owner">
                <option value="0">---Please select---</option>
                <?php
                $sqlSelectProjectType = "SELECT * FROM QRC_TEAM_BUILDER;";
                $resultSet = mysql_query($sqlSelectProjectType);
                if (!$resultSet) {
                    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                }
                while ($row = mysql_fetch_array($resultSet)) {
                    echo '<option value="' . $row['tCode'] . '">' . $row['tName'] . '</option>';
                }
                ?>                                           
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="qa_inspectors" class="col-sm-5 control-label">Quality Inspectors (ผู้ตรวจสอบคุณภาพ) :</label>
        <div class="col-sm-5">
            <select class="form-control" id="qa_inspectors" name="qa_inspectors">
                <option value="0">---Please select---</option>
                <?php
                $sqlSelectProjectType = "SELECT * FROM QRC_MEMBERS WHERE memRole IN ('60001','60003','60004','60002');";
                $resultSet = mysql_query($sqlSelectProjectType);
                if (!$resultSet) {
                    $log = "[" . date("Y-m-d H:i:s") . "] | [ERROR] | DB query exception: " . mysql_error() . PHP_EOL;
                    file_put_contents('../logs/QRC_BUILDING_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
                }
                while ($row = mysql_fetch_array($resultSet)) {
                    echo '<option value="' . $row['memID'] . '">' . $row['memName'] . '</option>';
                }
                ?>                                           
            </select>
        </div>
    </div>
    <div class="form-group" id="createDate">
        <label for="created_date" class="col-sm-5 control-label">Created Date (วันที่สร้างโปรเจค) :</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="created_date" disabled="true">
        </div>
    </div>
    <div class="form-group" id="lastUpdate">
        <label for="last_update" class="col-sm-5 control-label">Last update (วันที่แก้ไขล่าสุด) :</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="last_update" disabled="true">
        </div>
    </div>
    <div class="form-group">
        <label for="last_update" class="col-sm-5 control-label">Address/Location :</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="address_location" name="address_location" val="">
        </div>
    </div>
    <div class="form-group">
        <label for="project_remark" class="col-sm-5 control-label">Remark :</label>
        <div class="col-sm-5">
            <textarea rows="4" cols="30" class="form-control" id="project_remark" name="project_remark"></textarea><br>
        </div>        
    </div>


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

</form>

<script type="text/javascript" src="../assets/js/jquery.uploadfile.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/uploadfile.css" media="screen" />
<script>
    $(document).ready(function () {
        settings = {
            url: "../model/upload_project_image.php",
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
                    $.post("../model/delete_project_image_attach.php", {op: "delete", name: data[i]},
                    function (resp, textStatus, jqXHR)
                    {

                    });
                }
                pd.statusbar.hide(); //You choice to hide/not.

            }
        };
        var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
        initialTextBox();
        var m_names = new Array("มกราคม", "กุมภาพันธ์", "มีนาคม",
                "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน",
                "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        var d = new Date();
        var curr_date = d.getDate();
        var curr_month = d.getMonth();
        var curr_year = d.getFullYear();
        $("#created_date").val(curr_date + " " + m_names[curr_month] + " " + (curr_year + 543));
    });


    function initialTextBox() {
        document.getElementById("project_name").maxLength = "128";
        document.getElementById("project_manager").maxLength = "64";
        document.getElementById("project_foreman").maxLength = "64";
        document.getElementById("supervisor_control").maxLength = "64";
        document.getElementById("address_location").maxLength = "256";
        document.getElementById("project_remark").maxLength = "256";
    }
</script>