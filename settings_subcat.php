<form action="" method="POST" id="my_form1">
    <div class="container-fluid maindiv bg-white">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="category">Category <span>*</span></label>
                <select class="form-select" name="task_cat" id="" autofocus required>
                    <option value="" selected disabled>Select Options</option>
                    <?php
                    $task = $fetch->m_cat_value('Task Category');

                    foreach ($task as $tk) {
                    ?>
                        <option value="<?php echo $tk['title']; ?>"><?php echo $tk['title']; ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="subcat">Sub Category <span>*</span></label>
                <input type="text" class="form-control" name="sub_cat" id="" placeholder="Enter Title" required>
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
        <input hidden name="add_sub_cat">
        <button type="submit" id="sub" class="formbtn">Save</button>
    </div>
</form>

<div class="sidebodyhead mt-4">
    <h4 class="m-0">Sub Category Details</h4>
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
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sub_arr = $fetch->table_list('m_sub_task');
                $i = 1;
                foreach ($sub_arr as $s) {

                ?>
                    <tr>
                        <td><?php echo $i;
                            $i++; ?></td>
                        <td><?php echo $s['task']; ?></td>
                        <td><?php echo $s['sub']; ?></td>
                        <td><?php echo $s['status']; ?></td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="./edit_category.php?cat_id=<?php echo $s['id']; ?>&type=sub_cat" data-bs-toggle="tooltip"
                                    data-bs-title="Edit"><i class="fas fa-pen-to-square"></i></a>
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

<script>
    document.getElementById("my_form1").addEventListener("submit", function(event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        // Collect form data
        const formData = new FormData(this);

        //  formData.append("additionalKey", value);

        console.log(...formData.entries());

        // // Send data to PHP backend using Fetch API
        fetch('ajax.php', {
                method: 'POST',
                body: formData,

            })
            .then(response => {

                if (response.ok) {
                    // console.log(response);
                    // If the request was successful (status 200-299)
                    return response.json(); // Parse the JSON data from the response
                } else {
                    // Handle error if the response was not successful
                    throw new Error("Request failed with status: " + response.status);
                }
            }) // Assuming the PHP backend sends JSON
            .then(data => {
                console.log(data);
                if (data.status === 'success') {
                    window.location.href = data.url;

                } else {
                    // popup();
                    window.location.href = data.url;
                    // alert("Error: " + data.message);
                }
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>