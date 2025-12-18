<?php
include('fetch.php');

if (isset($_GET['exp'])) {
    $exp_id = $_GET['exp'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>

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
                        <h6>Edit Expense Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Expense Details</h4>
                </div>
                <?php
                $exp_lt = $fetch->table_list_id('m_exp', 'id', $exp_id);
                $sup_lt = $fetch->table_list_id('m_supplier', 'id', $exp_lt['sup_id']);
                $led_lt = $fetch->table_list_id('m_ledger', 'id', $exp_lt['led_id']);
                ?>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="suppname">Supplier Name</label>
                                <select class="form-select" name="suppname" id="suppname" autofocus>
                                    <option value="<?php echo $sup_lt['id']; ?>" selected><?php echo $sup_lt['name']; ?>
                                    </option>
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
                                    <option value="<?php echo $led_lt['id']; ?>" selected><?php echo $led_lt['name']; ?>
                                    </option>
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
                                    placeholder="Enter Workorder Name" value="<?php echo $exp_lt['w_name']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="exptype">Type</label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="exptype" id="service" value="service" <?php echo $exp_lt['type'] == 'service' ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="service">Service</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="exptype" id="product" value="product" <?php echo $exp_lt['type'] == 'product' ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="product">Product</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount"
                                    placeholder="Enter Amount" value="<?php echo $exp_lt['amt']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="remarks">Remarks</label>
                                <textarea rows="1" class="form-control" name="remarks" id="remarks"
                                    placeholder="Enter Remarks"><?php echo $exp_lt['remarks']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="file">File</label>
                                <input type="file" class="form-control" name="exp_file"
                                    onchange="preview(this,'exp_file')">
                                <img id="exp_file" style="width:200px;height:100px;"
                                    src="./img/<?php echo $exp_lt['file'] ?? 'nil'; ?>">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="up_expenses">
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
    function preview(inp, type) {
        // alert("hello");
        const file = inp.files[0]; // Get the selected file
        // console.log(file);
        if (file) {
            const imagePreview = $('#' + type);
            console.log(imagePreview);

            const imageURL = URL.createObjectURL(file); // Create a URL for the selected file
            imagePreview.attr('src', imageURL).show(); // Set the src to the created URL and show the image
        }
    }

</script>


<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        const formData = new FormData(this);

        var exp_id = '<?php echo $exp_id; ?>';


        formData.append("exp_edit", exp_id);

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