<?php 

    class Database{
    
        private $host = "localhost";
        private $db_name = "NedaDB";
        private $username = "root";
        private $password = "";

        private static $instance = null;
        public $connection = null;
    
        public function __construct(){    
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public function getConnection(){
            return $this->$connection;
        }
        
        public static function getInstance(){
            if(!isset(self::$instance)){
                self::$instance = new Database();
            }

            return self::$instance;
        }


        public function registruj($korisnik){
            $query = "INSERT INTO Korisnik (ime, prezime, nadimak, email, sifra) VALUES(:ime, :prezime, :nadimak, :email, :sifra)";
            $statement = $this->conn->prepare($query);
            
            return $statement->execute(
                [
                    'ime' => $korisnik->ime,
                    'prezime' => $korisnik->prezime,
                    'nadimak' => $korisnik->nadimak,
                    'email' => $korisnik->email,
                    'sifra' => $korisnik->sifra,
                ]
            );
        }
    }