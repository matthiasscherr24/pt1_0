<?php
session_start();
include 'Version1DB.php';
include 'session_helper.php';
?>


<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/> <!--TODO herausfinden was Scalable heißt-->
    <title>Projectfeed</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link rel="stylesheet" href="css/pt.css" type="text/css">


    <!--JS-->

</head>

<body>
<!--Import jQuery before materialize.js-->

<div class="navbar-fixed">
    <!--Obere Navigationsbar-->
    <nav>
        <div class="blue darken-2 nav-wrapper">
            <!--<form>
                <div class="input-field right">
                <input id="search" type="search" required>
                    <label for="search">
                    <i class="black material-icons">search</i>
                    </label>
                    <i class="material-icons">close</i>
                </div>
            </form>-->

            <ul class="right">
                <li><a id="SidNavSuchen" href="#" data-activates="SuchenNav" class="white-text"><i class="material-icons">search</i></a></li>
                <li><a id="SidNavChat" href="#" data-activates="ChatNav" class="white-text"><i class="material-icons">chat_bubble_outline</i></a></li>
                <li><a id="SidNavProjekte" href="#" data-activates="ProjektNav" class="white-text"><i class="material-icons">supervisor_account</i></a></li>
                <li><a id="SidNavProfil"  data-activates="ProfilNav" class="white-text"><i class="material-icons">perm_identity</i></a></li>
                <?php
                if (areCredentialsSent()||isSessionDataAvailable()){
                }
                else{
                echo "<li><div><a href=\"#AnmeldenRegistrieren\" class=\"modal-trigger white-text\">Login</a></div>
                </li>";
                }
                ?>
            </ul>
            <!-- All das Seitliche-->
            <!-- Chat Seitliche Navigation-->
            <ul class="side-nav" id="ChatNav">
                <li><a href="sass.html">Chat1</a></li>
                <div class="divider"></div>
                <li><a href="badges.html">Chat2</a></li>
                <div class="divider"></div>
                <li><a href="collapsible.html">Chat3</a></li>
                <div class="divider"></div>
                <li><a href="mobile.html">Chat4</a></li>
            </ul>
            <!-- Projekt Infos Seitliche Navigation-->
            <ul class="side-nav" id="ProjektNav">
                <li><a href="sass.html">Projekt1</a></li>
                <div class="divider"></div>
                <li><a href="badges.html">Projekt2</a></li>
                <div class="divider"></div>
                <li><a href="collapsible.html">Projekt3</a></li>
                <div class="divider"></div>
                <li><a href="mobile.html">Projekt4</a></li>
            </ul>
            <!-- Profil Seitliche Navigation-->
            <ul class="side-nav" id="ProfilNav">
                <li><a href="sass.html">Profil ansehen</a></li>
                <div class="divider"></div>
                <li><a href="badges.html">Profil bearbeiten</a></li>
                <div class="divider"></div>
                <li><a href="collapsible.html">Profil suchen</a></li>
            </ul>
            <!-- Suchen Seitliche Navbar-->
            <ul class="side-nav" id="SuchenNav">
                <div class="row">
                    <div class="col s12">
                        <form>
                            <div class="divider"></div>
                            <div class="blue-text input-field">

                                <i class="large material-icons prefix">search</i>
                                <input id="input_text" type="text">
                                <label for="input_text">
                                </label>

                            </div>
                            <div class="divider"></div>

                        </form>
                    </div>
                </div>



            </ul>

        </div>
    </nav>
</div>


<div class="row">
    <div class="col s12">
        <!-- Oberste TabFenster-->
        <ul class="tabs">
            <li class= "tab col s6"><a class="blue-text text-darken-2 active" href="#all_projects">Alle Projekte</a></li>
            <li class="tab col s6"><a class="blue-text text-darken-2" href="#DeineProjekte">Deine Projekte</a></li>
        </ul>
    </div>

 <!--Beim Drücken des Plus-Buttons -->
    <div id="add_project_form" style="display: none; class="row">
         <div class="container">
                <form action="ProjectFeed.php" method="post">
                    <label for="project_title">Dein Projektname:</label>
                    <input id="project_title" name="projecttitle" type="text"/>

                    <label for="project_description">Deine Projektbeschreibung:</label>
                    <input id="project_description" name="projectdescription" type="text"/>

                    <label for="project_category">Deine Projektcateogry</label>
                    <input id="project_category" name="projectcategory" type="checkbox"/>
                    <button type="submit">Starten</button>
                </form>
         </div>
    </div>

