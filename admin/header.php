<?php

if (!isset($_SESSION["user"]) || $_SESSION["user"]["is_admin"] != 1) {
    die("You cannot access please login with valid credentials");
}
?>
<header>
    <div class="topnav" id="mytopnav">
        <a href="index.php" id="logo" class="topnav-left">CED&nbsp;<span class="cab">CAB</span></a>
        <a href="#" id="home" class="active topnav-left">Home</a>

        <div class="admin-pannel-dropdown">
            <button id="rides" class="topnav-left admin-dropdown-btn" onclick="ride_Dropdown()">Rides
                <i class="fa fa-caret-down"></i></button>
            <div id="admin-ride-dropdown" class="admin-dropdown-content">
                <a href="#">Ride Requests</a>
                <a href="#">Completed Rides</a>
                <a href="#">Canceled Rides</a>
                <a href="#">All Rides</a>
            </div>
        </div>

        <div class="admin-pannel-dropdown">
            <button id="users" class="topnav-left admin-dropdown-btn" onclick="users_Dropdown()">Users
                <i class="fa fa-caret-down"></i> </button>
            <div id="admin-users-dropdown" class="admin-dropdown-content">
                <a href="#">All Users</a> 
            </div>
        </div>

        <div  class="admin-pannel-dropdown">
            <button id="location" class="topnav-left admin-dropdown-btn" onclick="location_Dropdown()">Location
                <i class="fa fa-caret-down"></i> </button>
            <div id="admin-location-dropdown" class="admin-dropdown-content">
                <a href="#">Location List</a> 
                <a href="#">Add New Location</a>
            </div>
        </div>

        <div  class="admin-pannel-dropdown">
            <button id="account" class="topnav-left admin-dropdown-btn" onclick="account_Dropdown()">Account
                <i class="fa fa-caret-down"></i> </button>
            <div id="admin-account-dropdown" class="admin-dropdown-content">
                <a href="#">Change Password</a>
                <a href="#">Edit Password</a> 
            </div>
        </div>

        <a href="logout.php" id="logout" class="topnav-right">LOG OUT</a>
        <!-- <a href="#contact" id="contact" class="topnav-right">Contact Us</a>
        <a href="#about" id="about" class="topnav-right">About Us</a> -->
        <h2 style="color: black; margin:0px; font-size:25px; padding-right: 10px"  class="topnav-right"> Hello Admin! <?php $_SESSION["user"]["name"]; ?></h2>
        <a href="javascript:void(0);" class="icon topnav-right" onclick="top_nav()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</header>