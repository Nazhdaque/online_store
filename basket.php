<?php
    $title = 'ваша корзина';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';

    $empty_fields   = 'Пожалуйста, заполните все поля.';
    $too_long       = 'Превышен лимит символов в одном из полей формы.';
    $crash          = 'Техника подвела и введенные данные не отправились, попробуйте еще раз.';
    $success        = 'Вы успешно оформили заказ!';

    if(isset($_GET['empty_fields'   ])){    $info = $empty_fields   ;}
    if(isset($_GET['too_long'       ])){    $info = $too_long       ;}
    if(isset($_GET['crash'          ])){    $info = $crash          ;}
    if(isset($_GET['success'        ])){    $info = $success        ;}
    
?>

<div class="limiter basket">

    <?php if(isset($info)): ?>
        <div class="handlers">
            <div class="item">
                <a class="info" href="http://store.com">
                    <?= $info; ?>
                </a>
            </div>
        </div>
    <?php endif; ?>
    
    <section>
        <h1>ВАША КОРЗИНА</h1>
                                                <!-- если массив пуст, то count вернет 0 -->
        <?php if (isset($_SESSION['basket']) && $_SESSION['basket_count']): ?>
            <p>Товары резервируются на ограниченное время</p>
        <?php else: ?>
            <p>пуста</p>
        <?php endif; ?>
        <div class="table_head">
            <div class="table_item">
                <div>ФОТО</div>
                <div>НАИМЕНОВАНИЕ</div>
            </div>
            <div class="table_item">
                <div>РАЗМЕР</div>
                <div>КОЛИЧЕСТВО</div>
                <div>СТОИМОСТЬ</div>
                <div>УДАЛИТЬ</div>
            </div>
        </div>
        <?php if (isset($_SESSION['basket'])): ?>
            <?php foreach ($_SESSION['basket'] as $id => $size_amount_arr): ?>
                <?php foreach ($size_amount_arr as $size_id => $amount): ?>
                    <?php $good = new Good($id); ?>
                    <div class="table_row">
                        <div class="table_item">
                            <div class="photo">
                                <img src="<?= $good->getField('photo') ?>">
                            </div>
                            <div class="info">
                                <p><?= $good->getField('title') ?></p>
                                <p><?= $good->getField('vendor_code') ?></p>
                            </div>
                        </div>

                        <div class="table_item">
                        <?php
                            $size = new Size($size_id);
                            $size_value = $size->getField('size');
                        ?>
                            <div><?= $size_value ?></div>
                            <div class="amount">
                                <div class="goods_amount"><?= $amount ?></div>
                                <div>
                                    <div data-item_id="<?= $id ?>" data-item_size_id="<?= $size_id ?>" onclick="plus_basket()">
                                        <div class="plus"></div>
                                    </div>
                                    <div data-item_id="<?= $id ?>" data-item_size_id="<?= $size_id ?>" onclick="minus_basket()">
                                        <div class="minus"></div>
                                    </div>
                                </div>
                            </div>
                            <div><?= $good->getField('price') ?></div>
                            <div data-item_id="<?= $id ?>" data-item_size_id="<?= $size_id ?>" onclick="from_basket()" class="cancel"> <!-- Создали свой атрибут для хранения id, чтобы использовать его в script.js -> from_basket -->
                                <div></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="total">
            <div class="total_item">
                <div>Итого</div>
                <div id="count_basket">
                    <?php 
                        if (isset($_SESSION['basket'])) {
                            $sum = 0;
                            foreach ($_SESSION['basket'] as $id => $size_amount_arr) {
                                $good = new Good($id);
                                $price = $good->getField('price');
                                foreach ($size_amount_arr as $size_id => $amount) {
                                    $sum += $amount * $price;
                                }
                            }
                            echo $sum;
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <a href="/handlers/clear_basket.php" class="orange_button">Очистить корзину</a>
 
    <div class="decor">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <section class="delivery">
        <div class="basket_form">
            <h2>АДРЕС ДОСТАВКИ</h2>
            <p>Все поля обязательны для заполнения</p>
            <div class="form_holder">
                <form id="order" action="/handlers/order.php" method="GET">
                    <p>выберите вариант доставки</p>
                    <label class="select_arrow">
                        <select name="delivery_type" onChange="this.options[this.selectedIndex].onclick()">
                            <option data-cost="0" hidden value="undefined">Курьер, почтомат или самовывоз?</option>
                            <?php
                                $delivery = new Delivery ();
                                $result = $delivery->getElements();
                            ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <option onclick="delivery_price()" data-cost="<?= $row['price'] ?>" value="<?= $row['value']?>"><?= $row['type']?> — <?= ($row['price'] == 0) ? 'бесплатно' : $row['price'].'руб.' ?><p></p></option>
                            <?php endwhile; ?>
                        </select>
                    </label>

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
                                <input type="email" name="email">
                            </div>
                        </div>
                    </div>

                    <div class="decor">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    
                    <h2>ВАРИАНТЫ ОПЛАТЫ</h2>
                    <p>Все поля обязательны для заполнения</p>

                    <div class="bill">
                        <div>
                            <div>Стоимость:</div>
                                <div id="cost">
                                    <?php 
                                        if (isset($_SESSION['basket'])) {
                                            $sum = 0;
                                            foreach ($_SESSION['basket'] as $id => $size_amount_arr) {
                                                $good = new Good($id);
                                                $price = $good->getField('price');
                                                foreach ($size_amount_arr as $size_id => $amount) {
                                                    $sum += $amount * $price;
                                                }
                                            }
                                            echo $sum.' руб.';
                                        } else {
                                            echo '0';
                                        }
                                    ?>
                                </div>
                            </div>
                        <div>
                            <div>Доставка:</div>
                            <div id="delivery_price">руб</div>
                        </div>
                        <div>
                            <div>Итого:</div>
                            <div id="total_price">руб</div>
                        </div>
                    </div>
                    
                    <p>выберите способ оплаты</p>
                    <div class="payment_systems_logos">
                        <label class="select_arrow">
                            <select name="payment_method" id="payment">
                                <option value="bank_card">Банковская карта</option>
                                <option value="cash">Наличные</option>
                            </select>
                        </label>
                    </div>

                    <input type="submit" value="заказать" class="orange_button">
                </form>
            </div>
        </div>
    </section>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>