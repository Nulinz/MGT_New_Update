<?php
include('fetch.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads List</title>

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
                    <h4 class="m-0">Leads List</h4>
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
                                    <th>Name</th>
                                    <th>Contact Number</th>
                                    <th>Email ID</th>
                                    <th>Needs</th>
                                    <th>Industry</th>
                                    <th>Budget</th>
                                    <th>Preferred Time</th>
                                    <th>Message</th>
                                    <th>Created_on</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $con_pop = mysqli_connect('localhost', 'nuscmy3y_saran', 'sara@7811853020', 'nuscmy3y_nulinz_v2');
                                $con_pop = mysqli_connect('localhost', 'root', '', 'nulinz_management');
                                
                                $s_list = "select * from `popup_form`  order by `id` DESC";
                                $q_list = mysqli_query($con_pop,$s_list);
                                $i=1;
                                while($d_list = mysqli_fetch_assoc($q_list)){
                                
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $d_list['name']; ?></td>
                                    <td><?php echo $d_list['contactno']; ?></td>
                                    <td><?php echo $d_list['email']; ?></td>
                                    <td><?php echo $d_list['needs']; ?></td>
                                    <td><?php echo $d_list['industry']; ?></td>
                                    <td><?php echo $d_list['budget']; ?></td>
                                    <td><?php echo $d_list['preferredtime']; ?></td>
                                    <td><?php echo $d_list['message']; ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($d_list['c_by'])); ?></td>
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