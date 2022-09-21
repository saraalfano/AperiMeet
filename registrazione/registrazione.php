<?php
if (!(isset($_POST['registraButton']))) {
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
        $email=$_COOKIE['email'];
        $nome = $_COOKIE['nome'];
        $cognome = $_COOKIE['cognome'];
        $password = $_COOKIE['pass'];
        $src = null;
        $pagina = <<<HTML
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
        <body style="errorgrid">
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
        <form action="registrazione.php" class="form-signin" method="post" name="myForm">
        <h2><font face="Bodoni" color="white" ><strong>Registrazione avvenuta con successo.</strong></font></h2>
        <div><br></div>
        <h2><font face="Bodoni" color="white" ><strong>Vivi l'esperienza Aperimeet</strong></font></h2>
        <h3><font face="Bodoni" color="white" >Clicca <a href='../login/login.html'> qui </a> per iniziare.</font></h3>
        </form>
        </div>
        </div> 
        <!--<div align="center">
        <h1><font face="Bodoni" color="white">Registrazione avvenuta con successo.
            Vivi l'esperienza con AperiMeet<br></font></h1>
        <div><br></div>
        
        </div>  -->          
        </body>
        </html>
        HTML;
        $q2 = "insert into utente values($1,$2,$3,$4,$5)";
        $data = pg_query_params($dbconn,$q2,array($email,$nome,$cognome,$password,$src));
        if($data){
            setcookie("email", "", time() - 3600);
            setcookie("nome", "", time() - 3600);
            setcookie("cognome", "", time() - 3600);
            setcookie("pass", "", time() - 3600);
            echo $pagina;
        }
    }
?>
</body>
</html>