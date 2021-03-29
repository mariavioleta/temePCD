<?php
class Book{
    //DB elemente
    private $conn;
    private $table = 'books';

    //Propretati Books
    public $id;
    public $title;
    public $author;
    public $category_id;
    public $category_name;
    public $page_number;

    //constructor cu DB 
    //metoda care ruleaza automat atunci cand se instantiaza o clasa

    public function __construct($db){
        $this->conn=$db;
    }

    //get carti sau read carti
    public function read(){

        //create query
        $query = 'SELECT
            c.name as category_name,
            b.id,
            b.id_category,
            b.title,
            b.author,
            b.page_number
        FROM 
        '. $this->table . ' b
        LEFT JOIN 
        category c ON b.id_category = c.id';

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
         c.name as category_name,
         b.id,
         b.id_category,
         b.title,
         b.author,
         b.page_number
     FROM 
     '. $this->table . ' b
     LEFT JOIN 
     category c ON b.id_category = c.id
     WHERE 
     b.id = ? 
     LIMIT 0,1';

     //prepare statement
     $stmt = $this->conn->prepare($query);

     //bind id
     $stmt->bindParam(1,$this->id);

      //execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      //set properties
      $this->title = $row['title'];
      $this->author = $row['author'];
      $this->id_category = $row['id_category'];
      $this->page_number = $row['page_number'];
      $this->category_name = $row['category_name'];
         }

         //create book
         public function create(){
             //create query
             $query = 'INSERT INTO ' .
             $this->table . '
             SET            
             title = :title,
             author = :author,
             page_number = :page_number,
             id_category = :id_category';
        
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this-> author = htmlspecialchars(strip_tags($this->author));
        $this->page_number = htmlspecialchars(strip_tags($this->page_number));
        $this->id_category = htmlspecialchars(strip_tags($this->id_category));

        //bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':page_number', $this->page_number);
        $stmt->bindParam(':id_category', $this->id_category);
           
        //execute query
        if($stmt->execute()){
        return true;
        }
    
        //print error if something goes wrong
        printf("Error: %s. \n", $stmt->error);
            return false;   
    }

        ///update book
    public function update(){
        //create query
        $query = 'UPDATE ' .
        $this->table . '
        SET            
        title = :title,
        author = :author,
        page_number = :page_number,
        id_category = :id_category
        WHERE
        id = :id';
   
   
   //prepare statement
   $stmt = $this->conn->prepare($query);

   //clean data
   $this->title = htmlspecialchars(strip_tags($this->title));
   $this-> author = htmlspecialchars(strip_tags($this->author));
   $this->page_number = htmlspecialchars(strip_tags($this->page_number));
   $this->id_category = htmlspecialchars(strip_tags($this->id_category));
   $this->id = htmlspecialchars(strip_tags($this->id));
         
   //bind data
   $stmt->bindParam(':title', $this->title);
   $stmt->bindParam(':author', $this->author);
   $stmt->bindParam(':page_number', $this->page_number);
   $stmt->bindParam(':id_category', $this->id_category);
   $stmt->bindParam(':id', $this->id);  
  
   //execute query
   if($stmt->execute()){
   return true;
   }

   //print error if something goes wrong
   printf("Error: %s. \n", $stmt->error);
       return false;   
 }

   //delete book
 public function delete(){
    //create query 
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    //prepare statement
   $stmt = $this->conn->prepare($query);

   //clean data
   $this->id = htmlspecialchars(strip_tags($this->id));
   
   //bind data
   $stmt->bindParam(':id', $this->id); 

   //execute query
   if($stmt->execute()){
    return true;
    }
 
    //print error if something goes wrong
    printf("Error: %s. \n", $stmt->error);
        return false;   
  }

 }
