<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$teamCodeSet = $_GET['teamCodeSet'];
$finalResult = "";
$isFirst = true;
$arrayTeamCodeSet = explode(",", $teamCodeSet);
for ($i = 0; $i < count($arrayTeamCodeSet); $i++) {
    if ($arrayTeamCodeSet[$i] == "on") {
        
    } else {
        $totalAmountWithDeduct = 0;
        $totalRetention = 0;
        $sqlGetTotalAmount2 = "select qpo.amount as amount
                                                from qrc_project_order qpo
                                                left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                where qao.TEAM_CODE like '$arrayTeamCodeSet[$i]';";
        $resultForTotalAmount = mysql_query($sqlGetTotalAmount2);
        while ($rowAVGAmounts = mysql_fetch_array($resultForTotalAmount)) {
            $totalAmountWithDeduct += $rowAVGAmounts['amount'];
        }

        $sqlGetTotalRentention = "select WO_RETENTION as WO_RETENTION
                                                    from qrc_project_order qpo
                                                    left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                    where qao.TEAM_CODE like '$arrayTeamCodeSet[$i]'
                                                    and qpo.WO_RETENTION is not null
                                                    and qpo.WO_RETENTION !='';";

        $resultSetTotalRetention = mysql_query($sqlGetTotalRentention);
        while ($rowTotalRetention = mysql_fetch_array($resultSetTotalRetention)) {
            $totalRetention += $rowTotalRetention['WO_RETENTION'];
        }
        if ($isFirst) {
            $finalResult .= ($totalAmountWithDeduct - $totalRetention);
            $isFirst = false;
        } else {
            $finalResult .= "," . ($totalAmountWithDeduct - $totalRetention);
        }
    }
}

echo $finalResult;
