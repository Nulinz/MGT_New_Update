<?php

include('db.php');

if (!isset($_COOKIE['emp'])) {
    header('Location:./index.php');
} else {
    $emp_log = $_COOKIE['emp'];
}



class fetch extends DB
{

    public $emp_cook = '';

    public function __construct($emp_cook)
    {
        parent::__construct(); // Calls the parent DB constructor
        $this->emp_cook = $emp_cook; // Assign the parameter to the property
    }


    public function m_cat()
    {
        $s_cat = "SELECT * FROM `m_cat` WHERE `status`='Active'";

        $q_cat = mysqli_query($this->con, $s_cat);

        $cat = []; // Initialize the array before use
        while ($d_cat = mysqli_fetch_assoc($q_cat)) {
            $cat[] = $d_cat;
        }
        return $cat;
    }

    public function m_cat_value($val)
    {
        $s_cat = "SELECT * FROM `m_cat` WHERE  `cat`='$val' and `status`='Active'";

        $q_cat = mysqli_query($this->con, $s_cat);

        $cat = []; // Initialize the array before use
        while ($d_cat = mysqli_fetch_assoc($q_cat)) {
            $cat[] = $d_cat;
        }
        return $cat;
    }
    public function m_cat_id($val)
    {
        $s_cat = "SELECT * FROM `m_cat` WHERE  `id`='$val' and `status`='Active'";

        $q_cat = mysqli_query($this->con, $s_cat);
        $d_cat = mysqli_fetch_assoc($q_cat);

        return $d_cat;
    }

    public function m_emp()
    {
        $s_emp = "SELECT * FROM `m_emp` WHERE  `status`='Active'";

        $q_emp = mysqli_query($this->con, $s_emp);

        $emp_arr = []; // Initialize the array before use
        while ($d_emp = mysqli_fetch_assoc($q_emp)) {
            $emp_arr[] = $d_emp;
        }
        return $emp_arr;
    }

    public function table_list($tbl)
    {

        $s_tbl = "SELECT * FROM `$tbl` WHERE `status`='Active'";

        $q_tbl = mysqli_query($this->con, $s_tbl);

        $tbl_arr = []; // Initialize the array before use
        while ($d_tbl = mysqli_fetch_assoc($q_tbl)) {
            $tbl_arr[] = $d_tbl;
        }
        return $tbl_arr;
    }

    public function table_list_id($tbl, $col, $val)
    {

        $s_tbl = "SELECT * FROM `$tbl` WHERE `$col` ='$val' ";

        $q_tbl = mysqli_query($this->con, $s_tbl);
        $d_tbl = mysqli_fetch_assoc($q_tbl);

        return $d_tbl;
    }


    public function table_list_arr($tbl, $col = null, $val = null)
    {
        if ($col && $val !== null) {
            // Fetch with a WHERE condition
            $s_tbl = "SELECT * FROM `$tbl` WHERE `$col` ='$val'";
        } else {
            // Fetch all rows
            $s_tbl = "SELECT * FROM `$tbl`";
        }

        $q_tbl = mysqli_query($this->con, $s_tbl);
        $tbl_arr = [];
        while ($d_tbl = mysqli_fetch_assoc($q_tbl)) {
            $tbl_arr[] = $d_tbl;
        }

        return $tbl_arr;
    }

    public function list_arr_type($tbl, $col, $val, $cat)
    {

        if ($cat == "progress") {
            $s_tbl = "SELECT * FROM `$tbl` WHERE `$col` ='$val' and `cat` NOT IN ('Drop','Hold','Completed') ";
        } else {
            $s_tbl = "SELECT * FROM `$tbl` WHERE `$col` ='$val' and `cat`='$cat'";
        }

        $q_tbl = mysqli_query($this->con, $s_tbl);
        $tbl_arr = [];
        while ($d_tbl = mysqli_fetch_assoc($q_tbl)) {
            $tbl_arr[] = $d_tbl;
        }

        return $tbl_arr;
    }
    
