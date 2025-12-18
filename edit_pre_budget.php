<?php
include('fetch.php');

if (isset($_GET['bud'])) {
    $bud_id = $_GET['bud'];

   $bud_ar = $fetch->table_list_id('m_pre_bud','id',$bud_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Budget </title>

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
                        <h6>Edit Pre Monthly Budget Form</h6>
                    </div>
                </div>
                <div class="sidebodyhead my-3">
                    <h4 class="m-0">Budget Details</h4>
                </div>
                <form action="" method="POST" id="my_form">

                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3" id="">
                                <label for="input2">Type <span>*</span></label>
                                <input type="text" class="form-control" name="type" id=""
                                    placeholder="Enter Description" value="<?php echo $bud_ar['type']; ?>" required>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3">
                                <label for="input4">Amount<span>*</span></label>
                                <input type="number" class="form-control" name="amt" id="" min="0"
                                    placeholder="Enter Amount" value="<?php echo $bud_ar['amt']; ?>" required>
                            </div>

                            </div>

                            <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                                <input hidden type="text" name="edit_pre_mon">
                                <button type="submit" id="sub" class="formbtn">Save</button>
                             </div>


                        </div>
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

</script>


<script>
    // DataTables List
    $(document).ready(function () {
        var table = $('#dataTable').DataTable({
            "paging": false,
            "searching": false,
            "ordering": true,
            "bDestroy": true,
            "info": false,
            "responsive": true,
            "pageLength": 10,
            "bDestroy": true,
            "dom": '<"top"f>rt<"bottom"lp><"clear">'
        });

    });
</script>

<script>
    document.getElementById("my_form").addEventListener("submit", function (event) {

        event.preventDefault(); // Prevent default form submission

        const submitButton = document.getElementById("sub");
        submitButton.disabled = true; // Disable the button

        const formData = new FormData(this);

        formData.append('bud_id', '<?php echo $bud_id; ?>');


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