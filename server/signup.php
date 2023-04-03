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

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = correctEmail($email);

    function correctEmail(string $email): string {
        return preg_replace("/(@[^_]*)_+/", "$1.", $email);
    }

    $query = "SELECT * FROM Profiles WHERE Profiles.Email = '$email'";
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

    var_dump('exist', $exist);

$newpassword = md5($password);
if(!$exist) {
    if($email == 'adminadmin@mail.com' && $newpassword == md5('adminadmin')){
        $insert = "INSERT INTO Profiles (ID, Email, Password, Name, Surname, Role) VALUES (NULL, '$email', '$newpassword', '$name', '$surname', 'admin')";
    }
    else {
        $insert = "INSERT INTO Profiles (ID, Email, Password, Name, Surname, Role) VALUES (NULL, '$email', '$newpassword', '$name', '$surname', 'user')";
    }
    $ckeck = mysqli_query($connect, $insert);
    if($ckeck) {
        var_dump("ok");
    }
    else {
        var_dump('ne ok');
    }
    $response = [
        "status" => true,
        "type" => 0,
        "message" => "Регистрация прошла успешно!",
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}
?>