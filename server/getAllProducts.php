<?php
include './header.php';

session_start();
require_once './connect.php';

$query = "SELECT
        Products.ID, Products.Name, Products.Price, Products.Count, Products.Composition, Products.Main_Photo,
        Products.Secondary_Photo_first, Products.Secondary_Photo_second, Type.Name as 'Type', Categories.Name as 'Category',
        Sizes.Size, Sexs.Sex as 'Sex'
        FROM `Products`
        INNER JOIN Type on Products.Type_ID = Type.ID
        INNER JOIN Categories on Type.Category_ID = Categories.ID
        INNER JOIN Sizes on Products.Size_ID = Sizes.ID
        INNER JOIN Sexs on Products.Sex_ID = Sexs.ID";


$check_item = mysqli_query($connect, $query);

$num_rows = mysqli_num_rows($check_item);

$arr_item = array();

for ($i = 0 ; $i < $num_rows ; ++$i) {
    $row = mysqli_fetch_row($check_item);
    $arr_item[] = $row;

}


if (!count($arr_item) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Произошла ошибка"
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();

} else {
    $response = [
        "status" => true,
        "type" => 0,
        "message" => "200 ok",
        "item"=> $arr_item
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}
?>

