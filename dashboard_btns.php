<?php
if ($emp_role == "Admin") {
?>
    <div class="overalltabs">
        <div class="container px-0 mt-2 headbtns">
            <div class="my-3">
                <a href="./dashboard.php"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'listbtnactive' : ''; ?>">Overall
                    </button></a>
            </div>
            <div class="my-3">
                <a href="./dashboard_crm.php"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_crm.php' ? 'listbtnactive' : ''; ?>">CRM
                    </button></a>
            </div>
            <div class="my-3">
                <a href="./dashboard_hrm.php?type=Plan"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_hrm.php' ? 'listbtnactive' : ''; ?>">HRM
                    </button></a>
            </div>
            <div class="my-3">
                <a href="./dashboard_project.php"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_project.php' ? 'listbtnactive' : ''; ?>">Project
                    </button></a>
            </div>
            <div class="my-3">
                <a href="./emp_my_dashboard.php"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'emp_my_dashboard.php' ? 'listbtnactive' : ''; ?>">My Dashboard
                    </button></a>
            </div>

            <div class="my-3">
                <a href="./list_emp_task.php?type=schedule"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'list_emp_task.php?type=schedule' ? 'listbtnactive' : ''; ?>">Schedule
                    </button></a>
            </div>

        </div>

        <!-- <div class="container px-0 headbtns d-flex align-items-center justify-content-md-end">
            <div class="my-3">
                <a href="./add_manual_task.php"><button class="listbtn">Manual Task</button></a>
            </div>
        </div> -->
    </div>


<?php
}
if (($emp_role != 'Admin') && (strpos($emp_role, 'Business Development') === false)) {
?>
    <div class="overalltabs">
        <div class="container px-0 mt-2 headbtns">
            <div class="my-3">
                <a href="./emp_my_dashboard.php"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'emp_my_dashboard.php' ? 'listbtnactive' : ''; ?>">My Dashboard
                    </button></a>
            </div>
            <div class="my-3">
                <a href="./list_emp_task.php?type=schedule"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'list_emp_task.php?type=schedule' ? 'listbtnactive' : ''; ?>">Schedule
                    </button></a>
            </div>
        </div>

        <!-- <div class="container px-0 headbtns d-flex align-items-center justify-content-md-end">
            <div class="my-3">
                <a href="./add_manual_task.php"><button class="listbtn">Manual Task</button></a>
            </div>
        </div> -->
    </div>
<?php
}else if(strpos($emp_role, 'Business Development') !== false){

    ?>
 <div class="overalltabs">
        <div class="container px-0 mt-2 headbtns">
            <div class="my-3">
            <a href="./dashboard_crm.php"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_crm.php' ? 'listbtnactive' : ''; ?>">CRM
                    </button></a>
            </div>
            <div class="my-3">
                <a href="./bda_my_dashboard.php"><button
                        class="listbtn <?php echo basename($_SERVER['PHP_SELF']) == 'bda_my_dashboard.php' ? 'listbtnactive' : ''; ?>">My    Dashboard
                    </button></a>
            </div>

        </div>

        <!-- <div class="container px-0 headbtns d-flex align-items-center justify-content-md-end">
            <div class="my-3">
                <a href="./add_manual_task.php"><button class="listbtn">Manual Task</button></a>
            </div>
        </div> -->
    </div>

<?php
}
?>