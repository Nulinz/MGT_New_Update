<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>

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

            <div class="sidebodydiv px-5 py-3 mb-3">
                <div class="sidebodyback mb-3" onclick="goBack()">
                    <div class="backhead">
                        <h5><i class="fas fa-arrow-left"></i></h5>
                        <h6>Add Task Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Task Details</h4>
                </div>
                <form action="" method="post" id="">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="prjtlist">Project</label>
                                <select class="form-select" name="prjtlist" id="prjtlist" autofocus>
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="">Project List</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="employee">Employee</label>
                                <select class="form-select" name="employee" id="employee">
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="">Employee List</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="startdate">Start Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01" max="9999-12-31" name="startdate" id="startdate">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="enddate">End Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01" max="9999-12-31" name="enddate" id="enddatedate">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                            <label for="category">Category</label>
                                <select name="category" id="category" class="form-select">
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="">Category List</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                            <label for="subcategory">Sub Category</label>
                                <select name="subcategory" id="subcategory" class="form-select">
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="">Sub Category List</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" name="time" id="time">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="description">Description</label>
                                <textarea rows="1" class="form-control" name="description" id="description"
                                    placeholder="Enter Description"></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="file">File</label>
                                <input type="file" class="form-control" name="file" id="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="button" class="formbtn">Request</button>
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

</html>