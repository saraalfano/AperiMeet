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
<head>
</head>
<body>
<?php
if ($dbconn){
    $email=$_POST['inputEmail'];
    $q1 = "select * from utente where email=$1";
    $result = pg_query_params($dbconn,$q1,array($email));
    if($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
        $giaregistrato = <<<HTML
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Registrazione | Aperimeet</title>
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
        <body class="errorgrid">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top flexnav">
        <img class="flex" src="aperimeet  logo.jpg" alt="">
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          </ul>
          <div>
        </div>
        </div>
        </nav>
        <div><br></div>
        <div><br></div>
        <div><br></div>
        <div><br></div>
        <div class="position-relative vert2">
        <div class="testo position-relative center-50 start-0" style="padding-left: 30px; padding-right: 30px; padding-top: 50px;">
        <h2><font face="Bodoni" color="white" ><strong>Mmm... <br>
        Sei gia un utente registrato al sito.</strong></font></h2>
        <div><br></div>
        <h4 ><font face="Bodoni" color="white">Clicca <a href='../login/login.html'>qui</a> per loggarti.</font></h4>
        </div>
        </div>            
        </body>
        </html>
        HTML;
        echo $giaregistrato;
    }
    else{
        setcookie("email",$email,time() + (86400), "/");
        setcookie("nome",$_POST['nome'],time() + (86400), "/");
        setcookie("cognome",$_POST['cognome'],time() + (86400), "/");
        setcookie("pass",md5($_POST['pass']),time() + (86400), "/");
        header("location: compilato.html");
    }
}
?>
</body>
</html>