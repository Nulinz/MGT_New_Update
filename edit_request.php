<?php
include('fetch.php');

if(isset($_GET['req_id'])){
   $req_id = $_GET['req_id'];

   $lv_lt = $fetch->table_list_id('e_leave','id',$req_id);
//    print_r($lv_lt);
   extract($lv_lt);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Request</title>

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
                        <h6>Edit Request Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Request Details</h4>
                </div>
                <form action="" method="POST" id="my_form">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="startdate">Start Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="startdate" id="startdate" value="<?php echo $s_date; ?>" autofocus>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="enddate">End Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="enddate" value="<?php echo $e_date; ?>" id="enddatedate">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="reqtype">Request Type</label>
                                <select class="form-select" name="reqtype" id="reqtype">
                                    <option value="<?php echo $type; ?>" selected true><?php echo $type; ?></option>
                                    <option value="Permission">Permission</option>
                                    <option value="Work From Home">Work From Home</option>
                                    <option value="Casual Leave">Casual Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Medical Leave">Medical Leave</option>
                                    <option value="Personal Leave">Personal Leave</option>
                                    <option value="Maternity Leave">Maternity Leave</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs time-section" style="display: none;">
                                <label for="permission">Permission (In Hours)</label>
                                <select class="form-select" name="permission" id="permission">
                                    <option value="<?php echo $hrs; ?>" selected true><?php echo $hrs; ?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="reason">Reason</label>
                                <textarea rows="1" class="form-control" name="reason" id="reason"
                                    placeholder="Enter Reason"><?php echo $reason; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">

                        <button type="submit" id="sub" class="formbtn">Request</button>
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
        $("#reqtype").change(function () {
            var request = $(this).val();
            $(".time-section").hide();
            $(".time-section").prop("required", false);
            if (request === "Permission") {
                $(".time-section").show();
                $(".time-section").prop("required", true);
            }
        })
    })
</script>

<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission
        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button
        // Collect form data
        const formData = new FormData(this);

        var edit_leave =  '<?php echo $req_id; ?>';

         formData.append("edit_leave", edit_leave);

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
                    popup(data.message,data.url);
                    // window.location.href = data.url;
                } else {
                    popup(data.message,data.url);
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