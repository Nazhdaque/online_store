<?php
    function classLoader($class) {   // $class = str_repalce("\\", "/", $class);
        require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/'.$class.'.php';
    }
    spl_autoload_register('classLoader');