</div>

    <!-- Registerkarte alle Projekte-->
    <div id="all_projects" class="container">

        <div class="row">
        <!-- Leuchturm Projekt-->
            <div id="leutturm_projekt" class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="media/images/aias.jpg">
                </div>
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4">AIAS-Deutschland<i class="material-icons right">more_vert</i></span>
                    <p><a href="ProjectOverview.php">Kennen lernen</a></p>

                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">AIAS-Deutschland<i class="material-icons right">close</i></span>

                    <span style="align-content: center">
                    </span>

                    <span><p>AIAS ist ein gemeinnütziger Verein von Studenten. Alle 15 Minuten erkrankt in Deutschland ein Mensch an Blutkrebs.
                            </br>Jeder 7. Patient muss sterben. Doch Blutkrebs ist heilbar: Deine Stammzellen können Leben retten! Unsere Vision ist, dass sich jeder Student in Deutschland in die internationale Stammzelldatenbank aufnehmen lässt.</p></span>
                    <p><a href="#">Kennen lernen</a></p>


                </div>
            </div>

                <?php
                //PHP-CODE
                    if (areCredentialsSent()||isSessionDataAvailable()){ //Credentials means LoginData as well as Data from Register
                        if(!isSessionDataAvailable()){
                            setSessionData();
                        }
                        //Zugangsdaten
                        $userEmail=$_SESSION["user_email"];

                        echo $_SESSION["user_email"];
                        $userPassword=$_SESSION["user_password"];
                        $loginCase = true;
                        //Jetzt kommt der Fall, dass man über eine Registrierung kommt
                        if(isset($_POST['register_firstname'])) {
                            $loginCase = false;  //Registriere mich ja
                        }

                        $userId = registerUserViaServerRetrieveId($userEmail,$loginCase);//Dies ist nur beim Registrieren der Fall!

                        echo $userId;

                        $forename = getUserForename($userId);
                        echo $forename;
                        $_SESSION["fore_name"] = $forename;
                        echo $_SESSION["fore_name"];


                        //Jetzt wird die eigentliche Datenbankverbindung aufgebaut
                        $ProjectDatabase = new Version1DB("localhost","Eugen", "Eugen");
                        $dbConnection = $ProjectDatabase->connect();



                        // Case user adds Projects:
                        if (isset($_POST["projecttitle"])){
                            $ProjectDatabase->addNewProjectTitle($dbConnection, $_POST["projecttitle"],$_POST["projectdescription"],0);
                        }
                        $allProjectList = $ProjectDatabase->getAllProjects($dbConnection);
                        printAllProjectsTable($allProjectList);

                        //Button für Eingeloggte:
                        $htmlPlusBtnLoggedIn="<div onclick='showAddProject()' class=\"fixed-action-btn-pt\">
                            <a class=\"btn-floating btn-large\" style=\"background-color:rgba(132,216,255,0.5)\">
                            <i class=\"large material-icons\">add</i> 
                            </a>
                            </div>"; //TODO Der Button muss noch zentriert werden!


                        echo $htmlPlusBtnLoggedIn;

                    }
                    else{

                        $user="Eugen";
                        $pass="Eugen";
                        $ProjectDatabase = new Version1DB("localhost",$user, $pass);
                        $dbConnection = $ProjectDatabase->connect();

                        //Case: User adds ProjectTitle

                        if (isset($_POST["projecttitle"])){

                            //TODO Evtl. redundant Evtl. was reinfügen.
                        }
                        $allProjectList = $ProjectDatabase->getAllProjects($dbConnection);
                        printAllProjectsTable($allProjectList);

                        //Button für noch nicht Eingeloggte -zum Anmelden/Registrieren

                        $htmlPlusBtnNotLoggedIn="<div href=\"#AnmeldenRegistrieren\" class=\"fixed-action-btn-pt modal-trigger\">
                        <a class=\"btn-floating btn-large\" style=\"background-color:rgba(132,216,255,0.5)\">
                            <i class=\"large material-icons\">add</i> 
                        </a>
                    </div>"; //TODO Der Button muss noch zentriert werden!


                        echo $htmlPlusBtnNotLoggedIn;
                    }

                    function printAllProjectsTable($projectList) {
                        $img_url = "http://localhost:8888/media/images/projects/";
                        $rowCount = 0;

                        while ($row = $projectList->fetch()) {

                            $projectId=$row["projectId"];
                            $projectTitle = $row["projectTitle"];
                            $projectDescription = $row["projectDescription"];
                            $projectImagePath = $row["projectImagePath"];


                            $final_im_url = $img_url."/".$projectId.$projectImagePath;
                            //Hier Cards ausgeben
                            $htmlForCards = "<div id=\"leutturm_projekt\" class=\"card\">
                <div class=\"card-image waves-effect waves-block waves-light\">
                    <img class=\"activator\" src=\"$final_im_url\">
                </div>
                <div class=\"card-content\">
                    <span class=\"card-title activator grey-text text-darken-4\">$projectTitle<i class=\"material-icons right\">more_vert</i></span>
                    <div><a onclick=\"joinProject($projectId, '$projectTitle')\">Kennen lernen</a></div>
                </div>
                <div class=\"card-reveal\">
                    <span class=\"card-title grey-text text-darken-4\">$projectTitle<i class=\"material-icons right\">close</i></span>

                    <span style=\"align-content: center\">
                    </span>

            
                    <span><p>$projectDescription<p>
                    <a onclick=\"joinProject($projectId, '$projectTitle')\">Chat</a> </p> 
                    </span><!-- Außen Kennen lernen-->


                </div>
            </div>";
                            echo $htmlForCards;
                            $rowCount++;
                        }
                    }

                    function registerUserViaServerRetrieveId($userEmail, $loginCase){

                        $ProjectDatabase = new Version1DB("localhost", "Eugen", "Eugen");
                        $dbConnection = $ProjectDatabase->connect();


                        if ($loginCase==false) { //Wir sind im Registrieren
                            $register_email = $_POST["user_email"];
                            $register_firstname = $_POST["register_firstname"];
                            $register_lastname = $_POST["register_lastname"];
                            $register_password = $_POST["user_password"];
                            $ProjectDatabase->registerUser($dbConnection, $register_firstname, $register_lastname, $register_email, $register_password, 0);
                        }

                            $userId = $ProjectDatabase->retrieveUserId($dbConnection, $userEmail);
                        return $userId;
                    //The method is specified in Version1DB.php

                }

                    function loginRetrieveId($userEmail){
                    }

                    function getUserForename($userId){

                        $ProjectDatabase = new Version1DB("localhost", "Eugen", "Eugen");
                        $dbConnection = $ProjectDatabase->connect();

                        $userForename = $ProjectDatabase->getUserForename($dbConnection, $userId);
                        return $userForename;


                    }

                        //TODO Chat verknüpfung zu username!

                ?>

            <script>
                function joinProject(projectId, projectTitle) {
                    debugger;
                    var projectId = projectId;
                    var projectTitle = projectTitle;
                    window.location = 'ProjectOverview.php?projectId=' + projectId +'&projectTitle='+ projectTitle;

                    console.log("Hallo Eugen, ich bins");

                }
            </script>
        </div>
    </div>



        <div class="divider"></div>
        <!--LadeKreis-->
            <div id="laden" class="preloader-wrapper active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div></div>
    <!-- Registerkarte deine Projekte-->
    <div id="DeineProjekte" class="col s12">



    </div>


