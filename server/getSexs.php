<?php
include './header.php';

session_start();
require_once './connect.php';

function getSex() {
    global $connect;

    $query = "SELECT Sexs.Sex FROM `Sexs`";
    $check_sex = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($check_sex);

    $arr_sex = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_sex);
        $arr_sex[] = $row;

    }

    return $arr_sex;
}

if (!getSex()) {
    $response_size = [
        "status" => false,
        "type" => 1,
        "message" => "Произошла ошибка"
    ];

    echo json_encode($response_size, JSON_UNESCAPED_UNICODE);
    die();

} else {
    $response_size = [
        "status" => true,
        "type" => 0,
        "message" => "200 ok",
        "sex"=> getSex()
    ];
    echo json_encode($response_size, JSON_UNESCAPED_UNICODE);
    die();
}

