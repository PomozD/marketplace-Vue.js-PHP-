<?php
include './header.php';

session_start();
require_once './connect.php';

$id = $_GET['id'];

$query = "SELECT Products.ID, Products.Name, Sizes.Size, Sexs.Sex, Type.Name as 'Type', Categories.Name as 'Category', Products.Price, Products.Count,
Products.Composition, Products.Main_Photo, Products.Secondary_Photo_first, Products.Secondary_Photo_second
FROM Products
INNER JOIN Sizes on Products.Size_ID = Sizes.ID
INNER JOIN Sexs on Products.Sex_ID = Sexs.ID
INNER JOIN Type on Products.Type_ID = Type.ID
INNER JOIN Categories on Type.Category_ID = Categories.ID
WHERE Products.ID = '$id';";

$check_item = mysqli_query($connect, $query);
$num_rows = mysqli_num_rows($check_item);

$arr_item = array();

for ($i = 0 ; $i < $num_rows ; ++$i) {
    $row = mysqli_fetch_row($check_item);

    if($row[9]) {
        $row[9] = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $row[9]);
        $row[9] = str_replace('/view?usp=share_link', '', $row[9]);
    }

    if($row[10]) {
        $row[10] = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $row[10]);
        $row[10] = str_replace('/view?usp=share_link', '', $row[10]);
    }

    if($row[11]) {
        $row[11] = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $row[11]);
        $row[11] = str_replace('/view?usp=share_link', '', $row[11]);
    }


    $arr_item[] = $row;

}


$exist = false;
if (!$num_rows) {
    $exist = true;
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
        "itemInfo"=>$arr_item
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

?>