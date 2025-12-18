<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
header('Content-Type: application/json');

include('update.php');

header('Content-Type: application/json');

// update the project

if (isset($_POST['update_project'])) {

  echo ($up->up_project($_POST));

}


if (isset($_POST['up_company'])) {

  echo ($up->up_company($_POST));

}
if (isset($_POST['up_com2'])) {

  echo ($up->up_com2($_POST));

}
// update the contact person details

if (isset($_POST['up_com3'])) {

  echo ($up->up_com3($_POST));

}
// update the Employee  details

if (isset($_POST['up_emp1'])) {

  echo ($up->up_emp1($_POST, $_FILES));

}
// update the Employee  details

if (isset($_POST['up_emp2'])) {

  echo ($up->up_emp2($_POST));

}
// update the Employee  details part -3

if (isset($_POST['up_emp3'])) {

  echo ($up->up_emp3($_POST));

}

// update the Employee  details part -4

if (isset($_POST['up_emp4'])) {

  echo ($up->up_emp4($_POST));

}
// update the Supplier  details

if (isset($_POST['up_supplier'])) {

  echo ($up->up_supplier($_POST));

}

// update the ledger  details

if (isset($_POST['up_ledger'])) {

  echo ($up->up_ledger($_POST));

}


// update the expenses  details

if (isset($_POST['up_expenses'])) {

  echo ($up->up_expenses($_POST, $_FILES));

}
// update the category  details

if (isset($_POST['up_category'])) {

  echo ($up->up_category($_POST));

}
// update the Sub_category  details

if (isset($_POST['up_subcategory'])) {

  echo ($up->up_subcategory($_POST));

}
// update the meeting  details

if (isset($_POST['up_meet'])) {

  echo ($up->up_meet($_POST, $_FILES));

}
// update the meeting  details

if (isset($_GET['pro_sch'])) {

  echo ($up->pro_sch($_GET));

}


// update the Task Status  details

if (isset($_POST['task_id'], $_POST['status'])) {

  echo ($up->emp_task_status($_POST));

}

// update the Task Status  details for bda

if (isset($_POST['bda_task_id'], $_POST['status'])) {

  echo ($up->emp_task_status($_POST));

}

//upadat  teh pop html form

if (isset($_POST['tk_id_pop'])) {

  $tk_id = $_POST['tk_id_pop'];
  $link = $db->link();

  $s_tk = "SELECT * from `m_pro_task` where `id`='$tk_id' ";
  $q_tk = mysqli_query($link, $s_tk);
  $d_tk = mysqli_fetch_assoc($q_tk);
  $seq = $d_tk['seq'] + 1;
  $pro_id = $d_tk['pro_id'];

  $s_seq = "SELECT * from `m_pro_task` where `pro_id`='$pro_id' and `seq`='$seq'";
  $q_seq = mysqli_query($link, $s_seq);
  $d_seq = mysqli_fetch_assoc($q_seq);


  $htmlContent = '
  <form class="row" action="up_ajax.php" method="POST" enctype="multipart/form-data">
    <input hidden type="text" name="task_id" value="' . $d_seq['id'] . '">

        <div class="col-sm-12 col-md-6 mb-3">
            <label for="taskname" class="col-form-label">Task Title</label>
            <input type="text" class="form-control" name="taskname" id="" value="' . $d_seq['title'] . '"
                placeholder="Enter Task Title">
        </div>
        <div class="col-sm-12 col-md-6 mb-3">
            <label for="file" class="col-form-label">File</label>
            <input type="file" class="form-control" name="task_file" id="file">
        </div>
        <div class="col-sm-12 col-md-12 mb-3">
            <label for="taskdescp" class="col-form-label">Task Desctiption</label>
            <textarea class="form-control" name="taskdescp" id="taskdescp"
                placeholder="Enter Task Desctiption">' . $d_seq['des'] . '</textarea>
        </div>
        <div class="d-flex justify-content-center align-items-center mx-auto">
            <button type="submit" name="task_submit" class="modalbtn">Assign</button>
        </div>
    </form>';

  echo json_encode($htmlContent);
  echo json_encode([
    'status' => 'success',
    'message' => 'Updated successfully',
    'url' => 'edit_emp_job.php'
  ]);
  exit;


}

if (isset($_POST['task_submit'])) {
  // print_r($_POST);
  // print_r($_FILES);

  echo ($up->emp_task_ind($_POST, $_FILES));
}

if (isset($_GET['tk_manual'])) {
  // print_r($_POST);
  // print_r($_FILES);

  echo ($up->emp_inital($_GET));
}

//update the leave approval

if (isset($_POST['lv_id_up'])) {
  // print_r($_POST);
  // print_r($_FILES);

  echo ($up->leave_app($_POST));
}
//update the password

if (isset($_POST['change_pwd'])) {
  // print_r($_POST);
  // print_r($_FILES);

  echo ($up->change_pwd($_POST));
}

// update the leave request

if (isset($_POST['edit_leave'])) {
  // print_r($_POST);
  // print_r($_FILES);

  echo ($up->update_leave($_POST));
}
// update the budget

if (isset($_POST['edit_pre_mon'])) {
  // print_r($_POST);
  // print_r($_FILES);

  echo ($up->edit_pre_mon($_POST));
}

//delete the budget

if (isset($_GET['bud_del'])) {
  // print_r($_POST);
  // print_r($_FILES);

  $link = $db->link();
  $s_del = "DELETE FROM `m_pre_bud` WHERE `id`='{$_GET['bud_del']}'";
  $q_del = mysqli_query($link, $s_del);
  if ($q_del) {
    header("Location:./list_pre_mon.php");

  }
}
?>