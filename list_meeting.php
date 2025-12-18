<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting List</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
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
                    <h4 class="m-0">Meeting List</h4>
                </div>

                <div class="mt-3 listtable">
                    <div class="filter-container row mb-3">
                        <div class="custom-search-container col-sm-12 col-md-8">
                            <select class="form-select filter-option" id="headerDropdown7">
                                <option value="All" selected>All</option>
                            </select>
                            <input type="text" id="filterInput7" class="form-control" placeholder=" Search">
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
                                    <th>Project Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Date/Time</th>
                                    <th>Link / Location</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $meet_lt = $fetch->table_list_arr('m_meeting', 'status', 'upcoming');
                                $m = 1;
                                foreach ($meet_lt as $mt) {

                                    $meet_arr = json_decode($mt['emp']);
                                    $m_last = end($meet_arr);

                                    if (in_array($emp_log, $meet_arr)) {

                                        $pro_lt = $fetch->table_list_id('m_pro', 'id', $mt['f_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $m++; ?></td>
                                            <td><?php echo $pro_lt['title']; ?></td>
                                            <td><?php echo $mt['m_type']; ?></td>
                                            <td><?php echo $mt['des']; ?></td>
                                            <td><?php echo date("d-m-Y h:m", strtotime($mt['date'] . $mt['time'])); ?></td>

                                            <td>
                                                <div class="d-flex gap-3">
                                                    <?php
                                                    if ($mt['m_type'] == 'online') {
                                                        ?>
                                                        <a href="<?php echo $mt['loc']; ?>" target="_blank"><i
                                                                class="fa-solid fa-link text-primary"></i><?php echo $mt['loc']; ?></a>
                                                        <?php
                                                    } else {
                                                        echo $mt['loc'];
                                                    }
                                                    ?>


                                                </div>
                                            </td>
                                            <!-- <td>Completed</td> -->
                                        </tr>
                                        <?php
                                    }
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