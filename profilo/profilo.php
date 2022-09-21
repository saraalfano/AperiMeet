<?php
    $dbconn = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=Nicomm.88')
    or die('Could not connect: ' . pg_last_error());

        ob_start();
        if ($dbconn){
            function eliminaaccount($email,$dbconn){
                $q = "delete from utente where email='$email'";
                $result = pg_query($dbconn,$q);
                if($result){
                    $q = "delete from richiesta where prenotato='$email'";
                    $result = pg_query($dbconn,$q);
                }
            }
            function upload($email,$dbconn){
                $uploaddir = 'immagini/';
                $userfile_tmp = $_FILES['userfile']['tmp_name'];
                $userfile_name = $_FILES['userfile']['name'];
                if($userfile_name=='Nessun file scelto') return false;
                if(move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)){
                    $inserisco = "update utente set immagine='immagini/$userfile_name' where email='$email'";
                    $result = pg_query($dbconn,$inserisco);
                    header("Refresh : 0");
                    ob_end_flush();
                    return true;
                }
                return false;
            }
            session_start();
            $email = $_SESSION["sessionEmail"];
            $q1 = "select * from utente where email='$email'";
            $result = pg_query($dbconn,$q1);
            $row = pg_fetch_assoc($result);
            $nome = $row["nome"];
            $cognome = $row["cognome"];
            if($row["immagine"]==null) $immagine = 'profilo.png';
            else $immagine = $row["immagine"];
            $pagina = <<<HTML
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Profilo | Aperimeet</title>
                <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
                <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
                <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
                <link rel="manifest" href="../site.webmanifest">
                <link rel="stylesheet" href="style.css">
                <link rel="stylesheet" href="../bootstrap/css/bootstrap-grid.css">
                <link rel="stylesheet" href="../bootstrap/css/bootstrap-utilities.css">
                <link rel="stylesheet" href="../bootstrap/css/bootstrap-grid.rtl.css">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            </head>
            <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
                <img class="flex" src="aperimeet  logo.jpg" alt="">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <form method="post">
                    <a href="../home/home.html"><img src="home.jpeg" style="width: 47px; height:47px;"></a>
                    <img src="esci.jpeg" id="show-popup-btn2" style="width: 60px; height:47px; padding-left: 15px;">
                    <div id="popup-container2">
                    <div id="close-btn-container2">
                        <span id="close-btn2"><font face="Bodoni" color="darkred" size="4"><strong>Chiudi</strong></font></span>
                    </div>
                    <p><font face="Bodoni" color="darkorange" size="4">Sei sicuro di voler uscire del tuo account?</p>
                    <p><strong>Torna presto!</strong></font></p>
                        <button type="submit" name="esci">Logout</button>
                    </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){
                $("#show-popup-btn2").click(function(){
                    $("#popup-container2").show();
                })
                $("#close-btn2").click(function(){
                    $("#popup-container2").hide();
                })
                })
            </script>
                </form>
                </div>
            </nav>
            <div class="profilegrid" style="padding-bottom: 60px;">
                <div class="position-relative vert">
                    <div class="profilevert">
                    <div><br></div>
                    <div class="w3-panel w3-border-top w3-border-bottom w3-border-deep-orange">
                        <div align="center">
                        <div><br></div>
                        <div><br></div>
                        <div><br></div>
                        <div><br></div>
                        <form method="post" enctype="multipart/form-data">
                        <img src="$immagine" class="avatar">
                        <div><br></div>
                        <input type="file" id="imageFile" accept=".jpg, .jpeg, .png" alt="Submit" name="userfile">
                        <button type="submit" name="upload">Carica Foto</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div><br></div>
                    <div class="w3-panel w3-border-top w3-border-bottom w3-border-deep-orange">
                        <div><br></div>
                        <h3 style="text-align:center;"><font face="Bodoni" color="black" size="5"> Nome: &emsp;</font><font face="Bodoni" style="color: rgb(240,121,42);" size="10"><strong>$nome</font></strong></h3>
                        <h3 style="text-align:center;"><font face="Bodoni" color="black" size="5">Cognome: &emsp;</font><font face="Bodoni" style="color: rgb(240,121,42);" size="10"><strong>$cognome</font></strong></h3>
                        <div><br></div>
                        <div><br></div>
                        <h6 style="text-align:center; color:black;"><font face="Bodoni" size="5">Email universitaria:</font></h6>
                        <h6 style="text-align:center; color:rgb(240,121,42);"><font face="Bodoni"  size="4">$email</font></h6>
                        <div><br></div>
                        <div><br></div>
                        <!--<div align="center">
                        <a href="../login.html"><img src="assistenza.png" style="width: 50px; height:55px;"></a>
                        </div>
                        -->
                        <div align="center">
                        <img src="assistenza.png" id="show-popup-btn3" style="width: 50px; height:55px;">
                        </div>
                        <div id="popup-container3">
                            <div id="close-btn-container3">
                            <span id="close-btn3"><font face="Bodoni" color="darkred" size="4"><strong>Chiudi</strong></font></span>
                            </div>
                            <p><font face="Bodoni" color="darkorange" size="4"><strong>Scrivici una mail a aperimeet@gmail.com</strong></p>
                            <p>proveremo ad aiutarti il prima possibile!</font></p>
                        </div>
                        <h2 style="text-align:center;"><font face="Bodoni" color="black" size="4">*Termini e Condizioni</font></h2>
                        </div>
                        <div><br></div>
                        <div><br></div>
                        <div align="center">
                        <button id="show-popup-btn">Elimina account</button>
                        </div>
                        <div id="popup-container">
                            <div id="close-btn-container">
                            <span id="close-btn"><font face="Bodoni" color="darkred" size="4"><strong>Chiudi</strong></font></span>
                            </div>
                            <p><font face="Bodoni" color="darkorange" size="4">In questo modo non potrai più partecipare alle tante richieste di aperitivo nella tua zona!</p>
                            <p><strong>Sicuro di voler eliminare il tuo account?</strong></font></p>
                            <form method="post">
                            <button type="submit" name="eliminaAccount">Elimina</button>
                            </form>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                        $("#show-popup-btn3").click(function(){
                        $("#popup-container3").show();
                        })
                        $("#close-btn3").click(function(){
                        $("#popup-container3").hide();
                        })
                        })
                    </script>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        $("#show-popup-btn").click(function(){
                        $("#popup-container").show();
                        })
                        $("#close-btn").click(function(){
                        $("#popup-container").hide();
                        })
                    })
                    </script>
            </body>
        </html>
        HTML;
        echo $pagina;
        if(isset($_POST["eliminaAccount"])){
            eliminaaccount($email,$dbconn);
            header("Location: ../profilo/eliminato.html");
            session_destroy();
            ob_end_flush();
        }
        if(isset($_POST["esci"])){
            header("Location: ../login/login.html");
            session_destroy();
            ob_end_flush();
        }
        if(isset($_POST["upload"])){
            if($immagine == 'profilo.png'){
                upload($email,$dbconn);
            }
            else{ 
                if(upload($email,$dbconn)==true) @unlink($immagine);
            }
            }
        }
?>
