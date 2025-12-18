<?php
include('fetch.php');

if(isset($_GET['emp_crm'])){
    $emp_crm = $_GET['emp_crm'];

    $crm_pdf = $fetch->crm_pdf($emp_crm);

     $cr = $fetch->c_on();

    $emp_sub =  $fetch->table_list_id('m_emp','id',$crm_pdf[0]['tk']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $emp_sub['name']."-".$cr; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" sizes="32*32" type="image/png">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="./css/pdf.css">

</head>

<body onload="window.print()">

    <div class="container1">
        <div class="head">


            <h3><?php echo $emp_sub['name']; ?> - <?php echo date("d-m-Y h:m a"); ?></h3>
            <?php
            //  echo "<pre>";
              $emp_list = $fetch->crm_tbl();
            foreach($emp_list as $employee_data){


                 $emp_i = $employee_data['CS']['tk'] ?? $employee_data['L1']['tk'] ?? $employee_data['L2']['tk'] ?? 0;

                // echo $employee_data[];
                if(($emp_i != $emp_crm)){
                    continue;
                }
                ?>
                <div class="headflex">
                    <h4>L1: <span><?php echo (isset($employee_data['L1']) ? $employee_data['L1']['total_pro_val'] : '0'); ?></span></h4>
                    <h4>L2: <span><?php echo (isset($employee_data['L2']) ? $employee_data['L2']['total_pro_val'] : '0'); ?></span></h4>
                    <h4>CS: <span><?php echo (isset($employee_data['CS']) ? $employee_data['CS']['total_pro_val'] : '0'); ?></span></h4>
                    <h4>TL: <span>
                    <?php
                            // Calculate TL as the sum of L1, L2, and CS
                            $l1_value = isset($employee_data['L1']) ? $employee_data['L1']['total_pro_val'] : 0;
                            $l2_value = isset($employee_data['L2']) ? $employee_data['L2']['total_pro_val'] : 0;
                            $cs_value = isset($employee_data['CS']) ? $employee_data['CS']['total_pro_val'] : 0;

                            $tl_value = $l1_value + $l2_value + $cs_value;
                            echo $tl_value;
                        ?>
                    </span></h4>
                </div>
                <?php
            }
            ?>

        </div>

        <div class="listtable">
            <table class="table">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Sub</th>
                        <th>Company</th>
                        <th>Project</th>
                        <th>Description</th>
                        <th>Quotation</th>
                        <th>value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // echo "<pre>";
                    // print_r($crm_pdf);

                        $sub_count = 1; // Employee counter
                        foreach ($crm_pdf as $crm) {


                        $cmp_cat =  $fetch->table_list_id('m_cmp','id',$crm['c_id']);
                        $cmp_category = $cmp_cat['c_cat'];
                        $cat_lt =  $fetch->table_list_id('m_cat','id',$cmp_category);
                        $plat_arr = json_decode($crm['plat_form']);
                            $p_last = end($plat_arr);

                            $emp_cby =  $fetch->table_list_id('m_emp','id',$crm['c_by']);
                    ?>
                    <tr>
                        <td><?php echo $sub_count++; ?></td>

                        <td><?php echo $crm['sub']; ?></td>

                        <td><?php echo $cmp_cat['c_name']; ?> <br> <?php echo $cat_lt['title']; ?></td>
                        <td><?php echo $crm['title']; ?> <br> <?php echo $crm['lead']; ?> - PF:
                        <?php
                            foreach($plat_arr as $pl){
                                switch($pl){
                                    case 'web':
                                        $pl='W';
                                        break;
                                    case 'android':
                                        $pl='A';
                                        break;
                                    case 'ios':
                                        $pl='I';
                                        break;
                                }
                                if ($pl === $p_last) {
                                    echo $pl;  // Print the last element without a comma
                                } else {
                                    echo $pl . ', ';  // Print with a comma for others
                                }
                            }
                            ?>

                        </td>
                        <td><?php echo $emp_cby['name']." -  ".date("d-m-Y",strtotime($crm['tk_start'])); ?> <br> <?php echo $crm['des']; ?></td>
                        <td>
                            <?php
                           $quot_lt =  $fetch->table_list_arr('m_quot','f_id',$crm['pro_id']);

                           $link = $db->link();

                           foreach($quot_lt as $qlt){

                           $e_quto = "SELECT SUM(qty*cost)as qt_amt,id from `e_quot` where `f_id`={$qlt['id']}";
                           $q_quot = mysqli_query($link,$e_quto);
                           while($d_quot=mysqli_fetch_assoc($q_quot)){
                                    echo "Q-".$d_quot['id']."=".($d_quot['qt_amt']/10000)."<br>";
                           }

                        }

                            ?>
                        </td>


                        <td><?php echo $crm['pro_val']/10000; ?></td>

                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>