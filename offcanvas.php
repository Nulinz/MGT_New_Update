<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <div class="user ps-1">
            <img src="./images/avatar.png" height="40px" class="rounded-5" alt="">
            <h6 class="bg-dark px-3 py-1 m-0 rounded-2">Saravanan</h6>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="flex-shrink-0 sidebar">
            <ul class="list-unstyled mt-2 ps-0">
                <li class="mb-1">
                    <a href="./dashboard.php">
                        <button class="btn0 mx-auto bn1 btn-toggle collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapse1" aria-expanded="false">
                            <div class="btnname">
                                <i class="bx bxs-dashboard"></i> &nbsp;Dashboard
                            </div>
                        </button>
                    </a>
                </li>
                <li class="mb-1">
                    <button class="btn0 mx-auto bn2 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse2" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-user-tie"></i> &nbsp;HR
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse2">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_employee.php"
                                    class="d-inline-flex text-decoration-none rounded mt-2">Employee</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn0 mx-auto bn3 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse3" aria-expanded="false">
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
                                    class="d-inline-flex text-decoration-none rounded mt-2">Company</a>
                            </li>
                            <li><a href="./list_project.php"
                                    class="d-inline-flex text-decoration-none rounded">Project</a>
                            </li>
                            <li><a href="" class="d-inline-flex text-decoration-none rounded">Follow-Ups</a>
                            </li>
                            <li><a href="" class="d-inline-flex text-decoration-none rounded">Project Tracking</a>
                            </li>
                            <li><a href="" class="d-inline-flex text-decoration-none rounded">Invoice</a>
                            </li>
                            <li><a href="" class="d-inline-flex text-decoration-none rounded">Payment</a>
                            </li>
                            <li><a href="" class="d-inline-flex text-decoration-none rounded">Document</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <a href="./list_task.php">
                        <button class="btn0 mx-auto bn4 btn-toggle collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapse4" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-list-check"></i> &nbsp;Task
                            </div>
                        </button>
                    </a>
                </li>
                <!-- <li class="mb-1">
                    <button class="btn0 mx-auto bn5 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse5" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-clipboard-user"></i> &nbsp;Attendance
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse5">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_daily_attendance.php"
                                    class="d-inline-flex text-decoration-none rounded mt-2">Daily</a>
                            </li>
                            <li><a href="./list_monthly_attendance.php"
                                    class="d-inline-flex text-decoration-none rounded">Monthly</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn0 mx-auto bn6 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse6" aria-expanded="false">
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
                                    class="d-inline-flex text-decoration-none rounded mt-2">Ledger</a>
                            </li>
                            <li><a href="./list_supplier.php"
                                    class="d-inline-flex text-decoration-none rounded">Supplier</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn0 mx-auto bn7 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse7" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-money-bill-transfer"></i> &nbsp;Expenses
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse7">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_expense.php"
                                    class="d-inline-flex text-decoration-none rounded mt-2">Make
                                    Expense</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <a href="./list_approval.php">
                        <button class="btn0 mx-auto bn8 btn-toggle collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapse8" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-clipboard-check"></i> &nbsp;Approval List
                            </div>
                            <div class="righticon d-flex mx-auto approvalno">
                                <h6 class="mb-0">2</h6>
                            </div>
                        </button>
                    </a>
                </li>
                <li class="mb-1">
                    <button class="btn0 mx-auto bn9 btn-toggle collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapse9" aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-arrow-up-short-wide"></i> &nbsp;Request
                        </div>
                        <div class="righticon d-flex mx-auto">
                            <i class="fa-solid fa-angle-down toggle-icon"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapse9">
                        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
                            <li><a href="./list_leave_request.php"
                                    class="d-inline-flex text-decoration-none rounded mt-2">Leave
                                    Request</a>
                            </li>
                        </ul>
                    </div>
                </li> -->

            </ul>

            <ul class="list-unstyled lgt">
                <li class="mb-1">
                    <a href="./logout.php">
                        <button class="btn0 mx-auto btn-toggle collapsed" aria-expanded="false">
                            <div class="btnname">
                                <i class="fa-solid fa-right-from-bracket" style="color: red;"></i> &nbsp;Logout
                            </div>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>