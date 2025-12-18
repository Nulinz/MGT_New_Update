<?php
include('fetch.php');
if(isset($_GET['monthyear'],$_GET['employee'])){
    $mon_arr = $_GET['monthyear'];
    $emp_slip = $_GET['employee'];
    $mon_arr = explode('-', $mon_arr); // This will result in an array.

    $mon = $mon_arr[1];
    $year = $mon_arr[0];
    $dateStr = $year . '-' . $mon . '-01'; // e.g., "2025-03-01"

    $link = $db->link();

    $s_slip = "select * from `e_salary` where `mon`='$mon' and `year`='$year' and `emp`='$emp_slip'";
    $q_slip = mysqli_query($link,$s_slip);
    $d_slip = mysqli_fetch_assoc($q_slip);

    // print_r($d_slip);



}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Slip</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" sizes="32*32" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/salaryslip.css">

</head>

<body onload="window.print()">
    <section class="overall">

        <!-- Header -->
        <div class="nulinzheader">
            <div class="headerleft">
                <h5>Nulinz Education Private Limited</h5>
                <h6>1st Floor, NV Arcade Building, Near 5Roads, Next Reliance Mall, Salem-636004</h6>
            </div>
            <div class="headerright">
                <img src="./images/favicon.png" height="30px" alt="">
            </div>
        </div>

        <hr>

        <!-- Employee Details -->
        <div class="empdetails">
            <h5>Payslip for the month of <?php echo date('F',strtotime($dateStr)).",". $year; ?></h5>
            <h6>Employee Pay Summary</h6>
            <div class="emptable">
                <div class="tableleft">
                    <?php
                    $emp_dt = $fetch->table_list_id('m_emp','id',$emp_slip);
                    $emp_dt2 = $fetch->table_list_id('m_emp2','f_id',$emp_slip);
                    $emp_dt3 = $fetch->table_list_id('m_emp3','f_id',$emp_slip);
                    ?>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Employee Code</th>
                                <th>:</th>
                                <td><?php echo $emp_dt['emp_code']; ?></td>
                            </tr>
                            <tr>
                                <th>Employee Name</th>
                                <th>:</th>
                                <td><?php echo $emp_dt['name']; ?></td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <th>:</th>
                                <td><?php echo $emp_dt2['role']; ?></td>
                            </tr>
                            <tr>
                                <th>Account Number</th>
                                <th>:</th>
                                <td><?php echo $emp_dt3['ac_no']; ?></td>
                            </tr>
                            <tr>
                                <th>IFSC Code</th>
                                <th>:</th>
                                <td><?php echo $emp_dt3['ifsc']; ?></td>
                            </tr>
                            <tr>
                                <th>Branch Name</th>
                                <th>:</th>
                                <td><?php echo $emp_dt3['b_branch']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tableright">
                    <h6>Employee Basic Pay</h6>
                    <h4>₹<?php echo $emp_dt3['salary']; ?></h4>
                    <h6>Paid Days: <span><?php echo $pr_days = (26-$d_slip['lop']); ?></span> | LOP Days: <span><?php echo $d_slip['lop']; ?></span></h6>
                    <h6>Pay Date: <span><?php echo date('d-m-Y',strtotime($d_slip['c_on'])); ?></span></h6>
                </div>
            </div>
        </div>

        <hr>

        <!-- Earnings Table -->
        <div class="earningstable">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Earnings</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Basic</td>
                        <td><span>₹</span> <?php  echo $ba_pr= $emp_dt3['salary'] // $ba_pr = round((($emp_dt3['salary']/26)*$pr_days)); ?></td>
                    </tr>
                    <tr>
                        <td>House Rent Allowance(HRA)</td>
                        <td><span>₹</span> <?php echo $emp_dt3['hra']; ?></td>
                    </tr>
                    <tr>
                        <td>Conveyance</td>
                        <td><span>₹</span> <?php echo $emp_dt3['convey']; ?></td>
                    </tr>
                    <tr>
                        <td>Medical</td>
                        <td><span>₹</span> <?php echo $emp_dt3['medical']; ?></td>
                    </tr>
                    <tr>
                        <td>Special</td>
                        <td><span>₹</span> <?php echo $emp_dt3['special']; ?></td>
                    </tr>
                    <tr>
                        <td>Other</td>
                        <td><span>₹</span> <?php echo $emp_dt3['other']; ?></td>
                    </tr>
                    <tr>
                        <td>Incentive</td>
                        <td><span>₹</span> <?php echo $d_slip['inc']; ?></td>
                    </tr>
                    <tr>
                        <td>Additional</td>
                        <td><span>₹</span> <?php echo $d_slip['additional']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Amount<span>.</span></th>
                        <td><span>₹</span> <?php echo $ttl_sal = round($ba_pr+$emp_dt3['hra']+$emp_dt3['convey']+$emp_dt3['medical']+$emp_dt3['special']+$emp_dt3['other']+$d_slip['inc']+$d_slip['additional']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <div class="earningstable">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Deductions</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>LOP</td>
                        <td><span>₹</span> <?php echo $lop_amt =  round(($emp_dt3['net']/26)*$d_slip['lop']); ?></td>
                    </tr>
                    <tr>
                        <td>Permission</td>
                        <td><span>₹</span> <?php echo $per_amt = ($d_slip['per']*50); ?> </td>
                    </tr>
                    <tr>
                        <th>Total Amount.</th>
                        <td><span>₹</span> <?php echo $ded = round($lop_amt+$per_amt); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <div class="earningstable">
            <table class="table table-striped table-borderless">
                <tbody class="border-0">
                    <tr>
                        <td>Total Net Pay</td>
                        <td><span>₹</span> <?php echo $final  = $ttl_sal-$ded; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="totalpay">
            <h4><span class="totalcntnt">Total Net Payable - ₹ <?php echo $final; ?></span> <span class="totalwords">(<?php echo $fetch->money($final); ?>)</span></h4>
        </div>

    </section>


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>