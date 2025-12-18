<?php
include('fetch.php');

if (isset($_GET['pro'])) {
    $pro_id = $_GET['pro'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project Invoice</title>

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

            <div class="sidebodydiv px-4 py-2 mb-3">
                <div class="sidebodyback mb-3" onclick="goBack()">
                    <div class="backhead">
                        <h5><i class="fas fa-arrow-left"></i></h5>
                        <h6>Add Project Invoice Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Project Invoice Details</h4>
                </div>
                <form action="" method="post" id="">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="date" id="date" autofocus>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="remarks">Remarks</label>
                                <textarea rows="1" class="form-control" name="remarks" id="remarks"
                                    placeholder="Enter Remarks"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end align-items-center gap-3">
                        <button type="button" class="addbtn" id="addButton">+ Add</button>
                    </div>
                    <div class="container-fluid maindiv bg-white my-3" id="inputcontainer">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                                <label for="input1">Services <span>*</span></label>
                                <select class="select2 form-select" name="services" id="input1" required>
                                    <option value="" selected disabled>Select Option</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                                <label for="input2">Item <span>*</span></label>
                                <input type="text" class="form-control" name="item" id="input2" placeholder="Enter Item"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                                <label for="input3">Quantity <span>*</span></label>
                                <input type="text" class="form-control" name="quantity" id="input3"
                                    placeholder="Enter Quantity" required>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                                <label for="input4">Amount <span>*</span></label>
                                <input type="number" class="form-control" name="amount" id="input4" min="0"
                                    placeholder="Enter Amount" required>
                            </div>
                        </div>
                    </div>

                    <div class="container px-0">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th>Services</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Values will be inserted here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="button" class="formbtn">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

</body>

<!-- <script>
    document.getElementById('addButton').addEventListener('click', function () {
        const inputContainer = document.getElementById('inputcontainer');
        const newRow = document.querySelector('#inputcontainer .row').cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');

        const deleteButton = newRow.querySelector('.deletebtn');
        deleteButton.addEventListener('click', function () {
            if (inputContainer.querySelectorAll('.row').length > 1) {
                newRow.remove();
            } else {
                alert('At least one row is required!');
            }
        });
        inputContainer.appendChild(newRow);
    });

    document.querySelectorAll('.deletebtn').forEach(button => {
        button.addEventListener('click', function () {
            const inputContainer = document.getElementById('inputcontainer');
            const row = button.closest('.row');
            if (inputContainer.querySelectorAll('.row').length > 1) {
                row.remove();
            } else {
                alert('At least one row is required!');
            }
        });
    });
</script> -->

<script>
    // Clear session storage on page load
    window.addEventListener('DOMContentLoaded', (event) => {
        sessionStorage.clear();
        displayValues();
    });

    // Function to retrieve and display values from session storage
    function displayValues() {
        const values = JSON.parse(sessionStorage.getItem('inputValues')) || [];
        const tableBody = document.querySelector('#dataTable tbody');
        tableBody.innerHTML = '';

        values.forEach((value, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${value[0]}</td>
                <td>${value[1]}</td>
                <td>${value[2]}</td>
                <td>${value[3]}</td>
                
                <td><button type="button" class="deletebtn" onclick="deleteRow(${index})">- Delete</button></td>
            `;
            tableBody.appendChild(row);
        });

        if (values.length > 0) {
            document.querySelector('#dataTable thead').style.display = '';
        } else {
            document.querySelector('#dataTable thead').style.display = 'none';
        }
    }

    // Function to add inputs to session storage
    function addInputs() {
        const input1 = document.getElementById('input1').value;
        // const input_pro = $('#input1').find('option:selected').data('id');;
        const input2 = document.getElementById('input2').value;
        const input3 = document.getElementById('input3').value;
        const input4 = document.getElementById('input4').value;

        if (input1 && input2 && input3 && input4) {
            const values = JSON.parse(sessionStorage.getItem('inputValues')) || [];
            values.push([input1, input2, input3, input4]);
            sessionStorage.setItem('inputValues', JSON.stringify(values));

            // console.log(values);

            // Clear the inputs
            $('#input1').val(null).trigger('change');  // Reset select2 dropdowns
            document.getElementById('input1').value = '';
            document.getElementById('input2').value = '';
            document.getElementById('input3').value = '';
            document.getElementById('input4').value = '';
            // document.getElementById('input1_pro').value = '';

            document.getElementById('input1').removeAttribute('required');
            document.getElementById('input2').removeAttribute('required');
            document.getElementById('input3').removeAttribute('required');
            document.getElementById('input4').removeAttribute('required');
            displayValues();

            // Show the thead if this is the first entry
            if (values.length === 1) {
                document.querySelector('#dataTable thead').style.display = '';
            }
        } else {
            // alert("Please fill in all inputs.");
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
    displayValues();
</script>

<script>
    // DataTables List
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            "paging": false,
            "searching": false,
            "ordering": true,
            "bDestroy": true,
            "info": false,
            "responsive": true,
            "pageLength": 10,
            "bDestroy": true,
            "dom": '<"top"f>rt<"bottom"lp><"clear">'
        });

    });
</script>

</html>