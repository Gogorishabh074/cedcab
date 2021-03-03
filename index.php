<?php
session_start();
include "arrays.php";
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

</head>

<body>
    <?php include "includes/header.php"; ?>
    <div class="booking">
        <form id="bookingform">
            <p>CITY TAXI</p>
            <hr>
            <h3>Your Everyday Tarvel Partner</h4>
                <h4>AC Cabs For Point To Point Travel</h5>


                    <div class="input-container">
                        <label>PICKUP</label>
                        <select name="pickup" id="pickup">
                            <option>PICKUP Location</option>
                            
                        </select>
                    </div>

                    <div class="input-container">
                        <label>DROP</label>
                        <select name="dropup" id="dropup">
                            <option>DROP Location</option>
                           
                        </select>
                    </div>

                    <div class="input-container">
                        <label>CAB TYPE</label>
                        <select name="cedtype" id="cabtype" class="custom-select type">
                            <option value="select_cab_type">Select CAB Type </option>
                            <?php
                            $temp = count($cedType);
                            for ($i = 0; $i < $temp; $i++) {
                            ?>
                                <option value="<?php echo $cedType[$i]; ?>"> <?php echo $cedType[$i]; ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>

                    <div class="input-container">
                        <label>Luggage</label>
                        <input type="number" id="luggage" name="luggage" placeholder="Input Luggage in Kg">
                    </div>

                    <div class="fare-button">
                        <button id="farecalc" name="submit" type="button">Calculate Fare</button>
                    </div>

        </form>
    </div>

    <div id="mymodal" class="modal">

        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Fare Details</h2>
            </div>

            <div class="modal-body">
                <h2>Pick up : <span id="pick"></span> </h2>
                <h2>Drop up: <span id="drop"></span> </h2>
                <h2>Cab Type :<span id="cab-type"></span> </h2>
                <h2>Luggage :<span id="luggage_in_kg"></span> </h2>
                <h2>Fare : <span id="fare_detail"></span> </p>
            </div>

            <div class="modal-footer">
                <div class="modal_foot_btn">
                    <a href="#" id="cancel-booking" class="topnav-right ">CANCEL</a>
                    <a href="login.php" id="book-cab" class="topnav-right ">BOOK CAB</a>
                </div>
            </div>
        </div>

    </div>
    
    <?php include "includes/footer.php"; ?>
    <script src="assets/script.js">

    </script>

</body>

</html>