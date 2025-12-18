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
    <title>Employee Task List</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/modal.css">

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
                    <h4 class="m-0">Schedule</h4>
                    <?php // include('./task_tabs.php'); ?>
                </div>

                <div class="container-fluid mt-4 listtable">
                    <div class="filter-container row mb-3">
                        <div class="custom-search-container col-sm-12 col-md-8">
                            <select class="headerDropdown form-select filter-option">
                                <option value="All" selected>All</option>
                            </select>
                            <input type="text" id="customSearch" class="form-control filterInput" placeholder=" Search">
                        </div>

                        <div class="select1 col-sm-12 col-md-4 mx-auto">
                            <div class="d-flex gap-3">
                                <a href="" id="pdfLink"><img src="./images/printer.png" id="print" alt="" height="35px"
                                        data-bs-toggle="tooltip" data-bs-title="Print"></a>
                                <a href="" id="excelLink"><img src="./images/excel.png" id="excel" alt="" height="35px"
                                        data-bs-toggle="tooltip" data-bs-title="Excel"></a>
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
                                $s_sch = "SELECT * from `m_pro_task` where `task_for`='$emp_log' and `status`='schedule' order by `id` DESC";
                                $q_sch = mysqli_query($link, $s_sch);
                                $i = 1;

                                while ($tk_tbl = mysqli_fetch_assoc($q_sch)) {
                                    $pro_det = $fetch->table_list_id('m_pro', 'id', $tk_tbl['pro_id']);
                                    $cmp_id = $pro_det['c_id'];
                                    $cmp_det = $fetch->table_list_id('m_cmp', 'id', $cmp_id);
                                    $emp_det = $fetch->table_list_id('m_emp', 'id', $tk_tbl['task_for']);
                                    ?>
                                    <tr>
                                        <td><?php echo $i;
                                        $i++; ?></td>
                                        <td><?php echo $pro_det['title']; ?></td>
                                        <td><?php echo $cmp_det['c_name']; ?></td>
                                        <td><?php echo $tk_tbl['task']; ?> - <?php echo $tk_tbl['sub']; ?></td>
                                        <td><?php echo $emp_det['name']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($tk_tbl['st_date'])); ?></td>
                                        <td>
                                            <div class="d-flex gap-3 align-items-center">
                                                <a target="__blank"
                                                    href="./view_emp_task.php?tk_id=<?php echo $tk_tbl['id']; ?>"
                                                    data-bs-toggle="tooltip" data-bs-title="View Profile"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <a href="./up_ajax.php?tk_manual=<?php echo $tk_tbl['id']; ?>&tk_pro=<?php echo $tk_tbl['pro_id']; ?>"
                                                    data-bs-toggle="tooltip"
                                                    onclick="return confirm('Are you sure you want to Intialise Schedule Task?');">
                                                    <button class="listtdbtn">Intial</button>
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

</html>