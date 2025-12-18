<div class="empdetails">
    <div class="cards mt-3">

    <?php
    $ed2 = $fetch->table_list_id('m_emp2','f_id',$emp_id);
    ?>

        <div class="jobdetails mb-3">
            <div class="maincard row">
                <a class="editicon" href="./edit_emp_job.php?emp_id=<?php echo $emp_id; ?>" data-bs-toggle="tooltip" data-bs-title="Edit Job">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Role</h6>
                    <h5 class="mb-0"><?php echo $ed2['role']; ?> - [<?php echo $ed2['level']; ?>]</h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Job Title</h6>
                    <h5 class="mb-0"><?php echo $ed2['title']; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Job Type</h6>
                    <h5 class="mb-0"><?php echo $ed2['type']; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Experience</h6>
                    <h5 class="mb-0"><?php echo $ed2['exp']; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Professionally Skilled In</h6>
                    <h5 class="mb-0"><?php echo $ed2['skill']; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Preferred Start Date</h6>
                    <h5 class="mb-0"><?php echo date("d-m-Y",strtotime($ed2['st_date'])); ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Relieving Date</h6>
                    <h5 class="mb-0"><?php echo date("d-m-Y",strtotime($ed2['re_date'])); ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Reason For Leaving</h6>
                    <h5 class="mb-0"><?php echo $ed2['reason']; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Do You have Own Laptop</h6>
                    <h5 class="mb-0"><?php echo $ed2['lap']; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Verification</h6>
                    <h5 class="mb-0"><?php echo $ed2['verify']; ?></h5>
                </div>
            </div>
        </div>

        <?php
    $ed3 = $fetch->table_list_id('m_emp3','f_id',$emp_id);
    ?>

        <div class="bankdetails mb-3">
            <div class="maincard row">
                <a class="editicon" href="./edit_emp_bank.php?emp_id=<?php echo $emp_id; ?>" data-bs-toggle="tooltip" data-bs-title="Edit Bank">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Bank Name</h6>
                    <h5 class="mb-0"><?php echo $ed3['b_name'] ?? 'No data'; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Bank Account Holder Name</h6>
                    <h5 class="mb-0"><?php echo $ed3['ac_name'] ?? 'No data'; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Bank Account Number</h6>
                    <h5 class="mb-0"><?php echo $ed3['ac_no'] ?? 'No data'; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">IFSC Code</h6>
                    <h5 class="mb-0"><?php echo $ed3['ifsc'] ?? 'No data'; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Account Type</h6>
                    <h5 class="mb-0"><?php echo $ed3['ac_type'] ?? 'No data'; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Bank Branch</h6>
                    <h5 class="mb-0"><?php echo $ed3['b_branch'] ?? 'No data' ; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Basic Salary</h6>
                    <h5 class="mb-0"><?php echo $ed3['salary'] ?? 'No data'; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Provident Fund</h6>
                    <h5 class="mb-0"><?php echo $ed3['pf'] ?? 'No data'; ?></h5>
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Employment State Insurance</h6>
                    <h5 class="mb-0"><?php echo $ed3['esi'] ?? 'No data'; ?></h5>
                </div>
            </div>
        </div>

        <?php
        $ed4 = $fetch->table_list_arr('m_file','f_id',$emp_id);



        $file_types = ['aadhar','expcertify','slyslip','agreement','certification'];

        foreach ($ed4 as $item) {
            // Use the 'type' as the key and 'file' as the value
            $file_data[$item['type']] = $item['file'];
        }
            // print_r($file_data);

        ?>

        <div class="docdetails mb-3">
            <div class="maincard row">
                <a class="editicon" href="./edit_emp_document.php?emp_id=<?php echo $emp_id; ?>" data-bs-toggle="tooltip" data-bs-title="Edit Document">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Aadhar Card</h6>
                    <img src="./img/<?php echo $file_data['aadhar'] ?? 'nil'; ?>" height="150px" alt="Aadhar">
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Experience Certificate</h6>
                    <img src="./img/<?php echo $file_data['expcertify'] ?? 'nil'; ?>" height="150px" alt="Experience">
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Salary Slip</h6>
                    <img src="./img/<?php echo $file_data['slyslip'] ?? 'nil'; ?>" height="150px" alt="Salary">
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Agreement</h6>
                    <img src="./img/<?php echo $file_data['agreement'] ?? 'nil'; ?>" height="150px" alt="Agreement">
                </div>
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3">
                    <h6 class="mb-1">Certifications</h6>
                    <img src="./img/<?php echo $file_data['certification'] ?? 'nil'; ?>" height="150px" alt="Certifications">
                </div>
            </div>
        </div>

    </div>
</div>