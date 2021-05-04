<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    if (isset($_SESSION['basket'])) {
        $sum = 0;
        foreach ($_SESSION['basket'] as $id => $size_amount_arr) {
            $good = new Good($id);
            $price = $good->getField('price');
            foreach ($size_amount_arr as $size_id => $amount) {
                $sum += $amount * $price;
            }
        }
        echo $sum;
    } else {
        echo '0';
    }