<?php
    require_once($_SERVER['DOCUMENT_ROOT']).'/config/db_config.php';
    require_once($_SERVER['DOCUMENT_ROOT']).'/system/classes/autoload.php';

    if (isset($_COOKIE['user_id'])) {
      $user = new User($_COOKIE['user_id']);
      if ($user->getField('user_group') !=2) {
        header('Location: /index.php');
      }
    } else {
      header('Location: /index.php');
    }


    if (isset($_GET ['table_id'])) {
      $table = new Table ($_GET ['table_id']);
      $title = $table->getField('title');
    } else {
      $user = new User($_COOKIE['user_id']);
      $title = 'Здравствуйте, '.$user->getfield('name').' '.$user->getfield('surname').'!';
    }

    if (isset($_GET ['new_good'   ])){  $title = 'Новый товар'                    ;}
    if (isset($_GET ['edit_good'  ])){  $title = "Редактировать товарную позицию" ;}
    if (isset($_GET ['edit_user'  ])){  $title = "Редактировать пользователя"     ;}
?>

<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Панель администратора</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">SH</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="/handlers/logout.php">Выйти</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">






        <!-- LEFT MENU
        =========================================================================== -->
        <ul class="nav flex-column">
        
          <li class="nav-item">
            <a class="nav-link" <?= (isset($_GET['table_id']) && $_GET['table_id'] == 1) ? "style='color: red;'" : '' ?> href="?table_id=1">
              <span data-feather="file">
                Заказы
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" <?= (isset($_GET['table_id']) && $_GET['table_id'] == 2) ? "style='color: red;'" : '' ?> href="?table_id=2">
              <span data-feather="shopping-cart">
                Товары
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" <?= (isset($_GET['table_id']) && $_GET['table_id'] == 3) ? "style='color: red;'" : '' ?> href="?table_id=3">
              <span data-feather="users">
                Пользователи
              </span>
            </a>
          </li>
          
        </ul>
      </div>
    </nav>
    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"></div>

      <h2><?= $title ?></h2>






      <!-- NEW GOOD
      =========================================================================== -->
      <?php if (isset($_GET ['table_id']) && $_GET ['table_id'] == 2): ?>
        <div class="container d-grid gap-2 d-md-flex justify-content-md-end">
          <a class="btn btn-primary" href="?new_good" role="button">
            Создать товарную позицию
          </a>
        </div>
      <?php endif; ?>

      <!-- New Good Form
      ========================= -->
      <?php if (isset($_GET ['new_good'])): ?>
        <div class="d-grid gap-2 col-6">
          <form enctype="multipart/form-data" action="/handlers/new_good.php" method="POST">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Наименование
              </label>
              <input name="title" type="text" class="form-control" aria-describedby="emailHelp" placeholder="title">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Цена
              </label>
              <input name="price" type="number" class="form-control" aria-describedby="emailHelp" placeholder="price">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Артикул
              </label>
              <input name="vendor_code" type="text" class="form-control" aria-describedby="emailHelp" placeholder="vendor_code">
            </div>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">
                Описание
              </label>
              <textarea name="specification" class="form-control" rows="3" placeholder="specification"></textarea>
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Изображение
              </label>
              <input name="photo" class="form-control" type="file" placeholder="photo">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Товарная категория
              </label>
              <select name="category_id" class="form-select" aria-label="Default select example">
                <option hidden selected>category_id</option>
                <option value="1">Женщинам</option>
                <option value="2">Мужчинам</option>
                <option value="3">Детям</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Товарная группа
              </label>
              <select name="goods_category_id" class="form-select" aria-label="Default select example">
                <option hidden selected>goods_category_id</option>
                <option value="1">Верхняя одежда</option>
                <option value="2">Обувь</option>
                <option value="3">Брюки, джинсы</option>
              </select>
            </div>

            <div class="mb-3 form-check">
              <input name="new_arrival" value="1" type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">
                Новинка
              </label>
            </div>

            <button type="submit" class="btn btn-primary">
              Внести в базу
            </button>
          </form>
        </div>






      <!-- EDIT GOOD
      =========================================================================== -->
      <?php elseif (isset($_GET ['edit_good'])): ?>
        <?php $good = new Good($_GET['id']); ?>

        <div class="d-grid gap-2 col-6">
          <form enctype="multipart/form-data" action="/handlers/edit_good.php" method="POST">
            <!-- скрытый инпут для отправки id -->
            <input type="hidden" name="id" value="<?= $good->getField('id') ?>">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Наименование
              </label>
              <input name="title" type="text" class="form-control" aria-describedby="emailHelp" placeholder="title" value="<?= $good->getField('title'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Цена
              </label>
              <input name="price" type="number" class="form-control" aria-describedby="emailHelp" placeholder="price" value="<?= $good->getField('price'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Артикул
              </label>
              <input name="vendor_code" type="text" class="form-control" aria-describedby="emailHelp" placeholder="vendor_code" value="<?= $good->getField('vendor_code'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">
                Описание
              </label>
              <textarea name="specification" class="form-control" rows="3" placeholder="specification"><?= $good->getField('specification'); ?></textarea>
            </div>

            <div class="mb-3">
              <img style="width: 200px" src="<?= $good->getField('photo'); ?>">
              <input name="photo" class="form-control" type="file" placeholder="photo">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Товарная категория
              </label>
              <select name="category_id" class="form-select" aria-label="Default select example">

                <?php
                  $category = new Category ($good->getField('category_id'));
                  $result = (new Category ())->getElements();
                  while ($row = mysqli_fetch_assoc($result)) {
                    $arr_category[] = $row['title'];
                  }
                ?>
                
                <option value="<?= $category->getField('id') ?>" selected><?= $category->getField('title') ?></option>

                  <?php foreach ($arr_category as $key => $value): ?>
                    <?php if ($key != $category->getField('id') - 1): // чтобы не дублировалось с selected ?>
                      <option value="<?= $key + 1 ?>">
                        <?= $value ?>
                      </option>
                    <?php endif; ?>
                  <?php endforeach; ?>

              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Товарная группа
              </label>
              <select name="goods_category_id" class="form-select" aria-label="Default select example">

                <?php
                  $goods_category_id = new Goods_category_id ($good->getField('goods_category_id'));
                  $result = (new Goods_category_id ())->getElements();
                  while ($row = mysqli_fetch_assoc($result)) {
                    $arr_goods_category_id[] = $row['title'];
                  }
                ?>

                <option value="<?= $goods_category_id->getField('id') ?>" selected><?= $goods_category_id->getField('title') ?></option>

                <?php foreach ($arr_goods_category_id as $key => $value): ?>
                  <?php if ($key != $goods_category_id->getField('id') - 1): ?>
                    <option value="<?= $key + 1 ?>">
                      <?= $value ?>
                    </option>
                  <?php endif; ?>
                <?php endforeach; ?>

              </select>
            </div>

            <div class="mb-3 form-check">
              <input name="new_arrival" value="0" type="hidden"> <!-- cкрытый инпут с таким же именем, чтобы чекбокс отправлялся при снятой галке, когда мы редактируем товар (если отсутствует checked, инпут не отправляется, а нам надо его отправить со значением "0") -->
              <input name="new_arrival" value="1" type="checkbox" class="form-check-input" id="exampleCheck1"
                <?php if ($good->getField('new_arrival')): ?>
                  checked
                <?php endif; ?>>
              <label class="form-check-label" for="exampleCheck1">
                Новинка
              </label>
            </div>

            <button type="submit" class="btn btn-primary">
              Сохранить изменения
            </button>
          </form>
        </div>
      <?php endif; ?>






      <!-- EDIT USER
      =========================================================================== -->
      <?php if (isset($_GET ['edit_user'])): ?>
        <?php $user = new User($_GET['id']); ?>

        <div class="d-grid gap-2 col-6">
          <form enctype="multipart/form-data" action="/handlers/edit_user.php" method="GET">
            <!-- скрытый инпут для отправки id -->
            <input type="hidden" name="id" value="<?= $user->getField('id') ?>">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Имя
              </label>
              <input name="name" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $user->getField('name'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Фамилия
              </label>
              <input name="surname" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $user->getField('surname'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Адрес
              </label>
              <input name="adress" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $user->getField('adress'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Город
              </label>
              <input name="city" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $user->getField('city'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Почтовый индекс
              </label>
              <input name="postcode" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $user->getField('postcode'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Телефон
              </label>
              <input name="phone" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $user->getField('phone'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Email
              </label>
              <input name="email" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $user->getField('email'); ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Привилегии
              </label>
              <select name="user_group" class="form-select" aria-label="Default select example">

                <?php
                  $user_group = new User_groups ($user->getField('user_group'));
                  $result = (new User_groups ())->getElements();
                  while ($row = mysqli_fetch_assoc($result)) {
                    $arr_user_group[] = $row['title'];
                  }
                ?>

                <option value="<?= $user_group->getField('id') ?>" selected><?= $user_group->getField('title') ?></option>

                  <?php foreach ($arr_user_group as $key => $value): ?>
                    <?php if ($key != $user_group->getField('id') - 1): ?>
                      <option value="<?= $key + 1 ?>">
                        <?= $value ?>
                      </option>
                    <?php endif; ?>
                  <?php endforeach; ?>

              </select>
            </div>

            <button type="submit" class="btn btn-primary container">
              Сохранить изменения
            </button>
          </form>
        </div>

      <?php endif; ?>





      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <?php if (isset($_GET ['table_id']) && $_GET ['table_id'] == 1): ?>
                <th>id</th>
                <th>Имя</th>
                <th>Емайл</th>
                <th>Заказ</th>
                <th>Создан</th>
                <th>Просмотрено</th>
                <th>Статус</th>
              <?php endif; ?>

              <?php if (isset($_GET ['table_id']) && $_GET ['table_id'] == 2): ?>
                <th>id</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Описание</th>
                <th>Пол</th>
                <th>Категория</th>
                <th>Новинка</th>
              <?php endif; ?>

              <?php if (isset($_GET ['table_id']) && $_GET ['table_id'] == 3): ?>
                <th>id</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Группа</th>
              <?php endif; ?>
            </tr>
          </thead>

          <tbody>






            <!-- ORDERS 
            =========================================================================== -->
            <?php if (isset($_GET ['table_id']) && $_GET ['table_id'] == 1): ?>

              <?php
                $connect = new Connect();
                $query = "SELECT `id`, `name`, `email`, `order_list`, `order_status`, `created_at`, `processed_at` 
                          FROM `core_orders`";
                $result = mysqli_query($connect->getConnect(), $query);
              ?>

              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php $status = new Status($row['order_status']); ?>
                <tr>
                  <td><?= $row['id']; ?></td>
                  <td><?= $row['name']; ?></td>
                  <td><?= $row['email']; ?></td>

                  <td> <!-- Popover -->
                    <a tabindex="0" class="btn btn-sm btn-danger popover-dismiss" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Состав заказа" data-bs-content=
                    '
                      <?php 
                        $list = json_decode($row["order_list"]); 
                        $order = [$row['id']=>[$list]];

                        $connect = new Connect();
                        $query = "SELECT `delivery_type`.`price`, `core_orders`.`delivery_type`
                                  FROM `delivery_type`
                                  RIGHT JOIN `core_orders`
                                  ON `delivery_type`.`value` = `core_orders`.`delivery_type`
                                  WHERE `core_orders`.`id` = {$row['id']}";
                        $row2 = mysqli_query($connect->getConnect(), $query);
                        $delivery = mysqli_fetch_assoc($row2);
                        $delivery_price = $delivery['price'];
                        $delivery_type = $delivery['delivery_type'];

                        foreach ($order as $key => $val) {
                          $order_item_total = [];
                          foreach ($list as $goods_id => $size_amount_arr) {
                            $good = new Good($goods_id);
                            $goods_id = $good->getField('id');
                            $title = $good->getField('title');
                            $price = $good->getField('price');
                            foreach ($size_amount_arr as $size_id => $amount) {
                              $cost = $price * $amount;
                              $order_item_total[] = $cost;

                              $size = new Size($size_id);
                              $size = $size->getField('size');
                              echo '[ <a href="http://store.com/card.php?id='.$goods_id.'" target="_blank" rel="noopener noreferrer">'.$title.'</a> ]<br>
                              Размер: .......... '.$size.'<br>
                              Количество: ... '.$amount.'<br>
                              Стоимость: ..... '.$price.' * '.$amount.' = '.$cost.'
                              ===========================<br>';
                            }
                            if ($delivery_type == 'undefined') {
                              $delivery_price = 'не выбрано';
                              $total = array_sum($order_item_total);
                            } else {
                              $total = array_sum($order_item_total) + $delivery_price;
                            }
                          }
                          echo 
                            'Доставка: ....... '.$delivery_price.'<br>
                            Итого: ............. '.$total;
                        }
                      ?>
                    '>Открыть</a>
                  </td>

                  <td><?= $row['created_at']; ?></td>
                  <td>
                  <?= $row['processed_at'] != 0 ? date("Y-m-d H:i:s") : 'не просмотрено' ; ?>
                  </td>
                  <td style="color: <?= $status->getField('color') ?>; background: <?= $status->getField('background') ?>"><?= $status->getField('title'); ?></td>
                </tr>

              <?php endwhile; ?>
            <?php endif; ?>






            <!-- GOODS
            =========================================================================== -->
            <?php if (isset($_GET ['table_id']) && $_GET ['table_id'] == 2): ?>

              <?php
                $connect = new Connect();
                $query = "SELECT `id`, `title`, `price`, `specification`, `category_id`, `goods_category_id`, `new_arrival` FROM `core_goods`";
                $result = mysqli_query($connect->getConnect(), $query);
              ?>

              <?php while ($row = mysqli_fetch_assoc($result)): ?>

                <?php $category = new Category($row['category_id']); ?>
                <?php $goods_category = new Goods_category_id($row['goods_category_id']); ?>

                <tr>
                  <td><?= $row['id']; ?></td>
                  <td>
                    <a href="?edit_good&id=<?= $row['id']; ?>" target="_blank">
                      <?= $row['title']; ?>
                    </a>
                  </td>
                  <td><?= $row['price']; ?></td>
                  <td><?= $row['specification']; ?></td>
                  <td><?= $category->getField('title') ?></td>
                  <td><?= $goods_category->getField('title') ?></td>
                  <td><?= $row['new_arrival'] != 0 ? 'новинка' : '' ?></td>
                </tr>

              <?php endwhile; ?>
            <?php endif; ?>
            





            <!-- USERS
            =========================================================================== -->
            <?php if (isset($_GET ['table_id']) && $_GET ['table_id'] == 3): ?>

              <?php
                $connect = new Connect();
                $query = "SELECT `id`, `name`, `surname`, `adress`, `phone`, `email`, `user_group` FROM `core_users`";
                $result = mysqli_query($connect->getConnect(), $query);
              ?>

              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php $user_group = new User_groups($row['user_group']); ?>

                <tr>
                  <td>
                    <a href="?edit_user&id=<?= $row['id']; ?>" target="_blank">
                      <?= $row['id']; ?>
                    </a>
                  </td>
                  <td><?= $row['name']; ?></td>
                  <td><?= $row['surname']; ?></td>
                  <td><?= $row['adress']; ?></td>
                  <td> 
                    <a href="tel: <?= $row['phone'] ?>">
                      <?= $row['phone']; ?>
                    </a>
                  </td>
                  <td>
                    <a href="mailto: <?= $row['email'] ?>">
                      <?= $row['email']; ?>
                    </a>
                  </td>
                  <td><?= $user_group->getField('title'); ?></td>
                </tr>

              <?php endwhile; ?>
            <?php endif; ?>

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="/js/script_bootstrap.js"></script>
  </body>
</html>

