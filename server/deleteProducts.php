<?php
include './header.php';

session_start();
require_once './connect.php';

$itemId = $_GET['itemId'];

$delete = "DELETE FROM Products
WHERE Products.ID = '$itemId'";
$check = mysqli_query($connect, $delete);

var_dump($check, $delete);
die();

$response = [
    "status" => true,
    "type" => 0,
    "message" => "Продукт удален!",
];
echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();
?>
