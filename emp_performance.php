<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Performance Details</h4>
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
                        <th>Month</th>
                        <th>Target</th>
                        <th>Acheived</th>
                        <th>Remaining</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $per_lt = $fetch->list_target_ind($emp_id);
                    // echo "<pre>";
                    // print_r($per_lt);
                    // echo "</pre>";
                    $i=1;
                    foreach($per_lt as $per){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $per['mon_name']; ?></td>
                        <td><?php echo $per['target']; ?></td>
                        <td><?php echo $per['pro_amt'] ?? 0; ?></td>
                        <td><?php echo $per['target']-$per['pro_amt']; ?></td>



                        <td>
                            <div class="d-flex gap-3">
                                <a href="./view_employee.php"><i class="fas fa-eye"></i></a>
                                <a href="./edit_employee.php"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
