<?php
include('fetch.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Generation List</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/list.css">
    <link rel="stylesheet" href="./css/form.css">

</head>
<style>
    @media screen and (min-width: 1098px) {
        .table tbody td .form-control {
            padding: 2px 5px !important;
            font-size: 12px;
            border-radius: 2px !important;
        }
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
                    <h4 class="m-0">Salary Generation List</h4>
                </div>

                <form action="" method="post" id="">
                    <div class="container-fluid maindiv bg-white my-3">
                        <div class="row">
                            <!-- <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="month">Month</label>
                                <select class="form-select" name="month" id="month" autofocus>
                                    <option value="" selected disabled>Select Options</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div> -->
                            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 inputs">
                                <label for="month">Month</label>
                                <input type="month" class="form-control" name="monthyear" id="monthyear">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                        <button type="submit" name="sal_form" class="formbtn">Save</button>
                    </div>
                </form>

                <div class="container-fluid mt-4 listtable">
                    <div class="filter-container row mb-3">
                        <div class="custom-search-container col-sm-12 col-md-8">
                            <select class="headerDropdown form-select filter-option">
                                <option value="All" selected>All</option>
                            </select>
                            <input type="text" id="customSearch" class="form-control filterInput" placeholder=" Search">
                        </div>

                        <div class="select1 col-sm-12 col-md-4 mx-auto">
                            <div class="d-flex gap-3">
                                <a href="" id="pdfLink"><img src="./images/printer.png" id="print" alt="" height="35px"
                                        data-bs-toggle="tooltip" data-bs-title="Print"></a>
                                <a href="" id="excelLink"><img src="./images/excel.png" id="excel" alt="" height="35px"
                                        data-bs-toggle="tooltip" data-bs-title="Excel"></a>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['sal_form'])) {
                        $mon = strval($_POST['monthyear']);

                        ?>

                        <div class="table-wrapper">
                            <form action="" method="POST" id="my_form">
                                <input hidden type="text" name="mon" value="<?php echo $mon; ?>">
                                <table class="example table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee</th>
                                            <th>Salary</th>
                                            <th>LOP</th>
                                            <th>Permission</th>
                                            <th>Incentives</th>
                                            <th>Additional</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $mp_emp = $fetch->table_list_arr('m_emp', 'status', 'Active');
                                        $i = 1;
                                        foreach ($mp_emp as $me) {

                                            $sal = $fetch->table_list_id('m_emp3', 'f_id', $me['id']);

                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $me['name'] . "<br>" . $me['emp_code']; ?> <input hidden type="text"
                                                        name="emp[]" value="<?php echo $me['id']; ?>"></td>
                                                <td><?php echo $sal['net']; ?></td>
                                                <td><input hidden type="text" class="base"
                                                        value="<?php echo ($sal['net']); ?>"> <input type="text" name="lop[]"
                                                        class="lop" value="0"></td>
                                                <td><input type="number" class="form-control per" id="permission" name="per[]"
                                                        value="0"></td>
                                                <td><input type="number" class="form-control inc" id="incentives" name="inc[]"
                                                        value="0"></td>
                                                <td><input type="number" class="form-control add" id="additional" name="add[]"
                                                        value="0"></td>
                                                <td><input type="number" class="form-control total" id="total" name="total[]"
                                                        value="0" readonly></td>
                                                <!-- <td>14950</td> -->
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div
                                    class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                                    <input hidden type="text" name="sal_gen">
                                    <button type="submit" id="sub" class="formbtn">Save</button>
                                </div>
                            </form>
                        </div>

                        <?php
                    }
                    ?>
                </div>
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
            "searching": true,
            "ordering": true,
            "bDestroy": true,
            "info": false,
            "responsive": true,
            "pageLength": 10,
            "dom": '<"top"f>rt<"bottom"lp><"clear">'
        });

    });

    $(document).on('change', '.lop, .per, .inc, .add', function () {
        // Get the current row
        let $currentRow = $(this).closest('tr');

        // Get the values of inputs within the current row
        let inc = $currentRow.find('.inc').val();
        let per = $currentRow.find('.per').val();
        let add = $currentRow.find('.add').val();
        let lop = parseFloat($currentRow.find('.lop').val());
        let base = $currentRow.find('.base').val();

        let one = parseInt(base / 26);



        let lop_amt = one * lop;

        let per_amt = 50;

        let per_amt1 = per * per_amt;

        let total = (((base) - (lop_amt + per_amt1)))

        let total1 = parseFloat(total) + parseInt(inc) + parseInt(add);


        //   $(".total").val(total1);

        $currentRow.find('.total').val(total1);


        // console.log("Inc Value: " + inc);
        // console.log("Per Value: " + per);
        // console.log("Lop Value: " + base);

        // You can perform additional actions here with the retrieved values
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