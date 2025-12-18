<?php

include('fetch.php');
$link = $db->link();

if (!isset($_SESSION['emp_id'])) {
    header("Location: index.php");
    exit;
}

$emp_id = $_SESSION['emp_id']; // logged-in user ID

/* 🔎 Get employee role */
$emp2 = $fetch->table_list_id('m_emp2', 'f_id', $emp_id);

$role = $emp2['role'] ?? '';
$today = date('Y-m-d');

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

/* 💾 Save report */
if (isset($_POST['save_report'])) {

    // $project = $_POST['project_id'];
    $project = $_POST['project_title'];
    $morning = $_POST['morning_update'];
    $evening = $_POST['evening_update'];

    mysqli_query(
        $link,
        "INSERT INTO m_daily_report
        (emp_id, project_title, report_date, morning_update, evening_update)
        VALUES
        ('$emp_id','$project','$today','$morning','$evening')"
    );

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
                        <div class="row">

                            <!-- Name -->
                            <div class="col-md-4 mb-3 inputs">
                                <label>Name</label>
                                <input type="text" class="form-control" value="<?php echo $emp['name']; ?>" readonly>
                            </div>

                            <!-- Date -->
                            <div class="col-md-4 mb-3 inputs">
                                <label>Date</label>
                                <input type="date" class="form-control" value="<?php echo $today; ?>" readonly>
                            </div>

                            <!-- Project -->
                            <!-- <div class="col-md-4 mb-3 inputs">
                                <label>Project</label>
                                <select name="project_id" class="form-select" required>
                                    <option value="">Select Project</option>
                                    <?php
                                    $pro = $fetch->table_list_arr('m_pro', 'status', 'Active');
                                    foreach ($pro as $p) {
                                        echo "<option value='{$p['id']}'>{$p['title']}</option>";
                                    }
                                    ?>
                                </select>
                            </div> -->

                            <!-- Project Title -->
                            <div class="col-md-4 mb-3 inputs">
                                <label>Project Title *</label>
                                <input type="text" name="project_title" class="form-control"
                                    placeholder="Enter project name" required>
                            </div>


                            <!-- Morning Update -->
                            <div class="col-md-6 mb-3 inputs">
                                <label>Morning Update *</label>
                                <textarea name="morning_update" class="form-control" rows="3" required></textarea>
                            </div>

                            <!-- Evening Update -->
                            <div class="col-md-6 mb-3 inputs">
                                <label>Evening Update</label>
                                <textarea name="evening_update" class="form-control" rows="3"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" name="save_report" class="formbtn">
                            Submit
                        </button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <?php include("./cdn_script.php"); ?>
</body>

</html>