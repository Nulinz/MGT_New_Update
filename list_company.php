<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company List</title>

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
                    <h4 class="m-0">Company List</h4>
                    <a href="./add_company.php"><button class="listbtn">+ Add Company</button></a>
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
                        if ($emp_role == 'Admin') {
                            ?>
                            <table class="example table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Category</th>
                                        <th>District</th>

                                        <th>Contact</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cmp_det = $fetch->table_list('m_cmp');
                                    $i = 1;
                                    foreach ($cmp_det as $cd) {

                                        $c_cat = $fetch->m_cat_id($cd['c_cat']);
                                        $c_type = $fetch->m_cat_id($cd['c_type']);
                                        $b_with = $fetch->m_cat_id($cd['b_with']);

                                        $emp_det = $fetch->table_list_id('m_emp', 'id', $cd['c_by']);

                                        ?>
                                        <tr>
                                            <td><?php echo $i;
                                            $i++; ?></td>
                                            <td><?php echo $cd['c_name']; ?></td>
                                            <td><?php echo $c_cat['title'] ?? 'No data'; ?></td>
                                            <td><?php echo $cd['dis']; ?></td>
                                            <td><?php echo $cd['contact']; ?></td>
                                            <td><?php echo $emp_det['name']; ?></td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a target="__blank" href="./view_company.php?com=<?php echo $cd['id']; ?>"
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
                                        <th>Company Name</th>
                                        <th>Category</th>
                                        <th>District</th>
                                        <th>Contact</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cmp_det = $fetch->table_list_arr('m_cmp', 'c_by', $emp_cook);
                                    $i = 1;
                                    foreach ($cmp_det as $cd) {

                                        $c_cat = $fetch->m_cat_id($cd['c_cat']);
                                        $c_type = $fetch->m_cat_id($cd['c_type']);
                                        $b_with = $fetch->m_cat_id($cd['b_with']);

                                        $emp_det = $fetch->table_list_id('m_emp', 'id', $cd['c_by']);


                                        ?>
                                        <tr>
                                            <td><?php echo $i;
                                            $i++; ?></td>
                                            <td><?php echo $cd['c_name']; ?></td>
                                            <td><?php echo $c_cat['title'] ?? 'No data'; ?></td>
                                            <td><?php echo $cd['dis']; ?></td>
                                            <td><?php echo $cd['contact']; ?></td>
                                            <td><?php echo $emp_det['name']; ?></td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a target="__blank" href="./view_company.php?com=<?php echo $cd['id']; ?>"
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