    public function pro_docs($val, $type)
    {

        $s_tbl = "SELECT * FROM `m_file` WHERE `f_id` = '$val' and `cat`='$type' ORDER BY `id` DESC";

        $q_tbl = mysqli_query($this->con, $s_tbl);
        $tbl_arr = [];
        while ($d_tbl = mysqli_fetch_assoc($q_tbl)) {
            $tbl_arr[] = $d_tbl;
        }

        return $tbl_arr;
    }

    public function task_list_arr($tbl, $col, $val)
    {

        $s_tbl = "SELECT * FROM $tbl WHERE $col = '$val' ORDER BY id DESC";

        $q_tbl = mysqli_query($this->con, $s_tbl);
        $tbl_arr = [];
        while ($d_tbl = mysqli_fetch_assoc($q_tbl)) {
            $tbl_arr[] = $d_tbl;
        }

        return $tbl_arr;
    }

    public function task_list()
    {
        $s_task = "SELECT DISTINCT(task) FROM `m_sub_task` WHERE `status` = 'Active'";

        $q_task = mysqli_query($this->con, $s_task);

        $task_arr = []; // Initialize the array before use
        while ($d_task = mysqli_fetch_assoc($q_task)) {
            $task_arr[] = $d_task;
        }
        return $task_arr;
    }

    public function task_sub($val)
    {
        $s_task = "SELECT * FROM `m_sub_task` WHERE `task`='$val' and `status` = 'Active'";

        $q_task = mysqli_query($this->con, $s_task);

        $task_arr = []; // Initialize the array before use
        while ($d_task = mysqli_fetch_assoc($q_task)) {
            $task_arr[] = $d_task;
        }
        return $task_arr;
    }

    public function task_list_status()
    {
        $s_task = "SELECT * FROM `m_task` WHERE `status` = 'open'";

        $q_task = mysqli_query($this->con, $s_task);

        $task_arr = []; // Initialize the array before use
        while ($d_task = mysqli_fetch_assoc($q_task)) {
            $task_arr[] = $d_task;
        }
        return $task_arr;
    }
    public function task_list_arr_type($cat)
    {
        if ($cat == 'progress') {
            $s_task = "SELECT * FROM `m_task` WHERE `status` = 'open' and `task`  NOT IN ('Drop','Hold','Completed')";
        } else {
            if ($cat == 'Drop') {
                $status = 'close';
            } else {
                $status = 'open';
            }
            $s_task = "SELECT * FROM `m_task` WHERE `status` = '$status' and `task`='$cat'";
        }


        $q_task = mysqli_query($this->con, $s_task);

        $task_arr = []; // Initialize the array before use
        while ($d_task = mysqli_fetch_assoc($q_task)) {
            $task_arr[] = $d_task;
        }
        return $task_arr;
    }

    public function task_ind($task_for)
    {
        $s_task = "SELECT * FROM `m_task` WHERE `task_for`='$task_for' and  `status` = 'open'";

        $q_task = mysqli_query($this->con, $s_task);

        $task_arr = []; // Initialize the array before use
        while ($d_task = mysqli_fetch_assoc($q_task)) {
            $task_arr[] = $d_task;
        }
        return $task_arr;
    }

    public function task_ind_type($task_for, $cat)
    {
        if ($cat == 'progress') {
            $s_task = "SELECT * FROM `m_task` WHERE `task_for`='$task_for' and  `status` = 'open' and `task` NOT IN ('Drop','Hold','Completed')";
        } else {

            if ($cat == 'Drop') {
                $status = 'close';
            } else {
                $status = 'open';
            }

            $s_task = "SELECT * FROM `m_task` WHERE `task_for`='$task_for' and  `status` = '$status' and `task` = '$cat'";
        }

        $q_task = mysqli_query($this->con, $s_task);

        $task_arr = []; // Initialize the array before use
        while ($d_task = mysqli_fetch_assoc($q_task)) {
            $task_arr[] = $d_task;
        }
        return $task_arr;
    }


