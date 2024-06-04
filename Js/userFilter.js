function activeMember() {
    $.ajax({
        url: "memberLevelwiseActiveAndInactive.php",
        type: "GET",
        data: { status: "active" },
        success: function(response) {
            $(".text").html(response);
        }
    });
}

function inactiveMember() {
    $.ajax({
        url: "memberLevelwiseActiveAndInactive.php",
        type: "GET",
        data: { status: "inactive" },
        success: function(response) {
            $(".text").html(response);
        }
    });
}
