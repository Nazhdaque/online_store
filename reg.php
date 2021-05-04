<?php
    $title = 'Регистрация';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';

    $empty_fields       = 'Пожалуйста, заполните все поля.';
    $too_long           = 'Превышен лимит символов в одном из полей формы.';
    $crash              = 'Техника подвела и введенные данные не отправились, попробуйте еще раз.';
    $already_exists     = 'Пользователь с таким логином или email уже зарегистрирован.';

    if (isset($_GET['empty_fields'      ])){    $info = $empty_fields      ;}
    if (isset($_GET['too_long'          ])){    $info = $too_long          ;}
    if (isset($_GET['crash'             ])){    $info = $crash             ;}
    if (isset($_GET['already_exists'    ])){    $info = $already_exists    ;}
?>

<div class="limiter reg">
    <div class="decor">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <section class="reg_form">

        <?php if(isset($info)): ?>
            <div class="handlers">
                <div class="item">
                    <a class="info" href="http://store.com">
                        <?php echo $info; ?>
                    </a>
                </div>
            </div>
        <?php else: ?>
            <h2>ПРИВЕТ!</h2>
            <p>Пожалуйста, заполните все поля</p>
        <?php endif; ?>

        <div class="form_holder">
            <form action="/handlers/reg.php" method="GET">

                <div class="fields">
                    <div>
                        <div>
                            <p>имя</p>
                            <input type="text" name="name">
                        </div>
                        <div>
                            <p>фамилия</p>
                            <input type="text" name="surname">
                        </div>
                    </div>

                    <div>
                        <p>адрес</p>
                        <input type="text" name="adress">
                    </div>

                    <div>
                        <div>
                            <p>город</p>
                            <input type="text" name="city">
                        </div>
                        <div>
                            <p>индекс</p>
                            <input type="text" name="postcode">
                        </div>
                    </div>

                    <div>
                        <div>
                            <p>телефон</p>
                            <input type="tel" name="phone">
                        </div>
                        <div>
                            <p>e-mail</p>
                            <input type="text" name="email">
                        </div>
                    </div>

                    <div>
                        <div>
                            <p>Логин</p>
                            <input type="text" name="login">
                        </div>
                        <div>
                            <p>Пароль</p>
                            <input type="password" name="password">
                        </div>
                    </div>
                </div>

                <input type="submit" value="зарегистрироваться" class="orange_button">

                <div class="enter_or_reg">
                    <p>или</p>
                    <a href="/auth.php">войти</a>
                </div>
            </form>
        </div>
    </section>
    <div class="decor">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>