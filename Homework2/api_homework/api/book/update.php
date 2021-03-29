<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
Access-Control-Allow-Methods');


include_once '../../config/Database.php';
include_once '../../models/Book.php';

//instantiem DB si conexiunea
$database = new Database();
$db = $database->connect();

//instantiem obj book
$book = new Book($db);

//get data that is posted
$data = json_decode(file_get_contents("php://input"));

//set ID to update
$book->id = $data->id;

$book->title = $data->title;
$book->author = $data->author;
$book->page_number = $data->page_number;
$book->id_category = $data->id_category;

//update book
if($book->update()){
    echo json_encode(
        array('message' => 'Book updated.')
    );    
}else {
    echo json_encode(
        array('message' => 'Book not updated.')
    );    

}

