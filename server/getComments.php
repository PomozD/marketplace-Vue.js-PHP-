<?php
include './header.php';

session_start();
require_once './connect.php';


// должны выводиться все комментарии у которых имя = имени данного товара
// могут быть комментарии от одного юзера по этому имени несколько штук
// сделать проверку на то,чтобы выводился один комментарий этого юзера
// скрывать форму если существует коммент данного юзера



$item__name = $_GET['name'];

function getComments($name) {
    global $connect;

    $query = "SELECT Rating.ID, Rating.Product_ID, Rating.User_ID,
              Rating.Rating, Rating.Comment, Rating.Recommend,
              Products.ID, Products.Name,
              Profiles.ID, Profiles.Name, Profiles.Surname
              FROM `Rating`
              INNER JOIN Products on Rating.Product_ID = Products.ID
              INNER JOIN Profiles on Rating.User_ID = Profiles.ID
              WHERE Products.Name = '$name';";
    $check_comments = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($check_comments);

    $arr_comments = array();

    for ($i = 0 ; $i < $num_rows ; ++$i) {
        $row = mysqli_fetch_row($check_comments);
        $arr_comments[] = $row;

    }

    return $arr_comments;
}

$callFunction = getComments($item__name);


function getCorrectComments($comments) {
    $arrCorrectComments = array();
    for ($i = 0 ; $i < count($comments); ++$i) {
        if($comments[$i][2] == $comments[$i + 1][2]) {
            continue;
        }
        $arrCorrectComments[] = $comments[$i];
    }
    return $arrCorrectComments;
}

if (!getCorrectComments($callFunction)) {
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
        "comments"=> getCorrectComments($callFunction)
    ];
    echo json_encode($response_size, JSON_UNESCAPED_UNICODE);
    die();
}




?>