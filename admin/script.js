$(document).ready(function() {
    /*   Defualt function calls on page loaa */
    ride_request_count();
    completed_rides_count();
    cancelled_rides_count();
    all_rides_count();
    all_users_count();
    location_list_count();

    /* ******************    Default table display on page load    *************** */
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "ride_requests",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#ride_requests_table").css("display", "none");
            let pending_rides_result = JSON.parse(response);
            let pending_rides_count = pending_rides_result.length;
            $("#ride_requests h2").html(pending_rides_count);
            let keys = [];
            for (let k in pending_rides_result[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#ride_requests_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (pending_rides_count !== 0) {
                $("#ride_requests_table_head").append("<th>" + "ACTION" + "</th>");
            }

            for (let i = 0; i < pending_rides_result.length; i++) {
                let row = $("<tr></tr>");
                let td1 = $("<td></td>").text(pending_rides_result[i]["ride_id"]);
                let td2 = $("<td></td>").text(pending_rides_result[i]["from"]);
                let td3 = $("<td></td>").text(pending_rides_result[i]["to"]);
                let td5 = $("<td></td>").text(pending_rides_result[i]["total_fare"]);
                let td6 = $("<td></td>").text(pending_rides_result[i]["luggage"]);
                let td4 = $("<td></td>").text(pending_rides_result[i]["cab_type"]);
                let td7 = $("<td></td>").append(
                    "<input type='submit' value='APPROVE' onclick = 'Approve_ride(" +
                    pending_rides_result[i]["ride_id"] +
                    ")' >"
                );
                row.append(td1, td2, td3, td5, td6, td4, td7);
                $("#ride_requests_table_body").append(row);
                $("#ride_requests_table").show();
            }
        },
    });
});

/********************   displaying table on click event ********************** */

//**********   pending rides or ride request ****************

$("#ride_requests").click(function() {
    $("#ride_requests_table").hide();
    $("#completed_rides_table").hide();
    $("#cancelled_rides_table").hide();
    $("#all_rides_table").hide();
    $("#all_users_table").hide();
    $("#location_list_table").hide();

    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "ride_requests",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#ride_requests_table").css("display", "none");
            let pending_rides_result = JSON.parse(response);
            let pending_rides_count = pending_rides_result.length;
            $("#ride_requests h2").html(pending_rides_count);
            let keys = [];
            for (let k in pending_rides_result[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#ride_requests_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (pending_rides_count !== 0) {
                $("#ride_requests_table_head").append("<th>" + "ACTION" + "</th>");
            }

            for (let i = 0; i < pending_rides_result.length; i++) {
                let row = $("<tr></tr>");
                let td1 = $("<td></td>").text(pending_rides_result[i]["ride_id"]);
                let td2 = $("<td></td>").text(pending_rides_result[i]["from"]);
                let td3 = $("<td></td>").text(pending_rides_result[i]["to"]);
                let td5 = $("<td></td>").text(pending_rides_result[i]["total_fare"]);
                let td6 = $("<td></td>").text(pending_rides_result[i]["luggage"]);
                let td4 = $("<td></td>").text(pending_rides_result[i]["cab_type"]);
                let td7 = $("<td></td>").append(
                    "<input type='submit' value='APPROVE' onclick = 'Approve_ride(" +
                    pending_rides_result[i]["ride_id"] +
                    ")' >"
                );
                row.append(td1, td2, td3, td5, td6, td4, td7);
                $("#ride_requests_table_body").append(row);
                $("#ride_requests_table").show();
            }
        },
    });
});

/************   Approving the pending rides   **************/

function Approve_ride(ride_id) {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            ride_id: ride_id,
            action: "approve_ride",
        },
        success: function(response) {
            alert(response);
            location.reload();
        },
    });
}

//************* completed ride table **************

$("#completed_rides").click(function() {
    $("#ride_requests_table").hide();
    $("#completed_rides_table").hide();
    $("#cancelled_rides_table").hide();
    $("#all_rides_table").hide();
    $("#all_users_table").hide();
    $("#location_list_table").hide();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "completed_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#completed_rides_table").css("display", "none");
            let completed_ride_result = JSON.parse(response);
            let completed_ride_count = completed_ride_result.length;
            $("#completed_rides h2").html(completed_ride_count);

            let keys = [];
            for (let k in completed_ride_result[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#completed_rides_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (completed_ride_count !== 0) {
                $("#completed_rides_table_head").append("<th>" + "ACTION" + "</th>");
            }

            for (let i = 0; i < completed_ride_count; i++) {
                let row = $("<tr></tr>");
                let td1 = $("<td></td>").text(completed_ride_result[i]["ride_id"]);
                let td2 = $("<td></td>").text(completed_ride_result[i]["from"]);
                let td3 = $("<td></td>").text(completed_ride_result[i]["to"]);
                let td5 = $("<td></td>").text(completed_ride_result[i]["total_fare"]);
                let td6 = $("<td></td>").text(completed_ride_result[i]["luggage"]);
                let td4 = $("<td></td>").text(completed_ride_result[i]["cab_type"]);
                let td7 = $("<td></td>").append(
                    "<input type='submit' value='VIEW DETAILS' onclick = 'View_Detail(" +
                    completed_ride_result[i]["ride_id"] +
                    ")' >"
                );
                row.append(td1, td2, td3, td5, td6, td4, td7);
                $("#completed_rides_table_body").append(row);
                $("#completed_rides_table").show();
            }
        },
    });
});

