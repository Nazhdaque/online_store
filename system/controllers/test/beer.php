<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    
    echo Beer::NAME;                            echo'<br>';
    echo Ale::NAME;                             echo'<br><br><br>';

    echo Beer::getName();                       echo'<br>';
    echo Ale::getName();                        echo'<br><br><br>';

    echo Beer::getStaticName();                 echo'<br>';
    echo Ale::getStaticName();                  echo'<br><br><br>';
?>