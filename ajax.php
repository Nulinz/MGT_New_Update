<?php

include_once('class.php');

header('Content-Type: application/json');

if (isset($_POST['check_email'])) {

  $email = trim($_POST['mail']);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
      'status' => 'error',
      'message' => 'Invalid email format'
    ]);
    exit;
  }

  $stmt = mysqli_prepare($ins->con, "SELECT id FROM m_emp WHERE email = ?");
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) > 0) {
    echo json_encode([
      'status' => 'exists',
      'message' => 'Email already exists'
    ]);
  } else {
    echo json_encode([
      'status' => 'available'
    ]);
  }
  exit;
}

if (isset($_POST['check_mobile'])) {

  $contact = trim($_POST['contact']);

  // Mobile format check
  if (!preg_match('/^[6-9]\d{9}$/', $contact)) {
    echo json_encode([
      'status' => 'error',
      'message' => 'Invalid mobile number'
    ]);
    exit;
  }

  $stmt = mysqli_prepare($ins->con, "SELECT id FROM m_emp WHERE contact = ?");
  mysqli_stmt_bind_param($stmt, "s", $contact);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) > 0) {
    echo json_encode([
      'status' => 'exists',
      'message' => 'Mobile number already exists'
    ]);
  } else {
    echo json_encode([
      'status' => 'available'
    ]);
  }
  exit;
}

if (isset($_POST['change_pwd'])) {

    $password = trim($_POST['password_new']);
    $emp_id = $_SESSION['emp_id'];

    if (strlen($password) < 6) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Password must be at least 6 characters'
        ]);
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use the correct mysqli connection from your class
    $stmt = mysqli_prepare($ins->con, "UPDATE m_emp SET pwd = ? WHERE id = ?");
    if (!$stmt) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Prepare failed: ' . mysqli_error($ins->con)
        ]);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "si", $hashed_password, $emp_id);

    if (!mysqli_stmt_execute($stmt)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Execute failed: ' . mysqli_stmt_error($stmt)
        ]);
        exit;
    }

    // Success response with hashed password
    echo json_encode([
        'status' => 'success',
        'message' => 'Password changed successfully',
        'hashed_password' => $hashed_password
    ]);
    exit;
}

if (isset($_POST['add_cat'])) {

  //  extract($_POST);

  echo ($ins->add_cat($_POST));

}

if (isset($_POST['add_sub_cat'])) {

  // print_r($_POST);

  //  extract($_POST);

  echo ($ins->add_sub_cat($_POST));

}


if (isset($_POST['add_emp1'])) {

  // print_r($_FILES);

  //  extract($_POST);

  echo ($ins->add_emp($_POST, $_FILES));

}

if (isset($_POST['add_emp2'])) {

  // print_r($_FILES);

  //  extract($_POST);

  echo ($ins->add_emp2($_POST));

}

if (isset($_POST['add_emp3'])) {

  echo ($ins->add_emp3($_POST));

}

if (isset($_POST['add_emp4'])) {

  // print_r($_POST);

  //  extract($_POST);

  echo ($ins->add_emp4($_POST, $_FILES));

}


if (isset($_POST['add_com'])) {

  //  print_r($_POST);

  //  extract($_POST);

  echo ($ins->add_company($_POST));

}

if (isset($_POST['add_com2'])) {

  //  print_r($_POST);

  //  extract($_POST);

  echo ($ins->add_company2($_POST));

}

if (isset($_POST['add_com3'])) {

  // print_r($_POST);

  //  extract($_POST);

  echo ($ins->add_company3($_POST));

}


if (isset($_POST['add_pro'])) {

  //  print_r($_POST);

  //  extract($_POST);

  echo ($ins->add_pro($_POST));

}

if (isset($_POST['add_pro2'])) {

  //  print_r($_POST);

  //  extract($_POST);

  echo ($ins->add_pro2($_POST, $_FILES));

}


if (isset($_POST['up_task'])) {

  //  print_r($_POST);

  //  extract($_POST);

  echo ($ins->up_task($_POST));

}

if (isset($_POST['add_quot'])) {

  echo ($ins->add_quot($_POST));

}

// add service

if (isset($_POST['add_ser'])) {

  echo ($ins->add_ser($_POST));

}
// update quotation finalise

if (isset($_GET['update'])) {


  echo ($ins->up_quot($_GET));

}
// update invoice to GST finalise

if (isset($_GET['update_gst'])) {


  echo ($ins->up_inv_gst($_GET));

}

/// add payment

if (isset($_POST['add_payment'])) {


  echo ($ins->add_pay($_POST, $_FILES));

}

/// add ledger

if (isset($_POST['add_ledger'])) {


  echo ($ins->add_ledger($_POST));

}

/// add supplier

if (isset($_POST['add_sup'])) {


  echo ($ins->add_sup($_POST));

}
/// add supplier

if (isset($_POST['add_budget'])) {


  echo ($ins->add_budget($_POST));

}
/// add expenses

if (isset($_POST['add_exp'])) {


  echo ($ins->add_exp($_POST, $_FILES));

}
/// add companyh bank details

if (isset($_POST['add_bnk'])) {


  echo ($ins->add_bnk($_POST));

}
/// add target details

if (isset($_POST['add_target'])) {


  echo ($ins->add_target($_POST));

}

/// add notes for the project

if (isset($_POST['add_notes'])) {


  echo ($ins->add_notes($_POST, $_FILES));

}
/// add schedule for the task project

if (isset($_POST['add_sc_file'])) {


  echo ($ins->add_sc_file($_POST));

}
/// add meeting for the task project

if (isset($_POST['add_meet'])) {


  echo ($ins->add_meet($_POST));

}
/// add meeting for the task project

if (isset($_POST['sal_gen'])) {


  echo ($ins->sal_gen($_POST));

}

/// add schedule for the task project //////////////demo puprose add_schedule1.php

if (isset($_POST['add_sc_file1'])) {


  echo ($ins->add_sc_file1($_POST));

}


/// add schedule for the task project

if (isset($_POST['add_manual'])) {


  echo ($ins->add_manual($_POST, $_FILES));

}

/// add leave request

if (isset($_POST['add_leave'])) {


  echo ($ins->add_leave($_POST));

}
/// add pre monthly budget

if (isset($_POST['add_pre_mon'])) {


  echo ($ins->add_pre_mon($_POST));

}


?>