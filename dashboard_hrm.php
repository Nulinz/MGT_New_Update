<?php
include('fetch.php');

if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM Dashboard</title>

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
                    <h4 class="m-0">Dashboard - HRM</h4>
                    <!-- <div class="sdbdysearch">
                        <input type="text" class="form-control border-0" name="" id="">
                        <button>
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </div> -->
                </div>

                <!-- Dashboard buttons -->
                <?php
                if ($emp_role == "Admin") {
                    include('./dashboard_btns.php');
                }
                ?>

                <div class="container px-0 mt-3">
                    <div class="row">
                        <div class="container mb-4">
                            <div class="sidebodyhead">
                                <h4 class="m-0">Planning List</h4>
                            </div>

                            <div class="container-fluid mt-4 listtable">
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
                                            $link = $db->link();
                                            // $tk_tbl = $fetch->task_ind_type($emp_cook,$type);
                                            $s_task = "SELECT * FROM `m_task` WHERE `task_for`='$emp_cook'  and `task` = '$type'";
                                            $q_task = mysqli_query($link, $s_task);
                                            $i = 1;
                                            while ($td = mysqli_fetch_assoc($q_task)) {
                                                //    print_r($tk_tbl);
                                            
                                                // foreach ($tk_tbl as $td) {
                                            
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
                                                            <?php
                                                            $link = $db->link();
                                                            $s_sch = "SELECT * from `m_pro_task` where `pro_id`='{$td['pro_id']}' and `status` IN ('schedule','intialise') ";
                                                            $q_sch = mysqli_query($link, $s_sch);
                                                            $d_sch = mysqli_num_rows($q_sch);



                                                            if ($d_sch > 0) {

                                                                ?>
                                                                <a href="./up_ajax.php?pro_sch=<?php echo $td['pro_id']; ?>&old_tk=<?php echo $td['id']; ?>"
                                                                    data-bs-toggle="tooltip"
                                                                    onclick="return confirm('Are you sure you want to Intialise Schedule Task?');">
                                                                    <button class="listtdbtn">Initial</button>
                                                                </a>
                                                                <?php
                                                            } else {
                                                                ?>

                                                                <?php
                                                            }
                                                            ?>
                                                            <a href="./add_schedule.php?pro_id=<?php echo $td['pro_id']; ?>"
                                                                data-bs-toggle="tooltip" data-bs-title="Schedule">
                                                                <button class="listtdbtn">Schedule</button>
                                                            </a>
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

        </div>
    </div>

    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- script -->
    <?php include("./cdn_script.php"); ?>

</body>

<!-- HRM Table -->
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