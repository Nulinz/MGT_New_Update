<div class="container px-0" id="timelinecards">
    <div class="row mb-2" id="tmlnrow1">
        <div class="row" id="tmlnrow2">
            <div class="container px-0 pb-2">
                <div class="wrapper">
                    <ul class="carousel px-0">
                        <li class="card d-flex flex-column mt-3">
                            <div class="col timelinemain">
                                <div class="container-fluid ps-0 pe-2 center-tmln" id="scrollbar2">
                                    <div class="container px-0 w-100">
                                        <ul class="p-0 m-0">
                                            <?php
                                            $pro_id = $tk_det['pro_id'];
                                            $tk_loop = $fetch->task_list_arr('m_task', 'pro_id', $pro_id);

                                            foreach ($tk_loop as $tk) {

                                                $emp_det = $fetch->table_list_id('m_emp', 'id', $tk['task_for']);

                                                if ($tk['status'] == 'open') {
                                                    $icon = 'text-success';
                                                }
                                                ?>
                                                <li style="--accent-color:#000" class="mb-4">
                                                    <div class="date ps-2" id="datetimests">
                                                        <div>
                                                            <h6 class="m-0 text-start" style="font-size: 12px;">
                                                                <?php echo $emp_det['name']; ?>
                                                            </h6>
                                                        </div>
                                                        <div class="sts">
                                                            <h6 class="border-0 m-0 ">
                                                                <?php echo date("d-M-y", strtotime($tk['st_date'])); ?> /
                                                                <?php echo date("H:i a", strtotime($tk['c_on'])); ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="pe-2">
                                                        <div class="titleflex">
                                                            <h6 class="mt-2 mb-1"><span
                                                                    class="titlehead <?php echo $icon; ?>"><?php echo $tk['task']; ?></span>
                                                                /
                                                                <span
                                                                    class="title <?php echo $icon; ?>"><?php echo $tk['sub']; ?></span>
                                                            </h6>
                                                            <h6 class="my-1 ms-auto">
                                                                <span class="title text-end text-danger"><i
                                                                        class="fa-solid fa-flag"></i>
                                                                    <?php echo date("d-M-y", strtotime($tk['end_date'])); ?></span>
                                                            </h6>
                                                        </div>
                                                        <?php
                                                        $emp_cby = $fetch->table_list_id('m_emp', 'id', $tk['c_by']);
                                                        ?>
                                                        <h6 class="my-1"><span
                                                                class="assignname"><?php echo $emp_cby['name']; ?></span>
                                                            <span class="descr"> : <?php echo $tk['des']; ?>.</span>
                                                        </h6>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>