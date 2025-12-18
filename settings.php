<?php
include('fetch.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/profile.css">

</head>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 py-2 mb-3">
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Settings</h4>
                </div>

                <!-- Tabs -->
                <div class="proftabs">
                    <ul class="nav nav-tabs d-flex justify-content-start align-items-center gap-md-3" id="myTab"
                        role="tablist">
                        <?php
                        if (($emp_role == 'Admin') or ($emp_role == 'Human Resource')) {
                            ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="category-tab" role="tab" data-bs-toggle="tab"
                                    type="button" data-bs-target="#category" aria-controls="category"
                                    aria-selected="true">Category</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="subcat-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#subcat" aria-controls="subcat" aria-selected="true">Sub
                                    Category</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="service-tab" role="tab" data-bs-toggle="tab" type="button"
                                    data-bs-target="#service" aria-controls="service" aria-selected="false">Service</button>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($emp_role != 'Admin') ; ?>" id="password-tab" role="tab" data-bs-toggle="tab" type="button"
                                data-bs-target="#password-track" aria-controls="password"
                                aria-selected="false">Password</button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">

                    <?php
                    if (($emp_role == 'Admin') or ($emp_role == 'Human Resource')) {
                        ?>

                        <!-- Category Tab -->
                        <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
                            <?php include('./settings_category.php'); ?>
                        </div>

                        <!-- Category Tab -->
                        <div class="tab-pane fade" id="subcat" role="tabpanel" aria-labelledby="subcat-tab">
                            <?php include('./settings_subcat.php'); ?>
                        </div>

                        <!-- Service Tab -->
                        <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab">
                            <?php include('./settings_service.php'); ?>
                        </div>
                        <?php
                    }
                    ?>

                    <!-- Password Tab -->
                    <div class="tab-pane fade <?php echo ($emp_role != 'Admin') ? 'show active' : ''; ?>" id="password-track" role="tabpanel" aria-labelledby="password-tab">
                        <?php include('./settings_password.php'); ?>
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
    });
</script>

<script>
    function togglePasswordVisibility(inputId, showId, hideId) {
        let $input = $('#' + inputId);
        let $passShow = $('#' + showId);
        let $passHide = $('#' + hideId);

        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $passShow.hide();
            $passHide.show();
        } else {
            $input.attr('type', 'password');
            $passShow.show();
            $passHide.hide();
        }
    }
</script>

</html>