<?php

    require_once 'classes/Knjiga.php';

    if(isset($_POST['vrstaSorta'])){
        $html = '';

        if($_POST['vrstaSorta'] == 'cena'){
            $knjige = Knjiga::sortirajPoCeni();

            foreach($knjige as $knjiga){
                $html .= '<div class="col-md-4 mb-3 mt-3">
                        <div class="card mb-3">
                            <h3 class="card-header">NASLOV: <?php echo $knjiga["naslov"]; ?></h3>
                            <div class="card-body">
                                <h5 class="card-title">AUTOR: <?php echo $knjiga["autor"]; ?></h5>
                                <h6 class="card-subtitle text-muted">Predlozio/la: <?php echo Knjiga::nadjiKorisnika($knjiga["korisnik_id"]); ?></h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text">OPIS: <br><?php echo $knjiga["opis"]; ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="<?php echo $knjiga[\'prodavnica\']; ?>" class="card-link">Link do prodavnice</a></li>
                            </ul>
                            <div class="card-body">

                                <?php if(isset($_SESSION["korisnik"]) && Knjiga::pripadaKorisniku($knjiga["id"], $_SESSION["korisnik"]["id"])) : ?> 

                                    <a class="btn btn-warning btn-sm" role="button" data-toggle="collapse" href="#collapseEditForm<?php echo $knjiga[\'id\']; ?>" aria-expanded="false" aria-controls="collapseEditForm">
                                        <i class="fas fa-pencil-alt"></i> Ažuriraj
                                    </a>
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="knjigaID" value="<?php echo $knjiga[\'id\']; ?>">
                                        <button name="izbrisi" class="btn btn-sm btn-danger">Izbriši</button>
                                    </form>

                                    <div class="<?php if(count($poruka2) == 0 || $knjiga[\'id\'] != $_POST[\'knjiga2ID\']) echo \'collapse\'?>" id="collapseEditForm<?php echo $knjiga[\'id\'] ?>" style="margin-top: 2rem; margin-bottom: 4rem;">
                                        <div class="well">
                                        <?php if(Korisnik::ulogovan()): ?>
                                            <!--If the user is logged in, show the new comment form-->
                                            <h4>Popunite podatke o knjizi <i class="fas fa-pencil-alt"></i></h4>
                                            <?php if(array_key_exists("knjiga2", $poruka2)) echo $poruka2["knjiga2"]; ?>
                                            <form method="POST">
                                                <input type="hidden" name="knjiga2ID" value="<?php echo $knjiga[\'id\']; ?>">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" disabled value="Korisnik: <?php echo $_SESSION[\'korisnik\'][\'nadimak\']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="naslov2" type="text" placeholder="Naslov" value="<?php echo $knjiga[\'naslov\']; ?>">
                                                    <?php if(array_key_exists("naslov2", $poruka2)) echo $poruka2["naslov2"]; ?>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="autor2" type="text" placeholder="Autor" value="<?php echo $knjiga[\'autor\']; ?>">
                                                    <?php if(array_key_exists("autor2", $poruka2)) echo $poruka2["autor2"]; ?>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="opis2" placeholder="Opis..." rows="5" cols="70"><?php echo $knjiga[\'opis\']; ?></textarea>
                                                    <?php if(array_key_exists("opis2", $poruka2)) echo $poruka2["opis2"]; ?>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="cena2" type="number" placeholder="Cena u $" value="<?php echo $knjiga[\'cena\']; ?>">
                                                    <?php if(array_key_exists("cena2", $poruka2)) echo $poruka2["cena2"]; ?>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="link2" type="text" placeholder="Link prodavnice" value="<?php echo $knjiga[\'prodavnica\']; ?>">
                                                    <?php if(array_key_exists("link2", $poruka2)) echo $poruka2["link2"]; ?>
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
                                CENA: <?php echo $knjiga["cena"]; ?>$
                            </div>
                        </div>
                    </div>';
            }

            echo $html;
        }else if($_POST['vrstaSorta'] == 'naziv'){
            $knjige = Knjiga::sortirajPoNazivu();



            echo $html;
        }
    }
    