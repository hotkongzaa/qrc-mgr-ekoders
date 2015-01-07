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
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/plugins/jqueryui/jquery-ui-1.10.4.full.min.css" />
<script src="../assets/js/plugins/jqueryui/jquery-ui-1.10.4.full.min.js"></script>
<script src="../assets/js/plugins/jqueryui/jquery.ui.touch-punch.min.js"></script>

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
                        and qrc_project_order.created_date_time between '$start_date' and '$end_date'
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
                                                    where qao.TEAM_CODE like '" . $row['team_code'] . "'"
                                . " and qpo.created_date_time between '$start_date' and '$end_date';";
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
                                            where qao.TEAM_CODE like '" . $row['team_code'] . "'"
                                . " and qpo.created_date_time between '$start_date' and '$end_date';";
                        $resultForAVG = mysql_query($sqlGetUnitPrice);
                        while ($rowAVG = mysql_fetch_array($resultForAVG)) {
                            $sqlAVGunit += $rowAVG['unit_price'];
                        }
                        $sqlGetCount = "select count(*) as total
                                            from qrc_project_order qpo  
                                            left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                            where qao.TEAM_CODE like '" . $row['team_code'] . "'"
                                . " and qpo.created_date_time between '$start_date' and '$end_date';";
                        $rowTotalRec = mysql_fetch_assoc(mysql_query($sqlGetCount));
                        echo $sqlAVGunit / $rowTotalRec['total'];
                        $sqlAVGunit = 0;
                        ?></td>
                    <td align="center"><?php
                        $totalAVGAmount = 0;
                        $sqlGetTotalAmount = "select qpo.amount as amount
                                                from qrc_project_order qpo
                                                left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                where qao.TEAM_CODE like '" . $row['team_code'] . "'"
                                . " and qpo.created_date_time between '$start_date' and '$end_date';";
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
                                                where qao.TEAM_CODE like '" . $row['team_code'] . "'"
                                . " and qpo.created_date_time between '$start_date' and '$end_date';";
                        $resultForTotalAmount = mysql_query($sqlGetTotalAmount2);
                        while ($rowAVGAmounts = mysql_fetch_array($resultForTotalAmount)) {
                            $totalAmountWithDeduct += $rowAVGAmounts['amount'];
                        }

                        $sqlGetTotalRentention = "select WO_RETENTION as WO_RETENTION
                                                    from qrc_project_order qpo
                                                    left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                    where qao.TEAM_CODE like '" . $row['team_code'] . "'
                                                    and qpo.WO_RETENTION is not null
                                                    and qpo.WO_RETENTION !=''
                                                    and qpo.created_date_time between '$start_date' and '$end_date';";

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
                                                and qpo.WO_RETENTION !=''
                                                and qpo.created_date_time between '$start_date' and '$end_date';";
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
        var noOfWO = "";
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

                if (stringTeamCodeBuilder == "on,on") {
                    stringTeamCodeBuilder = "";
                }

                if (stringTeamCodeBuilder != "" && stringTeamCodeBuilder != "on,on") {
                    $("#dialog").removeClass("hide").dialog({
                        height: 550,
                        width: 1150
                    });
                    var getCateSeries = $.post("../model/GetTeamReportCateSummary.php?teamCodeSet=" + stringTeamCodeBuilder);
                    getCateSeries.success(function (cateData) {
                        var teamCateArray = cateData.split(",");

                        //Get Work Number of Work Order
                        var partOfGettingNoOfWO = $.post("../model/ReportGettingTeamNoOfWO.php?teamCodeSet=" + stringTeamCodeBuilder);
                        partOfGettingNoOfWO.success(function (noOfWso) {
                            var arrayWO = new Array();
                            var woSplit = noOfWso.split(",");
                            for (i = 0; i < woSplit.length; i++) {
                                arrayWO.push(parseInt(woSplit[i]));
                            }
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
                                            '<td style="padding:0"><b>{point.y:.1f}     </b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    },
                                    bar: {
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'top',
                                    x: -40,
                                    y: 100,
                                    floating: true,
                                    borderWidth: 1,
                                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                    shadow: true
                                },
                                credits: {
                                    enabled: false
                                },
                                "series": [{
                                        name: 'Number of Work Order',
                                        data: arrayWO
                                    }]
                            });
                            //Get Summary Plan Size
                            var partOfSummaryPlanSize = $.post("../model/ReportGettingTeamSummaryPlanSize.php?teamCodeSet=" + stringTeamCodeBuilder);
                            partOfSummaryPlanSize.success(function (summaryPlanSize) {
                                var arrayPlanSize = new Array();
                                var planSizeSplit = summaryPlanSize.split(",");
                                for (j = 0; j < planSizeSplit.length; j++) {
                                    arrayPlanSize.push(parseInt(planSizeSplit[j]));
                                }
                                $('#container2').highcharts({
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
                                                '<td style="padding:0"><b>{point.y:.1f}     </b></td></tr>',
                                        footerFormat: '</table>',
                                        shared: true,
                                        useHTML: true
                                    },
                                    plotOptions: {
                                        column: {
                                            pointPadding: 0.2,
                                            borderWidth: 0
                                        },
                                        bar: {
                                            dataLabels: {
                                                enabled: true
                                            }
                                        }
                                    },
                                    legend: {
                                        layout: 'vertical',
                                        align: 'right',
                                        verticalAlign: 'top',
                                        x: -40,
                                        y: 100,
                                        floating: true,
                                        borderWidth: 1,
                                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                        shadow: true
                                    },
                                    credits: {
                                        enabled: false
                                    },
                                    "series": [{
                                            name: 'Summary Plan Size',
                                            data: arrayPlanSize
                                        }]
                                });
                                //Get AVG Unit Price
                                var partOfGettingAVGUnitPrice = $.post("../model/ReportGettingTeamAVGUnitPrice.php?teamCodeSet=" + stringTeamCodeBuilder);
                                partOfGettingAVGUnitPrice.success(function (avgUnitPrice) {
                                    var arrayAVGPrice = new Array();
                                    var avgPriceSplit = avgUnitPrice.split(",");
                                    for (j = 0; j < avgPriceSplit.length; j++) {
                                        arrayAVGPrice.push(parseInt(avgPriceSplit[j]));
                                    }
                                    $('#container3').highcharts({
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
                                                    '<td style="padding:0"><b>{point.y:.1f}     </b></td></tr>',
                                            footerFormat: '</table>',
                                            shared: true,
                                            useHTML: true
                                        },
                                        plotOptions: {
                                            column: {
                                                pointPadding: 0.2,
                                                borderWidth: 0
                                            },
                                            bar: {
                                                dataLabels: {
                                                    enabled: true
                                                }
                                            }
                                        },
                                        legend: {
                                            layout: 'vertical',
                                            align: 'right',
                                            verticalAlign: 'top',
                                            x: -40,
                                            y: 100,
                                            floating: true,
                                            borderWidth: 1,
                                            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                            shadow: true
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        "series": [{
                                                name: 'AVG Unit Price',
                                                data: arrayAVGPrice
                                            }]
                                    });
                                    //Part of geting total amount
                                    var gettingTotalAmount = $.post("../model/ReportGettingTeamTotalAmount.php?teamCodeSet=" + stringTeamCodeBuilder);
                                    gettingTotalAmount.success(function (totalAmount) {
                                        var arrayTotalAmount = new Array();
                                        var totalAmountSplit = totalAmount.split(",");
                                        for (i = 0; i < totalAmountSplit.length; i++) {
                                            arrayTotalAmount.push(parseInt(totalAmountSplit[i]));
                                        }
                                        $('#container4').highcharts({
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
                                                        '<td style="padding:0"><b>{point.y:.1f}     </b></td></tr>',
                                                footerFormat: '</table>',
                                                shared: true,
                                                useHTML: true
                                            },
                                            plotOptions: {
                                                column: {
                                                    pointPadding: 0.2,
                                                    borderWidth: 0
                                                },
                                                bar: {
                                                    dataLabels: {
                                                        enabled: true
                                                    }
                                                }
                                            },
                                            legend: {
                                                layout: 'vertical',
                                                align: 'right',
                                                verticalAlign: 'top',
                                                x: -40,
                                                y: 100,
                                                floating: true,
                                                borderWidth: 1,
                                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                                shadow: true
                                            },
                                            credits: {
                                                enabled: false
                                            },
                                            "series": [{
                                                    name: 'Total Amount',
                                                    data: arrayTotalAmount
                                                }]
                                        });
                                        var gettingTotalAmountWithDeduct = $.post("../model/ReportGettingTeamTotalAmountWithDeduct.php?teamCodeSet=" + stringTeamCodeBuilder);
                                        gettingTotalAmountWithDeduct.success(function (totalAmountWithDeduct) {
                                            var arrayTotalAmountWithDeduct = new Array();
                                            var totalAmountWithDeductSplit = totalAmountWithDeduct.split(",");
                                            for (i = 0; i < totalAmountWithDeductSplit.length; i++) {
                                                arrayTotalAmountWithDeduct.push(parseInt(totalAmountWithDeductSplit[i]));
                                            }
                                            $('#container5').highcharts({
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
                                                            '<td style="padding:0"><b>{point.y:.1f}     </b></td></tr>',
                                                    footerFormat: '</table>',
                                                    shared: true,
                                                    useHTML: true
                                                },
                                                plotOptions: {
                                                    column: {
                                                        pointPadding: 0.2,
                                                        borderWidth: 0
                                                    },
                                                    bar: {
                                                        dataLabels: {
                                                            enabled: true
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    layout: 'vertical',
                                                    align: 'right',
                                                    verticalAlign: 'top',
                                                    x: -40,
                                                    y: 100,
                                                    floating: true,
                                                    borderWidth: 1,
                                                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                                    shadow: true
                                                },
                                                credits: {
                                                    enabled: false
                                                },
                                                "series": [{
                                                        name: 'Total Amount With Deduct',
                                                        data: arrayTotalAmountWithDeduct
                                                    }]
                                            });
                                            var gettingNoOfRetention = $.post("../model/ReportGettingTeamTotalNumberOfRetention.php?teamCodeSet=" + stringTeamCodeBuilder);
                                            gettingNoOfRetention.success(function (noOfRetention) {
                                                var arrayTotalNumberOfRetention = new Array();
                                                var totalRetentionWithSplit = noOfRetention.split(",");
                                                for (i = 0; i < totalRetentionWithSplit.length; i++) {
                                                    arrayTotalNumberOfRetention.push(parseInt(totalRetentionWithSplit[i]));
                                                }
                                                $('#container6').highcharts({
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
                                                                '<td style="padding:0"><b>{point.y:.1f}     </b></td></tr>',
                                                        footerFormat: '</table>',
                                                        shared: true,
                                                        useHTML: true
                                                    },
                                                    plotOptions: {
                                                        column: {
                                                            pointPadding: 0.2,
                                                            borderWidth: 0
                                                        },
                                                        bar: {
                                                            dataLabels: {
                                                                enabled: true
                                                            }
                                                        }
                                                    },
                                                    legend: {
                                                        layout: 'vertical',
                                                        align: 'right',
                                                        verticalAlign: 'top',
                                                        x: -40,
                                                        y: 100,
                                                        floating: true,
                                                        borderWidth: 1,
                                                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                                        shadow: true
                                                    },
                                                    credits: {
                                                        enabled: false
                                                    },
                                                    "series": [{
                                                            name: 'Total Number of Retention',
                                                            data: arrayTotalNumberOfRetention
                                                        }]
                                                });
                                                stringTeamCodeBuilder = "";
                                            });

                                        });

                                    });
                                });

                            });


                        });



                    });

                } else {
                    alert("Please select at least one team");

                }

            });
        });
    </script>
    <div id="dialog" title="Team Report Summary" class="hide">
        <div class="tc-tabs tabs-left"><!-- Nav tabs style 11-->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab30" data-toggle="tab"><i class="fa fa-line-chart"></i> No. Of WO</a></li>
                <li class=""><a href="#tab31" data-toggle="tab"><i class="fa fa-line-chart"></i> Summary Plan Size </a></li>
                <li class=""><a href="#tab32" data-toggle="tab"><i class="fa fa-line-chart"></i> AVG Unit Price</a></li>
                <li class=""><a href="#tab33" data-toggle="tab"><i class="fa fa-line-chart"></i> Total Amount</a></li>
                <li class=""><a href="#tab34" data-toggle="tab"><i class="fa fa-line-chart"></i> Total Amount With Deduct</a></li>
                <li class=""><a href="#tab35" data-toggle="tab"><i class="fa fa-line-chart"></i> Total Number of Retention</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="tab30">
                    <div id="container" style="min-width: 850px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="tab-pane" id="tab31">
                    <div id="container2" style="min-width: 850px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="tab-pane" id="tab32">
                    <div id="container3" style="min-width: 850px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="tab-pane" id="tab33">
                    <div id="container4" style="min-width: 850px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="tab-pane" id="tab34">
                    <div id="container5" style="min-width: 850px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="tab-pane" id="tab35">
                    <div id="container6" style="min-width: 850px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>       
    </div>