<?php 


  require_once 'classes/Korisnik.php';
      
  $poruka = array();
  $email = '';
  $sifra = '';

  function ocisti($input){
      $input = mysqli_real_escape_string(Database::getInstance()->getConnection(), $input);
      $input = trim($input);
      $input = stripslashes($input); // removes / from sting
      $input = htmlspecialchars($input);

      return $input;
  }


  if(isset($_POST['prijava'])){
      $email = $_POST['email'];
      $sifra = $_POST['sifra'];

      if(empty($email)){
          $poruka['email'] = '<p><label class="text-danger">Molimo Vas unesite email.</label></p>';
      }else{
          $email = ocisti($email);
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
              $poruka['email'] = '<p><label class="text-danger">Pogrešan Email Format</label></p>';
          }
      }

      if(empty($sifra)){
        $poruka['sifra'] = '<p><label class="text-danger">Molimo Vas unesite šifru.</label></p>';
      }else{
        $sifra = ocisti($sifra);
      }

      if(count($poruka) == 0){
          $korisnik = new Korisnik('', '', '', '', $sifra);
          
          if($korisnik->prijavi($email, $sifra)){
            header("Location: index.php");
          }else{
            $poruka['prijava'] = '<p><label class="text-danger">Pogrešna kombinacija.</label></p>';
          }
      }

  }

?>

<?php require_once 'includes/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">

        <?php if(array_key_exists('prijava', $poruka)) echo $poruka['prijava']; ?>

        <form method="POST">
            <fieldset>
                <legend>Prijavi se</legend>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email adresa</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite email" value="<?php if(isset($email)) echo $email; ?>">
                    <?php if(array_key_exists('email', $poruka)) echo $poruka['email']; ?>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Šifra</label>
                    <input type="password" name="sifra" class="form-control" id="exampleInputPassword1" placeholder="Unesite šifru">
                    <?php if(array_key_exists('sifra', $poruka)) echo $poruka['sifra']; ?>
                </div>
                <button type="submit" name="prijava" class="btn btn-primary">Prijava</button>
            </fieldset>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
