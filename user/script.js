$(document).ready(function() {

    //*******************************************Booking the Ride of the user ***************************** */

    $("#book-now").click(function() {
        let pickup = $("#user-pick").text();
        let dropup = $("#user-drop").text();
        let cabtype = $("#user-cabtype").text();
        let luggage = $("#user-luggage").text();
        let fare = $("#user-fare").text();
        let total_distance = $("#total_distance").text();
        $.ajax({
            type: "POST",
            url: "../helper.php",
            data: {
                pickup: pickup,
                dropup: dropup,
                cabtype: cabtype,
                luggage: luggage,
                fare: fare,
                total_distance: total_distance,
                action: "bookcab",
            },
            success: function(response) {
                $("#user-panel-modal").hide();
                alert(response);
            },
        });
    });

    Cancelled_rides_count();
    Completed_rides_count();
    Total_rides_count();


    //***********************Fetching  the pending rides table on default**************************** */

    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            'action': 'user_pending_rides',
        },
        success: function(response) {
            let pending_rides_result = JSON.parse(response);
            console.log(pending_rides_result);
            console.log(typeof(pending_rides_result));
            let pending_rides_count = pending_rides_result.length;
            $("#user_pending_rides h2").html(pending_rides_count);
            let keys = [];
            for (let k in pending_rides_result[0]) keys.push(k);
            console.log(keys);
            for (let i = 0; i < keys.length; i++) {
                $("#pending_ride_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (pending_rides_count !== 0) {
                $("#pending_ride_table_head").append("<th>" + "ACTION" + "</th>");
                $("#pending_ride_table_head").append("<th>" + "ACTION" + "</th>");

            }
            for (let i = 0; i < pending_rides_result.length; i++) {
                let row = $('<tr></tr>');
                let td1 = $('<td></td>').text(pending_rides_result[i]['ride_id']);
                let td2 = $('<td></td>').text(pending_rides_result[i]['from']);
                let td3 = $('<td></td>').text(pending_rides_result[i]['to']);
                let td5 = $('<td></td>').text(pending_rides_result[i]['total_fare']);
                let td6 = $('<td></td>').text(pending_rides_result[i]['luggage']);
                let td4 = $('<td></td>').text(pending_rides_result[i]['cab_type']);
                let td7 = $('<td></td>').append("<input type='submit' id='view_detail' value='View Details' onclick = 'View_Detail(" + pending_rides_result[i]['ride_id'] + ")' >");
                let td8 = $('<td></td>').append("<input type='submit' id='cancel_pending_ride' value='CANCEL' onclick = 'Cancel_ride(" + pending_rides_result[i]['ride_id'] + ")'>");
                row.append(td1, td2, td3, td5, td6, td4, td7, td8);
                $('#pending_ride_table_body').append(row);
            }
        }
    });
});


//************************fetching the Pending ride on click event **************************** */


$("#user_pending_rides").click(function(e) {

    $("#user_cancelled_ride_table").hide();
    $("#user_completed_ride_table").hide();
    $("#user_all_ride_table").hide();

    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            'action': 'user_pending_rides',
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#pending_ride_table").css("display", "none");
            let pending_rides_result = JSON.parse(response);
            console.log(pending_rides_result);
            console.log(typeof(pending_rides_result));
            let pending_rides_count = pending_rides_result.length;
            $("#user_pending_rides h2").html(pending_rides_count);
            let keys = [];
            for (let k in pending_rides_result[0]) keys.push(k);
            console.log(keys);
            for (let i = 0; i < keys.length; i++) {
                $("#pending_ride_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (pending_rides_count !== 0) {
                $("#pending_ride_table_head").append("<th>" + "ACTION" + "</th>");
                $("#pending_ride_table_head").append("<th>" + "ACTION" + "</th>");

            }
            for (let i = 0; i < pending_rides_result.length; i++) {
                let row = $('<tr></tr>');
                let td1 = $('<td></td>').text(pending_rides_result[i]['ride_id']);
                let td2 = $('<td></td>').text(pending_rides_result[i]['from']);
                let td3 = $('<td></td>').text(pending_rides_result[i]['to']);
                let td5 = $('<td></td>').text(pending_rides_result[i]['total_fare']);
                let td6 = $('<td></td>').text(pending_rides_result[i]['luggage']);
                let td4 = $('<td></td>').text(pending_rides_result[i]['cab_type']);
                let td7 = $('<td></td>').append("<input type='submit' id='view_detail' value='View Details' onclick = 'View_Detail(" + pending_rides_result[i]['ride_id'] + ")'>");
                let td8 = $('<td></td>').append("<input type='submit' id='cancel_pending_ride' value='CANCEL'onclick = 'Cancel_ride(" + pending_rides_result[i]['ride_id'] + ")'>");
                row.append(td1, td2, td3, td5, td6, td4, td7, td8);
                $("#pending_ride_table_body").append(row);
                $("#user_pending_ride_table").show();
                $("#pending_ride_table").show();
            }
        }
    });
});

