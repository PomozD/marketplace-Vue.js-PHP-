<?php
include './header.php';

session_start();
require_once './connect.php';

$categoryName = $_GET['categoryname'];

function getProductType($categoryName) {
    global $connect;

    $query = "SELECT Type.Name FROM `Type`
              INNER JOIN Categories on Type.Category_ID = Categories.ID              
              WHERE Categories.Name = '$categoryName'";
    $check_type = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($check_type);

    $arr_type = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_type);
        $arr_type[] = $row;

    }
    return $arr_type;
}

if (!getProductType($categoryName)) {
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
        "type" => getProductType($categoryName),
    ];
    echo json_encode($response_size, JSON_UNESCAPED_UNICODE);
    die();
}