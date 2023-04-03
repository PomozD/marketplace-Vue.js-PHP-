<?php
include './header.php';

session_start();
require_once './connect.php';

function getCaregory() {
    global $connect;

    $query = "SELECT Categories.Name FROM `Categories`";
    $check_category = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($check_category);

    $arr_category = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_category);
        $arr_category[] = $row;

    }

    return $arr_category;
}

if (!getCaregory()) {
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
        "category"=> getCaregory()
    ];
    echo json_encode($response_size, JSON_UNESCAPED_UNICODE);
    die();
}

