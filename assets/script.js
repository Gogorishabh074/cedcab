function top_nav() {
    var x = document.getElementById("mytopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

$(document).ready(function() {
    dropdown();
    $("#cabtype").on("change", function() {
        if (this.value == "CED MICRO") {
            $("#luggage").prop("disabled", true);
            $("#luggage").val("");
            $("#luggage").attr("placeholder", "No Luggage Cost");
        } else {
            $("#luggage").prop("disabled", false);
            $("#luggage").attr("placeholder", "Enter Luggage in kg");
        }
    });

    $("#farecalc").click(function() {
        let pickup_location = $("#pickup option:selected").text();
        let pickup = $("#pickup").val();
        let dropup_location = $("#dropup option:selected").text();
        let dropup = $("#dropup").val();
        let cabtype = $("#cabtype").val();
        let luggage = $("#luggage").val();


        $.ajax({
            type: "POST",
            url: "helper.php",
            dataType: "html",
            data: {
                "pickup_location": pickup_location,
                "pickup": pickup,
                "dropup_location": dropup_location,
                "dropup": dropup,
                "cabtype": cabtype,
                "luggage": luggage,
                "action": "fare_calculation",

            },
            success: function(response) {
                var modal_result = JSON.parse(response);
                console.log(modal_result);
                $("#pick").html(modal_result[0]);
                $("#drop").html(modal_result[1]);
                $("#cab-type").html(modal_result[2]);
                $("#luggage_in_kg").html(modal_result[3] + " kg");
                $("#fare_detail").html(modal_result[4] + " Rs/-");
                $("#mymodal").show();
                $(".close").click(function() {
                    $("#mymodal").hide();
                });
            },
        });
    });
});

function dropdown() {
    $.ajax({
        url: "helper.php",
        type: "POST",
        data: {
            action: "pickup",
        },
        success: function(response) {
            // console.log(response);
            var pickup_result = JSON.parse(response);
            for (let i = 0; i < pickup_result.length; i++) {
                // console.log(pickup_result[i]);
                $("#pickup").append(
                    $("<option>")
                    .val(pickup_result[i]["distance"])
                    .text(pickup_result[i]["name"])
                );
                $("#dropup").append(
                    $("<option>")
                    .val(pickup_result[i]["distance"])
                    .text(pickup_result[i]["name"])
                );
            }
        },
    });
}

function showdrop(e) {
    $("select#dropup")
        .find("option")
        .each(function() {
            if ($(this).val() == e.value) {
                $("select#dropup option[value=" + e.value + "]").each(function() {
                    $(this).remove();
                });
            }
        });
}