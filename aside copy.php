<aside>
    <div class="flex-shrink-0 sidebar">
        <div class="nav col-md-11">
            <a href="./index.php" class="mx-auto"><img src="./images/logo.png" alt="" height="50px" class="mx-auto"></a>
        </div>
        <ul class="list-unstyled mt-5 ps-0">
            <li class="mb-1">
                <a href="./dashboard.php">
                    <button class="btn0 bn1 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse1"
                        aria-expanded="false">
                        <div class="btnname">
                            <i class="bx bxs-dashboard"></i> &nbsp;Dashboard
                        </div>
                    </button>
                </a>
            </li>
            <li class="mb-1">
                <button class="btn0 bn2 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse2"
                    aria-expanded="false">
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
                                class="d-inline-flex text-decoration-none rounded mt-3">Employee</a>
                        </li>
                    </ul>
                </div>
            </li>
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
                        <li><a href="./list_project.php" class="d-inline-flex text-decoration-none rounded">Project</a>
                        </li>
                        <!-- <li><a href="" class="d-inline-flex text-decoration-none rounded">Follow-Ups</a>
                        </li>
                        <li><a href="" class="d-inline-flex text-decoration-none rounded">Project Tracking</a>
                        </li> -->
                        <li><a href="./list_invoice.php" class="d-inline-flex text-decoration-none rounded">Invoice</a>
                        </li>
                        <li><a href="./list_quotation.php" class="d-inline-flex text-decoration-none rounded">Quotation</a>
                        </li>
                        <li><a href="./list_payment.php" class="d-inline-flex text-decoration-none rounded">Payment</a>
                        </li>
                        <!-- <li><a href="" class="d-inline-flex text-decoration-none rounded">Document</a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a href="./list_task.php">
                    <button class="btn0 bn4 btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse4"
                        aria-expanded="false">
                        <div class="btnname">
                            <i class="fa-solid fa-list-check"></i> &nbsp;Task
                        </div>
                    </button>
                </a>
            </li>

        </ul>

        <ul class="list-unstyled lgt">
            <li class="mb-1">
                <a href="./log_out.php">
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