<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEDCAB</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
    <?php include "includes/header.php"; ?>
    <div class="wrapper fadeInDown">
        <div id="login_formContent">
            <!-- Tabs Titles -->
            <h2 class="form-head">Login</h2>
            <!-- Icon -->
            <div class="fadeIn first">
                <img src="./images/user_icon.png" id="login-icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form id="login-form">
                <input type="text" id="email" class="fadeIn second" name="email" placeholder="Username">
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="Password">
                <input type="button" id="log_in" class="fadeIn fourth" name="login" value="Log In">

            </form>

            <!-- Remind Passowrd -->
            <div id="login_formFooter">
                <a id="forget-pass" class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
<script>
    $(document).ready(function() {
        $("#log_in").click(function(e) {
            e.preventDefault();
            let email = $("#email").val();
            let password = $("#password").val();
            $.ajax({
                type: "POST",
                url: "helper.php",
                data: {
                    'email': email,
                    'password': password,
                    'action': 'login',
                },

                success: function(response) {
                    console.log(response);
                    if (response == 1) {
                        window.location = "admin/index.php";
                    } else if (response == 0) {
                        window.location = "user/index.php";
                    } else if (response == -1) {
                        alert("Your Account has been pur on hold due to some illegal actions")
                    } else {
                        alert("Account doesn't Exist! please Sign up First");
                        window.location = "signup.php";
                    }
                }
            });
        });
    });
</script>

</html>