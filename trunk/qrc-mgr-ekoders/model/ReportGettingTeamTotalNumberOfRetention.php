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
        $sqlGetTotalRetention = "select count(*) as total_of_retention
                                                from qrc_project_order qpo
                                                left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                where qao.TEAM_CODE like '$arrayTeamCodeSet[$i]'
                                                and qpo.WO_RETENTION is not null
                                                and qpo.WO_RETENTION !='';";
        $resultSetTotaoRetention = mysql_query($sqlGetTotalRetention);
        $rowSet = mysql_fetch_assoc($resultSetTotaoRetention);

        if ($isFirst) {
            $finalResult .= $rowSet['total_of_retention'];
            ;
            $isFirst = false;
        } else {
            $finalResult .= "," . $rowSet['total_of_retention'];
            ;
        }
    }
}

echo $finalResult;
