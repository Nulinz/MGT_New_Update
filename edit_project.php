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
    <title>Update Project</title>

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
                        <h6>Edit Project Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Project Details</h4>
                </div>
                <?php
                $pro_det = $fetch->table_list_id('m_pro', 'id', $pro_id);

                $emp_ass = $fetch->table_list_id('m_emp', 'id', $pro_det['assign']);


                $ag_arr = json_decode($pro_det['agree']);

                $a_last = end($ag_arr);

                $plat_arr = json_decode($pro_det['plat_form']);
                $p_last = end($plat_arr);

                $tech_arr = json_decode($pro_det['tech']);
                $t_last = end($tech_arr);
                ?>
                <form action="" method="POST" id="my_form">
                    <div class="container-fluid maindiv bg-white">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="prjttitle">Project Title</label>
                                <input type="text" class="form-control" name="prjttitle" id="prjttitle"
                                    placeholder="Enter Project Title" value="<?php echo $pro_det['title']; ?>" autofocus>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="leadtype">Lead Type</label>
                                <select name="lead" id="leadtype" class="form-select">
                                    <option value="<?php echo $pro_det['lead']; ?>" selected true>
                                        <?php echo $pro_det['lead']; ?></option>
                                    <option value="Hot">Hot</option>
                                    <option value="Cold">Cold</option>
                                    <option value="Warm">Warm</option>
                                    <option value="Wrong">Wrong</option>
                                    <option value="Follow Up">Follow Up</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="servicetype">Service Type</label>
                                <select name="service" id="servicetype" class="form-select">
                                    <option value="<?php echo $pro_det['service']; ?>" selected true>
                                        <?php echo $pro_det['service']; ?></option>
                                    <option value="Customised Software">Customised Software</option>
                                    <option value="Static Website">Static Website</option>
                                    <option value="Dynamic Website">Dynamic Website</option>
                                    <option value="Customised Website">Customised Website</option>
                                    <option value="Re-Built Software">Re-Built Software</option>
                                    <option value="Startup Initiative">Startup Initiative</option>
                                </select>
                            </div>

                            <?php
                            // $ser = $fetch->m_cat_id($pro_det['service']);
                            
                            ?>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="ecom">E-Commerce</label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="ecom" id="yes" value="yes" <?php echo ($pro_det['e_com'] == 'yes') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="yes">Yes</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="ecom" id="no" value="no" <?php echo ($pro_det['e_com'] == 'no') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="peopleno">No. Of People Using</label>
                                <input type="number" class="form-control" name="peopleno" id="peopleno" min="0"
                                    placeholder="Enter No. Of People Using" value="<?php echo $pro_det['no_user']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="needsw">Roles</label>
                                <textarea rows="1" name="roles" id="roles" class="form-control"
                                    placeholder="Enter Roles"><?php echo $pro_det['roles']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="purpose">Purpose</label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="purpose" id="own" value="own" <?php echo ($pro_det['purpose'] == 'own') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="own">Own</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="purpose" id="company" value="company" <?php echo ($pro_det['purpose'] == 'company') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="company">Company</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="prjtvalue">Project Value</label>
                                <input type="number" class="form-control" name="prjtvalue" id="prjtvalue" min="0"
                                    placeholder="Enter Project Value" value="<?php echo $pro_det['pro_val']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="technology">Technology</label>
                                <select name="technology[]" id="technology" class="select2input form-select"
                                    multiple="multiple">
                                    <?php
                                    $available_tech = [
                                        "HTML",
                                        "CSS",
                                        "JavaScript",
                                        "jQuery",
                                        "Bootstrap",
                                        "Tailwind CSS",
                                        "ReactJS",
                                        "PHP",
                                        "Ajax",
                                        "Firebase",
                                        "Laravel",
                                        "MySQL",
                                        "Android",
                                        "IOS",
                                        "Flutter",
                                        "Dart",
                                        "Swift",
                                        "Java",
                                        "Kotlin"
                                    ];

                                    // Loop through available technologies and check if each is in $tech_arr
                                    foreach ($available_tech as $tech) {
                                        $selected = in_array($tech, $tech_arr) ? 'selected' : '';  // Check if the tech is in the $tech_arr
                                        ?>
                                        <option value="<?php echo $tech; ?>" <?php echo $selected; ?>><?php echo $tech; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="estdate">Estimated Start Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="estdate" id="estdate"
                                    value="<?php echo $pro_det['st_date']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="reqdate">Required Date</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}" min="1000-01-01"
                                    max="9999-12-31" name="reqdate" id="reqdate"
                                    value="<?php echo $pro_det['re_date']; ?>">
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="payterms">Payment Terms</label>
                                <select name="payterms" id="payterms" class="form-select">
                                    <option value="<?php echo $pro_det['pay_term']; ?>" selected true>
                                        <?php echo $pro_det['pay_term']; ?></option>
                                    <option value="Net 30">Net 30</option>
                                    <option value="Net 60">Net 60</option>
                                </select>
                            </div>


                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="agreement">Agreement</label>

                                <div class="d-flex justify-content-start align-items-center gap-4 mt-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="agree[]" id="nda" value="nda" <?php echo in_array('nda', $ag_arr) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="nda">NDA</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="agree[]" id="mou" value="mou" <?php echo in_array('mou', $ag_arr) ? 'checked/' : ''; ?>>
                                        <label class="form-check-label my-auto" for="mou">MOU</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="agree[]" id="agreements" value="agreement" <?php echo in_array('agreement', $ag_arr) ? 'checked/' : ''; ?>>
                                        <label class="form-check-label my-auto" for="agreements">Agreements</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="agree[]" value="nil" id="nil" value="nil" <?php echo in_array('nil', $ag_arr) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="nil">Nil</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="platform">Platform</label>
                                <div class="d-flex justify-content-start align-items-center gap-4 mt-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="plat[]" id="web" value="web" <?php echo in_array('web', $plat_arr) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="web">Website</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="plat[]" id="android" value="android" <?php echo in_array('android', $plat_arr) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="android">Android</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="plat[]" id="ios" value="ios" <?php echo in_array('ios', $plat_arr) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="ios">IOS</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="checkbox" name="plat[]" value="nil" id="nil" <?php echo in_array('nil', $plat_arr) ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="nil">Nil</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="needsw">Why they need Software</label>
                                <textarea rows="1" name="needsw" id="needsw" class="form-control"
                                    placeholder="Enter Why they need Software"><?php echo $pro_det['need_soft']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="issues">What was the current issues in system</label>
                                <textarea rows="1" name="issues" id="issues" class="form-control"
                                    placeholder="Enter What was the current issues in system"><?php echo $pro_det['current']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="assignto">Assign To</label>
                                <select name="assignto" id="assignto" class="form-select">
                                    <option value="<?php echo $emp_ass['id']; ?>" selected true>
                                        <?php echo $emp_ass['name']; ?></option>
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
                                <select name="category" id="task_cat" class="form-select">
                                    <option value="<?php echo $pro_det['cat']; ?>" selected true>
                                        <?php echo $pro_det['cat']; ?></option>
                                    <?php
                                    $task = $fetch->task_list();

                                    foreach ($task as $tk) {
                                        ?>
                                        <option><?php echo $tk['task']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="subcategory">Sub Category</label>
                                <select name="subcategory" id="sub_cat" class="form-select">
                                    <option value="<?php echo $pro_det['sub_cat']; ?>" selected true>
                                        <?php echo $pro_det['sub_cat']; ?></option>
                                    <option value="">Sub Category List</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="paygateway">Payment Gateway</label>
                                <div class="d-flex justify-content-start align-items-center gap-5 mt-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="pay_gate" id="yes" value="yes" <?php echo ($pro_det['pay_gate'] == 'yes') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="yes">Yes</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="radio" name="pay_gate" id="no" value="no" <?php echo ($pro_det['pay_gate'] == 'no') ? 'checked' : ''; ?>>
                                        <label class="form-check-label my-auto" for="no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <input hidden type="text" name="update_project">
                        <button type="submit" id="sub" class="formbtn">Update</button>
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
        $('#gender').change(function () {
            var type = $(this).val();
            $('#marriage-section').hide();
            $('#marriageexpdate').prop('required', false);
            if (type === 'Female') {
                $('#marriage-section').show();
                $('#marriageexpdate').prop('required', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.select2input').select2({
            placeholder: "Select Options",
            allowClear: false,
            width: '100%'
        }).prop('required', true);
    });
</script>

<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        const formData = new FormData(this);

        var pro_id = '<?php echo $pro_id; ?>';


        formData.append("pro_id", pro_id);

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

                    window.location.href = data.url;

                } else {
                    window.location.href = data.url;
                    // alert("Error: " + data.message);
                }
            })
            .catch(error => {
                alert("There was an error: " + error.message);
            });

    });
</script>

<script>
    $('#task_cat').on('change', function () {

        var drop = $(this).val();

        var formData = new FormData();
        formData.append('task_cat_drop', drop); // Append the selected value

        fetch('ajax_dep.php', {
            method: 'POST',
            body: formData,  // Make sure formData contains any necessary data
        })
            .then(response => {
                if (response.ok) {
                    return response.text(); // Expect HTML as a response, not JSON
                } else {
                    throw new Error("Request failed with status: " + response.status);
                }
            })
            .then(html => {

                console.log(html);
                // If the response is HTML, you can insert it into the DOM
                // For example, populate the dependent dropdown
                document.getElementById("sub_cat").innerHTML = html;

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