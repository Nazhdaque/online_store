<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';
    date_default_timezone_set("Europe/Moscow");
    $connect = new Connect();

    $arr_fields = []; // создаем массив полей и
    $arr_values = []; // массив значений

    foreach ($_GET as $key => $value) { // наполняем массивы
        $arr_fields[] = $key;
        $arr_values[] = "'".$value."'"; // конкатенируем одинарные кавычки, чтобы получить строковые значения для подстановки в sql запрос
    }
    // дописываем в массив то, что не получаем из GET
    $arr_fields[] = "order_list";   $arr_values[] = "'".json_encode($_SESSION['basket'])."'";
    $arr_fields[] = "created_at";   $arr_values[] = "'".date("Y-m-d H:i:s")."'";
    
    $str_fields = implode(', ', $arr_fields); // формируем строку для запроса из массива полей 
    $str_values = implode(', ', $arr_values); // формируем строку для запроса из массива значений 

    if (!in_array("''", $arr_values) && !empty($_SESSION['basket'])) {
        $query  = " INSERT INTO `core_orders` ($str_fields) VALUES  ($str_values) ";
        $result = mysqli_query($connect->getConnect(), $query);
        if ($result) {
            header('Location: /handlers/order_completed.php');
        } else {
            header('Location: /basket.php?crash=1');
        }
    } else {
        header('Location: /basket.php?empty_fields=1');
    }
    
    $chat_id = 56298657;
    $token = 'https://api.telegram.org/bot1727637201:AAF2hRy65QztbK4Yutbyc4n7USG2NKq0jWw';

    $telegram = new Telegram($token);
    $telegram->send_message($chat_id);