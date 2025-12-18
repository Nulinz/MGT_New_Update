<div class="empdetails">
    <div class="sidebodyhead">
        <h4 class="m-0">Project Details</h4>
        <a href="./add_project.php?com=<?php echo $com_id; ?>"><button class="listbtn">+ Add Project</button></a>
    </div>
    <div class="mt-3 listtable">
        <div class="filter-container row mb-3">
            <div class="custom-search-container col-sm-12 col-md-8">
                <select class="form-select filter-option" id="headerDropdown1">
                    <option value="All" selected>All</option>
                </select>
                <input type="text" id="filterInput1" class="form-control" placeholder=" Search">
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
            <table class="table table-hover table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project</th>
                        <th>Lead</th>
                        <th>Start Date</th>
                        <th>Required Date</th>
                        <th>Status</th>
                        <th>Cat - Sub</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                         $pro_det = $fetch->table_list_arr('m_pro','c_id',$com_id);

                        //  echo "<pre>";
                        //   print_r($pro_det);
                        $i=1;
                           foreach($pro_det as $pd){



                            $link = $db->link();

                            $s_tk = "SELECT * from `m_task` where `pro_id`='{$pd['id']}' order by `id` DESC ";
                            $q_tk = mysqli_query($link,$s_tk);
                            $d_tk = mysqli_fetch_assoc($q_tk);
                            // print_r($d_tk);


                    ?>
                    <tr>
                        <td><?php echo $i;$i++; ?></td>
                        <td><?php echo $pd['title']; ?></td>
                        <td><?php echo $pd['lead']; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($pd['st_date'])); ?></td>
                        <td><?php echo date("d-m-Y",strtotime($pd['re_date'])); ?></td>
                        <td><?php echo $pd['status']; ?></td>
                        <td><?php echo $d_tk['task']; ?> - <?php echo $d_tk['sub']; ?></td>
                        <td>
                            <div class="d-flex gap-3">
                                <a target="__blank" href="./view_project.php?pro=<?php echo $pd['id']; ?>" data-bs-toggle="tooltip" data-bs-title="View Profile"><i
                                        class="fas fa-eye"></i></a>
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