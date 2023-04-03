<?php
include './header.php';

session_start();
require_once './connect.php';

$categoryname = $_GET['categoryname'];
$type = $_GET['type'];

$selectCategory = "SELECT Type.Name FROM `Type` INNER JOIN Categories on Type.Category_ID = Categories.ID
WHERE Categories.Name = '$categoryname' AND Type.Name = '$type'";
$check_category = mysqli_query($connect, $selectCategory);
$rowcategory = mysqli_fetch_assoc($check_category);

$query = "";
if($rowcategory !== null) {
    $selectCategoryID = "SELECT Categories.ID FROM Categories WHERE Categories.Name = '$categoryname'";
    $check_categoryID = mysqli_query($connect, $selectCategoryID);
    $rowcategoryID = mysqli_fetch_assoc($check_categoryID);
    $newrowcategoryID = $rowcategoryID['ID'];
    $query = "DELETE FROM Type WHERE Type.Name = '$type' AND Type.Category_ID = '$newrowcategoryID'";
}
else {
    $response = [
        "status" => true,
        "type" => 1,
        "message" => "Произошла ошибка",
    ];
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
