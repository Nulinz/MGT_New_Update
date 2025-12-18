<?php
include('fetch.php');
if (isset($_GET['pro'])) {
    $pro_id = $_GET['pro'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project Meeting</title>

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
                        <h6>Add Project Meeting Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Project Meeting Details</h4>
                </div>
                <form action="" method="POST" id="my_form" enctype="multipart/form-data">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="type">Meeting Type <span>*</span></label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="type" value="online" id="online" autofocus>
                                        <label class="form-check-label my-auto" for="online">Online</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="type" value="offline" id="offline">
                                        <label class="form-check-label my-auto" for="offline">Offline</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="date">Date <span>*</span></label>
                                <input type="date" class="form-control" name="m_date" id="date" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="time">Time <span>*</span></label>
                                <input type="time" class="form-control" name="m_time" id="time" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="description">Description</label>
                                <textarea rows="1" class="form-control" name="m_des" id="description"
                                    placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs online-section" style="display: none;">
                                <label for="meetlink">Meeting Link <span>*</span></label>
                                <input type="text" class="form-control" name="meetlink" id="meetlink"
                                    placeholder="Enter Meeting Link">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs offline-section" style="display: none;">
                                <label for="location">Location <span>*</span></label>
                                <input type="text" class="form-control" name="location" id="location"
                                    placeholder="Enter Location">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="personinv">Persons Invloved <span>*</span></label>
                                <select name="emp_inv[]" id="personinv" class="form-select select2" multiple="multiple"
                                    required>

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
                                <label for="clientteam">Client Team</label>
                                <textarea rows="1" class="form-control" name="client_team" id="clientteam"
                                    placeholder="Enter Client Team"></textarea>
                            </div>
                            <!-- <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="meetsts">Meeting Status <span>*</span></label>
                                <select class="form-select" name="meetsts" id="meetsts" required>
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="Upcoming">Upcoming</option>
                                </select>
                            </div> -->
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input type="text" hidden name="add_meet">
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
        $('input[type="radio"]').change(function () {
            var selectedValue = $('input[name="type"]:checked').val();
            $('.online-section').hide();
            $(".offline-section").hide();
            $('.online-section input').prop("required", false);
            $('.offline-section input').prop("required", false);
            if (selectedValue === 'online') {
                $('.online-section').show();
                $('.online-section input').prop("required", true);
            } else if (selectedValue === 'offline') {
                $(".offline-section").show();
                $('.offline-section input').prop("required", true);
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

        formData.append('pro', '<?php echo $pro_id; ?>');

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