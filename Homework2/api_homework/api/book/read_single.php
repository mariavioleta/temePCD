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

//get id
$book->id = isset($_GET['id']) ? $_GET['id'] : die();

//get book
$book->read_single();

//create array
$book_arr = array(
    'id'=> $book->id,
    'title'=> $book->title,
    'author'=> $book->author,
    'page_number' => $book->page_number,
    'id_category' => $book->id_category,
    'category_name'=> $book->category_name
);

//convert to json
print_r(json_encode($book_arr));
