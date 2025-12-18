<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Budget List</title>

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
                    <h4 class="m-0">Monthly Pre Budget List</h4>
                    <a href="./pre_mon_budget.php"><button class="listbtn">+ Add Pre  Monthly Budget</button></a>
                </div>

                <form action="" method="post" id="">
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

                                        $s_mon = "SELECT * from `m_pre_bud` where `mon`='$key'";
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
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="submit" name="sh_bud" id="" class="formbtn">Save</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['sh_bud'])) {

                    $mon = $_POST['mon'];

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
                            <!-- <div class="select1 col-sm-12 col-md-4 mx-auto">
                                <div class="d-flex gap-3">

                                </div>
                            </div> -->
                        </div>

                        <div class="table-wrapper">
                            <table class=" table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $link = $db->link();
                                    $m_lt = $fetch->table_list_arr('m_pre_bud', 'mon', $mon);
                                    $i = 1;$amt1=0;
                                    foreach ($m_lt as $m) {
                                        // $led_lt = $fetch->table_list_id('m_ledger', 'id', $m['led_id']);

                                        $type =$m['type'];
                                        $amt = $m['amt'];


                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>

                                            <td><?php echo $type; ?></td>
                                            <td><?php echo $amt;$amt1 = $amt1+$amt; ?></td>
                                            <td>
                                                <div class="d-flex gap-3 align-items-center">
                                                    <a href="./edit_pre_budget.php?bud=<?php echo $m['id']; ?>"><i class="fa-solid fa-pen-to-square" onclick="return confirm('Are you sure you want to Edit the budget?');"></i></a>
                                                    <a href="./up_ajax.php?bud_del=<?php echo $m['id']; ?>" onclick="return confirm('Are you sure you want to Delete the budget?');"><i class="fa-solid fa-trash"></i></a>

                                                </div>
                                             </td>


                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>Total</td>
                                        <td><?php echo $amt1; ?></td>
                                        <td></td>
                                    </tr>
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