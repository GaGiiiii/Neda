<?php 


    require_once 'classes/Knjiga.php';
    session_start();

    $poruka = array();
    $naslov = '';
    $opis = '';
    $autor = '';
    $cena = '';
    $link = '';

    $poruka2 = array();
    $naslov2 = '';
    $opis2 = '';
    $autor2 = '';
    $cena2 = '';
    $link2 = '';

    function ocisti($input){
        $input = mysqli_real_escape_string(Database::getInstance()->getConnection(), $input);
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
        }else{
            $naslov = ocisti($naslov);
        }

        if(empty($autor)){
            $poruka['autor'] = '<p><label class="text-danger">Molimo Vas unesite autora.</label></p>';
        }else{
            $autor = ocisti($autor);
        }

        if(empty($opis)){
            $poruka['opis'] = '<p><label class="text-danger">Molimo Vas unesite opis.</label></p>';
        }else{
            $opis = ocisti($opis);
        }

        if(empty($cena)){
            $poruka['cena'] = '<p><label class="text-danger">Molimo Vas unesite cenu.</label></p>';
        }else{
            $cena = ocisti($cena);
        }

        if(empty($link)){
            $poruka['link'] = '<p><label class="text-danger">Molimo Vas unesite link.</label></p>';
        }else{
            $link = ocisti($link);
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

    if(isset($_POST['knjiga2'])){
        $naslov2 = $_POST['naslov2'];
        $autor2 = $_POST['autor2'];
        $opis2 = $_POST['opis2'];
        $cena2 = $_POST['cena2'];
        $link2 = $_POST['link2'];

        if(empty($naslov2)){
            $poruka2['naslov2'] = '<p><label class="text-danger">Molimo Vas unesite naslov.</label></p>';
        }else{
            $naslov2 = ocisti($naslov2);
        }

        if(empty($autor2)){
            $poruka2['autor2'] = '<p><label class="text-danger">Molimo Vas unesite autora.</label></p>';
        }else{
            $autor2 = ocisti($autor2);
        }

        if(empty($opis2)){
            $poruka2['opis2'] = '<p><label class="text-danger">Molimo Vas unesite opis.</label></p>';
        }else{
            $opis2 = ocisti($opis2);
        }

        if(empty($cena2)){
            $poruka2['cena2'] = '<p><label class="text-danger">Molimo Vas unesite cenu.</label></p>';
        }else{
            $cena2 = ocisti($cena2);
        }

        if(empty($link2)){
            $poruka2['link2'] = '<p><label class="text-danger">Molimo Vas unesite link.</label></p>';
        }else{
            $link2 = ocisti($link2);
        }


        if(count($poruka2) == 0){
            $props = [
                'naslov' => $naslov2,
                'autor' => $autor2,
                'cena' => $cena2,
                'opis' => $opis2,
                'link' => $link2
            ];

            if(Knjiga::azuriraj($_POST['knjiga2ID'], $props)){
                header("Location: index.php");
            }else{
                $poruka2['knjiga2'] = '<p><label class="text-danger">Greška prilikom azuriranja.</label></p>';
            }
        }
    }


?>



<?php require_once 'includes/header.php'; ?>

    <div class="container">
        <div class="row" id="knjige-row-container">

            <div class="col-md-12" style="padding: 0;">
                <form method="POST" id="sortiraj-forma">
                    <fieldset>
                        <div class="form-group">
                        <label for="sortiraj-select">Sortiraj po</label>
                        <select class="form-control" id="sortiraj-select">
                            <option value="cena">Cena</option>
                            <option value="naziv">Naziv</option>
                        </select>
                        </div>
                        <button type="submit" value="sortiraj" class="btn btn-primary">Sortiraj</button>
                    </fieldset>
                </form>
            </div>

            <div id="knjige-container" class="row">
            
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

                                <?php if(isset($_SESSION['korisnik']) && Knjiga::pripadaKorisniku($knjiga['id'], $_SESSION['korisnik']['id'])) : ?> 

                                    <a class="btn btn-warning btn-sm" role="button" data-toggle="collapse" href="#collapseEditForm<?php echo $knjiga['id']; ?>" aria-expanded="false" aria-controls="collapseEditForm">
                                        <i class="fas fa-pencil-alt"></i> Ažuriraj
                                    </a>
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="knjigaID" value="<?php echo $knjiga['id']; ?>">
                                        <button name="izbrisi" class="btn btn-sm btn-danger">Izbriši</button>
                                    </form>

                                    <div class="<?php if(count($poruka2) == 0 || $knjiga['id'] != $_POST['knjiga2ID']) echo 'collapse'?>" id="collapseEditForm<?php echo $knjiga['id'] ?>" style="margin-top: 2rem; margin-bottom: 4rem;">
                                        <div class="well">
                                        <?php if(Korisnik::ulogovan()): ?>
                                            <!--If the user is logged in, show the new comment form-->
                                            <h4>Popunite podatke o knjizi <i class="fas fa-pencil-alt"></i></h4>
                                            <?php if(array_key_exists('knjiga2', $poruka2)) echo $poruka2['knjiga2']; ?>
                                            <form method="POST">
                                                <input type="hidden" name="knjiga2ID" value="<?php echo $knjiga['id']; ?>">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" disabled value="Korisnik: <?php echo $_SESSION['korisnik']['nadimak']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="naslov2" type="text" placeholder="Naslov" value="<?php echo $knjiga['naslov']; ?>">
                                                    <?php if(array_key_exists('naslov2', $poruka2)) echo $poruka2['naslov2']; ?>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="autor2" type="text" placeholder="Autor" value="<?php echo $knjiga['autor']; ?>">
                                                    <?php if(array_key_exists('autor2', $poruka2)) echo $poruka2['autor2']; ?>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="opis2" placeholder="Opis..." rows="5" cols="70"><?php echo $knjiga['opis']; ?></textarea>
                                                    <?php if(array_key_exists('opis2', $poruka2)) echo $poruka2['opis2']; ?>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="cena2" type="number" placeholder="Cena u $" value="<?php echo $knjiga['cena']; ?>">
                                                    <?php if(array_key_exists('cena2', $poruka2)) echo $poruka2['cena2']; ?>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="link2" type="text" placeholder="Link prodavnice" value="<?php echo $knjiga['prodavnica']; ?>">
                                                    <?php if(array_key_exists('link2', $poruka2)) echo $poruka2['link2']; ?>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" name="knjiga2" style="width: 100%;">Ažuriraj <i class="far fa-comment"></i></button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                        </div>
                                    </div>

                                <?php endif; ?>

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


<script>

    const form = document.getElementById('sortiraj-forma');
    const select = document.getElementById('sortiraj-select');


    form.addEventListener('submit', (event) => {
        event.preventDefault();

        let izbor = select.options[select.selectedIndex].value;

        $.ajax({
            url: 'sortiraj.php',
            type: 'POST',
            data: {
                vrstaSorta: izbor
            },
            success: (response) => {
                console.log(response)
                document.getElementById('knjige-row-container').innerHTML = response;
            }
        });
    });
    
</script>
   


<?php require_once 'includes/footer.php'; ?>
