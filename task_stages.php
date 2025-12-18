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
    <link rel="stylesheet" href="./css/stages.css">

</head>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-5 py-3 mb-3">
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Task Stages</h4>
                </div>

                <div class="container-fluid px-0 stages">
                    <div class="row">
                        <!-- Todo -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="todo">
                                    <div class="todoct">
                                        <h6 class="m-0">To Do</h6>
                                    </div>
                                    <div class="todono totalno">
                                        <h6 class="m-0 text-end">3</h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag todo-list">

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-danger"></i>
                                                <h6 class="mb-0">Resolving escalated customer complaints.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Human Resources</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/10/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/10/2024
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Inprogress -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="inprogress">
                                    <div class="inprgct">
                                        <h6 class="m-0">In Progress</h6>
                                    </div>
                                    <div class="inprgno totalno">
                                        <h6 class="m-0 text-end">5</h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag inprogress-list">

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-danger"></i>
                                                <h6 class="mb-0">Resolving escalated customer complaints.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Human Resources</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/10/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/10/2024
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- On Hold -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="onhold">
                                    <div class="onholdct">
                                        <h6 class="m-0">On Hold</h6>
                                    </div>
                                    <div class="onholdno totalno">
                                        <h6 class="m-0 text-end">7</h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag onhold-list">

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-danger"></i>
                                                <h6 class="mb-0">Resolving escalated customer complaints.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Human Resources</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/10/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/10/2024
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Completed -->
                        <div class="col-sm-12 col-md-3 col-xl-3 px-2">
                            <div class="stagemain">
                                <div class="completed">
                                    <div class="completedct">
                                        <h6 class="m-0">Completed</h6>
                                    </div>
                                    <div class="completedno totalno">
                                        <h6 class="m-0 text-end">10</h6>
                                    </div>
                                </div>

                                <div class="cardmain">
                                    <div class="row drag completed-list">

                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-danger"></i>
                                                <h6 class="mb-0">Resolving escalated customer complaints.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Human Resources</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/10/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/10/2024
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-warning"></i>
                                                <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Coordinator</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/01/2025
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-danger"></i>
                                                <h6 class="mb-0">Resolving escalated customer complaints.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Human Resources</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    12/10/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 18/10/2024
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-11 col-xl-11 mb-2 d-block mx-auto draggablecard">
                                            <div class="taskname mb-2">
                                                <i class="fa-solid fa-circle text-primary"></i>
                                                <h6 class="mb-0">Prepare performance reviews for team members.</h6>
                                            </div>
                                            <div class="taskdescp mb-2">
                                                <h6 class="mb-0">Discuss staff responsibilities during the upcoming
                                                    holiday rush.</h6>
                                                <h5 class="mb-0">Team Lead</h5>
                                            </div>
                                            <div class="taskdate">
                                                <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                                                    25/12/2024</h6>
                                                <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp; 05/01/2025
                                                </h6>
                                            </div>
                                        </div>

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

</body>

<!-- Draggable Card JS / Total Card JS -->
<script>
    $(document).ready(function () {
        $(".todo-list, .inprogress-list, .completed-list, .onhold-list").sortable({
            connectWith: ".drag",
            placeholder: "ui-sortable-placeholder",
            start: function (event, ui) {
                ui.item.addClass("dragging");
            },
            stop: function (event, ui) {
                $(".draggablecard").removeClass("last-dragged");
                ui.item.addClass("last-dragged");
                ui.item.removeClass("dragging");
                updateEmptyState();
                updateTotalCards();
            }
        }).disableSelection();

        function updateEmptyState() {
            $(".todo-list, .inprogress-list, .completed-list, .onhold-list").each(function () {
                if ($(this).children(".draggablecard").length === 0) {
                    if ($(this).find(".empty-message").length === 0) {
                        $(this).append('<div class="empty-message">No tasks available</div>');
                    }
                } else {
                    $(this).find(".empty-message").remove();
                }
            });
        }

        $(".todo-list, .inprogress-list, .completed-list, .onhold-list").on("sortover", function () {
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
        updateTotalCards();
    });
</script>

</html>