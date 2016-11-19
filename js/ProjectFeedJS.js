/**
 * Created by Eugen on 04.11.16.
 */

function joinRoom(projectId, username, Chatname) { //Chatname wurde zu projectTitle
    debugger;
    var username = username; //username! TODO username dynamisch machen
    var projectId= projectId;
    window.location = 'ChatRoom.html?uuid=' + username +'=PrNa='+ projectId;
}


