<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Payment Details</h4>
        <a href="./add_prjt_payment.php?pro=<?php echo $pro_id; ?>"><button class="listbtn">+ Add Payment</button></a>
    </div>
    <div class="mt-3 listtable">
        <div class="filter-container row mb-3">
            <div class="custom-search-container col-sm-12 col-md-8">
                <select class="form-select filter-option" id="headerDropdown5">
                    <option value="All" selected>All</option>
                </select>
                <input type="text" id="filterInput5" class="form-control" placeholder=" Search">
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
            <table class="table table-hover table-striped" id="table5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //  $pay = $fetch->table_list_arr('m_payment','f_id',$pro_id);
                    
                    $s_qt = "select * from `m_quot` where `f_id`='$pro_id' and `status`='final'";
                    $q_qt = mysqli_query($link, $s_qt);
                    $i = 1;
                    while ($d_qt = mysqli_fetch_assoc($q_qt)) {

                        $q_id = $d_qt['id'];

                        $s_pay = "select * from `m_payment` where `q_no`='$q_id'";
                        $q_pay = mysqli_query($link, $s_pay);
                        $d_pay = mysqli_fetch_assoc($q_pay);


                        // print_r($pay);
                    
                        // foreach($pay as $p){
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $d_pay['amt'] ?? '—'; ?></td>
                            <td><?php echo $d_pay['status'] ?? 'Pending'; ?></td>
                            <td>
                                <?php if (!empty($d_pay['file'])) { ?>
                                    <a href="./img/<?php echo $d_pay['file']; ?>">Download</a>
                                <?php } else { ?>
                                    Not Uploaded
                                <?php } ?>
                            </td>
                            <td>
                                <i class="fa-solid fa-pen-to-square"></i>
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