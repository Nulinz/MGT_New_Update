<?php
// session_start();
include('db.php');

$emp_log = $_COOKIE['emp'];

$logout_time = $db->c_on();

$cur_date = $db->c_date;

$link = $db->link();

$insert_logout = "UPDATE `e_login` SET `logout`='$logout_time',`status`='logout' where `f_id`='$emp_log' and DATE(`c_on`)='$cur_date'";
$q_logout = mysqli_query($link,$insert_logout);

setcookie("emp","", time()-3600, '/'); // 86400 = 1 day

header('location:./index.php');


?>