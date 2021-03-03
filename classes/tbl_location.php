<?php
class Location
{
    public $name;
    public $distance;
    public $is_available;
    public $arr_location = array();
    public $arr_location_list = array();

    function __construct()
    {
        $db = new Dbcon();
        $this->conn = $db->conn;
    }

    function pickup()
    {

        $pickup_query = "SELECT * FROM `tbl_location` WHERE `is_available` = '1'";
        $pickup_query_result = $this->conn->query($pickup_query);

        if ($pickup_query_result->num_rows > 0) {
            $i = 0;
            while ($row =  $pickup_query_result->fetch_assoc()) {
                $this->arr_location[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_location;
    }

    function fare($distance, $cabtype, $luggage = null)
    {
        switch ($cabtype) {

            case "CED MINI":
                if ($luggage <= 10) {
                    $luggage_charge = 50;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $luggage_charge = 100;
                } else {
                    $luggage_charge = 200;
                }

                if ($distance < 10) {
                    $fare =  150 + $luggage_charge + $distance * 14.50;
                } else if ($distance > 10 && $distance < 60) {
                    $fare = 150 + $luggage_charge + ((10 * 14.50) + ($distance - 10) * 13.00);
                } else if ($distance > 60 && $distance < 160) {
                    $fare = 150 + $luggage_charge + ((10 * 14.50) + 50 * 13.00 + ($distance - 60) * 11.20);
                } else {
                    $fare = 150 + $luggage_charge + ((10 * 14.50) + 50 * 13.00 + 100 * 11.20 + ($distance - 100) * 9.50);
                }
                break;

            case "CED MICRO":
                if ($distance < 10) {
                    $fare =  50 + $distance * 14.50;
                } else if ($distance > 10 && $distance < 60) {
                    $fare = 50 +   ((10 * 14.50) + ($distance - 10) * 13.00);
                } else if ($distance > 60 && $distance < 160) {
                    $fare = 50 +  ((10 * 14.50) + 50 * 13.00 + ($distance - 60) * 11.20);
                } else {
                    $fare = 50 + ((10 * 14.50) + 50 * 13.00 + 100 * 11.20 + ($distance - 160) * 9.50);
                }
                break;

            case "CED ROYAL":
                if ($luggage <= 10) {
                    $luggage_charge = 50;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $luggage_charge = 100;
                } else {
                    $luggage_charge = 200;
                }

                if ($distance < 10) {
                    $fare =  200 + $luggage_charge + $distance * 15.50;
                } else if ($distance > 10 && $distance < 60) {
                    $fare = 200 + $luggage_charge + ((10 * 15.50) + ($distance - 10) * 14.00);
                } else if ($distance > 60 && $distance < 160) {
                    $fare = 200 + $luggage_charge + ((10 * 15.50) + 50 * 14.00 + ($distance - 60) * 12.20);
                } else {
                    $fare = 200 + $luggage_charge + ((10 * 15.50) + 50 * 14.00 + 100 * 12.20 + ($distance - 160) * 10.50);
                }
                break;

            case "CED SUV":
                if ($luggage <= 10) {
                    $luggage_charge = 50 * 2;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $luggage_charge = 100 * 2;
                } else {
                    $luggage_charge = 200 * 2;
                }

                if ($distance < 10) {
                    $fare =  250 + $luggage_charge + $distance * 16.50;
                } else if ($distance > 10 && $distance < 60) {
                    $fare = 250 + $luggage_charge + ((10 * 16.50) + ($distance - 10) * 15.00);
                } else if ($distance > 60 && $distance < 160) {
                    $fare = 250 + $luggage_charge + ((10 * 16.50) + 50 * 15.00 + ($distance - 60) * 13.20);
                } else {
                    $fare = 250 + $luggage_charge + ((10 * 16.50) + 50 * 15.00 + 100 * 13.20 + ($distance - 160) * 11.50);
                }
                break;
            default: {
                    $fare = "can be calculated";
                }
        }
        return $fare;
    }

    function get_location_list()
    {
        $location_list_query = "SELECT `name`,`distance`,`is_available` from `tbl_location` WHERE `is_available` = 1";
        $location_list_query_result = $this->conn->query($location_list_query);

        if ($location_list_query_result->num_rows > 0) {
            $i = 0;
            while ($row = $location_list_query_result->fetch_assoc()) {
                $this->arr_location_list[$i] = $row;
                ++$i;
            }
        }
        return $this->arr_location_list;
    }
}
