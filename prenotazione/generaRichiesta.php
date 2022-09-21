<?php
if (!(isset($_POST['signButton']))) {
    header("Location: /");
}
else {
    $dbconn = pg_connect('host=localhost port=5432 dbname=postgres user=postgres password=Nicomm.88')
        or die('Could not connect: ' . pg_last_error());
}
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
if ($dbconn){
    session_start();
    $email = $_SESSION["sessionEmail"];
    $locale= $_POST['locale'];
    $orario = $_POST['ora'];
    $partecipanti = $_POST['partecipanti'];
    $data = $_POST['giorno'];
    $prenotato = $_SESSION["sessionEmail"];
    $prenotati = 1;
    $descrizione = $_POST['descrizione'];
    $q1 = "select * from richiesta where email=$1 and locale=$2 and orario=$3 and data=$4";
    $result = pg_query_params($dbconn,$q1,array($email,$locale,$orario,$data));
    if($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
        header("Location: /");  
        $message = "Errore: Hai già effettuato una prenotazione simile";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
        $q2 = 'insert into richiesta values($1,$2,$3,$4,$5,$6,$7,$8)';
        $result2 = pg_query_params($dbconn,$q2,array($email,$locale,$orario,$partecipanti,$data,$prenotato,$prenotati,$descrizione));
        if($result2){
            header("location: ../home/home.html");
        }
    }
}
?>
</body>
</html>