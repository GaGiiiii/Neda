<?php 


    require_once 'classes/Database.php';
    require_once 'classes/Korisnik.php';
    
    $db = new Database();

    $poruka = array();
    $ime = '';
    $prezime = '';
    $nadimak = '';
    $email = '';
    $sifra = '';
    $sifra2 = '';

    function ocisti($input){
        $input = trim($input);
        $input = stripslashes($input); // removes / from sting
        $input = htmlspecialchars($input);

        return $input;
    }


    if(isset($_POST['registracija'])){
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $nadimak = $_POST['nadimak'];
        $email = $_POST['email'];
        $sifra = $_POST['sifra'];
        $sifra2 = $_POST['sifra2'];

        if(empty($email)){
            $poruka['email'] = '<p><label class="text-danger">Molimo Vas unesite email.</label></p>';
        }else{
            $email = ocisti($email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $poruka['email'] = '<p><label class="text-danger">Pogrešan Email Format</label></p>';
            }
        }

        
        if(count($poruka) == 0){
            $korisnik = new Korisnik($ime, $prezime, $nadimak, $email, $sifra);
            
            if($db->registruj($korisnik)){
                echo "Uspesno registrovan.";
            }else{
                echo "Nije uspela registracija.";
            }
        }



    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Neda</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/5c5689b7a2.js"></script>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Neda</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Knjige <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Registruj se</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="odjava.php">Odjavi se</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Registruj se</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Traži">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Traži</button>
    </form>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">

        <form method="POST">
            <fieldset>
                <legend>Prijavi se</legend>
                <div class="form-group">
                    <?php if(array_key_exists('ime', $poruka)) echo $poruka['ime']; ?>
                    <input type="text" name="ime" class="form-control" id="exampleInputPassword1" placeholder="Unesite ime">
                </div>
                <div class="form-group">
                    <input type="text" name="prezime" class="form-control" id="exampleInputPassword1" placeholder="Unesite prezime">
                </div>
                <div class="form-group">
                    <input type="text" name="nadimak" class="form-control" id="exampleInputPassword1" placeholder="Unesite nadimak">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite email">
                    <?php if(array_key_exists('email', $poruka)) echo $poruka['email']; ?>
                </div>
                <div class="form-group">
                    <input type="password" name="sifra" class="form-control" id="exampleInputPassword1" placeholder="Unesite šifru">
                </div>
                <div class="form-group">
                    <input type="password" name="sifra2" class="form-control" id="exampleInputPassword2" placeholder="Potvrdite šifru">
                </div>
                <button type="submit" name="registracija" class="btn btn-primary">Prijava</button>
            </fieldset>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>