<?php
include('fetch.php');

if (isset($_GET['pro'])) {
    $pro_id = $_GET['pro'];

    $type = $_GET['type'];

    if ($type == "quot") {
        $v = 'Quotation';
    } else {
        $v = 'Invoice';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project <?php echo $v; ?></title>

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
                        <h6>Add Project <?php echo $v; ?> Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Project <?php echo $v; ?> Details</h4>
                </div>
                <form action="" method="POST" id="my_form">

                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs" id="quot">
                                <label for="prjtname">Quoation No</label>
                                <select name="quot_new" class="form-select">
                                    <option value="" selected true>Select Options</option>
                                    <?php
                                    $link = $db->link();

                                    $s_qt1 = "select * from `m_quot` where `f_id`='$pro_id' and `status`='final'";
                                    $q_qt1 = mysqli_query($link, $s_qt1);
                                    while ($d_qt1 = mysqli_fetch_assoc($q_qt1)) {

                                        //     print_r($d_qt1);
                                    
                                        //     $q_id1 = $d_qt1['id'];
                                    
                                        ?>
                                        <option><?php echo $d_qt1['id']; ?></option>
                                        <?php
                                    }

                                    ?>
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs" id="gst_type">
                                <label for="remarks">GST</label>
                                <select name="gst_type" class="form-select">
                                    <option selected true>With</option>
                                    <option>Without</option>
                                    ?>
                                </select>
                            </div>



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
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="remarks">Bank</label>
                                <select name="quot_bank" class="form-select">
                                    <option value="" selected true>Select Bank</option>
                                    <?php
                                    $bk_lt = $fetch->table_list_arr('m_bank', 'status', 'Active');
                                    foreach ($bk_lt as $bk) {
                                        ?>
                                        <option value="<?php echo $bk['id']; ?>"><?php echo $bk['b_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                    ?>
                                </select>
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
                                <select class="select2 form-select" name="" id="input1" required>
                                    <option value="" selected disabled>Select Option</option>
                                    <?php
                                    $ser = $fetch->table_list('m_service');
                                    //   print_r($ser);
                                    
                                    foreach ($ser as $s) {
                                        ?>
                                        <option value="<?php echo $s['id']; ?>" data-ser='<?php echo $s['ser_name']; ?>'>
                                            <?php echo $s['ser_name']; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                                <label for="input2">Description <span>*</span></label>
                                <input type="text" class="form-control" name="" id="input2"
                                    placeholder="Enter Description" required>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                                <label for="input3">Quantity <span>*</span></label>
                                <input type="text" class="form-control" name="" id="input3" placeholder="Enter Quantity"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                                <label for="input4">Amount<span>*</span></label>
                                <input type="number" class="form-control" name="" id="input4" min="0"
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
                        <input hidden type="text" name="add_quot">
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
    var ty = '<?php echo $type; ?>';
    if (ty === 'inv') {
        $('#quot').show();
        $('#gst_type').show();
    } else {
        $('#quot').hide();
        $('#gst_type').hide();
    }
</script>

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
                <td>${value[4]}</td>
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
        const input_ser = $('#input1').find('option:selected').data('ser');
        const input2 = document.getElementById('input2').value;
        const input3 = document.getElementById('input3').value;
        const input4 = document.getElementById('input4').value;


        if (input1 && input2 && input3 && input4 && input_ser) {
            const values = JSON.parse(sessionStorage.getItem('inputValues')) || [];
            values.push([input1, input2, input3, input4, input_ser]);
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

<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        const formData = new FormData(this);

        var type = '<?php echo $type; ?>';
        var pro_id = '<?php echo $pro_id; ?>';


        formData.append("pro_id", pro_id);
        formData.append("type", type);

        const storedValues = JSON.parse(sessionStorage.getItem('inputValues')) || [];

        const productData = [];

        storedValues.forEach(item => {
            productData.push([
                item[0],
                item[1],
                item[2],
                item[3],

            ]);
        });

        formData.append('products', JSON.stringify(productData));


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
                console.log(data);
                if (data.status === 'success') {

                    popup(data.message, data.url);

                    // window.location.href = data.url;

                } else {
                    popup(data.message, data.url);
                    // window.location.href = data.url;
                    // alert("Error: " + data.message);
                }
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>

</html>