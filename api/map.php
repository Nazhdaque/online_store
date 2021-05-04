<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    $connect = new Connect();
    $query = "SELECT * FROM `core_stores`";
    $result = mysqli_query($connect->getConnect(), $query);

    $arr_stores = []; // все магазины
    while ($row = mysqli_fetch_assoc($result)) {
        $arr_item = [];
        $arr_item['title'    ] = $row['title'    ];
        $arr_item['about'    ] = $row['about'    ];
        $arr_item['photo'    ] = $row['photo'    ];
        $arr_item['adress'   ] = $row['adress'   ];
        $arr_item['latitude' ] = $row['latitude' ];
        $arr_item['longitude'] = $row['longitude'];
        $arr_stores[] = $arr_item; // добавили в общий массив
    }
    echo json_encode($arr_stores);