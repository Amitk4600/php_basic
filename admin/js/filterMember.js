function displayAll(str) {
    if (str == "") {
        document.getElementById("text").innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("text").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "filter-member.php?q=" + str, true);
        xmlhttp.send();
    }
}
function displayBlock(str) {

    if (str == "") {
        document.getElementById("text").innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("text").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "filter-member.php?block=" + str, true);
        xmlhttp.send();
    }
}

function displayUnblock(str) {

    if (str == "") {
        document.getElementById("text").innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("text").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "filter-member.php?unblock=" + str, true);
        xmlhttp.send();
    }
}
function displayPending(str) {
    if (str == "") {
        document.getElementById("text").innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("text").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "displayPending.php?pendingId=" + str, true);
        xmlhttp.send();
    }
}

function block(userId) {
    if (userId == "") {
        document.getElementById("text").innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xmlhttp.open("GET", "activeDeactiveAjax.php?q=" + userId, true);
        xmlhttp.send();
    }
}

function filterMember(status) {
    if (status === "") {
        $("#text").html("");
        return;
    } else {
        $.ajax({
            url: "active-inactiveMember.php",
            type: "GET",
            data: { status: status },
            success: function (response) {
                $("#text").html(response);
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    }
}

// levelWise

$(document).ready(function () {
    $(document).on('click', '.view-referrals-btn', function () {
        let userId = $(this).data('user-id');
        $.ajax({
            url: 'levewiseActiveInactive.php',
            type: 'GET',
            data: { view_referrals: true, user_id: userId },
            success: function (response) {
                $('#referralContainer').html(response);
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    });
});
