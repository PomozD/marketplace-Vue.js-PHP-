<?php
include './header.php';

session_start();
require_once './connect.php';

$userID = $_GET['userID'];
$itemName = $_GET['itemName'];

$select = "SELECT Products.ID FROM Products WHERE Products.Name = '$itemName'";

$check_productsID = mysqli_query($connect, $select);
$num_rows = mysqli_num_rows($check_productsID);

for ($i = 0; $i < $num_rows; ++$i) {
    $row = mysqli_fetch_row($check_productsID);
    $delete = "DELETE FROM Rating
    WHERE Product_ID = '$row[0]' and User_ID = '$userID'";
    $check = mysqli_query($connect, $delete);
}

$response = [
    "status" => true,
    "type" => 0,
    "message" => "Комментарий удален!",
];
echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();
?>
