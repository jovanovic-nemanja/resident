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
        var duration = $("#durations").val();

        var href = $("#env_domain_url").val();
        window.location.href =
            href +
            "/indexbyfilter?type=" +
            typeID +
            "&user_id=" +
            nurseVal +
            "&duration=" +
            duration;
    });

    $("#nurse").change(function() {
        var nurseVal = $(this).val();
        var typeID = $("#types").val();
        var duration = $("#durations").val();

        var href = $("#env_domain_url").val();
        window.location.href =
            href +
            "/indexbyfilter?type=" +
            typeID +
            "&user_id=" +
            nurseVal +
            "&duration=" +
            duration;
    });

    $("document").ready(function() {
        var duration = $("#durations").val();
        if (duration == 5) {
            $("#start_time").show();
            $("#end_time").show();
            $("#search").show();
        } else {
            $("#start_time").hide();
            $("#end_time").hide();
            $("#search").show();
        }
    });

    $("#durations").change(function() {
        var duration = $(this).val();
        var nurseVal = $("#nurse").val();
        var typeID = $("#types").val();
        if (duration == 5) {
            $("#start_time").show();
            $("#end_time").show();
            $("#search").show();
        } else {
            var href = $("#env_domain_url").val();
            window.location.href =
                href +
                "/indexbyfilter?type=" +
                typeID +
                "&user_id=" +
                nurseVal +
                "&duration=" +
                duration;
        }
    });

    $("#search").click(function() {
        var nurseVal = $("#nurse").val();
        var typeID = $("#types").val();
        var duration = $("#durations").val();
        var start = $("#start_time").val();
        var end = $("#end_time").val();

        var href = $("#env_domain_url").val();
        window.location.href =
            href +
            "/indexbyfilter?type=" +
            typeID +
            "&user_id=" +
            nurseVal +
            "&duration=" +
            duration +
            "&start=" +
            start +
            "&end=" +
            end;
    });

    $("#types_resident").change(function() {
        var typeID = $(this).val();
        var nurseVal = $("#nurse_resident").val();
        var duration = $("#durations_resident").val();
        var resident = $("#resident_id").val();
        var href = $("#env_domain_url").val();
        window.location.href =
            href +
            "/indexresidentbyfilter?type=" +
            typeID +
            "&user_id=" +
            nurseVal +
            "&duration=" +
            duration +
            "&resident=" +
            resident;
    });

    $("#nurse_resident").change(function() {
        var nurseVal = $(this).val();
        var typeID = $("#types_resident").val();
        var duration = $("#durations_resident").val();
        var resident = $("#resident_id").val();
        var href = $("#env_domain_url").val();
        window.location.href =
            href +
            "/indexresidentbyfilter?type=" +
            typeID +
            "&user_id=" +
            nurseVal +
            "&duration=" +
            duration +
            "&resident=" +
            resident;
    });

    $("document").ready(function() {
        var duration = $("#durations_resident").val();
        if (duration == 5) {
            $("#start_time_resident").show();
            $("#end_time_resident").show();
            $("#search_resident").show();
        } else {
            $("#start_time_resident").hide();
            $("#end_time_resident").hide();
            $("#search_resident").show();
        }
    });

    $("#durations_resident").change(function() {
        var duration = $(this).val();
        var nurseVal = $("#nurse_resident").val();
        var typeID = $("#types_resident").val();
        var resident = $("#resident_id").val();
        if (duration == 5) {
            $("#start_time_resident").show();
            $("#end_time_resident").show();
            $("#search_resident").show();
        } else {
            var href = $("#env_domain_url").val();
            window.location.href =
                href +
                "/indexresidentbyfilter?type=" +
                typeID +
                "&user_id=" +
                nurseVal +
                "&duration=" +
                duration +
                "&resident=" +
                resident;
        }
    });

    $("#search_resident").click(function() {
        var nurseVal = $("#nurse_resident").val();
        var typeID = $("#types_resident").val();
        var duration = $("#durations_resident").val();
        var start = $("#start_time_resident").val();
        var end = $("#end_time_resident").val();
        var resident = $("#resident_id").val();
        var href = $("#env_domain_url").val();
        window.location.href =
            href +
            "/indexresidentbyfilter?type=" +
            typeID +
            "&user_id=" +
            nurseVal +
            "&duration=" +
            duration +
            "&start=" +
            start +
            "&end=" +
            end +
            "&resident=" +
            resident;
    });
});
