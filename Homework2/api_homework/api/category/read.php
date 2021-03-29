<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiem DB si conexiunea
$database = new Database();
$db = $database->connect();


//instantiem obj category
$category = new Category($db);

//cat query
$result = $category->read();

//get row count
$num = $result->rowCount();

//check if any cat
if($num>0){
    //cat array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cat_item = array(
    'id'=> $id,
    'name'=>$name
 );

 //push to data
 array_push($cat_arr['data'], $cat_item);
    }
    
    //turn to json & output
    echo json_encode($cat_arr);

}
else {
    //nu sunt carti
    echo json_encode(
        array('message' => 'No categories found')
    );
}



