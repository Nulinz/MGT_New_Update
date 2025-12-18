<?php
include('fetch.php');

if (isset($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task Schedule</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/list.css">

</head>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-5 py-3 mb-3">
                <div class="sidebodyback mb-3" onclick="goBack()">
                    <div class="backhead">
                        <h5><i class="fas fa-arrow-left"></i></h5>
                        <h6>Add Task Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Task Details</h4>
                    <button type="button" class="addbtn" id="addButton">+ Add</button>
                </div>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="employee">Employee</label>
                                <select class="form-select" name="assignto[]" id="input1" autofocus>
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
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="category">Category</label>
                                <select name="cat[]" id="input2" class="form-select task_cat">
                                    <option value="" selected true>Select Category</option>
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
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="subcategory">Sub Category</label>
                                <select name="sub_cat[]" id="input3" class="form-select sub_cat">
                                    <option value="" selected true>Select Sub Category</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="startdate">Start Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="startdate[]" id="input4">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="enddate">End Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="enddate[]" id="input5">
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" name="time[]" id="input6">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="description">Title</label>
                                <input type="text" class="form-control"
                                    name="title[]" id="input7" placeholder="Enter Title">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="description">Description</label>
                                <textarea rows="1" class="form-control" name="description[]" id="input8"
                                    placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="description">Priority</label>
                                <select name="prior[]" id="input9" class="form-select">
                                    <option value="">Select Prior</option>
                                    <option>Prior</option>
                                    <option>Non Prior</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="file">File</label>
                                <input type="file" class="form-control" id="input10">
                            </div>
                        </div>

                        <div class="container-fluid px-0">
                            <table id="dataTable" class="table">
                                <thead style="display: none;">
                                    <tr>
                                        <th>Employee</th>
                                        <th>Cat</th>
                                        <th>Sub Category</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Time</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Priority</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Values will be inserted here -->
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <!-- <input hidden  type="text" name="add_sc_file" value="submit"> -->
                        <button type="submit" id="sub" class="formbtn">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        sessionStorage.clear();
        // displayValues();
    });

    // Function to retrieve and display values from session storage
    function displayValues(values_sh) {

        // const values_sh = JSON.parse(sessionStorage.getItem('inputValues')) || []; // Retrieve the values
        console.log(values_sh);

        const tableBody = document.querySelector('#dataTable tbody');
        tableBody.innerHTML = ''; // Clear the existing table body content

        values_sh.forEach((values_sh1, index) => {
            const row = document.createElement('tr');
            // Check if the value is a file URL or Base64 encoded data, and display it as a link
            if (values_sh1[9]) {
                // If the file is a Base64 string, display it as a downloadable link
                if (values_sh1[9].startsWith('data:image/')) {
                    fileLink = `<a href="${values_sh1[9]}" target="_blank">View Image</a>`;
                } else {
                    let fileLink1 = 'No File'; // Default value
                    // Otherwise, treat it as a regular file URL
                    fileLink = `<a href="${values_sh1[9]}" target="_blank">View File</a>`;
                }
            }

            // <td>${fileLink}</td>

            // Create table row with values
            row.innerHTML = `
            <td>${values_sh1[10]}</td>
            <td>${values_sh1[1]}</td>
            <td>${values_sh1[2]}</td>
            <td>${values_sh1[3]}</td>
            <td>${values_sh1[4]}</td>
            <td>${values_sh1[5]}</td>
            <td>${values_sh1[6]}</td>
            <td>${values_sh1[7]}</td>
            <td>${values_sh1[8]}</td>
            <td>${fileLink}</td>
            <td><a href="javascript:void(0);" onclick="deleteRow(${index})"><i class="fas fa-trash text-danger"></i></a></td>
        `;
            tableBody.appendChild(row); // Add the new row to the table
        });

        // // Optionally show or hide the table header based on whether there are values
        // const tableHeader = document.querySelector('#dataTable thead');
        // if (values.length > 0) {
        //     tableHeader.style.display = '';  // Show header
        // } else {
        //     tableHeader.style.display = 'none';  // Hide header if no data
        // }
    }

    function addInputs() {
        const input1 = document.querySelector('#input1').value;
        const input_name = $('#input1 option:selected').text();
        const input2 = document.querySelector('#input2').value;
        const input3 = document.querySelector('#input3').value;
        const input4 = document.querySelector('#input4').value;
        const input5 = document.querySelector('#input5').value;
        const input6 = document.querySelector('#input6').value;
        const input7 = document.querySelector('#input7').value;
        const input8 = document.querySelector('#input8').value;
        const input9 = document.querySelector('#input9').value;
        const input10 = document.querySelector('#input10').files[0]; // Get the file

        // console.log(input1, input2, input3, input4, input5, input6, input7, input8, input9,input10);
        //  console.log(input8);


        if (input1 && input_name && input2 && input3 && input4 && input5 && input6 && input7 && input8 && input9) {
            // If a file is selected, create a URL for the file
            if (input10) { // If a file is selected
                const reader = new FileReader();

                // Define the onloadend function to handle the file once it's read
                reader.onloadend = function() {
                    // Get the base64 encoded string from the file
                    const base64File = reader.result;

                    // Get the existing values in sessionStorage or initialize as an empty array
                    const values = JSON.parse(sessionStorage.getItem('inputValues')) || [];

                    // Push new values (including the base64 encoded file) into the values array
                    values.push([input1, input2, input3, input4, input5, input6, input7, input8, input9, base64File, input_name]);

                    // Save the updated values array back to sessionStorage
                    sessionStorage.setItem('inputValues', JSON.stringify(values));

                      // Display updated values
                     displayValues(values);
                };

                // Start reading the file as a data URL
                reader.readAsDataURL(input10);



            } else {
                let base64File = "nil"; // Default empty value for file if no file is selected
                // If no file is selected, just store the values without a file
                const values = JSON.parse(sessionStorage.getItem('inputValues')) || [];

                values.push([input1, input2, input3, input4, input5, input6, input7, input8, input9, base64File, input_name]);

                sessionStorage.setItem('inputValues', JSON.stringify(values));

                 // Display updated values
                 displayValues(values);

            }



            // Clear the inputs (using jQuery for consistency)
            $('#input1, #input2, #input3, #input4, #input5, #input6, #input7, #input8, #input9, #input10').val(null).trigger('change');

        } else {
            alert("Please fill in all inputs.");
        }


    }


    // Function to delete a row from the session storage and table
    function deleteRow(index) {
        const values = JSON.parse(sessionStorage.getItem('inputValues')) || [];
        values.splice(index, 1);
        sessionStorage.setItem('inputValues', JSON.stringify(values));
        displayValues();
    }

    // Event listener for the Add button
    document.getElementById('addButton').addEventListener('click', addInputs);
