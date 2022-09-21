<?php
$dbconn = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=Nicomm.88')
    or die('Could not connect: ' . pg_last_error());
?>
<!DOCTYPE html>
<html class="example::-webkit-scrollbar example">
<head>
<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Home | Aperimeet</title>
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
</head>
<body style="background-color: rgb(240,121,42)">
    <div class="gridinterna">
            <div class="gridinterna" style="height:100px;"></div>
        <?php
        ob_start();
        if ($dbconn){
            session_start();
            $email = $_SESSION["sessionEmail"];
            $q1 = "select distinct richiesta.email, nome, locale, orario, partecipanti, data, prenotati, descrizione, immagine 
                   from richiesta join utente on richiesta.email = utente.email 
                   where richiesta.email!='$email'";
            $result = pg_query($dbconn,$q1);
            function prenotati($emailrichiesta,$locale,$orario,$partecipanti,$data,$email,$dbconn,$prenotati,$descrizione){
                $q2 = "select * 
                   from richiesta join utente on richiesta.email = utente.email 
                   where richiesta.email=$1 and locale=$2 and orario=$3 and partecipanti=$4 and data=$5";
                $result = pg_query_params($dbconn,$q2,array($emailrichiesta,$locale,$orario,$partecipanti,$data));
                if($result==null) return;  
                $prenotati = intval($prenotati) +1;
                $q2 = "insert into richiesta values($1,$2,$3,$4,$5,$6,$7,$8)";
                $result = pg_query_params($dbconn,$q2,array($emailrichiesta,$locale,$orario,$partecipanti,$data,$email,$prenotati,$descrizione));
                if($result){
                    $q3 = "update richiesta set prenotati = $1 where email = $2 and locale= $3 and orario= $4 and data= $5";
                    $result2 = pg_query_params($dbconn,$q3,array($prenotati,$emailrichiesta,$locale,$orario,$data));
                    }
            }
            $prova=0;
            while($row = pg_fetch_assoc($result)) {
                $query = "select distinct richiesta.email, nome, locale, orario, partecipanti, data, prenotati, descrizione, immagine
                          from richiesta join utente on richiesta.email = utente.email 
                          where richiesta.email!='$email' and prenotato = '$email' ";
                $result4 = pg_query($dbconn,$query);
                while($row2 = pg_fetch_assoc($result4)){
                    if($row==$row2) goto a;
                }
                $prova +=1;
                $emailrichiesta = $row["email"];
                $nome = $row["nome"];
                $locale = $row["locale"];
                $orario = $row["orario"];
                $partecipanti = $row["partecipanti"];
                $prenotati = $row["prenotati"];
                $descrizione = $row["descrizione"];
                $data = $row["data"];
                $parts = explode(",", $locale,2);
                $nome_locale = $parts[0];
                $indirizzo = $parts[1];
                if($row["immagine"]==null) $immagine = 'profilo.png';
                else $immagine = $row["immagine"];
                //identificazione università
                $dominio = explode("@",$emailrichiesta,2);
                if($dominio[1]=='studenti.uniroma1.it') $universita = 'La Sapienza';
                if($dominio[1]=='@stud.uniroma3.it') $universita = 'Roma 3';
                //eliminazione richieste scadute
                $DateAndTime = date('Y-m-d h:i', time());  
                $dataeora = explode(" ",$DateAndTime,2);
                $orarioeliminazione = explode(":",$orario,2);
                $orarioeliminazione[0] = strval(intval($orarioeliminazione[0]) +1);
                $orarioeliminazione = $orarioeliminazione[0] . ":" . $orarioeliminazione[1];
                if($dataeora[0]==$data && $dataeora[1]==$orarioeliminazione){
                    $query = "delete from richiesta where email=$1 and locale=$2 and orario=$3 and partecipanti=$4 and data=$5";
                    $result2 = pg_query_params($dbconn,$query,array($emailrichiesta,$locale,$orario,$partecipanti,$data));
                    continue;
                }
                //stampa delle richieste
                $richiesta = <<<HTML
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Home | Aperimeet</title> 
                    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
                    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
                    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
                    <link rel="manifest" href="../site.webmanifest">
                    <link rel="stylesheet" href="style.css">
                    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.css">
                    <link rel="stylesheet" href="bootstrap/css/bootstrap-utilities.css">
                    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.rtl.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
                    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> 
                </head>
                <body style="background-color: rgb(240,121,42)" class="scrollbar">
                    <div class="phpgrid" >
                        <div class="formgrid vert" frameBorder="0">
                            <div class="intformgrid myborder" style="background-color: white" frameBorder="0">
                                <div class="intformgrid1">
                                    <div class="position-relative">
                                        <div class="position-absolute top-0 start-0" style=" padding-left:8px; padding-top:12px;"><h3>Aperitivo di $nome</h3></div>
                                    </div>
                                    <div class="position-relative">
                                        <div class="position-absolute bottom-0 start-0" style="padding-bottom: 12px; padding-left:8px;"><h3>Università $universita</h3></div>
                                    </div>
                                </div>
                                <div align="right" style=" padding-right:5px; padding-top:5px; padding-bottom: 5px;"><img src="../profilo/$immagine" style="max-width: 120px" class="avatar"></div>
                            </div>
                            <div class="intformgrid2 myborder" style="background-color: white; padding-bottom: 8px; padding-left:8px; padding-top:8px; padding-right: 8px;" frameBorder="0">
                                <div class="intformgrid3">
                                    <div>
                                        <h3>Bar: $nome_locale</h3>
                                        <h6>$indirizzo</h6>
                                        <h4>il giorno $data</h4>
                                        <h4>alle ore $orario <br><br><br><br></h4>
                                    </div>
                                    <div>
                                        <h3>Descrizione evento:</h3>
                                        <h6>$descrizione<br><br><br><br></h6>
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <div class="position-absolute bottom-0 start-0"><h3>Partecipanti: $prenotati su $partecipanti</h3></div>
                                    <form method="post">
                                        <div class="position-absolute bottom-0 end-0"  style="padding-bottom: 5px; padding-right:5px;"><button class="btn my-2 my-sm-0 btncolor mr-sm-2" type="submit"  style="width: 100px; height:40px;" name="$prova">Prenota</button></div>
                                    </form>                             
                                    </div>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
                HTML;
                echo $richiesta;
                a:
                if(isset($_POST["$prova"])){
                     prenotati($emailrichiesta,$locale,$orario,$partecipanti,$data,$email,$dbconn,$prenotati,$descrizione);
                     header("Refresh: 0");
                     ob_end_flush();
                }
            }
        }
        ?>
        <div class="gridinterna" style="height:44px;"></div>
        </div>
</body>
</html>


