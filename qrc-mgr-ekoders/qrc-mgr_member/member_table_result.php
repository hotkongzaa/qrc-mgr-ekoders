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
        $searchCondition = $_GET['searchCondition'];
        $memId = $_GET['memId'];
        $memName = $_GET['memName'];
        $memRole = $_GET['memRole'];
        $memberSkill = $_GET['memberSkill'];
        $teamCode = $_GET['teamCode'];
        $teamName = $_GET['teamName'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/plugins/jqueryui/jquery-ui-1.10.4.full.min.css" />
<!-- core JavaScript -->
<script src="../assets/js/jquery.min.js"></script>
<!-- PAGE LEVEL PLUGINS JS -->
<script src="../assets/js/plugins/footable/footable.min.js"></script>
<script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/datatables/datatables.js"></script>
<script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>

<script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.full.min.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/jquery.quickfit.js"></script>

<!-- initial page level scripts for examples -->
<script src="../assets/js/plugins/datatables/datatables.init.js"></script>
<!-- Start jQuery Datatable -->
<div class="well white">
    <table id="SampleDT" class="datatable table table-hover table-striped table-bordered tc-table">
        <thead>
            <tr>
                <th data-class="expand" class="center" width="110px">Member ID</th>
                <th class = "center" width="200px">Member Name</th>
                <th class = "center" width="100px">Role</th>
                <th data-hide="phone,tablet" width="100px">Skill(s)</th>
                <th data-hide="phone,tablet" width="140px">Tel.</th>
                <th data-hide="phone,tablet">Email</th>
                <!--<th data-hide="phone,tablet">Remark</th>-->
                <th class = "center">Team Code</th>
                <th class = "center" width="140px">Team Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($searchCondition == "search_all") {
                $sqlSelectMemberAll = "SELECT qm.memID AS mem_id,"
                        . "qm.memName AS mem_name,"
                        . "qmr.role_name AS mem_role,"
                        . "qm.memTel AS mem_tel,"
                        . "qm.memEmail AS mem_email,"
                        . "qm.memSkill AS mem_skill,"
                        . "qm.memTCode AS mem_t_code,"
                        . "qm.memTName AS mem_t_name,"
                        . "qm.memRemark AS mem_remark"
                        . " FROM QRC_MEMBERS qm"
                        . " LEFT JOIN QRC_TEAM_BUILDER qtb ON qm.memTCode =qtb.tCode"
                        . " LEFT JOIN QRC_MEMBER_ROLE qmr ON qm.memRole = qmr.role_id"
                        . " ORDER BY qm.memID DESC;";
//            echo $sqlSelectMemberAll;
            } else {
                $checkMemId = !empty($memId) ? " AND qm.memID LIKE '%$memId%'" : "";
                $checkMemName = !empty($memName) ? " AND qm.memName LIKE '%$memName%'" : "";
                $checkMemRole = !empty($memRole) ? " AND qm.memRole LIKE '$memRole'" : "";
                $checkTCode = !empty($teamCode) ? " AND qm.memTCode LIKE '%$teamCode%'" : "";
                $checkTName = !empty($teamName) ? " AND qm.memTName LIKE '%$teamName%'" : "";
                if ($memberSkill == "null") {
                    $checkMemSkill = "";
                } else {
                    $checkMemSkill = !empty($memberSkill) ? " AND qsa.SKILL_ID IN ($memberSkill)" : "";
                }

                $sqlSelectMemberAll = "SELECT DISTINCT qm.memID AS mem_id,"
                        . "qm.memName AS mem_name,"
                        . "qmr.role_name AS mem_role,"
                        . "qm.memTel AS mem_tel,"
                        . "qm.memEmail AS mem_email,"
                        . "qm.memSkill AS mem_skill,"
                        . "qm.memTCode AS mem_t_code,"
                        . "qm.memTName AS mem_t_name,"
                        . "qm.memRemark AS mem_remark"
                        . " FROM QRC_MEMBERS qm"
                        . " LEFT JOIN QRC_TEAM_BUILDER qtb ON qm.memTCode =qtb.tCode"
                        . " LEFT JOIN QRC_MEMBER_ROLE qmr ON qm.memRole = qmr.role_id"
                        . " LEFT JOIN QRC_SKILL_ATTR qsa ON qm.memID = qsa.M_T_REF_ID"
                        . " WHERE 1=1"
                        . $checkMemId
                        . $checkMemName
                        . $checkMemRole
                        . $checkTCode
                        . $checkTName
                        . $checkMemSkill
                        . " ORDER BY qm.memID DESC;";
            }
            $sqlGetAllData = mysql_query($sqlSelectMemberAll);
//                echo $sqlSelectMemberAll;
            if (mysql_num_rows($sqlGetAllData) >= 1) {
                while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                    echo '<tr class = "gradeX">';
                    echo '<td>' . $row['mem_id'] . '</td>';
                    echo '<td title="' . $row['mem_name'] . '"><div class="wordrap">' . $row['mem_name'] . '</div></td>';
                    echo '<td title="' . $row['mem_role'] . '"><div class="wordrap">' . $row['mem_role'] . '</div></td>';
                    $skills = explode(",", $row['mem_skill']);
                    $j = 0;
                    for ($i = 0; $i <= count($skills); $i++) {
                        $sqlGetNameOfSkill = "SELECT service_name FROM QRC_TYPE_OF_SERVICE WHERE service_id like '$skills[$i]'";
                        $sqlGetSkillFromID = mysql_query($sqlGetNameOfSkill);
                        while ($rows = mysql_fetch_assoc($sqlGetSkillFromID)) {
                            if ($j == 0) {
                                $strResult.= $rows['service_name'];
                                $j = 1;
                            } else {
                                $strResult.= " , " . $rows['service_name'];
                            }
                        }
                    }
                    echo '<td title="' . $strResult . '"><div class="wordrap">' . $strResult . '</div></td>';
                    echo '<td title="' . $row['mem_tel'] . '"><div class="wordrap">' . $row['mem_tel'] . '</div></td>';
                    echo '<td title="' . $row['mem_email'] . '"><div class="wordrap">' . $row['mem_email'] . '</div></td>';
//                    echo '<td>' . $row['mem_remark'] . '</td>';
                    if ($row['mem_t_code'] == "") {
                        echo '<td class = "center">-</td>';
                        echo '<td class = "center">-</td>';
                    } else {
                        echo '<td>' . $row['mem_t_code'] . '</td>';
                        echo '<td>' . $row['mem_t_name'] . '</td>';
                    }


                    echo '<td class = "center">';

                    echo '<div class = "btn-group margin-bottom-20">';
                    echo '<button type = "button" class = "btn btn-default dropdown-toggle btn-xs" data-toggle = "dropdown">Actions <span class = "caret"></span></button>';

                    echo '<ul class = "dropdown-menu" role = "menu">';
                    echo '<li><a href = "#modal-member" class="btn-xs" data-toggle = "modal" onclick=editMember("' . $row['mem_id'] . '")><i class = "fa fa-edit"></i> Edit (แก้ไข)</a></li>';
                    echo '<li class = "divider"></li>';
                    echo '<li><a href = "#" class="btn-xs" onclick=deleteMember("' . $row['mem_id'] . '")><i class = "fa fa-trash-o"></i> Delete (ลบ)</a></li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</td>';


                    echo '</tr>';
                    $strResult = "";
                }
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).tooltip({
            open: function(event, ui) {
                ui.tooltip.css("max-width", "600px");
                ui.tooltip.css("font-size", "12px");
            },
            track: true
        });
        $('.wordrap').quickfit({max: 14, min: 12, truncate: true});
    </script>