<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Meeting Details</h4>
        <a href="./add_prjt_meeting.php?pro=<?php echo $pro_id; ?>"><button class="listbtn">+ Add Meeting</button></a>
    </div>
    <div class="mt-3 listtable">
        <div class="filter-container row mb-3">
            <div class="custom-search-container col-sm-12 col-md-8">
                <select class="form-select filter-option" id="headerDropdown7">
                    <option value="All" selected>All</option>
                </select>
                <input type="text" id="filterInput7" class="form-control" placeholder=" Search">
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
            <table class="table table-hover table-striped" id="table7">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Meeting Type</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Meeting Link</th>
                        <th>Persons Invloved</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $meet_lt = $fetch->table_list_arr('m_meeting','f_id',$pro_id);
                        $m=1;
                        foreach($meet_lt as $mt){

                            $meet_arr = json_decode($mt['emp']);
                            $m_last = end($meet_arr);
                    ?>
                    <tr>
                        <td><?php echo $m++; ?></td>
                        <td><?php echo $mt['m_type']; ?></td>
                        <td><?php echo date("d-m-Y h:m",strtotime($mt['date'].$mt['time'])); ?></td>
                        <td><?php echo $mt['des']; ?></td>
                        <td><?php echo $mt['loc']; ?></td>

                        <td><?php
                        foreach($meet_arr as $ml){

                            $emp_lt = $fetch->table_list_id('m_emp','id',$ml);

                            if ($ml === $m_last) {
                                echo $emp_lt['name'];  // Print the last element without a comma
                            } else {
                                echo $emp_lt['name'] . ', ';  // Print with a comma for others
                            }
                        }
                        ?></td>
                        <td><?php echo $mt['status']; ?></td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="./edit_prjt_meeting.php?meet_id=<?php echo $mt['id']; ?>" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
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