<?php
include('fetch.php');

if (isset($_GET['com_prime'])) {

    $com_id = $_GET['com_prime'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Company</title>

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
                        <h6>Edit Contact Person Form</h6>
                    </div>
                </div>
                <?php
                $cmp_con = $fetch->table_list_id('m_cmp3', 'id', $com_id);
                ?>
                <form action="" method="POST" id="my_form">
                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Contact Person Details</h4>
                        <!-- <button type="button" class="addbtn" id="addButton">+ Add</button> -->
                    </div>
                    <div class="container-fluid maindiv bg-white my-3" id="inputcontainer">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contactpersonname">Full Name <span>*</span></label>
                                <input type="text" class="form-control" name="con_name" id="contactpersonname"
                                    placeholder="Enter Full Name" value="<?php echo $cmp_con['con_name']; ?>" autofocus>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contactpersonrole">Role <span>*</span></label>
                                <select name="con_role" id="contactpersonrole" class="form-select">
                                    <option value="<?php echo $cmp_con['con_role']; ?>" selected>
                                        <?php echo $cmp_con['con_role']; ?></option>
                                    <option value="Admin">Admin</option>
                                    <option value="Team Leader">Team Leader</option>
                                    <option value="Human Resource">Human Resource</option>
                                    <option value="Project Manager">Project Manager</option>
                                    <option value="UI/UX Designer">UI/UX Designer</option>
                                    <option value="Front-End Developer">Front-End Developer</option>
                                    <option value="Back-End Developer">Back-End Developer</option>
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
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contactpersoncontact">Contact Number <span>*</span></label>
                                <input type="number" class="form-control" name="con_contact" oninput="validate(this)"
                                    min="1000000000" max="9999999999" id="contactpersoncontact"
                                    value="<?php echo $cmp_con['con_num']; ?>" placeholder="Enter Contact Number">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contactpersonemail">Email ID <span>*</span></label>
                                <input type="text" class="form-control" name="con_mail"
                                    value="<?php echo $cmp_con['con_email']; ?>" id="contactpersonemail"
                                    placeholder="Enter Email ID">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="up_com3">
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
    document.getElementById('addButton').addEventListener('click', function () {
        const inputContainer = document.getElementById('inputcontainer');
        const newRow = document.querySelector('#inputcontainer .row').cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        inputContainer.appendChild(newRow);
    });
</script>

<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        const formData = new FormData(this);

        var com_id = '<?php echo $com_id; ?>';


        formData.append("com_id", com_id);

        console.log(...formData.entries());

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
                // console.log(data);
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