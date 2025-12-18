<div class="container ps-0 pe-2" id="timelinecards">
    <div class="timeline">

        <?php
        $tk_pend = $fetch->table_list_arr('m_pro_task', 'pro_id', $tk_pro);

        // print_r($tk_pend);
        
        $link = $db->link();

        foreach ($tk_pend as $tp) {

            $emp_lt = $fetch->table_list_id('m_emp', 'id', $tp['task_for']);

            $open_file = "SELECT * from `m_file` where `f_id`='{$tp['id']}' and `cat`='PRO_TASK'";
            $q_opfile = mysqli_query($link, $open_file);
            $c_opfile = mysqli_num_rows($q_opfile);

            ?>

            <div class="entry">
                <div class="title">
                    <h3><?php echo $emp_lt['name']; ?></h3>
                    <h6><?php echo date("H:i a", strtotime($tp['st_time'])); ?></h6>
                    <h6><?php echo $tp['status']; ?></h6>
                </div>
                <div class="entrybody">
                    <div class="taskname mb-1">
                        <div class="tasknameleft">
                            <i class="fa-solid fa-circle text-danger"></i>
                            <h6 class="mb-0"><?php echo $tp['title']; ?>.</h6>
                        </div>
                        <div class="tasknamefile">
                            <?php
                            if ($c_opfile > 0) {
                                $d_opfile = mysqli_fetch_assoc($q_opfile);
                                ?>
                                <a href="./img/<?php echo $d_opfile['file']; ?>" data-bs-toggle="tooltip"
                                    data-bs-title="Attachment" download><i class="fa-solid fa-paperclip"></i></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="taskcategory mb-1">
                        <h6 class="mb-0"><span class="category"><?php echo $tp['task']; ?></span> / <span
                                class="subcat"><?php echo $tp['sub']; ?></span></h6>
                    </div>
                    <div class="taskdescp">
                        <h6 class="mb-1"><?php echo $tp['des']; ?>.</h6>
                        <h5 class="mb-1"><?php echo $tp['prior']; ?></h5>
                    </div>
                    <div class="taskdate">
                        <h6 class="m-0 startdate"><i class="fa-regular fa-calendar"></i>&nbsp;
                            <?php echo date("d-m-Y", strtotime($tp['st_date'])); ?></h6>
                        <h6 class="m-0 enddate"><i class="fas fa-flag"></i>&nbsp;
                            <?php echo date("d-m-Y", strtotime($tp['end_date'])); ?>
                        </h6>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>

        <!-- <div class="entry">
            <div class="title">
                <h3>Sabarinathan</h3>
                <h6>02.30 pm</h6>
            </div>
            <div class="entrybody">
                <div class="taskname">
                    <div class="tasknameleft">
                        <i class="fa-solid fa-circle text-warning"></i>
                        <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                    </div>
                    <div class="tasknamefile">
                        <a href="" data-bs-toggle="tooltip" data-bs-title="Attachment" download><i
                                class="fa-solid fa-paperclip"></i></a>
                    </div>
                </div>
                <div class="taskcategory mb-2">
                    <h6 class="mb-0"><span class="category">Task Category</span> / <span class="subcat">Sub
                            Category</span></h6>
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

        <div class="entry">
            <div class="title">
                <h3>Sugan Chakravarthi</h3>
                <h6>02.30 pm</h6>
            </div>
            <div class="entrybody">
                <div class="taskname">
                    <div class="tasknameleft">
                        <i class="fa-solid fa-circle text-primary"></i>
                        <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                    </div>
                    <div class="tasknamefile">
                        <a href="" data-bs-toggle="tooltip" data-bs-title="Attachment" download><i
                                class="fa-solid fa-paperclip"></i></a>
                    </div>
                </div>
                <div class="taskcategory mb-2">
                    <h6 class="mb-0"><span class="category">Task Category</span> / <span class="subcat">Sub
                            Category</span></h6>
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

        <div class="entry">
            <div class="title">
                <h3>Venkatesh Surendiran</h3>
                <h6>02.30 pm</h6>
            </div>
            <div class="entrybody">
                <div class="taskname">
                    <div class="tasknameleft">
                        <i class="fa-solid fa-circle text-danger"></i>
                        <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                    </div>
                    <div class="tasknamefile">
                        <a href="" data-bs-toggle="tooltip" data-bs-title="Attachment" download><i
                                class="fa-solid fa-paperclip"></i></a>
                    </div>
                </div>
                <div class="taskcategory mb-2">
                    <h6 class="mb-0"><span class="category">Task Category</span> / <span class="subcat">Sub
                            Category</span></h6>
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

        <div class="entry">
            <div class="title">
                <h3>Saravanan Srinivasan</h3>
                <h6>02.30 pm</h6>
            </div>
            <div class="entrybody">
                <div class="taskname">
                    <div class="tasknameleft">
                        <i class="fa-solid fa-circle text-danger"></i>
                        <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                    </div>
                    <div class="tasknamefile">
                        <a href="" data-bs-toggle="tooltip" data-bs-title="Attachment" download><i
                                class="fa-solid fa-paperclip"></i></a>
                    </div>
                </div>
                <div class="taskcategory mb-2">
                    <h6 class="mb-0"><span class="category">Task Category</span> / <span class="subcat">Sub
                            Category</span></h6>
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

        <div class="entry">
            <div class="title">
                <h3>Sabarinathan</h3>
                <h6>02.30 pm</h6>
            </div>
            <div class="entrybody">
                <div class="taskname">
                    <div class="tasknameleft">
                        <i class="fa-solid fa-circle text-warning"></i>
                        <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                    </div>
                    <div class="tasknamefile">
                        <a href="" data-bs-toggle="tooltip" data-bs-title="Attachment" download><i
                                class="fa-solid fa-paperclip"></i></a>
                    </div>
                </div>
                <div class="taskcategory mb-2">
                    <h6 class="mb-0"><span class="category">Task Category</span> / <span class="subcat">Sub
                            Category</span></h6>
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

        <div class="entry">
            <div class="title">
                <h3>Sugan Chakravarthi</h3>
                <h6>02.30 pm</h6>
            </div>
            <div class="entrybody">
                <div class="taskname">
                    <div class="tasknameleft">
                        <i class="fa-solid fa-circle text-primary"></i>
                        <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                    </div>
                    <div class="tasknamefile">
                        <a href="" data-bs-toggle="tooltip" data-bs-title="Attachment" download><i
                                class="fa-solid fa-paperclip"></i></a>
                    </div>
                </div>
                <div class="taskcategory mb-2">
                    <h6 class="mb-0"><span class="category">Task Category</span> / <span class="subcat">Sub
                            Category</span></h6>
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

        <div class="entry">
            <div class="title">
                <h3>Venkatesh Surendiran</h3>
                <h6>02.30 pm</h6>
            </div>
            <div class="entrybody">
                <div class="taskname">
                    <div class="tasknameleft">
                        <i class="fa-solid fa-circle text-danger"></i>
                        <h6 class="mb-0">Conduct team meeting for holiday.</h6>
                    </div>
                    <div class="tasknamefile">
                        <a href="" data-bs-toggle="tooltip" data-bs-title="Attachment" download><i
                                class="fa-solid fa-paperclip"></i></a>
                    </div>
                </div>
                <div class="taskcategory mb-2">
                    <h6 class="mb-0"><span class="category">Task Category</span> / <span class="subcat">Sub
                            Category</span></h6>
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
        </div> -->

    </div>
</div>