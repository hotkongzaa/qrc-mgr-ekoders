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
        $sqlQuery = "SELECT"
                . " COUNT(qrc_project_order.project_order_id) as number_of_wo"
                . " from qrc_project_order"
                . " LEFT join qrc_assign_order on qrc_project_order.assign_id = qrc_assign_order.ASSIGN_ID"
                . " LEFT join qrc_team_builder on qrc_assign_order.TEAM_CODE = qrc_team_builder.tCode"
                . " where qrc_project_order.assign_id is not null"
                . " and qrc_team_builder.tCode like '" . $arrayTeamCodeSet[$i] . "'";
        $resultset = mysql_query($sqlQuery);
        $row = mysql_fetch_assoc($resultset);
        if ($isFirst) {
            $finalResult .= $row['number_of_wo'];
            $isFirst = false;
        } else {
            $finalResult .= "," . $row['number_of_wo'];
        }
    }
}

echo $finalResult;
