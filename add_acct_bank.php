<?php
include('fetch.php');

if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bank Details</title>

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
                        <h6>Bank Details Form</h6>
                    </div>
                </div>
                <?php
                if ($type == 'add') {
                    ?>
                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Bank Details</h4>
                    </div>
                    <form action="" method="POST" id="my_form1" enctype="multipart/form-data">
                        <div class="container-fluid maindiv bg-white">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankname">Bank Name</label>
                                    <input type="text" class="form-control" name="s_bank" id="bankname"
                                        placeholder="Enter Bank Name">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankacct">Bank Account Number</label>
                                    <input type="text" class="form-control" name="s_ac" id="bankacct"
                                        placeholder="Enter Bank Account Number">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankacctholder">Bank Account Holder Name</label>
                                    <input type="text" class="form-control" name="s_bname" id="bankacctholder"
                                        placeholder="Enter Bank Account Holder Name">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="ifsc">IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc" id="ifsc"
                                        placeholder="Enter IFSC Code">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankbranch">Bank Branch Name</label>
                                    <input type="text" class="form-control" name="s_branch" id="bankbranch"
                                        placeholder="Enter Bank Branch Name">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankbranch">Opening Balance</label>
                                    <input type="text" class="form-control" name="open" id="bankbranch"
                                        placeholder="Enter Opening Balance">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                            <input hidden type="text" name="add_bnk">
                            <button type="submit" id="sub" class="formbtn">Save</button>
                        </div>
                    </form>
                    <?php
                } else {
                    ?>


                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Edit Bank Details</h4>
                    </div>
                    <form action="" method="POST" id="my_form">
                        <div class="container-fluid maindiv bg-white">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankname">Bank Name</label>
                                    <input type="text" class="form-control" name="s_bank" id="bankname"
                                        placeholder="Enter Bank Name">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankacct">Bank Account Number</label>
                                    <input type="text" class="form-control" name="s_ac" id="bankacct"
                                        placeholder="Enter Bank Account Number">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankacctholder">Bank Account Holder Name</label>
                                    <input type="text" class="form-control" name="s_bname" id="bankacctholder"
                                        placeholder="Enter Bank Account Holder Name">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="ifsc">IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc" id="ifsc"
                                        placeholder="Enter IFSC Code">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankbranch">Bank Branch Name</label>
                                    <input type="text" class="form-control" name="s_branch" id="bankbranch"
                                        placeholder="Enter Bank Branch Name">
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="bankbranch">Opening Balance</label>
                                    <input type="text" class="form-control" name="open" id="bankbranch"
                                        placeholder="Enter Opening Balance">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">

                            <button type="submit" id="sub" class="formbtn">Update</button>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>


    document.getElementById("my_form1").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        const formData = new FormData(this);

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
                //  console.log(data);
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