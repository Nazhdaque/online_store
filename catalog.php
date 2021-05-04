<?php
    $title = 'каталог';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';

    if (isset($_GET ['category_id'])) {
        $category = new Category($_GET ['category_id']);
        $category_name = $category->getField('title');
    } else {
        $category_name = 'Всем';
    }

    if (isset($_GET ['goods_category_id'])) {
        $goods_category = new Goods_category_id($_GET ['goods_category_id']);
        $goods_category_name = $goods_category->getField('title');
    } else {
        $goods_category_name = 'Все товары';
    }

    // $params = [];
    // foreach ($_GET as $key => $value) {
    //     $temp_get = $_GET; 
    //     unset($temp_get[$key]);
    //     if ($key == 'from') {
    //         unset($temp_get['up_to']);
    //     }
    //     $str = http_build_query($temp_get);
    //     $params[$key] = $str;
    //     if ($params[$key] != '') {
    //         $params[$key] = "&".$params[$key];
    //     }
    // }
    // $end_url = $_SERVER['QUERY_STRING'];
    // if ($end_url != '') {
    //     $end_url = "&".$end_url;
    // }

    $connect = new Connect();
    $filter = ''; // ФИЛЬТРЫ
    $category_str = ''; // по разделам Ж / М / Д; (из Good.php)
    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $filter .= " AND category_id=$category_id";
        $category_str = "&category_id=$category_id";
    }
    
    $goods_category_str = ''; // по товарным категориям (группам)
    if (isset($_GET['goods_category_id'])) {
        $goods_category_id = $_GET['goods_category_id'];
        $filter .= " AND goods_category_id=$goods_category_id";
        $goods_category_str = "&goods_category_id=$goods_category_id";
    }

    $new_arrival_str = ''; // по новинкам
    if (isset($_GET['new_arrival'])) {
        $new_arrival = $_GET['new_arrival'];
        $filter .= " AND new_arrival=$new_arrival";
        $new_arrival_str = "&new_arrival=$new_arrival";
    }
    
    $price_range_str = ''; // по ценовому диапазону
    if (isset($_GET['from']) && isset($_GET['up_to'])) {
        $from = $_GET['from'];
        $up_to = $_GET['up_to'];
        $filter .= " AND `price` > $from AND `price` < $up_to";
        $price_range_str = "&from=$from&up_to=$up_to";
    }
    
    if (isset($_GET['size'])) { // по размеру 
        $size = $_GET['size'];
        $query = "SELECT core_goods.*, goods_sizes.good_id 
                    FROM core_goods 
                    RIGHT JOIN goods_sizes 
                    ON core_goods.id = goods_sizes.good_id 
                    WHERE size_id = $size $filter ";
        $result = mysqli_query($connect->getConnect(), $query);

        $arr_size = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $arr_size[] = $row['id'];
        }
        $goods_amount = count($arr_size);
        $size_str = "&size=$size";
    } else {
        $result = mysqli_query($connect->getConnect()," SELECT COUNT(`id`) AS `num` FROM `core_goods` WHERE id>0 $filter "); // id>0 для того, чтобы после WHERE достроить запрос тем, что в $filter
        $info = mysqli_fetch_assoc($result);
        $goods_amount = $info['num'];
    }
    // ПАГИНАЦИЯ
    $per_page = 12;
    $pages_amount = ceil($goods_amount / $per_page);
    $page = 1;
    if (isset($_GET['page'])) {
        if ($pages_amount < $_GET['page']) {
            header('Location: '.URL.'/catalog.php?'.trim((isset($params['page']) ? $params['page'] : $end_url), "&"));
        }
        $page = $_GET['page'];
    }
?>

<div class="limiter catalog">
    <div class="breadcrumbs">
        <a href="/index.php">ГЛАВНАЯ</a>
        <a>/</a>
        <a><?= $category_name ?></a>
    </div>
    
    <section>
        <h1><?= $category_name ?></h1>
        <h2><?= $goods_category_name ?></h2>
        <div class="filter">
            <div class="select"> 
                <div class="closed">
                    <?php if (!isset($_GET['goods_category_id'])): ?>
                        Категория
                    <?php else: ?>
                        <?php
                            $result = (new Goods_category_id ())->getElements();
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['id'] == $_GET['goods_category_id']) {
                                    echo $row['title'];
                                }
                            }
                        ?>
                    <?php endif; ?>
                </div>
                <div>
                    <?php $result = (new Goods_category_id ())->getElements(); ?>
                    <a href="?<?= isset($params['goods_category_id']) ? trim($params['goods_category_id'], "&") : trim($end_url, "&") ?>">
                        <span>Не выбрано</span>
                    </a>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php if (isset($_GET['goods_category_id']) && $row['id'] == $_GET['goods_category_id']): ?>
                        <?php else: ?>
                            <a href="?goods_category_id=<?= $row['id'] ?><?= isset($params['goods_category_id']) ? $params['goods_category_id'] : $end_url ?>">
                                <span><?= $row['title'] ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="select"> 
                <div class="closed">
                    <?php if (!isset($_GET['size'])): ?>
                        Размер
                    <?php else: ?>
                        <?php
                            $result = (new Size ())->getSizesInStock();
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['id'] == $_GET['size']) {
                                    echo $row['size'];
                                }
                            }
                        ?>
                    <?php endif; ?>
                </div>
                <div>
                    <?php $result = (new Size ())->getSizesInStock(); ?>
                    <a href="?<?= isset($params['size']) ? trim($params['size'], "&") : trim($end_url, "&") ?>">
                        <span>Не выбрано</span>
                    </a>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php if (isset($_GET['size']) && $row['id'] == $_GET['size']): ?>
                        <?php else: ?>
                            <a href="?size=<?= $row['id'] ?><?= isset($params['size']) ? $params['size'] : $end_url ?>">
                                <span><?= $row['size'] ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="select"> 
                <div class="closed">
                    <?php if (!isset($_GET['from'])): ?>
                        Стоимость
                    <?php else: ?>
                        <?php
                            $result = (new Price_Range ())->getElements();
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['price_from'] == $_GET['from']) {
                                    echo ($row['price_from'] .' — '. $row['price_up_to']);
                                }
                            }
                        ?>
                    <?php endif; ?>
                </div>
                <div>
                    <?php $result = (new Price_Range ())->getElements(); ?>
                    <a href="?<?= isset($params['from']) ? trim($params['from'], "&") : trim($end_url, "&") ?>">
                        <span>Не выбрано</span>
                    </a>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php if (isset($_GET['from']) && $row['price_from'] == $_GET['from']): ?>
                        <?php else: ?>
                            <a href="?from=<?= $row['price_from'] ?>&up_to=<?= $row['price_up_to'] ?><?= isset($params['from']) ? $params['from'] : $end_url ?>">
                                <span><?= $row['price_from'] ?> — <?= $row['price_up_to'] ?> руб.</span>
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>

        <div id='catalog'></div>

        <div class='buttons'>
            <?php for ($i = 1; $i <= $pages_amount; $i++) {?>
                <a  href="?page=<?= $i ?><?= isset($params['page']) ? $params['page'] : $end_url ?>" 
                    class="button <?php if ($i == $page) {?> active_button <?php }?>">
                    <div>
                        <?= $i ?>
                    </div>
                </a>
            <?php }?>
        </div>
    </section>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>