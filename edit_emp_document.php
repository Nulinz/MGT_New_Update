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
    <title>Update Documents</title>

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
                        <h6>Edit Document Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Document Information</h4>
                </div>

                <?php
                $ed4 = $fetch->table_list_arr('m_file', 'f_id', $emp_edit);
                $file_types = ['aadhar', 'expcertify', 'slyslip', 'agreement', 'certification'];

                foreach ($ed4 as $item) {
                    // Use the 'type' as the key and 'file' as the value
                    $file_data[$item['type']] = $item['file'];
                }

                ?>

                <form action="" method="post" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="aadhar">Aadhar Card <span>*</span></label>
                                <input type="file" class="form-control" name="aadhar" onchange="preview(this,'aadhar')"
                                    autofocus>
                                <img id="aadhar" style="width:200px;height:100px;"
                                    src="./img/<?php echo $file_data['aadhar'] ?? 'nil'; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="expcertify">Experience Certificate</label>
                                <input type="file" class="form-control" name="expcertify" id=""
                                    onchange="preview(this,'expcertify')">
                                <img id="expcertify" style="width:200px;height:100px;"
                                    src="./img/<?php echo $file_data['expcertify'] ?? 'nil'; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="slyslip">Salary Slip</label>
                                <input type="file" class="form-control" name="slyslip" id=""
                                    onchange="preview(this,'slyslip')">
                                <img id="slyslip" style="width:200px;height:100px;"
                                    src="./img/<?php echo $file_data['slyslip'] ?? 'nil'; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="agreement">Agreement</label>
                                <input type="file" class="form-control" name="agreement" id=""
                                    onchange="preview(this,'agreement')">
                                <img id="agreement" style="width:200px;height:100px;"
                                    src="./img/<?php echo $file_data['agreement'] ?? 'nil'; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="certification">Certification</label>
                                <input type="file" class="form-control" name="certification" id=""
                                    onchange="preview(this,'certification')">
                                <img id="certification" style="width:200px;height:100px;"
                                    src="./img/<?php echo $file_data['certification'] ?? 'nil'; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="up_emp4">
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