<?php 
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    $test = new \ForTraining\Test();
    $test->drive();

    $good_from_library = new \someLibrary\Good();
    $good_from_library-> showInfo();
?>

<?php
    // // парный файл Test.php лежит в system/classes/
    
    // // подключаем класс
    // // include('../../classes/Test.php');
    // require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';
    // // создаем экземпляр объекта с классом Test;
    // $car = new Test();
    // // вызываем метод drive()
    // $car->drive();                          echo '<br>';
    // // вызываем метод accelerate() и передаем в скобках новое значение св-ва $speed;
    // $car->accelerate(100);
    // // снова вызываем метод drive(), чтобы увидеть изменения
    // $car->drive();                          echo '<br>';
    // // выводим на экран св-во $speed объекта $car
    // echo $car->speed;                       echo '<br><br><br>';
    // // $this используем только внутри класса, а во внешнем коде вызываем экземпляр класса по имени;
?>


<?php
    // // подключаем класс;
    // include('../../classes/Good.php');
    // // создаем экземпляр объекта с классом Good;
    // $good = new Good ();
    // // сообщаем методу getId параметр (id товара в БД);
    // $good->getId(1);
    // // по этому id получаем строку с данными по единице товара из таблицы core_goods:
    // // id, полученный методом getId, подставляется в запрос к БД в методе getInfo;
    // $good->getInfo();
    // // выводим полученные данные;
    // echo $good->title();                    echo '<br>';
    // echo $good->price();                    echo '<br>';
    // echo $good->photo();                    echo '<br><br><br>';

    // комментируем на шаге 14
?>

<!-- одновременно оба не выводит -->

<?php
// // 7 // альтернатива - берем данные напрямую из БД;
//     // подключаем класс;
//     include('../../classes/Good.php');
//     // создаем экземпляр объекта с классом Good;
//     $good = new Good ();
//     // сообщаем методу getId параметр (id товара в БД);
//     $good->getId(9);
//     // по этому id получаем строку с данными по единице товара из таблицы core_goods:
//     // id, полученный методом getId, подставляется в запрос к БД в методе getInfo;
//     // $good->getInfo(); на шаге 13 комментируем это
//     // выводим полученные данные;
//     echo $good->getField('title');          echo '<br>';
//     echo $good->getField('price');          echo '<br>';
//     echo $good->getField('photo');          echo '<br><br><br>';
?>

