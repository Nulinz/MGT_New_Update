<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request List</title>

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
                    <h4 class="m-0">Leave Request List</h4>
                    <a href="./add_leave_request.php"><button class="listbtn">+ Add Request</button></a>
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
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Request Type</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $lv_lt = $fetch->table_list_arr('e_leave', 'c_by', $emp_cook);
                                $i = 1;
                                foreach ($lv_lt as $lv) {
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($lv['s_date'])); ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($lv['e_date'])); ?></td>
                                        <td><?php echo $lv['type']; ?> - <?php echo ($lv['type'] == 'Permission') ? "- " . $lv['hrs'] . " Hrs" : ''; ?></td>
                                        <td><?php echo $lv['reason']; ?></td>
                                        <td><?php echo $lv['status']; ?></td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <?php
                                                if($lv['status']=='request'){
                                                ?>
                                                <a target="__blank" href="./edit_request.php?req_id=<?php echo $lv['id']; ?>"
                                                    data-bs-toggle="tooltip" data-bs-title="View Profile"><i
                                                        class="fas fa-eye"></i></a>
                                                <?php
                                                }
                                                ?>
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
    $(document).ready(function() {
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