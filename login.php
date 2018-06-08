<?php
include "config.php";
include "function.php";
    
if (isset($_POST['username']) && isset($_POST['password']))
{
    //Sécurité
    $username = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['username']);
    $password= md5(preg_replace("/[^a-zA-Z0-9]/", "", $_POST['password']));
	
    
    if ($username=="" || $password=="") {
        echo 'false';
        exit();
    }
    
    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE username=? AND password=? ");
    $stmt->bindParam(1,$username);
    $stmt->bindParam(2,$password);
    $stmt->execute();
    $row = $stmt->fetch();
    
    if ($row && $row['type']!="Passive Member")
    {
        foreach (array_keys($row) as $key)
            $_SESSION[$key] = $row[$key];
        $_SESSION['recherche'] = "";
        $_SESSION['message'] = "";
        $_SESSION['messageColor'] = "";
        echo 'true';
    }
    else
    {
        echo 'false';
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BDD AQM</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200" rel="stylesheet"/>
    <!-- Style.css -->
    <link rel="stylesheet" href="style.css" type="text/css"/>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  </head>
  <body>

<style>

    .inputText {
        text-align:center;
        transition: background-color 0.5s ease;
        background-color:rgba(255,255,255,0);
        color:white;
        border: 1px solid white;
        border-radius:25px;
        padding:10px;
        margin:15px;
    }

    .inputText:focus {
        outline:none;
        background-color:rgba(0,0,0,0.2);
    }

    #loginDiv {
        position:fixed;
        top:15%;
        width:60%;
        height:45%;
        overflow:hidden;
        padding-right:0px;
        padding-left:0px;
        padding-top:40px;
        opacity:1;
    }

    #contactDiv {
        cursor:pointer;
        transition:background-color 0.6s ease;
        background-color:rgba(0,0,0,0.5);
        border:1px solid white;
        border-bottom:none;
        border-radius:10px 10px 0px 0px;
        position:fixed;
        bottom:-2px;
        height:50px;
        width:250px;
        left:0px;
        right:0px;
        margin:auto;
        text-align:center;
        opacity:1;
    }

    #contactDiv:hover {
        background-color:rgba(0,0,0,0.7);
    }

    #contactMessageDiv {
        position:fixed;
        top:100%;
        width:60%;
        height:50%;
        overflow:hidden;
        padding-top:20px;
        padding-right:0px;
        padding-left:0px;
        opacity:0;
    }

    #quiSommesNousDiv {
        position:fixed;
        top:100%;
        width:60%;
        height:350px;
        overflow:hidden;
        padding-top:20px;
        opacity:0;
    }

    textarea {
        transition:background-color 0.5s ease;
        background-color:rgba(0,0,0,0.2);
        border:1px solid white;
        border-radius:10px;
        width:80%;
        height:60%;
        padding:10px;
    }

    textarea:focus {
        outline:none;
        background-color:rgba(0,0,0,0.4);
    }

    @keyframes jumpDown {
        0% {top:0px;}
        50% {top:10px;}
        100% {top:0px;}
    }

    .scrollButton {
        animation: jumpDown 1s infinite;
        margin:0 auto;
        position:relative;
    }

</style>

<script>
    function usernameKeyUp(source,event) {
        if (event.keyCode == 13) {
            if (source.value!="") {
                $("#inputDiv").animate({right:'100%'}, 700);
                $("#inputUsername").animate({opacity:0}, 700);
                $("#inputPassword").animate({opacity:1}, 700, function() {
                                            document.getElementById("password").focus();
                                            });
            }
            else {
                //Mouvements imbriqués, pour faire un effet de balayage
                $("#inputUsername").animate({right:'20px'}, 100, function() {
                    $("#inputUsername").animate({right:'-10px'}, 100, function() {
                        $("#inputUsername").animate({right:'5px'}, 100, function() {
                            $("#inputUsername").animate({right:'0px'}, 100);
                        });
                    });
                });
            }
        }
    }

    function passwordKeyUp(source,event) {
        if (event.keyCode == 13) {
            if (source.value!="") {
                $.post("login.php", {username:document.getElementById("username").value, password:source.value}, function(res) {
                       
					   if (res=="true") {
                   
							document.location="index.php";
                       }
                       else {
                            $("#errorDiv").animate({bottom:'20px'}, 400, function() {});
                            //Mouvements imbriqués, pour faire un effet de balayage
                            $("#inputPassword").animate({left:'20px'}, 100, function() {
                                $("#inputPassword").animate({left:'-10px'}, 100, function() {
                                    $("#inputPassword").animate({left:'5px'}, 100, function() {
                                        $("#inputPassword").animate({left:'0px'}, 100);
                                    });
                                });
                            });
                       }
                });
            }
            else {
                //Mouvements imbriqués, pour faire un effet de balayage
                $("#inputPassword").animate({left:'20px'}, 100, function() {
                    $("#inputPassword").animate({left:'-10px'}, 100, function() {
                        $("#inputPassword").animate({left:'5px'}, 100, function() {
                            $("#inputPassword").animate({left:'0px'}, 100);
                        });
                    });
                });
            }
        }
    }

    function contact() {
        $("#contactDiv").animate({opacity:0}, 300);
        $("#loginDiv").animate({top:'-45%',opacity:0}, 800);
        $("#contactMessageDiv").animate({top:'20%',opacity:1},800);
        $("#quiSommesNousButton").animate({opacity:0}, 300);
        $("#quiSommesNousButtonBack").animate({top:'-10%',opacity:0},800);
        $("#quiSommesNousDiv").animate({top:'100%',opacity:0},800);
    }

    function backContact() {
        $("#contactDiv").animate({opacity:1}, 300);
        $("#loginDiv").animate({top:'15%',opacity:1}, 800);
        $("#contactMessageDiv").animate({top:'100%',opacity:0},800);
        $("#quiSommesNousButton").animate({opacity:1}, 300);
    }

    function quiSommesNous() {
        $("#quiSommesNousButton").animate({opacity:0}, 300);
        $("#loginDiv").animate({top:'-45%',opacity:0}, 800);
        $("#quiSommesNousButtonBack").animate({top:'12%',opacity:1},800);
        $("#quiSommesNousDiv").animate({top:'25%',opacity:1},800);
    }

    function quiSommesNousBack() {
        $("#quiSommesNousButton").animate({opacity:1}, 300);
        $("#loginDiv").animate({top:'15%',opacity:1}, 800);
        $("#quiSommesNousButtonBack").animate({top:'-10%',opacity:0},800);
        $("#quiSommesNousDiv").animate({top:'100%',opacity:0},800);
    }

