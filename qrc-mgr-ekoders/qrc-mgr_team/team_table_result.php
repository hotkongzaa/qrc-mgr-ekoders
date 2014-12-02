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
        $teamName = $_GET['teamName'];
        $teamCode = $_GET['teamCode'];
        $teamLead = $_GET['teamLead'];
        $teamSkill = $_GET['teamSkill'];
        $teamType = $_GET['teamType'];
        $teamManager = $_GET['teamManager'];
        $searchLimit = $_GET['searchLimit'];
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
                <th data-class="expand" class="center">Team Code</th>
                <th class = "center">Team Name</th>
                <th class = "center">Team Leader</th>
                <th class = "center">Team Type</th>
                <th class = "center">No. of member</th>
                <th class = "center">Remark</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($searchCondition == "search_all") {
                $sqlSelectTeamAll = "SELECT qtb.tCode AS t_code,"
                        . "qtb.tName AS t_Name,"
                        . "qtb.tLead_memid AS t_lead_id,"
                        . "qtb.tType AS t_type,"
                        . "qmr.memName AS t_lead_name,"
                        . "qtb.tRemark AS t_remark"
                        . " FROM QRC_TEAM_BUILDER qtb"
                        . " LEFT JOIN QRC_MEMBERS qmr ON qtb.tLead_memid = qmr.memID"
                        . " ORDER BY qtb.tCode DESC"
                        . " LIMIT 100;";
            } else {
                if ($searchLimit == "All") {
                    $limit = "";
                } else {
                    $limit = " LIMIT " . $searchLimit . ";";
                }
                $checkTeamCode = !empty($teamCode) ? " AND qtb.tCode LIKE '%$teamCode%'" : "";
                $checkTeamName = !empty($teamName) ? " AND qtb.tName LIKE '%$teamName%'" : "";
                $checkTeamLead = !empty($teamLead) ? " AND qtb.tLead_memid LIKE '$teamLead'" : "";
                $checkTeamType = !empty($teamType) ? " AND qtb.tType LIKE '$teamType'" : "";
                $checkTeamManager = !empty($teamManager) ? " AND qtb.tManager_memid LIKE '$teamManager'" : "";
                if ($teamSkill == "null") {
                    $checkTeamSkill = "";
                } else {
                    $checkTeamSkill = !empty($teamSkill) ? " AND qtb.tSkill IN ($teamSkill)" : "";
                }
                $sqlSelectTeamAll = "SELECT qtb.tCode AS t_code,"
                        . "qtb.tName AS t_Name,"
                        . "qtb.tLead_memid AS t_lead_id,"
                        . "qtb.tType AS t_type,"
                        . "qmr.memName AS t_lead_name,"
                        . "qtb.tRemark AS t_remark"
                        . " FROM QRC_TEAM_BUILDER qtb"
                        . " LEFT JOIN QRC_MEMBERS qmr ON qtb.tLead_memid = qmr.memID"
                        . " WHERE 1=1"
                        . $checkTeamCode
                        . $checkTeamLead
                        . $checkTeamName
                        . $checkTeamType
                        . $checkTeamManager
                        . $checkTeamSkill
                        . " ORDER BY qtb.tCode DESC"
                        . $limit;
            }
            $sqlGetAllData = mysql_query($sqlSelectTeamAll);
            if (mysql_num_rows($sqlGetAllData) >= 1) {
                while ($row = mysql_fetch_assoc($sqlGetAllData)) {
                    echo '<tr class = "gradeX">';
                    echo '<td class = "center">' . $row['t_code'] . '</td>';
                    echo '<td>' . $row['t_Name'] . '</td>';
                    echo '<td>' . $row['t_lead_name'] . '</td>';
                    if ($row['t_type'] == "M") {
                        echo '<td class = "center">M (Main team)</td>';
                    } else if ($row['t_type'] == "S") {
                        echo '<td class = "center">S (Sub team)</td>';
                    } else if ($row['t_type'] == "T") {
                        echo '<td class = "center">T (Temporary)</td>';
                    } else {
                        echo '<td class="center"</td>';
                    }
                    $sqlGetAmount = "SELECT COUNT(*) AS amount FROM QRC_TEAM_MAPPING WHERE TEAM_ID LIKE '" . $row['t_code'] . "'";
                    $sqlGetAmountData = mysql_query($sqlGetAmount);
                    $AmountResult = mysql_fetch_assoc($sqlGetAmountData);
                    echo '<td class = "center">' . $AmountResult['amount'] . '</td>';
                    echo '<td title="' . $row['t_remark'] . '"><div class="wordrap">' . $row['t_remark'] . '</div></td>';
                    echo '<td>';
                    echo '<div class = "btn-group margin-bottom-20">';
                    echo '<button type = "button" class = "btn btn-xs btn-default dropdown-toggle" data-toggle = "dropdown">Actions <span class = "caret"></span></button>';
                    echo '<ul class = "dropdown-menu" role = "menu">';
                    echo '<li><a href = "#modal-team" class="btn-xs" data-toggle = "modal" onclick=editTeam("' . $row['t_code'] . '",' . $AmountResult['amount'] . ')><i class = "fa fa-edit"></i> Edit (แก้ไข)</a></li>';
                    echo '<li class = "divider"></li>';
                    echo '<li><a href = "#" class="btn-xs" onclick=deleteTeam("' . $row['t_code'] . '","' . $row['t_lead_id'] . '")><i class = "fa fa-trash-o"></i> Delete (ลบ)</a></li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>      
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).tooltip({
            open: function (event, ui) {
                ui.tooltip.css("max-width", "600px");
                ui.tooltip.css("font-size", "12px");
            },
            track: true
        });
        $('.wordrap').quickfit({max: 14, min: 12, truncate: true});
    </script>