    public function quot_list($tbl, $pro, $cat)
    {
        $s_quot = "SELECT * FROM `$tbl` WHERE `f_id` = '$pro'";

        $q_quot = mysqli_query($this->con, $s_quot);

        $quot_arr = [];
        // Initialize the array before use
        $i = 1;
        while ($d_quot = mysqli_fetch_assoc($q_quot)) {
            $quote_prime = $d_quot['id'];


            $s_quot_val = "SELECT count(f_id) as items,sum(cost) as total from `e_quot` where `f_id`='$quote_prime' and `cat`='$cat'";
            $q_quot_val = mysqli_query($this->con, $s_quot_val);
            $d_quot_vl = mysqli_fetch_assoc($q_quot_val);

            // $sr_name = $this->m_cat_id($d_quot_vl['ser']);
            $d_quot['item'] = $d_quot_vl['items'];
            $d_quot['total'] = $d_quot_vl['total'];
            $quot_arr[] = $d_quot;



            // $quot_arr['service'] = $sr_name['title'];

            $i++;
        }

        return $quot_arr;
    }


    public function inv_list($pro, $cat)
    {
        $s_quot = "SELECT * FROM `e_quot` WHERE `f_id` = '$pro' and `cat`='$cat'";

        $q_quot = mysqli_query($this->con, $s_quot);

        $quot_arr = [];
        // Initialize the array before use
        $i = 1;
        while ($d_quot = mysqli_fetch_assoc($q_quot)) {

            $quot_arr[] = $d_quot;

            // $quot_arr['service'] = $sr_name['title'];

            $i++;
        }

        return $quot_arr;
    }

    public function crm_chart1($task_for, $role)
    {

        $a = ['L1', 'L2', 'CS'];

        $task_arr_L1 = []; // Initialize separate arrays for L1, L2, CS
        $task_arr_L2 = [];
        $task_arr_CS = [];

        foreach ($a as $b) {

            if ($role == "Admin") {

                $s_task = "SELECT
                COUNT(*) as total,
                    mc.c_cat,
                SUM(mp.pro_val) AS total_val
                FROM
                    `m_task` AS mt
                JOIN
                    `m_pro` AS mp
                    ON mt.pro_id = mp.id
                JOIN
                    `m_cmp` AS mc
                    ON mc.id = mp.c_id
                WHERE
                     mt.status = 'open'
                    AND mt.sub IN ('$b')
                GROUP BY
                    mc.c_cat";

            } else {

                $s_task = "SELECT
                COUNT(*) as total,
                    mc.c_cat,
                SUM(mp.pro_val) AS total_val
                FROM
                    `m_task` AS mt
                JOIN
                    `m_pro` AS mp
                    ON mt.pro_id = mp.id
                JOIN
                    `m_cmp` AS mc
                    ON mc.id = mp.c_id
                WHERE
                    mt.task_for = '$task_for'
                    AND mt.status = 'open'
                    AND mt.sub IN ('$b')
                GROUP BY
                    mc.c_cat";

            }


            $q_task = mysqli_query($this->con, $s_task);
            $i = 1;
            while ($d_task = mysqli_fetch_assoc($q_task)) {
                $cat = $this->m_cat_id($d_task['c_cat']);

                $cat_title = $cat['title'];

                $d_task['cat'] = $cat_title ?? 0;


                if ($b == 'L1') {
                    $task_arr_L1[] = $d_task;
                } elseif ($b == 'L2') {
                    $task_arr_L2[] = $d_task;
                } elseif ($b == 'CS') {
                    $task_arr_CS[] = $d_task;
                }
            }

        }

        //             // Combine the arrays into one associative array for easier access if needed
        $task_arr = [
            'L1' => $task_arr_L1,
            'L2' => $task_arr_L2,
            'CS' => $task_arr_CS
        ];
        return $task_arr;
    }


