<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

//set ID to delete
$book->id = $data->id;

//delete book
if($book->delete()){
    echo json_encode(
        array('message' => 'Book deleted')
    );    
 }
 else {
    echo json_encode(
        array('message' => 'Book not deleted')
    );    
 }
