<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>

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
                        <h6>Add Employee Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Basic Details</h4>
                </div>
                <form action="" method="post" id="">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="empid">Employee Code</label>
                                <input type="number" class="form-control" name="empid" id="empid"
                                    placeholder="Enter Employee Code" readonly>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="fname">Full Name</label>
                                <input type="text" class="form-control" name="fname" id="fname"
                                    placeholder="Enter Full Name" autofocus>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="dob">Date Of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="marital">Marital Status</label>
                                <select name="marital" id="marital" class="form-select">
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs" id="marriage-section"
                                style="display: none;">
                                <label for="marriageexpdate" id="marriage_section">Expected Marriage Date</label>
                                <textarea rows="1" name="marriageexpdate" id="marriageexpdate" class="form-control"
                                    placeholder="Enter Expected Marriage Date"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="mail">Email ID</label>
                                <input type="email" class="form-control" name="mail" id="mail"
                                    placeholder="Enter Email ID">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contact">Contact Number</label>
                                <input type="number" class="form-control" name="contact" id="contact"
                                    oninput="validate(this)" min="1000000000" max="9999999999"
                                    placeholder="Enter Contact Number">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="aadhar">Aadhar Number</label>
                                <input type="number" class="form-control" name="aadhar" id="aadhar"
                                    oninput="validate_aadhar(this)" min="000000000000" max="999999999999"
                                    placeholder="Enter Aadhar Number">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" name="qualification" id="qualification"
                                    placeholder="Enter Qualification">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="yog">Year Of Graduation</label>
                                <input type="number" class="form-control" name="yog" id="yog"
                                    oninput="validate_year(this)" min="0000" max="9999"
                                    placeholder="Enter Year Of Graduation">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="familybg">Family Background</label>
                                <textarea rows="1" class="form-control" name="familybg" id="familybg"
                                    placeholder="Enter Family Background"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="financebg">Financial Background</label>
                                <textarea rows="1" class="form-control" name="financebg" id="financebg"
                                    placeholder="Enter Financial Background"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="adrs">Address</label>
                                <textarea rows="1" class="form-control" name="adrs" id="adrs"
                                    placeholder="Enter Address"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="pfimg">Profile Image (Optional)</label>
                                <input type="file" class="form-control" name="pfimg" id="pfimg">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="button" onclick="popup()" class="formbtn">Save</button>
                        <!-- <a href="./add_emp_job.php"><button type="button" id="submitBtn"
                                class="formbtn">Save</button></a> -->
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

    <?php include("./popup.php"); ?>

</body>

<script>
    $(document).ready(function () {
        $('#gender, #marital').change(function () {
            var gender = $('#gender').val();
            var marital = $('#marital').val();
            $('#marriage-section').hide();
            $('#marriageexpdate').prop('required', false);
            if (gender === 'Female' && marital === 'Single') {
                $('#marriage-section').show();
                $('#marriageexpdate').prop('required', true);
            }
        });
    });
</script>

</html>