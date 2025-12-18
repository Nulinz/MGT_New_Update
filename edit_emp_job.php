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
    <title>Update Job</title>

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
                        <h6>Edit Job Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Job Details</h4>
                </div>
                <?php
                $ed2 = $fetch->table_list_id('m_emp2', 'f_id', $emp_edit);

                if (!$ed2) {
                    $ed2 = [
                        'role' => '',
                        'level' => '',
                        'title' => '',
                        'type' => '',
                        'exp' => '',
                        'skill' => '',
                        'st_date' => '',
                        're_date' => '',
                        'reason' => '',
                        'lap' => '',
                        'verify' => ''
                    ];
                }

                ?>
                <form action="" method="POST" id="my_form">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-select" autofocus>
                                    <option value="<?php echo $ed2['role'] ?? ''; ?>" selected>
                                        <?php echo $ed2['role']; ?>
                                        <!-- <option value="<?php echo $ed2['role'] ?? ''; ?>"> -->
                                    </option>
                                    <option value="Business Development Associate L-1">Business Development Associate
                                        L-1</option>
                                    <option value="Business Development Associate L-2">Business Development Associate
                                        L-2</option>
                                    <option value="Business Development Field Officer L-1">Business Development Field
                                        Officer L-1</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Team Leader">Team Leader</option>
                                    <option value="Human Resource">Human Resource</option>
                                    <option value="Project Manager">Project Manager</option>
                                    <option value="UI/UX Designer">UI/UX Designer</option>
                                    <option value="Front-End Developer">Front-End Developer</option>
                                    <option value="Back-End Developer">Back-End Developer</option>
                                    <option value="Full Stack Developer">Full Stack Developer</option>
                                    <option value="App Developer">App Developer</option>
                                    <option value="Android Developer">Android Developer</option>
                                    <option value="Junior App Developer">Junior App Developer</option>
                                    <option value="Testing">Testing</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Sales Marketing Executive">Sales Marketing Executive</option>
                                    <option value="Junior Content Creator">Junior Content Creator</option>
                                    <option value="Data Analytics">Data Analytics</option>
                                    <option value="Video Creator">Video Creator</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Human Resource Intern">Human Resource Intern</option>
                                    <option value="Digital Marketing Intern">Digital Marketing Intern</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-select">
                                    <option value="<?php echo $ed2['level']; ?>" selected><?php echo $ed2['level']; ?>
                                    </option>
                                    <option value="L-1">L-1</option>
                                    <option value="L-2">L-2</option>
                                    <option value="L-3">L-3</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="jobtitle">Job Title</label>
                                <input type="text" class="form-control" name="jobtitle" id="jobtitle"
                                    placeholder="Enter Job Title" value="<?php echo $ed2['title']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="jobtype">Job Type</label>
                                <select name="jobtype" id="jobtype" class="form-select">
                                    <option value="<?php echo $ed2['type']; ?>" selected><?php echo $ed2['type']; ?>
                                    </option>
                                    <option value="Internship">Internship</option>
                                    <option value="Full-Time">Full-Time</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="experience">Experience <span>*</span></label>
                                <select name="experience" id="experience" class="form-select" required>
                                    <option value="<?php echo $ed2['exp']; ?>" selected><?php echo $ed2['exp']; ?>
                                    </option>
                                    <option value="Fresher">Fresher</option>
                                    <option value="0-1 Year">0-1 Year</option>
                                    <option value="1+ Year">1+ Year</option>
                                    <option value="2+ Years">2+ Years</option>
                                    <option value="3+ Years">3+ Years</option>
                                    <option value="4+ Years">4+ Years</option>
                                    <option value="5+ Years">5+ Years</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="skilledin">Professionally Skilled In</label>
                                <input type="text" class="form-control" name="skilledin" id="skilledin"
                                    placeholder="Enter Professionally Skilled In" value="<?php echo $ed2['skill']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="prefdate">Preferred Start Date <span>*</span></label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="prefdate" id="prefdate"
                                    value="<?php echo $ed2['st_date']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="relievedate">Relieving Date (Previous Company) <span>*</span></label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="relievedate" id="relievedate"
                                    value="<?php echo $ed2['re_date']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="reasonleaving">Reason For Leaving (Previous Company) <span>*</span></label>
                                <textarea rows="1" class="form-control" name="reasonleaving" id="reasonleaving"
                                    placeholder="Enter Reason For Leaving"
                                    required><?php echo $ed2['reason']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ownlaptop">Do You Have Own Laptop</label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="radio" name="ownlaptop" id="yes" value="yes" <?php echo ($ed2['lap'] == 'yes') ? "checked" : ""; ?>>
                                        <label class="form-check-label my-auto" for="yes">Yes</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="radio" name="ownlaptop" id="no" value="no" <?php echo ($ed2['lap'] == 'no') ? "checked" : ""; ?>>
                                        <label class="form-check-label my-auto" for="no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="verification">Verification</label>
                                <textarea rows="1" class="form-control" name="verification" id="verification"
                                    placeholder="Enter Verification"><?php echo $ed2['verify']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <!-- <a href="./add_emp_bank.php"> -->
                        <input hidden type="text" name="up_emp2">
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