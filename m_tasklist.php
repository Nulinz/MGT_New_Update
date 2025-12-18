<?php
// task_full_list.php
// Shows all rows from m_pro_task, with task_for resolved to m_emp.name
// and project details (id + title) pulled from m_pro
include('fetch.php'); // provides $fetch and DB connection + cookie check
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Task List</title>

    <!-- Project CSS / CDN -->
    <?php include("./cdn_style.php"); ?>
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/modal.css">

    <!-- DataTables CSS (safe fallback if not already included) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

    <div class="main">
        <?php include("./aside.php"); ?>

        <div class="side-body">
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 py-2">
                <h3 class="mb-3">Full Task List (m_pro_task)</h3>

                <div class="container-fluid mt-2 listtable">
                    <div class="table-wrapper">
                        <table id="fullTaskTable" class="example table table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Task</th>
                                    <th>Sub</th>
                                    <th>Task For</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Use the DB connection from your fetch object
                                $con = $fetch->con;

                                // Query the m_pro_task columns you specified, join m_emp for task_for -> name
                                // and join m_pro to fetch project details (id, title, ...).
                                $sql = "SELECT
                                            t.`id` AS task_id,
                                            t.`pro_id` AS pro_id,
                                            t.`type`, t.`seq`, t.`task`, t.`sub`, t.`task_for`,
                                            t.`st_date`, t.`st_time`, t.`end_date`, t.`title` AS task_title, t.`des`, t.`prior`,
                                            t.`initial`, t.`status` AS task_status, t.`c_on` AS task_c_on, t.`c_by` AS task_c_by,
                                            e.`name` AS emp_name,
                                            mp.`id` AS mp_id,
                                            mp.`title` AS mp_title
                                        FROM `m_pro_task` t
                                        LEFT JOIN `m_emp` e ON t.task_for = e.id
                                        LEFT JOIN `m_pro` mp ON t.pro_id = mp.id
                                        WHERE 1
                                        ORDER BY t.id DESC";

                                $q = mysqli_query($con, $sql);
                                if (!$q) {
                                    echo '<tr><td colspan="20">Query error: ' . htmlspecialchars(mysqli_error($con)) . '</td></tr>';
                                } else {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($q)) {
                                        // Safe output
                                        $mp_id = isset($row['mp_id']) ? (int)$row['mp_id'] : 0;
                                        $mp_title_raw = $row['mp_title'] ?? '';
                                        $task = htmlspecialchars($row['task']);
                                        $sub = htmlspecialchars($row['sub']);
                                        $emp_name = htmlspecialchars($row['emp_name']);
                                        $st_date = !empty($row['st_date']) ? date("d-m-Y", strtotime($row['st_date'])) : '';
                                        $end_date = !empty($row['end_date']) ? date("d-m-Y", strtotime($row['end_date'])) : '';
                                        $task_title = htmlspecialchars($row['task_title']);
                                        // keep description trimmed in cell, full on title attribute
                                        $des_raw = $row['des'] ?? '';
                                        $des_disp = htmlspecialchars($des_raw);
                                        if (strlen($des_disp) > 140) {
                                            $des_cell = substr($des_disp, 0, 140) . '...';
                                        } else {
                                            $des_cell = $des_disp;
                                        }

                                        // If project id is 0 (or missing), show "Company Activity"
                                        if ($mp_id === 0 || empty(trim($mp_title_raw))) {
                                            $display_project_title = 'Company Activity';
                                        } else {
                                            $display_project_title = htmlspecialchars($mp_title_raw);
                                        }

                                        echo "<tr>";
                                        echo "<td>{$i}</td>";
                                        // show project title (or Company Activity)
                                        echo "<td>{$display_project_title}</td>";
                                        echo "<td>{$task}</td>";
                                        echo "<td>{$sub}</td>";
                                        echo "<td>{$emp_name}</td>";
                                        echo "<td>{$st_date}</td>";
                                        echo "<td>{$end_date}</td>";
                                        echo "<td>{$task_title}</td>";
                                        echo "<td style='max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;' title=\"" . htmlspecialchars($des_raw) . "\">{$des_cell}</td>";
                                        echo "</tr>";

                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <?php include("./cdn_script.php"); ?>

    <script>
        $(document).ready(function () {
            var table = $('.example').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "bDestroy": true,
                "info": false,
                "responsive": true,
                "pageLength": 25,
                "dom": '<"top"f>rt<"bottom"lp><"clear">'
            });
        });
    </script>
</body>
</html>
