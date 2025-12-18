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
    <title>Task List</title>

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
                    <?php include('./task_tabs.php'); ?>
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
                        <?php
                        if ($emp_role == "Admin") {
                            ?>
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
                                    $tk_tbl = $fetch->task_list_arr_type($type);
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
                                                    <a target="__blank" href="./view_task.php?task_id=<?php echo $td['id']; ?>"
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
                            <?php
                        } else {
                            ?>
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
                                    $tk_tbl = $fetch->task_ind_type($emp_cook, $type);
                                    //    print_r($tk_tbl);
                                    $i = 1;
                                    foreach ($tk_tbl as $td) {

                                        $pro_det = $fetch->table_list_id('m_pro', 'id', $td['pro_id']);

                                        if (!$pro_det) {
                                            continue; // skip this row safely
                                        }

                                        $cmp_id = $pro_det['c_id'];

                                        $cmp_det = $fetch->table_list_id('m_cmp', 'id', $cmp_id);
                                        $emp_det = $fetch->table_list_id('m_emp', 'id', $td['task_for']);

                                        $cmp_name = $cmp_det['c_name'] ?? 'N/A';
                                        $emp_name = $emp_det['name'] ?? 'N/A';
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
                                                    <a target="__blank" href="./view_task.php?task_id=<?php echo $td['id']; ?>"
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
                            <?php
                        }
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