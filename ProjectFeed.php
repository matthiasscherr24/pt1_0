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

    <!--JS-->
    <script src="js/pubnub-3.16.1.min.js"></script>


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
                <li><a id="SidNavProfil" href="#" data-activates="ProfilNav" class="white-text"><i class="material-icons">perm_identity</i></a></li>
            </ul>
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



<!-- Sektionen-->
<div class="row">

    <div class="col s12">
        <!-- Oberste TabFenster-->
        <ul class="tabs">
            <li class= "tab col s6"><a class="blue-text text-darken-2 active" href="#AlleProjekte">Alle Projekte</a></li>
            <li class="tab col s6"><a class="blue-text text-darken-2" href="#DeineProjekte">Deine Projekte</a></li>
        </ul>
    </div>

    <!-- Registerkarte alle Projekte-->
    <div id="AlleProjekte" class="col s12">

        <!-- Leuchturm Projekt-->
        <div class="section">
            <img href="#AnRe" class="responsive-img modal-trigger" src="projecttogether.jpg">
            <div class="video-container">
                <iframe width="853" height="480" src="//www.youtube.com/embed/p_W-7OdcL4U?rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="divider"></div>




        <!--Jetzt kommt Matthias-->
<div class="container">

    <div id="add_project_form" style="display: none">
        <form action="ProjectFeed.php" method="post">
            <label for="ProjectTitleInput">Dein Projektname:</label>
            <input id="project_title" name="projecttitle" type="text"/>
            <button type="submit">Starten</button>
        </form>
    </div> <!-- Das was kommt, wenn ich auf Plus drücke-->

<div class="row" id="project_feed_row">

    <?php


    if (isLoginDataSent()||isSessionDataAvailable()){
        if(!isSessionDataAvailable()){
            setSessionData();
        }
        $user=$_SESSION["username"];
        $pass=$_SESSION["password"];
        $ProjectDatabase = new Version1DB("localhost",$user, $pass);
        $dbConnection = $ProjectDatabase->connect();

        //Case: User adds ProjectTitle

        if (isset($_POST["projecttitle"])){
            $ProjectDatabase->addNewProjectTitle($dbConnection, $_POST["projecttitle"]);
        }
        $allProjectList = $ProjectDatabase->getAllProjects($dbConnection);
        printAllProjectsTable($allProjectList);
    }
    else{

        echo "Du bist noch nicht eingeloggt";

        $user="Eugen";
        $pass="Eugen";
        $ProjectDatabase = new Version1DB("localhost",$user, $pass);
        $dbConnection = $ProjectDatabase->connect();

        //Case: User adds ProjectTitle

        if (isset($_POST["projecttitle"])){ //TODO Evtl. redundant.
            $ProjectDatabase->addNewProjectTitle($dbConnection, $_POST["projecttitle"]);
        }
        $allProjectList = $ProjectDatabase->getAllProjects($dbConnection);
        printAllProjectsTable($allProjectList);
    }



    function printAllProjectsTable($projectList) {

        echo "<table>";
        echo "<tr>";
        echo "<th></th>";
        echo "</tr>";


        $img_url = "http://localhost:8888/media/images/projects/";




        $rowCount = 0;
        while ($row = $projectList->fetch()) { //Hier Cards rausspucken

            //Cards_Code
            $htmlForCards="<div class=\"card medium col s12 l6\">
    <div class=\"card-image waves-effect waves-block waves-light\">
      <img class=\"activator\" src=".$img_url.$row['projectId'].$row['projectImagePath']." style='width:300px' />
    </div>
	<!--Karten FrontFace-->
    <div class=\"card-content\">
      <span class=\"Chat card-title activator grey-text text-darken-4 \">".$row['projectTitle']."<i class=\"material-icons right\">video_library</i></span>
      <p class=\"userName\">".$row['projectDescription']."</p>
		<a href=\"Projekt.html\" class=\"blue lighten-1 waves-effect waves-light btn right\"><i class=\"material-icons left\">zoom_in</i>Details</a>
		<a class=\"blue lighten-1 waves-effect waves-light btn right\"><i class=\"material-icons right\" onclick=\"joinRoom('DBChange','Eugen',0)\">chat</i>Chat</a>
		
    </div>
		<!--Karten InnenSeite-->
    <div class=\"card-reveal\">
      <span class=\"card-title grey-text text-darken-4\">Wachse über dich Hinaus!<i class=\"material-icons right\">close</i></span>
		
		<div class=\"video-container\">
        <iframe width=\"853\" height=\"480\" src=\"//www.youtube.com/embed/_nQoYH3lYBg?rel=0\" frameborder=\"0\" allowfullscreen></iframe>
      </div>
		<p>Das ist ein Text</p>
    </div>
  </div>";





            echo $htmlForCards;
            echo "<tr>";
            echo "<td>".$row["projectTitle"]."
            <button id=".$row['projectId'].">Mitmachen</button>
            <img src=".$img_url.$row['projectImagePath']." style='width:300px' /></td>";
            echo "</tr>";

            echo "<tr>";
            echo "</tr>";
            $rowCount++;
        }
        echo "</table>";
    }

    ?>

    <button class="btn-floating btn-large waves-effect waves-light light-blue" onclick="showAddProject()"><i class="material-icons">add</i></button>
    <h1 style="display: none">Heading</h1>

</div> <!--Der eigentliche ProjectFeed aus Datenbank-->
    </div>







        <!--Jetzt kommt wieder Eugen-->
        <div class="divider"></div>

        <!--LadeKreis-->
        <center>
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
            </div>
        </center>

        <!--Kreis zum hinzufügen-->
        <div href="#AnRe" class="fixed-action-btn modal-trigger" style="bottom: 20px; left: 49%; margin-right: -51%;">
            <a class="btn-floating btn-large" style="background-color:rgba(128,216,255,0.5);">
                <i class="large material-icons">add</i>
            </a>
        </div>


    </div>
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
    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
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
<script type="text/javascript">
    function joinRoom(id, name, Chatname) {
        debugger;
        var uuid = name;
        var ProjektName= id;
        window.location = 'ChatRoom.html?uuid=' + uuid +'=PrNa='+ ProjektName;
    }
</script>



<!--Anmelden Registrieren-->
<div id="AnRe" class="modal bottom-sheet" style="font-size:125%;">

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
                                <input id="email" type="email" class="validate">
                                <label for="email" data-error="wrong" data-success="right">Email</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="Passwort" type="password" class="validate">
                                <label for="Passwort">Passwort</label>
                            </div>

                        </div>
                        <button  class="modal-action modal-close waves-effect waves-green btn-flat right" type="submit">Loslegen</button>
                    </form>
                </div>

            </div>
            <!-- Registrieren-->
            <div id="Registrieren" class="col s12">
                <div class="row">
                    <form class="col s12" action="register.php" method="post">
                        <div class="row">

                            <div class="input-field col s6">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="icon_prefix" type="text" class="validate">
                                <label for="icon_prefix">Vorname</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="icon_prefix" type="text" class="validate">
                                <label for="icon_prefix">Nachname</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">email</i>
                                <input id="email" type="email" class="validate">
                                <label for="email" data-error="wrong" data-success="right">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="Passwort" type="password" class="validate">
                                <label for="Passwort">Passwort</label>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">account_circle</i>
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

        document.getElementById('project_feed_row').style.display='none'; //Zunächst ausgeblendet
        document.getElementById('add_project_form').style.display='block';
    }

    function hideAndShow(shouldBeHidden, shouldBeShown){
        document.getElementById(shouldBeHidden).style.display='none';
        document.getElementById(shouldBeShown).style.display='block';
    }

</script>

