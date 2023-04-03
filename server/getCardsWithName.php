<?php
include './header.php';

session_start();
require_once './connect.php';

$name = $_GET['name'];

function getName($name) {
    global $connect;

    $query = "SELECT Products.ID, Sizes.Size FROM `Products`
        INNER JOIN Sizes on Products.Size_ID = Sizes.ID
        WHERE Products.Name = '$name'";
    $check_items = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($check_items);

    $arr_items = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_items);
        $arr_items[] = $row;

    }

    return $arr_items;
}

if (!getName($name)) {
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
        "items"=> getName($name)
    ];
    echo json_encode($response_items, JSON_UNESCAPED_UNICODE);
    die();
}
?>

