<?php
    $title = 'Аутентификация';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';

    $empty_fields       = 'Пожалуйста, заполните все поля.';
    $too_long           = 'Превышен лимит символов в одном из полей формы.';
    $crash              = 'Техника подвела и введенные данные не отправились, попробуйте еще раз.';
    $not_found          = 'Пользователь с таким логином или email не зарегистрирован.';
    $wrong_credentials  = 'Неверный логин или пароль.';

    if (isset($_GET['empty_fields'       ])){    $info = $empty_fields       ;}
    if (isset($_GET['too_long'           ])){    $info = $too_long           ;}
    if (isset($_GET['crash'              ])){    $info = $crash              ;}
    if (isset($_GET['not_found'          ])){    $info = $not_found          ;}
    if (isset($_GET['wrong_credentials'  ])){    $info = $wrong_credentials  ;}
?>


<div class="auth">
    <form action="/handlers/auth.php" method="GET" autocomplete="off">
        <div class="item">
            <input type="text" name="login" placeholder="login или email">
        </div>
        <div>
            <div class="item">
                <input type="password" name="password" placeholder="password">
            </div>
            <div class="item">
                <input type="submit" value="">
            </div>
        </div>
    </form>
    <div class="enter_or_reg">
        <p>или</p>
        <a href="/reg.php">зарегистрироваться</a>
    </div>

    <?php if (isset($info)): ?>
        <div class="limiter handlers">
            <div class="item">
                <a class="info" href="http://store.com">
                    <?php echo $info; ?>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="decor">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>