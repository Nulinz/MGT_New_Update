<?php
include('fetch.php');

if (isset($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Manual Task</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/list.css">

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
                        <h6>Add Manual Task Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Manual Task Details</h4>
                </div>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="project">Project</label>
                                <select class="form-select" name="project" id="project" autofocus>
                                    <option value="">Project List</option>
                                    <?php

                                    $link = $db->link();
                                    $s_final = "SELECT DISTINCT mp.id,mp.title,mp.c_id FROM `m_pro` as mp JOIN `m_quot` as mq ON mp.id=mq.f_id where mq.status='final' and mp.status='Active' ";
                                    $q_final = mysqli_query($link, $s_final);
                                    while ($c_final = mysqli_fetch_assoc($q_final)) {
                                        $cmp_det = $fetch->table_list_id('m_cmp', 'id', $c_final['c_id']);

                                        ?>
                                        <option value="<?php echo $c_final['id']; ?>"><?php echo $c_final['title']; ?>-
                                            <?php echo $cmp_det['c_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                    <option>Company Activity</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="employee">Employee</label>
                                <select class="form-select" name="assignto" id="input1">
                                    <option value="">Employee List</option>
                                    <?php
                                    $emp_det = $fetch->m_emp();
                                    foreach ($emp_det as $ed) {
                                        ?>
                                        <option value="<?php echo $ed['id']; ?>"><?php echo $ed['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="category">Category</label>
                                <select name="cat" id="input2" class="form-select task_cat">
                                    <option value="" selected true>Select Category</option>
                                    <?php

                                    $task = $fetch->task_list();
                                    foreach ($task as $tk) {
                                        if ($tk['task'] == 'Lead') {
                                            continue;
                                        }
                                        ?>
                                        <option><?php echo $tk['task']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="subcategory">Sub Category</label>
                                <select name="sub_cat" id="input3" class="form-select sub_cat">
                                    <option value="" selected true>Select Sub Category</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="startdate">Start Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="startdate" id="">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="enddate">End Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="enddate" id="">
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" name="s_time" id="">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="description">Title</label>
                                <input type="text" class="form-control" name="title" id="" placeholder="Enter Title">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="description">Description</label>
                                <textarea rows="1" class="form-control" name="desc" id=""
                                    placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="file">File</label>
                                <input type="file" class="form-control" name="man_file" id="">
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="add_manual">
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

        // Ask the user for confirmation
        const isConfirmed = window.confirm("Are you ready to save?");

        if (isConfirmed) {
            // Collect form data

            // Collect form data
            const formData = new FormData(this);

            // console.log(...formData.entries());
            console.log(...formData.entries());

            // // // Send data to PHP backend using Fetch API
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

                        //     //  window.location.href = data.url;

                    } else {


                        popup(data.message, data.url);


                        //     // window.location.href = data.url;


                        //     // alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    alert("There was an error: " + error.message);
                });

        } else {
            // If user cancels, re-enable the submit button
            submitButton.disabled = false;
            console.log("Form submission canceled");
        }

    });
</script>

<script>
    $('.task_cat').on('change', function () {
        var drop = $(this).val();
        var formData = new FormData();
        formData.append('task_cat_drop', drop); // Append the selected value
        fetch('ajax_dep.php', {
            method: 'POST',
            body: formData, // Make sure formData contains any necessary data
        })
            .then(response => {
                if (response.ok) {
                    return response.text(); // Expect HTML as a response, not JSON
                } else {
                    throw new Error("Request failed with status: " + response.status);
                }
            })
            .then(html => {
                // console.log(html);
                // If the response is HTML, you can insert it into the DOM
                // For example, populate the dependent dropdown
                $('.sub_cat').html(html);
                // document.getElementsByClassName("sub_cat").innerHTML = html;
                // Optionally, you could trigger any further actions based on the data
                // For instance, enable the second dropdown if necessary
                // document.getElementById("dependentDropdown").disabled = false;
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>

</html>