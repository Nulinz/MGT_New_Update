<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Attendance List</title>

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
                    <h4 class="m-0">Monthly Attendance List</h4>
                </div>

                <form action="" method="post" id="">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="month">Month</label>
                                <!-- <select class="form-select" name="month" id="month" autofocus>
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select> -->
                                <input type="month" class="form-control" name="monthyear" id="monthyear">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="employee">Employee</label>
                                <select class="form-select" name="employee" id="employee">
                                    <option value="" selected disabled>Select Options</option>
                                    <?php
                                    $emp_det = $fetch->m_emp();
                                    foreach ($emp_det as $ed) {
                                        ?>
                                        <option value="<?php echo $ed['id']; ?>"><?php echo $ed['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="submit" name="mon_attd" class="formbtn">Save</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['mon_attd'])) {

                    $mon_arr = explode('-', $_POST['monthyear']);

                    $yr = $mon_arr[0];
                    $mon = $mon_arr[1];

                    $employee = $_POST['employee'];



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
                                        <th>Date</th>
                                        <th>Login</th>

                                        <th>Logout</th>

                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    $mon_attd = $fetch->mon_attd($mon, $employee);
                                    // print_r($mon_attd);
                                    $i = 1;
                                    foreach ($mon_attd as $mt) {
                                        // $emp_dt = $fetch->table_list_id('m_emp','id',$et['id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($mt['c_on'])); ?></td>
                                            <td><?php echo date("h:i", strtotime($mt['login'])); ?></td>
                                            <td><?php echo date("h:i", strtotime($mt['logout'])); ?></td>
                                            <td><?php echo $mt['status']; ?></td>
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