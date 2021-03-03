<?php
if (!isset($_POST)) {
    die("Sorry u can't access");
}
include "classes/tbl_user.php";
include "classes/tbl_location.php";
include "classes/tbl_ride.php";

if (isset($_POST['action'])) {

    switch ($_POST['action']) {
        case "signup": {
                $email = $_POST["email"];
                $name = $_POST["name"];
                $mobile = $_POST["mobile"];
                $password = $_POST["password"];

                $signup_obj = new User();
                $signup_result = $signup_obj->signup($email, $name, $mobile, $password);
                echo $signup_result;
                break;
            }

        case "login": {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $login_obj = new User();
                $login_result = $login_obj->login($email, $password);
                echo $login_result;
                break;
            }
        case "pickup": {
                $pickup_obj = new Location();
                $pickup_result = $pickup_obj->pickup();
                echo json_encode($pickup_result);
                break;
            }
        case "fare_calculation": {
                $pickup_location = $_POST["pickup_location"];
                $pickup = $_POST["pickup"];
                $dropup_location = $_POST["dropup_location"];
                $dropup = $_POST["dropup"];
                $cabtype = $_POST["cabtype"];
                $luggage = $_POST["luggage"];

                $distance = abs($pickup - $dropup);
                // $_SESSION['pickup'] = $pickup;

                $fare_obj = new Location();
                $fare_obj_result = $fare_obj->fare($distance, $cabtype, $luggage);
                $modal_result = array($pickup_location, $dropup_location, $cabtype, $luggage, $fare_obj_result, $distance);
                $_SESSION["modal_Result"] = $modal_result;
                echo json_encode($modal_result);
                break;
            }

        case "bookcab": {
                $from = $_POST["pickup"];
                $to = $_POST["dropup"];
                $cabtype = $_POST["cabtype"];
                $luggage = $_POST["luggage"];
                $total_fare = $_POST["fare"];
                $total_distance = $_POST["total_distance"];

                $bookcab_obj = new Ride();
                $bookcab_obj_result = $bookcab_obj->bookcab($from, $to, $total_distance, $cabtype, $luggage, $total_fare);
                echo $bookcab_obj_result;
                break;
            }
        case "user_cancelled_rides": {
                $user_cancelled_ride_obj = new Ride();
                $user_cancelled_ride_obj_result = $user_cancelled_ride_obj->get_cancelled_rides();
                echo json_encode($user_cancelled_ride_obj_result);
                break;
            }
        case "user_pending_rides": {
                $user_pending_ride_obj = new Ride();
                $user_pending_ride_obj_result = $user_pending_ride_obj->get_pending_rides();
                echo json_encode($user_pending_ride_obj_result);
                break;
            }

        case "user_all_rides": {
                $user_all_ride_obj = new Ride();
                $user_all_ride_obj_result = $user_all_ride_obj->get_all_rides();
                echo json_encode($user_all_ride_obj_result);
                break;
            }
        case "user_total_expenses": {
                $user_total_expense_obj = new Ride();
                $user_total_expense_obj_result = $user_total_expense_obj->get_total_expense();
                echo json_encode($user_total_expense_obj_result);

                break;
            }
        case "user_completed_rides": {
                $user_completed_ride_obj = new Ride();
                $user_completed_ride_obj_result = $user_completed_ride_obj->get_completed_rides();

                echo json_encode($user_completed_ride_obj_result);
                break;
            }
        case "view_detail": {
                $ride_id = $_POST["ride_id"];
                $user_ride_detail_obj = new Ride();
                $user_ride_detail_obj_result = $user_ride_detail_obj->get_ride_details($ride_id);
                echo json_encode($user_ride_detail_obj_result);
                break;
            }
        case "cancel_ride": {
                $cancel_id = $_POST["ride_id"];
                $cancel_ride_obj = new Ride();
                $cancel_ride_obj_result = $cancel_ride_obj->Cancel_ride($cancel_id);
                echo $cancel_ride_obj_result;
                break;
            }

        case "ride_requests": {
                $ride_request_obj = new Ride();
                $ride_request_obj_result  = $ride_request_obj->get_ride_requests();
                echo json_encode($ride_request_obj_result);
                break;
            }

        case "completed_rides": {
                $ride_completed_obj =  new Ride();
                $ride_completed_obj_result = $ride_completed_obj->get_all_completed_rides();
                echo json_encode($ride_completed_obj_result);
                break;
            }

        case "cancelled_rides": {
                $cancelled_rides_obj =  new Ride();
                $cancelled_rides_obj_result = $cancelled_rides_obj->get_all_cancelled_rides();
                echo json_encode($cancelled_rides_obj_result);
                break;
            }

        case "all_rides": {
                $all_rides_obj = new Ride();
                $all_rides_obj_result = $all_rides_obj->get_rides();
                echo json_encode($all_rides_obj_result);
                break;
            }
        case "all_users": {
                $all_users_obj = new User();
                $all_users_result = $all_users_obj->get_all_users();
                echo json_encode($all_users_result);
                break;
            }
        case "location_list": {
                $location_list_obj = new Location();
                $location_list_obj_result = $location_list_obj->get_location_list();
                echo json_encode($location_list_obj_result);
                break;
            }
        case "add_new_location": {
                break;
            }
        case  "approve_ride": {
                $approve_ride_id = $_POST['ride_id'];
                $approve_ride_obj = new Ride();
                $approve_ride_obj_result = $approve_ride_obj->Approve_ride($approve_ride_id);
                echo $approve_ride_obj_result;
                break;
            }
        case "sort_Table": {
                $order = $_POST["order"];
                $date_fare = $_POST["date_fare"];
                $sort_table_obj = new Ride();
                $sort_table_obj_result = $sort_table_obj->get_sorted_table($order, $date_fare);
                echo json_encode($sort_table_obj_result);
                break;
            }
    }
} else {
    die("You can not directly access");
}

// session_start();
// include "arrays.php";
// include "class_define.php";
// if (isset($_POST)) {

//     $pickup = $_POST["pickup"];
//     $dropup = $_POST["dropup"];
//     $cabtype = $_POST["cedtype"];
//     $luggage = isset($_POST["luggage"]) ? $_POST["luggage"] : "NOTALLOWED";
//     $_SESSION["pickup"] = $pickup;
//     $_SESSION["dropup"] = $dropup;
//     $_SESSION["cabtype"] = $cabtype;
//     $_SESSION["luggage"] = $luggage;

//     foreach (location as $key => $value) {
//         if ($pickup == $key) {
//             $distance_pickup = $value;
//         }
//     }

//     foreach (location as $key => $value) {
//         if ($dropup == $key) {
//             $distance_dropup = $value;
//         }
//     }

//     $total_distance = ($distance_dropup - $distance_pickup);

//     $obj = new CalculateFare();
//     $result = $obj->fare_Calc($total_distance, $cabtype, $luggage);

//     echo $result;
