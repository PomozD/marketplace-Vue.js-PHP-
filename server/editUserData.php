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
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$currentEmail = $_POST['currentEmail'];

$email = correctEmail($email);
$currentEmail = correctEmail($currentEmail);

function correctEmail(string $email): string {
    return preg_replace("/(@[^_]*)_+/", "$1.", $email);
}



//if ($email == 'adminadmin@mail.com') {
//    $response = [
//        "status" => false,
//        "type" => 1,
//        "message" => "Данный Email невозможно использовать"
//    ];
//
//    echo json_encode($response);
//    die();
//
//}

$newpassword = md5($password);
$query = "SELECT * FROM Profiles WHERE Profiles.Email = '$email' AND Profiles.ID NOT IN ($userID)";
$check_login = mysqli_query($connect, $query);

$num_rows = mysqli_num_rows($check_login);

$exist = false;
if ($num_rows > 0) {
    $exist = true;
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Пользователь с таким Email уже зарегистрирован"
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();

}

$newpassword = md5($password);
if(!$exist) {
    $update = "UPDATE Profiles SET Profiles.Name = '$name', Profiles.Surname = '$surname', Profiles.Email = '$email',
        Profiles.Password = '$newpassword'
        WHERE Profiles.Email = '$currentEmail'";
    $check = mysqli_query($connect, $update);
    if($check){
        $response = [
            "status" => true,
            "type" => 0,
            "message" => "Изменения данных успешно завершились",
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    } else {
        $response = [
            "status" => true,
            "type" => 1,
            "message" => "Изменения данных завершились неуспешно",
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>