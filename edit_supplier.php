<?php
include('fetch.php');

if (isset($_GET['sup'])) {
    $sup_id = $_GET['sup'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>

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
                        <h6>Edit Supplier Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Supplier Details</h4>
                </div>
                <?php
                $sup = $fetch->table_list_id('m_supplier', 'id', $sup_id);
                ?>
                <form action="" method="POST" id="my_form">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="suppname">Supplier Name</label>
                                <input type="text" class="form-control" name="suppname" id="suppname"
                                    placeholder="Enter Supplier Name" value="<?php echo $sup['name']; ?>" autofocus>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankname">Bank Name</label>
                                <input type="text" class="form-control" name="bankname" id="bankname"
                                    placeholder="Enter Bank Name" value="<?php echo $sup['b_name']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankacct">Bank Account Number</label>
                                <input type="text" class="form-control" name="bankacct" id="bankacct"
                                    placeholder="Enter Bank Account Number" value="<?php echo $sup['ac_no']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankacctholder">Bank Account Holder Name</label>
                                <input type="text" class="form-control" name="bankacctholder" id="bankacctholder"
                                    placeholder="Enter Bank Account Holder Name" value="<?php echo $sup['ac_name']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ifsc">IFSC Code</label>
                                <input type="text" class="form-control" name="ifsc" id="ifsc"
                                    placeholder="Enter IFSC Code" value="<?php echo $sup['ifsc']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="bankbranch">Bank Branch Name</label>
                                <input type="text" class="form-control" name="bankbranch" id="bankbranch"
                                    placeholder="Enter Bank Branch Name " value="<?php echo $sup['b_branch']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="taxgst">Tax/GST No</label>
                                <input type="text" class="form-control" name="taxgst" id="taxgst"
                                    placeholder="Enter Tax/GST No" value="<?php echo $sup['gst']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contact">Contact Number</label>
                                <input type="number" class="form-control" name="contact" id="contact"
                                    oninput="validate(this)" min="6000000000" max="9999999999"
                                    placeholder="Enter Contact Number" value="<?php echo $sup['contact']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="adrs">Address</label>
                                <textarea rows="1" class="form-control" name="adrs" id="adrs"
                                    placeholder="Enter Address"><?php echo $sup['ad']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="district">District</label>
                                <input type="text" class="form-control" name="district" id="district"
                                    placeholder="Enter District" value="<?php echo $sup['dis']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="state">State</label>
                                <input type="text" class="form-control" name="state" id="state"
                                    placeholder="Enter State" value="<?php echo $sup['state']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="pincode">Pincode</label>
                                <input type="number" class="form-control" name="pincode" id="pincode"
                                    oninput="validate_pin(this)" min="000000" max="999999" placeholder="Enter Pincode"
                                    value="<?php echo $sup['pin']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="up_supplier">
                        <button type="submit" id="sub" class="formbtn">Update</button>
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

        var sup_edit = '<?php echo $sup_id; ?>';


        formData.append("sup_edit", sup_edit);

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