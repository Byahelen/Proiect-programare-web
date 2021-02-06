// AJAX

function showTable(collection_id) {
    if (collection_id === ''){
        document.getElementById("transactionsTable").innerHTML = "Please choose a collection";
    } else {
        XMLhttp = new XMLHttpRequest();
        XMLhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200){
                document.getElementById("transactionsTable").innerHTML = this.responseText;
            }
        };
        XMLhttp.open("GET","/trex/transactions/index.php?col_id=" + collection_id, true);
        XMLhttp.send();
    }
}

//https://stackoverflow.com/questions/827368/using-the-get-parameter-of-a-url-in-javascript
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}



function goToColStatisticsURL(newURL){
    var Url ="/trex/statistics/index.php?col_id=" + newURL + "&year=" + findGetParameter('year');
    window.location = Url;
}

function goToYearURL(newURL){
    var Url ="/trex/statistics/index.php?col_id=" + findGetParameter('col_id') + "&year=" + newURL;
    window.location = Url;
}

function goToColURL(newURL){
    var Url ="/trex/transactions/index.php?col_id=" + newURL + "&time=" + findGetParameter('time');
    window.location = Url;
}

function goToTimeURL(newURL){
    var Url ="/trex/transactions/index.php?col_id=" + findGetParameter('col_id') + "&time=" + newURL;
    window.location = Url;
}


//https://www.w3schools.com/howto/howto_js_sort_table.asp
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("transactions");
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("TR");
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}