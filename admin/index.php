<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["is_admin"] != 1) {
    die("You cannot access please login with valid credentials");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php include "header.php" ?>

    <div class="admin-panel-cards">

        <div id="ride_requests">
            <h3>Ride Requests</h3>
            <h2></h2>
        </div>

        <div id="completed_rides">
            <h3>Completed rides</h3>
            <h2></h2>

        </div>

        <div id="cancelled_rides">
            <h3>Cancelled Rides</h3>
            <h2></h2>
        </div>

        <div id="all_rides">
            <h3>All Rides</h3>
            <h2></h2>
        </div>

        <div id="all_users">
            <h3>All Users</h3>
            <h2></h2>
        </div>

        <div id="location_list">
            <h3>Location List</h3>
            <h2></h2>
        </div>

        <div id="add_new_location">
            <h3>Add New Location</h3>
        </div>

    </div>


    <div class="sorting_container">
        <label>Sort By : </label>
        <select id="iteration_order">
            <option value="aesc">ASCENDING</option>
            <option value="desc">DESCENDING</option>
        </select>

        <select id="date_fare">
            <option value="date">BY RIDE DATE</option>
            <option value="fare">BY RIDE FARE</option>
        </select>

        <input type="button" id="sort" value="Submit">
    </div>

    <div class="table_display">


        <table id="ride_requests_table">
            <thead id="ride_requests_table_head"></thead>
            <tbody id="ride_requests_table_body"></tbody>
        </table>



        <table id="completed_rides_table">
            <thead id="completed_rides_table_head"></thead>
            <tbody id="completed_rides_table_body"></tbody>
        </table>

        <table id="cancelled_rides_table">
            <thead id="cancelled_rides_head"></thead>
            <tbody id="cancelled_rides_body"></tbody>
        </table>



        <table id="all_rides_table">
            <thead id="all_rides_table_head"></thead>
            <tbody id="all_rides_table_body"></tbody>
        </table>

        <table id="all_users_table">
            <thead id="all_users_table_head"></thead>
            <tbody id="all_users_table_body"></tbody>
        </table>

        <table id="location_list_table">
            <thead id="location_list_table_head"></thead>
            <tbody id="location_list_table_body"></tbody>
        </table>

        <table id="add_new_location_table">
            <thead id="add_new_location_head"></thead>
            <tbody id="add_new_location_body"></tbody>
        </table>

    </div>




    <?php include "footer.php" ?>

</body>
<script>
    function ride_Dropdown() {
        document.getElementById("admin-ride-dropdown").classList.toggle("show");
    }
    window.onclick = function(e) {
        if (!e.target.matches('.admin-dropdown-btn')) {
            var ride_dropdown = document.getElementById("admin-ride-dropdown");
            if (ride_dropdown.classList.contains('show')) {
                ride_dropdown.classList.remove('show');
            }
        }
    }

    function users_Dropdown() {
        document.getElementById("admin-users-dropdown").classList.toggle("show");
    }
    window.onclick = function(e) {
        if (!e.target.matches('.admin-dropdown-btn')) {
            var ride_dropdown = document.getElementById("admin-users-dropdown");
            if (ride_dropdown.classList.contains('show')) {
                ride_dropdown.classList.remove('show');
            }
        }
    }

    function location_Dropdown() {
        document.getElementById("admin-location-dropdown").classList.toggle("show");
    }
    window.onclick = function(e) {
        if (!e.target.matches('.admin-dropdown-btn')) {
            var ride_dropdown = document.getElementById("admin-location-dropdown");
            if (ride_dropdown.classList.contains('show')) {
                ride_dropdown.classList.remove('show');
            }
        }
    }

    function account_Dropdown() {
        document.getElementById("admin-account-dropdown").classList.toggle("show");
    }
    window.onclick = function(e) {
        if (!e.target.matches('.admin-dropdown-btn')) {
            var ride_dropdown = document.getElementById("admin-account-dropdown");
            if (ride_dropdown.classList.contains('show')) {
                ride_dropdown.classList.remove('show');
            }
        }
    }
</script>
<script src="script.js"></script>

</html>