/*************************showing the detail info on click View Detail Action button***************************/
function View_Detail(ride_id) {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            'ride_id': ride_id,
            'action': 'view_detail',
        },
        success: function(response) {
            $(".ride_modal").show();
            let user_ride_details = JSON.parse(response);
            console.log(user_ride_details);
            for (let k = 0; k < user_ride_details.length; k++) {
                $("#ride-date").html(user_ride_details[k]['ride_date']);
                $("#ride-pick").html(user_ride_details[k]['from']);
                $("#ride-drop").html(user_ride_details[k]['to']);
                $("#ride-cabtype").html(user_ride_details[k]['cab_type']);
                $("#ride-luggage").html(user_ride_details[k]['luggage']);
                $("#ride_distance").html(user_ride_details[k]['total_distance']);
                $("#ride-fare").html(user_ride_details[k]['total_fare']);
            }
        }
    });
}
$("#ride-modal-close").click(function() {
    $(".ride_modal").hide();
});


/************************Cancelling the pending ride on click cancel ride option ***************************** */
function Cancel_ride(ride_id) {
    if (confirm("You going to cancel this ride!!! Are u Sure You want to cancel this ride")) {
        $.ajax({
            type: "POST",
            url: "../helper.php",
            data: {
                'ride_id': ride_id,
                'action': 'cancel_ride'
            },
            success: function(response) {

                alert(response);
                $("#user_cancelled_ride_table").hide();
                $("#user_completed_ride_table").hide();
                $("#user_all_ride_table").hide();
                $.ajax({
                    type: "POST",
                    url: "../helper.php",
                    data: {
                        'action': 'user_pending_rides',
                    },
                    success: function(response) {
                        $("th").css("display", "none");
                        $("td").css("display", "none");
                        $("#pending_ride_table").css("display", "none");
                        let pending_rides_result = JSON.parse(response);
                        let pending_rides_count = pending_rides_result.length;
                        $("#user_pending_rides h2").html(pending_rides_count);
                        let keys = [];
                        for (let k in pending_rides_result[0]) keys.push(k);
                        for (let i = 0; i < keys.length; i++) {
                            $("#pending_ride_table_head").append("<th> " + keys[i] + " </th>");
                        }
                        if (pending_rides_count != 0) {
                            $("#pending_ride_table_head").append("<th>" + "ACTION" + "</th>");
                            $("#pending_ride_table_head").append("<th>" + "ACTION" + "</th>");

                        }

                        for (let i = 0; i < pending_rides_result.length; i++) {
                            let row = $('<tr></tr>');
                            let td1 = $('<td></td>').text(pending_rides_result[i]['ride_id']);
                            let td2 = $('<td></td>').text(pending_rides_result[i]['from']);
                            let td3 = $('<td></td>').text(pending_rides_result[i]['to']);
                            let td5 = $('<td></td>').text(pending_rides_result[i]['total_fare']);
                            let td6 = $('<td></td>').text(pending_rides_result[i]['luggage']);
                            let td4 = $('<td></td>').text(pending_rides_result[i]['cab_type']);
                            let td7 = $('<td></td>').append("<input type='submit' id='view_detail' value='View Details' onclick = 'View_Detail(" + pending_rides_result[i]['ride_id'] + ")' >");
                            let td8 = $('<td></td>').append("<input type='submit' id='cancel_pending_ride' value='CANCEL' onclick = 'Cancel_ride(" + pending_rides_result[i]['ride_id'] + ")'>");
                            row.append(td1, td2, td3, td5, td6, td4, td7, td8);
                            $('#pending_ride_table_body').append(row);
                            $("#user_pending_ride_table").show();
                        }
                    }
                });

            }
        });

    }

}

