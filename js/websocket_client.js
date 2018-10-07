var output;

var websocket;

var t;

// window.onload = resetTimer;

function WebSocketSupport()
{
    if (browserSupportsWebSockets() === false) {
        document.getElementById("ws_support").innerHTML = "<h2>Sorry! Your web browser does not supports web sockets</h2>";

        var element = document.getElementById("wrapper");
        element.parentNode.removeChild(element);

        return;
    }

    output = document.getElementById("chatbox");

    websocket = new WebSocket('ws:localhost:999');

    websocket.onopen = function(e) {
        writeToScreen("You have successfully connected to the server");
    };


    websocket.onmessage = function(e) {
        onMessage(e);
        var audio = new Audio('submarine-diving-alarm-daniel_simon.mp3');
        audio.play();
        // restTimer();
        var map = document.getElementById("map");
        map.style.visibility = "visible";
        
    };

    websocket.onerror = function(e) {
        onError(e);
    };
}

//function resetTimer(){
//    clearTimeout(t);
//    t = setTimeout(resetContent, 5000);
//}
//
//function resetContent(){
//    writeToScreen('<span style="color: blue;">Your are alright.</span>');
//    var map = document.getElementById("mapContainer");
//    map.style.visibility = "hidden";   
//}

function onMessage(e) {
    writeToScreen('<span style="color: blue;"> ' + e.data + '</span>');
}

function onError(e) {
    writeToScreen('<span style="color: red;">ERROR:</span> ' + e.data);
}

function writeToScreen(message) {
    var pre = document.createElement("p");
    pre.style.wordWrap = "break-word";
    pre.innerHTML = message;
    output.innerHTML = "";
    output.appendChild(pre);
}

function browserSupportsWebSockets() {
    if ("WebSocket" in window)
    {
        return true;
    }
    else
    {
        return false;
    }
}