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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

</head>

<body>
    <?php include "includes/header.php"; ?>

    <div class="wrapper fadeInDown">
        <div id="signupContent">

            <form id="signup-form" method="POST" enctype="multipart/form-data">
                <h2 class="form-head">Sign UP PAGE!</h2>

                <input type="email" class="fadeIn" id="email" name="email" placeholder="Email" style=" background-color: #fff; border-bottom: 2px solid #5fbae9;">

                <!-- <input type="number" id= "emailotp" placeholder= "Please Enter otp to verify your mail"> -->

                <input type="text" class="fadeIn" id="name" name="name" placeholder="NAME">

                <input type="number" class="fadeIN" id="mobile" name="mobile" placeholder="Mobile">

                <!-- <input type="number" id= "mobileotp" placeholder= "Please Enter otp to verify your mobile"> -->

                <input type="password" class="fadeIn" id="password" name="password" placeholder="Password">

                <!-- <input type="file" class="fadein" id="file" name="file" placeholder="Upload image"> -->

                <button type="button" id="sign" name="signup" class="sign_UP">SIGN UP</button>
            </form>

        </div>
    </div>

    <?php include "includes/footer.php"; ?>

</body>
<script>
    $("#sign").on("click", function(e) {
        e.preventDefault();
        console.log("HEllo");
        let email=$("#email").val();
        let name = $("#name").val();
        let mobile = $("#mobile").val();
        let password = $("#password").val();
        $.ajax({
            type: "POST",
            url: "helper.php",
            data: {
                'email' : email,
                'name' : name,
                'mobile' : mobile,
                'password' : password,
                'action' : 'signup',
            },
            // data: $("#signup-form").serialize(),
            success: function(response) {
                console.log(response);
                if(response == "user already exist"){
                    alert(response);
                }else{
                $("#signup-form")[0].reset();
                 window.location = "login.php";
                }
            }
        });
    });
</script>

</html>