//*********************************Fetching the cancelled rides of the user *************************** */


$("#user_cancelled_rides").click(function(e) {
    $("#user_pending_ride_table").hide();
    $("#user_completed_ride_table").hide();
    $("#user_all_ride_table").hide();

    e.preventDefault();
    $("#user_pending_ride_table").hide();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            'action': 'user_cancelled_rides',
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            let cancelled_rides = JSON.parse(response);
            console.log(cancelled_rides);
            let cancelled_ride_count = cancelled_rides.length;
            $("#user_cancelled_rides h2").html(cancelled_ride_count);
            let keys = [];
            for (k in cancelled_rides[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#cancelled_ride_table_head").append("<th>" + keys[i] + "</th>");
            }
            if (cancelled_ride_count !== 0) {
                $("#cancelled_ride_table_head").append("<th>" + "ACTION" + "</th>");
            }

            for (let i = 0; i < cancelled_rides.length; i++) {
                let row = $('<tr></tr>');
                let td1 = $('<td></td>').text(cancelled_rides[i]['ride_id']);
                let td2 = $('<td></td>').text(cancelled_rides[i]['from']);
                let td3 = $('<td></td>').text(cancelled_rides[i]['to']);
                let td5 = $('<td></td>').text(cancelled_rides[i]['total_fare']);
                let td6 = $('<td></td>').text(cancelled_rides[i]['luggage']);
                let td4 = $('<td></td>').text(cancelled_rides[i]['cab_type']);
                let td7 = $('<td></td>').append("<input type='submit' id='view' value='View Details'  onclick = 'View_Detail(" + cancelled_rides[i]['ride_id'] + ")'>");
                row.append(td1, td2, td3, td5, td6, td4, td7);
                $("#cancelled_ride_table_body").append(row);
                $("#user_cancelled_ride_table").show();
            }
        }
    });
});

//*******************Diplaying the  total Expense ******************** */



$("#user_total_expenses").click(function(e) {
    $("#user_pending_ride_table").hide();
    $("#user_cancelled_ride_table").hide();
    $("#user_all_ride_table").hide();

    e.preventDefault();
    $("#user_cancelled_ride_table").hide();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            "action": "user_total_expenses",
        },
        success: function(response) {
            let expense = JSON.parse(response);
            let Total_fare = expense.Total_expense;
            $("#user_total_expenses h2").html(Total_fare + " Rs/-");



            //*********************fetching the all the completed Rides ************************ */


            $.ajax({
                type: "POST",
                url: "../helper.php",
                data: {
                    "action": "user_completed_rides",
                },
                success: function(response) {
                    $("th").css("display", "none");
                    $("td").css("display", "none");
                    console.log(JSON.parse(response));
                    let completed_rides = JSON.parse(response);
                    let completed_rides_count = completed_rides.length;
                    $("#user_total_expenses span").html("Completed Rides " + completed_rides_count);
                    let keys = [];
                    for (k in completed_rides[0]) keys.push(k);
                    for (let i = 0; i < keys.length; i++) {
                        $("#completed_ride_table_head").append("<th>" + keys[i] + "</th>");
                    }
                    $("#completed_ride_table_head").append("<th>ACTION</th>");
                    for (let i = 0; i < completed_rides.length; i++) {
                        let row = $('<tr></tr>');
                        let td1 = $('<td></td>').text(completed_rides[i]['ride_id']);
                        let td2 = $('<td></td>').text(completed_rides[i]['from']);
                        let td3 = $('<td></td>').text(completed_rides[i]['to']);
                        let td5 = $('<td></td>').text(completed_rides[i]['total_fare']);
                        let td6 = $('<td></td>').text(completed_rides[i]['luggage']);
                        let td4 = $('<td></td>').text(completed_rides[i]['cab_type']);
                        let td7 = $('<td></td>').append("<input type='submit' id='view' value='View Details' onclick = 'View_Detail(" + completed_rides[i]['ride_id'] + ")' >");
                        row.append(td1, td2, td3, td5, td6, td4, td7);
                        $("#completed_ride_table_body").append(row);
                        $("#user_completed_ride_table").show();
                    }
                }
            });
        }
    });
});