</div>

<!--  Scripts-->
<script>
    $(document).ready(function(){
        $('.tooltipped').tooltip({delay: 50});
    });</script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>




<!-- Ladekreis Skript, wenn Seite geladen nicht zeigen-->
<script>
    $(document).ready(function(){
        $("#laden").hide();
    });
</script>

<!--slider Skript-->
<script>
    $(document).ready(function(){
        $('.slider').slider({full_width: true});
    });
</script>

<!--modal Skript-->
<script>
    $(document).ready(function(){//Wenn Dokument geladen ist,
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal(); //dann schaut es modal-trigger klassen ein und
    });
</script>

<!-- Navbar Script-->
<script>
    $(document).ready(function(){
        $("#SidNavSuchen").sideNav({
            menuWidth: 300
        });
        $("#SidNavChat").sideNav({
            menuWidth: 300
        });
        $("#SidNavProfil").sideNav({
            menuWidth: 300
        });
        $("#SidNavProjekte").sideNav({
            menuWidth: 300
        });

    })
</script>

<!--Form Script-->
<script>
    $(document).ready(function() {
        $('input#input_text, textarea#textarea1').characterCounter();
    });
</script>
<!--ZumChatWeiterleiten-->
<script type="text/javascript"> //TODO evtl löschen tex/javascript
    function joinRoom(projectId, username, Chatname) { //Chatname wurde zu projectTitle
        debugger;
        var username = username; //username! TODO username dynamisch machen
        var projectId= projectId;
        window.location = 'ChatRoom.html?uuid=' + username +'=PrNa='+ projectId;
    }

    //TODO Chat erste beim Login zulassen
