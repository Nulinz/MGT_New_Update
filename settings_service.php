<form action="" method="POST" id="my_form2">
    <div class="container-fluid maindiv bg-white">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="servicetype">Service Type <span>*</span></label>
                <input type="text" class="form-control" name="ser_type" id=""
                    placeholder="Enter Service Type" required>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="hsn">HSN Code <span>*</span></label>
                <input type="text" class="form-control" name="hsn" id="" placeholder="Enter HSN Code" required>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="gst">GST <span>*</span></label>
                <input type="text" class="form-control" name="gst" id="" placeholder="Enter GST" required>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
        <input hidden type="text" name="add_ser">
        <button type="submit" id="sub" class="formbtn">Save</button>
    </div>
</form>

<div class="sidebodyhead mt-4">
    <h4 class="m-0">Service Type Details</h4>
</div>
<div class="mt-3 listtable">
    <div class="filter-container row mb-3">
        <div class="custom-search-container col-sm-12 col-md-8">
            <select class="form-select filter-option" id="headerDropdown3">
                <option value="All" selected>All</option>
            </select>
            <input type="text" id="filterInput3" class="form-control" placeholder=" Search">
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
                    <th>Service Type</th>
                    <th>HSN Code</th>
                    <th>GST</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ser_arr = $fetch->table_list('m_service');
                $i = 1;
                foreach ($ser_arr as $s) {

                ?>
                    <tr>
                        <td><?php echo $i;
                            $i++; ?></td>
                        <td><?php echo $s['ser_name']; ?></td>
                        <td><?php echo $s['hsn']; ?></td>
                        <td><?php echo $s['gst']; ?></td>
                        <td><?php echo $s['status']; ?></td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="./edit_service.php?ser_id=<?php echo $s['id']; ?>" data-bs-toggle="tooltip"
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
    document.getElementById("my_form2").addEventListener("submit", function(event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        // Collect form data
        const formData = new FormData(this);

        //  formData.append("additionalKey", value);

        console.log(...formData.entries());

        // // // Send data to PHP backend using Fetch API
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