<?php
include('fetch.php');

if(isset($_POST['task_cat_drop'])){

    $task_cat = $_POST['task_cat_drop'];

    $tk_list = $fetch->task_sub($task_cat);

    foreach($tk_list as $tk){
        ?>
        <option><?php echo $tk['sub']; ?></option>
        <?php
    }

}


?>