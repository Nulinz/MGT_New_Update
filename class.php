<?php

include('db.php');

if (!isset($_COOKIE['emp'])) {
    header('Location:./index.php');
} else {
    $emp_log = $_COOKIE['emp'];
}


class Insert extends DB
{

    public $emp_cook = '';

    public function __construct($emp_cook)
    {
        parent::__construct(); // Calls the parent DB constructor
        $this->emp_cook = $emp_cook; // Assign the parameter to the property
    }

    public function add_cat($data)
    {

        extract($data);

        $ins_cat = "INSERT INTO `m_cat`(`cat`, `title`, `des`, `c_by`)

                        VALUES ('$category','$title','$description', '$this->emp_cook')";

        $q_cat = mysqli_query($this->con, $ins_cat);

        if ($q_cat) {

            return json_encode([
                'status' => 'success',
                'message' => '',
                'url' => 'settings.php',

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Category Not Added!',
                'url' => 'settings.php',

            ]);
        }
    }

    public function add_emp($data, $file)
    {

        $esc = $this->escape($data);
        extract($esc);

        /* ===============================
           EMAIL & MOBILE VALIDATION
           =============================== */

        // Email format
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return json_encode([
                'status' => 'error',
                'field' => 'email',
                'message' => 'Invalid email address'
            ]);
        }

        // Mobile format (India)
        if (!preg_match('/^[6-9]\d{9}$/', $contact)) {
            return json_encode([
                'status' => 'error',
                'field' => 'contact',
                'message' => 'Invalid mobile number'
            ]);
        }

        // Email duplicate check
        $checkEmail = mysqli_prepare(
            $this->con,
            "SELECT id FROM m_emp WHERE email = ?"
        );
        mysqli_stmt_bind_param($checkEmail, "s", $mail);
        mysqli_stmt_execute($checkEmail);
        mysqli_stmt_store_result($checkEmail);

        if (mysqli_stmt_num_rows($checkEmail) > 0) {
            return json_encode([
                'status' => 'error',
                'field' => 'email',
                'message' => 'Email already exists'
            ]);
        }

        // Mobile duplicate check
        $checkMobile = mysqli_prepare(
            $this->con,
            "SELECT id FROM m_emp WHERE contact = ?"
        );
        mysqli_stmt_bind_param($checkMobile, "s", $contact);
        mysqli_stmt_execute($checkMobile);
        mysqli_stmt_store_result($checkMobile);

        if (mysqli_stmt_num_rows($checkMobile) > 0) {
            return json_encode([
                'status' => 'error',
                'field' => 'contact',
                'message' => 'Mobile number already exists'
            ]);
        }

        /* ===============================
           INSERT EMPLOYEE (YOUR CODE)
           =============================== */

        $ins_emp = "INSERT INTO `m_emp`
        (`emp_code`, `pwd`, `name`, `dob`, `gender`, `marital`, `exp_mrg`,
         `email`, `contact`, `aadhar`, `qualification`, `year`,
         `fam_back`, `fin_back`, `address`, `c_by`)
        VALUES
        ('$empid','123','$fname','$dob','$gender','$marital',
         '$marriageexpdate','$mail','$contact','$aadhar','$qualification',
         '$yog','$familybg','$financebg','$adrs','$this->emp_cook')";

        $q_emp = mysqli_query($this->con, $ins_emp);

        if (!$q_emp) {
            return json_encode([
                'status' => 'failed',
                'message' => 'Employee STEP-1 Failed to add!',
                'url' => 'list_employee.php'
            ]);
        }

        $last = mysqli_insert_id($this->con);

        /* ===============================
           PROFILE IMAGE UPLOAD (YOUR CODE)
           =============================== */

        $file = $_FILES['pfimg'];

        if (!empty($file['name'])) {
            $curdate = $this->c_on();
            $f_title = $curdate . "-" . $file['name'];

            move_uploaded_file($file['tmp_name'], "./img/$f_title");

            mysqli_query(
                $this->con,
                "UPDATE `m_emp` SET `profile`='$f_title' WHERE `id`='$last'"
            );
        }

