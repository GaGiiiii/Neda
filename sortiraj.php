<?php

    require_once 'classes/Knjiga.php';
    session_start();

    if(isset($_POST['vrstaSorta'])){
        $html2 = '';

        if($_POST['vrstaSorta'] == 'cena'){
            $knjige = Knjiga::sortirajPoCeni();

            foreach($knjige as $knjiga){
                    $html2 .= '<div class="col-md-4 mb-3 mt-3">
                        <div class="card mb-3">
                            <h3 class="card-header">NASLOV: ' . $knjiga["naslov"] . '</h3>
                            <div class="card-body">
                                <h5 class="card-title">AUTOR: ' . $knjiga["autor"] . '</h5>
                                <h6 class="card-subtitle text-muted">Predlozio/la: ' . Knjiga::nadjiKorisnika($knjiga["korisnik_id"]) . '</h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text">OPIS: <br>' . $knjiga["opis"] . '</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="' . $knjiga['prodavnica'] . '" class="card-link">Link do prodavnice</a></li>
                            </ul>
                            <div class="card-body">';

                                if(isset($_SESSION["korisnik"]) && Knjiga::pripadaKorisniku($knjiga["id"], $_SESSION["korisnik"]["id"])){
                                    $html2 .= '
                                    <a class="btn btn-warning btn-sm" role="button" data-toggle="collapse" href="#collapseEditForm' . $knjiga['id'] . '" aria-expanded="false" aria-controls="collapseEditForm">
                                        <i class="fas fa-pencil-alt"></i> Ažuriraj
                                    </a>
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="knjigaID" value="' . $knjiga['id'] . '">
                                        <button name="izbrisi" class="btn btn-sm btn-danger">Izbriši</button>
                                    </form>

                                    <div class="collapse" id="collapseEditForm' . $knjiga['id'] . '" style="margin-top: 2rem; margin-bottom: 4rem;">
                                        <div class="well">
                                            <h4>Popunite podatke o knjizi <i class="fas fa-pencil-alt"></i></h4>
                                            <form method="POST">
                                                <input type="hidden" name="knjiga2ID" value="' . $knjiga['id'] . '">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" disabled value="Korisnik: ' . $_SESSION['korisnik']['nadimak'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="naslov2" type="text" placeholder="Naslov" value="' . $knjiga['naslov'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="autor2" type="text" placeholder="Autor" value="' . $knjiga['autor'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="opis2" placeholder="Opis..." rows="5" cols="70">' . $knjiga['opis'] . '</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="cena2" type="number" placeholder="Cena u $" value="' . $knjiga['cena'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="link2" type="text" placeholder="Link prodavnice" value="' . $knjiga['prodavnica'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" name="knjiga2" style="width: 100%;">Ažuriraj <i class="far fa-comment"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>';

                                }
                                $html2 .= '
                            </div>
                            <div class="card-footer text-muted">
                                CENA: ' . $knjiga["cena"] . '$
                            </div>
                        </div>
                    </div>';
            }

            echo $html2;
        }else if($_POST['vrstaSorta'] == 'naziv'){
            $knjige = Knjiga::sortirajPoNazivu();

            foreach($knjige as $knjiga){
                $html2 .= '<div class="col-md-4 mb-3 mt-3">
                        <div class="card mb-3">
                            <h3 class="card-header">NASLOV: ' . $knjiga["naslov"] . '</h3>
                            <div class="card-body">
                                <h5 class="card-title">AUTOR: ' . $knjiga["autor"] . '</h5>
                                <h6 class="card-subtitle text-muted">Predlozio/la: ' . Knjiga::nadjiKorisnika($knjiga["korisnik_id"]) . '</h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text">OPIS: <br>' . $knjiga["opis"] . '</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="' . $knjiga['prodavnica'] . '" class="card-link">Link do prodavnice</a></li>
                            </ul>
                            <div class="card-body">';

                                if(isset($_SESSION["korisnik"]) && Knjiga::pripadaKorisniku($knjiga["id"], $_SESSION["korisnik"]["id"])){
                                    $html2 .= '
                                    <a class="btn btn-warning btn-sm" role="button" data-toggle="collapse" href="#collapseEditForm' . $knjiga['id'] . '" aria-expanded="false" aria-controls="collapseEditForm">
                                        <i class="fas fa-pencil-alt"></i> Ažuriraj
                                    </a>
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="knjigaID" value="' . $knjiga['id'] . '">
                                        <button name="izbrisi" class="btn btn-sm btn-danger">Izbriši</button>
                                    </form>

                                    <div class="collapse" id="collapseEditForm' . $knjiga['id'] . '" style="margin-top: 2rem; margin-bottom: 4rem;">
                                        <div class="well">
                                            <h4>Popunite podatke o knjizi <i class="fas fa-pencil-alt"></i></h4>
                                            <form method="POST">
                                                <input type="hidden" name="knjiga2ID" value="' . $knjiga['id'] . '">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" disabled value="Korisnik: ' . $_SESSION['korisnik']['nadimak'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="naslov2" type="text" placeholder="Naslov" value="' . $knjiga['naslov'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="autor2" type="text" placeholder="Autor" value="' . $knjiga['autor'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="opis2" placeholder="Opis..." rows="5" cols="70">' . $knjiga['opis'] . '</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="cena2" type="number" placeholder="Cena u $" value="' . $knjiga['cena'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="link2" type="text" placeholder="Link prodavnice" value="' . $knjiga['prodavnica'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" name="knjiga2" style="width: 100%;">Ažuriraj <i class="far fa-comment"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>';

                                }
                                $html2 .= '
                            </div>
                            <div class="card-footer text-muted">
                                CENA: ' . $knjiga["cena"] . '$
                            </div>
                        </div>
                    </div>';
            }

            echo $html2;
        }
    }
    