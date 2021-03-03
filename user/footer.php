<?php 

if (!isset($_SESSION["user"]) || $_SESSION["user"]["status"] != 1) {
    die("You cannot access please login with valid credentials");
 }
?>
<footer id="footer">

<div class="sociallinks">
    <i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
    <i class="fa fa-twitter-square fa-2x px-5" id="icons" aria-hidden="true"></i>
    <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>

</div>

<div class="footer-logo">
    <h1>Ced Cabs</h1>
</div>

<div class="footer-right-links">
    <a href="#contact" id="contact" class="topnav-right">Contact Us</a>
    
</div>
</footer>