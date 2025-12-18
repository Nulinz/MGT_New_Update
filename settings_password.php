<form action="" method="POST" id="my_form_pwd">
    <div class="container-fluid maindiv bg-white">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="password2">New Password </label>
                <div class="d-flex justify-content-between align-items-center inpflex">
                    <input type="password" name="password_new" id="password2" class="form-control border-0"
                        placeholder="Enter New Password" required>
                    <i class="fa-solid fa-eye-slash" id="passHide_2"
                        onclick="togglePasswordVisibility('password2', 'passShow_2', 'passHide_2')"
                        style="display:none; cursor:pointer;"></i>
                    <i class="fa-solid fa-eye" id="passShow_2"
                        onclick="togglePasswordVisibility('password2', 'passShow_2', 'passHide_2')"
                        style="cursor:pointer;"></i>
                </div>
                <div class="mt-1">
                    <div class="progress" style="height:6px;">
                        <div id="pwdBar" class="progress-bar" style="width:0%"></div>
                    </div>
                    <small id="pwdStrengthText"></small>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-4 mb-3 px-2 inputs">
                <label for="password3">Confirm New Password</label>
                <div class="d-flex justify-content-between align-items-center inpflex">
                    <input type="password" name="password_cnf" id="password3" class="form-control border-0"
                        placeholder="Enter Confirm New Password" required onchange="">
                    <i class="fa-solid fa-eye-slash" id="passHide_3"
                        onclick="togglePasswordVisibility('password3', 'passShow_3', 'passHide_3')"
                        style="display:none; cursor:pointer;"></i>
                    <i class="fa-solid fa-eye" id="passShow_3"
                        onclick="togglePasswordVisibility('password3', 'passShow_3', 'passHide_3')"
                        style="cursor:pointer;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
        <button type="submit" id="sub" class="formbtn">Save</button>
    </div>
</form>

<script>
    document.getElementById("my_form_pwd").addEventListener("submit", function (e) {
        e.preventDefault();
        const submitButton = document.getElementById("sub");
        submitButton.disabled = true;

        const pwdNew = document.getElementById("password2").value;
        const pwdCnf = document.getElementById("password3").value;

        if (pwdNew !== pwdCnf) {
            alert("Passwords do not match");
            submitButton.disabled = false;
            return;
        }

        const formData = new FormData();
        formData.append("password_new", pwdNew);
        formData.append("change_pwd", "change_pwd");

        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())  // parse JSON
            .then(data => {
                console.log("Full response:", data);  // see entire JSON
                console.log("Hashed password:", data.hashed_password); // hashed password
                alert(data.message);
                submitButton.disabled = false;

                if (data.status === 'success') {
                    this.reset();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                submitButton.disabled = false;
            });
    });
</script>

<script>
    const pwdInput = document.getElementById("password2");
    const pwdBar = document.getElementById("pwdBar");
    const pwdText = document.getElementById("pwdStrengthText");

    pwdInput.addEventListener("input", function () {
        const pwd = pwdInput.value;
        let score = 0;

        if (pwd.length >= 6) score++;
        if (pwd.length >= 10) score++;
        if (/[A-Z]/.test(pwd)) score++;
        if (/[0-9]/.test(pwd)) score++;
        if (/[^A-Za-z0-9]/.test(pwd)) score++;

        if (pwd.length === 0) {
            pwdBar.style.width = "0%";
            pwdText.innerText = "";
            return;
        }

        switch (score) {
            case 1:
                pwdBar.style.width = "25%";
                pwdBar.style.backgroundColor = "red";
                pwdText.innerText = "Weak";
                pwdText.style.color = "red";
                break;

            case 2:
            case 3:
                pwdBar.style.width = "50%";
                pwdBar.style.backgroundColor = "orange";
                pwdText.innerText = "Medium";
                pwdText.style.color = "orange";
                break;

            case 4:
                pwdBar.style.width = "75%";
                pwdBar.style.backgroundColor = "#0d6efd";
                pwdText.innerText = "Strong";
                pwdText.style.color = "#0d6efd";
                break;

            case 5:
                pwdBar.style.width = "100%";
                pwdBar.style.backgroundColor = "green";
                pwdText.innerText = "Very Strong";
                pwdText.style.color = "green";
                break;
        }
    });
</script>