// ***************** Fetching all the Rides of the User****************************


$("#user_all_rides").click(function(e) {
    $("#user_pending_ride_table").hide();
    $("#user_cancelled_ride_table").hide();
    $("#user_completed_ride_table").hide();

    e.preventDefault();
    $("#user_completed_ride_table").hide()
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            "action": "user_all_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            let all_rides = JSON.parse(response);
            console.log(all_rides);
            let all_ride_count = all_rides.length;
            $("#user_all_rides h2").html(all_ride_count);
            let keys = [];
            for (k in all_rides[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#all_ride_table_head").append("<th>" + keys[i] + "</th>");
            }
            $("#all_ride_table_head").append("<th>ACTION</th>");
            $("#all_ride_table_head").append("<th>ACTION</th>");
            for (let i = 0; i < all_rides.length; i++) {
                let row = $('<tr></tr>');
                let td1 = $('<td></td>').text(all_rides[i]['ride_id']);
                let td2 = $('<td></td>').text(all_rides[i]['from']);
                let td3 = $('<td></td>').text(all_rides[i]['to']);
                let td5 = $('<td></td>').text(all_rides[i]['total_fare']);
                let td6 = $('<td></td>').text(all_rides[i]['luggage']);
                let td4 = $('<td></td>').text(all_rides[i]['cab_type']);
                let td7 = $('<td></td>').append("<input type='submit' id='view' value='View Details' onclick = 'View_Detail(" + all_rides[i]['ride_id'] + ")'>");

                var td8;
                if (all_rides[i]['status'] == 2) {
                    td8 = $('<td></td>').append("<input type='submit' id='cancel_pending_ride' value='CANCEL'onclick = 'Cancel_ride(" + all_rides[i]['ride_id'] + ")'>");
                } else {
                    td8 = $('<td></td>').append("COMPLETED");
                }
                row.append(td1, td2, td3, td5, td6, td4, td7, td8);
                $("#all_ride_table_body").append(row);
                $("#user_all_ride_table").show();
            }
        }
    });
});



function Cancelled_rides_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            'action': 'user_cancelled_rides',
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            let cancelled_rides = JSON.parse(response);
            console.log(cancelled_rides);
            let cancelled_ride_count = cancelled_rides.length;
            $("#user_cancelled_rides h2").html(cancelled_ride_count);
        }
    });
}

function Completed_rides_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            "action": "user_total_expenses",
        },
        success: function(response) {
            let expense = JSON.parse(response);
            let Total_fare = expense.Total_expense;
            $("#user_total_expenses h2").html(Total_fare + " Rs/-");
        }
    });

    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            "action": "user_completed_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            console.log(JSON.parse(response));
            let completed_rides = JSON.parse(response);
            let completed_rides_count = completed_rides.length;
            $("#user_total_expenses span").html("Completed Rides " + completed_rides_count);
        }
    });

}

function Total_rides_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            "action": "user_all_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            let all_rides = JSON.parse(response);
            console.log(all_rides);
            let all_ride_count = all_rides.length;
            $("#user_all_rides h2").html(all_ride_count);
        }
    });
}