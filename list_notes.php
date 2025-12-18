<?php
include('fetch.php');

if (isset($_GET['pro_id'])) {

    $pro_id = $_GET['pro_id'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes List</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/modal.css">

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
                    <h4 class="m-0">Notes List</h4>
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
                                    <th>Project Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Links</th>
                                    <th>Attachments</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['pro_id'])) {
                                    $link = $db->link();
                                    $s_note = "SELECT * from `m_notes` where `f_id`='{$_GET['pro_id']}'";
                                    $q_note = mysqli_query($link, $s_note);
                                    $p = 1;
                                    while ($d_note = mysqli_fetch_assoc($q_note)) {

                                        $pro_lt = $fetch->table_list_id('m_pro', 'id', $d_note['f_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $p++; ?></td>
                                            <td><?php echo $pro_lt['title']; ?></td>
                                            <td><?php echo $d_note['title']; ?></td>
                                            <td><?php echo $d_note['des']; ?></td>
                                            <td><?php echo $d_note['link']; ?></td>
                                            <td><a href="./img/<?php echo $d_note['file']; ?>" download>Download</a></td>

                                            <!-- <td>
                                        <div class="d-flex gap-3">
                                            <a href="" data-bs-toggle="tooltip" data-bs-title="View Profile"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td> -->
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    $pr_lt = $fetch->table_list_arr('m_notes', 'status', 'Active');
                                    $p = 1;
                                    foreach ($pr_lt as $pr) {
                                        $pro_lt = $fetch->table_list_id('m_pro', 'id', $pr['f_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $p++; ?></td>
                                            <td><?php echo $pro_lt['title']; ?></td>
                                            <td><?php echo $pr['title']; ?></td>
                                            <td><?php echo $pr['des']; ?></td>
                                            <td><?php echo $pr['link']; ?></td>
                                            <td><a href="./img/<?php echo $pr['file']; ?>" download>Download</a></td>
                                            <!-- <td>
                                        <div class="d-flex gap-3">
                                            <a href="" data-bs-toggle="tooltip" data-bs-title="View Profile"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td> -->
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