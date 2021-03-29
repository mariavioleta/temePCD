<?php
class Category{
    //DB elemente
    private $conn;
    private $table = 'category';

    //Propretati category
    public $id;
    public $name;

    //constructor with db
    public function __construct($db){
        $this->conn = $db;
    }

    //get categories
    public function read(){
        //create query
        $query = 'SELECT 
        id, 
        name
        FROM 
        ' . $this->table ;

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //execute query 
        $stmt->execute();
        return $stmt;
   }

    //get single
    public function read_single(){
        //create query
        $query = 'SELECT 
        id, 
        name
        FROM 
        ' . $this->table ;

    //prepare statement
    $stmt = $this->conn->prepare($query);

    //bind id
    $stmt->bindParam(1,$this->id);

     //execute query
     $stmt->execute();

     $row = $stmt->fetch(PDO::FETCH_ASSOC);

     //set properties
     $this->name = $row['name'];
        }
}