//***********Cancelled ride table ****************

$("#cancelled_rides").click(function() {
    $("#ride_requests_table").hide();
    $("#completed_rides_table").hide();
    $("#cancelled_rides_table").hide();
    $("#all_rides_table").hide();
    $("#all_users_table").hide();
    $("#location_list_table").hide();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "cancelled_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#cancelled_rides_table").css("display", "none");
            let cancelled_ride_result = JSON.parse(response);
            let cancelled_ride_count = cancelled_ride_result.length;
            $("#cancelled_rides h2").html(cancelled_ride_count);

            let keys = [];
            for (let k in cancelled_ride_result[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#cancelled_rides_head").append("<th> " + keys[i] + " </th>");
            }
            if (cancelled_ride_count !== 0) {
                $("#cancelled_rides_head").append("<th>" + "ACTION" + "</th>");
            }

            for (let i = 0; i < cancelled_ride_count; i++) {
                let row = $("<tr></tr>");
                let td1 = $("<td></td>").text(cancelled_ride_result[i]["ride_id"]);
                let td2 = $("<td></td>").text(cancelled_ride_result[i]["from"]);
                let td3 = $("<td></td>").text(cancelled_ride_result[i]["to"]);
                let td5 = $("<td></td>").text(cancelled_ride_result[i]["total_fare"]);
                let td6 = $("<td></td>").text(cancelled_ride_result[i]["luggage"]);
                let td4 = $("<td></td>").text(cancelled_ride_result[i]["cab_type"]);
                let td7 = $("<td></td>").append(
                    "<input type='submit' value='VIEW DETAILS' onclick = 'View_Detail(" +
                    cancelled_ride_result[i]["ride_id"] +
                    ")' >"
                );
                row.append(td1, td2, td3, td5, td6, td4, td7);
                $("#cancelled_rides_body").append(row);
                $("#cancelled_rides_table").show();
            }
        },
    });
});

// ****************all rides *********************

$("#all_rides").click(function() {
    $("#ride_requests_table").hide();
    $("#completed_rides_table").hide();
    $("#cancelled_rides_table").hide();
    $("#all_rides_table").hide();
    $("#all_users_table").hide();
    $("#location_list_table").hide();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "all_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#all_rides_table").css("display", "none");
            let all_rides_result = JSON.parse(response);
            let all_rides_count = all_rides_result.length;
            $("#all_rides h2").html(all_rides_count);

            let keys = [];
            for (let k in all_rides_result[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#all_rides_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (all_rides_count !== 0) {
                $("#all_rides_table_head").append("<th>" + "ACTION" + "</th>");
            }

            for (let i = 0; i < all_rides_count; i++) {
                let row = $("<tr></tr>");
                let td1 = $("<td></td>").text(all_rides_result[i]["ride_id"]);
                let td2 = $("<td></td>").text(all_rides_result[i]["from"]);
                let td3 = $("<td></td>").text(all_rides_result[i]["to"]);
                let td5 = $("<td></td>").text(all_rides_result[i]["total_fare"]);
                let td6 = $("<td></td>").text(all_rides_result[i]["luggage"]);
                let td4 = $("<td></td>").text(all_rides_result[i]["cab_type"]);
                let td7 = $("<td></td>").append(
                    "<input type='submit' value='VIEW DETAILS' onclick = 'View_Detail(" +
                    all_rides_result[i]["ride_id"] +
                    ")' >"
                );
                row.append(td1, td2, td3, td5, td6, td4, td7);
                $("#all_rides_table_body").append(row);
                $("#all_rides_table").show();
            }
        },
    });
});

//****************  list of all users*****************

