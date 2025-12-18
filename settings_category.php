<form action="" method="POST" id="my_form">
    <div class="container-fluid maindiv bg-white">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="role">Category <span>*</span></label>
                <select class="form-select" name="category" id="category" autofocus required>
                    <option value="" selected disabled>Select Options</option>
                    <option value="Task Category">Task Category</option>
                    <option value="Employee Category">Employee Category</option>
                    <option value="Company Category">Company Category</option>
                    <option value="Company Type">Company Type</option>
                    <option value="Lead Type">Lead Type</option>
                    <!-- <option value="Service Type">Service Type</option> -->
                    <option value="Businessing With">Businessing With</option>
                    <option value="Document">Document</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="title">Title <span>*</span></label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="description">Description</label>
                <textarea rows="1" class="form-control" name="description" id="description"
                    placeholder="Enter Description"></textarea>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
        <input hidden name="add_cat">
        <button type="submit" id="sub" class="formbtn">Save</button>
    </div>
</form>

<div class="sidebodyhead mt-4">
    <h4 class="m-0">Category Details</h4>
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
                    <th>Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cat_arr = $fetch->m_cat();
                $i = 1;
                foreach ($cat_arr as $c) {

                ?>
                    <tr>
                        <td><?php echo $i;
                            $i++; ?></td>
                        <td><?php echo $c['cat']; ?></td>
                        <td><?php echo $c['title']; ?></td>
                        <td><?php echo $c['des']; ?></td>
                        <td><?php echo $c['status']; ?></td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="./edit_category.php?cat_id=<?php echo $c['id']; ?>&type=category" data-bs-toggle="tooltip"
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
    document.getElementById("my_form").addEventListener("submit", function(event) {

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
                    window.location.href = data.url;
                    // alert("Error: " + data.message);
                }
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>