        return json_encode([
            'status' => 'success',
            'message' => 'Employee STEP-1 Added Successfully',
            'url' => 'add_emp_job.php?emp=' . $last
        ]);
    }


    public function add_emp2($data)
    {
        // Escape all POST data
        $esc = $this->escape($data);
        extract($esc);

        // Status (already escaped above)
        $status = $esc['status'];

        $ins_emp2 = "
        INSERT INTO `m_emp2`
        (
            `f_id`,
            `role`,
            `level`,
            `title`,
            `type`,
            `exp`,
            `skill`,
            `st_date`,
            `re_date`,
            `reason`,
            `lap`,
            `verify`,
            `status`,
            `c_by`
        )
        VALUES
        (
            '$f_id',
            '$role',
            '$level',
            '$jobtitle',
            '$jobtype',
            '$experience',
            '$skilledin',
            '$prefdate',
            '$relievedate',
            '$reasonleaving',
            '$ownlaptop',
            '$verification',
            '$status',
            '$this->emp_cook'
        )
    ";

        $q_emp2 = mysqli_query($this->con, $ins_emp2);

        if ($q_emp2) {
            return json_encode([
                'status' => 'success',
                'message' => 'Employee STEP-2 Added Successfully',
                'url' => 'add_emp_bank.php?emp=' . $f_id
            ]);
        } else {
            return json_encode([
                'status' => 'failed',
                'message' => 'Employee STEP-2 Failed to add!',
                'error' => mysqli_error($this->con),
                'url' => 'list_employee.php'
            ]);
        }
    }

    public function add_emp3($data)
    {


        $esc = $this->escape($data);

        extract($esc);

        $ins_emp3 = "INSERT INTO `m_emp3`( `f_id`, `b_name`, `ac_name`, `ac_no`, `ifsc`, `ac_type`, `b_branch`, `salary`, `hra`, `convey`, `medical`, `special`, `other`, `pf`, `esi`, `pro_tax`, `it`, `bonus`, `net`, `c_by`)

                                    VALUES ('$f_id','$bankname','$bankacctholder','$bankacctno','$ifsc','$accttype','$bankbranch','$basic','$hra','$conveyance','$medical','$special','$other','$pf','$esi','$ptax','$it','$pbonus','$net','$this->emp_cook')";

        $q_emp3 = mysqli_query($this->con, $ins_emp3);


        if ($q_emp3) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Employee <STEP-3></STEP-3> Added Successfully',
                'url' => 'add_emp_document.php?emp=' . $f_id,

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Employee STEP-3 Failed to add!',
                'url' => 'list_employee.php',

            ]);
        }
    }

    public function add_emp4($data, $file)
    {

        extract($data);


        // $ins_emp = "INSERT INTO `m_emp`( `emp_code`, `pwd`, `name`, `dob`, `gender`, `marital`, `exp_mrg`, `email`, `contact`, `aadhar`, `qualification`, `year`, `fam_back`, `fin_back`, `address`,  `c_by`) VALUES

        //                                 ('$empid','123','$fname','$dob','$gender','$marital','$marriageexpdate','$mail','$contact','$aadhar','$qualification','$yog','$familybg','$financebg','$adrs','$this->emp_cook')";

        // $q_emp = mysqli_query($this->con,$ins_emp);

        // $last = mysqli_insert_id($this->con);


        $file_types = ['aadhar', 'expcertify', 'slyslip', 'agreement', 'certification'];

        foreach ($file_types as $field) {
            // Check if file has been uploaded for this specific field
            if (!empty($_FILES[$field]['name'][0])) {
                $files = $_FILES[$field];  // Each file input is accessed by its name (e.g. 'aadhar', 'exp', etc.)
                $file_type = array('jpg', 'jpeg', 'png', 'pdf', 'docx');  // Allowed file extensions

                // Loop through each file
                $f_name = $files['name'];
                $f_tem = $files['tmp_name'];
                $f_size = $files['size'];
                $f_type = $files['type'];

                $f_ext = pathinfo($f_name, PATHINFO_EXTENSION);
                $f_ext1 = strtolower($f_ext);

                // Check if file type is valid and size is greater than 0
                if (in_array($f_ext1, $file_type) && $f_size > 0) {
                    // Generate a unique filename using the current date-time and a unique ID
                    $curdate = $this->c_on();  // Assuming this is a function that returns the current date/time
                    $f_title = $curdate . "-" . uniqid() . "-" . $f_name;  // Adding uniqid() to ensure uniqueness

                    // Move the file to the desired folder
                    // $upload_dir = "./img/$field/";  // Create sub-directories for each file type (e.g. 'aadhar', 'exp')
                    // if (!is_dir($upload_dir)) {
                    //     mkdir($upload_dir, 0777, true);  // Create the directory if it doesn't exist
                    // }

                    // Move the file to its destination
                    move_uploaded_file($f_tem, "./img/$f_title");

                    // You can choose to store the file name in the database if needed
                    $up_file = "INSERT INTO `m_file`( `f_id`, `cat`, `type`, `file`, `c_by`)

                                                       VALUES ('$f_id','emp','$field','$f_title','$this->emp_cook')";

                    $q_file = mysqli_query($this->con, $up_file);
                }
            }
        }


        if ($q_file) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Employee Documents Added Successfully',
                'url' => 'list_employee.php',

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Employee Documents Failed to add!',
                'url' => 'list_employee.php',

            ]);
        }
    }


    public function add_company($data)
    {


        $esc = $this->escape($data);

        extract($esc);

        // if($gender==''){

        // }



        $ins_com = "INSERT INTO `m_cmp`( `type`, `c_name`, `c_cat`, `c_type`, `b_with`, `contact`, `mail`, `address`, `dis`, `state`, `pin`, `web`, `gst`, `c_by`)

                         VALUES ('$type','$cmpnyname','$cmp_cat','$c_type','$b_with','$contact','$mail','$address','$district','$state','$pinode','$website','$gst','$this->emp_cook')";

        $q_com = mysqli_query($this->con, $ins_com);

        $last = mysqli_insert_id($this->con);


        if ($q_com) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Company Added Successfully',
                'url' => 'add_cmp_details.php?com=' . $last,

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Company Failed to add!',
                'url' => 'list_company.php',

            ]);
        }
    }

    public function add_company2($data)
    {


        // $esc = $this->escape($data);

        extract($data);

        $st_type = json_encode($type);
        $bus_type = json_encode($b_type);

        // if($gender==''){

        // }



        $ins_com2 = "INSERT INTO `m_cmp2`( `f_id`, `store`, `b_acc`, `soft`, `soft_name`,`turn_over`, `emp_no`, `cus_rate`, `remarks`, `mgt_emp`, `c_by`)

                            VALUES ('$f_id','$st_type','$bus_type','$soft','$soft_name','$turnover','$noemp','$customerrating','$remarks','$mgt_emp','$this->emp_cook')";

        $q_com2 = mysqli_query($this->con, $ins_com2);



        if ($q_com2) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Company  STEP-2 Added Successfully',
                'url' => 'add_cmp_contact_person.php?com=' . $f_id

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Company Failed to add!',
                'url' => 'list_company.php'


            ]);
        }
    }
    public function add_company3($data)
    {


        $esc = $this->escape($data);

        extract($esc);


        $ins_com3 = "INSERT INTO `m_cmp3`( `f_id`, `con_name`, `con_role`, `con_num`, `con_email`, `c_by`)

                        VALUES ('$f_id','$con_name','$con_role','$con_contact','$con_mail','$this->emp_cook')";

        $q_com3 = mysqli_query($this->con, $ins_com3);



        if ($q_com3) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Company  STEP-3 Added Successfully',
                'url' => 'list_company.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Company Failed to add!',
                'url' => 'list_company.php'


            ]);
        }
    }


    public function add_pro($data)
    {


        //  $esc = $this->escape($data);



        extract($data);

        $tech_arr = json_encode($technology);
        $agree_arr = json_encode($agree);
        $plat_arr = json_encode($plat);


        $ins_pro = "INSERT INTO `m_pro`( `c_id`, `title`, `lead`, `service`, `e_com`, `no_user`, `roles`, `purpose`, `pro_val`, `tech`, `st_date`, `re_date`, `pay_term`, `agree`, `plat_form`, `need_soft`, `current`, `assign`, `cat`, `sub_cat`, `pay_gate`,`c_by`)

                                    VALUES ('$com_id','$prjttitle','$lead','$service','$ecom','$peopleno','$roles','$purpose','$prjtvalue','$tech_arr','$estdate','$reqdate','$payterms','$agree_arr','$plat_arr','$needsw','$issues','$assignto','$category','$subcategory','$pay_gate','$this->emp_cook')";

        $q_pro = mysqli_query($this->con, $ins_pro);

        $last = mysqli_insert_id($this->con);

        $ins_tk = "INSERT INTO `m_task`( `pro_id`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `des`, `c_by`)

                                   VALUES ('$last','$category','$subcategory','$assignto','$this->c_date','$this->c_time','$this->c_date','nil','$this->emp_cook')";


        $q_tk = mysqli_query($this->con, $ins_tk);



        if ($q_pro && $q_tk) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Project Added Successfully',
                'url' => 'add_prjt_document.php?pro=' . $last

            ]);
        } else {

            return json_encode([
                'status' => 'Failed',
                'message' => 'Project Failed to add!',
                'url' => 'list_project.php'
            ]);
        }
    }


    public function up_task($data)
    {


        $esc = $this->escape($data);

        extract($esc);

        $up_tk = "UPDATE `m_task` SET `status`='close' where `id`='$task_id'";
        $q_up = mysqli_query($this->con, $up_tk);

        $up_pro = "UPDATE `m_pro` SET `cat`='$cat',`sub_cat`='$sub_cat' where `id`='$pro_id'";
        $q_pro = mysqli_query($this->con, $up_pro);

        if ($cat != 'Drop') {


            $ins_tk = "INSERT INTO `m_task`( `pro_id`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `des`, `c_by`)

        VALUES ('$pro_id','$cat','$sub_cat','$assignto','$st_date','$time','$end_date','$des','$this->emp_cook')";


            $q_tk = mysqli_query($this->con, $ins_tk);

        } else {
            $ins_tk = "INSERT INTO `m_task`( `pro_id`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `des`, `status`,`c_by`)

                VALUES ('$pro_id','$cat','$sub_cat','$assignto','$st_date','$time','$end_date','$des','close','$this->emp_cook')";


            $q_tk = mysqli_query($this->con, $ins_tk);

        }



        if ($q_up && $q_tk) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Task Updated Successfully',
                'url' => 'list_task.php?type=progress'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Task Failed to Update!!!',
                'url' => 'list_task.php?type=progress'


            ]);
        }
    }

    public function add_pro2($data, $file)
    {


        $esc = $this->escape($data);

        extract($esc);

        // if($gender==''){

        // }

        $file = $_FILES['pro_file'];

        if (!empty($file['name'])) {
            $f_name = $file['name'];
            $f_tem = $file['tmp_name'];
            $f_size = $file['size'];
            $f_type = $file['type'];

            $f_ext = pathinfo($f_name, PATHINFO_EXTENSION);
            $f_ext1 = strtolower($f_ext[1]);

            $file_type = array('jpg', 'jpeg', 'png');

            // if ((in_array($f_ext1, $file_type))&& ($f_size>0)) {

            $curdate = $this->c_on();

            $f_title = $curdate . "-" . $f_name;


            move_uploaded_file($f_tem, "./img/$f_title");



            $ins_file = "INSERT INTO `m_file`( `f_id`, `cat`, `type`, `title`, `file`,  `c_by`)

                            VALUES ('$pro_id','PROJECT','$doctype','$title','$f_title','$this->emp_cook')";

            $q_file = mysqli_query($this->con, $ins_file);

            // }

        }


        if ($q_file) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Project Document Added Successfully',
                'url' => 'list_project.php?type=progress',

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Project Document Failed to add!',
                'url' => 'list_project.php?type=progress',

            ]);
        }
    }

    public function add_sub_cat($data)
    {


        $esc = $this->escape($data);

        extract($esc);



        $ins_sub = "INSERT INTO `m_sub_task`( `task`, `sub`, `c_by`)

            VALUES ('$task_cat','$sub_cat','$this->emp_cook')";


        $q_sub = mysqli_query($this->con, $ins_sub);



        if ($q_sub) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Sub Category Added Successfully',
                'url' => 'settings.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Sub Category Failed to Update!!!',
                'url' => 'settings.php'


            ]);
        }
    }


    public function add_quot($data)
    {


        //  $esc = $this->escape($data);

        extract($data);

        if ($type == "quot") {
            $tbl = 'm_quot';
            $v = 'Quotation';

            $ins_quot = "INSERT INTO `$tbl`( `f_id`, `date`, `remark`, `c_by`)

                         VALUES ('$pro_id','$date','$remarks','$this->emp_cook')";

        } else {
            $tbl = 'm_inv';
            $v = 'Invoice';

            $ins_quot = "INSERT INTO `$tbl`( `f_id`, `q_id`,`date`, `gst_type`, `remark`, `c_by`)

        VALUES ('$pro_id','$quot_new','$date','$gst_type','$remarks','$this->emp_cook')";
        }



        $q_quot = mysqli_query($this->con, $ins_quot);

        $last_id = mysqli_insert_id($this->con);


        $products_js = json_decode($products, true);


        // $count_item = count($products);

        $cost_sum = [];
        foreach ($products_js as $item) {
            // Assuming each item is an array like ["5", "new", "10", "25"]
            $ser = $item[0];
            $des = $item[1];
            $qty = $item[2];
            $cost = $item[3];

            $ins_quot1 = "INSERT INTO `e_quot`( `f_id`, `cat`, `ser`, `des`, `qty`, `cost`, `c_by`)


                                 VALUES ('$last_id','$type','$ser','$des','$qty','$cost','$this->emp_cook')";

            $q_quot1 = mysqli_query($this->con, $ins_quot1);

            $s_ser = "SELECT * from `m_service` where `id`='$ser'";
            $q_ser = mysqli_query($this->con, $s_ser);
            $d_ser = mysqli_fetch_assoc($q_ser);

            $gst_per = ($d_ser['gst'] / 100) + 1;

            if ($gst_type == "With") {

                $cost_sum[] = ($cost * $gst_per) * $qty;

            } else {
                $cost_sum[] = $cost;
            }

        }

        $ttl_amt = array_sum($cost_sum);

        if ($type != "quot") {



            $ins_bnk = "INSERT INTO `e_bank`( `bank_prime`,`type`, `f_id`, `amount`, `c_by`)

                                    VALUES ('$quot_bank','inv','$last_id','$ttl_amt','$this->emp_cook')";

            $q_bnk = mysqli_query($this->con, $ins_bnk);
        }


        if ($q_quot && $q_quot1) {

            return json_encode([
                'status' => 'Success',
                'message' => $v . ' Added Successfully',
                'url' => 'view_project.php?pro=' . $pro_id

            ]);
        } else {

            return json_encode([
                'status' => 'Failed',
                'message' => $v . ' Failed to add!',
                'url' => 'view_project.php?pro=' . $pro_id,
                "data" => $products_js
            ]);
        }
    }



    public function add_ser($data)
    {


        $esc = $this->escape($data);

        extract($esc);



        $ins_sub = "INSERT INTO `m_service`( `ser_name`, `hsn`, `gst`, `c_by`)


            VALUES ('$ser_type','$hsn','$gst','$this->emp_cook')";


        $q_sub = mysqli_query($this->con, $ins_sub);



        if ($q_sub) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Service Category Added Successfully',
                'url' => 'settings.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Service Category Failed to Update!!!',
                'url' => 'settings.php'


            ]);
        }
    }

    public function up_quot($data)
    {


        $esc = $this->escape($data);

        extract($esc);

        $cr_dt = date('Y-m-d');

        $up_quot = "UPDATE `m_quot` SET `status`='final', `status_con`='$cr_dt' where `id`='$update'";

        $q_quot = mysqli_query($this->con, $up_quot);

        $s_prime = "SELECT * from `m_task` where `pro_id`='$pro_ind' order by `id` DESC";
        $q_prime = mysqli_query($this->con, $s_prime);
        $d_prime = mysqli_fetch_assoc($q_prime);

        $task_id = $d_prime['id'];

        $up_tk = "UPDATE `m_task` SET `status`='close' where `id`='$task_id'";
        $q_up = mysqli_query($this->con, $up_tk);

        $up_pro = "UPDATE `m_pro` SET `cat`='Plan',`sub_cat`='Planning' where `id`='$pro_ind'";
        $q_pro = mysqli_query($this->con, $up_pro);

        $st_dt = date("Y-m-d");
        $st_time = date('H:i:s');

        $insert_tk = "INSERT INTO `m_task`( `pro_id`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `des`,`c_by`)

                                   VALUES ('$pro_ind','Plan','Planning','4','$st_dt','$st_time','$st_dt','Plannig','$this->emp_cook')";


        $query_tk = mysqli_query($this->con, $insert_tk);

        // $up_task =


        if ($q_quot && $query_tk && $up_tk && $q_pro) {

            header("Location:./view_project.php?pro=$pro_ind");

            //    return json_encode([
            //        'status' => 'Success',
            //        'message' => 'Quotation updated Successfully',
            //         'url' => 'view_project.php?pro='.$pro_ind

            //    ]);
        } else {

            // header("Location:./view_project.php?pro=$pro_ind");


            //    return json_encode([
            //        'status' => 'failed',
            //        'message' => 'Quotation Failed to Update!!!',
            //         'url' => 'view_project.php?pro='.$pro_ind


            //    ]);
        }
    }

    public function up_inv_gst($data)
    {


        $esc = $this->escape($data);

        extract($esc);



        $up_inv_gst = "UPDATE `m_inv` SET `gst`='gst' where `id`='$update_gst'";

        $q_inv_gst = mysqli_query($this->con, $up_inv_gst);



        if ($q_inv_gst) {

            header("Location:./view_project.php?pro=$pro_ind");

        } else {

            header("Location:./view_project.php?pro=$pro_ind");

        }
    }


    // add thee payment

    public function add_pay($data, $file)
    {


        $esc = $this->escape($data);

        extract($esc);

        $file = $_FILES['pay_file'];

        if (!empty($file['name'])) {
            $f_name = $file['name'];
            $f_tem = $file['tmp_name'];
            $f_size = $file['size'];
            $f_type = $file['type'];

            $f_ext = pathinfo($f_name, PATHINFO_EXTENSION);
            $f_ext1 = strtolower($f_ext[1]);

            $file_type = array('jpg', 'jpeg', 'png');

            // if ((in_array($f_ext1, $file_type))&& ($f_size>0)) {

            $curdate = $this->c_on();

            $f_title = $curdate . "-" . $f_name;


            move_uploaded_file($f_tem, "./img/$f_title");

        }



        $ins_pay = "INSERT INTO `m_payment`( `q_no`, `amt`, `remark`, `file`, `c_by`)

                             VALUES ('$quot_new','$amount','$remark','$f_title','$this->emp_cook')";


        $q_pay = mysqli_query($this->con, $ins_pay);



        if ($q_pay) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Payment Added Successfully',
                'url' => 'view_project.php?pro=' . $pro_id

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Payment Failed to Update!!!',
                'url' => 'view_project.php?pro=' . $pro_id


            ]);
        }
    }



    public function add_ledger($data)
    {


        $esc = $this->escape($data);

        extract($esc);



        $ins_led = "INSERT INTO `m_ledger`( `name`, `type`, `c_by`)


                     VALUES ('$l_name','$l_type','$this->emp_cook')";


        $q_led = mysqli_query($this->con, $ins_led);



        if ($q_led) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Ledger Added Successfully',
                'url' => 'list_ledger.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Ledger Failed to Update!!!',
                'url' => 'list_ledger.php'


            ]);
        }
    }


    public function add_sup($data)
    {


        $esc = $this->escape($data);

        extract($esc);



        $ins_supplier = "INSERT INTO `m_supplier`( `name`, `b_name`, `ac_no`, `ac_name`, `ifsc`, `b_branch`, `gst`, `contact`, `ad`, `dis`, `state`, `pin`,  `c_by`)



                                   VALUES ('$s_name','$s_bank','$s_ac','$s_bname','$ifsc','$s_branch','$gst','$contact','$add','$dis','$state','$pin','$this->emp_cook')";


        $q_supplier = mysqli_query($this->con, $ins_supplier);



        if ($q_supplier) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Supplier Added Successfully',
                'url' => 'list_supplier.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Supplier Failed to Update!!!',
                'url' => 'list_supplier.php'


            ]);
        }
    }



    public function add_budget($data)
    {


        // $esc = $this->escape($data);

        extract($data);


        for ($i = 0; $i < count($check); $i++) {


            $ins_bud = "INSERT INTO `m_budget`( `mon`, `led_id`, `amt`, `c_by`)


                                    VALUES ('$mon','{$check[$i]}','{$bud[$i]}','$this->emp_cook')";


            $q_bud = mysqli_query($this->con, $ins_bud);

        }



        if ($q_bud) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Monthly Budget Added Successfully',
                'url' => 'add_monthly_budget.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Monthly Budget Failed to Update!!!',
                'url' => 'add_monthly_budget.php'


            ]);
        }
    }

    public function add_exp($data, $file)
    {


        $esc = $this->escape($data);

        extract($esc);


        $c_on_time = date("h:i:s");
        $con_cat = $c_on . " " . $c_on_time;


        $file = $_FILES['exp_file'];

        if (!empty($file['name'])) {

            $a = 'hello';

            $f_name = $file['name'];
            $f_tem = $file['tmp_name'];
            $f_size = $file['size'];
            $f_type = $file['type'];

            $f_ext = pathinfo($f_name, PATHINFO_EXTENSION);

            $f_ext1 = strtolower($f_ext[1]);

            $file_type = array('jpg', 'jpeg', 'png');

            // if ((in_array($f_ext1, $file_type))&& ($f_size>0)) {

            $curdate = $this->c_on();

            $f_title = $curdate . "-" . $f_name;



            move_uploaded_file($f_tem, "./img/$f_title");

            $ins_exp = "INSERT INTO `m_exp`( `sup_id`, `led_id`, `w_name`, `type`,`gst_type`, `per_amt`, `gst_amt`, `amt`, `trans_type`,`remarks`, `file`,`c_on`,`c_by`)


                                       VALUES ('$suppname','$ledgername','$w_order','$exptype','$gst_type','$per_amt','$gst_amt','$amount','$trans_bank','$remarks','$f_title','$con_cat','$this->emp_cook')";

            $q_exp = mysqli_query($this->con, $ins_exp);

            // }

        } else {

            $ins_exp = "INSERT INTO `m_exp`( `sup_id`, `led_id`, `w_name`, `type`,`gst_type`, `per_amt`, `gst_amt`, `amt`, `trans_type`,`remarks`, `file`, `c_on`,`c_by`)


                VALUES ('$suppname','$ledgername','$w_order','$exptype','$gst_type','$per_amt','$gst_amt','$amount','$trans_bank','$remarks','nil','$con_cat','$this->emp_cook')";

            $q_exp = mysqli_query($this->con, $ins_exp);

        }

        $last_id = mysqli_insert_id($this->con);

        if ($trans_bank != 0) {
            if ($gst_type == "With") {
                $ttl_amt = $per_amt + $gst_amt;
            } else {
                $ttl_amt = $per_amt;
            }
            $ins_bnk = "INSERT INTO `e_bank`( `bank_prime`,`type`, `f_id`, `amount`, `c_by`)

                                    VALUES ('$trans_bank','exp','$last_id','$ttl_amt','$this->emp_cook')";

            $q_bnk = mysqli_query($this->con, $ins_bnk);
        }


        if ($q_exp) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Expenses Added Successfully',
                'url' => 'list_expense.php',

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Expenses Failed to add!',
                'url' => 'list_expense.php',


            ]);
        }
    }


    public function add_bnk($data)
    {


        $esc = $this->escape($data);

        extract($esc);



        $ins_bnk = "INSERT INTO `m_bank`( `b_name`, `ac_no`, `ac_name`, `ifsc`, `branch`, `balance`, `c_by`)

                                    VALUES ('$s_bank','$s_ac','$s_bname','$ifsc','$s_branch','$open','$this->emp_cook')";


        $q_bnk = mysqli_query($this->con, $ins_bnk);



        if ($q_bnk) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Bank Details Added Successfully',
                'url' => 'list_acct_bank.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Bank Details Failed to Update!!!',
                'url' => 'list_acct_bank.php'


            ]);
        }
    }


    public function add_target($data)
    {


        // $esc = $this->escape($data);

        extract($data);


        for ($i = 0; $i < count($check); $i++) {


            $ins_tar = "INSERT INTO `m_target`( `mon`, `year`, `emp`, `amt`, `c_by`)


                              VALUES ('$mon','$year','{$check[$i]}','{$tar[$i]}','$this->emp_cook')";


            $q_tar = mysqli_query($this->con, $ins_tar);

        }



        if ($q_tar) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Monthly Target Added Successfully',
                'url' => 'add_target.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Monthly Target Failed to Update!!!',
                'url' => 'add_target.php'
            ]);
        }
    }

    public function add_notes($data, $file)
    {


        $esc = $this->escape($data);

        extract($esc);

        // if($gender==''){

        // }

        $file = $_FILES['note_file'];

        $f_title = '';

        if (!empty($file['name'])) {
            $f_name = $file['name'];
            $f_tem = $file['tmp_name'];
            $f_size = $file['size'];
            $f_type = $file['type'];

            $f_ext = pathinfo($f_name, PATHINFO_EXTENSION);
            $f_ext1 = strtolower($f_ext[1]);

            $file_type = array('jpg', 'jpeg', 'png');

            // if ((in_array($f_ext1, $file_type))&& ($f_size>0)) {

            $curdate = $this->c_on();

            $f_title = $curdate . "-" . $f_name;


            move_uploaded_file($f_tem, "./img/$f_title");



            // $ins_notes = "INSERT INTO `m_notes`( `f_id`, `title`, `des`, `link`, `file`, `c_by`)

            //                         VALUES ('$pro_id','$title','$desp','$links','$f_title','$this->emp_cook')";

            //  $q_notes = mysqli_query($this->con,$ins_notes);

            // }

        }

        $ins_notes = "INSERT INTO `m_notes`( `f_id`, `title`, `des`, `link`, `file`, `c_by`)

                        VALUES ('$pro_id','$title','$desp','$links','$f_title','$this->emp_cook')";

        $q_notes = mysqli_query($this->con, $ins_notes);



        if ($q_notes) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Project Notes Added Successfully',
                'url' => 'view_project.php?pro=' . $pro_id,

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Project Notes Failed to add!',
                'url' => 'view_project.php?pro=' . $pro_id,

            ]);
        }
    }

    public function add_sc_file($data)
    {


        // $esc = $this->escape($data);

        // $data_ch = json_decode($data, true);

        $file_ar = [];

        // extract($esc);

        $pro_id = $data['pro_id'];



        // $removed = array_splice($data, -2);

        $s_seq = "SELECT * from `m_pro_task` where `pro_id`='$pro_id' and `seq`='1'";
        $q_seq = mysqli_query($this->con, $s_seq);
        $d_seq = mysqli_num_rows($q_seq);

        if ($d_seq == 0) {
            $seq = 1;
        } else {

            $s_seq1 = "SELECT * from `m_pro_task` where `pro_id`='$pro_id' and `type`='loop' order by `seq` DESC";
            $q_seq1 = mysqli_query($this->con, $s_seq1);
            $d_seq1 = mysqli_fetch_assoc($q_seq1);

            $seq = $d_seq1['seq'] + 1;
        }

        foreach ($data as $dt) {

            $data1 = json_decode($dt, true);

            //  echo "<pre>";
            //  print_r($data1);



            // $file_base = $data1[7];

            // if (empty($file_base)) {

            //     if (preg_match('/^data:image\/(\w+);base64,/',$file_base,$matches)) {

            //         $fileType = $matches[1];

            //         // Remove the "data:image/png;base64," part
            //         $data_de = substr($file_base, strpos($file_base, ",") + 1);

            //         $decoded_data = base64_decode($data_de);

            //         $uploadDir = './img/';

            //         $fileName = 'image_' . uniqid(date("Y-m-d_H_i_s_")) . '.' . $fileType;


            //         // Define the file path
            //         $filePath = $uploadDir . $fileName;
            //         // Save the decoded data to the file
            //         // $save = file_put_contents($filePath, $decoded_data);

            //         $file_ar[] = $fileName;


            //         $ins_tk = "INSERT INTO `m_task`( `pro_id`,`seq`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `des`, `c_by`)

            //                         VALUES ('$pro_id','$seq','{$data1[1]}','{$data1[2]}','{$data1[0]}','{$data1[3]}','{$data1[5]}','{$data1[4]}','{$data1[6]}','$this->emp_cook')";


            //         $q_tk = mysqli_query($this->con,$ins_tk);

            //         $last = mysqli_insert_id($this->con);


            //         $ins_file = "INSERT INTO `m_file`( `f_id`, `cat`,`type`, `file`,  `c_by`)

            //                                     VALUES ('$last','TASK','SCHEDULE','$fileName','$this->emp_cook')";

            //     $q_file = mysqli_query($this->con,$ins_file);



            //     } // preg match if;


            // }

            //     else{

            $emp_id = $data1[0] ?? 0;

            if ($emp_id == 0) {
                continue;
            }

            $ins_tk = "INSERT INTO `m_pro_task`( `pro_id`, `seq`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `title`, `des`, `prior`, `status`,`c_by`)


                             VALUES ('$pro_id','$seq','{$data1[1]}','{$data1[2]}','{$data1[0]}','{$data1[3]}','{$data1[5]}','{$data1[4]}','{$data1[6]}','{$data1[7]}','{$data1[8]}','schedule','$this->emp_cook')";


            $q_tk = mysqli_query($this->con, $ins_tk);

            // }

            $seq++;

        } //foreach  loop end....

        // print_r($file_ar);


        if ($q_tk) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Task Schedule Added Successfully',
                'url' => 'dashboard_hrm.php?type=Plan',

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Task Schedule Failed to add!',
                'url' => 'dashboard_hrm.php?type=Plan',

            ]);
        }
    }

    public function add_meet($data)
    {


        // $esc = $this->escape($data);

        extract($data);

        $emp_inv_arr = json_encode($emp_inv, true);

        if ($type == 'online') {
            $link = $meetlink;
        } else {
            $link = $location;
        }



        $ins_meet = "INSERT INTO `m_meeting`( `f_id`, `m_type`, `date`, `time`, `des`, `loc`, `emp`, `client`,`c_by`)

                              VALUES ('$pro','$type','$m_date','$m_time','$m_des','$link','$emp_inv_arr','$client_team','$this->emp_cook')";


        $q_meet = mysqli_query($this->con, $ins_meet);



        if ($q_meet) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Meeting Details Added Successfully',
                'url' => 'view_project.php?pro=' . $pro,

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Meeting Details Failed to Update!!!',
                'url' => 'view_project.php?pro=' . $pro,


            ]);
        }
    }

    public function sal_gen($data)
    {


        //  $esc = $this->escape($data);

        extract($data);

        $mon_arr = explode('-', $mon); // This will result in an array.



        $ar = count($emp);

        for ($x = 0; $x < ($ar); $x++) {

            $ins_sal = "INSERT INTO `e_salary`( `mon`, `year`, `emp`, `lop`, `per`, `inc`, `additional`, `total`, `c_by`)

                                     VALUES ('$mon_arr[1]','$mon_arr[0]','$emp[$x]','$lop[$x]','$per[$x]','$inc[$x]','$add[$x]','$total[$x]','$this->emp_cook')";

            $q_ins = mysqli_query($this->con, $ins_sal);


        }






        if ($q_ins) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Salary Details Added Successfully',
                'url' => 'list_salary_generate.php',

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Salary Details Failed to Update!!!',
                'url' => 'list_salary_generate.php',


            ]);
        }
    }


    public function add_sc_file1($data)
    {


        // $esc = $this->escape($data);

        // $data_ch = json_decode($data, true);

        $file_ar = [];

        // extract($esc);

        $pro_id = $data['pro_id'];



        // $removed = array_splice($data, -2);

        $seq = 1;

        foreach ($data as $dt) {

            $data1 = json_decode($dt, true);

            //  echo "<pre>";
            //  print_r($data1);
            //  echo "</pre>";


            $file_base = $data1[9];

            if (empty($file_base)) {

                if (preg_match('/^data:image\/(\w+);base64,/', $file_base, $matches)) {

                    $fileType = $matches[1];

                    // Remove the "data:image/png;base64," part
                    $data_de = substr($file_base, strpos($file_base, ",") + 1);

                    $decoded_data = base64_decode($data_de);

                    $uploadDir = './img/';

                    $fileName = 'image_' . uniqid(date("Y-m-d_H_i_s_")) . '.' . $fileType;


                    // Define the file path
                    $filePath = $uploadDir . $fileName;
                    // Save the decoded data to the file
                    // $save = file_put_contents($filePath, $decoded_data);

                    $file_ar[] = $fileName;


                    $ins_tk = "INSERT INTO `m_pro_task`( `pro_id`, `seq`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `title`, `des`, `prior`, `status`,`c_by`)


                             VALUES ('$pro_id','$seq','{$data1[1]}','{$data1[2]}','{$data1[0]}','{$data1[3]}','{$data1[5]}','{$data1[4]}','{$data1[6]}','{$data1[7]}','{$data1[8]}','schedule','$this->emp_cook')";


                    $q_tk = mysqli_query($this->con, $ins_tk);

                    $last = mysqli_insert_id($this->con);


                    $ins_file = "INSERT INTO `m_file`( `f_id`, `cat`,`type`, `file`,  `c_by`)

                                                VALUES ('$last','PRO_TASK','SCHEDULE','$fileName','$this->emp_cook')";

                    $q_file = mysqli_query($this->con, $ins_file);

                    $file_base = '';

                } // preg match if;


            }

            // else{

            //     $emp_id = $data1[0] ?? 0;

            //     if($emp_id==0){
            //         continue;
            //     }

            //     $ins_tk = "INSERT INTO `m_pro_task`( `pro_id`, `seq`, `task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `title`, `des`, `prior`, `status`,`c_by`)


            //              VALUES ('$pro_id','$seq','{$data1[1]}','{$data1[2]}','{$data1[0]}','{$data1[3]}','{$data1[5]}','{$data1[4]}','{$data1[6]}','{$data1[7]}','{$data1[8]}','schedule','$this->emp_cook')";


            //     $q_tk = mysqli_query($this->con,$ins_tk);

            // }

            $seq++;

        } //foreach  loop end....

        // print_r($file_ar);


        // if($q_tk){

        return json_encode([
            'status' => 'Success',
            'message' => 'Task Schedule Added Successfully',
            'url' => 'dashboard_hrm.php?type=Plan',

        ]);
        //     }else{

        //         return json_encode([
        //             'status' => 'failed',
        //             'message' => 'Task Schedule Failed to add!',
        //             'url' => 'dashboard_hrm.php?type=Plan',

        //         ]);
        //   }
    }


    public function add_manual($data, $file)
    {


        $esc = $this->escape($data);

        extract($esc);

        $link = DB::link();

        $s_role = "SELECT * from `m_emp2` where `f_id`='{$this->emp_cook}' and `role` LIKE '%Business Development Associate L-1' ";
        $q_role = mysqli_query($link, $s_role);
        $d_role = mysqli_num_rows($q_role);

        if ($d_role == 0) {

            $url = 'emp_my_dashboard.php';


            $ins_tk = "INSERT INTO `m_pro_task`( `pro_id`, `type`,`task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `title`, `des`, `status`,`c_by`)


                                   VALUES ('$project','Manual','$cat','$sub_cat','$assignto','$startdate','$s_time','$enddate','$title','$desc','initial','$this->emp_cook')";

        } else {

            $url = 'bda_my_dashboard.php';

            $ins_tk = "INSERT INTO `m_task`( `pro_id`, `type`,`task`, `sub`, `task_for`, `st_date`, `st_time`, `end_date`, `des`, `status`,`c_by`)


            VALUES ('$project','Manual','$cat','$sub_cat','$assignto','$startdate','$s_time','$enddate','$desc','open','$this->emp_cook')";




        }


        $q_tk = mysqli_query($this->con, $ins_tk);

        $last = mysqli_insert_id($this->con);




        $file = $_FILES['man_file'];

        if (!empty($file['name'])) {
            $f_name = $file['name'];
            $f_tem = $file['tmp_name'];
            $f_size = $file['size'];
            $f_type = $file['type'];

            $f_ext = pathinfo($f_name, PATHINFO_EXTENSION);
            $f_ext1 = strtolower($f_ext[1]);

            $file_type = array('jpg', 'jpeg', 'png');

            // if ((in_array($f_ext1, $file_type))&& ($f_size>0)) {

            $curdate = $this->c_on();

            $f_title = $curdate . "-" . $f_name;


            move_uploaded_file($f_tem, "./img/$f_title");



            $ins_file = "INSERT INTO `m_file`( `f_id`, `cat`,`type`, `file`,  `c_by`)

                   VALUES ('$last','PRO_TASK','MANUAL','$f_title','$this->emp_cook')";

            $q_file = mysqli_query($this->con, $ins_file);

            // }

        }


        if ($q_tk) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Manual Task Added Successfully',
                'url' => $url

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Manual Task Failed to add!',
                'url' => $url

            ]);
        }
    }


    //add the leave

    public function add_leave($data)
    {


        $esc = $this->escape($data);

        extract($esc);

        if ($reqtype != 'Permission') {
            $permission = 0;
        }

        $ins_lev = "INSERT INTO `e_leave`( `s_date`, `e_date`, `type`, `hrs`, `reason`,  `c_by`)

                                VALUES ('$startdate','$enddate','$reqtype','$permission','$reason','$this->emp_cook')";


        $q_led = mysqli_query($this->con, $ins_lev);



        if ($q_led) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Leave Added Successfully',
                'url' => 'list_leave_request.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Leave Failed to Update!!!',
                'url' => 'list_leave_request.php'


            ]);
        }
    }


    public function add_pre_mon($data)
    {


        //  $esc = $this->escape($data);

        extract($data);


        $products_js = json_decode($products, true);



        foreach ($products_js as $item) {
            // Assuming each item is an array like ["5", "new", "10", "25"]
            $type = $item[0];
            $amt = $item[1];

            $ins_mon = "INSERT INTO `m_pre_bud`(`mon`, `type`, `amt`,  `c_by`)

                                VALUES ('$mon','$type','$amt','$this->emp_cook')";

            $q_mon = mysqli_query($this->con, $ins_mon);



        }


        if ($q_mon) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Budget Added Successfully',
                'url' => 'list_pre_mon.php'

            ]);
        } else {

            return json_encode([
                'status' => 'Failed',
                'message' => 'Budget Failed to Add',
                'url' => 'list_pre_mon.php'
            ]);
        }
    }
}


$ins = new Insert($emp_log);

// $ins->emp_cook=$emp;


?>