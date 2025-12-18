<?php

include('db.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nulinz MGT</title>

    <!-- Stylesheets CDN -->
    <?php include("./cdn_style.php"); ?>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/register.css">

</head>

<body>

    <div class="container" id="container">

        <div class="form-container sign-in">
            <form action="" id="my_form" method="POST">

                <!-- <div class="social-icons">
                    <a href="#" class="icons"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icons"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icons"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="icons"><i class="fa-brands fa-linkedin-in"></i></a>
                </div> -->
                <div class="mb-2 rounded-4">
                    <img src="./images/logo.png" height="50px" class="d-flex mx-auto" alt="">
                </div>
                <h1 class="mb-4">Sign In</h1>
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="emp" id="empcode"
                        placeholder="Enter Employee Code">
                </div>
                <div class="col-12 mb-2">
                    <div class="d-flex justify-content-between align-items-center inpflex">
                        <input type="password" class="form-control m-0" name="pwd" id="password1"
                            placeholder="Enter Password">
                        <i class="fa-solid fa-eye-slash" id="passHide_1"
                            onclick="togglePasswordVisibility('password1', 'passShow_1', 'passHide_1')"
                            style="display:none; cursor:pointer;"></i>
                        <i class="fa-solid fa-eye" id="passShow_1"
                            onclick="togglePasswordVisibility('password1', 'passShow_1', 'passHide_1')"
                            style="cursor:pointer;"></i>
                    </div>
                </div>

                <input hidden type="text" name="sign_in">
                <!-- <a href="#">Forget Password ?</a> -->
                <button type="submit" id="sub">Sign In</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <!-- <div class="toggle-panel toggle-left">
                    <h1>Welcome To Nulinz Technology</h1>
                    <p>Sign In with Employee Code & Password</p>
                    <button class="hidden" id="login">Sign In</button>
                </div> -->
                <div class="toggle-panel toggle-right">
                    <h1>Welcome To Nulinz Technology</h1>
                    <p>Empower Growth, Connect Business, Drive Success</p>
                    <!-- <button class="hidden" id="register">Sign Up</button> -->
                </div>
            </div>
        </div>

    </div>

    <!-- Script -->
    <?php include("./cdn_script.php"); ?>

</body>

<script>
    const container = document.getElementById("container");
    const registerBtn = document.getElementById("register");
    const loginBtn = document.getElementById("login");

    registerBtn.addEventListener("click", () => {
        container.classList.add("active");
    })

    loginBtn.addEventListener("click", () => {
        container.classList.remove("active");
    })
</script>

<script>
    function togglePasswordVisibility(inputId, showId, hideId) {
        let $input = $('#' + inputId);
        let $passShow = $('#' + showId);
        let $passHide = $('#' + hideId);

        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $passShow.hide();
            $passHide.show();
        } else {
            $input.attr('type', 'password');
            $passShow.show();
            $passHide.hide();
        }
    }
</script>

<script>
    document.getElementById("my_form").addEventListener("submit", function(event) {

event.preventDefault();  // Prevent default form submission

const submitButton = document.getElementById("sub");
submitButton.disabled = true;  // Disable the button

// Collect form data
const formData = new FormData(this);

//  formData.append("additionalKey", value);

console.log(...formData.entries());

// // Send data to PHP backend using Fetch API
fetch('db.php', {
    method: 'POST',
    body: formData,

})
.then(response => {

    if (response.ok) {

        // If the request was successful (status 200-299)
        return response.json();  // Parse the JSON data from the response
    } else {
        // Handle error if the response was not successful
        throw new Error("Request failed with status: " + response.status);
    }
})  // Assuming the PHP backend sends JSON
.then(data => {
         console.log(data);
    if (data.status === 'success') {

          window.location.href = data.url;

    } else {

         alert("Error: " + data.message);
         window.location.href = data.url;

    }
})
.catch(error => {
    alert("There was an error: " + error.message);
});

});
</script>

</html>