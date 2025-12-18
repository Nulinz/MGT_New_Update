<?php
include('fetch.php');
$link = $db->link();
$projects = $fetch->table_list_arr('m_pro', 'status', 'Active'); // fetch active projects

if (!isset($_SESSION['emp_id'])) {
    header("Location: index.php");
    exit;
}

$login_emp_id = $_SESSION['emp_id']; // login/session ID

$res = mysqli_query(
    $link,
    "SELECT id FROM m_emp WHERE id = '$login_emp_id'"
);

$row = mysqli_fetch_assoc($res);
$emp_id = $row['id']; // REAL m_emp.id

$today = date('Y-m-d');

/* 🔎 Get employee role */
$emp2 = $fetch->table_list_id('m_emp2', 'f_id', $emp_id);
$role = $emp2['role'] ?? '';

/* 🔐 Check if report already submitted */
$chk = mysqli_query(
    $link,
    "SELECT id FROM m_daily_report 
     WHERE emp_id='$emp_id' AND report_date='$today'"
);

/* 👉 If logout clicked & report already exists → logout */
if (isset($_GET['logout']) && mysqli_num_rows($chk) > 0) {
    header("Location: log_out.php");
    exit;
}

/* 💾 Save report for multiple projects */
if (isset($_POST['save_report'])) {
    $projects = $_POST['project_title'];
    $morning_updates = $_POST['morning_update'];
    $evening_updates = $_POST['evening_update'];

    for ($i = 0; $i < count($projects); $i++) {
        $project = mysqli_real_escape_string($link, $projects[$i]);
        $morning = mysqli_real_escape_string($link, $morning_updates[$i]);
        $evening = mysqli_real_escape_string($link, $evening_updates[$i]);

        mysqli_query(
            $link,
            "INSERT INTO m_daily_report
            (emp_id, project_title, report_date, morning_update, evening_update)
            VALUES
            ('$emp_id','$project','$today','$morning','$evening')"
        );
    }

    header("Location: log_out.php");
    exit;
}

/* 👤 Employee details */
$emp = $fetch->table_list_id('m_emp', 'id', $emp_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daily Report</title>
    <?php include("./cdn_style.php"); ?>
    <link rel="stylesheet" href="./css/form.css">
</head>

<style>
    .projectBlock {
        border-bottom: 2px dashed #ddd;
    }

    .remove-btn {
        padding: 0;
        width: 28px;
        height: 28px;
        font-size: 16px;
        line-height: 1;
        border-radius: 2px;
    }
</style>

<body>

    <div class="main">
        <?php include("./aside.php"); ?>

        <div class="side-body">
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 py-2">
                <div class="sidebodyhead mb-3">
                    <h4 class="text-danger">Submit Daily Report</h4>
                </div>

                <form method="POST">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row" id="projectContainer">

                            <div class="projectBlock">
                                <!-- Name -->
                                <div class="col-md-4 mb-3 inputs">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?php echo $emp['name']; ?>"
                                        readonly>
                                </div>

                                <!-- Date -->
                                <div class="col-md-4 mb-3 inputs">
                                    <label>Date</label>
                                    <input type="date" class="form-control" value="<?php echo $today; ?>" readonly>
                                </div>

                                <!-- Project Title + Remove -->
                                <div class="col-md-4 mb-3 inputs">
                                    <label>Project Title *</label>
                                    <div class="d-flex gap-2">
                                        <select name="project_title[]" class="form-select" required>
                                            <option value="">Select Project</option>
                                            <?php
                                            foreach ($projects as $p) {
                                                echo "<option value='{$p['title']}'>{$p['title']}</option>";
                                            }
                                            ?>
                                        </select>

                                        <!-- Remove button (hidden for first block) -->
                                        <button type="button" class="btn btn-danger btn-sm remove-btn d-none"
                                            onclick="removeProject(this)">
                                            ✖
                                        </button>
                                    </div>
                                </div>


                                <!-- Morning Update -->
                                <div class="col-md-6 mb-3 inputs">
                                    <label>Morning Update *</label>
                                    <textarea name="morning_update[]" class="form-control" rows="3" required></textarea>
                                </div>

                                <!-- Evening Update -->
                                <div class="col-md-6 mb-3 inputs">
                                    <label>Evening Update</label>
                                    <textarea name="evening_update[]" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="button" class="formbtn mb-1" onclick="addProject()"
                            style="padding: 5px 30px; font-size: 16px; width: 250px;">
                            Add Another Project
                        </button><br>
                        <button type="submit" name="save_report" class="formbtn"
                            style="padding: 5px 25px; font-size:16px;">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include("./cdn_script.php"); ?>
    <script>
        const projectList = <?php echo json_encode($projects); ?>;
    </script>

    <script>

        function addProject() {
            const container = document.getElementById('projectContainer');
            const block = document.createElement('div');
            block.classList.add('projectBlock', 'row');

            let options = `<option value="">Select Project</option>`;
            projectList.forEach(p => {
                options += `<option value="${p.title}">${p.title}</option>`;
            });

            block.innerHTML = `
            <!-- Project Title -->
            <div class="col-md-4 mb-3 inputs">
                <label>Project Title *</label>
                <div class="d-flex gap-2">
                    <select name="project_title[]" class="form-select" required>
                        ${options}
                    </select>

                    <button type="button"
                        class="btn btn-danger btn-sm remove-btn"
                        onclick="removeProject(this)">
                        ✖
                    </button>
                </div>
            </div>

            <!-- Morning Update -->
            <div class="col-md-6 mb-3 inputs">
                <label>Morning Update *</label>
                <textarea name="morning_update[]" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Evening Update -->
            <div class="col-md-6 mb-3 inputs">
                <label>Evening Update</label>
                <textarea name="evening_update[]" class="form-control" rows="3"></textarea>
            </div>
    `;

            container.appendChild(block);
        }

        function removeProject(btn) {
            btn.closest('.projectBlock').remove();
        }


    </script>
</body>

</html>