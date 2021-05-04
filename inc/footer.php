        <footer>
            <div class="limiter">
                <div class="footer_group">
                    <div class="item">
                        <div class="f_header">КОЛЛЕКЦИИ</div>
                        <div class="f_links">
                            <?php
                                $connect = new Connect();
                                $categories = mysqli_query($connect->getConnect(), "SELECT * FROM `categories` ");
                                while ($category = mysqli_fetch_assoc($categories)) { 
                                    $amount = mysqli_query($connect->getConnect(), "SELECT COUNT(*) as num FROM `core_goods` WHERE `category_id`=".$category['id']);
                                    $info = mysqli_fetch_assoc($amount);
                            ?>
                                <a href="catalog.php?category_id=<?= $category['id'] ?>">
                                    <span>
                                        <?= $category['title'] ?> (<?= $info['num'] ?>)
                                    </span>
                                </a>
                            <?php }?>

                            <?php
                                $amount = mysqli_query($connect->getConnect(), "SELECT COUNT(*) as num FROM `core_goods` WHERE `new_arrival`=1 ");
                                $info = mysqli_fetch_assoc($amount);
                            ?>
                            <a href="/catalog.php?new_arrival=1">
                                <span>Новинки (<?= $info['num'] ?>)</span>
                            </a>
                        </div>
                    </div>
                    <div class="v_line"></div>
                    <div class="item">
                        <div class="f_header">МАГАЗИН</div>
                        <div class="f_links">
                            <a href="#">
                                <span>О нас</span>
                            </a>
                            <a href="#">
                                <span>Доставка</span>
                            </a>
                            <a href="#">
                                <span>Работай с нами</span>
                            </a>
                            <a href="#">
                                <span>Контакты</span>
                            </a>
                        </div>
                    </div>
                    <div class="v_line"></div>
                    <div class="item">
                        <div class="f_header">МЫ В СОЦИАЛЬНЫХ СЕТЯХ</div>
                        <div class="copyright">
                            <div>Сайт разработан в inordic.ru</div>
                            <div>2018 © Все права защищены</div>
                        </div>
                        <div class="social">
                            <a href="https://twitter.com/" target="_blank" rel="noopener noreferrer">
                                <div class="icon_border">
                                    <div class="icon"></div>
                                </div>
                            </a>
                            <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                                <div class="icon_border">
                                    <div class="icon"></div>
                                </div>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                                <div class="icon_border">
                                    <div class="icon"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/jquery.maskedinput.min.js"></script>


    <!-- Yandex maps -->
    <script src="https://api-maps.yandex.ru/2.1/?apikey=e58b6f18-22c5-49e3-8e28-897146cb09ce&lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);
        function init() {
            var myMap = new ymaps.Map("yandex_map", {
                center: [55.76153874483878,37.626786764780924],
                zoom: 17
            });

            // var myPlacemark = new ymaps.Placemark([55.76153874483878,37.626786764780924]); // создаем метку
            // myMap.geoObjects.add(myPlacemark); // добавляем на карту

            let points = JSON.parse(getStores());
            for (let i = 0; i < points.length; i++) {
                let myPlacemark = new ymaps.Placemark([points[i].latitude,points[i].longitude], {
                        hintContent: points[i].title,
                        balloonContent: 
                        '<a href="https://yandex.ru/">'+points[i].title+'</a>'+
                        '<div>'+points[i].adress+'</div>'+
                        '<div><img width="200px" src='+points[i].photo+'></div>'+
                        '<div>'+points[i].about+'</div>'
                    }
                ); // создаем метку
                myMap.geoObjects.add(myPlacemark); // добавляем на карту
            }
        }

        function getStores() {
            let xhr = new XMLHttpRequest();
            let url = 'http://store.com/api/map.php';
            xhr.open('GET', url, false); // false - синхронный запрос
            xhr.send();
            return xhr.responseText;
        }
    </script>

    
    <!-- Google maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwbktBM3GY5GfsT0VfA1MGEobYqkvrSkc&amp;callback=initMap" async="" defer=""></script>
    <script> 
        let map;
        function initMap() {
            var center_point = {lat: 55.7615, lng: 37.6266
            };  
            // The map, centered at center_point
            var map = new google.maps.Map
            (
                document.getElementById('google_map'),
                {zoom: 18, center: center_point}
            );
            // The marker, positioned at center_point
            var marker = new google.maps.Marker({position: center_point, map: map
            });
        } 
   </script>
    
</body>
</html>