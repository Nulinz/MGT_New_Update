<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval List</title>

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
                    <h4 class="m-0">Approval List</h4>
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
                                    <th>Employee Name/Code</th>
                                    <th>Start  - End</th>
                                    <th>Type</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $link = $db->link();
                                $s_lt = "SELECT * from `e_leave`";
                                $q_lt = mysqli_query($link,$s_lt);
                                $i=1;
                                while($d_lt = mysqli_fetch_assoc($q_lt)){
                                        $emp_dt = $fetch->table_list_id('m_emp','id',$d_lt['c_by']);
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $emp_dt['name']; ?> - [<?php echo $emp_dt['emp_code']; ?>]</td>
                                    <td><?php echo date("d-m-Y",strtotime($d_lt['s_date'])); ?> - <?php echo date("d-m-Y",strtotime($d_lt['e_date'])); ?></td>
                                    <td><?php echo $d_lt['type']; ?>  <?php echo ($d_lt['type']=='Permission') ? "- ".$d_lt['hrs']." Hrs" : ''; ?></td>
                                    <td><?php echo $d_lt['reason']; $status = $d_lt['status']; ?> </td>
                                    <td>
                                        <?php
                                        if($status=="request"){
                                        ?>
                                        <button class="listtdbtn lv_up" data-bs-toggle="modal" data-id="<?php echo $d_lt['id']; ?>"
                                        data-bs-target="#updateApproval">Request</button>
                                            <?php
                                        }else{
                                            echo $status;
                                        }
                                        ?>
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
                    <form action="up_ajax.php" method="POST">
                        <input hidden  name="lv_id" id="lv_id">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="sts" class="col-form-label">Status</label>
                            <select class="form-select" name="sts" id="sts">
                                <option value="" selected disabled>Select Options</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <!-- <div class="col-sm-12 col-md-12 mb-3" id="reason-section" style="display: none;">
                            <label for="reason" class="col-form-label">Reason</label>
                            <textarea class="form-control" name="reason" id="reason"
                                placeholder="Enter Reason"></textarea>
                        </div> -->
                        <div class="d-flex justify-content-center align-items-center mx-auto">
                            <input hidden type="text" name="lv_id_up">
                             <button type="submit" class="modalbtn">Update</button>
                        </div>
                    </form>
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

$('.lv_up').on('click',function(){

var lv_id = $(this).attr('data-id');
// console.log(lv_id);

            $('#lv_id').val(lv_id);

//    $.ajax({
//        url: 'up_ajax.php', // URL where the status update is handled
//        type: 'POST',
//        data: {
//         lv_id: lv_id,
//        },
//        success: function (response) {
//            // console.log('Task status updated successfully:', response);
//         //    $('#assign_form').html(response);
//        },
//        error: function (xhr, status, error) {
//            console.error('Error updating task status:', error);
//        }
//    });


});

</script>

</html>