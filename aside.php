<aside>
    <div class="flex-shrink-0 sidebar">
        <div class="nav col-md-11">
            <a href="./index.php" class="mx-auto"><img src="./images/logo.png" alt="" height="50px" class="mx-auto"></a>
        </div>
        <?php
        $emp_cook = $_COOKIE['emp'];
        $emp_det = $fetch->table_list_id('m_emp2', 'f_id', $emp_cook);
        $emp_role = $emp_det['role'];

        if ((strpos($emp_role, 'Business Development') !== false)) {
            $url = 'dashboard_crm.php';
        } else if ($emp_role == 'Admin') {
            $url = 'dashboard.php';
        } else {
            $url = 'emp_my_dashboard.php';
        }


        // Define an array with allowed roles for each menu item
        $menuItems = [
            'dashboard' => [
                'Admin',
                'Human Resource',
                'Business Development Associate L-1',
                'Team Leader',
                'Project Manager',
                'UI/UX Designer',
                'Front-End Developer',
                'Back-End Developer',
                'App Developer',

                'Android Developer',
                'Junior App Developer',
                'Testing',
                'Digital Marketing',
                'Sales Marketing Executive',
                'Junior Content Creator',
                'Data Analytics',
                'Video Creator',
                'Accountant',
                'Human Resource Intern',
                'Digital Marketing Intern'
            ], // Roles allowed for Dashboard
            'hr' => ['Admin', 'Human Resource'], // Roles allowed for HR section
            'crm' => ['Admin', 'Human Resource', 'Business Development Associate L-1'], // Roles allowed for CRM section
            'task' => ['Admin', 'Human Resource', 'Business Development Associate L-1'], // Roles allowed for Task section
            'target' => ['Admin', 'Human Resource']

        ];

        // Function to check if the user has access to a specific menu item
        function hasAccess($role, $menuItem)
        {
            global $menuItems;
            return in_array($role, $menuItems[$menuItem]);
        }
        ?>

        <ul class="list-unstyled mt-5 ps-0">

            <?php if (hasAccess($emp_role, 'dashboard')): ?>
                <li class="mb-1">
                    <a href="./<?php echo $url; ?>">
                        <button class="btn0 bn1 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse1"
                            aria-expanded="false">
                            <div class="btnname">
                                <i class="bx bxs-dashboard"></i> &nbsp;Dashboard
                            </div>
                        </button>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (hasAccess($emp_role, 'hr')): ?>
                <li class="mb-1">
                    <button class="btn0 bn2 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse2"
                        aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-user-tie"></i> &nbsp;HRM
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse2">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_employee.php"
                                    class="d-inline-flex text-decoration-none rounded mt-3">Employee</a>
                            </li>
                            <li><a href="./list_daily_attendance.php"
                                    class="d-inline-flex text-decoration-none rounded">Daily Attendance</a>
                            </li>
                            <li><a href="./list_monthly_attendance.php"
                                    class="d-inline-flex text-decoration-none rounded">Monthly Attendance</a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (hasAccess($emp_role, 'crm')): ?>
                <li class="mb-1">
                    <button class="btn0 bn3 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse3"
                        aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-people-group"></i> &nbsp;CRM
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse3">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_company.php"
                                    class="d-inline-flex text-decoration-none rounded mt-3">Company</a>
                            </li>
                            <li><a href="./list_project.php?type=progress"
                                    class="d-inline-flex text-decoration-none rounded">Project</a>
                            </li>
                            <li><a href="./list_invoice.php" class="d-inline-flex text-decoration-none rounded">Invoice</a>
                            </li>
                            <li><a href="./list_quotation.php"
                                    class="d-inline-flex text-decoration-none rounded">Quotation</a>
                            </li>
                            <li><a href="./list_document.php"
                                    class="d-inline-flex text-decoration-none rounded">Document</a>
                            </li>
                            <li><a href="./list_notes.php" class="d-inline-flex text-decoration-none rounded">Notes</a>
                            </li>
                            <li><a href="./list_leads.php" class="d-inline-flex text-decoration-none rounded">Leads</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="mb-1">
                    <a href="./list_task.php?type=progress">
                        <button class="btn0 bn4 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse4"
                            aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-list-check"></i> &nbsp;Project Task
                            </div>
                        </button>
                    </a>
                </li>

            <?php endif; ?>
            <li class="mb-1">
                <a href="add_manual_task.php">
                    <button class="btn0 bn14 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse14" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-list-check"></i> &nbsp;Manual Task
                        </div>
                    </button>
                </a>
            </li>
            <?php if (hasAccess($emp_role, 'target')): ?>
                <li class="mb-1">
                    <a href="./list_target.php">
                        <button class="btn0 bn12 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse5"
                            aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-map-pin"></i> &nbsp;Target
                            </div>
                        </button>
                    </a>
                </li>
                <li class="mb-1">
                    <button class="btn0 bn6 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse6"
                        aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-piggy-bank"></i> &nbsp;Accounts
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse6">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_ledger.php"
                                    class="d-inline-flex text-decoration-none rounded mt-3">Ledger</a>
                            </li>
                            <li><a href="./list_supplier.php"
                                    class="d-inline-flex text-decoration-none rounded">Supplier</a>
                            </li>
                            <li><a href="./list_acct_bank.php" class="d-inline-flex text-decoration-none rounded">Bank
                                    Details</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn0 bn7 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse7"
                        aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-money-bill-transfer"></i> &nbsp;Expenses
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse7">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_expense.php" class="d-inline-flex text-decoration-none rounded mt-3">Make
                                    Expense</a>
                            </li>
                            <li><a href="./list_monthly_budget.php"
                                    class="d-inline-flex text-decoration-none rounded">Monthly
                                    Budget</a>
                            </li>
                            <li><a href="./list_pre_mon.php" class="d-inline-flex text-decoration-none rounded">Pre Monthly
                                    Budget</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="mb-1">
                    <a href="./list_approval.php">
                        <button class="btn0 bn9 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse9"
                            aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-clipboard-check"></i> &nbsp;Approval List
                            </div>
                            <div class="righticon d-flex mx-auto approvalno">
                                <?php
                                $link = $db->link();
                                $s_app = "SELECT  count(id) as lt from `e_leave` WHERE  `status`='request'";
                                $app_query = mysqli_query($link, $s_app);
                                $app_count = mysqli_fetch_assoc($app_query);

                                ?>
                                <h6 class="mb-0"><?php echo $app_count['lt']; ?></h6>
                            </div>
                        </button>
                    </a>
                </li>

                <li class="mb-1">
                    <button class="btn0 bn11 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse11"
                        aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-wallet"></i> &nbsp;Salary
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse11">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_salary_generate.php"
                                    class="d-inline-flex text-decoration-none rounded mt-3">Generation</a>
                            </li>
                            <li><a href="./list_salary_report.php"
                                    class="d-inline-flex text-decoration-none rounded">Report</a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <li class="mb-1">
                <button class="btn0 bn8 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse8"
                    aria-expanded="false">
                    <div class="btnname">
                        <i class="fa-solid fa-arrow-up-short-wide"></i> &nbsp;Request
                    </div>
                    <div class="righticon d-flex mx-auto">
                        <i class="fa-solid fa-angle-down toggle-icon"></i>
                    </div>
                </button>
                <div class="collapse" id="collapse8">
                    <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                        <li><a href="./list_leave_request.php"
                                class="d-inline-flex text-decoration-none rounded mt-3">Leave
                                Request</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <a href="./list_meeting.php">
                    <button class="btn0 bn10 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse10" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-handshake"></i> &nbsp;Meetings
                        </div>
                        <div class="righticon d-flex mx-auto approvalno">
                            <?php
                            $link = $db->link();
                            $mt_count = "SELECT  count(id) as ct from `m_meeting` WHERE JSON_CONTAINS(`emp`, JSON_QUOTE(CAST($emp_log AS CHAR)))  and `status`='upcoming'";
                            $qt_count = mysqli_query($link, $mt_count);
                            $dt_count = mysqli_fetch_assoc($qt_count);

                            ?>
                            <h6 class="mb-0"><?php echo $dt_count['ct']; ?></h6>
                        </div>
                    </button>
                </a>
            </li>

        </ul>

        <?php
        $isEmployee = !in_array($emp_role, ['Admin']);
        ?>

        <ul class="list-unstyled lgt">
            <li class="mb-1">
                <a href="<?php echo $isEmployee ? './daily_report.php?logout=1' : './log_out.php'; ?>">
                    <button class="btn0 btn-toggle collapsed" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-right-from-bracket" style="color: red;"></i> &nbsp;Logout
                        </div>
                    </button>
                </a>
            </li>
        </ul>

    </div>
</aside>