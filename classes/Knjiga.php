<?php

    require_once 'Database.php';

    class Knjiga{

        public $id;
        public $naslov;
        public $autor;
        public $opis;
        public $cena;
        public $link;
        public $korisnikID;
        public $connection;

        public function __construct($naslov, $autor, $opis, $cena, $link, $korisnikID){
            $this->naslov = $naslov;
            $this->autor = $autor;
            $this->opis = $opis;
            $this->cena = $cena;
            $this->link = $link;
            $this->korisnikID = $korisnikID;
            $this->connection = Database::getInstance()->getConnection();
        }

        public function dodaj(){
            $query = "INSERT INTO Knjiga (naslov, autor, opis, cena, prodavnica, korisnik_id) VALUES ('$this->naslov', '$this->autor', '$this->opis', '$this->cena', '$this->link', '$this->korisnikID')";
            $result = mysqli_query($this->connection, $query);

            print_r($query);
            
            if($result){
                return true;
            }

            return false;
        }

        public static function uzmiSve(){
            $query = "SELECT * FROM Knjiga";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
            $knjige = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            return $knjige;
        }

        public static function nadjiKorisnika($korisnikID){
            $query = "SELECT nadimak FROM Korisnik WHERE id = $korisnikID";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
            $korisnik = mysqli_fetch_array($result);      

            return $korisnik['nadimak'];
        }

        public static function izbrisi($knjigaID){
            $query = "DELETE FROM Knjiga WHERE id = $knjigaID";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);

            return $result;
        }

        public static function azuriraj($knjigaID, $props){
            $naslov = $props['naslov'];
            $autor = $props['autor'];
            $opis = $props['opis'];
            $cena = $props['cena'];
            $prodavnica = $props['link'];
            $query = "UPDATE Knjiga SET naslov = '$naslov', autor = '$autor', opis = '$opis', cena = $cena, prodavnica = '$prodavnica' WHERE id = $knjigaID";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);

            return $result;
        }

        public static function pripadaKorisniku($knjigaID, $korisnikID){
            $query = "SELECT korisnik_id FROM Knjiga WHERE id = $knjigaID";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
            $red = mysqli_fetch_array($result);      

            if($red['korisnik_id'] == $korisnikID){
                return true;
            }

            return false;
        }

        public static function sortirajPoCeni(){
            $query = "SELECT * FROM Knjiga ORDER BY cena";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
            $knjige = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            return $knjige;
        }

        public static function sortirajPoNazivu(){
            $query = "SELECT * FROM Knjiga ORDER BY naslov";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
            $knjige = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            return $knjige;
        }

        public static function trazi($tekst){
            $query = "SELECT * FROM Knjiga WHERE naslov LIKE '%" . $tekst . "%'";
            $result = mysqli_query(Database::getInstance()->getConnection(), $query);
            $knjige = mysqli_fetch_all($result, MYSQLI_ASSOC);

            return $knjige;
        }

    }