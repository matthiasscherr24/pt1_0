<?php
$servername = "localhost";
$username = "Eugen";
$password = "Eugen";



	try {
	echo "Schritt1";

    $conn = new PDO("mysql:host=$servername;dbname=PTAppVersionEins", $username, $password);
    echo "Schritt2";
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }



    $sql = 'SELECT ProjectTitle FROM ProjectFeed';
    foreach ($conn->query($sql) as $row) {
        print $row['ProjectTitle'] . "\t";
    }



?>