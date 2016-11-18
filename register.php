 <?php
   	
   	    include 'Version1DB.php';
   	
	echo "Herzlich Willkommen in Register"; 
	
	$server="localhost"; 
	
	
	function registerUserViaServer(){
		
	$username = $_POST["username"]; 
	$password = $_POST["password"]; 
	echo $password;
	echo $username; 
	
	$ProjectDatabase = new Version1DB("localhost", "Registrator", "Wqud4YjsNX42XPXY");
	
	echo("Neues Objekt vom Typ Version1DB angelegt"); 
    $dbConnection=$ProjectDatabase->connect(); 
	echo("Connected"); 

	$ProjectDatabase->registerUser($dbConnection, $username, $password, $server); //The method is specified in Version1DB.php
	echo("registerServer ist aufgerufen");  
	}    
	
	registerUserViaServer(); 
   
   	
   	?>