</script>

    <div class="background" style="top:0px;">
        <img class="bgImg" src="img/index.png" alt="" draggable="false"/>

        <div id="loginDiv" class="centerDiv">

            <h1>BDD <span style="color:#ff8c1a;">AQM</span></h1><br/>

            <div id="inputDiv" style="position:relative;width:200%;height:72px;right:0%">
                <div id="inputUsername" style="position:relative;width:50%;float:left;">
                    <span style="color:#ff8c1a;font-size:18px;">Username</span>
                    <input type="text" class="inputText" name="username" id="username" onkeyup="usernameKeyUp(this,event)" style="width:250px" autofocus/>
                </div>
                <div id="inputPassword" style="position:relative;width:50%;opacity:0;float:left;">
                    <span style="color:#ff8c1a;font-size:18px;">Mot de passe</span>
                    <input type="password" class="inputText" name="password" id="password" onkeyup="passwordKeyUp(this,event)" style="width:200px"/>
                    <span style="cursor:pointer" onclick="$('#inputDiv').animate({right:'0%'}, 700, function() {document.getElementById('username').focus();});$('#inputUsername').animate({opacity:1}, 700);$('#inputPassword').animate({opacity:0}, 700);$('#errorDiv').animate({bottom:'-50px'}, 700);">Retour</span>
                </div>
            </div>
            <div id="errorDiv" style="position:absolute;bottom:-50px;height:40px;padding-top:1px;background-color:rgba(220,0,0,0.3);color:white;width:100%;">
                <h5>Username ou mot de passe incorrect</h5>
            </div>

        </div>

        <div id="quiSommesNousButton" style="position:absolute;top:65%;width:100%;height:50px;display:inline-block;text-align:center;" ><div class="buttonClassic scrollButton" onclick="quiSommesNous()"><h4 style="padding-right:2px;padding-top:2px;"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></h4><h5 style="position:relative;top:6px;right:40px;white-space:nowrap">Qui sommes nous ?</h5></div></div>

        <div id="contactDiv" onclick="contact()">
            <h4 style="color:#ff8c1a">Contact</h4>
        </div>

        <div id="contactMessageDiv" class="centerDiv">
            <h4 style="color:#ff8c1a">Votre message</h4>
            <textarea id="textMessage"></textarea>
            <h5>Merci de bien vouloir laisser votre e-mail pour vous recontacter</h5>
            <div style="display:flex;justify-content:center;width:100%;">
                <div class="buttonClassic" style="width:250px;border-radius:15px;margin-right:3px;" onclick="backContact();"><h4>Annuler</h4></div>
                <div class="buttonClassic" style="width:250px;border-radius:15px;margin-left:3px;" onclick="$.post('send_message.php', {message:document.getElementById('textMessage').value}, function (res) { document.getElementById('contactMessageDiv').innerHTML=res; } );"><h4>Envoyer</h4></div>
            </div>
        </div>

        <div id="quiSommesNousButtonBack" style="position:fixed;top:-10%;opacity:0;width:100%;height:50px;display:inline-block;text-align:center;" ><div class="buttonClassic scrollButton" onclick="quiSommesNousBack()"><h4 style="position:relative;right:1px;"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></h4></div></div>

        <div id="quiSommesNousDiv" class="centerDiv">
            <h3 style="color:#ff8c1a">Qui sommes nous ?</h3><br/>
            <p style="font-size:16px;text-align:justify;">Bienvenue sur la base de données collaborative d'analyse quantifiée de la marche. <br/>
                Ce site a pour vocation de réunir des informations sur la <span style="color:#ff8c1a">marche de patients</span> à pathologie affectant ou réduisant leur mobilité, et ce à une <span style="color:#ff8c1a">échelle nationale</span>.<br/>
                L'objectif est, à terme, de proposer aux médecins un service d'<span style="color:#ff8c1a">aide à la décision</span> en s'appuyant sur la comparaison statistique de cas similaires, afin d'estimer dans la plus fiable mesure une corrélation entre <span style="color:#ff8c1a">traitements et évolution du sujet</span>.<br/>
                Si votre centre d'analyse porte un interêt certain à cette prestation, la section <span style="color:#ff8c1a">"contact"</span> est ouverte à toute question ou demande de participation.
            </p>
        </div>
    </div>
  </body>
</html>
