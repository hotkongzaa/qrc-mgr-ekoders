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
<link rel="stylesheet" href="../assets/css/plugins/jqueryui/jquery-ui-1.10.4.full.min.css" />
<script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.full.min.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/highcharts.js"></script>
<script src="../assets/js/exporting.js"></script>
<script src="../assets/js/data.js"></script>
<script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/plugins/datatables/datatables.js"></script>
<script src="../assets/js/plugins/datatables/datatables.responsive.js"></script>
<script src="../assets/js/jquery.quickfit.js"></script>
<script src="../assets/js/plugins/datatables/datatables.init.js"></script>

<div class="well white">
    <table id="SampleDT" class="datatable table table-hover table-striped table-bordered tc-table footable">
        <thead>
            <tr>
                <th class="col-small center" data-sort-ignore="true"></th>
                <th>Team Name</th>
                <th>No. Of WO</th>
                <th>Summary Plan Size</th>
                <th>AVG Unit Price</th>
                <th>Total Amount</th>
                <th>Total Amount With Deduct</th>
                <th>Total Number of Retention</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlQuery = "select
                            qrc_project_order.project_order_id as project_order_id,
                            qrc_team_builder.tCode as team_code,
                            qrc_team_builder.tName as team_name,
                            count(qrc_project_order.project_order_id) as number_of_wo, 
                            qrc_project_order.plan_size as summary_plan_size,
                            qrc_project_order.unit_price as average_unit_price,
                            qrc_project_order.amount as total_of_amount,
                            qrc_project_order.WO_RETENTION as total_amount_with_deduction,
                            qrc_project_order.WO_RETENTION as total_number_of_retention,
                            qrc_assign_order.TEAM_CODE as team_code
                        from qrc_project_order
                        left join qrc_assign_order on qrc_project_order.assign_id = qrc_assign_order.ASSIGN_ID
                        left join qrc_team_builder on qrc_assign_order.TEAM_CODE = qrc_team_builder.tCode
                        where qrc_project_order.assign_id is not null
                        group by qrc_team_builder.tName";
            $resultSet = mysql_query($sqlQuery);
            while ($row = mysql_fetch_array($resultSet)) {
                ?>
                <tr>
                    <td class="col-small center"><label><input type="checkbox" class="tc" value="<?= $row['team_code'] ?>"><span class="labels"></span></label></td>
                    <th><?= $row['team_name'] ?></th>
                    <td align="center"><?= $row['number_of_wo'] ?></td>
                    <td align="center"><?php
                        $summaryPlanSize = 0;
                        $sqlGetPlanSizeByWOID = "select plan_size
                                                    from qrc_project_order qpo
                                                    left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                    where qao.TEAM_CODE like '" . $row['team_code'] . "';";
                        $resultSetForPlansize = mysql_query($sqlGetPlanSizeByWOID);
                        while ($rowPlanSize = mysql_fetch_array($resultSetForPlansize)) {
                            $summaryPlanSize += $rowPlanSize['plan_size'];
                        }
                        echo $summaryPlanSize;
                        $summaryPlanSize = 0;
                        ?></td>
                    <td align="center"><?php
                        $sqlAVGunit = 0;
                        $sqlGetUnitPrice = "select unit_price as unit_price
                                            from qrc_project_order qpo
                                            left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                            where qao.TEAM_CODE like '" . $row['team_code'] . "';";
                        $resultForAVG = mysql_query($sqlGetUnitPrice);
                        while ($rowAVG = mysql_fetch_array($resultForAVG)) {
                            $sqlAVGunit += $rowAVG['unit_price'];
                        }
                        $sqlGetCount = "select count(*) as total
                                            from qrc_project_order qpo  
                                            left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                            where qao.TEAM_CODE like '" . $row['team_code'] . "';";
                        $rowTotalRec = mysql_fetch_assoc(mysql_query($sqlGetCount));
                        echo $sqlAVGunit / $rowTotalRec['total'];
                        $sqlAVGunit = 0;
                        ?></td>
                    <td align="center"><?php
                        $totalAVGAmount = 0;
                        $sqlGetTotalAmount = "select qpo.amount as amount
                                                from qrc_project_order qpo
                                                left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                where qao.TEAM_CODE like '" . $row['team_code'] . "';";
                        $resultForAVGAmount = mysql_query($sqlGetTotalAmount);
                        while ($rowAVGAmount = mysql_fetch_array($resultForAVGAmount)) {
                            $totalAVGAmount += $rowAVGAmount['amount'];
                        }
                        echo $totalAVGAmount;
                        $totalAVGAmount = 0;
                        ?></td>
                    <td align="center"><?php
                        $totalAmountWithDeduct = 0;
                        $totalRetention = 0;
                        $sqlGetTotalAmount2 = "select qpo.amount as amount
                                                from qrc_project_order qpo
                                                left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                where qao.TEAM_CODE like '" . $row['team_code'] . "';";
                        $resultForTotalAmount = mysql_query($sqlGetTotalAmount2);
                        while ($rowAVGAmounts = mysql_fetch_array($resultForTotalAmount)) {
                            $totalAmountWithDeduct += $rowAVGAmounts['amount'];
                        }

                        $sqlGetTotalRentention = "select WO_RETENTION as WO_RETENTION
                                                    from qrc_project_order qpo
                                                    left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                    where qao.TEAM_CODE like '" . $row['team_code'] . "'
                                                    and qpo.WO_RETENTION is not null
                                                    and qpo.WO_RETENTION !='';";

                        $resultSetTotalRetention = mysql_query($sqlGetTotalRentention);
                        while ($rowTotalRetention = mysql_fetch_array($resultSetTotalRetention)) {
                            $totalRetention += $rowTotalRetention['WO_RETENTION'];
                        }

                        echo $totalAmountWithDeduct - $totalRetention;

                        $totalAmountWithDeduct = 0;
                        $totalRetention = 0;
                        ?></td>
                    <td align="center"><?php
                        $sqlGetTotalRetention = "select count(*) as total_of_retention
                                                from qrc_project_order qpo
                                                left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                where qao.TEAM_CODE like '" . $row['team_code'] . "'
                                                and qpo.WO_RETENTION is not null
                                                and qpo.WO_RETENTION !='';";
                        $resultSetTotaoRetention = mysql_query($sqlGetTotalRetention);
                        $rowSet = mysql_fetch_assoc($resultSetTotaoRetention);
                        echo $rowSet['total_of_retention'];
                        ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
                    <div class="btn-group btn-group-sm pull-left">
                        <button class="btn btn-primary dropdown-toggle hidden-xs" data-toggle="dropdown">
                            with Selected <span class="caret"></span>
                        </button>
                        <button class="btn btn-primary dropdown-toggle visible-xs" data-toggle="dropdown">
                            <i class="fa fa-cog icon-only"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-primary" role="menu">
                            <li><a href="#" id="generate_graph">Generate Report Graph</a></li>
                        </ul>
                    </div>
                    <ul class="hide-if-no-paging pagination pagination-centered pull-right"></ul>
                    <div class="clearfix"></div>
                </td>
            </tr>
        </tfoot>
    </table>
    <script>
        var stringTeamCodeBuilder = "";
        $(document).ready(function () {
            $("#dialog").hide();
            $('table th input:checkbox').on('click', function () {
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                        .each(function () {
                            this.checked = that.checked;
                            $(this).closest('tr').toggleClass('selected');
                        });

            });
            $("#generate_graph").click(function () {
                var isFirst = true;
                $('input:checkbox.tc').each(function () {
                    var sThisVal = (this.checked ? $(this).val() : "");
                    if (sThisVal != "") {
                        if (isFirst) {
                            stringTeamCodeBuilder += sThisVal;
                            isFirst = false;
                        } else {
                            stringTeamCodeBuilder += "," + sThisVal;
                        }

                    }
                });
//                alert(stringTeamCodeBuilder);
                if (stringTeamCodeBuilder != "") {
                    $("#dialog").removeClass("hide").dialog({
                        height: 500,
                        width: 900
                    });
                    var getCateSeries = $.post("../model/GetTeamReportCateSummary.php?teamCodeSet="+stringTeamCodeBuilder);
                    getCateSeries.success(function (cateData) {
                        var teamCateArray = cateData.split(",");
                        console.log(teamCateArray);
                        $('#container').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Team Summary Report'
                            },
                            xAxis: {
                                categories: teamCateArray
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Amount(s)'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            "series": [{
                                    name: 'Tokyo',
                                    data: [106.4, 12900.2]

                                }, {
                                    name: 'New York',
                                    data: [9800.5, 93.4]

                                }, {
                                    name: 'London',
                                    data: [39.3, 41.4]

                                }, {
                                    name: 'Berlin',
                                    data: [34.5, 39.7]

                                }]
                        });
                    });
                } else {
                    alert("Please select at least one team");
                }
                stringTeamCodeBuilder = "";
            });
        });
    </script>
    <div id="dialog" title="Team Report Summary" class="hide">
        <div id="container" style="min-width: 850px; height: 400px; margin: 0 auto"></div>
    </div>