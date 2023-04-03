<?php
include './header.php';

session_start();
require_once './connect.php';

$id = $_GET['itemId'];
$intID = (int)$id;
$name = $_GET['name'];
$size = $_GET['size'];
$sex = $_GET['sex'];
$category = $_GET['category'];
$type = $_GET['type'];
$price = $_GET['price'];
$newPrice = (int)$price;
$count = $_GET['count'];
$newCount = (int)$count;
$composition = $_GET['composition'];
$main_photo = $_GET['main_photo'];
$first_sec_photo = $_GET['first_sec_photo'];
$second_sec_photo = $_GET['second_sec_photo'];

$selectSize = "SELECT Sizes.ID FROM `Sizes` WHERE Sizes.Size = '$size'";
$check_size = mysqli_query($connect, $selectSize);
$rowSize = mysqli_fetch_assoc($check_size);
$newRowSize = (int)$rowSize['ID'];

$selectType = "SELECT Type.ID FROM `Type` WHERE Type.Name = '$type'";
$check_type = mysqli_query($connect, $selectType);
$rowType = mysqli_fetch_assoc($check_type);
$newRowType = (int)$rowType['ID'];

$selectSex = "SELECT Sexs.ID FROM `Sexs` WHERE Sexs.Sex = '$sex'";
$check_sex = mysqli_query($connect, $selectSex);
$rowSex = mysqli_fetch_assoc($check_sex);
$newRowSex = (int)$rowSex['ID'];

$query = "UPDATE Products SET ";

$arr = [];

if($name != ''){
    array_push($arr,"Products.Name = '$name'");
}

if($size != ''){
    array_push($arr,"Products.Size_ID = '$newRowSize'");
}

if($sex != ''){
    array_push($arr,"Products.Sex_ID = '$newRowSex'");
}

if($type != ''){
    array_push($arr,"Products.Type_ID = '$newRowType'");
}

if($price != ''){
    array_push($arr,"Products.Price = '$newPrice'");
}

if($count != ''){
    array_push($arr, "Products.Count = '$newCount'");
}

if($composition != ''){
    array_push($arr,"Products.Composition = '$composition'");
}

if($main_photo != ''){
    $main_photo = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $main_photo);
    $main_photo = str_replace('/view?usp=share_link', '', $main_photo);
    array_push($arr,"Products.Main_Photo = '$main_photo'");
}

if($first_sec_photo != ''){
    $first_sec_photo = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $first_sec_photo);
    $first_sec_photo = str_replace('/view?usp=share_link', '', $first_sec_photo);
    array_push($arr,"Products.Secondary_Photo_first = '$first_sec_photo'");
}

if($second_sec_photo != ''){
    $second_sec_photo = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $second_sec_photo);
    $second_sec_photo = str_replace('/view?usp=share_link', '', $second_sec_photo);
    array_push($arr,"Products.Secondary_Photo_second = '$second_sec_photo'");
}
$implode_arr = implode(", ", $arr);
$query.= $implode_arr;
$query.= " WHERE Products.ID = '$intID'";

$check_item = mysqli_query($connect, $query);

if($check_item){
    $response = [
        "status" => true,
        "type" => 0,
        "message" => "200 ok"
    ];
}
else {
    $response = [
        "status" => true,
        "type" => 1,
        "message" => "Произошла ошибка"
    ];
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();
?>

