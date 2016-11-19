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


    function retrieveUserId($dbConnection,$userEmail){

        $retrieveUserIdSQL="SELECT userId FROM User WHERE userEmail ='".$userEmail."'";
        $retrievedUserId= $dbConnection->query($retrieveUserIdSQL);

        while ($row = $retrievedUserId->fetch()) {
            $userId =$row['userId'];
            return $userId;
        }

    }
    function getAllProjects($dbConnection)
    {
        $selectAllProjects = "SELECT * FROM Project";//TODO Überprüfe, welche Sachen wir auslesen wollen (evtl. zuviel mit *)
        $projectList = $dbConnection->query($selectAllProjects);
        return $projectList;
    }

    function getThirdPartyProjects($dbConnection)
    {
        $selectProjects = "SELECT * FROM Project WHERE thirdPartyProject = 1";//TODO Überprüfe, welche Sachen wir auslesen wollen (evtl. zuviel mit *)
        $thirdPartyProjectList = $dbConnection->query($selectProjects);
        return $thirdPartyProjectList;
    }
	
	function addNewProjectTitle($dbConnection,$projectTitle,$projectDescription,$thirdPartyProject){
		$addNewProjectTitle = "INSERT INTO  Project VALUES (NULL, '".$projectTitle."', '".$projectDescription."','/seifenblase.jpg',0,0,$thirdPartyProject,NULL,0, 'testUrl');"; //TODO Noch eine korrekte projectFounderId holen
        $dbConnection->query($addNewProjectTitle);
	}
	
	function registerUser($dbConnection, $userFirstName, $userLastName, $userEmail, $userPassword, $thirdPartyUser){

	    $server='localhost';

        $createUserForUserRelation = "INSERT INTO USER VALUES (NULL,'".$userFirstName."','".$userLastName."','".$userEmail."', $thirdPartyUser)";
        $dbConnection->query($createUserForUserRelation);

        $retrieveUserIdSQL="SELECT userId FROM User WHERE userEmail = '".$userEmail."'";
        $retrievedUserId= $dbConnection->query($retrieveUserIdSQL);

        while ($row = $retrievedUserId->fetch()) {
            $userId =$row['userId'];

            $createUserForMySQL = "CREATE USER '".$userId."'@'localhost' IDENTIFIED BY '".$userPassword."';
		                           GRANT ALL PRIVILEGES ON PTAppVersionEins.Project TO ; '".$userId."'@'".$server."'";

            $grantPrivileges = "GRANT ALL PRIVILEGES ON PTAppVersionEins.Project TO '".$userId."'@'".$server."'";

            $dbConnection->query($createUserForMySQL);
            $dbConnection->query($grantPrivileges);

            echo("UserFor Relation  für MySQL gebaut");

        }

	}
	
	
	
	
	//Milestone related code

    function getMilestones($dbConnection, $projectId){
        $selectAllMilestones = "SELECT * FROM Milestones WHERE projectId = '$projectId'";
        $milestoneList = $dbConnection->query($selectAllMilestones);
        return $milestoneList;
    }

    function addNewMilestone($dbConnection,$milestoneTitle, $milestoneDescription, $projectId){
        $addNewMilestone = "INSERT INTO  Milestones VALUES (NULL, '".$milestoneTitle."', '".$milestoneDescription."', '$projectId', NULL, NULL)"; //TODO Unbedingt noch passende ProjectId hinzufügen

        $dbConnection->query($addNewMilestone);
    }

    //Task related code

    function getTask($dbConnection, $milestoneId){
        $selectTasks = "SELECT * FROM Tasks WHERE milestoneId = '$milestoneId'";
        $taskList = $dbConnection->query($selectTasks);
        return $taskList;
    }

    function addNewTask($dbConnection, $taskTitle, $taskDescription, $milestoneId){

        $deadline = "1000-01-01 00:00:00";
        $addNewTask = "INSERT INTO  Tasks VALUES ('".$deadline."', NULL, '".$taskTitle."','".$taskDescription."', '$milestoneId');"; //TODO Unbedingt noch passende ProjectId hinzufügen

        $dbConnection->query($addNewTask);
    }

}
?>

