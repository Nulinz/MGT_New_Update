<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice List</title>

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
                    <h4 class="m-0">Invoice List</h4>
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
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Quotation No</th>
                                    <th>Project Name</th>
                                    <th>Company</th>
                                    <th>Service</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $inv_lt = $fetch->table_list_arr('m_inv', 'status', 'Active');
                                $i = 1;
                                foreach ($inv_lt as $inv) {
                                    $pro_id = $inv['f_id'];
                                    $pro = $fetch->table_list_id('m_pro', 'id', $pro_id);
                                    $inv_ser = $fetch->inv_list($inv['id'], 'inv');

                                    $com_lt = $fetch->table_list_id('m_cmp', 'id', $pro['c_id']);
                                    //  print_r($inv_ser);
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>00<?php echo $inv['id']; ?>/24-25</td>
                                        <td><?php echo date("d-m-Y", strtotime(DATE($inv['c_on']))); ?></td>
                                        <td>Q_No - <?php echo $inv['q_id']; ?></td>
                                        <td><?php echo $pro['title']; ?></td>
                                        <td><?php echo $com_lt['c_name']; ?></td>
                                        <td>
                                            <?php
                                            $sum = [];
                                            foreach ($inv_ser as $index => $in_li) {
                                                // Fetch the title for the current item
                                                $ser_list = $fetch->table_list_id('m_service', 'id', $in_li['ser']);

                                                // Echo the title
                                                echo $ser_list['ser_name'];

                                                // Add a comma unless it's the last item in the array
                                                if ($index < count($inv_ser) - 1) {
                                                    echo ",";
                                                }

                                                $sum[] = $in_li['cost'];
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo array_sum($sum); ?></td>
                                        <td>
                                            <div class="d-flex gap-3 align-items-center">
                                                <a href="./pdf_quotation.php?quot=<?php echo $inv['id']; ?>&type=inv"><i
                                                        class="fa-solid fa-print"></i></a>
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

    <!-- Update Approval Modal -->
    <div class="modal fade" id="updateApproval" tabindex="-1" aria-labelledby="updateApprovalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="updateApprovalLabel">Update Approval</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="sts" class="col-form-label">Status</label>
                            <select class="form-select" name="sts" id="sts">
                                <option value="" selected disabled>Select Options</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3" id="reason-section" style="display: none;">
                            <label for="reason" class="col-form-label">Reason</label>
                            <textarea class="form-control" name="reason" id="reason"
                                placeholder="Enter Reason"></textarea>
                        </div>
                    </form>
                    <div class="d-flex justify-content-center align-items-center mx-auto">
                        <button type="button" class="modalbtn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

<script>
    $(document).ready(function () {
        $("#sts").change(function () {
            var status = $(this).val();
            $("#reason-section").hide();
            $("#reason-section").prop("required", false);
            if (status === "Rejected") {
                $("#reason-section").show();
                $("#reason-section").prop("required", true);
            }
        })
    })
</script>

</html>