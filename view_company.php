<?php
include('fetch.php');

if (isset($_GET['com'])) {

    $com_id = $_GET['com'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Company</title>

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
                        <h6 class="m-0">Company Details</h6>
                    </div>
                </div>
                <?php
                $cmp_det = $fetch->table_list_id('m_cmp', 'id', $com_id);
                $c_cat = $fetch->m_cat_id($cmp_det['c_cat']);
                $c_type = $fetch->m_cat_id($cmp_det['c_type']);
                $b_with = $fetch->m_cat_id($cmp_det['b_with']);
                // print_r($cmp_det)
                ?>

                <div class="mainbdy">

                    <div class="accordion border-0" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <?php echo $cmp_det['c_name']; ?>
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse py-2"
                                data-bs-parent="#accordionExample">
                                <div class="emphead d-block">
                                    <div class="empright row">
                                        <a class="editicon" href="./edit_company.php?com=<?php echo $com_id; ?>" data-bs-toggle="tooltip"
                                            data-bs-title="Edit Company">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Company Name</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['c_name']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Company Category</h6>
                                            <h5 class="mb-0"><?php echo $c_cat['title']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Company Type</h6>
                                            <h5 class="mb-0"><?php echo $c_type['title']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Business With</h6>
                                            <h5 class="mb-0"><?php echo $b_with['title']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Contact Number</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['contact']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Email ID</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['mail']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">GST</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['gst']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Address</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['address']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">District</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['dis']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">State</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['state']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Pincode</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['pin']; ?></h5>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                                            <h6 class="mb-1">Website</h6>
                                            <h5 class="mb-0"><?php echo $cmp_det['web']; ?></h5>
                                        </div>
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
                                <button class="nav-link" id="projects-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#projects" aria-controls="projects"
                                    aria-selected="false">Projects</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel"
                            aria-labelledby="details-tab">
                            <?php include('./cmp_details.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">
                            <?php include('./cmp_projects.php'); ?>
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
    });
</script>

</html>