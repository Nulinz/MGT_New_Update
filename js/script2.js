const currentUrl = window.location.href;
const lastPart = new URL(currentUrl).pathname.split('/').pop();
// console.log(lastPart);

const classMap = {
    // bn1 - Dashboard
    'dashboard.php': 'bn1',

    // bn2 - Employee / Attendance
    'list_employee.php': 'bn2',
    'add_employee.php': 'bn2',
    'add_emp_job.php': 'bn2',
    'add_emp_bank.php': 'bn2',
    'edit_employee.php': 'bn2',
    'edit_emp_job.php': 'bn2',
    'edit_emp_bank.php': 'bn2',
    'view_employee.php': 'bn2',
    'edit_employee.php': 'bn2',
    'list_daily_attendance.php': 'bn2',
    'list_monthly_attendance.php': 'bn2',

    // bn3 - Company / Project / Invoice / Quotation / Payment / Document / Notes / Leads
    'list_company.php': 'bn3',
    'list_project.php': 'bn3',
    'list_invoice.php': 'bn3',
    'list_quotation.php': 'bn3',
    'list_payment.php': 'bn3',
    'list_document.php': 'bn3',
    'list_notes.php': 'bn3',
    'list_leads.php': 'bn3',
    'add_company.php': 'bn3',
    'add_cmp_details.php': 'bn3',
    'add_cmp_contact_person.php': 'bn3',
    'edit_company.php': 'bn3',
    'edit_cmp_details.php': 'bn3',
    'edit_cmp_contact_person.php': 'bn3',
    'add_project.php': 'bn3',
    'add_prjt_document.php': 'bn3',
    'edit_project.php': 'bn3',
    'edit_prjt_document.php': 'bn3',
    'add_prjt_quotation.php': 'bn3',
    'add_prjt_invoice.php': 'bn3',
    'add_prjt_payment.php': 'bn3',
    'view_company.php': 'bn3',
    'view_project.php': 'bn3',

    // bn4 - Task
    'list_task.php': 'bn4',
    'view_task.php': 'bn4',

    // bn6 - Ledger / Supplier
    'list_ledger.php': 'bn6',
    'list_supplier.php': 'bn6',
    'add_ledger.php': 'bn6',
    'add_supplier.php': 'bn6',
    'edit_ledger.php': 'bn6',
    'edit_supplier.php': 'bn6',
    'list_acct_bank.php': 'bn6',
    'add_acct_bank.php': 'bn6',
    'edit_acct_bank.php': 'bn6',

    // bn7 - Expense / Monthly Budget
    'list_expense.php': 'bn7',
    'add_expense.php': 'bn7',
    'edit_expense.php': 'bn7',
    'list_monthly_budget.php': 'bn7',
    'add_monthly_budget.php': 'bn7',

    // bn8 - Leave Request
    'list_leave_request.php': 'bn8',
    'add_leave_request.php': 'bn8',

    // bn9 - Approval List
    'list_approval.php': 'bn9',

    // bn10 - Meeting
    'list_meeting.php': 'bn10',

    // bn11 - Salary Generate / Report
    'list_salary_generate.php': 'bn11',
    'list_salary_report.php': 'bn11',

    // bn12 - Target
    'list_target.php': 'bn12',
    'add_target.php': 'bn12',

};

if (classMap[lastPart]) {
    const btnToggle = $(`.${classMap[lastPart]}`);
    btnToggle.addClass('active').attr('aria-expanded', 'true');
    const collapseSection = btnToggle.attr('data-bs-target');
    $(collapseSection).addClass('show');
    $(`${collapseSection} li a[href*='${lastPart}']`).addClass('active');
    $(`${collapseSection} li a[href*='${lastPart}']`)
        .closest('li')
        .addClass('active');
} else {
    console.warn(lastPart);
}