<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';
    $connect = new Connect();

    $id = (int)$_POST['id'];
    $arr_fields = [];
    $arr_values = [];

    foreach ($_POST as $key => $value) {   
        if ($key != 'id') { // убираем id, чтобы не перезаписывать его
            $arr_fields[] = $key;
            $arr_values[] = "'".$value."'";
        }
    };

    if ($_FILES['photo']['name']) { // для фото
        $complete_file_name = explode('.', $_FILES['photo']['name']); // разделяем название файла на имя и расширение
        $file_name = $complete_file_name[0]; // записываем имя
        $file_extention = $complete_file_name[1]; // записываем расширение
        $hash = md5($file_name . time()); // генерируем уникальный идентификатор, чтобы избежать перезаписи файлов в одинаковым именем
        $new_file_name = $file_name .'_'. $hash .'.' .$file_extention; // объединяем по шаблону
        $absolute_filename = $_SERVER['DOCUMENT_ROOT'].'/img/catalog/'.$new_file_name; // формируем абсолютное имя файла (путь + имя + расширение) для загрузки на сервер
        move_uploaded_file($_FILES['photo']['tmp_name'], $absolute_filename); // загружаем на сервер
        $arr_fields[] = 'photo'; // дописываем в массив поле photo 
        $arr_values[] = "'".'/img/catalog/'.$new_file_name."'"; // и его значение (ссылку) в том же формате, что у нас в БД
    }

    $str_update = '';
    for ($i = 0; $i < count($arr_fields); $i++) {   
        $str_update = $str_update . $arr_fields[$i] .'='.$arr_values[$i].', '; // формируем строку ключ=значение (в какое поле таблицы что записать)
    }
    $str_update = trim($str_update,', '); // удаляем запятую в конце строки

    if (!in_array("''", $arr_values)) {   
        $query  = " UPDATE `core_goods` SET $str_update WHERE `id` = $id "; // формируем запрос на вставку данных в БД: подставляем полученные строки
        $result = mysqli_query($connect->getConnect(), $query);

        if (isset($result)) {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
    