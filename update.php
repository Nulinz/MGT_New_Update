<?php

include('db.php');

if (!isset($_COOKIE['emp'])) {
    header('Location:./index.php');
} else {
    $emp_log = $_COOKIE['emp'];
}



class Update extends DB
{

    public $emp_cook = '';

    public function __construct($emp_cook)
    {
        parent::__construct(); // Calls the parent DB constructor
        $this->emp_cook = $emp_cook; // Assign the parameter to the property
    }

    public function up_project($data)
    {

        // $esc = $this->escape($data);

        extract($data);

        $tech_arr = json_encode($technology);
        $agree_arr = json_encode($agree);
        $plat_arr = json_encode($plat);

        $up_pro = "UPDATE `m_pro` SET `title`='$prjttitle',`lead`='$lead',`service`='$service',`e_com`='$ecom',`no_user`='$peopleno',`roles`='$roles',`purpose`='$purpose',`pro_val`='$prjtvalue',`tech`='$tech_arr',`st_date`='$estdate',`re_date`='$reqdate',`pay_term`='$payterms',`agree`='$agree_arr',

                    `plat_form`='$plat_arr',`need_soft`='$needsw',`current`='$issues',`assign`='$assignto',`cat`='$category',`sub_cat`='$subcategory',`pay_gate`='$pay_gate' WHERE `id`='$pro_id'";

        $q_pro = mysqli_query($this->con, $up_pro);

        if ($q_pro) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Project Updated Successfully',
                'url' => 'view_project.php?pro=' . $pro_id

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Project Failed to Update!!!',
                'url' => 'view_project.php?pro=' . $pro_id


            ]);
        }

    }


    public function up_company($data)
    {

        $esc = $this->escape($data);

        extract($esc);



        $up_comp = "UPDATE `m_cmp` SET `type`='$type',`c_name`='$cmpnyname',`c_cat`='$cmp_cat',`c_type`='$c_type',`b_with`='$b_with',`contact`='$contact',`mail`='$mail',

                        `address`='$address',`dis`='$district',`state`='$state',`pin`='$pinode',`web`='$website',`gst`='$gst' WHERE `id`='$com_id'";

        $q_comp = mysqli_query($this->con, $up_comp);

        if ($q_comp) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Company Details Updated Successfully',
                'url' => 'view_company.php?com=' . $com_id

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Company Details Failed to Update!!!',
                'url' => 'view_company.php?com=' . $com_id


            ]);
        }

    }


    public function up_com2($data)
    {

        extract($data);

        $type_arr = json_encode($type);
        $b_arr = json_encode($b_type);


        $up_comp2 = "UPDATE `m_cmp2` SET `store`='$type_arr',`b_acc`='$b_arr',`soft`='$soft',`soft_name`='$soft_name',`turn_over`='$turnover',`emp_no`='$noemp',

                    `cus_rate`='$customerrating',`remarks`='$remarks'  WHERE `f_id`='$com_id'";

        $q_comp2 = mysqli_query($this->con, $up_comp2);

        if ($q_comp2) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Company Details Updated Successfully',
                'url' => 'view_company.php?com=' . $com_id

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Company Details Failed to Update!!!',
                'url' => 'view_company.php?com=' . $com_id


            ]);
        }

    }

    public function up_com3($data)
    {

        extract($data);


        $up_comp3 = "UPDATE `m_cmp3` SET `con_name`='$con_name',`con_role`='$con_role',

                    `con_num`='$con_contact',`con_email`='$con_mail'  WHERE `f_id`='$com_id'";

        $q_comp3 = mysqli_query($this->con, $up_comp3);

        if ($q_comp3) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Company Contacts Updated Successfully',
                'url' => 'view_company.php?com=' . $com_id

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Company Contacts Failed to Update!!!',
                'url' => 'view_company.php?com=' . $com_id


            ]);
        }

    }


    public function up_emp1($data, $file)
    {

        $esc = $this->escape($data);

        extract($esc);

        $file = $_FILES['pfimg']['name'];

        if ($file !== "") {

            $curdate = $this->c_on();

            $f_tem = $_FILES['pfimg']['tmp_name'];

            $f_title = $curdate . "-" . $file;
            move_uploaded_file($f_tem, "./img/$f_title");

            $up_emp1 = "UPDATE `m_emp` SET `name`='$fname',`dob`='$dob',`gender`='$gender',`marital`='$marital',`exp_mrg`='$marriageexpdate',`email`='$mail',`contact`='$contact',`aadhar`='$aadhar',`qualification`='$qualification',

                    `year`='$yog',`fam_back`='$familybg',`fin_back`='$financebg',`address`='$adrs',`profile`='$f_title' WHERE `id`='$emp_edit'";

            $q_emp1 = mysqli_query($this->con, $up_emp1);

        } else {

            $up_emp1 = "UPDATE `m_emp` SET `name`='$fname',`dob`='$dob',`gender`='$gender',`marital`='$marital',`exp_mrg`='$marriageexpdate',`email`='$mail',`contact`='$contact',`aadhar`='$aadhar',`qualification`='$qualification',

                    `year`='$yog',`fam_back`='$familybg',`fin_back`='$financebg',`address`='$adrs' WHERE `id`='$emp_edit'";

            $q_emp1 = mysqli_query($this->con, $up_emp1);

        }




        if ($q_emp1) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Company Contacts Updated Successfully',
                'url' => 'view_employee.php?emp=' . $emp_edit

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Company Contacts Failed to Update!!!',
                'url' => 'view_employee.php?emp=' . $emp_edit,



            ]);
        }

    }


    public function up_emp2($data)
    {
        $esc = $this->escape($data);
        extract($esc);

        // 1️⃣ Update job details
        $up_emp2 = "
        UPDATE m_emp2 SET
            role        = '$role',
            level       = '$level',
            title       = '$jobtitle',
            type        = '$jobtype',
            exp         = '$experience',
            skill       = '$skilledin',
            st_date     = '$prefdate',
            re_date     = '$relievedate',
            reason      = '$reasonleaving',
            lap         = '$ownlaptop',
            verify      = '$verification'
        WHERE f_id = '$emp_edit'
    ";

        $q1 = mysqli_query($this->con, $up_emp2);

        // 2️⃣ UPDATE STATUS IN MASTER TABLE
        $up_status = "
        UPDATE m_emp
        SET status = '$status'
        WHERE id = '$emp_edit'
    ";

        $q2 = mysqli_query($this->con, $up_status);

        if ($q1 && $q2) {
            return json_encode([
                'status' => 'success',
                'message' => 'Employee details & status updated successfully',
                'url' => 'view_employee.php?emp=' . $emp_edit
            ]);
        } else {
            return json_encode([
                'status' => 'failed',
                'error' => mysqli_error($this->con),
                'url' => 'view_employee.php?emp=' . $emp_edit
            ]);
        }
    }


    public function up_emp3($data)
    {

        extract($data);


        $up_emp3 = "UPDATE `m_emp3` SET `b_name`='$bankname',`ac_name`='$bankacctholder',`ac_no`='$bankacctno',`ifsc`='$ifsc',


                        `ac_type`='$accttype',`b_branch`='$bankbranch',`salary`='$basic',`hra`='$hra',`convey`='$conveyance',`medical`='$medical',

                        `special`='$special',`other`='$other',`pf`='$pf',`esi`='$esi',`pro_tax`='$ptax',`it`='$it',`bonus`='$pbonus',`net`='$net' WHERE `f_id`='$emp_edit'";

        $q_emp3 = mysqli_query($this->con, $up_emp3);

        if ($q_emp3) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Employee STEP-3 details Updated Successfully',
                'url' => 'view_employee.php?emp=' . $emp_edit

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Employee STEP-3 details Failed to Update!!!',
                'url' => 'view_employee.php?emp=' . $emp_edit


            ]);
        }

    }

    // update the documents for employess

    public function up_emp4($data)
    {

        extract($data);

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


                    // echo $f_title."<br>";

                    // // Move the file to its destination
                    move_uploaded_file($f_tem, "./img/$f_title");

                    // You can choose to store the file name in the database if needed
                    $up_file = "UPDATE `m_file` SET `file`='$f_title'  where  `f_id`='$emp_edit' and  `cat`='emp' and  `type`='$field'";

                    $q_file = mysqli_query($this->con, $up_file);
                }
            }
        }


        if ($q_file) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Employee STEP-4 documents Updated Successfully',
                'url' => 'view_employee.php?emp=' . $emp_edit

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Employee STEP-3 documents Failed to Update!!!',
                'url' => 'view_employee.php?emp=' . $emp_edit


            ]);
        }

    }


    public function up_supplier($data)
    {

        extract($data);


        $up_sup = "UPDATE `m_supplier` SET `name`='$suppname',`b_name`='$bankname',`ac_no`='$bankacct',`ac_name`='$bankacctholder',`ifsc`='$ifsc',`b_branch`='$bankbranch',`gst`='$taxgst',`contact`='$contact',


                    `ad`='$adrs',`dis`='$district',`state`='$state',`pin`='$pincode' WHERE `id`='$sup_edit'";

        $q_sup = mysqli_query($this->con, $up_sup);

        if ($q_sup) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Supplier details Updated Successfully',
                'url' => 'list_supplier.php'

            ]);
        } else {

            return json_encode([
                'status' => 'Supplier',
                'message' => 'Employee STEP-3 details Failed to Update!!!',
                'url' => 'list_supplier.php'


            ]);
        }

    }
    public function up_ledger($data)
    {

        extract($data);


        $up_led = "UPDATE `m_ledger` SET `name`='$ledgername',`type`='$ledgertype' WHERE `id`='$led_edit'";

        $q_led = mysqli_query($this->con, $up_led);

        if ($q_led) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Ledger details Updated Successfully',
                'url' => 'list_ledger.php'

            ]);
        } else {

            return json_encode([
                'status' => 'Supplier',
                'message' => 'Ledger details Failed to Update!!!',
                'url' => 'list_ledger.php'


            ]);
        }

    }


    public function up_expenses($data, $file)
    {

        $esc = $this->escape($data);

        extract($esc);

        $file = $_FILES['exp_file']['name'];

        if ($file !== "") {

            $curdate = $this->c_on();

            $f_tem = $_FILES['exp_file']['tmp_name'];

            $f_title = $curdate . "-" . $file;
            move_uploaded_file($f_tem, "./img/$f_title");

            $up_exp = "UPDATE `m_exp` SET `sup_id`='$suppname',`led_id`='$ledgername',`w_name`='$w_order',`type`='$exptype',`amt`='$amount',


                    `remarks`='$remarks',`file`='$f_title'  WHERE `id`='$exp_edit'";

            $q_exp = mysqli_query($this->con, $up_exp);


        } else {

            $up_exp = "UPDATE `m_exp` SET `sup_id`='$suppname',`led_id`='$ledgername',`w_name`='$w_order',`type`='$exptype',`amt`='$amount',


            `remarks`='$remarks'  WHERE `id`='$exp_edit'";

            $q_exp = mysqli_query($this->con, $up_exp);

        }




        if ($q_exp) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Expenses Details Updated Successfully',
                'url' => 'list_expense.php'

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Expenses Details Failed to Update!!!',
                'url' => 'list_expense.php'



            ]);
        }

    }


    public function up_category($data)
    {

        extract($data);


        $up_cat = "UPDATE `m_cat` SET `title`='$cat_title',`des`='$cat_des' WHERE `id`='$cat_edit'";

        $q_cat = mysqli_query($this->con, $up_cat);

        if ($q_cat) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Category details Updated Successfully',
                'url' => 'settings.php'

            ]);
        } else {

            return json_encode([
                'status' => 'Supplier',
                'message' => 'Category details Failed to Update!!!',
                'url' => 'settings.php'


            ]);
        }

    }
    public function up_subcategory($data)
    {

        extract($data);


        $up_cat = "UPDATE `m_sub_task` SET `task`='$category',`sub`='$sub_title' WHERE `id`='$cat_edit'";

        $q_cat = mysqli_query($this->con, $up_cat);

        if ($q_cat) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Sub_category details Updated Successfully',
                'url' => 'settings.php'

            ]);
        } else {

            return json_encode([
                'status' => 'Supplier',
                'message' => 'Sub_category details Failed to Update!!!',
                'url' => 'settings.php'


            ]);
        }

    }

    public function up_meet($data, $file)
    {

        // $esc = $this->escape($data);

        extract($data);

        $emp_inv_arr = json_encode($per_inv, true);

        if ($type == 'online') {
            $link = $m_link;
            $rec = $rec_link;
        } else {
            $link = $loc;
            $rec = '';
        }

        $file = $_FILES['mom']['name'];

        if ($file !== "") {

            $curdate = $this->c_on();

            $f_tem = $_FILES['mom']['tmp_name'];

            $f_title = $curdate . "-" . $file;

            move_uploaded_file($f_tem, "./img/$f_title");

            $up_mt = "UPDATE `m_meeting` SET `m_type`='$type',`date`='$m_date',`time`='$m_time',`des`='$description',`loc`='$link',


                        `emp`='$emp_inv_arr',`client`='$clientteam',`rec_link`='$rec',`mom`='$f_title',`remarks`='$remarks',`status`='$meetsts'  WHERE `id`='$meet_id'";

            $q_meet = mysqli_query($this->con, $up_mt);


        } else {

            $up_mt = "UPDATE `m_meeting` SET `m_type`='$type',`date`='$m_date',`time`='$m_time',`des`='$description',`loc`='$link',


                        `emp`='$emp_inv_arr',`client`='$clientteam',`rec_link`='$rec',`remarks`='$remarks',`status`='$meetsts'  WHERE `id`='$meet_id'";

            $q_meet = mysqli_query($this->con, $up_mt);

        }




        if ($q_meet) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Meeting Details Updated Successfully',
                'url' => 'view_project.php?pro=' . $pro

            ]);
        } else {

            return json_encode([
                'status' => 'failed',
                'message' => 'Meeting Details Failed to Update!!!',
                'url' => 'view_project.php?pro=' . $pro



            ]);
        }

    }


    public function pro_sch($data)
    {

        extract($data);

        $int = [$this->emp_cook, $this->c_on()];

        $int1 = json_encode($int);

        $s_seq = "SELECT `pro_id`, MAX(`seq`) AS last_seq FROM `m_pro_task` WHERE `pro_id` = '$pro_sch' and `type`='loop' GROUP BY `pro_id`";
        $q_seq = mysqli_query($this->con, $s_seq);
        $d_seq = mysqli_fetch_assoc($q_seq);

        $seq_no = $d_seq['last_seq'] ?? 1;



        $up_cat = "UPDATE `m_pro_task` SET `status`='initial',`initial`='$int1' WHERE `pro_id`='$pro_sch' and `seq`='$seq_no' ";

        $q_cat = mysqli_query($this->con, $up_cat);

        $up_old = "UPDATE `m_task` SET `status`='close' WHERE `id`='$old_tk'  ";

        $q_old = mysqli_query($this->con, $up_old);

        if ($q_cat && $q_old) {

            header("Location:./dashboard_hrm.php?type=Plan");

            // return json_encode([
            //     'status' => 'Success',
            //     'message' => 'Sub_category details Updated Successfully',
            //      'url' => 'settings.php'

            // ]);
        } else {

            header("Location:./dashboard_hrm.php?type=Plan");

            // return json_encode([
            //     'status' => 'Supplier',
            //     'message' => 'Sub_category details Failed to Update!!!',
            //      'url' => 'settings.php'


            // ]);
        }

    }

    public function emp_task_status($data)
    {

        extract($data);


        $up_tk = "UPDATE `m_pro_task` SET `status`='$status' WHERE `id`='$task_id' ";

        $q_tk = mysqli_query($this->con, $up_tk);


        if ($q_tk) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Task Status details Updated Successfully -' . $status,
                'url' => 'settings.php'

            ]);
        } else {
            return json_encode([
                'status' => 'Fialed',
                'message' => 'Task Status details Failed to Update!!!',
                'url' => 'settings.php'


            ]);
        }

    }

    // UPDATE THE schedule task to initial by the employee


    public function emp_task_ind($data, $file)
    {

        extract($data);

        // $up_tk = "UPDATE `m_pro_task` SET  `status`='close' WHERE `id`='$task_id' ";

        // $q_tk = mysqli_query($this->con,$up_tk);

        $up_tk = "UPDATE `m_pro_task` SET `title`='$taskname',`des`='$taskdescp', `status`='initial' WHERE `id`='$task_id' ";

        $q_tk = mysqli_query($this->con, $up_tk);


        $file = $_FILES['task_file'];

        if (!empty($file['name'])) {
            $f_name = $file['name'];
            $f_tem = $file['tmp_name'];
            $f_size = $file['size'];
            $f_type = $file['type'];

            $f_ext = pathinfo($f_name, PATHINFO_EXTENSION);
            $f_ext1 = strtolower($f_ext[1]);

            $file_type = array('jpg', 'jpeg', 'png');


            $curdate = $this->c_on();

            $f_title = $curdate . "-" . $f_name;


            move_uploaded_file($f_tem, "./img/$f_title");


            $up_file = "INSERT INTO `m_file`( `f_id`, `cat`, `file`, `c_by`)

                                             VALUES ('$task_id','PRO_TASK','$f_title','$this->emp_cook')";

            $q_file = mysqli_query($this->con, $up_file);


        }



        if ($q_tk) {
            // return json_encode([
            //         'status' => 'Success'

            //     ]);
            header("Location:./emp_my_dashboard.php");
        } else {
            // return json_encode([
            //         'status' => 'Fialed'
            //     ]);
            header("Location:./emp_my_dashboard.php");
        }

    }


    public function emp_inital($data)
    {

        extract($data);



        $int = [$this->emp_cook, $this->c_on()];

        $int1 = json_encode($int);


        $up_tk = "UPDATE `m_pro_task` SET `status`='initial', `initial`='$int1' WHERE `id`='$tk_manual' ";

        $q_tk = mysqli_query($this->con, $up_tk);


        $up_old = "UPDATE `m_task` SET `status`='close' WHERE `pro_id`='$tk_pro' and `task`='Plan' ";

        $q_old = mysqli_query($this->con, $up_old);


        if ($q_tk && $q_old) {

            header("Location:./emp_my_dashboard.php");
        } else {
            header("Location:./emp_my_dashboard.php");
        }

    }

    public function leave_app($data)
    {

        extract($data);


        $up_leave = "UPDATE `e_leave` SET `status`='$sts' WHERE `id`='$lv_id'";

        $q_lv = mysqli_query($this->con, $up_leave);

        if ($q_lv) {
            header("Location:./list_approval.php");

            // return json_encode([
            //     'status' => 'Success',
            //     'message' => 'Leave details Updated Successfully',
            //      'url' => 'list_approval.php'

            // ]);
        } else {
            header("Location:./list_approval.php");

            // return json_encode([
            //     'status' => 'Supplier',
            //     'message' => 'Leave details Failed to Update!!!',
            //      'url' => 'list_approval.php'


            // ]);
        }

    }

    public function change_pwd($data)
    {

        extract($data);


        $up_leave = "UPDATE `m_emp` SET `pwd`='$password_new' WHERE `id`='{$this->emp_cook}'";

        $q_lv = mysqli_query($this->con, $up_leave);

        if ($q_lv) {


            return json_encode([
                'status' => 'Success',
                'message' => 'Password details Updated Successfully',
                'url' => 'list_approval.php'

            ]);
        } else {


            return json_encode([
                'status' => 'Failed',
                'message' => 'Password details Failed to Update!!!',
                'url' => 'list_approval.php'


            ]);
        }

    }

    // updat the leave request


    public function update_leave($data)
    {

        extract($data);

        if ($reqtype != 'Permission') {
            $permission = 0;
        }


        $update_leave = "UPDATE `e_leave` SET `s_date`='$startdate',`e_date`='$enddate',`type`='$reqtype',`hrs`='$permission',

                    `reason`='$reason' WHERE `id`='$edit_leave'";

        $q_lv = mysqli_query($this->con, $update_leave);

        if ($q_lv) {


            return json_encode([
                'status' => 'Success',
                'message' => 'Leave details Updated Successfully',
                'url' => 'list_leave_request.php'

            ]);
        } else {


            return json_encode([
                'status' => 'Failed',
                'message' => 'Leave details Failed to Update!!!',
                'url' => 'list_leave_request.php'


            ]);
        }

    }


    public function edit_pre_mon($data)
    {

        extract($data);


        $up_bud = "UPDATE `m_pre_bud` SET `type`='$type',`amt`='$amt' WHERE `id`='$bud_id' ";

        $q_bud = mysqli_query($this->con, $up_bud);


        if ($q_bud) {

            return json_encode([
                'status' => 'Success',
                'message' => 'Budget details Updated Successfully',
                'url' => 'list_pre_mon.php'

            ]);
        } else {
            return json_encode([
                'status' => 'Fialed',
                'message' => 'Budget Status details Failed to Update!!!',
                'url' => 'list_pre_mon.php'


            ]);
        }

    }






}

$up = new Update($emp_log);