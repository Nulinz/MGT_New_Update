<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Daily Report</h4>
    </div>
    <div class="mt-3 listtable">
        <div class="filter-container row mb-3">
            <div class="custom-search-container col-sm-12 col-md-8">
                <select class="form-select filter-option" id="headerDropdown4">
                    <option value="All" selected>All</option>
                </select>
                <input type="text" id="filterInput4" class="form-control" placeholder=" Search">
            </div>

            <div class="select1 col-sm-12 col-md-4 mx-auto">
                <div class="d-flex gap-3">
                    <a href="" id="pdfLink"><img src="./images/printer.png" id="print" alt="" height="35px"
                            data-bs-toggle="tooltip" data-bs-title="Print"></a>
                    <a href="" id="excelLink"><img src="./images/excel.png" id="excel" alt="" height="35px"
                            data-bs-toggle="tooltip" data-bs-title="Excel"></a>
                </div>
            </div>
        </div>

        <div class="table-wrapper">
            <table class="table table-hover table-striped" id="table4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Project Title</th>
                        <th>Morning update</th>
                        <th>Evening update</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $link = $db->link();

                    // Check DB connection
                    $res = mysqli_query($link, "SELECT DATABASE()");
                    $row = mysqli_fetch_row($res);
                    $sql = "
SELECT  
    dr.report_date,
    dr.project_title,
    dr.morning_update,
    dr.evening_update,
    e.name
FROM m_daily_report dr
JOIN m_emp e ON e.id = dr.emp_id
";
                    $qry = mysqli_query($link, $sql);

                    if (!$qry) {
                        die("SQL ERROR: " . mysqli_error($link));
                    }

                    // echo "Rows found: " . mysqli_num_rows($qry);
                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($qry)) {
                        echo "<tr>
            <td>{$counter}</td>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['report_date']) . "</td>
            <td>" . htmlspecialchars($row['project_title']) . "</td>
            <td>" . htmlspecialchars($row['morning_update']) . "</td>
            <td>" . htmlspecialchars($row['evening_update']) . "</td>
          </tr>";
                        $counter++;
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>