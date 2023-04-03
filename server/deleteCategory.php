<?php
include './header.php';

session_start();
require_once './connect.php';

$categoryname = $_GET['categoryname'];

$selectCategory = "SELECT Categories.Name FROM `Categories` WHERE Categories.Name = '$categoryname'";
$check_category = mysqli_query($connect, $selectCategory);
$rowcategory = mysqli_fetch_assoc($check_category);

$query = "";
if($rowcategory) {
    $query = "DELETE FROM Categories WHERE Categories.Name = '$categoryname'";
}

$check_item = mysqli_query($connect, $query);

if(!$check_item){
    $response = [
        "status" => true,
        "type" => 1,
        "message" => "Произошла ошибка",
    ];
}
else {
    $response = [
        "status" => true,
        "type" => 0,
        "message" => "200 ok"
    ];
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();
?>
