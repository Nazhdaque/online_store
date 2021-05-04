<?php
    $title = '';
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    $connect = new Connect();

    $login = $_GET['login'];
    $password = $_GET['password'];

    if (!empty($login) && !empty($password)) {
        if (mb_strlen($login) < 50 && mb_strlen($password) < 256) {
            $query  ="SELECT * FROM `core_users` WHERE `email` = '$login' OR `login` = '$login' ";
            $result = mysqli_query($connect->getConnect(), $query);
            $row    = mysqli_fetch_assoc($result);
            if ($result) {
                if (!empty($row['id'])) {
                    if(password_verify($password, $row['password'])) {
                        $title = 'Успешная авторизация!';
                        setcookie('user_id', $row['id'], time() + 3600, '/');
                        header('Location: /index.php'); 
                    } else {
                        $title = 'Ошибка!';
                        $info = 'Неверный логин или пароль.';
                        header('Location: /auth.php?wrong_credentials=1');
                    }
                } else {
                    $title = 'Ошибка!';
                    $info = 'Пользователь с таким логином или email не зарегистрирован.';
                    header('Location: /auth.php?not_found=1');
                }
            } else {
                $title = 'Крах!';
                $info = 'Техника подвела и введенные данные не отправились, попробуйте еще раз.';
                header('Location: /auth.php?crash=1');
            }
        } else {
            $title = 'Превышен лимит символов!';
            $info = 'Превышен лимит символов в одном из полей формы.';
            header('Location: /auth.php?too_long=1');
        }
    } else {
        $title = 'Заполните все поля';
        $info = 'Пожалуйста, заполните все поля.';
        header('Location: /auth.php?empty_fields=1');
    }
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';
?>

<div class="limiter handlers">
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

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>