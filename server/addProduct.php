<?php
include './header.php';

session_start();
require_once './connect.php';

$item_name = $_GET['item_name'];
$item_size = $_GET['item_size'];
$item_sex = $_GET['item_sex'];
$item_category = $_GET['item_category'];
$item_type = $_GET['item_type'];
$item_price = $_GET['item_price'];
$newPrice = (int)$item_price;
$item_count = $_GET['item_count'];
$newCount = (int)$item_count;
$item_composition = $_GET['item_composition'];
$item_mainPhoto = $_GET['item_mainPhoto'];
$item_fsPhoto = $_GET['item_fsPhoto'];
$item_ssPhoto = $_GET['item_ssPhoto'];

$selectSize = "SELECT Sizes.ID FROM `Sizes` WHERE Sizes.Size = '$item_size'";
$check_size = mysqli_query($connect, $selectSize);
$rowSize = mysqli_fetch_assoc($check_size);
$newRowSize = (int)$rowSize['ID'];

$selectType = "SELECT Type.ID FROM `Type` INNER JOIN Categories on Type.Category_ID = Categories.ID
                WHERE Type.Name = '$item_type' AND Categories.Name = '$item_category'";
$check_type = mysqli_query($connect, $selectType);
$rowType = mysqli_fetch_assoc($check_type);
$newRowType = (int)$rowType['ID'];

$selectSex = "SELECT Sexs.ID FROM `Sexs` WHERE Sexs.Sex = '$item_sex'";
$check_sex = mysqli_query($connect, $selectSex);
$rowSex = mysqli_fetch_assoc($check_sex);
$newRowSex = (int)$rowSex['ID'];


$select = "SELECT Products.Name, Products.Size_ID From Products WHERE Products.Name = '$item_name' AND Products.Size_ID = '$newRowSize'";
$check_select = mysqli_query($connect, $select);
$rowSelect = mysqli_num_rows($check_select);

if($rowSelect == 0) {
    $query = "INSERT INTO Products (ID, Name, Size_ID, Sex_ID, Type_ID, Price, Count, Composition, Main_Photo, Secondary_Photo_first,
                      Secondary_Photo_second) VALUES (NULL, '$item_name', '$newRowSize', '$newRowSex', '$newRowType', '$newPrice', '$newCount', '$item_composition'";

    if($item_mainPhoto != ''){
        $item_mainPhoto = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $item_mainPhoto);
        $item_mainPhoto = str_replace('/view?usp=share_link', '', $item_mainPhoto);

        $query.= " ,'$item_mainPhoto'";
    }

    if($item_fsPhoto != ''){
        $item_fsPhoto = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $item_fsPhoto);
        $item_fsPhoto = str_replace('/view?usp=share_link', '', $item_fsPhoto);

        $query.= " ,'$item_fsPhoto'";
    }

    if($item_ssPhoto != ''){
        $item_ssPhoto = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $item_ssPhoto);
        $item_ssPhoto = str_replace('/view?usp=share_link', '', $item_ssPhoto);

        $query.= " ,'$item_ssPhoto'";
    }

    $query.= ")";

    $check_item = mysqli_query($connect, $query);

    if(!$check_item){
        $response = [
            "status" => true,
            "type" => 1,
            "message" => "Произошла ошибка",
        ];
    }
    else {
        $response = [
            "status" => true,
            "type" => 0,
            "message" => "200 ok"
        ];
    }
}
else {
    $response = [
        "status" => true,
        "type" => 1,
        "message" => "Произошла ошибка",
    ];
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
die();
?>
