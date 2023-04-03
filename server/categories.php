<?php
    include './header.php';

    session_start();
    require_once './connect.php';

    function getCategories() {
        global $connect;


        $query = "SELECT Categories.Name FROM `Categories`";
        $check_categories = mysqli_query($connect, $query);
        $num_rows = mysqli_num_rows($check_categories);

        $arr_categories = array();
        for ($i = 0 ; $i < $num_rows ; ++$i) {
            $row = mysqli_fetch_row($check_categories);
            $arr_categories[] = $row;
        }

        return $arr_categories;
    }


    $menu = [];
    foreach (getCategories() as $category){
        $menu[] = [
            "category" => $category[0],
            "types"=>getTypes($category[0])
        ];
    }

    function getTypes($category) {
        global $connect;
        $query = "SELECT Type.Name as Type FROM `Categories`
        JOIN Type
        on Categories.ID = Type.Category_ID
        where Categories.Name = '$category'";
        $check_types = mysqli_query($connect, $query);
        $num_rows = mysqli_num_rows($check_types);

        $arr_types = array();
        for ($i = 0 ; $i < $num_rows ; ++$i) {
            $row = mysqli_fetch_assoc($check_types);
            $arr_types[] = $row;
        }

        return $arr_types;
    }

    if (!$menu) {
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
            "category"=> $menu
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

?>