<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Stages</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/dashboard_main.css">
    <link rel="stylesheet" href="./css/dashboard_stages.css">

</head>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 py-3 mb-3">
                <div class="sidebodyhead">
                    <h4 class="m-0">Overview</h4>
                </div>

                <!-- Dashboard Btns -->
                <?php include('./dashboard_btns.php'); ?>

                <div class="container-fluid px-0 mt-2 stages">
                    <div class="row">
                        <!-- Todo list -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="todo">
                                    <div class="todoct">
                                        <h6 class="m-0">To Do</h6>
                                    </div>
                                    <div class="todono totalno">
                                        <h6 class="m-0 text-end"></h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag int-list" data-type="initial">
                                        <?php
                                        $link = $db->link();

                                        $s_int = "SELECT * from `m_pro_task` where `task_for`='$emp_log' and `status`='initial'";
                                        $q_int = mysqli_query($link,$s_int);
                                        while($d_int = mysqli_fetch_assoc($q_int)){

                                                if($d_int['pro_id']!=0){
                                                $int_pro = $fetch->table_list_id('m_pro','id',$d_int['pro_id']);
                                                $int_cmp = $fetch->table_list_id('m_cmp','id',$int_pro['c_id']);

                                                $pro_t =$int_pro['title'];
                                                $cmp_t = $int_cmp['c_name'];
                                                }else{
                                                    $pro_t ='Manual';
                                                    $cmp_t = 'Company Activity';
                                                }



                                            $int_file = "SELECT * from `m_file` where `f_id`='{$d_int['id']}' and `cat`='PRO_TASK'";
                                            $q_infile = mysqli_query($link,$int_file);
                                            $c_infile = mysqli_num_rows($q_infile);

                                        ?>

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard"  data-id="<?php echo $d_int['id']; ?>">
                                            <div class="taskname mb-2">
                                                <div class="tasknameleft">
                                                    <i class="fa-solid fa-circle text-warning"></i>
                                                    <a href="./view_emp_task.php?tk_id=<?php echo $d_int['id']; ?>"><h6 class="mb-0"><?php echo $d_int['title']; ?></h6></a>
                                                </div>
                                                <div class="tasknamefile">
                                                    <?php
                                                    if($c_infile>0){
                                                        $d_infile = mysqli_fetch_assoc($q_infile);
                                                    ?>
                                                    <a href="./img/<?php echo $d_infile['file']; ?>" data-bs-toggle="tooltip" data-bs-title="Attachment"
                                                        download><i class="fa-solid fa-paperclip"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="taskdescp mb-1">
                                                <h6 class="mb-0"><?php echo $d_int['des']; ?>.</h6>
                                                <hr>
                                                <h5 class="mb-0"><?php echo $pro_t; ?>.</h5>
                                                <h6 class="mb-0"><?php echo $cmp_t; ?>.</h6>
                                                <div class="taskdescpdiv">
                                                    <h5 class="mb-0"><?php echo $d_int['task']."-".$d_int['sub']; ?></h5>
                                                    <!-- <a class="mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#completedModal"></a> -->
                                                </div>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                <?php echo date("d-m-Y",strtotime($d_int['st_date'])); ?></h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp;  <?php echo date("d-m-Y",strtotime($d_int['end_date'])); ?>
                                                </h6>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- In Progress List -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="inprogress">
                                    <div class="inprgct">
                                        <h6 class="m-0">In Progress</h6>
                                    </div>
                                    <div class="inprgno totalno">
                                        <h6 class="m-0 text-end"></h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag open-list" data-type="open">

                                    <?php
                                    $s_open = "SELECT * from `m_pro_task` where `task_for`='$emp_log' and `status`='open'";
                                    $q_open = mysqli_query($link,$s_open);
                                    while($d_open = mysqli_fetch_assoc($q_open)){

                                            if($d_open['pro_id']!=0){

                                                $open_pro = $fetch->table_list_id('m_pro','id',$d_open['pro_id']);
                                                $open_cmp = $fetch->table_list_id('m_cmp','id',$open_pro['c_id']);

                                                $pro_t1 =$open_pro['title'];
                                                $cmp_t1 = $open_cmp['c_name'];
                                                }else{
                                                    $pro_t1 ='Manual';
                                                    $cmp_t1 = 'Company Activity';
                                                }

                                        $open_file = "SELECT * from `m_file` where `f_id`='{$d_open['id']}' and `cat`='PRO_TASK'";
                                            $q_opfile = mysqli_query($link,$open_file);
                                            $c_opfile = mysqli_num_rows($q_opfile);
                                    ?>

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard" data-id="<?php echo $d_open['id']; ?>">
                                            <div class="taskname mb-2">
                                                <div class="tasknameleft">
                                                    <i class="fa-solid fa-circle text-primary"></i>
                                                    <a href="./view_emp_task.php?tk_id=<?php echo $d_open['id']; ?>"><h6 class="mb-0"><?php echo $d_open['title']; ?></h6></a>
                                                </div>
                                                <div class="tasknamefile">
                                                <?php
                                                    if($c_opfile>0){
                                                        $d_opfile = mysqli_fetch_assoc($q_opfile);
                                                    ?>
                                                    <a href="./img/<?php echo $d_opfile['file']; ?>" data-bs-toggle="tooltip" data-bs-title="Attachment"
                                                        download><i class="fa-solid fa-paperclip"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="taskdescp mb-1">
                                                <h6 class="mb-0"><?php echo $d_open['des']; ?>.</h6>
                                                <hr>
                                                <h5 class="mb-0"><?php echo $pro_t1; ?>.</h5>
                                                <h6 class="mb-0"><?php echo $cmp_t1; ?>.</h6>
                                                <div class="taskdescpdiv">
                                                    <h5 class="mb-0"><?php echo $d_open['task']."-".$d_open['sub']; ?></h5>
                                                    <!-- <a class="mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#completedModal"></a> -->
                                                </div>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                <?php echo date("d-m-Y",strtotime($d_open['st_date'])); ?></h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; <?php echo date("d-m-Y",strtotime($d_open['st_date'])); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Hold -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="onhold">
                                    <div class="onholdct">
                                        <h6 class="m-0">On Hold</h6>
                                    </div>
                                    <div class="onholdno totalno">
                                        <h6 class="m-0 text-end"></h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag hold-list" data-type="hold">

                                    <?php
                                    $s_hold = "SELECT * from `m_pro_task` where `task_for`='$emp_log' and `status`='hold'";
                                    $q_hold = mysqli_query($link,$s_hold);
                                    while($d_hold = mysqli_fetch_assoc($q_hold)){

                                        if($d_hold['pro_id']!=0){
                                            $hold_pro = $fetch->table_list_id('m_pro','id',$d_hold['pro_id']);
                                            $hold_cmp = $fetch->table_list_id('m_cmp','id',$hold_pro['c_id']);

                                            $pro_t2 =$hold_pro['title'];
                                            $cmp_t2 = $hold_cmp['c_name'];
                                        }else{
                                            $pro_t2 ='Manual';
                                            $cmp_t2 = 'Company Activity';
                                        }

                                        $hold_file = "SELECT * from `m_file` where `f_id`='{$d_hold['id']}' and `cat`='PRO_TASK'";
                                        $q_holdfile = mysqli_query($link,$hold_file);
                                        $c_holdfile = mysqli_num_rows($q_holdfile);
                                    ?>

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard" data-id="<?php echo $d_hold['id']; ?>">
                                            <div class="taskname mb-2">
                                                <div class="tasknameleft">
                                                    <i class="fa-solid fa-circle text-warning"></i>
                                                    <a href="./view_emp_task.php?tk_id=<?php echo $d_hold['id']; ?>"><h6 class="mb-0"><?php echo $d_hold['title']; ?></h6></a>
                                                </div>
                                                <div class="tasknamefile">
                                                <?php
                                                    if($c_holdfile>0){
                                                        $d_holdfile = mysqli_fetch_assoc($q_holdfile);
                                                    ?>
                                                    <a href="./img/<?php echo $d_holdfile['file']; ?>" data-bs-toggle="tooltip" data-bs-title="Attachment"
                                                        download><i class="fa-solid fa-paperclip"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="taskdescp mb-1">
                                                <h6 class="mb-0"><?php echo $d_hold['des']; ?>.</h6>
                                                <hr>
                                                <h5 class="mb-0"><?php echo $pro_t2; ?>.</h5>
                                                <h6 class="mb-0"><?php echo $cmp_t2; ?>.</h6>
                                                <div class="taskdescpdiv">
                                                    <h5 class="mb-0"><?php echo $d_hold['task']."-".$d_hold['sub']; ?></h5>
                                                    <!-- <a class="mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#completedModal"></a> -->
                                                </div>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                <?php echo date("d-m-Y",strtotime($d_hold['st_date'])); ?></h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; <?php echo date("d-m-Y",strtotime($d_hold['st_date'])); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- close -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="completed">
                                    <div class="completedct">
                                        <h6 class="m-0">Completed</h6>
                                    </div>
                                    <div class="completedno totalno">
                                        <h6 class="m-0 text-end"></h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag close-list" data-type="close">

                                    <?php
                                    $s_close = "SELECT * from `m_pro_task` where `task_for`='$emp_log' and `status`='close'";
                                    $q_close = mysqli_query($link,$s_close);
                                    while($d_close = mysqli_fetch_assoc($q_close)){

                                        $cr_on = $db->c_date;

                                        $tk_con = date("Y-m-d",strtotime($d_close['c_on']));

                                        // Create DateTime objects from both dates
                                        $cr_on_date = new DateTime($cr_on);
                                        $tk_con_date = new DateTime($tk_con);

                                        // Calculate the difference between the two dates
                                        $interval = $cr_on_date->diff($tk_con_date);

                                        if ($interval->days > 2) {
                                                 continue;
                                                //  $interval;
                                        }

                                        if($d_close['pro_id']!=0){

                                            $close_pro = $fetch->table_list_id('m_pro','id',$d_close['pro_id']);
                                            $close_cmp = $fetch->table_list_id('m_cmp','id',$close_pro['c_id']);


                                            $pro_t3 =$close_pro['title'];
                                            $cmp_t3 =$close_cmp['c_name'];
                                        }else{
                                            $pro_t3 ='Manual';
                                            $cmp_t3 = 'Company Activity';
                                        }

                                        $close_file = "SELECT * from `m_file` where `f_id`='{$d_close['id']}' and `cat`='PRO_TASK'";
                                        $q_clfile = mysqli_query($link,$close_file);
                                        $c_clfile = mysqli_num_rows($q_clfile);
                                    ?>

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard" data-id="<?php echo $d_close['id']; ?>">
                                            <div class="taskname mb-2">
                                                <div class="tasknameleft">
                                                    <i class="fa-solid fa-circle text-warning"></i>
                                                    <a href="./view_emp_task.php?tk_id=<?php echo $d_close['id']; ?>"><h6 class="mb-0"><?php echo $d_close['title']; ?></h6></a>
                                                </div>
                                                <div class="tasknamefile">
                                                <?php
                                                    if($c_clfile>0){
                                                        $d_clfile = mysqli_fetch_assoc($q_clfile);
                                                    ?>
                                                    <a href="./img/<?php echo $d_clfile['file']; ?>" data-bs-toggle="tooltip" data-bs-title="Attachment"
                                                        download><i class="fa-solid fa-paperclip"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="taskdescp mb-1">
                                                <h6 class="mb-0"><?php echo $d_close['des']; ?>.</h6>
                                                <hr>
                                                <h5 class="mb-0"><?php echo $pro_t3; ?>.</h5>
                                                <h6 class="mb-0"><?php echo $cmp_t3; ?>.</h6>
                                                <div class="taskdescpdiv">
                                                    <h5 class="mb-0"><?php echo $d_close['task']."-".$d_close['sub']; ?></h5>
                                                    <?php
                                                    $last_seq = $d_close['seq']+1;
                                                    $s_last = "SELECT * from `m_pro_task` where `pro_id`='{$d_close['pro_id']}' and `seq`='$last_seq' and `status`='schedule'";
                                                    $q_last = mysqli_query($link,$s_last);
                                                    $d_last = mysqli_num_rows($q_last);
                                                    if($d_last>0){
                                                    ?>
                                                    <a class="mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#completedModal"><i
                                                            class="fa-solid fa-circle-check pop_form" data-id=<?php echo $d_close['id']; ?>></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                <?php echo date("d-m-Y",strtotime($d_close['st_date'])); ?></h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; <?php echo date("d-m-Y",strtotime($d_close['st_date'])); ?>
                                                </h6>
                                                </h6>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>


                                    </div>
                                </div>
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

    <!-- Update Approval Modal -->
    <div class="modal fade" id="completedModal" tabindex="-1" aria-labelledby="completedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="completedModalLabel">Assign Task</h4>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="assign_form">

                </div>
            </div>
        </div>
    </div>

</body>

<!-- Draggable Card JS / Total Card JS -->


<script>
    $(document).ready(function () {
        $(".int-list, .open-list, .close-list, .hold-list").sortable({
            connectWith: ".drag",
            placeholder: "ui-sortable-placeholder",
            start: function (event, ui) {
                var card = ui.item;
                ui.item.addClass("dragging");
                card.data("original-list", card.parent());
                var st_cl = card.parent('div').attr('data-type');

                 // Prevent dragging in the "close" list
                if (st_cl === 'close') {
                  // Alert only if it's the first time
                    if (!card.hasClass("alerted")) {
                        alert("Task is in close list, cannot drag out.");
                        card.addClass("alerted");  // Add a class to ensure the alert doesn't fire again
                    }

                    // Prevent the drag action from continuing
                    event.stopPropagation();  // Prevents any further event propagation
                    event.preventDefault();    // Prevents default behavior
                    location.reload();
                    return false;  // This stops the drag action

                }



            },
            stop: function (event, ui) {
                $(".draggablecard").removeClass("last-dragged");
                ui.item.addClass("last-dragged");
                ui.item.removeClass("dragging");
                updateEmptyState();
                var card = ui.item;
                var originalList = card.data("original-list");
                var cl = card.parent('div').attr('data-type');


                //  console.log(st_cl);

                // if (cl === 'close') {
                if (card.closest(".close-list").length) {

                    if (!complete()) {
                    //   console.log(originalList.parent('div').attr('data-type'));
                        card.detach();
                        originalList.prepend(card);

                        return;
                    }
                    else {

                         updateTaskStatus(ui.item,cl);
                        updateTotalCards();
                        location.reload();
                    }
                } else {
                    updateTaskStatus(ui.item,cl);
                    updateTotalCards();
                }






            }
        }).disableSelection();

        function updateEmptyState() {
            $(".int-list, .open-list, .close-list, .hold-list").each(function () {
                if ($(this).children(".draggablecard").length === 0) {
                    if ($(this).find(".empty-message").length === 0) {
                        $(this).append('<div class="empty-message" style="color: var(--primary)">No tasks available</div>');
                    }
                } else {
                    $(this).find(".empty-message").remove();
                }
            });
        }

        $(".int-list, .open-list, .close-list, .hold-list").on("sortover", function () {
            $(this).find(".empty-message").remove();
        });

        // Total Count
        function updateTotalCards() {
            const columns = document.querySelectorAll('.col-xl-3');

            columns.forEach(function (column) {
                const draggableCards = column.querySelectorAll('.draggablecard');
                const totalNoElement = column.querySelector('.totalno h6');
                totalNoElement.textContent = draggableCards.length;
            });
        }
        updateEmptyState();
        updateTotalCards();

        function complete() {
            return confirm("Do you want to mark this task as completed?");
        }

        // Function to update the task status via AJAX
        function updateTaskStatus(task,close_box) {
            const taskId = task.data('id'); // Assuming each task has a data-id attribute
            // const newStatus = task.closest('div').attr('data-type'); // Get the list's class name (todo, inprogress, etc.)
            // const newStatus = task.closest('ul').attr('class').split('-')[0]; // Get the list's class name (todo, inprogress, etc.)

            //  console.log(close_box);
            //  console.log(taskId);

            $.ajax({
                url: 'up_ajax.php', // URL where the status update is handled
                type: 'POST',
                data: {
                    task_id: taskId,
                    status: close_box
                },
                success: function (response) {
                    console.log('Task status updated successfully:', response);
                },
                error: function (xhr, status, error) {
                    console.error('Error updating task status:', error);
                }
            });
        }

        $('.pop_form').on('click',function(){

         var tk_id = $(this).attr('data-id');
         console.log(tk_id);

            $.ajax({
                url: 'up_ajax.php', // URL where the status update is handled
                type: 'POST',
                data: {
                    tk_id_pop: tk_id,
                },
                success: function (response) {
                    // console.log('Task status updated successfully:', response);
                    $('#assign_form').html(response);
                },
                error: function (xhr, status, error) {
                    console.error('Error updating task status:', error);
                }
            });


        });
    });
</script>


</html>