<?php
include './header.php';

session_start();
require_once './connect.php';

$id = $_GET['id'];


$query = "SELECT * FROM Profiles WHERE Profiles.ID = '$id'";
$check_user = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($check_user);
$num_rows = mysqli_num_rows($check_user);


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
        "userInfo"=>$user
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

?>
