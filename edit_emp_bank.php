<?php
include('fetch.php');

if (isset($_GET['emp_id'])) {
    $emp_edit = $_GET['emp_id'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Bank Details</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/form.css">

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
                        <h6>Edit Bank Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Bank Information</h4>
                </div>
                <?php
                $ed3 = $fetch->table_list_id('m_emp3', 'f_id', $emp_edit);
                ?>

                <form action="" method="POST" id="my_form">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankname">Bank Name <span>*</span></label>
                                <input type="text" class="form-control" name="bankname" id="bankname"
                                    placeholder="Enter Bank Name" value="<?php echo $ed3['b_name']; ?>" autofocus
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankacctholder">Bank Account Holder Name <span>*</span></label>
                                <input type="text" class="form-control" name="bankacctholder" id="bankacctholder"
                                    placeholder="Enter Bank Account Holder Name" value="<?php echo $ed3['ac_name']; ?>"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankacctno">Bank Account Number <span>*</span></label>
                                <input type="number" class="form-control" name="bankacctno" id="bankacctno" min="0"
                                    placeholder="Enter Bank Account Number" value="<?php echo $ed3['ac_no']; ?>"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ifsc">IFSC Code <span>*</span></label>
                                <input type="text" class="form-control" name="ifsc" id="ifsc"
                                    placeholder="Enter IFSC Code" value="<?php echo $ed3['ifsc']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankname">Account Type</label>
                                <select class="form-select" name="accttype" id="accttype">
                                    <option value="<?php echo $ed3['ac_type']; ?>" selected>
                                        <?php echo $ed3['ac_type']; ?></option>
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankbranch">Bank Branch <span>*</span></label>
                                <input type="text" class="form-control" name="bankbranch" id="bankbranch"
                                    placeholder="Enter Bank Branch" value="<?php echo $ed3['b_branch']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Salary & Allowances</h4>
                    </div>
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="basic">Basic Salary</label>
                                <input type="number" class="form-control" name="basic" id="basic" min="0"
                                    placeholder="Enter Basic Salary" value="<?php echo $ed3['salary']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="hra">House Rent Allowance (HRA)</label>
                                <input type="number" class="form-control" name="hra" id="hra" min="0"
                                    placeholder="Enter House Rent Allowance (HRA)" value="<?php echo $ed3['hra']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="conveyance">Conveyance</label>
                                <input type="number" class="form-control" name="conveyance" id="conveyance" min="0"
                                    placeholder="Enter Conveyance" value="<?php echo $ed3['convey']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="medical">Medical</label>
                                <input type="number" class="form-control" name="medical" id="medical" min="0"
                                    placeholder="Enter Medical" value="<?php echo $ed3['medical']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="special">Special</label>
                                <input type="number" class="form-control" name="special" id="special" min="0"
                                    placeholder="Enter Special" value="<?php echo $ed3['special']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="other">Other (Food, Education)</label>
                                <input type="number" class="form-control" name="other" id="other" min="0"
                                    placeholder="Enter Other Allowance" value="<?php echo $ed3['other']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Deductions</h4>
                    </div>
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="pf">Provident Fund (PF)</label>
                                <input type="number" class="form-control" name="pf" id="pf" min="0"
                                    placeholder="Enter Provident Fund (PF)" value="<?php echo $ed3['pf']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="esi">Employment State Insurance (ESI)</label>
                                <input type="number" class="form-control" name="esi" id="esi" min="0"
                                    placeholder="Enter Employment State Insurance (ESI)"
                                    value="<?php echo $ed3['esi']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ptax">Professional Tax</label>
                                <input type="number" class="form-control" name="ptax" id="ptax" min="0"
                                    placeholder="Enter Professional Tax" value="<?php echo $ed3['pro_tax']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="it">Income Tax (IT)</label>
                                <input type="number" class="form-control" name="it" id="it" min="0"
                                    placeholder="Enter Income Tax" value="<?php echo $ed3['it']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-xl-4">
                            <div class="sidebodyhead my-3">
                                <h4 class="m-0">Bonus & Incentives</h4>
                            </div>
                            <div class="container-fluid maindiv bg-white">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
                                        <label for="pbonus">Performance Bonus</label>
                                        <input type="number" class="form-control" name="pbonus" id="pbonus" min="0"
                                            placeholder="Enter Performance Bonus" value="<?php echo $ed3['bonus']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-4 col-xl-4">
                            <div class="sidebodyhead my-3">
                                <h4 class="m-0">Net Salary</h4>
                            </div>
                            <div class="container-fluid maindiv bg-white">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-xl-12 mb-3 inputs">
                                        <label for="net">Net Salary <span>*</span></label>
                                        <input type="number" class="form-control" name="net" id="net" min="0" value="0"
                                            placeholder="Enter Net Salary" value="<?php echo $ed3['net']; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <!-- <a href="./add_emp_document.php"> -->
                        <input hidden type="text" name="up_emp3">
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
    document.getElementById("my_form").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        const formData = new FormData(this);

        var emp_edit = '<?php echo $emp_edit; ?>';


        formData.append("emp_edit", emp_edit);

        // console.log(...formData.entries());

        // // Send data to PHP backend using Fetch API
        fetch('up_ajax.php', {
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
                //  console.log(data);
                if (data.status === 'success') {

                    popup(data.message, data.url);

                    //  window.location.href = data.url;

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