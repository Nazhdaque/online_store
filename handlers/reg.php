<?php
    $title = '';
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    $connect = new Connect();

    $name  = trim($_GET['name']);     $surname  = trim($_GET['surname']);     $adress = trim($_GET['adress']);
    $city  = trim($_GET['city']);     $postcode = trim($_GET['postcode']);    $phone  = trim($_GET['phone']);
    $email = trim($_GET['email']);    $login    = trim($_GET['login']);       $hash = password_hash(trim($_GET['password']), PASSWORD_DEFAULT);

    if (!empty($name)  &&    !empty($surname)  &&    !empty($adress) && 
        !empty($city)  &&    !empty($postcode) &&    !empty($phone)  && 
        !empty($email) &&    !empty($login)    &&    !empty($hash))
    {
        if (mb_strlen($name)  < 50 &&    mb_strlen($surname)  < 50 &&    mb_strlen($adress) < 100 && 
            mb_strlen($city)  < 50 &&    mb_strlen($postcode) < 7  &&    mb_strlen($phone)  < 20  && 
            mb_strlen($email) < 50 &&    mb_strlen($login)    < 50 &&    mb_strlen($hash)   < 256  )
        {
            $query = "SELECT `id` FROM `core_users` WHERE `email` = '$email' OR `login` = '$login' ";
            $result = mysqli_query($connect->getConnect(), $query);
            $row = mysqli_fetch_assoc($result);

            if (empty($row['id'])) {
                $query = "INSERT INTO `core_users` 
                                    (   `name`,  `surname`,  `adress`,  `city`,  `postcode`,  `phone`,  `email`,  `login`,  `password`  ) 
                            VALUES  (  '$name', '$surname', '$adress', '$city', '$postcode', '$phone', '$email', '$login', '$hash'  ) ";
                $result = mysqli_query($connect->getConnect(), $query);
                if ($result) {
                    $title = 'Успех!';
                    $info = 'Вы успешно зарегистрировались!';
                } else {
                    $title = 'Крах!';
                    $info = 'Техника подвела и ваш запрос не отправился, попробуйте еще раз.';
                    header('Location: /reg.php?crash=1');
                }
            } else {
                $title = 'Хм, странно...';
                $info = 'Пользователь с таким логином или email уже зарегистрирован.';
                header('Location: /reg.php?already_exists=1');
            }
        } else {
            $title = 'Превышен лимит символов!';
            $info = 'Превышен лимит символов в одном из полей формы.';
            header('Location: /reg.php?too_long=1');
        }
    } else {
        $title = 'Заполните все поля';
        $info = 'Пожалуйста, заполните все поля.';
        header('Location: /reg.php?empty_fields=1');
    }
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';
?>

<div class="limiter handlers">
    <div class="reg">
        <div class="item">
            <a class="info" href="http://store.com">
                <?php if (isset($info)) {echo $info;} ?>
            </a>
        </div>
        <div class="decor">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>