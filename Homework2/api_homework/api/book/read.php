<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

//instantiem DB si conexiunea
$database = new Database();
$db = $database->connect();


//instantiem obj book
$book = new Book($db);

//book query
$result = $book->read();

//get row count
$num = $result->rowCount();

//check if any books
if($num>0){
    //books array
    $books_arr = array();
    $books_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $book_item = array(
    'id'=> $id,
    'title'=>$title,
    'author'=>$author,
    'page_number' =>$page_number,
    'id_category' =>$id_category,
    'category_name'=>$category_name
 );

 //push to data
 array_push($books_arr['data'], $book_item);
    }
    
    //turn to json & output
    echo json_encode($books_arr);

}
else {
    //nu sunt carti
    echo json_encode(
        array('message' => 'No books found')
    );
}



