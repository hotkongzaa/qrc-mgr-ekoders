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
        $memberID = $_GET['mID'];
    }
}
?>

<link rel="stylesheet" type="text/css" href="../assets/css/jquery.multiselect.css" />
<script src="../assets/js/jquery.maskedinput.js"></script>
<script src="../assets/js/jquery.multiselect.js"></script>

<table width="100%">
    <tr>
        <td align="right" style="width:250px">Team Code (หมายเลขทีมช่าง):</td>
        <td align="left" style="width:250px">
            <?php
            $sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_TEAM_BUILDER";
            $resultSet = mysql_query($sqlSelectMaxValue);
            $row = mysql_fetch_assoc($resultSet);
            if ($row['total'] == 0) {
                echo '<input type="text" class="form-control" id="team_code_form" disabled="true" value="B00001"/>';
            } else {
                $sqlSelectCodeValue = "SELECT tCode as code FROM QRC_TEAM_BUILDER ORDER BY CREATED_DATE_TIME DESC";

                $resultSets = mysql_query($sqlSelectCodeValue);
                $row = mysql_fetch_assoc($resultSets);
                $prefix = "B";
                $pieces = explode($prefix, $row[code]);
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
                echo '<input type="text" class="form-control" id="team_code_form" disabled="true" value="' . $strResult . '"/>';
            }
            ?>
        </td>
        <td align="right" style="width:250px">Team Name (ชื่อทีม)*:</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="team_name_form"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Team Leader (หัวหน้าทีม)*:</td>
        <td align="left" style="width:250px">
            <select class="form-control" id="team_lead_form" name="team_lead_form">
                <option value=""></option>
                <?php
                $sqlSelectMemType = "SELECT * FROM QRC_MEMBERS WHERE memRole in ('60004','60003');";
                $resultSets = mysql_query($sqlSelectMemType);
                while ($row = mysql_fetch_array($resultSets)) {
                    echo '<option value="' . $row['memID'] . '">' . $row['memName'] . '</option>';
                }
                ?>
            </select>
        </td>
        <td align="right" style="width:250px">No. of Member (จำนวนลูกทีม):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="no_of_member_form" disabled="true"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Type of Service (ประเภทของบริการ)*:</td>
        <td align="left" style="width:250px" colspan="3">

            <select title="Basic example" multiple="multiple" name="type_of_service" id="select2_2_form" size="5">
                <?php
                if ($memberID == "new") {
                    $sqlSelectProjectType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                    $resultSet = mysql_query($sqlSelectProjectType);
                    while ($row = mysql_fetch_array($resultSet)) {
                        echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                    }
                } else {
                    $selectNotin = "SELECT tSkill as memSkill FROM QRC_TEAM_BUILDER WHERE tCode = '" . $memberID . "'";
                    $rrSet = mysql_query($selectNotin);
                    $notinResult = mysql_fetch_array($rrSet);
                    if ($notinResult['memSkill'] == "undefined") {
                        $sqlSelectProjectType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                        $resultSet = mysql_query($sqlSelectProjectType);
                        while ($row = mysql_fetch_array($resultSet)) {
                            echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                        }
                    } else {
                        $strNotIn = "(" . $notinResult['memSkill'] . ")";
                        $sqlSelectProjectTypeOther = "SELECT * FROM QRC_TYPE_OF_SERVICE WHERE SERVICE_ID NOT IN " . $strNotIn;
                        $rSets = mysql_query($sqlSelectProjectTypeOther);
                        while ($rowss = mysql_fetch_array($rSets)) {
                            if ($row['service_id'] == $rows['SKILL_ID']) {
                                echo '<option value="' . $rowss['service_id'] . '" >' . $rowss['service_name'] . '</option>';
                            }
                        }
                        $sqlSelectProjectType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                        $resultSet = mysql_query($sqlSelectProjectType);
                        while ($row = mysql_fetch_array($resultSet)) {
                            //echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                            $sqlGetSkillAttr = "SELECT * FROM QRC_SKILL_ATTR WHERE M_T_REF_ID='" . $memberID . "';";
                            $rSet = mysql_query($sqlGetSkillAttr);
                            while ($rows = mysql_fetch_array($rSet)) {
                                if ($row['service_id'] == $rows['SKILL_ID']) {
                                    echo '<option value="' . $row['service_id'] . '" selected>' . $row['service_name'] . '</option>';
                                    $strBuilding .=$row['service_id'] . ",";
                                }
                            }
                        }
                    }
                }
                ?> 
            </select>
            <span id="waringteamMsg" style="color: red; font-size: 11px;"></span>
        </td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Team Type (ประเภททีม):*</td>
        <td align="left" style="width:250px">
            <select class="form-control" id="team_type_form" name="team_type_form">
                <option value=""></option>
                <option value="M">M (Main team)</option>
                <option value="S">S (Sub team)</option>
                <option value="T">T (Temporary)</option>
            </select>
        </td>
        <td align="right" style="width:250px">Team Manager (ผู้จัดการทีม):*</td>
        <td align="left" style="width:250px">
            <select class="form-control" id="team_t_manager_form" name="team_t_manager_form">
                <option value=""></option>
                <?php
                $sqlSelectMemType = "SELECT * FROM QRC_MEMBERS WHERE memRole ='60003';";
                $resultSets = mysql_query($sqlSelectMemType);
                while ($row = mysql_fetch_array($resultSets)) {
                    echo '<option value="' . $row['memID'] . '">' . $row['memName'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Remark:</td>
        <td align="left" colspan="3"><input type="text" class="form-control" id="team_remark_in_form"></td>

    </tr>
<!--    <tr>
        <td align="right" style="width:250px" colspan="2"><button class = "btn btn-primary" style="margin-left: 5px" id="team_create_edit_btn">Create/Edit (สร้าง/แก้ไข)</button></td>
        <td align="left" style="width:250px" colspan="2"><button class = "btn btn-red" style="margin-left: 5px" id="team_btn_cancel">Cancel (ยกเลิก)</button></td>
    </tr>-->
</table>
<script>
    $(document).ready(function () {
        initialTextBox();
        $("#select2_2_form").multiselect({
            selectedList: 1 // 0-based index
        });

    });
    function initialTextBox() {
        document.getElementById("team_name_form").maxLength = "64";
        document.getElementById("team_remark_in_form").maxLength = "256";
    }
</script>