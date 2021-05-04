<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';
    $connect = new Connect();

    $arr_fields = []; // создаем пустые массивы для полей 
    $arr_values = []; // и значений
    
    foreach ($_POST as $key => $value) { // заполняем их данными из формы
        $arr_fields[] = $key;
        $arr_values[] = "'".$value."'";
    };
    // для фото
    $complete_file_name = explode('.', $_FILES['photo']['name']); // разделяем имя файла на имя и расширение
    $file_name = $complete_file_name[0]; // записываем имя
    $file_extention = $complete_file_name[1]; // записываем расширение
    $hash = md5($file_name . time()); // генерируем уникальный идентификатор, чтобы избежать перезаписи файлов в одинаковым именем
    $new_file_name = $file_name .'_'. $hash .'.' .$file_extention; // объединяем по шаблону
    $absolute_filename = $_SERVER['DOCUMENT_ROOT'].'/img/catalog/'.$new_file_name; // формируем абсолютное имя файла (путь + имя + расширение) для загрузки на сервер
    move_uploaded_file($_FILES['photo']['tmp_name'], $absolute_filename); // загружаем на сервер
    $arr_fields[] = 'photo'; // дописываем в массив поле photo
    $arr_values[] = "'".'/img/catalog/'.$new_file_name."'"; // и его значение (ссылку) в том же формате, что у нас в БД
    // преобразуем массивы в строки, чтобы подставить в запрос к БД 
    $str_fields = implode(', ', $arr_fields); // в скобках указываем разделитель и массив
    $str_values = implode(', ', $arr_values);
    
    if (!in_array("''", $arr_values)) {
        $query  = " INSERT INTO `core_goods` ($str_fields) VALUES  ($str_values) "; // формируем запрос на вставку данных в БД: подставляем полученные строки
        $result = mysqli_query($connect->getConnect(), $query);

        if (isset($result)) {
            header('Location: /admin.php?table_id=2');
        }
    }
    