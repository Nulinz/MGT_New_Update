<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

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
                    <h4 class="m-0">Employee List</h4>
                    <a href="./add_employee.php"><button class="listbtn">+ Add Employee</button></a>
                </div>

                <div class="container-fluid mt-4 listtable">
                    <div class="filter-container row mb-3">
                        <div class="custom-search-container col-sm-12 col-md-8">
                            <select class="headerDropdown form-select filter-option">
                                <option value="All" selected>All</option>
                            </select>
                            <input type="text" id="customSearch" class="form-control filterInput" placeholder=" Search">
                            <select id="statusFilter" class="form-select" style="width:200px;">
                                <option value="">All</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
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
                                    <th>Full Name</th>
                                    <th>Designation</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $emp_det = $fetch->table_list_arr('m_emp');
                                $i = 1;
                                foreach ($emp_det as $ed) {

                                    $emp_role = $fetch->table_list_id('m_emp2', 'f_id', $ed['id']);
                                    ?>
                                    <tr>
                                        <td><?php echo $i;
                                        $i++; ?></td>
                                        <td><?php echo $ed['emp_code']; ?></td>
                                        <td><?php echo $ed['name']; ?></td>
                                        <td><?php echo $emp_role['role'] ?? 'No data'; ?></td>
                                        <td><?php echo $ed['contact']; ?></td>
                                        <td>
                                            <span
                                                class="badge <?= $ed['status'] == 'Active' ? 'bg-success' : 'bg-danger'; ?>">
                                                <?= $ed['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a target="__blank" href="./view_employee.php?emp=<?php echo $ed['id']; ?>"
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
    $(document).ready(function () {

        // Initialize DataTable ONCE
        var table = $('.example').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: false,
            responsive: true,
            pageLength: 10,
            bDestroy: true,
        });

        // Status column index
        // 0:# 1:Code 2:Name 3:Role 4:Contact 5:Status 6:Action
        let STATUS_COLUMN_INDEX = 5;

        // Dropdown filter
        $('#statusFilter').on('change', function () {
            table.column(STATUS_COLUMN_INDEX).search(this.value).draw();
        });

    });
</script>



<script>
    let view_page = './list_prescription.php?ap_id=';
    let view_pres = './view_prescription.php?ap_id=';
    console.log(status);
    $('.view').on('click', function () {
        let id = $(this).attr('id');
        let status = $(this).closest('tr').find('.status').text().trim();
        let url;
        if (status === 'Active') {
            url = view_page + id;
        } else {
            url = view_pres + id;
        }
        window.open(url, '_blank');
    });

</script>

</html>