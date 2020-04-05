<?php

    class Korisnik{

        public $ime;
        public $prezime;
        public $nadimak;
        public $email;
        public $sifra;

        public function __construct($ime, $prezime, $nadimak, $email, $sifra){
            $this->ime = $ime;
            $this->prezime = $prezime;
            $this->nadimak = $nadimak;
            $this->email = $email;
            $this->sifra = $sifra;
        }

    }