<?php 

if (!isset($_SESSION["user"]) || $_SESSION["user"]["status"] != 1) {
    die("You cannot access please login with valid credentials");
}
?>
<header>
        <div class="topnav" id="mytopnav">
            <a href="index.php" id="logo" class="topnav-left">CED&nbsp;<span class="cab">CAB</span></a>
            <a href="#" id="home" class="active topnav-left">Home</a>
            <a href="logout.php" id="logout" class="topnav-right">LOG OUT</a>
            <h2 style="color: black; margin:0px; font-size:25px; padding-right: 10px" 
             class="topnav-right"> Hello <?php  echo $_SESSION["user"]["name"]; ?></h2>
            <a href="javascript:void(0);" class="icon topnav-right" onclick="top_nav()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>