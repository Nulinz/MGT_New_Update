<?php
include('fetch.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/list.css">

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
                    <h4 class="m-0">Dashboard</h4>
                    <!-- <div class="sdbdysearch">
                        <input type="text" class="form-control border-0" name="" id="">
                        <button>
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </div> -->
                </div>

                <!-- Dashboard buttons -->
                <?php include('./dashboard_btns.php'); ?>
                <?php


                // echo $avg_growth;
                
                $exp_chart = $fetch->dash_exp_inc();
                // echo "<pre>";
                // print_r($exp_chart);
                
                $box1 = $fetch->dash_box1('overall');
                $box2 = $fetch->dash_box1('month');
                $box3 = $fetch->dash_box3();
                //  echo $box3;
                //  echo "<pre>";
                // print_r($box3);
                

                ?>

                <div class="container px-0 mt-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">QV &nbsp;<span>vs</span>&nbsp; INV</h6>
                                </div>
                                <h2 class="card1h2"><span>₹&nbsp;</span><?php echo ($box1[0]) - ($box1[1]); ?></h2>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">MINV</h6>
                                </div>
                                <h2 class="card1h2"><span>₹&nbsp;</span><?php echo $box2[1]; ?></h2>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">GST</h6>
                                </div>
                                <h2 class="card1h2"><span>₹&nbsp;</span> <?php echo $box3[0] ?? 0; ?> /
                                    <?php echo $box3[1] ?? 0; ?>
                                </h2>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">EXP</h6>
                                </div>
                                <h2 class="card1h2"><span>₹&nbsp;</span> <?php echo ($box3[2] + $box3[3]) ?? 0; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-xl-6 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <!-- <h6 class="card1h6 mb-2">Growth Rate Average</h6>
                                    <h6 class="card2h6 mb-2"><span>Value:</span> -->
                                    </h6>
                                </div>
                                <div id="chart1"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-6 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">EXP &nbsp;<span>vs</span>&nbsp; INC</h6>
                                </div>
                                <canvas id="chart2" height="185"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Task List</h4>
                    </div>

                    <div class="container-fluid listtable">
                        <div class="filter-container row mb-3">
                            <div class="custom-search-container col-sm-12 col-md-8">
                                <select class="headerDropdown form-select filter-option">
                                    <option value="All" selected>All</option>
                                </select>
                                <input type="text" id="customSearch" class="form-control filterInput"
                                    placeholder=" Search">
                            </div>

                            <div class="select1 col-sm-12 col-md-3 mx-auto">
                                <div class="d-flex gap-3">
                                    <a href="" id="pdfLink"><img src="./images/printer.png" id="print" alt=""
                                            height="35px"></a>
                                    <a href="" id="excelLink"><img src="./images/excel.png" id="excel" alt=""
                                            height="35px"></a>
                                </div>
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
                                    $tk_tbl = $fetch->task_list_status();
                                    //    print_r($tk_tbl);
                                    $i = 1;
                                    foreach ($tk_tbl as $td) {

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
                                            <td><?php echo date("d-m-Y", strtotime($td['st_date'])); ?></td>
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

            </div>
        </div>

    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>
    // DataTables List
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

<!-- Chart 1 -->
<script>

    // var options = {
    //     series: [{
    //         data: counts
    //     }],
    //     chart: {
    //         height: 300,
    //         type: 'bar',
    //         events: {
    //             click: function (chart, w, e) {
    //             },
    //         },
    //     },
    //     colors: ['#0427B9'],
    //     plotOptions: {
    //         bar: {
    //             columnWidth: '45%',
    //             distributed: true,
    //             borderRadius: 0,
    //         },
    //     },
    //     dataLabels: {
    //         enabled: false
    //     },
    //     legend: {
    //         show: false
    //     },
    //     xaxis: {
    //         categories: months,
    //         labels: {
    //             style: {
    //                 fontSize: '6px',
    //                 fontWeight: 500,
    //             },
    //         },
    //     },
    // };

    // var chart = new ApexCharts(document.querySelector("#chart1"), options);
    // chart.render();
</script>

<!-- Chart 2 -->
<script>

    const data1 = <?php echo json_encode($exp_chart); ?>;

    // Extract the month names as labels - use the `mon_nm` field for months
    const labels = [...new Set([
        ...data1.exp.map(item => item.mon_nm),  // Get months from expenses
        ...data1.inc.map(item => item.mon_nm)   // Get months from income
    ])].sort((a, b) => {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return months.indexOf(a) - months.indexOf(b);
    }); // Sort labels in order of months

    console.log(labels);




    var exp_dt = data1.exp.map(exp_it => exp_it.amt)
    var inc_dt = data1.inc.map(item => item.amt); // [225, 1015];


    // Line
    const chartTwo = document.getElementById("chart2");
    Chart.defaults.global.defaultFontColor = "#000";
    let linechart = new Chart(chartTwo, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: 'Expenses',
                data: exp_dt,
                borderColor: '#FF7E1D',
                backgroundColor: 'rgba(255, 126, 29, 0.2)',
                borderWidth: 1,
            },
            {
                label: 'Income',
                data: inc_dt,
                borderColor: '#F1F600',
                backgroundColor: 'rgba(241, 246, 0, 0.2)',
                borderWidth: 1,
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#888',
                        zeroLineColor: '#888',
                        borderDash: [1, 1]
                    },
                    ticks: {
                        fontColor: '#888',
                        beginAtZero: false,
                        callback: function (value, index, values) {
                            return value >= 1000 ? value / 1000 + 'k' : value;
                        }
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#eee',
                        zeroLineColor: '#eee',
                        borderDash: [1, 1]
                    },
                    ticks: {
                        fontColor: '#888',
                        beginAtZero: false,
                    }
                }]
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: 'black',
                    fontSize: 10,
                    fontStyle: 'normal',
                    backgroundColor: 'transparent'
                }
            },
        },
    });
</script>

</html>