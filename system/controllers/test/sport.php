<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Traits/Sport/Sprint_.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Traits/Sport/Jump_.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Traits/Sport/Throw_.php';

    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Sport/Sprinter.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Sport/Jumper.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Sport/Thrower.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Sport/Decathlete.php';

    // $sprinter = new Sprinter();
    // $sprinter->sprint();
    // echo'<br>';
    // $jumper = new Jumper();
    // $jumper->jump();
    // echo'<br>';
    // $thrower = new Thrower();
    // $thrower->throw();
    // echo'<br><br><br>';
    // $decathlete = new Decathlete();
    // $decathlete->sprint();
    // $decathlete->jump();
    // $decathlete->throw();

    $sprinter = new \ForTraining\Sport\Sprinter();
    $sprinter->sprint();
    echo'<br>';
    $jumper = new \ForTraining\Sport\Jumper();
    $jumper->jump();
    echo'<br>';
    $thrower = new \ForTraining\Sport\Thrower();
    $thrower->throw();
    echo'<br><br><br>';
    $decathlete = new \ForTraining\Sport\Decathlete();
    $decathlete->sprint();
    $decathlete->jump();
    $decathlete->throw();