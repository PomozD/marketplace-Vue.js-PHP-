<?php
include './header.php';

session_start();
require_once './connect.php';

$id = $_GET['id'];

$query = "SELECT Orders.Count, Orders.Number_order, Products.Name, Sizes.Size FROM Orders
          INNER JOIN Products on Orders.Product_ID = Products.ID
          INNER JOIN Sizes on Products.Size_ID = Sizes.ID
WHERE Orders.User_ID = '$id'";

$check_user = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($check_user);

$arr_user = [];
for($i = 0; $i < $num_rows; $i++) {
    $arr_user[] = mysqli_fetch_assoc($check_user);
}


$exist = false;
if (!$num_rows) {
    $exist = true;
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Пользователя с таким Email не существует"
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();

} else {
    $response = [
        "status" => true,
        "type" => 0,
        "message" => "200 ok",
        "info" => $arr_user
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

?>
