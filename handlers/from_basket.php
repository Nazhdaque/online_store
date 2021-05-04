<?php
    session_start();
    if (isset($_SESSION['basket_count'])) {
        $basket_count = $_SESSION['basket_count']; 
    } else {   
        $basket_count = 0;
    }
    
    if (isset($_SESSION['basket'])) {   
        $basket = $_SESSION['basket'];
    } else {
        $basket = [];
    }

    if (($id = $_GET['id']) && ($size_id = $_GET['size_id'])) {   
        if (isset($basket[$id][$size_id])) {
            $basket_count -= $basket[$id][$size_id]; // из общего кол-ва товаров в корзине вычитаем кол-во удаляемых по клику на крестик;
            unset($basket[$id][$size_id]); // удаляем сам товар данного размера;
        }

        if (isset($basket[$id]) && $basket[$id] == []) { // после удаления товара останется пустой массив
            unset($basket[$id]); // удаляем его;
        }

        $_SESSION['basket'] = $basket;
        $_SESSION['basket_count'] = $basket_count;
        echo $basket_count;




        // if (in_array($id, $basket)) // проверяем, есть ли товар, который нужно удалить, в корзине
        // {   
        //     for ($i = 0; $i < count($basket); $i++)
        //     {   
        //         if ($basket[$i] == $id) // если найден, 
        //         {   
        //             unset($basket[$i]); // удаляем
        //             break;
        //         }
        //     } 
        //     sort($basket); // сортируем массив после удаления
        // } 
    }