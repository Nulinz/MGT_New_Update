<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project Document</title>

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
                        <h6>Add Project Document Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Project Document Details</h4>
                </div>
                <form action="" method="post" id="">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="doctype">Document Type</label>
                                <select name="doctype" id="doctype" class="form-select" autofocus>
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="">SRS</option>
                                    <option value="">SRD</option>
                                    <option value="">Logo</option>
                                    <option value="">Gallery Photo</option>
                                    <option value="">Other Resources</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Enter Title">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="fileattach">File</label>
                                <input type="file" class="form-control" name="fileattach" id="fileattach">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="button" class="formbtn">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

</body>

</html>