</script>

<script>
    $('.task_cat').on('change', function() {
        var drop = $(this).val();
        var formData = new FormData();
        formData.append('task_cat_drop', drop); // Append the selected value
        fetch('ajax_dep.php', {
                method: 'POST',
                body: formData, // Make sure formData contains any necessary data
            })
            .then(response => {
                if (response.ok) {
                    return response.text(); // Expect HTML as a response, not JSON
                } else {
                    throw new Error("Request failed with status: " + response.status);
                }
            })
            .then(html => {
                // console.log(html);
                // If the response is HTML, you can insert it into the DOM
                // For example, populate the dependent dropdown
                $('.sub_cat').html(html);
                // document.getElementsByClassName("sub_cat").innerHTML = html;
                // Optionally, you could trigger any further actions based on the data
                // For instance, enable the second dropdown if necessary
                // document.getElementById("dependentDropdown").disabled = false;
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>

<script>
    document.getElementById("my_form").addEventListener("submit", function(event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        // Collect form data
        const formData = new FormData();

        // Retrieve values stored in sessionStorage
        const values = JSON.parse(sessionStorage.getItem('inputValues')) || [];

        // Assuming the values array contains all the data you need
        // Loop through the values and append them to the FormData
        values.forEach((value, index) => {
            // Append each value (or array item) to the FormData object
            // You can append them individually or in key-value pairs.
            formData.append(`inputValue_${index}`, JSON.stringify(value));
        });


        formData.append("add_sc_file1", 'add_sc_file1');

        var pro_id = '<?php echo $pro_id; ?>';

        formData.append("pro_id", pro_id);



        // console.log(...formData.entries());
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

                    // popup(data.message, data.url);

                    //     //  window.location.href = data.url;

                } else {


                    // popup(data.message, data.url);


                    //     // window.location.href = data.url;


                    //     // alert("Error: " + data.message);
                }
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>

</html>