</script>




<!--Anmelden Registrieren-->
<div id="AnmeldenRegistrieren" class="modal bottom-sheet" style="font-size:125%;" > <!-- ViewPorts Height-->

    <div class="modal-content">
        <div class="row">
            <div class="col s12">

                <!-- Oberstes TabFenster-->
                <ul class="tabs">
                    <li class= "tab col s6"><a class="active" href="#Anmelden">Anmelden</a></li>
                    <li class="tab col s6"><a href="#Registrieren">Registrieren</a></li>
                </ul>

            </div>

            <!--Anmelden-->
            <div id="Anmelden" class="col s12">

                <div class="row">
                    <form class="col s12" action="ProjectFeed.php" method="post">
                        <div class="row">

                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="username" type="email" class="validate" name="user_email">
                                <label for="username" data-error="wrong">E-Mail</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="Passwort" type="password" class="validate" name="user_password">
                                <label for="Passwort">Passwort</label>
                            </div>

                        </div>
                        <button  class="modal-action modal-close waves-effect waves-green btn-flat right" type="submit">Loslegen</button>
                    </form>

                </div>

            </div>
            <!-- Registrieren--> <!-- TODO Passwortüberprüfung bauen-->
            <div id="Registrieren" class="col s12">
                <div class="row">
                    <form class="col s12" action="ProjectFeed.php" method="post">
                        <div class="row">

                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="email" type="email" class="validate" name="user_email"> <!-- Absichtlich so benannt, Postvariable, Key user_email ist gleich, egal ob man login macht oder registriert-->
                                <label for="email" data-error="Fehlerhafte Adresse">Email-Adresse</label>
                            </div>


                            <div class="input-field col s6">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="icon_prefix" type="text" class="validate" name="register_firstname">
                                <label for="icon_prefix">Vorname</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="icon_prefix" type="text" class="validate" name="register_lastname">
                                <label for="icon_prefix">Nachname</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">visibility_off</i>
                                <input id="Passwort" type="password" class="validate" name="user_password">
                                <label for="Passwort">Passwort</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">visibility_off</i>
                                <input id="Passwort" type="password" class="validate">
                                <label for="Passwort">Passwort bestätigen</label>
                            </div>
                        </div>
                        <button  class="modal-action modal-close waves-effect waves-green btn-flat right" type="submit">Loslegen</button>
                    </form>
                </div>
            </div>
            <!--Fuß Zeile
    <div class="modal-footer">

      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Zurück</a>
    </div>-->
        </div>
    </div>
</div>



</body>
</html>


</body>
</html>

<script>

    function showAddProject() {

        document.getElementById('all_projects').style.display='none'; //Zunächst ausgeblendet
        document.getElementById('add_project_form').style.display='block';
    }

    function hideAndShow(shouldBeHidden, shouldBeShown){
        document.getElementById(shouldBeHidden).style.display='none';
        document.getElementById(shouldBeShown).style.display='block';
    }

</script>

