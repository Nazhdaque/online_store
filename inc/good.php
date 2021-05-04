<?php // код на странице подключается через AJAX в script.js
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';
    $result = (new Good())->getElements();

    while ($row = mysqli_fetch_assoc($result)) {
        $good = new Good($row['id']);
?>
        <a href="/card.php?id=<?= $good->getField('id')?>" class="goods_item">
            <div class="item_photo"><img src="<?= $good->photo() ?>"></div>
            <div><?= $good->title() ?></div>
            <div><?= $good->price() ?> руб.</div>
        </a>
<?php }?>






        <!-- Было на 15 строке -->
        <!-- Тренировочный статический метод: статический метод принадлежит классу, не содержит псевдопеременную this и вызывается у самого класса через ::
        динамический метод принадлежит объекту и вызывается у экземпляра класса, может содержать this -->
        <!-- <div>
        <?//= Good::getNote() ?> 
        </div> -->
        <!-- Обращение к тренировочной константе. Константа также принадлежит самому классу -->
        <!-- <div>
            <?php// if(Good::AVAILABILITY) {echo 'Товар в наличии';}?> 
        </div> -->
        <!-- Обращение к тренировочной статической переменной -->
        <!-- <div>
            <?//php if(Good::$availability) {echo 'Количество: '.Good::$availability;}?> 
        </div> -->

    

