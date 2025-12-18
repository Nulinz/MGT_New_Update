<?php
include('fetch.php');

if (isset($_GET['tk_id'])) {
    $tk_id = $_GET['tk_id'];

    $tk_li = $fetch->table_list_id('m_pro_task', 'id', $tk_id);

    $tk_pro = $tk_li['pro_id'];

    $task_pro_lt = $fetch->table_list_id('m_pro', 'id', $tk_pro);

    $task_cmp = $fetch->table_list_id('m_cmp', 'id', $task_pro_lt['c_id']);


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
    <link rel="stylesheet" href="./css/tasktimeline.css">

</head>
<style>
    .left-content {
        border-right: none;
    }
</style>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-5 mb-4">
                <!-- <div class="sidebodyback my-3" onclick="goBack()">
                    <div class="backhead">
                        <h5 class="m-0"><i class="fas fa-arrow-left"></i></h5>
                        <h6 class="m-0">Task Details</h6>
                    </div>
                </div> -->
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Task View - <?php echo $task_cmp['c_name']; ?></h4>
                    <h4 class="m-0"><?php echo $task_pro_lt['title']; ?></h4>
                </div>
                <div class="container px-0 mt-2 headbtns">
                    <div class="my-1">
                        <a href="./list_document.php?pro_id=<?php echo $tk_pro; ?>"><button
                                class="listbtn">Documents</button></a>
                    </div>
                    <div class="my-1">
                        <a href="./list_notes.php?pro_id=<?php echo $tk_pro; ?>"><button
                                class="listbtn">Notes</button></a>
                    </div>
                </div>
                <div class="mainbdy">
                    <div class="p-3 rounded-2 maindiv">
                        <div class="row">
                            <!-- Left Content -->
                            <div class="col-12 col-sm-12 col-md-12 col-xl-12 left-content">
                                <?php include('./emp_task_timeline.php'); ?>
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