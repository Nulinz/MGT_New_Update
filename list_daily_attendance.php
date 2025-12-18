<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Attendance List</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/form.css">

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
                    <h4 class="m-0">Daily Attendance List</h4>
                </div>

                <form action="" method="post" id="">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="att_date" id="date" autofocus>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="submit" name="attd_list" class="formbtn">Save</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['attd_list'])) {
                    $attd_date = $_POST['att_date'];

                    ?>

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
                                        <th>Employee Code</th>
                                        <th>Employee Name</th>
                                        <th>In-Time</th>
                                        <th>Out-Time</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $at_lt = $fetch->attd_list_arr('e_login', 'DATE(c_on)', $attd_date);
                                    // print_r($at_lt);
                                    $i = 1;
                                    foreach ($at_lt as $at) {

                                        $emp_dt = $fetch->table_list_id('m_emp', 'id', $at['f_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $emp_dt['emp_code']; ?></td>
                                            <td><?php echo $emp_dt['name']; ?></td>
                                            <td><?php echo date("h:i", strtotime($at['login'])); ?></td>
                                            <td><?php echo date("h:i", strtotime($at['logout'])); ?></td>
                                            <td><?php echo $at['status']; ?></td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="./view_company.php" data-bs-toggle="tooltip"
                                                        data-bs-title="View Profile"><i class="fas fa-eye"></i></a>
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

                    <?php
                }
                ?>
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