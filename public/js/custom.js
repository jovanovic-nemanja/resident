$(function() {
    "use strict";

    $("#duration").change(function() {
        var sel_val = $(this).val();

        if (sel_val == 1) {
            // Daily
            $("#Daily_area").show();
            $("#Weekly_area").hide();
            $("#Monthly_area").hide();
        }
        if (sel_val == 2) {
            //Weekly
            $("#Daily_area").hide();
            $("#Weekly_area").show();
            $("#Monthly_area").hide();
        }
        if (sel_val == 3) {
            //Monthly
            $("#Daily_area").hide();
            $("#Weekly_area").hide();
            $("#Monthly_area").show();
        }
    });

    $("#types").change(function() {
        var typeID = $(this).val();
        var nurseVal = $("#nurse").val();

        var href = $("#env_domain_url").val();
        window.location.href =
            href + "/indexbyfilter?type=" + typeID + "&user_id=" + nurseVal;
    });

    $("#nurse").change(function() {
        var nurseVal = $(this).val();
        var typeID = $("#types").val();

        var href = $("#env_domain_url").val();
        window.location.href =
            href + "/indexbyfilter?type=" + typeID + "&user_id=" + nurseVal;
    });
});
