<?php

    require_once 'classes/Korisnik.php';

    if(!Korisnik::ulogovan()){
        header("Location: index.php");
    }

    Korisnik::odjavi();
    header("Location: index.php");
