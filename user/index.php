<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Pannel</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php include "header.php" ?>
    <!-- <h2 style=" color: white;">welcome User<?php $_SESSION["user"]["name"]; ?></h2> -->

    <div id="user-panel-modal" class="user_modal">

        <div class="user-modal-content">
            <div class="modal-header">

                <h2>Fare Details</h2>
                <span id="user-modal-close" class="user-modal-close close">&times;</span>
            </div>

            <div class="modal-body">
                <h2>Pick up : <span id="user-pick"> <?php echo $_SESSION["modal_Result"][0] ?></span></h2>
                <h2>Drop up: <span id="user-drop"> <?php echo $_SESSION["modal_Result"][1] ?></span></h2>
                <h2>Cab Type :<span id="user-cabtype"> <?php echo $_SESSION["modal_Result"][2] ?></span></h2>
                <h2>Luggage :<span id="user-luggage"> <?php echo $_SESSION["modal_Result"][3] ?></span> kg</h2>
                <h2>Total distance : <span id="total_distance"> <?php echo  $_SESSION["modal_Result"][5] ?></span> </h2>
                <h2>Fare : <span id="user-fare"> <?php echo $_SESSION["modal_Result"][4] ?></span> Rs/-</h2>

            </div>

            <div class="modal-footer">
                <div class="modal_foot_btn">
                    <a href="#" id="cancel-booking" class="topnav-right ">CANCEL</a>
                    <button type="button" id="book-now" class="topnav-right ">BOOK NOW</button>
                </div>
            </div>
        </div>

    </div>

    <div id="pending_ride_table">
        </div>

    <div class="user-panel-card">

        <div id="user_pending_rides">
            <h3>Pending Rides</h3>
            <h2></h2>
        </div>


        <div id="user_cancelled_rides">
            <h3>Cancelled Rides</h3>
            <h2></h2>
        </div>

        <div id="user_total_expenses">
            <h3>Total Expenses</h3>
            <h2></h2>
            <span></span>
        </div>

        <div id="user_all_rides">
            <h3>All Rides</h3>
            <h2></h2>
        </div>

    </div>


    <!-- Displaying  the data fetched from the tab action -->


    <!-- Displaying the pending rides -->
    <div class="table_display">


        <table id="user_pending_ride_table">
            <thead id="pending_ride_table_head"></thead>
            <tbody id="pending_ride_table_body"></tbody>
        </table>



        <table id="user_cancelled_ride_table">
            <thead id="cancelled_ride_table_head"></thead>
            <tbody id="cancelled_ride_table_body"></tbody>
        </table>

        <table id="user_completed_ride_table">
            <thead id="completed_ride_table_head"></thead>
            <tbody id="completed_ride_table_body"></tbody>
        </table>



        <table id="user_all_ride_table">
            <thead id="all_ride_table_head"></thead>
            <tbody id="all_ride_table_body"></tbody>
        </table>

    </div>



    <div id="ride_detail_modal" class="ride_modal">

        <div class="ride_modal_content">
            <div class="modal-header">

                <h2>Fare Details</h2>
                <span id="ride-modal-close" class="user-modal-close close">&times;</span>
            </div>

            <div id="ride_modal_body" class="modal-body">
                <h2>Your Ride Details</h2>
                <h2>Date of Journey : <span id="ride-date"> </span></h2>
                <h2>Pick up : <span id="ride-pick"> </span></h2>
                <h2>Drop up: <span id="ride-drop"></span></h2>
                <h2>Cab Type :<span id="ride-cabtype"> </span></h2>
                <h2>Luggage :<span id="ride-luggage"></span> kg</h2>
                <h2>Total distance : <span id="ride_distance"> </span> </h2>
                <h2>Fare : <span id="ride-fare"> </span> Rs/-</h2>


            </div>

            <div class="modal-footer">
                <!-- <div class="modal_foot_btn">
                    <a href="#" id="cancel-booking" class="topnav-right ">CANCEL</a>
                    <button type="button" id="book-now" class="topnav-right ">BOOK NOW</button>
                </div> -->
            </div>
        </div>

    </div>









    <?php include "footer.php" ?>

</body>


<script>
    $("#user-modal-close").click(function() {
        $("#user-panel-modal").hide();
    });
</script>
<script src="script.js"></script>

</html>