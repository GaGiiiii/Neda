<?php

    require_once 'Database.php';

    class Korisnik{

        public $ime;
        public $prezime;
        public $nadimak;
        public $email;
        public $sifra;
        public $connection;

        public function __construct($ime, $prezime, $nadimak, $email, $sifra){
            $this->ime = $ime;
            $this->prezime = $prezime;
            $this->nadimak = $nadimak;
            $this->email = $email;
            $this->sifra = $sifra;
            $this->connection = Database::getInstance()->getConnection();
            $instance = Database::getInstance();
            $this->connection = $instance->getConnection();
        }

        public function registruj(){
            $query = "INSERT INTO Korisnik (ime, prezime, nadimak, email, sifra) VALUES(:ime, :prezime, :nadimak, :email, :sifra)";
            $statement = $this->connection->prepare($query);
            
            return $statement->execute(
                [
                    'ime' => $this->ime,
                    'prezime' => $this->prezime,
                    'nadimak' => $this->nadimak,
                    'email' => $this->email,
                    'sifra' => $this->sifra,
                ]
            );
        }

    }