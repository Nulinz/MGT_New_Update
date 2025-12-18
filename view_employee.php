<?php
include('fetch.php');

if (isset($_GET['emp'])) {
    $emp_id = $_GET['emp'];
}

$db_link = $db->link();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/list.css">

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
                        <h6 class="m-0">Employee Details</h6>
                    </div>
                </div>

                <div class="mainbdy">
                    <div class="accordion border-0" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    Employee Details
                                </button>
                            </h2>
                            <?php
                            $ed = $fetch->table_list_id('m_emp', 'id', $emp_id);

                            if (!empty($ed['profile'])) {
                                $fi = $ed['profile'];
                            } else {
                                $fi = 'avatar.png';
                            }

                            ?>
                            <div id="collapse1" class="accordion-collapse collapse py-2"
                                data-bs-parent="#accordionExample">
                                <div class="emphead">
                                    <div class="empleft">
                                        <img src="./img/<?php echo $fi; ?>" height="175px" alt="">
                                    </div>
                                    <div class="empright row">
                                        <a class="editicon" href="./edit_employee.php?emp_id=<?php echo $emp_id; ?>"
                                            data-bs-toggle="tooltip" data-bs-title="Edit Employee">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Employee Code</h6>
                                            <h5 class="mb-0"><?php echo $ed['emp_code']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Name</h6>
                                            <h5 class="mb-0"><?php echo $ed['name']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Date Of Birth</h6>
                                            <h5 class="mb-0"><?php echo date("d-m-Y", strtotime($ed['dob'])); ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Gender</h6>
                                            <h5 class="mb-0"><?php echo $ed['gender']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Marital Status</h6>
                                            <h5 class="mb-0"><?php echo $ed['marital']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Email ID</h6>
                                            <h5 class="mb-0"><?php echo $ed['email']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Contact Number</h6>
                                            <h5 class="mb-0"><?php echo $ed['contact']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Aadhar Number</h6>
                                            <h5 class="mb-0"><?php echo $ed['aadhar']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Qualification</h6>
                                            <h5 class="mb-0"><?php echo $ed['qualification']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Year Of Graduation</h6>
                                            <h5 class="mb-0"><?php echo $ed['year']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Address</h6>
                                            <h5 class="mb-0"><?php echo $ed['address']; ?></h5>
                                        </div>
                                        <?php
                                        if (($ed['gender'] == 'Female') && ($ed['marital'] == 'Single')):
                                            ?>
                                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                                <h6 class="mb-1">Expected Marriage Date</h6>
                                                <h5 class="mb-0"><?php echo $ed['exp_mrg']; ?></h5>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="proftabs">
                        <ul class="nav nav-tabs d-flex justify-content-start align-items-center gap-md-3 gap-xl-3"
                            id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="details-tab" role="tab" data-bs-toggle="tab"
                                    type="button" data-bs-target="#details" aria-controls="details"
                                    aria-selected="true">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="salary-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#salary" aria-controls="salary"
                                    aria-selected="false">Salary</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="projects-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#projects" aria-controls="projects"
                                    aria-selected="false">Projects</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="remarks-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#remarks" aria-controls="remarks"
                                    aria-selected="false">Remarks</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="performance-tab" role="tab" data-bs-toggle="tab"
                                    type="button" data-bs-target="#performance" aria-controls="performance"
                                    aria-selected="false">Performance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="report-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#report" aria-controls="report"
                                    aria-selected="false">Report</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel"
                            aria-labelledby="details-tab">
                            <?php include('./emp_details.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">
                            <?php include('./emp_salary.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">
                            <?php include('./emp_projects.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                            <?php include('./emp_remarks.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab">
                            <?php include('./emp_performance.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                            <?php include('./emp_report.php'); ?>
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
    });
</script>

</html>