function showHint(str) {
    if ((str.length == 0) || (str == "Choose.....")) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../api/get_counsellors_web.php?stressor=" + str, true);
        xmlhttp.send();
    }
}