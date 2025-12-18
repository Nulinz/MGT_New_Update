<?php
include('fetch.php');

if (isset($_GET['emp'])) {

    $f_id = $_GET['emp'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Documents</title>

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
                        <h6>Add Document Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Document Information</h4>
                </div>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="aadhar">Aadhar Card <span>*</span></label>
                                <input type="file" class="form-control" name="aadhar" id="aadhar" autofocus required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="expcertify">Experience Certificate</label>
                                <input type="file" class="form-control" name="expcertify" id="expcertify">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="slyslip">Salary Slip</label>
                                <input type="file" class="form-control" name="slyslip" id="slyslip">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="agreement">Agreement</label>
                                <input type="file" class="form-control" name="agreement" id="agreement">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="certification">Certification</label>
                                <input type="file" class="form-control" name="certification" id="certification">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="add_emp4">
                        <button type="submit" id="sub" class="formbtn">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

    <script>


        document.getElementById("my_form").addEventListener("submit", function (event) {

            event.preventDefault(); // Prevent default form submission

            const submitButton = document.getElementById("sub");
            submitButton.disabled = true; // Disable the button

            // Collect form data
            const formData = new FormData(this);

            var f_id = '<?php echo $f_id; ?>';


            formData.append("f_id", f_id);

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
                    console.log(data);
                    if (data.status === 'success') {

                        window.location.href = data.url;

                    } else {
                        window.location.href = data.url;
                        // alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    alert("There was an error: " + error.message);
                });

        });
    </script>


</body>

</html>