<?php
include './header.php';

session_start();
require_once './connect.php';

$id = $_GET['id'];

function getCard($id) {
    global $connect;

    $query = "SELECT Products.Price, Products.Count FROM `Products`
        WHERE Products.ID = '$id'";
    $check_items = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($check_items);

    $arr_items = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_items);
        $arr_items[] = $row;

    }

    return $arr_items;
}

if (!getCard($id)) {
    $response_items = [
        "status" => false,
        "type" => 1,
        "message" => "Произошла ошибка"
    ];

    echo json_encode($response_items, JSON_UNESCAPED_UNICODE);
    die();

} else {
    $response_items = [
        "status" => true,
        "type" => 0,
        "message" => "200 ok",
        "items"=> getCard($id)
    ];
    echo json_encode($response_items, JSON_UNESCAPED_UNICODE);
    die();
}
?>
