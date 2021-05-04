<?php
    $title = 'карточка товара';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';

    $good = new Good($_GET['id']);
    $category = new Category($good->getField('category_id')); // товарная категория (М/Ж/Д)
    $category_name = $category->getField('title');
    $goods_category_id = new Goods_category_id($good->getField('goods_category_id')); // товарная группа
    $goods_name = $goods_category_id->getField('title');
?>

<div class="limiter product_card">
    <div class="breadcrumbs">
        <a href="/index.php">ГЛАВНАЯ</a>
        <a>/</a>
        <a href="/catalog.php?category_id=<?= $good->getField('category_id')?>"><?= $category_name?></a>
        <a>/</a>
        <a href="/catalog.php?category_id=<?= $good->getField('category_id')?>&goods_category_id=<?= $good->getField('goods_category_id')?>"><?= $goods_name ?></a>
        <a>/</a>
        <a><?= $good->title() ?></a>
    </div>

    <section>
        <div class="image">
            <img src="<?= $good->getField('photo') ?>">
        </div>

        <h1><?= $good->getField('title') ?></h1>
        <p>Артикул: <?= $good->getField('vendor_code') ?></p>
        <p><?= $good->getField('price') ?> руб.</p>
        <p><?= $good->getField('specification') ?></p>

        <div class="size">
            <p>размер</p>
            <div>
                <!-- <form> -->
                    <div>
                        <?php
                            $connect = new Connect();
                            $query = "SELECT goods_sizes.*, core_goods.id, sizes.size 
                                        FROM goods_sizes 
                                        RIGHT JOIN core_goods 
                                        ON goods_sizes.good_id = core_goods.id 
                                        RIGHT JOIN sizes 
                                        ON goods_sizes.size_id = sizes.id 
                                        WHERE core_goods.id = {$_GET['id']} ";
                            $result = mysqli_query($connect->getConnect(), $query);
                        ?>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <label>
                                <input type="radio" name="size" value="<?= $row['size_id'] ?>">
                                <div><?= $row['size'] ?></div>
                            </label>
                        <?php endwhile ?>
                        <!-- <input hidden name="id" value=<?//= $good->getField('id') ?>> -->
                    </div>
                    <!-- <input onclick="to_basket()" class="orange_button" type="submit" value="добавить в корзину"> -->
                <!-- </form> -->
            </div>
            <div onclick="to_basket()" class="orange_button">добавить в корзину</div>
        </div>
    </section>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>