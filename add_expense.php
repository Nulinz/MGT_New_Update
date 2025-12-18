<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>

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
                        <h6>Add Expense Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Expense Details</h4>
                </div>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="suppname">Supplier Name</label>
                                <select class="form-select" name="suppname" id="suppname" autofocus>
                                    <option value="" selected disabled>Select Options</option>
                                    <?php
                                    $sup = $fetch->table_list_arr('m_supplier', 'status', 'Active');
                                    foreach ($sup as $s) {
                                        ?>
                                        <option value="<?php echo $s['id']; ?>"><?php echo $s['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ledgername">Ledger Name</label>
                                <select class="form-select" name="ledgername" id="ledgername">
                                    <option value="" selected disabled>Select Options</option>
                                    <?php
                                    $led = $fetch->table_list_arr('m_ledger', 'status', 'Active');
                                    foreach ($led as $l) {
                                        ?>
                                        <option value="<?php echo $l['id']; ?>"><?php echo $l['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="workorder">Workorder Name</label>
                                <input type="text" class="form-control" name="w_order" id="workorder"
                                    placeholder="Enter Workorder Name">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="exptype">Type</label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="exptype" id="service" value="service">
                                        <label class="form-check-label my-auto" for="service">Service</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="exptype" id="product" value="product">
                                        <label class="form-check-label my-auto" for="product">Product</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ledgername">Gst Type</label>
                                <select name="gst_type" class="form-select" id="gst_type" onchange=amt()>
                                    <option selected true>With</option>
                                    <option>Without</option>
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="per_amt" id="per_amt" onchange=amt()
                                    placeholder="Enter Amount" value="0">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ledgername">Gst Amount</label>
                                <input type="text" class="form-control" name="gst_amt" id="gst_amt" onchange=amt()
                                    placeholder="Enter Gst Amount" value="0">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ledgername">Total</label>
                                <input type="text" class="form-control" name="amount" id="ttl_amt"
                                    placeholder="Enter Gst Amount" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="remarks">Remarks</label>
                                <textarea rows="1" class="form-control" name="remarks" id="remarks"
                                    placeholder="Enter Remarks"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ledgername">Transaction Type</label>
                                <select class="form-select" name="trans_bank" id="ledgername">
                                    <option value="0" selected true>Cash On Hand</option>
                                    <?php
                                    $bk_lt = $fetch->table_list_arr('m_bank', 'status', 'Active');
                                    foreach ($bk_lt as $bk) {
                                        ?>
                                        <option value="<?php echo $bk['id']; ?>"><?php echo $bk['b_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="file">File</label>
                                <input type="file" class="form-control" name="exp_file" id="file">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="file">Date</label>
                                <input type="date" class="form-control" name="c_on" id=" ">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="add_exp">
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

    function amt() {

        var gst_type = $('#gst_type').val();

        if (gst_type == 'Without') {
            $('#gst_amt').attr('readonly', true);
        } else {
            $('#gst_amt').attr('readonly', false);
        }

        var per_amt = parseInt($('#per_amt').val());
        var gst_amt = parseInt($('#gst_amt').val());

        $('#ttl_amt').val((per_amt + gst_amt));

    }


    document.getElementById("my_form").addEventListener("submit", function (event) {

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