<?php

function areCredentialsSent(){
    //Approaches attempts, that include opening the specific page via link directly and not via form 
    if(isset($_POST['user_email']) || isset($_POST['user_password'])){
        return true; 
    }else{
        return false; 
    }
}

function isSessionDataAvailable(){
    if(isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])){
        return true; 
    }else{
        return false; 
    }
}

function setSessionData(){
    $_SESSION["user_email"] = $_POST["user_email"];

    echo $_SESSION["user_email"];
    $_SESSION["user_password"] = $_POST["user_password"];
    echo $_SESSION["user_password"];

}

function printSessionDataErrorMessag(){
    echo "<p>Oops, ein Fehler! bitte <a href='login_register.php>hier</a> neu einloggen!</p>"; 
}
?>