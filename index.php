<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $title = 'главная страница';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/top.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/header.php';

    $result = (new Article())->getElements();
?>

<div class="limiter main_page">

    <section>
        <h1>НОВЫЕ ПОСТУПЛЕНИЯ ВЕСНЫ</h1>
        <p>Мы подготовили для Вас лучшие новинки сезона</p>
        <a href="/catalog.php?new_arrival=1" class="button">
            <div>ПОСМОТРЕТЬ НОВИНКИ</div>
        </a>
        <div class="tiles_wrapper">
        <div class="tiles">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php $article = new Article ($row['id']); ?>

                <a
                    class="tile" style="background-image:url('<?= $article->getField('photo') ?>')" 
                    <?php if ($row['id'] == 1): ?>
                    href="/catalog.php?goods_category_id=6"
                    <?php elseif ($row['id'] == 3): ?>
                    href="/catalog.php?goods_category_id=3"
                    <?php elseif ($row['id'] == 5): ?>
                    href="/catalog.php?goods_category_id=2"
                    <?php elseif ($row['id'] == 7): ?>
                    href="/catalog.php?category_id=3"
                    <?php elseif ($row['id'] == 8): ?>
                    href="/catalog.php?goods_category_id=5"
                    <?php elseif ($row['id'] == 10): ?>
                    href="/catalog.php?goods_category_id=4"
                    <?php endif; ?>
                >
                    <div class="translucent">
                        <div class="mark"><?= $article->getField('mark') ?></div>
                        <h3><?= $article->getField('title') ?></h3>
                        <p><?= $article->getField('text') ?></p>
                    </div>
                </a>

            <?php endwhile; ?>
        </div>
        </div>
    </section>

    <section>
        <h2>будь всегда в курсе выгодных предложений</h2>
        <p>подписывайся и следи за новинками и выгодными предложениями.</p>
        <div>
            <form id="newsletter" action="/handlers/newsletter.php" method="GET" autocomplete="off">
                <div class="item">
                    <input type="text" name="email" placeholder="e-mail">
                </div>
                <div class="item">
                    <input type="submit" value="подписаться">
                </div>
            </form>
            <div>
                <div class="too_long">Превышен лимит символов.</div>
                <div class="empty_field">Пожалуйста, заполните это поле.</div>
                <div class="incorrect_email">Некорректный email.</div>
            </div>
        </div>
    </section>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/inc/footer.php';
?>