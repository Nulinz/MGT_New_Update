<?php
session_start();

class DB
{
    public $local;
    public $user;
    public $pwd;
    public $db;

    public $c_on = '';
    public $c_time;
    public $c_date;
    public $con; // Declare $con as a mysqli object/resource
    public $cur_date;

    // Constructor to initialize the connection
    public function __construct()
    {

        // Get the host from the request
        $host = $_SERVER['HTTP_HOST'];

        // Set database credentials based on host (local or live)
        if ($host == "localhost") {
            $this->local = 'localhost';
            $this->user = 'root';
            $this->pwd = '';
            $this->db = 'nulinz_management';
        } else {
            $this->local = 'localhost';
            $this->user = 'nuscmy3y_saran';
            $this->pwd = 'sara@7811853020';
            $this->db = 'nuscmy3y_nulinz_mgt';
        }

        // Attempt to establish the database connection
        $this->con = mysqli_connect($this->local, $this->user, $this->pwd, $this->db);

        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Set the timezone and fetch current time/date
        date_default_timezone_set('Asia/Kolkata');
        $this->c_time = date("H:i");
        $this->c_date = date("Y-m-d");
    }

    public function link()
    {
        return $this->con;
    }
    public function c_on()
    {

        date_default_timezone_set('Asia/Kolkata');

        return $this->c_on = date("Y-m-d h_i_s");

    }

    public function money(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else
                $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }

    public function login($data)
    {
        extract($data);

        $s_log = "SELECT * FROM `m_emp` where `emp_code`='$emp' and `pwd`='$pwd'";
        $q_log = mysqli_query($this->con, $s_log);
        $count_log = mysqli_num_rows($q_log);


        if ($count_log == 0) {

            return json_encode([
                'status' => 'failed',
                'message' => 'User Not Exist!',
                'url' => 'index.php',

            ]);
        } else {

            $d_log = mysqli_fetch_assoc($q_log);

            $id = $d_log['id'];

            $_SESSION['emp_id'] = $id;
            setcookie("emp", $id, time() + (86400 * 90), "/"); // 86400 = 1 day

            $cur_date = $this->c_date;

            $s_log = "SELECT * from `e_login` where `f_id`='$id' and DATE(`c_on`)='$cur_date'";
            $q_login = mysqli_query($this->con, $s_log);
            $d_login = mysqli_num_rows($q_login);

            if ($d_login == 0) {

                $login_time = $this->c_on();

                $ins_log = "INSERT INTO `e_login`( `f_id`, `login`,  `c_on`)


                        VALUES ('$id','$login_time','$login_time')";

                $q_log = mysqli_query($this->con, $ins_log);

            }

            $s_emp2 = "SELECT * FROM `m_emp2` where `f_id`='$id'";
            $q_emp2 = mysqli_query($this->con, $s_emp2);
            $d_emp2 = mysqli_fetch_assoc($q_emp2);
            $emp_rl = $d_emp2['role'];

            if ((strpos($emp_rl, 'Business Development') !== false)) {
                $url = 'dashboard_crm.php';
            } else if ($emp_rl == 'Admin') {
                $url = 'dashboard.php';
            } else {
                $url = 'emp_my_dashboard.php';
            }



            return json_encode([
                'status' => 'success',
                'message' => '',
                'url' => $url
            ]);



        }
    }

    public function escape($postData)
    {
        $escapedData = [];
        foreach ($postData as $key => $value) {
            // if (is_array($value)) {

            //     $escapedData[$key] = mysqli_real_escape_string($this->con, trim($value));
            // } else {

            $escapedData[$key] = mysqli_real_escape_string($this->con, trim($value));
            // }
        }
        return $escapedData;
    }

    public function hasFile($inputName)
    {
        return isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK;
    }

}

$db = new DB();



if (isset($_POST['sign_in'])) {

    header('Content-Type: application/json');

    // extract($_POST);

    echo ($db->login($_POST));

}

?>