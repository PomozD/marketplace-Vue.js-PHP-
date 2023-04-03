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

// селект для поиска каждого совпадения для itemName
// записать это в массив
// перебрать массив создавая инсерт передавая в качестве product_id каждый элемент массива

$userID = $_POST['userID'];
$itemName = $_POST['itemName'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$recommend = $_POST['recommend'];

function correctionJSON($string) {
    $correctString = str_replace('_', ' ', $string);
    return $correctString;
}

$correctName = correctionJSON($itemName);
$correctComment = correctionJSON($comment);

$select = "SELECT Products.ID FROM Products WHERE Products.Name = '$correctName'";

$check_productsID = mysqli_query($connect, $select);
$num_rows = mysqli_num_rows($check_productsID);

for ($i = 0 ; $i < $num_rows ; ++$i) {
    $row = mysqli_fetch_row($check_productsID);
    $insert = "UPDATE Rating
    SET Rating.Rating = '$rating',
    Rating.Comment = '$comment',
    Rating.Recommend = '$recommend'
    WHERE Product_ID = '$row[0]' and User_ID = '$userID'";
    $check = mysqli_query($connect, $insert);
}

$response = [
    "status" => true,
    "type" => 0,
    "message" => "Комментарий добавлен!",
];
echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();
?>