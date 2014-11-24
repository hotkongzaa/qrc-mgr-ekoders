<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$order_id = $_GET['order_id'];
$sqlSelectAllProjectRecord = "SELECT qpo.project_code as project_code,
                        qpo.project_order_id as order_id,
                        qpo.project_order_name as order_name,
			qpo.project_order_plan as project_plan,
			qpo.project_order_plot as project_plot,
			qpo.document_no as document_no,
			qpo.po_no as po_no,
			qpo.po_owner as po_owner,
			qpo.po_sender as po_sender,
			qpo.created_date_time as created_date_time,
			qpot.service_id as order_type,
                        qpot.service_name as service_name,
			qpo.plan_size as plan_size,
			qpo.unit_price as unit_price,
			qpo.amount as amount,
			qpo.include_vat as vat,
			qpo.image_name as imgName,
                        qpo.remark as project_order_remark,
                        qpo.project_status as project_status,
                        qp.project_manager as project_manager,
                        qp.project_foreman as project_foreman,
                        qp.supervisor_control as supervisor_control,
                        qtb.tCode as tCode,
                        qtb.tName as tName,
                        qpo.po_inspection_id as po_inspection_id,
                        qao.assign_date as assign_date,
                        qpo.WO_ORDER_TYPE as WO_ORDER_TYPE,
                        qpo.WO_PRICE as WO_PRICE,
                        qpo.WO_PERC_OF_PO as WO_PERC_OF_PO,
                        qao.target_date as target_date,
                        qpo.complete_date as complete_date
                        FROM QRC_PROJECT_ORDER qpo
                        LEFT JOIN QRC_TYPE_OF_SERVICE qpot ON qpo.order_type = qpot.service_id
                        LEFT JOIN QRC_ASSIGN_ORDER qao ON qpo.project_order_id = qao.wo_id
                        LEFT JOIN QRC_PROJECT qp ON qpo.project_code = qp.project_code
                        LEFT JOIN QRC_TEAM_BUILDER qtb ON qao.team_code = qtb.tCode
                        WHERE qpo.project_order_id like '$order_id';";
$sqlGetAllData = mysql_query($sqlSelectAllProjectRecord);
$row = mysql_fetch_array($sqlGetAllData);
echo json_encode($row);
//echo $project_code;