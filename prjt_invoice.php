<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Invoice Details</h4>
        <a href="./add_prjt_quotation.php?pro=<?php echo $pro_id; ?>&type=inv"><button class="listbtn">+ Add Invoice</button></a>
    </div>
    <div class="mt-3 listtable">
        <div class="filter-container row mb-3">
            <div class="custom-search-container col-sm-12 col-md-8">
                <select class="form-select filter-option" id="headerDropdown3">
                    <option value="All" selected>All</option>
                </select>
                <input type="text" id="filterInput3" class="form-control filterInput" placeholder=" Search">
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
            <table class="table table-hover table-striped" id="table3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice No</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $inv = $fetch->quot_list('m_inv',$pro_id,'inv');
                     $i=1;
                     foreach($inv as $in){

                        // echo $in['status'];

                         $inv_id = $in['id'];

                         $inv_list = $fetch->inv_list($inv_id,'inv');
                        //  echo "<pre>";
                        //  print_r($inv_list);




                     ?>
                    <tr>
                    <td><?php echo $i;$i++; ?></td>
                        <td><?php echo $in['id']; ?></td>
                        <td>

                           <?php
                           foreach($inv_list as $index => $in_li) {
                            // Fetch the title for the current item
                            $ser_list = $fetch->table_list_id('m_service', 'id', $in_li['ser']);

                            // Echo the title
                            echo $ser_list['ser_name'];

                            // Add a comma unless it's the last item in the array
                            if ($index < count($inv_list) - 1) {
                                echo ",";
                            }
                        }
                           ?>
                        </td>
                        <td><?php echo $in['total']; ?></td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="./pdf_quotation.php?quot=<?php echo $in['id']; ?>&type=inv"><i class="fa-solid fa-print"></i></a>
                                <?php
                                    if(empty($in['gst'])){
                                        ?>

                                        <a  href="./ajax.php?update_gst=<?php echo $in['id']; ?>&pro_ind=<?php echo $pro_ind; ?>" onclick="return confirm('Are you sure you want to update GST?');" class="listtdbtn">Update</a>
                                        <?php
                                    }else{
                                        ?>
                                        <?php echo $in['gst']; ?>
                                        <?php
                                    }
                                    ?>
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