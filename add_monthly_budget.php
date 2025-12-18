<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Monthly Budget</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/form.css">

</head>
<style>
    table td input[type="checkbox"] {
        width: 15px;
        height: 15px;
    }
</style>

<body>

    <div class="main">

        <!-- aside -->
        <?php include("./aside.php"); ?>

        <div class="side-body">

            <!-- Navbar -->
            <?php include("./navbar.php"); ?>

            <div class="sidebodydiv px-4 py-2">
                <div class="sidebodyhead">
                    <h4 class="m-0">Add Monthly Budget</h4>
                </div>

                <?php
                $link = $db->link();
                ?>

                <form action="" method="POST" id="my_form">

                    <div class="container-fluid mt-4 listtable">
                        <div class="filter-container row mb-3">
                            <div class="custom-search-container col-sm-12 col-md-8">
                                <select class="form-select rounded-2" name="mon" id="month" autofocus required>
                                    <option value="" selected true>Select Month</option>
                                    <?php
                                    // Define an associative array with month number as the key and month name as the value
                                    $months = [
                                        "01" => "January",
                                        "02" => "February",
                                        "03" => "March",
                                        "04" => "April",
                                        "05" => "May",
                                        "06" => "June",
                                        "07" => "July",
                                        "08" => "August",
                                        "09" => "September",
                                        "10" => "October",
                                        "11" => "November",
                                        "12" => "December"
                                    ];

                                    foreach ($months as $key => $value) {

                                        $s_mon = "SELECT * from `m_budget` where `mon`='$key'";
                                        $q_mon = mysqli_query($link, $s_mon);
                                        $d_mon = mysqli_num_rows($q_mon);

                                        if ($d_mon > 0) {
                                            continue;
                                        }

                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="table-wrapper">
                            <table class="example table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center pe-2">Check</th>
                                        <th>#</th>
                                        <th>Ledger Name</th>
                                        <th style="width: 200px">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $led_list = $fetch->table_list_arr('m_ledger', 'status', 'Active');
                                    $i = 1;
                                    foreach ($led_list as $led) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" name="check[]" id="check"
                                                        value="<?php echo $led['id']; ?>">
                                                </div>
                                            </td>
                                            <td><?php echo $i++; ?> </td>
                                            <td><?php echo $led['name']; ?></td>
                                            <td><input type="number" name="bud[]" class="form-control" min="0" name=""
                                                    id=""></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <div
                                class="col-sm-12 col-md-12 col-xl-12 d-flex justify-content-center align-items-center mt-3">
                                <input hidden type="text" name="add_budget">
                                <button type="submit" id="sub" class="formbtn">Save</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <?php include("./offcanvas.php"); ?>

    <!-- script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>
    // DataTables List
    $(document).ready(function () {
        var table = $('.example').DataTable({
            "paging": false,
            "searching": false,
            "ordering": true,
            "bDestroy": true,
            "info": false,
            "responsive": true,
            "pageLength": 10,
            "dom": '<"top"f>rt<"bottom"lp><"clear">'
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