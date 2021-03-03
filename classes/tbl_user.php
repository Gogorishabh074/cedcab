<?php
session_start();

require_once "dbcon.php";

class User extends Dbcon
{
    public $email_id;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $status;
    public $password;
    public $is_admin;
    public $arr_all_users = array();

    function __construct()
    {
        $db = new Dbcon();
        $this->conn = $db->conn;
    }

    function signup($email, $name, $mobile, $password)
    {
        $this->email_id = $email;
        $this->name = $name;
        $this->mobile = $mobile;
        $this->password = $password;

        $userexist = "SELECT * FROM `tbl_user` WHERE `email_id` = '$this->email_id' ";
        $userexist_result = $this->conn->query($userexist);

        if ($userexist_result->num_rows > 0) {
            $userexistalready =  "user already exist";
            return $userexistalready;
        } else {
            $sql  = "INSERT INTO `tbl_user` (`email_id`,`name`,`dateofsignup`,`mobile`,`status`, `password`, `is_admin`)
        VALUES('$email', '$name', NOW(), '$mobile', '1', '$password', '0')";


            if ($this->conn->query($sql) == TRUE) {
                $messege =  "New record created successfully";
            } else {
                echo "ERROR: " . $sql . "<br>" . $this->conn->connet_error;
            }
            return $messege;
        }
    }

    function login($email, $password)
    {
        $this->email_id = $email;
        $this->password = $password;

        $loginquery = "SELECT * FROM `tbl_user` WHERE `email_id` = '$this->email_id' AND `password` ='$this->password'";
        $loginquery_result = $this->conn->query($loginquery);

        if ($loginquery_result->num_rows > 0) {
            $user = $loginquery_result->fetch_assoc();
            if ($user["is_admin"] == 1) {
                $_SESSION["user"] = $user;
                return  1;
               
            } else if ($user["status"] == 1) {
                $_SESSION["user"] = $user;
                return 0;
                
            } else {
                return -1;
            }
        } else {
            return -2;
        }
    }

    function get_all_users(){
        $get_users_query = "SELECT `user_id`, `email_id`,`name`,`dateofsignup`,`mobile`,`status` from `tbl_user` WHERE `is_admin` = 0";
        $get_users_query_result = $this->conn->query($get_users_query);

        if($get_users_query_result->num_rows > 0) {
            $i = 0;
            while($row = $get_users_query_result->fetch_assoc()){
                $this->arr_all_users[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_all_users;
    }
}
