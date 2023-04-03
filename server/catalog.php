<?php
include './header.php';

session_start();
require_once './connect.php';

$items_category = $_GET['category'];
$items_type = $_GET['type'];
$items_sortingValue = $_GET['sortingValue'];
$items_filtresValue = json_decode($_GET['filtresValue']);
$items_searchText = $_GET['searchText'];

    $query = "SELECT
        Products.ID, Products.Name, Products.Price, Products.Count, Products.Composition, Products.Main_Photo,
        Products.Secondary_Photo_first, Products.Secondary_Photo_second, Type.Name as 'Type', Categories.Name as 'Category',
        Sizes.Size, Sexs.Sex as 'Sex'
        FROM `Products`
        INNER JOIN Type on Products.Type_ID = Type.ID
        INNER JOIN Categories on Type.Category_ID = Categories.ID
        INNER JOIN Sizes on Products.Size_ID = Sizes.ID
        INNER JOIN Sexs on Products.Sex_ID = Sexs.ID
        WHERE Categories.Name = '$items_category'";

    if($items_type != '') {
        $query.= " AND Type.Name = '$items_type'";
    }

    if($items_searchText != '') {
        $query.= " AND Products.Name LIKE '%$items_searchText%'";
    }
    else {
        $query.= " AND Products.Name LIKE '%%'";
    }

    if($items_filtresValue !== "" && count($items_filtresValue) > 0) {
        $i = 0;
        $query.= " AND Sizes.Size IN (";
        foreach ($items_filtresValue as &$value){
            if(!(++$i === count($items_filtresValue))){
                $query.= "'$value',";
            }
            else {
                $query.= "'$value'";
            }
        }
        $query.= ")";
    }


    switch ($items_sortingValue) {
        case 'asc':
            $query.= " ORDER BY Products.Price ASC";
            break;
        case 'desc':
            $query.= " ORDER BY Products.Price DESC";
            break;
    }



    $check_item = mysqli_query($connect, $query);

    $num_rows = mysqli_num_rows($check_item);

    $arr_item = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_item);

        if($row[5]) {
            $row[5] = str_replace('https://drive.google.com/file/d/', 'https://drive.google.com/uc?export=view&id=', $row[5]);
            $row[5] = str_replace('/view?usp=share_link', '', $row[5]);
        }
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
