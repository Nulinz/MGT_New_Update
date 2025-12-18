<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Document Details</h4>
        <a href="./add_prjt_document.php?pro=<?php echo $pro_id; ?>"><button class="listbtn">+ Add Document</button></a>
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
                        <th>Title</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $pro_doc = $fetch->pro_docs($pro_id,'PROJECT');
                    //  print_r($pro_doc);
                     $i=1;
                     foreach($pro_doc as $pd){
                    ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>

                        <td><?php echo $pd['title']; ?></td>
                        <td><a href="./img/<?php echo $pd['file']; ?>" download>Download</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>