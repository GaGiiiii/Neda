<?php 

    session_start();
    $username = '';

    include 'classes/Database.php';

    $database = new Database();
    $db = $database->getConnection();

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
        <a class="nav-link" href="login.php">Prijavi se</a>
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

        <form>
            <fieldset>
                <legend>Prijavi se</legend>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email adresa</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite email">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Šifra</label>
                    <input type="password" name="sifra" class="form-control" id="exampleInputPassword1" placeholder="Unesite šifru">
                </div>
                <button type="submit" name="prijava" class="btn btn-primary">Prijava</button>
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