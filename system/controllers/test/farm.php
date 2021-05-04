<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Interfaces/Farm/Eat.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Interfaces/Farm/Sleep.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Interfaces/Farm/Jump.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Interfaces/Farm/Run.php';

    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Farm/Animals.php';

    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Farm/Dog.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Farm/Cat.php';
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/ForTraining/Farm/Pig.php';

    
    $cat = new \ForTraining\Farm\Cat();
    $cat->cat();
    $cat->eat();
    $cat->sleep();
    $cat->run();
    $cat->jump();

    $dog = new \ForTraining\Farm\Dog();
    $dog->dog();
    $dog->eat();
    $dog->sleep();
    $dog->run();
    $dog->jump();

    $pig = new \ForTraining\Farm\Pig();
    $pig->pig();
    $pig->eat();
    $pig->sleep();
    $pig->run();
    $pig->jump();