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
        <td align="right" style="width:250px">Member ID (หมายเลขประจำตัว):</td>
        <td align="left" style="width:250px">
            <?php
            $sqlSelectMaxValue = "SELECT count(*) as total FROM QRC_MEMBERS";
            $resultSet = mysql_query($sqlSelectMaxValue);
            $row = mysql_fetch_assoc($resultSet);
            if ($row['total'] == 0) {
                echo '<input type="text" class="form-control" id="member_id_form" disabled="true" value="M00001"/>';
            } else {
                $sqlSelectCodeValue = "SELECT memID as code FROM QRC_MEMBERS ORDER BY CREATED_DATE_TIME DESC";
                $resultSets = mysql_query($sqlSelectCodeValue);
                $row = mysql_fetch_assoc($resultSets);
                $prefix = "M";
                $pieces = explode("M", $row[code]);
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
                echo '<input type="text" class="form-control" id="member_id_form" disabled="true" value="' . $strResult . '"/>';
//                                        echo '<input type="hidden" name="member_id" id="member_id" value="' . $strResult . '"/>';
            }
            ?>
        </td>
        <td align="right" style="width:250px">Member Name (ชื่อ-สกุล):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="member_name_form" name="member_name"/></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Role (ตำแหน่ง):</td>
        <td align="left" style="width:250px">
            <select class="form-control" id="member_role_form" name="member_role_form">
                <option value=""></option>
                <?php
                $sqlSelectProjectType = "SELECT * FROM QRC_MEMBER_ROLE;";
                $resultSet = mysql_query($sqlSelectProjectType);
                while ($row = mysql_fetch_array($resultSet)) {
                    echo '<option value="' . $row['role_id'] . '">' . $row['role_name'] . '</option>';
                }
                ?>
            </select>
        </td>
        <td align="right" style="width:250px">Skill (ความสามารถ):</td>
        <td align="left" style="width:250px">
            <select multiple="multiple" name="skill" id="member_skill_form" size="5">
                <?php
                $strBuilding = "";
                if ($memberID == "new") {
                    $sqlSelectProjectType = "SELECT * FROM QRC_TYPE_OF_SERVICE;";
                    $resultSet = mysql_query($sqlSelectProjectType);
                    while ($row = mysql_fetch_array($resultSet)) {
                        echo '<option value="' . $row['service_id'] . '">' . $row['service_name'] . '</option>';
                    }
                } else {
                    $selectNotin = "SELECT memSkill as memSkill FROM QRC_MEMBERS WHERE memID = '" . $memberID . "'";
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
            <span id="waringmsg" style="color: red; font-size: 11px;"></span>
        </td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Team Name (ชื่อทีม):</td>
        <td align="left" style="width:250px">
            <select class="form-control" id="team_code_in_member_form2" name="team_code_in_member_form">
                <option value=""></option>
                <?php
                $sqlSelectProjectType = "SELECT * FROM QRC_TEAM_BUILDER;";
                $resultSet = mysql_query($sqlSelectProjectType);
                while ($row = mysql_fetch_array($resultSet)) {
                    echo '<option value="' . $row['tCode'] . '">' . $row['tName'] . '</option>';
                }
                ?>
            </select>
        </td>
        <td align="right" style="width:250px">Team Code (หมายเลขทีมช่าง):</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="team_name_in_member_form2" disabled="true"></td>
    </tr>

    <tr>
        <td align="right" style="width:250px">Tel:</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="tel_in_member_form"></td>
        <td align="right" style="width:250px">Email:</td>
        <td align="left" style="width:250px"><input type="text" class="form-control" id="email_in_member_form"></td>
    </tr>
    <tr>
        <td align="right" style="width:250px">Remark:</td>
        <td align="left" colspan="3"><input type="text" class="form-control" id="remark_inform"></td>

    </tr>
</table>
<script>
    $(document).ready(function() {
        initialTextBox();
        $("#member_skill_form").multiselect({
            selectedList: 1
        });
        $("#team_code_in_member_form2").change(function() {

            var tCode = $("#team_code_in_member_form2").val();
            var jqxhr = $.post("../model/GetTName.php?tCode=" + tCode);
            jqxhr.success(function(data) {
                $("#team_name_in_member_form2").val(data);
            });
            jqxhr.error(function(data) {
                window.location.replace("error.php?error_msg=" + data);
            });
        });
    });
    function initialTextBox() {
        document.getElementById("member_name_form").maxLength = "64";
        document.getElementById("email_in_member_form").maxLength = "64";
        document.getElementById("remark_inform").maxLength = "256";
        $("#tel_in_member_form").mask("999-999-9999");
    }
</script>