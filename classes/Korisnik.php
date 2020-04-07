<?php

    require_once 'Database.php';

    class Korisnik{

        public $id;
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
            $query = "INSERT INTO Korisnik (ime, prezime, nadimak, email, sifra) VALUES (:ime, :prezime, :nadimak, :email, :sifra)";
            $statement = $this->connection->prepare($query);
            
            if($statement->execute(
                [
                    'ime' => $this->ime,
                    'prezime' => $this->prezime,
                    'nadimak' => $this->nadimak,
                    'email' => $this->email,
                    'sifra' => $this->sifra,
                ]
            )){
                $this->id = $this->connection->lastInsertId();

                $this->napraviSession();

                return true;
            }

            return false;
        }

        public function prijavi($email, $sifra){
            $query = "SELECT id, ime, prezime, nadimak, email FROM Korisnik WHERE email = :email AND sifra = :sifra";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'email' => $email,
                'sifra' => $sifra
            ]);

            $korisnik = $statement->fetch($this->connection::FETCH_ASSOC); 

            if($korisnik){
                $this->id = $korisnik['id'];
                $this->ime = $korisnik['ime'];
                $this->prezime = $korisnik['prezime'];
                $this->nadimak = $korisnik['nadimak'];
                $this->email = $korisnik['email'];

                $this->napraviSession();

                return true;
            }

            return false;
        }

        public function napraviSession(){
            session_start();

            $_SESSION['korisnik'] = [
                'id' => $this->id,
                'ime' => $this->ime,
                'prezime' => $this->prezime,
                'nadimak' => $this->nadimak,
                'email' => $this->email,
            ];
        }

        public static function odjavi(){
            session_start();
            session_unset();
            session_destroy();
        }

        public static function ulogovan(){
            if(isset($_SESSION['korisnik'])){
                return true;
            }

            return false;
        }

    }