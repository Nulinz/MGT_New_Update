<?php
include('fetch.php');

if (isset($_GET['com'])) {

    $com_id = $_GET['com'];
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
                        <h6>Edit Company Form</h6>
                    </div>
                </div>
                <?php
                $cmp_det = $fetch->table_list_id('m_cmp', 'id', $com_id);
                $c_cat = $fetch->m_cat_id($cmp_det['c_cat']);
                $c_type = $fetch->m_cat_id($cmp_det['c_type']);
                $b_with = $fetch->m_cat_id($cmp_det['b_with']);
                // print_r($cmp_det)
                ?>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Company Details</h4>
                </div>
                <form action="" method="POST" id="my_form">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="type">Type</label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="type" id="new" value="New Company" <?php echo ($cmp_det['type'] == 'New Company') ? 'checked' : ''; ?> autofocus>
                                        <label class="form-check-label my-auto" for="new">New Company</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="type" id="existing" value="Existing Company" <?php echo ($cmp_det['type'] == 'Existing Company') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="existing">Existing Company</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="cmpnyname">Company Name <span>*</span></label>
                                <input type="text" class="form-control" name="cmpnyname" id="cmpnyname"
                                    placeholder="Enter Company Name" value="<?php echo $cmp_det['c_name']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="cmpnyctgy">Company Category <span>*</span></label>
                                <select name="cmp_cat" id="cmpnyctgy" class="form-select" required>
                                    <option value="<?php echo $c_cat['id']; ?>" selected><?php echo $c_cat['title']; ?>
                                    </option>
                                    <?php
                                    $cat = $fetch->m_cat_value('Company Category');
                                    foreach ($cat as $c) {
                                        ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo $c['title']; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="cmpnytype">Company Type <span>*</span></label>
                                <select name="c_type" id="cmpnytype" class="form-select" required>
                                    <option value="<?php echo $c_type['id']; ?>" selected>
                                        <?php echo $c_type['title']; ?></option>
                                    <?php
                                    $c_type = $fetch->m_cat_value('Company Type');
                                    foreach ($c_type as $c1) {
                                        ?>
                                        <option value="<?php echo $c1['id']; ?>"><?php echo $c1['title']; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="businesswith">Business With <span>*</span></label>
                                <select name="b_with" id="businesswith" class="form-select" required>
                                    <option value="<?php echo $b_with['id']; ?>" selected>
                                        <?php echo $b_with['title']; ?></option>
                                    <?php
                                    $b_type = $fetch->m_cat_value('Businessing With');
                                    foreach ($b_type as $b1) {
                                        ?>
                                        <option value="<?php echo $b1['id']; ?>"><?php echo $b1['title']; ?></option>
                                        <?php
                                    }
                                    ?>
                                    <!-- <option value="B2B">B2B</option>
                                    <option value="B2C">B2C</option>
                                    <option value="Individual Services">Individual Services</option> -->
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="contact">Contact Number <span>*</span></label>
                                <input type="number" class="form-control" name="contact" id="contact"
                                    oninput="validate(this)" min="6000000000" max="9999999999"
                                    placeholder="Enter Contact Number" value="<?php echo $cmp_det['contact']; ?>"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="mail">Email ID <span>*</span></label>
                                <input type="email" class="form-control" name="mail" id="mail"
                                    placeholder="Enter Email ID" value="<?php echo $cmp_det['mail']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="address">Address <span>*</span></label>
                                <textarea rows="1" name="address" id="address" class="form-control"
                                    placeholder="Enter Address" required><?php echo $cmp_det['address']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="district">District <span>*</span></label>
                                <input type="text" class="form-control" name="district" id="district"
                                    placeholder="Enter District" value="<?php echo $cmp_det['dis']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="state">State <span>*</span></label>
                                <input type="text" class="form-control" name="state" id="state"
                                    placeholder="Enter State" value="<?php echo $cmp_det['state']; ?>" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="pinode">Pincode <span>*</span></label>
                                <input type="number" class="form-control" name="pinode" id="pinode"
                                    value="<?php echo $cmp_det['pin']; ?>" oninput="validate_pin(this)" min="000000"
                                    max="999999" placeholder="Enter Pincode" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="website">Website <span>*</span></label>
                                <input type="text" class="form-control" name="website" id="website"
                                    value="<?php echo $cmp_det['web']; ?>" placeholder="Enter Website" required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="gst">GST <span>*</span></label>
                                <input type="text" class="form-control" name="gst" id="gst" placeholder="Enter GST"
                                    value="<?php echo $cmp_det['gst']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <!-- <a href="./add_cmp_details.php"> -->
                        <input hidden type="text" name="up_company">
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
        $('#swyes').on('change', function () {
            if ($(this).is(':checked')) {
                $('#software-section').show();
            }
        });

        $('#swno').on('change', function () {
            if ($(this).is(':checked')) {
                $('#software-section').hide();
            }
        });
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