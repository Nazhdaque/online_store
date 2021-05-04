<?php
require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/Connect.php';
$connect = new Connect;
$email = $_GET['email'];

    if (!empty($email)) {   
        if (mb_strlen($email) < 50) {   
            $query = "SELECT `id` FROM `newsletter` WHERE `email` = '$email' "; // Проверяем, есть ли email в таблице newsletter
            $result = mysqli_query($connect->getConnect(), $query);
            $row = mysqli_fetch_assoc($result);
            if (empty($row['id'])) { // Если email не найден в этом массиве
                $query = "INSERT INTO `newsletter` (`email`) VALUES ('$email') "; // Вставляем данные в таблицу newsletter
                $result = mysqli_query($connect->getConnect(), $query);
                if ($result) {
                    $title = 'подписка оформлена';
                    $info = 'Благодарим вас за подписку на нашу рассылку.';
                } else {
                    $title = 'Крах!';
                    $info = 'Техника подвела и ваш запрос не отправился, попробуйте еще раз.';
                }
            } else { // если email  уже есть в БД
                $title = 'подписка уже оформлена';
                $info = 'Вы уже являетесь нашим подписчиком ))';
            }
        } else {
            $title = 'Превышен лимит символов';
            $info = 'Не более 50 символов, пожалуйста.';
        }
    } else {
        $title = 'Укажите e-mail';
        $info = 'Вы не указали e-mail.';
    }
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';
?>

<div class="limiter handlers newsletter">
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