<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Salary details</h4>
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
                        <!-- <th>Month</th> -->
                        <th>Basic Salary</th>
                        <th>HRA</th>
                        <th>Convey</th>
                        <th>Special</th>
                        <th>Other</th>
                        <!-- <th>Permissions</th> -->
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $link = $db->link();
                    $res = mysqli_query($link, "SELECT DATABASE()");
                    $row = mysqli_fetch_row($res);
                    $sql = "
SELECT  
    s.salary,
    s.hra,
    s.convey,
    s.special,
    s.other,
    s.net
    FROM m_emp3 s
JOIN m_emp e ON e.id = s.f_id
WHERE s.f_id = $emp_id

";
                    $qry = mysqli_query($link, $sql);

                    if (!$qry) {
                        die("SQL ERROR: " . mysqli_error($link));
                    }

                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($qry)) {
                        echo "<tr>
            <td>{$counter}</td>
            <td>" . htmlspecialchars($row['salary']) . "</td>
            <td>" . htmlspecialchars($row['hra']) . "</td>
            <td>" . htmlspecialchars($row['convey']) . "</td>
            <td>" . htmlspecialchars($row['special']) . "</td>
            <td>" . htmlspecialchars($row['other']) . "</td>
            <td>" . htmlspecialchars($row['net']) . "</td>
          </tr>";
                        $counter++;
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>