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
        if ($basket[$id][$size_id] > 1) {
            $basket[$id][$size_id]--;
        } else {
            unset($basket[$id][$size_id]);
            if (isset($basket[$id]) && $basket[$id] == []) {
                unset($basket[$id]);
            }
        }
        $basket_count--; 
        $_SESSION['basket'] = $basket; 
        $_SESSION['basket_count'] = $basket_count; 
        echo $basket_count;
    }