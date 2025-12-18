<?php
include('fetch.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dashboard</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/dashboard_crm.css">
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
                    <h4 class="m-0">Dashboard - Project</h4>
                    <!-- <div class="sdbdysearch">
                        <input type="text" class="form-control border-0" name="" id="">
                        <button>
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </div> -->
                </div>

                <!-- Dashboard buttons -->
                <?php include('./dashboard_btns.php'); ?>

                <div class="container px-0 mt-3">
                    <div class="row">
                        <!-- <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                            <div class="cards">
                                <div class="cardshead">
                                    <h6 class="card1h6 mb-2">Projects</h6>
                                    <h6 class="card2h6 mb-2"><span>Value:</span> 100</h6>
                                </div>
                                <div id="chart1"></div>
                            </div>
                        </div> -->
                        <div class="container-fluid mt-4 listtable">
                            <!-- <div class="filter-container row mb-3">
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
                            </div> -->

                            <div class="table-wrapper">
                                <table class=" table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project</th>
                                            <th>Task - Task For</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            $link = $db->link();
                                            $s_final = "SELECT DISTINCT mp.id, mp.title, mp.c_id
                                                        FROM `m_pro` as mp
                                                        JOIN `m_quot` as mq ON mp.id = mq.f_id
                                                        WHERE mq.status = 'final' ";
                                            $q_final = mysqli_query($link, $s_final);
                                            $i = 1;

                                            while ($pro_det = mysqli_fetch_assoc($q_final)) {
                                                $cmp_det = $fetch->table_list_id('m_cmp', 'id', $pro_det['c_id']);
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $pro_det['title']; ?> - <?php echo $cmp_det['c_name']; ?> </td>
                                                <td>
                                                    <?php
                                                    $pro_id = $pro_det['id'];
                                                    // Query to fetch open tasks
                                                    $s_tk = "SELECT * FROM `m_pro_task` WHERE `pro_id` = '$pro_id' AND `status` = 'open' ORDER BY `id` DESC";
                                                    $q_tk = mysqli_query($link, $s_tk);
                                                    $c_tk = mysqli_num_rows($q_tk);
                                                    // $last_id = null; // Initialize last_id

                                                    if ($c_tk > 0) {
                                                        // If there are open tasks, loop through them
                                                        while ($d_tk = mysqli_fetch_assoc($q_tk)) {
                                                            $emp_det = $fetch->table_list_id('m_emp', 'id', $d_tk['task_for']);
                                                          echo  $d_tk['title'] . " - " . $emp_det['name'] . "<br>";
                                                        }

                                                        // Assign the ID of the last task in the open tasks
                                                        // $last_id = $d_tk['id'];
                                                    } else {
                                                        // If no open tasks, fetch the loop task
                                                        $s_last = "SELECT * FROM `m_pro_task` WHERE `pro_id` = '$pro_id' AND `type` = 'loop' ORDER BY `id` DESC";
                                                        $q_last = mysqli_query($link, $s_last);
                                                        $d_last = mysqli_fetch_assoc($q_last);

                                                        // Display loop task details
                                                        $emp_det1 = $fetch->table_list_id('m_emp', 'id', $d_last['task_for']);
                                                        echo  $d_last['title'] . " - " . $emp_det1['name'] . "<br>";

                                                        // Assign the ID of the loop task
                                                        // $last_id = $d_last['id'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                     $s_last1 = "SELECT * FROM `m_pro_task` WHERE `pro_id` = '{$pro_det['id']}' AND `type` = 'loop' ORDER BY `id` DESC";
                                                    $q_last1 = mysqli_query($link, $s_last1);
                                                    $d_last1 = mysqli_fetch_assoc($q_last1);
                                                    ?>
                                                    <a href="view_emp_task.php?tk_id=<?php echo $d_last1['id']; ?>">View</a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>Company Activity</td>
                                                <td>
                                                    <?php
                                                     $s_last2 = "SELECT * FROM `m_pro_task` WHERE `pro_id` = '0' AND `type` = 'Manual' and `status`='open' ORDER BY `id` DESC";
                                                     $q_last2 = mysqli_query($link, $s_last2);
                                                     while($d_last2 = mysqli_fetch_assoc($q_last2)){
                                                        $emp_det2 = $fetch->table_list_id('m_emp', 'id', $d_last2['task_for']);
                                                            echo $d_last2['title']."-".$emp_det2['name'];
                                                     }
                                                    ?>
                                                </td>
                                                <td><a href="">View</a></td>
                                            </tr>
                                        </tbody>

                                </table>
                            </div>
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

<!-- <script>
    // Chart 1
    var options = {
        series: [
            {
                name: 'Lead',
                data: [
                    {
                        x: 'Aditya',
                        y: [
                            new Date('2019-03-02').getTime(),
                            new Date('2019-03-04').getTime()
                        ]
                    },
                    {
                        x: 'DLR',
                        y: [
                            new Date('2019-03-05').getTime(),
                            new Date('2019-03-08').getTime()
                        ]
                    },
                    {
                        x: 'Expert',
                        y: [
                            new Date('2019-03-08').getTime(),
                            new Date('2019-03-10').getTime()
                        ]
                    },
                    {
                        x: 'Fobas',
                        y: [
                            new Date('2019-03-11').getTime(),
                            new Date('2019-03-14').getTime()
                        ]
                    },
                    {
                        x: 'Rootments',
                        y: [
                            new Date('2019-03-15').getTime(),
                            new Date('2019-03-18').getTime()
                        ]
                    },
                ]
            },
            {
                name: 'Design',
                data: [
                    {
                        x: 'Aditya',
                        y: [
                            new Date('2019-03-15').getTime(),
                            new Date('2019-03-17').getTime()
                        ]
                    },
                    {
                        x: 'Expert',
                        y: [
                            new Date('2019-03-18').getTime(),
                            new Date('2019-03-19').getTime()
                        ]
                    },
                    {
                        x: 'DLR',
                        y: [
                            new Date('2019-03-20').getTime(),
                            new Date('2019-03-23').getTime()
                        ]
                    },
                    {
                        x: 'Rootments',
                        y: [
                            new Date('2019-03-24').getTime(),
                            new Date('2019-03-26').getTime()
                        ]
                    },
                    {
                        x: 'Fobas',
                        y: [
                            new Date('2019-03-27').getTime(),
                            new Date('2019-03-29').getTime()
                        ]
                    }
                ]
            },
            {
                name: 'Development',
                data: [
                    {
                        x: 'DLR',
                        y: [
                            new Date('2019-03-10').getTime(),
                            new Date('2019-03-17').getTime()
                        ]
                    },
                    {
                        x: 'Fobas',
                        y: [
                            new Date('2019-03-05').getTime(),
                            new Date('2019-03-09').getTime()
                        ]
                    },
                    {
                        x: 'DLR',
                        y: [
                            new Date('2019-03-25').getTime(),
                            new Date('2019-03-27').getTime()
                        ]
                    },
                    {
                        x: 'Rootments',
                        y: [
                            new Date('2019-03-24').getTime(),
                            new Date('2019-03-26').getTime()
                        ]
                    },
                    {
                        x: 'Expert',
                        y: [
                            new Date('2019-03-27').getTime(),
                            new Date('2019-03-29').getTime()
                        ]
                    }
                ]
            }
        ],
        chart: {
            height: 315,
            type: 'rangeBar'
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '80%',
                borderRadius: 5,
                distributed: true
            }
        },
        xaxis: {
            type: 'datetime'
        },
        tooltip: {
            x: {
                format: 'dd MMM yyyy', // Format the date on hover
            }
        },
        colors: ['#FF5733', '#4CAF50', '#2196F3']
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
</script> -->

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

</html>