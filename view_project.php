<?php

include('fetch.php');

if(isset($_GET['pro'])){
    $pro_id = $_GET['pro'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/tracking.css">

</head>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 mb-4">
                <div class="sidebodyback my-3" onclick="goBack()">
                    <div class="backhead">
                        <h5 class="m-0"><i class="fas fa-arrow-left"></i></h5>
                        <h6 class="m-0">Project Details</h6>
                    </div>
                </div>

                <div class="mainbdy">
                    <div class="accordion border-0" id="accordionExample">
                        <div class="accordion-item">
                            <?php
                            $pro_det = $fetch->table_list_id('m_pro','id',$pro_id);
                            $cmp_det = $fetch->table_list_id('m_cmp','id',$pro_det['c_id']);
                            // echo "<pre>";
                            // print_r($cmp_det);
                            // $ag_arr = json_decode($pro_det['agree']);
                            // $a_last = end($ag_arr);

                            $plat_arr = json_decode($pro_det['plat_form']);
                            $p_last = end($plat_arr);

                            $tech_arr = json_decode($pro_det['tech']);
                            $t_last = end($tech_arr);
                            ?>
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <?php echo $pro_det['title'];?> - <?php echo $cmp_det['c_name']; ?>
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse py-2"
                                data-bs-parent="#accordionExample">
                                <div class="emphead d-block">
                                    <div class="empright row">
                                        <a class="editicon" href="./edit_project.php?pro=<?php echo $pro_id; ?>" data-bs-toggle="tooltip"
                                            data-bs-title="Edit Project">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Project Title</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['title'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Lead Type</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['lead'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Service Type</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['service'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">E-Commerce</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['e_com'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">No. Of People Using</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['no_user'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Roles</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['roles'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Purpose</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['purpose'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Project Value</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['pro_val'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Technology</h6>
                                            <h5 class="mb-0">
                                            <?php
                                                foreach($tech_arr as $te){
                                                    if ($te === $t_last) {
                                                        echo $te;  // Print the last element without a comma
                                                    } else {
                                                        echo $te . ', ';  // Print with a comma for others
                                                    }
                                                }
                                                ?>
                                            </h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Estimates Start Date</h6>
                                            <h5 class="mb-0"><?php echo date("d-m-Y",strtotime($pro_det['st_date']));?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Required Date</h6>
                                            <h5 class="mb-0"><?php echo date("d-m-Y",strtotime($pro_det['re_date']));?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Payment Terms</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['pay_term'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Agreement</h6>
                                            <h5 class="mb-0">
                                                <?php
                                                // foreach($ag_arr as $ag){
                                                //     if ($ag === $a_last) {
                                                //         echo $ag;  // Print the last element without a comma
                                                //     } else {
                                                //         echo $ag . ', ';  // Print with a comma for others
                                                //     }
                                                // }
                                                ?>
                                            </h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Platform</h6>
                                            <h5 class="mb-0">
                                            <?php
                                                foreach($plat_arr as $pl){
                                                    if ($pl === $p_last) {
                                                        echo $pl;  // Print the last element without a comma
                                                    } else {
                                                        echo $pl . ', ';  // Print with a comma for others
                                                    }
                                                }
                                                ?>
                                            </h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Why they need Software</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['need_soft'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">What was the current issues in system</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['current'];?></h5>
                                        </div>
                                        <?php
                                            $emp = $fetch->table_list_id('m_emp','id',$pro_det['assign']);
                                        ?>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Assign To</h6>
                                            <h5 class="mb-0"><?php echo $emp['name']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Category</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['cat'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Sub Category</h6>
                                            <h5 class="mb-0"><?php echo $pro_det['sub_cat'];?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Points</h6>
                                            <h5 class="mb-0">25</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="proftabs">
                        <ul class="nav nav-tabs d-flex justify-content-start align-items-center gap-md-3 gap-xl-3" id="myTab"
                            role="tablist">
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="followups-tab" role="tab" data-bs-toggle="tab"
                                    type="button" data-bs-target="#followups" aria-controls="followups"
                                    aria-selected="true">Follow-Ups</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="projecttrack-tab" role="tab" data-bs-toggle="tab"
                                    type="button" data-bs-target="#project-track" aria-controls="project"
                                    aria-selected="false">Project Tracking</button>
                            </li> -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="quotation-tab" role="tab" data-bs-toggle="tab"
                                    type="button" data-bs-target="#quotation" aria-controls="quotation"
                                    aria-selected="false">Quotation</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="invoice-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#invoice" aria-controls="invoice"
                                    aria-selected="false">Invoice</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="document-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#document" aria-controls="document"
                                    aria-selected="false">Document</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payment-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#payment" aria-controls="payment"
                                    aria-selected="false">Payment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="notes-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#notes" aria-controls="notes" aria-selected="false">Notes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="meeting-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#meeting" aria-controls="meeting" aria-selected="false">Meetings</button>
                            </li>
                            <?php

                            $link = $db->link();

                            $s_tk = "SELECT * from `m_task` where `pro_id`='$pro_id' order by `id` DESC ";
                            $q_tk = mysqli_query($link,$s_tk);
                            $d_tk = mysqli_fetch_assoc($q_tk);
                            // print_r($d_tk);

                            ?>
                            <li class="nav-item d-flex justify-content-end align-items-center ms-auto" role="presentation">
                                <a href="./view_task.php?task_id=<?php echo $d_tk['id']; ?>" class="tabh6"><h6 class="tabh6 m-0"><i class="fa-solid fa-arrow-up-right-from-square"></i> &nbsp;View Task</h6></a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <?php /*
                        <div class="tab-pane fade show active" id="followups" role="tabpanel"
                            aria-labelledby="followups-tab">
                            <?php include('./prjt_followups.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="project-track" role="tabpanel" aria-labelledby="projects-tab">
                            <?php include('./prjt_projecttrack.php'); ?>
                        </div>
                        */ ?>
                        <div class="tab-pane fade show active" id="quotation" role="tabpanel" aria-labelledby="quotation-tab">
                            <?php include('./prjt_quotation.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                            <?php include('./prjt_invoice.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="documents-tab">
                            <?php include('./prjt_document.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <?php include('./prjt_payment.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <?php include('./prjt_notes.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="meeting" role="tabpanel" aria-labelledby="meeting-tab">
                            <?php include('./prjt_meeting.php'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>
    $(document).ready(function () {
        function initTable(tableId, dropdownId, filterInputId) {
            var table = $(tableId).DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "order": [0, "asc"],
                "bDestroy": true,
                "info": false,
                "responsive": true,
                "pageLength": 30,
                "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            });
            $(tableId + ' thead th').each(function (index) {
                var headerText = $(this).text();
                if (headerText != "" && headerText.toLowerCase() != "action") {
                    $(dropdownId).append('<option value="' + index + '">' + headerText + '</option>');
                }
            });
            $(filterInputId).on('keyup', function () {
                var selectedColumn = $(dropdownId).val();
                if (selectedColumn !== 'All') {
                    table.column(selectedColumn).search($(this).val()).draw();
                } else {
                    table.search($(this).val()).draw();
                }
            });
            $(dropdownId).on('change', function () {
                $(filterInputId).val('');
                table.search('').columns().search('').draw();
            });
            $(filterInputId).on('keyup', function () {
                table.search($(this).val()).draw();
            });
        }
        // Initialize each table
        initTable('#table1', '#headerDropdown1', '#filterInput1');
        initTable('#table2', '#headerDropdown2', '#filterInput2');
        initTable('#table3', '#headerDropdown3', '#filterInput3');
        initTable('#table4', '#headerDropdown4', '#filterInput4');
        initTable('#table5', '#headerDropdown5', '#filterInput5');
        initTable('#table6', '#headerDropdown6', '#filterInput6');
        initTable('#table7', '#headerDropdown7', '#filterInput7');
    });
</script>

</html>