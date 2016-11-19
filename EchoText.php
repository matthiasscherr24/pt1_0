<?php

    include 'Version1DB.php';

$q=$_REQUEST["q"];  //q als ProjectTitle einspeichern 

echo $q === "" ? "no suggestion" : $q;




    function printAllProjectsTable($projectList) {

        echo "ICh bin drin in print all projects ";
        echo "<table>";
        echo "<tr>";
        echo "<th>ProjectTitle</th>";
        echo "</tr>";

        $rowCount = 0;
        while ($row = $projectList->fetch()) {
            echo "<tr>";
            echo "<td>".$row["ProjectTitle"]."</td>";
            echo "</tr>";
            $rowCount++;
        }
        echo "</table>";
    }



    $ProjectDatabase = new Version1DB("localhost", "Eugen", "Eugen");
    $dbConnection=$ProjectDatabase->connect(); 
	$ProjectDatabase->addNewProjectTitle($dbConnection,$q); 
    $allProjectList = $ProjectDatabase->getAllProjects($dbConnection); 
    printAllProjectsTable($allProjectList);



?>