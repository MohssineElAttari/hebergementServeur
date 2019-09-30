<?php
class Hebergement{
 
    // database connection and table name
    private $conn;
    private $table_name = "hebergement";
 
    // object properties
    public $id;
    public $codeHebergement;
    public $nom;
    public $paye;
    public $ville;
    public $adress;
    public $adressMap;
    public $responsable;
    public $description;
    public $logo;
    public $telephon;
    public $email;
    public $password;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
   
    // used by select drop-down list
    public function read(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    nom";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
}

?>