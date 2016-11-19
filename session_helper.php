<?php

function isLoginDataSent(){ 
    //Approaches attempts, that include opening the specific page via link directly and not via form 
    if(isset($_POST['username']) || isset($_POST['password'])){
        return true; 
    }else{
        return false; 
    }
}

function isSessionDataAvailable(){
    if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
        return true; 
    }else{
        return false; 
    }
}

function setSessionData(){
    $_SESSION["username"] = $_POST["username"]; 
    $_SESSION["password"] = $_POST["password"];

    return "Session Data erfolgreich gesetzt";
}

function printSessionDataErrorMessag(){
    echo "<p>Oops, ein Fehler! bitte <a href='login_register.php>hier</a> neu einloggen!</p>"; 
}
?>