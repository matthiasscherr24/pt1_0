<?php



class Version1DB
{

    private $servername; 
    private $username; 
    private $password; 

    private $dbConnection;


    public function __construct($servername, $username, $password)
    {

        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password; 
    }


    public function connect()
    {
        try {

            $servername = $this->servername;
            $username = $this->username; 
              $password = $this->password;  

            $dbConnection = new PDO("mysql:host=$servername;dbname=PTAppVersionEins", $username, $password);
             



            // set the PDO error mode to exception
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection; 

            echo "Returned, Connected successfully";
        } catch (PDOException $e) {
            echo "Hallo Eugen, Connection failed: " . $e->getMessage();
        }
    
    }

    function getAllProjects($dbConnection)
    {


        $selectAllProjects = "SELECT * FROM Project";//TODO Überprüfe, welche Sachen wir auslesen wollen (evtl. zuviel mit *)
        $projectList = $dbConnection->query($selectAllProjects);
        return $projectList;
    }
	
	function addNewProjectTitle($dbConnection,$projectTitle){
		$addNewProjectTitle = "INSERT INTO  Project VALUES (NULL, 'Radfahren mit Mama', 'TestDescription','rad.jpg',0,0,0,NULL,0)"; //TODO Noch eine korrekte projectFounderId holen
		$dbConnection->query($addNewProjectTitle);
	}
	
	function registerUser($dbConnection, $username, $password, $server){
		echo("Schritt Ich bin in registerUser von Version1DB"); 
		$createUser = "CREATE USER '".$username."'@'localhost' IDENTIFIED BY '".$password."';
		GRANT ALL PRIVILEGES ON PTAppVersionEins.Project TO ; '".$username."'@'".$server."'";
		//$grantPrivileges = "GRANT ALL PRIVILEGES ON PTAppVersionEins.Project TO '".$username."'@'".$server."'";
		
		$dbConnection->query($createUser);
		echo("User created"); 
		//$dbConnection->query($grantPrivileges); 
			
	}
	
	
	
	
	

}
?>

