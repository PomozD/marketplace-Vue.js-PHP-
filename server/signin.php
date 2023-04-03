<?php
include './header.php';

session_start();
require_once './connect.php';

$email = $_GET['email'];
$password = $_GET['password'];

$email = correctEmail($email);

function correctEmail(string $email): string {
    return preg_replace("/(@[^_]*)_+/", "$1.", $email);
}

$newpassword = md5($password);
$query = "SELECT * FROM Profiles WHERE Profiles.Email = '$email' and Profiles.Password = '$newpassword'";
$check_login = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($check_login);
$num_rows = mysqli_num_rows($check_login);

$exist = false;
if (!$num_rows) {
    $exist = true;
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Пользователя с таким Email не существует или неправильный пароль"
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();

} else {

    $_SESSION['user'] = [
        "id" => $user['ID'],
        "name" => $user['Name'],
        "surname" => $user['Surname'],
        "email" => $user['Email'],
        "password" => $user['Password'],
    ];

    $response = [
        "status" => true,
        "type" => 0,
        "message" => "Вход успешен!",
        "user"=>$user
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

?>