<?php
include './header.php';

session_start();
require_once './connect.php';

parse_str(file_get_contents('php://input'), $_POST);

$_POST = parsePostedData($_POST);

function parsePostedData($data) {
    foreach ($data as $obj => $v) {
        foreach (json_decode($obj) as $key => $value) {
            $data[$key] = $value;
        }
        unset($data[$obj]);
    }
    return $data;
}

$userID = $_POST['userID'];
$itemID = $_POST['itemID'];
$count = $_POST['count'];
$numberOrder = $_POST['numberOrder'];

$insert = "INSERT INTO Orders (ID, User_ID, Product_ID, Count, Number_order) VALUES (NULL, '$userID', '$itemID', '$count', '$numberOrder')";
$check = mysqli_query($connect, $insert);


$select = "SELECT Count FROM Products WHERE Products.ID = '$itemID'";
$checkCount = mysqli_query($connect, $select);
$row = mysqli_fetch_row($checkCount);


$newCount = (int)$row[0] - $count;

if($newCount != 0) {
    $correctedCountProduct = "UPDATE Products SET Count = '$newCount' WHERE Products.ID = '$itemID'";
    $checkCorrect = mysqli_query($connect, $correctedCountProduct);
}
else {
    $deleteProduct = "DELETE FROM Products WHERE Products.ID = '$itemID'";
    $checkDelete = mysqli_query($connect, $deleteProduct);
}

if(!$check) {
    $response = [
        "status" => true,
        "type" => 1,
        "message" => "Произошла ошибка!",
    ];
}
else {
    $response = [
        "status" => true,
        "type" => 0,
        "message" => "Заказ оформлен!",
    ];
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();
?>