    public function crm_tbl()
    {

        // $emp_list = $this->m_emp();

        $emp_ar = [];

        $s_em = "SELECT me.id from `m_emp` as me JOIN `m_emp2` as mr ON me.id=mr.f_id where ((mr.role='Business Development Associate L-1') or (mr.role='Admin')) and me.status='Active'";
        $q_em = mysqli_query($this->con, $s_em);
        while ($d_em = mysqli_fetch_assoc($q_em)) {
            $emp_ar[] = $d_em['id'];
        }

        $new_ar1 = [];

        foreach ($emp_ar as $employee) {

            $s_tk = "SELECT mt.sub,mt.task_for as tk, COUNT(*) AS count_tk, GROUP_CONCAT(DISTINCT mt.pro_id) AS pro_ids, (SUM(mp.pro_val)/10000) AS total_pro_val FROM `m_task` AS mt JOIN `m_pro` AS mp ON mt.pro_id = mp.id WHERE mt.task_for = '$employee' AND mt.status = 'open' and mt.task NOT IN ('Drop','Hold') AND mt.sub IN ('L1', 'L2', 'CS') GROUP BY mt.sub";
            $q_tk = mysqli_query($this->con, $s_tk);
            $new_ar = [];
            while ($d_tk = mysqli_fetch_assoc($q_tk)) {

                $sub = $d_tk['sub'];
                $tk = $d_tk['tk'];


                $new_ar[$sub] = $d_tk;
            }



            $new_ar1[$employee] = $new_ar;




        }


        return $new_ar1;

    }


    public function crm_lead_chart($emp_lead, $role)
    {

        // $current_year = date("Y");
        // // $current_year = 2024;
        // $current_month = date("m");
        // // $current_month = 12;
        // $current_month_name = date("F", strtotime("$current_year-$current_month-01"));

        // // Get the total number of days in the current month
        // $total_days_in_month = date("t", strtotime("$current_year-$current_month-01"));



        // // Define the week ranges
        // $week_ranges = [
        //     ['start' => 1, 'end' => 7],
        //     ['start' => 8, 'end' => 14],
        //     ['start' => 15, 'end' => 21],
        //     ['start' => 22, 'end' => $total_days_in_month] // Last week goes to the end of the month
        // ];

        // // $t_week = 0;
        // // Loop through the defined week ranges
        // $wk = 1;
        // foreach ($week_ranges as $index => $range) {
        //     $start_date = new DateTime("$current_year-$current_month-{$range['start']}");
        //     $end_date = new DateTime("$current_year-$current_month-{$range['end']}");

        //     $st_date1 = $start_date->format("Y-m-d");
        //     $e_date1 = $end_date->format("Y-m-d");

        // Initialize an array to hold the weeks
        $weeks = [];

        if ($role == 'Admin') {
            $s_week_pro = "SELECT YEAR(`c_on`) AS year, MONTH(`c_on`) AS month, COUNT(*) AS ttl_pro, SUM(`pro_val`) AS ttl_val FROM `m_pro` WHERE  `status` = 'Active' and `cat` NOT IN ('Drop','Hold') GROUP BY YEAR(`c_on`), MONTH(`c_on`) ORDER BY YEAR(`c_on`), MONTH(`c_on`);";

        } else {
            $s_week_pro = "SELECT YEAR(`c_on`) AS year, MONTH(`c_on`) AS month, COUNT(*) AS ttl_pro, SUM(`pro_val`) AS ttl_val FROM `m_pro` WHERE `c_by` = '$emp_lead' AND `status` = 'Active' and  `cat` NOT IN ('Drop','Hold') GROUP BY YEAR(`c_on`), MONTH(`c_on`) ORDER BY YEAR(`c_on`), MONTH(`c_on`);";

        }

        $q_week_pro = mysqli_query($this->con, $s_week_pro);
        while ($d_week_pro = mysqli_fetch_assoc($q_week_pro)) {
            // $week_pro = $d_week_pro;
            // $s_week = "select count(id) as total_week from `m_attend` where `pro_id`='$week_pro' and DATE(`cap_in`) between '$st_date1' and '$e_date1' ";
            // $q_week = mysqli_query($con, $s_week);
            // $d_week = mysqli_fetch_assoc($q_week);
            // $t_week = $d_week['total_week'];


            // $dt = "Week - ".$wk;

            // Format the dates and store them in the array
            $weeks[] = $d_week_pro;

            //$weeks = ["2", "5", "4", "6"];
        }

        return $weeks;

    }


