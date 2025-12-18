<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Target List</title>

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
                    <h4 class="m-0">Target List</h4>
                    <a href="./add_target.php"><button class="listbtn">+ Add Target</button></a>
                </div>

                <form action="" method="POST" id="">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="month">Month</label>
                                <select class="form-select" name="mon" id="month" autofocus>
                                    <option value="" selected disabled>Select Options</option>
                                    <?php
                                    $link = $db->link();
                                    // Define an associative array with month number as the key and month name as the value
                                    $months = [
                                        "01" => "January",
                                        "02" => "February",
                                        "03" => "March",
                                        "04" => "April",
                                        "05" => "May",
                                        "06" => "June",
                                        "07" => "July",
                                        "08" => "August",
                                        "09" => "September",
                                        "10" => "October",
                                        "11" => "November",
                                        "12" => "December"
                                    ];

                                    foreach ($months as $key => $value) {

                                        $s_mon = "SELECT * from `m_target` where `mon`='$key'";
                                        $q_mon = mysqli_query($link, $s_mon);
                                        $d_mon = mysqli_num_rows($q_mon);

                                        if ($d_mon == 0) {
                                            continue;
                                        }

                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="year">Year</label>
                                <select class="form-select" name="year" id="year" required>
                                    <option value="2025" selected true>2025</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="submit" name="sh_bud" id="" class="formbtn">Save</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['sh_bud'])) {

                    $mon = $_POST['mon'];
                    $year = $_POST['year'];

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

                                        <th>Ledger Name</th>
                                        <th>TargetA</th>
                                        <th>Acheived</th>
                                        <th>Remaining</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $link = $db->link();
                                    $m_lt = $fetch->list_target($mon, $year);
                                    // print_r($m_lt);
                                    $i = 1;
                                    foreach ($m_lt as $m) {
                                        // $led_lt = $fetch->table_list_id('m_ledger','id',$m['led_id']);
                                

                                        $tr_amt = $m['target'];
                                        $pr_amt = $m['pro_amt'];
                                        $bal = $tr_amt - $pr_amt;

                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>

                                            <td><?php echo $m['emp_name']; ?></td>
                                            <td><?php echo $tr_amt; ?></td>
                                            <td><?php echo $pr_amt ?? 0; ?></td>
                                            <td><?php echo $bal; ?></td>

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