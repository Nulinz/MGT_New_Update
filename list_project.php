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
    <title>Project List</title>

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
                    <?php include('./project_tabs.php'); ?>
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
                                        <th>Start Date</th>
                                        <th>Required Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pro_det = $fetch->list_arr_type('m_pro', 'status', 'Active', $type);
                                    // print_r($pro_det);
                                    $i = 1;
                                    foreach ($pro_det as $pd) {

                                        $com = $fetch->table_list_id('m_cmp', 'id', $pd['c_id']);

                                        if ($pd['lead'] == "Hot") {
                                            $icon = 'text-danger';
                                        } elseif ($pd['lead'] == "Cold") {
                                            $icon = 'text-primary';
                                        } else {
                                            $icon = 'text-warning';
                                        }

                                        ?>
                                        <tr>
                                            <td><?php echo $i;
                                            $i++; ?></td>
                                            <td><i class="fa-solid fa-circle <?php echo $icon; ?>"
                                                    style="font-size: 10px;"></i>&nbsp; <?php echo $pd['title']; ?></td>
                                            <td><?php echo $com['c_name']; ?></td>
                                            <td><?php echo $pd['cat']; ?> - <?php echo $pd['sub_cat']; ?></td>
                                            <!-- <td><?php // echo $pd['lead']; ?></td> -->
                                            <td><?php echo date("d-m-Y", strtotime($pd['st_date'])); ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($pd['re_date'])); ?></td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a target="__blank" href="./view_project.php?pro=<?php echo $pd['id']; ?>"
                                                        data-bs-toggle="tooltip" data-bs-title="View Profile"><i
                                                            class="fas fa-eye"></i></a>
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
                                        <th>Start Date</th>
                                        <th>Required Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pro_det = $fetch->list_arr_type('m_pro', 'c_by', $emp_cook, $type);
                                    $i = 1;
                                    foreach ($pro_det as $pd) {

                                        $com = $fetch->table_list_id('m_cmp', 'id', $pd['c_id']);

                                        if ($pd['lead'] == "Hot") {
                                            $icon = 'text-danger';
                                        } elseif ($pd['lead'] == "Cold") {
                                            $icon = 'text-primary';
                                        } else {
                                            $icon = 'text-warning';
                                        }

                                        ?>
                                        <tr>
                                            <td><?php echo $i;
                                            $i++; ?></td>
                                            <td><i class="fa-solid fa-circle <?php echo $icon; ?>"
                                                    style="font-size: 10px;"></i>&nbsp; <?php echo $pd['title']; ?></td>
                                            <td><?php echo $com['c_name']; ?></td>
                                            <td><?php echo $pd['cat']; ?> - <?php echo $pd['sub_cat']; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($pd['st_date'])); ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($pd['re_date'])); ?></td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a target="__blank" href="./view_project.php?pro=<?php echo $pd['id']; ?>"
                                                        data-bs-toggle="tooltip" data-bs-title="View Profile"><i
                                                            class="fas fa-eye"></i></a>
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