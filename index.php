<?php 


    require_once 'classes/Knjiga.php';
    session_start();
        
    $poruka = array();
    $naslov = '';
    $opis = '';
    $autor = '';
    $cena = '';
    $link = '';

    function ocisti($input){
        $input = trim($input);
        $input = stripslashes($input); // removes / from sting
        $input = htmlspecialchars($input);

        return $input;
    }


    if(isset($_POST['knjiga'])){
        $naslov = $_POST['naslov'];
        $autor = $_POST['autor'];
        $opis = $_POST['opis'];
        $cena = $_POST['cena'];
        $link = $_POST['link'];

        if(empty($naslov)){
            $poruka['naslov'] = '<p><label class="text-danger">Molimo Vas unesite naslov.</label></p>';
        }

        if(empty($autor)){
            $poruka['autor'] = '<p><label class="text-danger">Molimo Vas unesite autora.</label></p>';
        }

        if(empty($opis)){
            $poruka['opis'] = '<p><label class="text-danger">Molimo Vas unesite opis.</label></p>';
        }

        if(empty($cena)){
            $poruka['cena'] = '<p><label class="text-danger">Molimo Vas unesite cenu.</label></p>';
        }

        if(empty($link)){
            $poruka['link'] = '<p><label class="text-danger">Molimo Vas unesite link.</label></p>';
        }


        if(count($poruka) == 0){
            $knjiga = new Knjiga($naslov, $autor, $opis, $cena, $link, $_SESSION['korisnik']['id']);
            
            if($knjiga->dodaj()){
                header("Location: index.php");
            }else{
                $poruka['knjiga'] = '<p><label class="text-danger">Greška prilikom dodavanja.</label></p>';
            }
        }
    }

    if(isset($_POST['izbrisi'])){
        Knjiga::izbrisi($_POST['knjigaID']);
    }



?>



<?php require_once 'includes/header.php'; ?>

    <div class="container">
        <div class="row">

                <?php 
                    $knjige = Knjiga::uzmiSve();

                    foreach($knjige as $knjiga){ ?>
                        

                    <div class="col-md-4 mb-3 mt-3">
                        <div class="card mb-3">
                            <h3 class="card-header">NASLOV: <?php echo $knjiga['naslov']; ?></h3>
                            <div class="card-body">
                                <h5 class="card-title">AUTOR: <?php echo $knjiga['autor']; ?></h5>
                                <h6 class="card-subtitle text-muted">Predlozio/la: <?php echo Knjiga::nadjiKorisnika($knjiga['korisnik_id']); ?></h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text">OPIS: <br><?php echo $knjiga['opis']; ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="<?php echo $knjiga['prodavnica']; ?>" class="card-link">Link do prodavnice</a></li>
                            </ul>
                            <div class="card-body">
                                <button class="btn btn-sm btn-warning"><a href="#" class="card-link">Ažuriraj</a></button>
                                <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="knjigaID" value="<?php echo $knjiga['id']; ?>">
                                    <button name="izbrisi" class="btn btn-sm btn-danger">Izbriši</a>
                                </form>
                            </div>
                            <div class="card-footer text-muted">
                                CENA: <?php echo $knjiga['cena']; ?>$
                            </div>
                        </div>
                    </div>

                    <?php }
                ?>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">


                <div class="container" style="text-align: center;">
                    <a class="btn btn-success pull-right" role="button" data-toggle="collapse" href="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
                        <i class="fas fa-plus"></i> Dodajte novu knjigu
                    </a>
                </div>

                <div class="<?php if(count($poruka) == 0) echo 'collapse'?>" id="collapseForm" style="margin-top: 4rem; margin-bottom: 4rem;">
                    <div class="well">
                    <?php if(!Korisnik::ulogovan()) : ?>
                        <!--If the user is not logged in, direct him to the login page-->
                        <h5 style="text-align: center;">Morate biti prijavljeni pre dodavanja nove knjige. <a href="login.php">Kliknite ovde</a> da se prijavite.</h5>
                    <?php endif; ?>
                    <?php if(Korisnik::ulogovan()): ?>
                        <!--If the user is logged in, show the new comment form-->
                        <h4>Popunite podatke o knjizi <i class="fas fa-pencil-alt"></i></h4>
                        <?php if(array_key_exists('knjiga', $poruka)) echo $poruka['knjiga']; ?>
                        <form method="POST">
                        <div class="form-group">
                            <input class="form-control" type="text" disabled value="Korisnik: <?php echo $_SESSION['korisnik']['nadimak']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="naslov" type="text" placeholder="Naslov" value="<?php if(isset($naslov)) echo $naslov; ?>">
                            <?php if(array_key_exists('naslov', $poruka)) echo $poruka['naslov']; ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="autor" type="text" placeholder="Autor" value="<?php if(isset($autor)) echo $autor; ?>">
                            <?php if(array_key_exists('autor', $poruka)) echo $poruka['autor']; ?>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="opis" placeholder="Opis..." rows="5" cols="70"><?php if(isset($opis)) echo $opis; ?></textarea>
                            <?php if(array_key_exists('opis', $poruka)) echo $poruka['opis']; ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="cena" type="number" placeholder="Cena u $" value="<?php if(isset($cena)) echo $cena; ?>">
                            <?php if(array_key_exists('cena', $poruka)) echo $poruka['cena']; ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="link" type="text" placeholder="Link prodavnice" value="<?php if(isset($link)) echo $link; ?>">
                            <?php if(array_key_exists('link', $poruka)) echo $poruka['link']; ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="knjiga" style="width: 100%;">Pošalji <i class="far fa-comment"></i></button>
                        </div>
                        </form>
                    <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

   


<?php require_once 'includes/footer.php'; ?>
