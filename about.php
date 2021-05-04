<?php
    $title = 'О нас';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';
?>

    <div class="limiter">
        <div class="about">
            <div id="yandex_map"></div>
            <div class="items">
                <div class="item">
                    <h2>АДРЕСА НАШИХ МАГАЗИНОВ</h2>
                    <div class="subitem">
                        <p>Улица Кузнецкий Мост, 24</p>
                        <p>Москва, 107031</p>
                    </div>
                    <div class="subitem">
                        <p>Волковская улица, 43</p>
                        <p>Люберцы, Московская область, 140000</p>
                    </div>
                </div>

                <div class="between"></div>

                <div class="item">
                    <h2>ГРАФИК РАБОТЫ</h2>
                    <div class="subitem">
                        <p>Мы работаем по будням</p>
                        <p>с 10:00 до 22:00</p>
                    </div>
                </div>
            </div>

            <div class="decor">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <!-- <div id="google_map" style="width: 600px; height: 400px"></div> -->
    </div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>