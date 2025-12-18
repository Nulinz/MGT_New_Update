<?php
include('fetch.php');
if (isset($_GET['pro']))
    ;

$pro_id = $_GET['pro'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project Document</title>

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
                        <h6>Add Project Document Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Project Document Details</h4>
                </div>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="doctype">Document Type</label>
                                <select name="doctype" id="doctype" class="form-select" autofocus>
                                    <option value="" selected disabled>Select Options</option>
                                    <option>SRS</option>
                                    <option>SRD</option>
                                    <option>Logo</option>
                                    <option>Gallery Photo</option>
                                    <option>Other Resources</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter Title">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="fileattach">File</label>
                                <input type="file" class="form-control" name="pro_file" id="fileattach">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="add_pro2">
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
    $(document).ready(function () {
        $('#gender').change(function () {
            var type = $(this).val();
            $('#marriage-section').hide();
            $('#marriageexpdate').prop('required', false);
            if (type === 'Female') {
                $('#marriage-section').show();
                $('#marriageexpdate').prop('required', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.select2input').select2({
            placeholder: "Select Options",
            allowClear: false,
            width: '100%'
        }).prop('required', true);
    });
</script>

<script>


    document.getElementById("my_form").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        // Collect form data
        const formData = new FormData(this);

        var pro_id = '<?php echo $pro_id; ?>';


        formData.append("pro_id", pro_id);

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