<?php
include('fetch.php');
if(isset($_GET['task_id'])){
    $task_id = $_GET['task_id'];

    $tk_det = $fetch->table_list_id('m_task','id',$task_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/single-timeline.css">

</head>
<style>
    .left-content,
    .center-content {
        border-right: 2px solid #D9D9D9;
    }
</style>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 mb-4">
                <div class="sidebodyback my-2" onclick="goBack()">
                    <div class="backhead">
                        <h5 class="m-0"><i class="fas fa-arrow-left"></i></h5>
                        <h6 class="m-0">Task Details</h6>
                    </div>
                </div>

                <div class="mainbdy">
                    <div class="bg-white p-3 rounded-2 maindiv">
                        <div class="row">
                            <!-- Left Content -->
                            <div class="col-12 col-sm-12 col-md-4 col-xl-4 left-content">
                                <?php include('./task_project.php'); ?>
                            </div>

                            <!-- Center Content -->
                            <div class="col-12 col-sm-12 col-md-4 col-xl-4 center-content">
                                <?php include('./task_timeline.php'); ?>
                            </div>

                            <!-- Right Content -->
                            <div class="col-12 col-sm-12 col-md-4 col-xl-4 ps-3 right-content">
                                <?php include('./task_create.php') ?>
                            </div>
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