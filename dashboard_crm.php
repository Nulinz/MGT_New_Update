<?php
include('fetch.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/dashboard_crm.css">

</head>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 py-2">
                <div class="sidebodyhead">
                    <h4 class="m-0">Dashboard - CRM</h4>
                    <!-- <div class="sdbdysearch">
                        <input type="text" class="form-control border-0" name="" id="">
                        <button>
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </div> -->
                </div>

                <!-- Dashboard buttons -->
                <?php
                // if ($emp_role == "Admin") {
                    include('./dashboard_btns.php');
                // }

                ?>

                <?php

                $tar_ch = $fetch->target_ach($emp_log);

                //   print_r($tar_ch);

                // Prepare the arrays for months and percentages
                $tar_months = [];
                $percentages = [];

                foreach ($tar_ch as $item) {
                    $tar_months[] = $item[0]; // Month names
                    $percentages[] = $item[1]; // Corresponding percentages
                }


                $growth = $fetch->dash_growth();
                // Encode the PHP array to JavaScript
                $months = array_column($growth, 'mon_name');  // Extract months (e.g., 'Dec', 'Jan')
                $counts = array_column($growth, 'cnt');

                foreach ($growth as $grw) {
                    $new_cnt[] = $grw['cnt'];
                }

                $avg_growth = array_sum($new_cnt) / count($new_cnt);

                $growth_cnt = $fetch->dash_growth_ind();

                // echo "<pre>";
                // print_r($growth_cnt);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($crm_pdf);

                // Assuming $le_chart is the data you're fetching
                $le_chart = $fetch->crm_lead_chart($emp_log, $emp_role);
                // echo "<pre>";

                // print_r($le_chart);

                // Initialize a variable to hold the sum of ttl_val
                $total_val_sum = 0;

                // Map numeric months to month names
                $month_names = [
                    1 => 'January',
                    2 => 'February',
                    3 => 'March',
                    4 => 'April',
                    5 => 'May',
                    6 => 'June',
                    7 => 'July',
                    8 => 'August',
                    9 => 'September',
                    10 => 'October',
                    11 => 'November',
                    12 => 'December'
                ];

                // Prepare JavaScript arrays for months and ttl_pro values
                $js_months = [];
                $js_ttl_pro = [];

                // Loop through the data array and sum the ttl_val
                foreach ($le_chart as $entry) {
                    $month_name = $month_names[$entry['month']]; // Convert month number to name
                    $js_months[] = $month_name; // Add month name to array
                    $js_ttl_pro[] = $entry['ttl_pro']; // Add ttl_pro value to array
                    $total_val_sum += $entry['ttl_val'];
                }

                // Extract only the ttl_pro values and store ttl_val separately
                // $ttlProValues = array_map(function($entry) use (&$new_val) {
                //     // If ttl_val is null, set it to 0
                //     $new_val[] = $entry['ttl_val'] ?? 0;  // Collect ttl_val into the array

                //     // Return ttl_pro values (converted to integer)
                //     return (int) $entry['ttl_pro'];  // Convert to integer for chart compatibility
                // }, $le_chart);

                // // Convert ttl_pro values to JavaScript format
                // $ttlProJs = json_encode($ttlProValues);

                $pro_value_lead = (($total_val_sum)) / 10000;


                //     $emp_ar  = [];

                //     foreach($emp_list as $em){

                //         $emp_ar[] = $em['id'];

                //     }

                //    foreach($emp_ar as $ar){
                //     $emp_ch = $fetch->crm_chart1($$ar, $emp_role);
                //    }


                $tk_list = $fetch->crm_chart1($emp_log, $emp_role);
                $tk_list = $fetch->crm_chart1($emp_log, $emp_role);

                if (!empty($tk_list['L1'])) {
                    foreach ($tk_list['L1'] as $tk) {
                        $t_L1[] = $tk['total_val']; // Store the 'total_val' from L1
                        $c_L1[] = $tk['total']; // Store the 'total_val' from L1

                    }
                } else {
                    // Handle empty 'L1' category (e.g., set default or show message)
                    $t_L1[] = 0;  // Default value, or handle as per your requirement
                    $c_L1[] = 0;
                }

                // Check if 'L2' category is not empty and loop through it
                if (!empty($tk_list['L2'])) {
                    foreach ($tk_list['L2'] as $tk) {
                        $t_L2[] = $tk['total_val']; // Store the 'total_val' from L2
                        $c_L2[] = $tk['total']; // Store the 'total_val' from L2
                    }
                } else {
                    // Handle empty 'L2' category (e.g., set default or show message)
                    $t_L2[] = 0;  // Default value, or handle as per your requirement
                    $c_L2[] = 0;  // Default value, or handle as per your requirement
                }


                // Check if 'CS' category is not empty and loop through it
                if (!empty($tk_list['CS'])) {
                    foreach ($tk_list['CS'] as $tk) {
                        $t_CS[] = $tk['total_val']; // Store the 'total_val' from CS
                        $c_CS[] = $tk['total']; // Store the 'total_val' from CS
                    }
                } else {
                    // Handle empty 'CS' category (e.g., set default or show message)
                    $t_CS[] = 0;  // Default value, or handle as per your requirement
                    $c_CS[] = 0;  // Default value, or handle as per your requirement
                }

                ?>

                <div class="container px-0 mt-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-xl-4 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">L1 - <?php echo array_sum($c_L1); ?></h6>
                                    <h6 class="card2h6 mb-2"><span>Value:</span> <?php echo array_sum($t_L1) / 10000; ?>
                                    </h6>

                                </div>
                                <div id="chart1"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-xl-4 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">L2 - <?php echo array_sum($c_L2); ?></h6>
                                    <h6 class="card2h6 mb-2"><span>Value:</span> <?php echo array_sum($t_L2) / 10000; ?>
                                    </h6>

                                </div>
                                <div id="chart2"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-xl-4 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">CS - <?php echo array_sum($c_CS); ?></h6>
                                    <h6 class="card2h6 mb-2"><span>Value:</span> <?php echo array_sum($t_CS) / 10000; ?>
                                    </h6>

                                </div>
                                <div id="chart3"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-6 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">Growth Rate Average</h6>
                                    <h6 class="card2h6 mb-2"><span>Value:</span> <?php echo $avg_growth; ?>
                                    </h6>
                                </div>
                                <div id="chart5"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-6 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">Target Achieved</h6>
                                    <h6 class="card2h6 mb-2"><span>Value:</span> <?php echo $avg_growth; ?>
                                    </h6>
                                </div>
                                <div id="chart6"></div>
                            </div>
                        </div>

                        <?php
                        if ($emp_role == "Admin") {
                            ?>

                            <div class="container mb-4">
                                <div class="sidebodyhead">
                                    <h4 class="m-0">CRM List</h4>
                                </div>

                                <div class="container-fluid mt-2 listtable">
                                    <div class="filter-container row mb-3">
                                        <div class="custom-search-container col-sm-12 col-md-8">
                                            <select class="headerDropdown form-select filter-option">
                                                <option value="All" selected>All</option>
                                            </select>
                                            <input type="text" id="customSearch" class="form-control filterInput"
                                                placeholder=" Search">
                                        </div>

                                        <div class="select1 col-sm-12 col-md-4 mx-auto">
                                            <div class="d-flex gap-3">
                                                <a href="" id="pdfLink"><img src="./images/printer.png" id="print" alt=""
                                                        height="35px" data-bs-toggle="tooltip" data-bs-title="Print"></a>
                                                <a href="" id="excelLink"><img src="./images/excel.png" id="excel" alt=""
                                                        height="35px" data-bs-toggle="tooltip" data-bs-title="Excel"></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-wrapper">
                                        <table class="example table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee</th>
                                                    <th>L1</th>
                                                    <th>L1-value</th>
                                                    <th>L2</th>
                                                    <th>L2-value</th>
                                                    <th>CS</th>
                                                    <th>CS-value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $emp_list = $fetch->crm_tbl();



                                                $emp_count = 1; // Employee counter
                                                foreach ($emp_list as $employee_data) {
                                                    if (empty($employee_data)) {
                                                        continue;
                                                    }
                                                    //   echo "<pre>";
                                                    //   print_r($employee_data['CS']['tk']);

                                                    $emp_i = $employee_data['CS']['tk'] ?? $employee_data['L1']['tk'] ?? $employee_data['L2']['tk'] ?? 0;

                                                    $emp_l = $fetch->table_list_id('m_emp', 'id', $emp_i);


                                                    ?>
                                                    <tr>
                                                        <td><?php echo $emp_count++; ?></td>
                                                        <td><?php echo $emp_l['name'] ?? 0; ?></td>
                                                        <td><?php echo (isset($employee_data['L1']) ? $employee_data['L1']['count_tk'] : '0'); ?>
                                                        </td>
                                                        <td><?php echo (isset($employee_data['L1']) ? $employee_data['L1']['total_pro_val'] : '0'); ?>
                                                        </td>
                                                        <td><?php echo (isset($employee_data['L2']) ? $employee_data['L2']['count_tk'] : '0'); ?>
                                                        </td>
                                                        <td><?php echo (isset($employee_data['L2']) ? $employee_data['L2']['total_pro_val'] : '0'); ?>
                                                        </td>
                                                        <td><?php echo (isset($employee_data['CS']) ? $employee_data['CS']['count_tk'] : '0'); ?>
                                                        </td>
                                                        <td><?php echo (isset($employee_data['CS']) ? $employee_data['CS']['total_pro_val'] : '0'); ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-3">
                                                                <a target="_blank"
                                                                    href="./print_crm.php?emp_crm=<?php echo $emp_i; ?>"><i
                                                                        class="fas fa-print"></i></a>
                                                            </div>
                                                        </td>

                                                        <!-- <td>
                                                    <div class="d-flex gap-3">
                                                        <a href=""><i class="fas fa-eye"></i></a>
                                                    </div>
                                                </td> -->

                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>



                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>

                            <div class="container mb-4">
                                <div class="sidebodyhead">
                                    <h4 class="m-0">Task List</h4>
                                </div>

                                <div class="container-fluid mt-2 listtable">
                                    <div class="filter-container row mb-3">
                                        <div class="custom-search-container col-sm-12 col-md-8">
                                            <select class="headerDropdown form-select filter-option">
                                                <option value="All" selected>All</option>
                                            </select>
                                            <input type="text" id="customSearch" class="form-control filterInput"
                                                placeholder=" Search">
                                        </div>

                                        <div class="select1 col-sm-12 col-md-4 mx-auto">
                                            <!-- <div class="d-flex gap-3">
                                            <a href="" id="pdfLink"><img src="./images/printer.png" id="print" alt="" height="35px"
                                                    data-bs-toggle="tooltip" data-bs-title="Print"></a>
                                            <a href="" id="excelLink"><img src="./images/excel.png" id="excel" alt="" height="35px"
                                                    data-bs-toggle="tooltip" data-bs-title="Excel"></a>
                                        </div> -->
                                        </div>
                                    </div>

                                    <div class="table-wrapper">
                                        <table class="example table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project</th>
                                                    <th>Company</th>
                                                    <th>Cat - Sub</th>
                                                    <th>Task For</th>
                                                    <th>Start Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tk_tbl = $fetch->task_ind($emp_log);
                                                //    print_r($tk_tbl);
                                                $i = 1;
                                                foreach ($tk_tbl as $td) {

                                                    $st_dt = date("d-m-Y", strtotime($td['st_date']));

                                                    if ($st_dt != date("Y-m-d")) {
                                                        continue;
                                                    }

                                                    $pro_det = $fetch->table_list_id('m_pro', 'id', $td['pro_id']);
                                                    $cmp_id = $pro_det['c_id'];
                                                    $cmp_det = $fetch->table_list_id('m_cmp', 'id', $cmp_id);
                                                    $emp_det = $fetch->table_list_id('m_emp', 'id', $td['task_for']);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i;
                                                        $i++; ?></td>
                                                        <td><?php echo $pro_det['title']; ?></td>
                                                        <td><?php echo $cmp_det['c_name']; ?></td>
                                                        <td><?php echo $td['task']; ?> - <?php echo $td['sub']; ?></td>
                                                        <td><?php echo $emp_det['name']; ?></td>
                                                        <td><?php echo $st_dt; ?></td>
                                                        <td>
                                                            <div class="d-flex gap-3">
                                                                <a target="__blank"
                                                                    href="./view_task.php?task_id=<?php echo $td['id']; ?>"
                                                                    data-bs-toggle="tooltip" data-bs-title="View Profile"><i
                                                                        class="fa-solid fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>

                                        </table>



                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        /*
                    ?>

                    <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                        <div class="cards">
                            <div class="cardshead">

                                <h6 class="card1h6 mb-2">Lead Generation</h6>
                                <h6 class="card2h6 mb-2"><span>Value:</span> <?php echo $pro_value_lead; ?></h6>
                            </div>
                            <div id="chart4"></div>
                            <!-- <div id="chart4"></div> -->
                        </div>
                    </div>
                    <?php
                         */
                        ?>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>
    var l1 = <?php echo json_encode($tk_list); ?>;

    console.log(l1);

    var series = [];
    var labels = [];

    if (l1.L1 && l1.L1.length > 0) {

        l1.L1.forEach(function (item) {
            series.push(parseInt(item.total));
            labels.push(item.cat);
        });


        // Chart 1
        var options = {
            series: series,
            labels: labels,
            colors: ["#115f9a", "#1984c5", "#22a7f0", "#48b5c4", "#76c68f", "#a6d75b"],
            chart: {
                type: 'donut',
                height: 315,
            },
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 320,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
    } else {
        document.querySelector("#chart1").innerHTML = "<p>No data available to display the chart.</p>";
        console.log("No data available in L1");
    }
</script>

<script>
    var series2 = [];
    var labels2 = [];


    if (l1.L2 && l1.L2.length > 0) {

        l1.L2.forEach(function (item) {
            series2.push(parseInt(item.total));
            labels2.push(item.cat);
        });

        // Chart 2
        var options = {
            series: series2,
            labels: labels2,
            // colors: ['#003f5c', '#58508d', '#bc5090'],
            colors: ['#92C5F9', '#0066CC', '#003366', '#87BB62', '#AFDC8F'],
            chart: {
                type: 'donut',
                height: 315,
            },
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 320,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };



        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();

    } else {
        document.querySelector("#chart2").innerHTML = "<p>No data available to display the chart.</p>";
        console.log("No data available in L1");
    }
</script>
<script>
    var series3 = [];
    var labels3 = [];

    if (l1.CS && l1.CS.length > 0) {


        l1.CS.forEach(function (item) {
            series3.push(parseInt(item.total));
            labels3.push(item.cat);
        });

        // Chart 3
        var options = {
            series: series3,
            labels: labels3,
            colors: ["#1B485E", "#326B77", "#568F8B", "#84B29E", "#B9D5B2", "#F4F6CC", "#df979e", "#d7658b", "#c80064"],
            chart: {
                type: 'donut',
                height: 315,
            },
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 320,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();

    } else {
        document.querySelector("#chart3").innerHTML = "<p>No data available to display the chart.</p>";
        console.log("No data available in CS");
    }
</script>

<script>
/*
    var months = <?php echo json_encode($js_months); ?>; // This will contain the month names
    var ttl_pro = <?php echo json_encode($js_ttl_pro); ?>; // This will contain the ttl_pro values
    // Chart 4
    var options = {
        series: [{
            name: "Monthly Lead Count",
            data: ttl_pro
        }],
        chart: {
            height: 300,
            type: 'area',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight',
            width: 3,
            colors: ['#568F8B']
        },
        markers: {
            size: 6,
            colors: ['#1B485E'],
            strokeColors: '#fff',
            strokeWidth: 2,
        },
        grid: {
            row: {
                colors: ['#fff', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: months,
        },
        yaxis: {
            min: 0,
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart4"), options);
    chart.render();
    */
</script>

<script>
    // Pass the PHP data to JavaScript
    var months = <?php echo json_encode($months); ?>;
    var counts = <?php echo json_encode($counts); ?>;
    var grw_cnt = <?php echo json_encode($growth_cnt); ?>;

    // console.log(months);
    // console.log(grw_cnt);

    // var comparison = [];

    //     // Loop through the months array and create a comparison object
    //     for (var i = 0; i < months.length; i++) {
    //         comparison.push({
    //             month: months[i],
    //             growth_count: grw_cnt[i]['cnt']
    //         });
    //     }

    //     console.log(comparison);


    // var uniqueMonths = [];
    //  var finalCounts = [];

    // //  var new_fi = [];

    //  // Create a map to quickly look up counts based on the month name
    //     var grwMap = {};
    //     grw_cnt.forEach(function(item) {
    //         // grwMap[item.mon_name] = item.cnt;  // Map each month name to its count
    //     });

    //  months.map(month => {
    //     console.log(grw_cnt.mon_name);

    //     // if(grw_cnt.mon_name==month){

    //     //     grwMap[item.mon_name] = grw_cnt.cnt
    //     // }

    //     });

    //     console.log(grwMap);

    //  grw_cnt.forEach(function(item) {
    //     var monthName = item;
    //     uniqueMonths.push(monthName);  // Add the month name to the categories
    //     finalCounts.push(grw_cnt.cnt || 0);  // Use the count from grwMap, or 0 if not found
    // });

    // console.log(grwMap);

    var options = {
        series: [{
            name: 'Growth',
            data: counts,
            type: 'column',
        }

        ],
        chart: {
            height: 350,
            type: 'line',
            stacked: false,
        },
        stroke: {
            width: [0, 2, 5],
            curve: 'smooth'
        },
        colors: ['#0427B9'],
        plotOptions: {
            bar: {
                columnWidth: '45%',
                distributed: true,
                borderRadius: 0,
            },
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: months,
            labels: {
                style: {
                    fontSize: '6px',
                    fontWeight: 500,
                },
            },
        },
        yaxis: {
            title: {
                text: 'Points',
            }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " points";
                    }
                    return y;
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart5"), options);
    chart.render();
</script>

<script>

    // Pass the PHP arrays to JavaScript
    var tar_months = <?php echo json_encode($tar_months); ?>;
    var percentages = <?php echo json_encode($percentages); ?>;


    // Chart 6
    var options = {
        series: [{
            name: 'Completed',
            data: percentages
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    position: 'top',
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },

        xaxis: {
            categories: tar_months,
            position: 'bottom',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + "%";
                }
            }

        },
        title: {
            text: 'Monthly Target',
            floating: true,
            offsetY: 350,
            align: 'center',
            style: {
                color: '#444'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart6"), options);
    chart.render();
</script>

<script>
    //     // Example: Dynamically generating data for lines
    // var dynamicData = [
    //   { name: "Session Duration", data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10] },
    //   { name: "Page Views", data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35] },
    //   { name: "Total Visits", data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47] },
    //   // Add more data sets as needed, e.g.
    //   { name: "New Visitors", data: [20, 35, 30, 45, 50, 38, 48, 56, 41, 33, 42, 37] }
    //   // You can add more data objects dynamically
    // ];

    // // Dynamically build the series from the data
    // var seriesData = dynamicData.map(function (item) {
    //   return {
    //     name: item.name,
    //     data: item.data,
    //     type: 'line' // All series are of type 'line', you can customize this for each if needed
    //   };
    // });

    // // Dynamic chart options
    // var options = {
    //   series: seriesData,  // Use the dynamically generated series
    //   chart: {
    //     height: 350,
    //     type: 'line',
    //     zoom: {
    //       enabled: false
    //     }
    //   },
    //   dataLabels: {
    //     enabled: false
    //   },
    //   stroke: {
    //     width: [5, 7, 5], // You can dynamically adjust this if needed
    //     curve: 'straight',
    //     dashArray: [0, 8, 5]
    //   },
    //   title: {
    //     text: 'Page Statistics',
    //     align: 'left'
    //   },
    //   legend: {
    //     tooltipHoverFormatter: function (val, opts) {
    //       return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + '</strong>';
    //     }
    //   },
    //   markers: {
    //     size: 0,
    //     hover: {
    //       sizeOffset: 6
    //     }
    //   },
    //   xaxis: {
    //     categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan', '10 Jan', '11 Jan', '12 Jan']
    //   },
    //   tooltip: {
    //     y: [
    //       {
    //         title: {
    //           formatter: function (val) {
    //             return val + " (mins)";
    //           }
    //         }
    //       },
    //       {
    //         title: {
    //           formatter: function (val) {
    //             return val + " per session";
    //           }
    //         }
    //       },
    //       {
    //         title: {
    //           formatter: function (val) {
    //             return val;
    //           }
    //         }
    //       }
    //     ]
    //   },
    //   grid: {
    //     borderColor: '#f1f1f1',
    //   }
    // };

    // // Render the chart
    // var chart = new ApexCharts(document.querySelector("#chart"), options);
    // chart.render();
</script>

<!-- CRM Table -->
<script>
    $(document).ready(function () {
        var table = $('.example').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "bDestroy": true,
            "info": false,
            "responsive": true,
            "pageLength": 10,
            "dom": '<"top"f>rt<"bottom"lp><"clear">'
        });

    });
</script>

</html>