    public function crm_pdf($employee)
    {


        $s_tk = "SELECT mt.sub,mt.task_for as tk,mp.title,mp.pro_val,mt.st_date as tk_start,mp.*,mt.* FROM `m_task` AS mt JOIN `m_pro` AS mp ON mt.pro_id = mp.id WHERE mt.task_for = '$employee' AND mt.status = 'open' AND mt.sub IN ('L1', 'L2', 'CS') ORDER BY FIELD(mt.sub, 'CS', 'L2', 'L1'),FIELD(mp.lead, 'Hot', 'Warm', 'Cold')";
        $q_tk = mysqli_query($this->con, $s_tk);
        $new_ar = [];
        while ($d_tk = mysqli_fetch_assoc($q_tk)) {

            $new_ar[] = $d_tk;
        }



        return $new_ar;

    }
    public function dash_growth()
    {


        $s_mon = "SELECT YEAR(`status_con`) AS year, MONTH(`status_con`) AS mon, COUNT(id) AS cnt FROM `m_quot` WHERE `status` = 'final' GROUP BY YEAR(`status_con`), MONTH(`status_con`) ORDER BY `year`,`mon`";
        $q_mon = mysqli_query($this->con, $s_mon);
        $new_ar = [];

        // Array of full month names
        $monthNames = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ];


