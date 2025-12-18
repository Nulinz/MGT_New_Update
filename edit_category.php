<?php
include('fetch.php');

if (isset($_GET['cat_id'], $_GET['type'])) {
    $cat_id = $_GET['cat_id'];
    $type = $_GET['type'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>

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


            <?php
            if ($type == 'category') {
                ?>
                <!-- Category -->
                <div class="sidebodydiv px-4 py-2 mb-3">
                    <div class="sidebodyback mb-3" onclick="goBack()">
                        <div class="backhead">
                            <h5><i class="fas fa-arrow-left"></i></h5>
                            <h6>Edit Category Form</h6>
                        </div>
                    </div>
                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Category Details</h4>
                    </div>
                    <?php
                    $cat_lt = $fetch->table_list_id('m_cat', 'id', $cat_id);
                    ?>
                    <form action="" method="POST" id="my_form1">
                        <div class="container-fluid maindiv bg-white">
                            <div class="row">
                                <!-- <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="role">Category <span>*</span></label>
                                <select class="form-select" name="category" id="category" autofocus required>
                                    <option value="" selected disabled></option>
                                    <option value="Task Category">Task Category</option>
                                    <option value="Employee Category">Employee Category</option>
                                    <option value="Company Category">Company Category</option>
                                    <option value="Company Type">Company Type</option>
                                    <option value="Lead Type">Lead Type</option>
                                   <option value="Service Type">Service Type</option>
                                 <option value="Businessing With">Businessing With</option>
                                    <option value="Document">Document</option>
                                </select>
                            </div>  -->
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="title">Title <span>*</span></label>
                                    <input type="text" class="form-control" name="cat_title" id="title"
                                        value="<?php echo $cat_lt['title']; ?>" placeholder="Enter Title" required>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="description">Description</label>
                                    <textarea rows="1" class="form-control" name="cat_des" id="description"
                                        placeholder="Enter Description"><?php echo $cat_lt['des']; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                            <input hidden type="text" name="up_category">
                            <button type="submit" id="sub" class="formbtn">Save</button>
                        </div>
                    </form>
                </div>
                <?php
            } else {

                $sub_cat_lt = $fetch->table_list_id('m_sub_task', 'id', $cat_id);

                ?>

                <!-- Sub Category -->
                <div class="sidebodydiv px-4 py-2 mb-3">
                    <div class="sidebodyback mb-3" onclick="goBack()">
                        <div class="backhead">
                            <h5><i class="fas fa-arrow-left"></i></h5>
                            <h6>Edit Sub Category Form</h6>
                        </div>
                    </div>
                    <div class="sidebodyhead my-3">
                        <h4 class="m-0">Sub Category Details</h4>
                    </div>
                    <form action="" method="POST" id="my_form2">
                        <div class="container-fluid maindiv bg-white">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="role">Category <span>*</span></label>
                                    <select class="form-select" name="category" id="category" autofocus required>
                                        <option value="<?php echo $sub_cat_lt['task']; ?>" selected>
                                            <?php echo $sub_cat_lt['task']; ?></option>
                                        <?php
                                        $task = $fetch->m_cat_value('Task Category');

                                        foreach ($task as $tk) {
                                            ?>
                                            <option value="<?php echo $tk['title']; ?>"><?php echo $tk['title']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                    <label for="subcat">Sub Category <span>*</span></label>
                                    <input type="text" class="form-control" name="sub_title" id="subcat"
                                        value="<?php echo $sub_cat_lt['sub']; ?>" placeholder="Enter Sub Category" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                            <input hidden type="text" name="up_subcategory">
                            <button type="submit" id="sub" class="formbtn">Save</button>
                        </div>
                    </form>
                </div>
                <?php
            }
            ?>

        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>
    document.getElementById("my_form1").addEventListener("submit", function (event) {


        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        var cat_id = '<?php echo $cat_id; ?>';

        // Collect form data
        const formData = new FormData(this);

        formData.append("cat_edit", cat_id);
        //  formData.append("additionalKey", value);

        console.log(...formData.entries());

        // // Send data to PHP backend using Fetch API
        fetch('up_ajax.php', {
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
                    // window.location.href = data.url;

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


<script>
    document.getElementById("my_form2").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        // Collect form data
        const formData = new FormData(this);

        var cat_id = '<?php echo $cat_id; ?>';
        formData.append("cat_edit", cat_id);


        //  formData.append("additionalKey", value);

        console.log(...formData.entries());

        // // Send data to PHP backend using Fetch API
        fetch('up_ajax.php', {
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

                    // window.location.href = data.url;

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