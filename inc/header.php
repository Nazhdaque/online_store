</head>
<body>
    <div class="back">
    <div class="wrapper">
        <header>
            <div class="limiter">
                <div class="header_group">
                    <a href="/index.php" class="logo">
                        <div>SH</div>
                    </a>
                    <div class="nav_panel">
                        <?php
                            $params = [];
                            foreach ($_GET as $key => $value) {
                                $temp_get = $_GET; 
                                unset($temp_get[$key]);
                                if ($key == 'from') {
                                    unset($temp_get['up_to']);
                                }
                                $str = http_build_query($temp_get);
                                $params[$key] = $str;
                                if ($params[$key] != '') {
                                    $params[$key] = "&".$params[$key];
                                }
                            }
                            $end_url = $_SERVER['QUERY_STRING'];
                            if ($end_url != '') {
                                $end_url = "&".$end_url;
                            }
                        ?>
                        <a href="catalog.php?category_id=1<?= isset($params['category_id']) ? $params['category_id'] : $end_url ?>" 
                        class="<?php if (isset($_GET['category_id']) && $_GET['category_id'] == 1) {?> is_bold <?php }?>">
                            <span>Женщинам</span>
                        </a>
                        <a href="catalog.php?category_id=2<?= isset($params['category_id']) ? $params['category_id'] : $end_url ?>" 
                        class="<?php if (isset($_GET['category_id']) && $_GET['category_id'] == 2) {?> is_bold <?php }?>">
                            <span>Мужчинам</span>
                        </a>
                        <a href="catalog.php?category_id=3<?= isset($params['category_id']) ? $params['category_id'] : $end_url ?>" 
                        class="<?php if (isset($_GET['category_id']) && $_GET['category_id'] == 3) {?> is_bold <?php }?>">
                            <span>Детям</span>
                        </a>
                        <a href="catalog.php?new_arrival=1<?= isset($params['category_id']) ? $params['category_id'] : $end_url ?>"
                        class="<?php if (isset($_GET['new_arrival']) && $_GET['new_arrival'] == 1) {?> is_bold <?php }?>">
                            <span>Новинки</span>
                        </a>
                        <?php 
                            $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        ?>
                        <a href="about.php"
                        class="<?php if (strpos($url,'about') == true) {?> is_bold <?php }?>">
                            <span>О нас</span>
                        </a>
                    </div>
                    

                    <div class="right">
                        <div class="item">
                            <div class="icon"></div>
                            <?php if (isset($_COOKIE['user_id'])): ?>
                                <?php 
                                    $user = new User ($_COOKIE['user_id']);
                                    $userName = $user->getField('name');
                                ?>
                                <p>Привет, <?php echo $userName; ?></p>
                                <a href="/handlers/logout.php">(Выйти)</a> 
                            <?php else: ?>
                                <a href="/auth.php">
                                    <span>Войти</span>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="item">
                            <div class="icon"></div>
                            <a href="/basket.php">
                                <span>Корзина (<span id="items_in_the_basket"><?= (isset($_SESSION['basket'])) ? $_SESSION['basket_count'] : '0' ?></span>)</span>
                            </a>
                        </div>
                    </div>
                    
                    <?php if (isset($_COOKIE['user_id'])): ?>
                        <?php 
                            $user = new User ($_COOKIE['user_id']);
                            $userName = $user->getField('name');
                        ?>
                        <a href="/handlers/logout.php" class="replacement logout_icon"></a>
                    <?php else: ?>
                        <a href="/auth.php" class="replacement login_icon"></a>
                    <?php endif; ?>

                    <a href="/basket.php" class="replacement basket_2">
                        <span id="items_in_the_basket_2"><?= (isset($_SESSION['basket'])) ? $_SESSION['basket_count'] : '0' ?></span>
                    </a>

                    <div class="logo hamburger">
                        <div class="sandwich"></div>
                        <div class="sandwich"></div>
                        <div class="sandwich"></div>
                    </div>
                </div>
            </div>
        </header>