$("#all_users").click(function() {
    $("#ride_requests_table").hide();
    $("#completed_rides_table").hide();
    $("#cancelled_rides_table").hide();
    $("#all_rides_table").hide();
    $("#all_users_table").hide();
    $("#location_list_table").hide();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "all_users",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#all_users_table").css("display", "none");
            let all_users = JSON.parse(response);
            let all_users_count = all_users.length;
            $("#all_users h2").html(all_users_count);

            let keys = [];
            for (let k in all_users[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#all_users_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (all_users_count !== 0) {
                $("#all_users_table_head").append("<th>" + "ACTION" + "</th>");
            }
            for (let i = 0; i < all_users_count; i++) {
                let row = $("<tr></tr>");
                let td0 = $("<td></td>").text(all_users[i]["user_id"]);
                let td1 = $("<td></td>").text(all_users[i]["email_id"]);
                let td2 = $("<td></td>").text(all_users[i]["name"]);
                let td3 = $("<td></td>").text(all_users[i]["dateofsignup"]);
                let td4 = $("<td></td>").text(all_users[i]["mobile"]);
                let td5 = $("<td></td>").text(all_users[i]["status"]);
                let td6 = $("<td></td>").append(
                    "<input type='submit' value='VIEW DETAILS' onclick = 'View_Detail(" +
                    all_users[i]["ride_id"] +
                    ")' >"
                );
                row.append(td0, td1, td2, td3, td4, td5, td6);
                $("#all_users_table_body").append(row);
                $("#all_users_table").show();
            }
        },
    });
});

// location list available ******************

$("#location_list").click(function() {
    $("#ride_requests_table").hide();
    $("#completed_rides_table").hide();
    $("#cancelled_rides_table").hide();
    $("#all_rides_table").hide();
    $("#all_users_table").hide();
    $("#location_list_table").hide();
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "location_list",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#location_list_table").css("display", "none");
            let location_list = JSON.parse(response);
            let location_list_count = location_list.length;
            $("#location_list h2").html(location_list_count);

            let keys = [];
            for (let k in location_list[0]) keys.push(k);
            for (let i = 0; i < keys.length; i++) {
                $("#location_list_table_head").append("<th> " + keys[i] + " </th>");
            }
            if (location_list_count !== 0) {
                $("#location_list_table_head").append("<th>" + "ACTION" + "</th>");
            }
            console.log(location_list[0]);
            for (let i = 0; i < location_list_count; i++) {
                let row = $("<tr></tr>");
                let td1 = $("<td></td>").text(location_list[i]["name"]);
                let td2 = $("<td></td>").text(location_list[i]["distance"]);
                let td3 = $("<td></td>").text(location_list[i]["is_available"]);
                let td4 = $("<td></td>").append(
                    "<input type='submit' value='VIEW DETAILS' onclick = 'View_Detail(" +
                    location_list[i]["ride_id"] +
                    ")' >"
                );
                row.append(td1, td2, td3, td4);
                $("#location_list_table_body").append(row);
                $("#location_list_table").show();
            }
        },
    });
});

/*********************   function which will execute by default on page load ***************/

function ride_request_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "ride_requests",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#ride_requests_table").css("display", "none");
            let pending_rides_result = JSON.parse(response);
            let pending_rides_count = pending_rides_result.length;
            $("#ride_requests h2").html(pending_rides_count);
        },
    });
}

function completed_rides_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "completed_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#completed_rides_table").css("display", "none");
            let completed_ride_result = JSON.parse(response);
            let completed_ride_count = completed_ride_result.length;
            $("#completed_rides h2").html(completed_ride_count);
        },
    });
}

function cancelled_rides_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "cancelled_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#cancelled_rides_table").css("display", "none");
            let cancelled_ride_result = JSON.parse(response);
            let cancelled_ride_count = cancelled_ride_result.length;
            $("#cancelled_rides h2").html(cancelled_ride_count);
        },
    });
}

function all_rides_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "all_rides",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#all_rides_table").css("display", "none");
            let all_rides_result = JSON.parse(response);
            let all_rides_count = all_rides_result.length;
            $("#all_rides h2").html(all_rides_count);
        },
    });
}

function all_users_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "all_users",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#all_users_table").css("display", "none");
            let all_users = JSON.parse(response);
            let all_users_count = all_users.length;
            $("#all_users h2").html(all_users_count);
        },
    });
}

function location_list_count() {
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            action: "location_list",
        },
        success: function(response) {
            $("th").css("display", "none");
            $("td").css("display", "none");
            $("#location_list_table").css("display", "none");
            let location_list = JSON.parse(response);
            let location_list_count = location_list.length;
            $("#location_list h2").html(location_list_count);
        },
    });
}

/*************Sorting the tables *****************/
$("#sort").click(function() {
    let order = $("#iteration_order").val();
    let date_fare = $("#date_fare").val();

    console.log(order);
    console.log(date_fare);
    $.ajax({
        type: "POST",
        url: "../helper.php",
        data: {
            'order': order,
            'date_fare': date_fare,
            'action': 'sort_Table',
        },
        success: function(response) {
            console.log(response);
        }
    });
});