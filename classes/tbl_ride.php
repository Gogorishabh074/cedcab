<?php 
// session_start();

require_once "dbcon.php";

class Ride extends Dbcon{
    public $ride_date;
    public $from;
    public $to;
    public $total_distance;
    public $luggage;
    public $total_fare;
    public $status;
    public $customer_user_id;
    public $arr_cancelled_rides = array();
    public $arr_pending_rides = array();
    public $arr_all_rides = array();
    public $arr_completed_rides = array();
    public $arr_ride_details = array();

    public $arr_ride_requests = array();
    public $arr_all_completed_ride = array();
    public $arr_all_cancelled_rides = array();
    public $arr_rides = array();

    function __construct()
    {
        // $this->ride_date = $ride_date;
        // $this->from = $from;
        // $this->to = $to;
        // $this->total_distance = $total_distance;
        // $this->luggage = $luggage;
        // $this->total_fare = $total_fare;
        // $this->status = $status;
        // $this->customer_user_id = $customer_user_id;

        $db = new Dbcon();
        $this->conn = $db->conn;
    }

    function bookcab($from, $to, $total_distance, $cabtype, $luggage = null, $total_fare){
        $this->from = $from;
        $this->to = $to;
        $this->total_distance = $total_distance;
        $this->cabtype = $cabtype;
        $this->luggage = $luggage;
        $this->total_fare = $total_fare;
        $status = $_SESSION["user"]["status"];
        $customer_user_id = $_SESSION["user"]["user_id"];
       
        $ride_book_query = "INSERT INTO `tbl_ride` (`ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`, `cab_type`)
        VALUES (NOW(), '$from', '$to', '$total_distance', '$luggage', '$total_fare', '$status', '$customer_user_id', '$cabtype')";
        // $ride_book_query_result = $this->conn->querry($ride_book_query);

        if($this->conn->query($ride_book_query) == TRUE){
            $ride_book_query_result = "Your Ride has been successfully Booked";
        }
        return $ride_book_query_result;

    }
    function get_cancelled_rides(){
        $customer_user_id = $_SESSION["user"]["user_id"];
        $cancelled_ride_query = "SELECT `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride` WHERE `status` = 0 AND `customer_user_id` = $customer_user_id";
        $cancelled_ride_query_result = $this->conn->query($cancelled_ride_query);

        if($cancelled_ride_query_result->num_rows > 0 ){
            $i = 0;
            while($row = $cancelled_ride_query_result->fetch_assoc()){
                $this->arr_cancelled_rides[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_cancelled_rides;
    }

    function get_pending_rides (){
        $customer_user_id = $_SESSION["user"]["user_id"];
     
        $pending_ride_query = "SELECT `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride` WHERE `status` = 1 AND `customer_user_id` = $customer_user_id";
        $pending_ride_query_result = $this->conn->query($pending_ride_query);

        if($pending_ride_query_result ->num_rows > 0 ){
            $i =0;
            while($row = $pending_ride_query_result -> fetch_assoc()){
                $this->arr_pending_rides[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_pending_rides;
    }


    function get_total_expense(){
        $customer_user_id = $_SESSION["user"]["user_id"];
        $total_expense_query = "SELECT SUM(total_fare)  AS `Total_expense` FROM `tbl_ride` WHERE `status` = 2 AND `customer_user_id` = $customer_user_id";
        $total_expense_query_result = $this->conn->query($total_expense_query);

        $temp = $total_expense_query_result->fetch_Assoc();

        return $temp;
        
    }

    function get_completed_rides(){
        $customer_user_id = $_SESSION["user"]["user_id"];

        $completed_ride_query = "SELECT`ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride` WHERE `status` = 2 AND `customer_user_id` = $customer_user_id";
        $completed_ride_query_result = $this->conn->query($completed_ride_query);

        if($completed_ride_query_result ->num_rows > 0){
            $i=0;
            while($row = $completed_ride_query_result->fetch_assoc()){
                $this->arr_completed_rides[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_completed_rides;

    }
    function get_ride_details($user_ride_id){
        $customer_user_id = $_SESSION["user"]["user_id"];
        $ride_detail_query = "SELECT `ride_date`, `from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`, `cab_type`
         FROM `tbl_ride` WHERE `customer_user_id` = $customer_user_id AND `ride_id` = $user_ride_id" ; 
         $ride_detail_query_result = $this->conn->query($ride_detail_query);

         if($ride_detail_query_result ->num_rows > 0){
             $i=0;
             while($row = $ride_detail_query_result->fetch_assoc()){
                 $this->arr_ride_details[$i] = $row;
                 ++$i;
             }
         }
         return $this->arr_ride_details;
    }
    
    function Cancel_ride($cancel_ride_id){
        $customer_user_id = $_SESSION["user"]["user_id"];
        $canel_ride_query = "UPDATE `tbl_ride` SET `status` = 0 WHERE `customer_user_id` = $customer_user_id AND  `ride_id` = $cancel_ride_id ";
        
        if ($this->conn->query($canel_ride_query) == TRUE ){
            return "Your Ride has been Cancelled Successfully";
        }
    }

    function get_all_rides(){
        $customer_user_id = $_SESSION["user"]["user_id"];
        $all_rides_query = "SELECT `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` `status` FROM `tbl_ride`  WHERE `customer_user_id` = $customer_user_id";
        $all_rides_query_result = $this->conn->query($all_rides_query);

        if($all_rides_query_result->num_rows > 0){
            $i =0;
            while($row = $all_rides_query_result -> fetch_assoc()){
                $this->arr_all_rides[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_all_rides;
    }

//*********************Admin Pannel methods*************************/


    function get_ride_requests(){
        $ride_request_query = "SELECT `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride` WHERE `status` = 1";
        $ride_request_query_result = $this->conn->query($ride_request_query);

        if($ride_request_query_result->num_rows > 0){
            $i = 0;
            while($row = $ride_request_query_result->fetch_assoc()){
                $this->arr_ride_requests[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_ride_requests;
    }

    function get_all_completed_rides(){
        $completed_rides_query = "SELECT `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride` WHERE `status` = 2 ";
        $completed_rides_query_result = $this->conn->query($completed_rides_query);

        if($completed_rides_query_result->num_rows > 0){
            $i = 0;
            while($row = $completed_rides_query_result->fetch_assoc()){
                $this->arr_all_completed_ride[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_all_completed_ride;
    }

    function get_all_cancelled_rides(){
        $cancelled_rides_query = "SELECT  `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride` WHERE `status` = 0 ";
        $cancelled_rides_query_result = $this->conn->query($cancelled_rides_query);

        if($cancelled_rides_query_result->num_rows > 0){
            $i = 0;
            while($row = $cancelled_rides_query_result->fetch_assoc()){
                $this->arr_all_cancelled_rides[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_all_cancelled_rides;
    }

    function get_rides(){
        $ride_query = "SELECT `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride`";
        $ride_query_result = $this->conn->query($ride_query);

        if($ride_query_result->num_rows >0 ){
            $i = 0;
            while($row = $ride_query_result->fetch_assoc()){
                $this->arr_rides[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_rides;
    }

    function Approve_ride($approve_ride_id){
        $approve_ride_query = "UPDATE `tbl_ride` SET `status` = 2 WHERE  `ride_id` = $approve_ride_id ";
        if($this->conn->query($approve_ride_query) == TRUE){
            return "Ride has been successfully approved";
        }
    }

    function get_sorted_table($order, $date_fare){
        $sorted_table_query = "SELECT `ride_id`, `from`, `to`, `total_fare`, `luggage`, `cab_type` FROM `tbl_ride` ORDERBY  ";


    }
}
