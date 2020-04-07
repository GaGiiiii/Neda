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
        }

        public function registruj(){
            $query = "INSERT INTO Korisnik (ime, prezime, nadimak, email, sifra) VALUES ('$this->ime', '$this->prezime', '$this->nadimak', '$this->email', '$this->sifra')";
            $result = mysqli_query($this->connection, $query);
            
            if($result){
                $this->id = mysqli_insert_id($this->connection);
                $this->napraviSession();

                return true;
            }

            return false;
        }

        public function prijavi($email, $sifra){
            $query = "SELECT id, ime, prezime, nadimak, email FROM Korisnik WHERE email = '$email' AND sifra = '$sifra'";
            $result = mysqli_query($this->connection, $query);

            $korisnik = mysqli_fetch_array($result);

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