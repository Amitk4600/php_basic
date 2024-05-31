//  Ajax
function display(str) {
    if (str.length == 0) {
        document.getElementById('displaytext').innerHTML = "";
        return;
    } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("displaytext").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "getUserHistory.php?q=" + str, true);
        xmlhttp.send();
    }
}