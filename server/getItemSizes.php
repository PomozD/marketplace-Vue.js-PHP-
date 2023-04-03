<?php
include './header.php';

session_start();
require_once './connect.php';

$name = $_GET['name'];

function getSize($name) {
    global $connect;

    $query = "SELECT Sizes.Size FROM `Products`
        INNER JOIN Sizes on Products.Size_ID = Sizes.ID
        WHERE Products.Name = '$name'";
    $check_size = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($check_size);

    $arr_sizes = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_size);
        $arr_sizes[] = $row;

    }

    return $arr_sizes;
}

if (!getSize($name)) {
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
        "size"=> getSize($name)
    ];
    echo json_encode($response_size, JSON_UNESCAPED_UNICODE);
    die();
}
?>