        while ($d_mon = mysqli_fetch_assoc($q_mon)) {

            $mon_name = $monthNames[$d_mon['mon']];

            $year = $d_mon['year'];

            // Append the month name to the array
            $new_ar[] = ['mon_name' => $mon_name . "-" . $year, 'cnt' => $d_mon['cnt']];
        }
        return $new_ar;
    }

    public function dash_growth_ind()
    {


        $s_mon = "SELECT YEAR(q.c_on) AS year, MONTH(q.c_on) AS mon, COUNT(q.id) AS cnt, q.f_id, p.c_by FROM m_quot q JOIN m_pro p ON q.f_id = p.id WHERE q.status = 'final' GROUP BY YEAR(q.c_on), MONTH(q.c_on), p.c_by ORDER BY year, mon,p.c_by";
        $q_mon = mysqli_query($this->con, $s_mon);
        $new_ar = [];

        // Array of full month names
        $monthNames = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ];


        while ($d_mon = mysqli_fetch_assoc($q_mon)) {

            $mon_name = $monthNames[$d_mon['mon']];

            $year = $d_mon['year'];

            $c_by = $d_mon['c_by'];

            // Append the month name to the array
            $new_ar[] = ['mon_name' => $mon_name . "-" . $year, 'cnt' => $d_mon['cnt'], "c_by" => $c_by];
        }



        return $new_ar;

    }



    public function dash_exp_inc()
    {


        $s_exp = "SELECT YEAR(`c_on`) AS year, MONTH(`c_on`) AS mon,sum(per_amt) as amt FROM `m_exp` GROUP BY YEAR(`c_on`), MONTH(`c_on`) order by `year`, `mon`";
        $q_exp = mysqli_query($this->con, $s_exp);
        $new_ar = [];

        // Array of full month names
        $monthNames = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ];


        while ($d_mon = mysqli_fetch_assoc($q_exp)) {

            if ($d_mon['mon'] == 0) {
                continue;
            }

            $mon_name = $monthNames[$d_mon['mon']];

            $year = $d_mon['year'];

            $d_mon['mon_nm'] = $mon_name . "-" . $year;

            // Append the month name to the array
            $new_ar['exp'][] = $d_mon;
        }


        $s_inv = "SELECT YEAR(`c_on`) AS year,MONTH(mi.c_on) AS mon, SUM(eq_sub.total_cost) AS amt FROM  m_inv AS mi LEFT JOIN

                            (SELECT f_id, SUM(qty * cost) AS total_cost FROM e_quot AS eq WHERE eq.cat = 'inv' GROUP BY f_id) AS eq_sub ON mi.id = eq_sub.f_id WHERE MONTH(mi.c_on) != 0 GROUP BY MONTH(mi.c_on) order by `year`, `mon`";

        $q_inv = mysqli_query($this->con, $s_inv);

        while ($d_inv = mysqli_fetch_assoc($q_inv)) {


            if ($d_inv['mon'] == 0) {
                continue;
            }

            $inv_name = $monthNames[$d_inv['mon']];

            $year = $d_inv['year'];

            $d_inv['mon_nm'] = $inv_name . "-" . $year;

            // Append the month name to the array
            $new_ar['inc'][] = $d_inv;

        }



        return $new_ar;

    }



    public function dash_box1($box)
    {

        $current_year = date("Y");
        //     // $current_year = 2024;
        $current_month = date("m");
        //     // $current_month = 12;
        $st_date = date("Y-m-d", strtotime("$current_year-$current_month-01"));

        // Get the total number of days in the current month
        $total_days_in_month = date("t", strtotime("$current_year-$current_month-01"));

        $end_date = date("Y-m-d", strtotime("$current_year-$current_month-$total_days_in_month"));

        if ($box == 'month') {


            $s_qt = "SELECT SUM(eq_sub.total_cost) AS quot_amt FROM m_quot AS mq LEFT JOIN (SELECT f_id, SUM(qty * cost) AS total_cost FROM e_quot AS eq WHERE eq.cat = 'quot' GROUP BY f_id) AS eq_sub ON mq.id = eq_sub.f_id where mq.status='final' and DATE(mq.c_on) BETWEEN '$st_date' and '$end_date'";
            $q_qt = mysqli_query($this->con, $s_qt);
            $new_ar = [];
            $d_qt = mysqli_fetch_assoc($q_qt);

            $s_inv = "SELECT SUM(eq_sub.total_cost) AS inv_amt FROM m_inv AS mi LEFT JOIN (SELECT f_id, SUM(qty * cost) AS total_cost FROM e_quot AS eq WHERE eq.cat = 'inv' GROUP BY f_id) AS eq_sub ON mi.id = eq_sub.f_id where  DATE(mi.c_on) BETWEEN '$st_date' and '$end_date'";
            $q_inv = mysqli_query($this->con, $s_inv);
            $d_inv = mysqli_fetch_assoc($q_inv);

            // Append the month name to the array
            $new_ar = [$d_qt['quot_amt'], $d_inv['inv_amt']];


            return $new_ar;

        } else {

            $s_qt = "SELECT SUM(eq_sub.total_cost) AS quot_amt FROM m_quot AS mq LEFT JOIN (SELECT f_id, SUM(qty * cost) AS total_cost FROM e_quot AS eq WHERE eq.cat = 'quot' GROUP BY f_id) AS eq_sub ON mq.id = eq_sub.f_id where mq.status='final' ";
            $q_qt = mysqli_query($this->con, $s_qt);
            $new_ar = [];
            $d_qt = mysqli_fetch_assoc($q_qt);

            $s_inv = "SELECT SUM(eq_sub.total_cost) AS inv_amt FROM m_inv AS mi LEFT JOIN (SELECT f_id, SUM(qty * cost) AS total_cost FROM e_quot AS eq WHERE eq.cat = 'inv' GROUP BY f_id) AS eq_sub ON mi.id = eq_sub.f_id where  DATE(mi.c_on) ";
            $q_inv = mysqli_query($this->con, $s_inv);
            $d_inv = mysqli_fetch_assoc($q_inv);

            // Append the month name to the array
            $new_ar = [$d_qt['quot_amt'], $d_inv['inv_amt']];

            return $new_ar;



        }

    }

    public function dash_box3()
    {

        $current_year = date("Y");
        //     // $current_year = 2024;
        $current_month = date("m");
        //     // $current_month = 12;
        $st_date = date("Y-m-d", strtotime("$current_year-$current_month-01"));

        // Get the total number of days in the current month
        $total_days_in_month = date("t", strtotime("$current_year-$current_month-01"));

        $end_date = date("Y-m-d", strtotime("$current_year-$current_month-$total_days_in_month"));


        $s_gst = "SELECT SUM(eq_sub.total_cost * (ms.gst/100)) AS gst_amount FROM m_inv AS mi
                    LEFT JOIN (SELECT f_id, SUM(qty * cost) AS total_cost,ser FROM e_quot AS eq WHERE eq.cat = 'inv' GROUP BY f_id, ser) AS eq_sub
                    ON mi.id = eq_sub.f_id
                    LEFT JOIN ( SELECT id, gst FROM m_service) AS ms ON ms.id = eq_sub.ser
                    WHERE mi.gst_type='With' AND DATE(mi.c_on) BETWEEN '$st_date' AND '$end_date'
                    GROUP BY mi.id";

        $q_qt = mysqli_query($this->con, $s_gst);
        $new_ar = [];
        while ($d_qt = mysqli_fetch_assoc($q_qt)) {

            $new_ar[] = $d_qt['gst_amount'] ?? 0;

        }

        // upated gst

        $s_up = "SELECT SUM(eq_sub.total_cost * (ms.gst/100)) AS gst_amount FROM m_inv AS mi
                LEFT JOIN (SELECT f_id, SUM(qty * cost) AS total_cost,ser FROM e_quot AS eq WHERE eq.cat = 'inv' GROUP BY f_id, ser) AS eq_sub
                ON mi.id = eq_sub.f_id
                LEFT JOIN ( SELECT id, gst FROM m_service) AS ms ON ms.id = eq_sub.ser
                WHERE mi.gst_type='With' and mi.gst='gst' AND DATE(mi.c_on) BETWEEN '$st_date' AND '$end_date'
                GROUP BY mi.id";

        $q_up = mysqli_query($this->con, $s_up);
        $new_up = [];
        while ($d_up = mysqli_fetch_assoc($q_up)) {

            $new_up[] = $d_up['gst_amount'] ?? 0;

        }

        $pend = (array_sum($new_ar) - array_sum($new_up));


        $s_exp = "SELECT SUM(gst_amt) AS gst_amt,sum(per_amt) as per_amt FROM m_exp  where  DATE(c_on) BETWEEN '$st_date' and '$end_date'";
        $q_exp = mysqli_query($this->con, $s_exp);
        $d_exp = mysqli_fetch_assoc($q_exp);

        $s_sal = "SELECT SUM(total) AS sal_amt FROM e_salary  where `mon`='$current_month' and `year`='$current_year'";
        $q_sal = mysqli_query($this->con, $s_sal);
        $d_sal = mysqli_fetch_assoc($q_sal);



        $box3_arr = [$pend, $d_exp['gst_amt'], $d_exp['per_amt'], $d_sal['sal_amt']];

        // // Append the month name to the array
        // $new_ar = [$d_qt['quot_amt'],$d_inv['inv_amt']];


        return $box3_arr;


    }



    public function list_target($mon, $year)
    {



        $s_list = "SELECT * from `m_target` where  `mon`='$mon' and `year`='$year'";
        $q_list = mysqli_query($this->con, $s_list);
        $name = [];
        while ($d_list = mysqli_fetch_assoc($q_list)) {

            $emp = $d_list['emp'];

            $emp_lt = $this->table_list_id('m_emp', 'id', $emp);

            $emp_name = $emp_lt['name'];

            $s_ach = "SELECT sum(mp.pro_val)as pro_amt FROM `m_quot` AS mq JOIN `m_pro` AS mp ON mq.f_id = mp.id WHERE (mq.status = 'final') AND mp.c_by = '$emp' AND MONTH(mq.status_con)='$mon' and YEAR(mq.status_con)='$year'";
            $q_ach = mysqli_query($this->con, $s_ach);
            $d_ach = mysqli_fetch_assoc($q_ach);

            $d_ach['emp_name'] = $emp_name;
            $d_ach['target'] = $d_list['amt'];



            $name[] = $d_ach;

        }

        return $name;



    }
    public function list_target_ind($user)
    {


        $months = [
            "1" => "January",
            "2" => "February",
            "3" => "March",
            "4" => "April",
            "5" => "May",
            "6" => "June",
            "7" => "July",
            "8" => "August",
            "9" => "September",
            "10" => "October",
            "11" => "November",
            "12" => "December"
        ];



        $s_list = "SELECT * from `m_target` where  `emp`='$user'";
        $q_list = mysqli_query($this->con, $s_list);
        $name = [];
        while ($d_list = mysqli_fetch_assoc($q_list)) {

            $emp = $d_list['emp'];

            $mon = $d_list['mon'];
            $year = $d_list['year'];

            $emp_lt = $this->table_list_id('m_emp', 'id', $emp);

            $emp_name = $emp_lt['name'];

            $s_ach = "SELECT sum(mp.pro_val)as pro_amt FROM `m_quot` AS mq JOIN `m_pro` AS mp ON mq.f_id = mp.id WHERE (mq.status = 'final') AND mp.c_by = '$emp' AND MONTH(mq.status_con)='$mon' and YEAR(mq.status_con)='$year'";
            $q_ach = mysqli_query($this->con, $s_ach);
            $d_ach = mysqli_fetch_assoc($q_ach);

            // $d_ach['emp_name'] = $emp_name;

            $d_ach['target'] = $d_list['amt'];
            $d_ach['mon_name'] = $months[$mon] . "-" . $year;
            $d_ach['year'] = $d_list['amt'];

            $name[] = $d_ach;

        }

        return $name;



    }

    public function attd_list_arr($tbl, $col, $val)
    {

        $s_tbl = "SELECT * FROM `$tbl` WHERE $col ='$val' ";

        $q_tbl = mysqli_query($this->con, $s_tbl);
        $tbl_arr = [];
        while ($d_tbl = mysqli_fetch_assoc($q_tbl)) {
            $tbl_arr[] = $d_tbl;
        }

        return $tbl_arr;
    }


    public function mon_attd($mon, $employee)
    {

        $s_tbl = "SELECT * FROM `e_login` WHERE f_id ='$employee' and MONTH(`c_on`)='$mon' ";

        $q_tbl = mysqli_query($this->con, $s_tbl);
        $tbl_arr = [];
        while ($d_tbl = mysqli_fetch_assoc($q_tbl)) {
            $tbl_arr[] = $d_tbl;
        }

        return $tbl_arr;
    }


    public function target_ach($emp_id)
    {

        $per_lt = $this->list_target_ind($emp_id);
        $lt = [];
        foreach ($per_lt as $per) {

            $pro_amt = $per['pro_amt'];
            $tar = $per['target'];

            $percent = ($per['pro_amt'] / $per['target']) * 100;

            $lt[] = [$per['mon_name'], $percent];


        }

        return $lt;





    }


    public function next_emp_code()
    {
        $sql = "SELECT emp_code FROM m_emp ORDER BY emp_code DESC LIMIT 1";
        $result = mysqli_query($this->con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return (int) $row['emp_code'] + 1;
        } else {
            return 1001; // starting emp code
        }
    }

}


$fetch = new fetch($emp_log);

?>