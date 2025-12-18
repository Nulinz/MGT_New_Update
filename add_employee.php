<?php
include('fetch.php');
?>

<?php
$emp = $fetch->next_emp_code();
?>

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
                <form action="" method="POST" id="my_form" enctype=multipart/form-data>
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <!-- <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="empid">Employee Code<span>*</span></label>
                                <input type="number" class="form-control" name="empid" id="empid"
                                    placeholder="Enter Employee Code" value="$emp" autofocus required>
                            </div> -->
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="empid">Employee Code <span>*</span></label>
                                <input type="number" class="form-control" name="empid" id="empid"
                                    value="<?php echo $emp; ?>" readonly required>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="fname">Full Name <span>*</span></label>
                                <input type="text" class="form-control" name="fname" id="fname"
                                    placeholder="Enter Full Name" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="dob">Date Of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="gender">Gender <span>*</span></label>
                                <select name="gender" id="gender" class="form-select" required>
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
                                <label for="mail">Email ID <span>*</span></label>
                                <input type="email" class="form-control" name="mail" id="mail"
                                    placeholder="Enter Email ID" required>
                                <small id="emailError" style="color:red; display:none;"></small>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contact">Contact Number <span>*</span></label>
                                <input type="text" class="form-control" name="contact" id="contact"
                                    placeholder="Enter 10-digit Mobile Number" maxlength="10" required>
                                <small id="contactError" style="color:red; display:none;"></small>
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
                                <label for="familybg">Family Background <span>*</span></label>
                                <textarea rows="1" class="form-control" name="familybg" id="familybg"
                                    placeholder="Enter Family Background" required></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="financebg">Financial Background <span>*</span></label>
                                <textarea rows="1" class="form-control" name="financebg" id="financebg"
                                    placeholder="Enter Financial Background" required></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="adrs">Address <span>*</span></label>
                                <textarea rows="1" class="form-control" name="adrs" id="adrs"
                                    placeholder="Enter Address" required></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="pfimg">Profile Image (Optional)</label>
                                <input type="file" class="form-control" name="pfimg" id="pfimg">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="add_emp1">
                        <button type="submit" id="sub" class="formbtn">Save</button>
                        <!-- <a href="./add_emp_job.php"></a> -->
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

<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button
        // Collect form data
        const formData = new FormData(this);
        //  formData.append("additionalKey", value);
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

<script>
    const contactInput = document.getElementById("contact");
    const emailInput = document.getElementById("mail");
    const contactError = document.getElementById("contactError");
    const emailError = document.getElementById("emailError");
    const submitBtn = document.getElementById("sub");

    // Mobile validation
    function validateMobile() {
        const regex = /^[6-9]\d{9}$/;
        if (!regex.test(contactInput.value)) {
            contactError.innerText = "Enter valid 10-digit mobile number";
            contactError.style.display = "block";
            return false;
        }
        contactError.style.display = "none";
        return true;
    }

    // Email format validation
    function validateEmail() {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regex.test(emailInput.value)) {
            emailError.innerText = "Enter valid email address";
            emailError.style.display = "block";
            return false;
        }
        emailError.style.display = "none";
        return true;
    }

    contactInput.addEventListener("input", validateMobile);
    emailInput.addEventListener("input", validateEmail);

    // Submit form
    document.getElementById("my_form").addEventListener("submit", function (event) {
        event.preventDefault();

        if (!validateMobile() || !validateEmail()) return;

        submitBtn.disabled = true;

        // clear previous errors
        contactError.style.display = "none";
        emailError.style.display = "none";

        const formData = new FormData(this);

        fetch("ajax.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;

                if (data.status === "success") {
                    window.location.href = data.url;
                } else {
                    if (data.field === "contact") {
                        contactError.innerText = data.message;
                        contactError.style.display = "block";
                    }
                    if (data.field === "email") {
                        emailError.innerText = data.message;
                        emailError.style.display = "block";
                    }
                }
            })
            .catch(() => {
                submitBtn.disabled = false;
            });
    });

</script>

<script>
    let emailTimer = null;

    emailInput.addEventListener("blur", function () {
        const email = emailInput.value.trim();

        if (email === "") return;

        clearTimeout(emailTimer);

        emailTimer = setTimeout(() => {
            const formData = new FormData();
            formData.append("check_email", "1");
            formData.append("mail", email);

            fetch("ajax.php", {
                method: "POST",
                body: formData
            })
                .then(res => res.json())
                .then(data => {

                    if (data.status === "exists") {
                        emailError.innerText = data.message;
                        emailError.style.display = "block";
                        submitBtn.disabled = true;
                    }
                    else if (data.status === "available") {
                        emailError.style.display = "none";
                        submitBtn.disabled = false;
                    }
                    else if (data.status === "error") {
                        emailError.innerText = data.message;
                        emailError.style.display = "block";
                        submitBtn.disabled = true;
                    }
                });
        }, 300);
    });
</script>

<script>
    let mobileTimer = null;

    contactInput.addEventListener("blur", function () {
        const mobile = contactInput.value.trim();

        if (mobile === "") return;

        clearTimeout(mobileTimer);

        mobileTimer = setTimeout(() => {
            const formData = new FormData();
            formData.append("check_mobile", "1");
            formData.append("contact", mobile);

            fetch("ajax.php", {
                method: "POST",
                body: formData
            })
                .then(res => res.json())
                .then(data => {

                    if (data.status === "exists") {
                        contactError.innerText = data.message;
                        contactError.style.display = "block";
                        submitBtn.disabled = true;
                    }
                    else if (data.status === "available") {
                        contactError.style.display = "none";
                        submitBtn.disabled = false;
                    }
                    else if (data.status === "error") {
                        contactError.innerText = data.message;
                        contactError.style.display = "block";
                        submitBtn.disabled = true;
                    }
                });
        }, 300);
    });
</script>

</html>