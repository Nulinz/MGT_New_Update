<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Notes Details</h4>
        <a href="./add_prjt_notes.php?pro=<?php echo $pro_id; ?>"><button class="listbtn">+ Add Notes</button></a>
    </div>
    <div class="mt-3 listtable">
        <div class="filter-container row mb-3">
            <div class="custom-search-container col-sm-12 col-md-8">
                <select class="form-select filter-option" id="headerDropdown6">
                    <option value="All" selected>All</option>
                </select>
                <input type="text" id="filterInput6" class="form-control" placeholder=" Search">
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
            <table class="table table-hover table-striped" id="table6">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Links</th>
                        <th>Attachments</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $pr_lt = $fetch->table_list_arr('m_notes','f_id',$pro_id);
                        $p=1;
                       foreach($pr_lt as $pr){
                    ?>
                    <tr>
                        <td><?php echo $p++; ?></td>
                        <td><?php echo $pr['title'];?></td>
                        <td><?php echo $pr['des'];?></td>
                        <td><?php echo $pr['link'];?></td>
                        <td><a href="./img/<?php echo $pr['file']; ?>" download>Download</a></td>

                        <td>
                            <div class="d-flex gap-3">
                                <i class="fa-solid fa-pen-to-square"></i>
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