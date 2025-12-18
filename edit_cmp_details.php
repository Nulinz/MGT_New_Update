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
    <title>Update Company Details</title>

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
                        <h6>Edit Company Details Form</h6>
                    </div>
                </div>
                <?php
                $cmp_st = $fetch->table_list_id('m_cmp2', 'f_id', $com_id);
                $store = json_decode($cmp_st['store']);
                $lastItem = end($store);

                $b_acc = json_decode($cmp_st['b_acc']);
                $b_last = end($b_acc);

                ?>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Company Details</h4>
                </div>
                <form action="" method="POST" id="my_form">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="storeacct">Store Accounts <span>*</span></label>
                                <div class="d-flex justify-content-start align-items-center gap-2 mt-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="type[]" value="playstore" <?php echo in_array('playstore', $store) ? 'checked' : ''; ?> id="playstore" autofocus>
                                        <label class="form-check-label my-auto" for="playstore">Playstore
                                            Account</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="type[]" value="appstore" <?php echo in_array('appstore', $store) ? 'checked' : ''; ?> id="appstore">
                                        <label class="form-check-label my-auto" for="appstore">Appstore Account</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="type[]" value="nil" <?php echo in_array('nil', $store) ? 'checked' : ''; ?> id="nil">
                                        <label class="form-check-label my-auto" for="nil">Nil</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="storeacct">Business Accounts <span>*</span></label>
                                <div class="d-flex justify-content-start align-items-center gap-1 mt-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="b_type[]" id="googlebusiness"
                                            value="googlebusiness" <?php echo in_array('googlebusiness', $b_acc) ? 'checked' : ''; ?> autofocus>
                                        <label class="form-check-label my-auto" for="googlebusiness">Google
                                            Business</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="b_type[]" id="indianmarket" value="indianmarket"
                                            <?php echo in_array('indianmarket', $b_acc) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="indianmarket">Indian Market</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="b_type[]" id="justdial" value="justdial" <?php echo in_array('justdial', $b_acc) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="justdial">Just Dial</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="b_type[]" value="nil" id="nil" <?php echo in_array('nil', $b_acc) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="nil">Nil</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="usingsw">Currently using Software <span>*</span></label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="soft" id="swyes" value="yes" <?php echo ($cmp_st['soft'] == 'yes') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="swyes">Yes</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="soft" id="swno" value="no" <?php echo ($cmp_st['soft'] == 'no') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="swno">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs" id="software-section"
                                style="display: none;">
                                <label for="swname">Software Name <span>*</span></label>
                                <input type="text" class="form-control" name="soft_name" id="swname"
                                    value="<?php echo $cmp_st['soft_name']; ?>" placeholder="Enter Software Name">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="turnover">Turnover (Annually) <span>*</span></label>
                                <select name="turnover" id="turnover" class="form-select" required>
                                    <option value="<?php echo $cmp_st['turn_over']; ?>" selected>
                                        <?php echo $cmp_st['turn_over']; ?></option>
                                    <option value="0 - 25 Lakhs">0 - 25 Lakhs</option>
                                    <option value="25 Lakhs - 50 Lakhs">25 Lakhs - 50 Lakhs</option>
                                    <option value="50 Lakhs - 75 Lakhs">50 Lakhs - 75 Lakhs</option>
                                    <option value="75 Lakhs - 1 Crore">75 Lakhs - 1 Crore</option>
                                    <option value="1 Crore and Above">1 Crore and Above</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="noemp">No. Of Employees <span>*</span></label>
                                <input type="number" class="form-control" name="noemp" id="noemp" min="0"
                                    value="<?php echo $cmp_st['emp_no']; ?>" placeholder="Enter No. Of Employees"
                                    required>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="customerrating">Customer Rating</label>
                                <select name="customerrating" id="customerrating" class="form-select">
                                    <option value="<?php echo $cmp_st['cus_rate']; ?>" selected>
                                        <?php echo $cmp_st['cus_rate']; ?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="remarks">Remarks</label>
                                <textarea rows="1" name="remarks" id="remarks" class="form-control"
                                    placeholder="Enter Remarks"><?php echo $cmp_st['remarks']; ?></textarea>
                            </div>
                            <?php
                            /*
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="noemp">Leads Generated By <span>*</span></label>
                                <select name="mgt_emp" id="" class="form-select" required>
                                    <option value="" selected disabled>Select Options</option>
                                    <?php
                                    $emp_det = $fetch->m_emp();

                                    foreach ($emp_det as $ed) {
                                        ?>

                                        <option value="<?php echo $ed['id']; ?>"><?php echo $ed['name']; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                                <!-- <input type="text" class="form-control" name="mgt_emp" id="noemp"
                                    placeholder="Enter Leads Generated By"> -->
                            </div>
                            */
                            ?>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <!-- <a href="./add_cmp_contact_person.php"> -->
                        <input hidden type="text" name="up_com2">
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
                //  console.log(data);
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