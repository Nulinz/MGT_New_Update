<div class="sidebodyhead mb-3">
    <h4 class="m-0">Create Task</h4>
</div>
<form action="" method="POST" id="my_form">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
            <label for="assignto">Assign To</label>
            <select class="form-select" name="assignto" id="assignto" autofocus>
                <option value="">Employee List</option>
                <?php
                $emp_det = $fetch->m_emp();
                foreach ($emp_det as $ed) {
                    ?>
                    <option value="<?php echo $ed['id']; ?>"><?php echo $ed['name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
            <label for="category">Category</label>
            <select name="cat" id="task_cat" class="form-select">
                <option selected true>Select Category</option>
                <?php
                $task = $fetch->task_list();
                foreach ($task as $tk) {
                    ?>
                    <option><?php echo $tk['task']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
            <label for="subcategory">Sub Category</label>
            <select name="sub_cat" id="sub_cat" class="form-select">
                <option selected true>Select Sub Category</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
            <label for="startdate">Start Date</label>
            <input type="date" class="form-control" name="st_date" id="startdate">
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
            <label for="enddate">End Date</label>
            <input type="date" class="form-control" name="end_date" id="enddatedate">
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
            <label for="time">Time</label>
            <input type="time" class="form-control" name="time" id="time">
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
            <label for="description">Description</label>
            <textarea rows="1" class="form-control" name="des" id="description"
                placeholder="Enter Description"></textarea>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-center mt-2">
            <input hidden type="text" name="up_task">
            <button type="submit" id="sub" class="formbtn">Save</button>
        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button
        const formData = new FormData(this);
        var task_id = '<?php echo $task_id; ?>';
        var pro_id = '<?php echo $tk_det['pro_id'] ?>';
        formData.append("task_id", task_id);
        formData.append("pro_id", pro_id);
        console.log(...formData.entries());
        // // Send data to PHP backend using Fetch API
        fetch('ajax.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (response.ok) {
                    //  console.log(response);
                    // If the request was successful (status 200-299)
                    return response.json(); // Parse the JSON data from the response
                } else {
                    // Handle error if the response was not successful
                    throw new Error("Request failed with status: " + response.status);
                }
            }) // Assuming the PHP backend sends JSON
            .then(data => {
                // console.log(data);
                if (data.status === 'success') {
                    popup(data.message,data.url);
                    // window.location.href = data.url;
                } else {
                    popup(data.message,data.url);
                    // window.location.href = data.url;
                    // alert("Error: " + data.message);
                }
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>

<script>
    $('#task_cat').on('change', function () {
        var drop = $(this).val();
        var formData = new FormData();
        formData.append('task_cat_drop', drop); // Append the selected value
        fetch('ajax_dep.php', {
            method: 'POST',
            body: formData,  // Make sure formData contains any necessary data
        })
            .then(response => {
                if (response.ok) {
                    return response.text(); // Expect HTML as a response, not JSON
                } else {
                    throw new Error("Request failed with status: " + response.status);
                }
            })
            .then(html => {
                console.log(html);
                // If the response is HTML, you can insert it into the DOM
                // For example, populate the dependent dropdown
                document.getElementById("sub_cat").innerHTML = html;
                // Optionally, you could trigger any further actions based on the data
                // For instance, enable the second dropdown if necessary
                // document.getElementById("dependentDropdown").disabled = false;
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>