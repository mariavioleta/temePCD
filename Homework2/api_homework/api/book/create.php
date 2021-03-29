<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

//instantiem DB si conexiunea
$database = new Database();
$db = $database->connect();

//instantiem obj book
$book = new Book($db);

//get data that is posted
$data = json_decode(file_get_contents("php://input"));
$book->title = $data->title;
$book->author = $data->author;
$book->page_number = $data->page_number;
$book->id_category = $data->id_category;

//create book
if($book->create()){
    echo json_encode(
        array('message' => 'Book created')
    );  
}else {
    echo json_encode(
        array('message' => 'Book not created')
    );    

}

?>