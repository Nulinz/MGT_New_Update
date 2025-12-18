<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Quotation Details</h4>
        <a href="./add_prjt_quotation.php?pro=<?php echo $pro_id; ?>&type=quot"><button class="listbtn">+ Add
                Quotation</button></a>
    </div>
    <div class="mt-3 listtable">
        <div class="filter-container row mb-3">
            <div class="custom-search-container col-sm-12 col-md-8">
                <select class="form-select filter-option" id="headerDropdown2">
                    <option value="All" selected>All</option>
                </select>
                <input type="text" id="filterInput2" class="form-control" placeholder=" Search">
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
            <table class="table table-hover table-striped" id="table2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Quotation No</th>
                        <th>Items</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $quot = $fetch->quot_list('m_quot',$pro_id, 'quot');
                    // echo "<pre>";
                    // print_r($quot);
                    $i = 1;
                    foreach ($quot as $qt) {

                         $pro_ind = $qt['f_id'];

                        ?>
                        <tr>
                            <td><?php echo $i;
                            $i++; ?></td>
                            <td><?php echo $qt['id']; ?></td>
                            <td><?php echo $qt['item']; ?></td>
                            <td><?php echo $qt['total']; ?></td>
                            <td>
                                <div class="d-flex gap-3 align-items-center">
                                    <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="./pdf_quotation.php?quot=<?php echo $qt['id']; ?>&type=quot"><i class="fa-solid fa-print"></i></a>
                                    <?php
                                    if($qt['status']=='Active'){
                                        ?>

                                        <a  href="./ajax.php?update=<?php echo $qt['id']; ?>&pro_ind=<?php echo $pro_ind; ?>" onclick="return confirm('Are you sure you want to update Quotation Finalise?');" class="listtdbtn">Update</a>
                                        <?php
                                    }else{
                                        ?>
                                        <?php echo $qt['status']; ?>
                                        <?php
                                    }
                                    ?>
                                    <!-- <a href=""><i class="fa-solid fa-trash text-danger"></i></a>
                                <a href=""><i class="fa-solid fa-circle-check text-success"></i></i></a> -->
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