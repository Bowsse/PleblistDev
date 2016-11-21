function closeList() {
            document.getElementById("playlist").style.width = "0px";
            document.getElementById("playlist").style.overflow = "hidden";
            document.getElementById("playlistButton").innerHTML = "Open";
            document.getElementById("playlistButton").onclick = openList;
        }
                
function openList() {
    document.getElementById("playlist").style.width = "auto";
    document.getElementById("playlist").style.overflow = "auto";
    document.getElementById("playlistButton").onclick = closeList;
    document.getElementById("playlistButton").innerHTML = "Close";
}
function closeChat() {
            document.getElementById("chat").style.width = "0px";
            document.getElementById("chat").style.overflow = "hidden";
            document.getElementById("chatButton").innerHTML = "Open";
            document.getElementById("chatButton").onclick = openChat;
        }
                
function openChat() {
    document.getElementById("chat").style.width = "auto";
    document.getElementById("chat").style.overflow = "auto";
    document.getElementById("chatButton").onclick = closeChat;
    document.getElementById("chatButton").innerHTML = "Close";
}
function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}


                   