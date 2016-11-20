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
    <link href="css/pt.css" type="text/css" rel="stylesheet" media="screen,projection"/>

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
        <!-- TabFenster-->
        <ul class="tabs">
            <li class= "tab col s6"><a class="blue-text text-darken-2 active" href="#milestones">Meilensteine</a></li>
            <li class="tab col s6"><a class="blue-text text-darken-2" href="#chat">Austausch</a></li>
        </ul>
    </div>
</div>

<div class="divider"></div>


<!-- Registerkarte alle Projekte-->
    <div id="milestones" class="container">

        <?php

        $projectId=$_GET["projectId"];
        $projectTitle = $_GET["projectTitle"];

        echo "<h2 style=\"color: #ee6e73; font-weight: 200;\">$projectTitle</h2>";

        $milestoneDatabase = new Version1DB("localhost","Eugen","Eugen"); //TODO use Session Variables
        $mDbConnection= $milestoneDatabase->connect();//milestoneDbConnection

        if (isset($_POST["milestonetitle"])){

            $milestoneDatabase->addNewMilestone($mDbConnection, $_POST["milestonetitle"],$_POST["milestonedescription"], $projectId);

            echo $_POST["milestonetitle"];
        }
        
        if (isset($_POST["tasktitle"])){

            $taskTitle = $_POST["tasktitle"]; 
            $milestoneId = $_POST["milestoneId"];
            $milestoneDatabase->addNewTask($mDbConnection, $taskTitle, "taskDescription", $milestoneId);
        }

        $milestoneList = $milestoneDatabase->getMilestones($mDbConnection,$projectId);
        printMilestones($milestoneList);

        $urlProjectOverview = "ProjectOverview.php?projectId=".$projectId."&projectTitle=".$projectTitle;
        $htmlNewMilestone = "<!-- Modal Trigger --> 
        <a class=\"waves-effect waves-light btn modal-trigger bottom-right-pt\" href=\"#modal1\">Neuer Meilenstein</a>
        <!-- Modal Structure --><div id=\"modal1\" class=\"modal\">
    <div class=\"modal-content\">
        <h4>Dein Meilenstein:</h4>
        
        
        <form action=$urlProjectOverview method=\"post\">
            <label for=\"milestone_title\"><p style=\"font-size: medium\">Titel des Meilensteins:</p></label>
            <input id=\"milestone_title\" name=\"milestonetitle\" type=\"text\" class=\"input-field col s4\"/>

            <label for=\"milestone_description\"><p style=\"font-size: medium\">Beschreibung</p></label>
            <input id=\"milestone_description\" name=\"milestonedescription\" type=\"text\" class=\"input-field col s8\"/>

            <label for=\"deadline\"><p style=\"font-size: medium\">Frist:</p></label>
            <input id=\"deadline\" class=\"datepicker\" name=\"milestonedeadline\"> <!-- Kalender-->

            <div class=\"modal-footer\">
                <button type=\"submit\" class=\"modal-close waves-effect waves-green btn-flat\">Erstellen</button>
            </div>

        </form>
    </div>
</div>";
        echo $htmlNewMilestone;
        function printMilestones($milestoneList) {
            $rowCount = 0;

            while ($row = $milestoneList->fetch()) {

                $milestoneTitle = $row["milestoneTitle"];
                $milestoneDescription = $row["milestoneDescription"];
                $milestoneId = $row["milestoneId"];

                    $htmlMilestonesPart1 =
                        "<ul class=\"collapsible\" data-collapsible=\"accordion\" style=\"position: static\">
                        <li>
                            <div class=\"collapsible-header\" style=\"position: relative\">
                                <h5 style=\"font-weight: 400; text-align: left\">$milestoneTitle</h5>
                                 <div class=\"row\">
                                 <div class=\"col s8\" style=\"position: static\">
                                 <div class=\"divider\"></div>
                                    <p style=\"line-height: 130%\">$milestoneDescription</p>
                                 </div>

                                 <div class=\"col s4\" style=\"position: static\">
                                <div class=\"chip\" style=\"position: absolute; right: 10px; bottom: 20px;\">1.12.2016</div>
                                 </div>
                                </div>
                </div>
                <div class=\"collapsible-body\" style=\"position: relative\">
                <div class=\"col s8\"
                    <form action=\"#\" style=\"padding: 5px\">";

                echo $htmlMilestonesPart1;



                $taskDatabase = new Version1DB("localhost","Eugen","Eugen");
                $tDbConnection= $taskDatabase->connect();
                $taskList = $taskDatabase->getTask($tDbConnection,$milestoneId);

                $i=1; //Variable for indeterminate-checkbox
                //
              while ($rowTask = $taskList->fetch()){
                    $i++;
                    $taskTitle = $rowTask["taskTitle"];
                    $htmlTask =
                  "<input type=\"checkbox\" id=\"indeterminate-checkbox$i\" />
                        <label for=\"indeterminate-checkbox$i\">$taskTitle</label>
                        <br>";
                    echo $htmlTask;
                }
                $projectId=$_GET["projectId"];
                $projectTitle = $_GET["projectTitle"];
                $urlProjectOverview = "ProjectOverview.php?projectId=".$projectId."&projectTitle=".$projectTitle;

                $htmlMilestonesPart2="</form>
                </div>
                
                <div class=\"col s4\" style=\"position: static\">
                        <a class=\"modal-trigger\" style=\"position: absolute; bottom: 20px; right:20px; color: #1976d2; text-align: center;\" href=\"#new_task\">Aufgabe <br>hinzufügen</a>
                        <!-- Modal Structure -->
                        <div id=\"new_task\" class=\"modal\">
                            <div class=\"modal-content\">
                            
                               <form action=$urlProjectOverview method=\"post\">

                               <div class='col s3'>
                                <label for=\"task_title\"><p style=\"font-size: medium\">Deine Aufgabe:</p></label>
                                <input id=\"task_title\" name=\"tasktitle\" type=\"text\" class=\"input-field\"/>
                                
                                <div class=\"modal-footer\">
                                    <button type=\"submit\" class=\"modal-close waves-effect waves-green btn-flat\">Erstellen</button>
                                </div>
                                </div>
                                
                            </form>



                            </div>
                        </div>
                    </div></div></ul>";


                    echo($htmlMilestonesPart2);

                $rowCount++;
            }
        }

        ?>

    </div>




    <!-- Registerkarte Chat-->


<script src="http://cdn.pubnub.com/pubnub.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--Scrollbar Unsichtbar-->
<style>
    html {
        overflow: scroll;
        overflow-x: hidden;
    }
    ::-webkit-scrollbar {
        width: 0px;  /* remove scrollbar space */
        background: transparent;  /* optional: just make scrollbar invisible */
    }
    /* optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FFFFFF;
    }

</style>
    <div id="chat" class="container">

     <?php   echo SESSION["userId"]; ?>
    </div>

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

</body>
</html>


</body>
</html>

<script>

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });


</script>

