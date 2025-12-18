<nav class="navbar px-4">
    <div class="icons login col-sm-12 col-md-12">
        <button class="border-0 m-0 p-0 responsive_button" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span id="navigation-icon" style=" font-size:25px;cursor:pointer">&#9776;</span>
        </button>
        <div class="navlogo">
            <a href="./index.php" class="mx-auto"><img src="./images/logo.png" alt="" height="40px" class="mx-auto"></a>
        </div>

        <div class="headimg">
            <a href="./settings.php" data-bs-toggle="tooltip" data-bs-title="Settings"><img src="./images/setting.png"
                    height="28px" alt=""></a>
        </div>

        <div class="headimg">
            <a href="./notification.php" data-bs-toggle="tooltip" data-bs-title="Notifications"><img
                    src="./images/bell.png" height="28px" alt=""></a>
        </div>
        <?php
        $link_nav = $db->link();
        $cr_on = $db->c_date;
        $s_login = "SELECT * from `e_login` where `f_id`='$emp_cook' and DATE(`c_on`)='$cr_on'";
        $q_log = mysqli_query($link_nav, $s_login);
        $c_log = mysqli_num_rows($q_log);
        if ($c_log > 0) {
            $d_log = mysqli_fetch_assoc($q_log);
            $log_time = date("d-m-Y H:i a", strtotime($d_log['login']));
        }

        ?>
        <div class="user" style="cursor: pointer;" data-bs-toggle="tooltip"
            data-bs-title="<?php echo $log_time ?? ''; ?>">
            <!-- <h5></h5> -->
            <img src="./images/avatar.png" height="43px" class="rounded-5" alt="">
            <h6 class="bg-dark px-3 m-0">
                <span class="username"><?php
                $emp_det = $fetch->table_list_id('m_emp', 'id', $emp_log);
                echo $emp_det['name'];
                // $emp_det2 = $fetch->table_list_id('m_emp2', 'f_id', $emp_log);
                
                ?>
                </span>
                <br>
                <span class="userrole"><?php echo $emp_role; ?></span>
            </h6>
        </div>
    </div>
</nav>