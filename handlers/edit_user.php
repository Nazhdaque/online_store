<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';
    $connect = new Connect();

    $id = (int)$_GET['id'];
    $arr_fields = []; // создаем пустые массивы для полей
    $arr_values = []; // и значений
    
    foreach ($_GET as $key => $value) { // заполняем их данными из формы
        if ($key != 'id') { // убираем id, чтобы не перезаписать его
            $arr_fields[] = $key;
            $arr_values[] = "'".$value."'";
        }
    };

    $str_update = ''; // формируем строку ключ=значение (в какое поле таблицы что записать)
    for ($i = 0; $i < count($arr_fields); $i++) {
        $str_update = $str_update . $arr_fields[$i] .'='.$arr_values[$i].', ';
    }
    $str_update = trim($str_update,', '); // удаляем запятую в конце строки

    if (!in_array("''", $arr_values)) {   
        $query  = " UPDATE `core_users` SET $str_update WHERE `id` = $id "; // формируем запрос на вставку данных в БД: подставляем полученные строки
        $result = mysqli_query($connect->getConnect(), $query);

        if (isset($result)) {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
    