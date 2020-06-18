<?php 

    require_once 'classes/Korisnik.php';
    
    $poruka = array();
    $ime = '';
    $prezime = '';
    $nadimak = '';
    $email = '';
    $sifra = '';
    $sifra2 = '';

    function ocisti($input){
        $input = mysqli_real_escape_string(Database::getInstance()->getConnection(), $input);
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

        if(empty($ime)){
          $poruka['ime'] = '<p><label class="text-danger">Molimo Vas unesite ime.</label></p>';
        }else{
            $ime = ocisti($ime);
        }

        if(empty($prezime)){
          $poruka['prezime'] = '<p><label class="text-danger">Molimo Vas unesite prezime.</label></p>';
        }else{
            $prezime = ocisti($prezime);
        }

        if(empty($nadimak)){
          $poruka['nadimak'] = '<p><label class="text-danger">Molimo Vas unesite nadimak.</label></p>';
        }else{
            $nadimak = ocisti($nadimak);
        }

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
            $sifra2 = ocisti($sifra2);
          if($sifra !== $sifra2){
            $poruka['sifra2'] = '<p><label class="text-danger">Šifre se ne poklapaju.</label></p>';
          }
        }

        if(count($poruka) == 0){
            $korisnik = new Korisnik($ime, $prezime, $nadimak, $email, $sifra);
            
            if($korisnik->registruj()){
              //print_r($_SESSION['korisnik']['ime']);
              header("Location: index.php");
            }else{
              $poruka['registracija'] = '<p><label class="text-danger">Greška prilikom registracije.</label></p>';
            }
        }

    }

?>


<?php require_once 'includes/header.php'; ?>


<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">

        <div>
           <?php if(array_key_exists('registracija', $poruka)) echo $poruka['registracija']; ?>
        </div>

        <form method="POST">
            <fieldset>
                <legend>Registruj se</legend>
                <div class="form-group">
                    <input type="text" name="ime" class="form-control" id="exampleInputPassword1" value="<?php if(isset($ime)) echo $ime; ?>" placeholder="Unesite ime">
                    <?php if(array_key_exists('ime', $poruka)) echo $poruka['ime']; ?>
                </div>
                <div class="form-group">
                    <input type="text" name="prezime" class="form-control" id="exampleInputPassword1" value="<?php if(isset($prezime)) echo $prezime; ?>" placeholder="Unesite prezime">
                    <?php if(array_key_exists('prezime', $poruka)) echo $poruka['prezime']; ?>
                </div>
                <div class="form-group">
                    <input type="text" name="nadimak" class="form-control" id="exampleInputPassword1" value="<?php if(isset($nadimak)) echo $nadimak; ?>" placeholder="Unesite nadimak">
                    <?php if(array_key_exists('nadimak', $poruka)) echo $poruka['nadimak']; ?>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php if(isset($email)) echo $email; ?>" placeholder="Unesite email">
                    <?php if(array_key_exists('email', $poruka)) echo $poruka['email']; ?>
                </div>
                <div class="form-group">
                    <input type="password" name="sifra" class="form-control" id="exampleInputPassword1" placeholder="Unesite šifru">
                    <?php if(array_key_exists('sifra', $poruka)) echo $poruka['sifra']; ?>
                </div>
                <div class="form-group">
                    <input type="password" name="sifra2" class="form-control" id="exampleInputPassword2" placeholder="Potvrdite šifru">
                    <?php if(array_key_exists('sifra2', $poruka)) echo $poruka['sifra2']; ?>
                </div>
                <button type="submit" name="registracija" class="btn btn-primary">Prijava</button>
            </fieldset>
            </form>
        </div>
    </div>
</div>


<?php require_once 'includes/footer.php'; ?>
