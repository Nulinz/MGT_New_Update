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
    <title>Update Employee</title>

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
                        <h6>Edit Employee Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Basic Details</h4>
                </div>
                <?php
                $ed = $fetch->table_list_id('m_emp', 'id', $emp_edit);
                ?>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="empid">Employee Code <span>*</span></label>
                                <input type="number" class="form-control" name="empid" id="empid"
                                    placeholder="Enter Employee Code" value="<?php echo $ed['emp_code']; ?>" autofocus
                                    required readonly>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="fname">Full Name <span>*</span></label>
                                <input type="text" class="form-control" name="fname" id="fname"
                                    placeholder="Enter Full Name" value="<?php echo $ed['name']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="dob">Date Of Birth</label>
                                <input type="date" class="form-control" name="dob" value="<?php echo $ed['dob']; ?>"
                                    id="dob">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="gender">Gender <span>*</span></label>
                                <select name="gender" id="gender" class="form-select" required>
                                    <option value="<?php echo $ed['gender']; ?>" selected><?php echo $ed['gender']; ?>
                                    </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="marital">Marital Status</label>
                                <select name="marital" id="marital" class="form-select">
                                    <option value="<?php echo $ed['marital']; ?>" selected true>
                                        <?php echo $ed['marital']; ?></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                            </div>
                            <?php
                            if (($ed['gender'] == 'Female') && ($ed['marital'] == 'Single')):
                                ?>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs" id="marriage-section"
                                    style="display: block;">
                                    <label for="marriageexpdate" id="marriage_section">Expected Marriage Date</label>
                                    <textarea rows="1" name="marriageexpdate" id="marriageexpdate" class="form-control"
                                        placeholder="Enter Expected Marriage Date"><?php echo $ed['exp_mrg']; ?></textarea>
                                </div>
                            <?php endif ?>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="mail">Email ID <span>*</span></label>
                                <input type="email" class="form-control" name="mail" id="mail"
                                    placeholder="Enter Email ID" value="<?php echo $ed['email']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contact">Contact Number <span>*</span></label>
                                <input type="number" class="form-control" name="contact" id="contact"
                                    oninput="validate(this)" min="1000000000" max="9999999999"
                                    placeholder="Enter Contact Number" value="<?php echo $ed['contact']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="aadhar">Aadhar Number</label>
                                <input type="number" class="form-control" name="aadhar" id="aadhar"
                                    oninput="validate_aadhar(this)" min="000000000000" max="999999999999"
                                    placeholder="Enter Aadhar Number" value="<?php echo $ed['aadhar']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" name="qualification" id="qualification"
                                    placeholder="Enter Qualification" value="<?php echo $ed['qualification']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="yog">Year Of Graduation</label>
                                <input type="number" class="form-control" name="yog" id="yog"
                                    oninput="validate_year(this)" min="0000" max="9999"
                                    placeholder="Enter Year Of Graduation" value="<?php echo $ed['year']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="familybg">Family Background <span>*</span></label>
                                <textarea rows="1" class="form-control" name="familybg" id="familybg"
                                    placeholder="Enter Family Background" value="<?php echo $ed['fam_back']; ?>"
                                    required></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="financebg">Financial Background <span>*</span></label>
                                <textarea rows="1" class="form-control" name="financebg" id="financebg"
                                    placeholder="Enter Financial Background" value="<?php echo $ed['fin_back']; ?>"
                                    required></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="adrs">Address <span>*</span></label>
                                <textarea rows="1" class="form-control" name="adrs" id="adrs"
                                    placeholder="Enter Address" required><?php echo $ed['address']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="pfimg">Profile Image (Optional)</label>
                                <input type="file" class="form-control" name="pfimg" id="pfimg"
                                    onchange="preview(this)">
                                <img id="img_pr" style="width:200px;height:100px;"
                                    src="./img/<?php echo $ed['profile']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="up_emp1">
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
    function preview(inp) {
        const file = inp.files[0]; // Get the selected file
        if (file) {
            const imagePreview = $('#img_pr');
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