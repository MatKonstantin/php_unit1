<?php

$summa = 0;

echo $num = rand(101, 999), "<hr />";
echo $num % 100, "<hr />";
echo $num % 10, "<hr />";

echo $num % 100 < 5 || $num % 10 > 20, '<hr />';
echo $num % 10 == 1;

$basket = [ 2 => 1, 10 => 2];

$word = 'товаров';
if( $num % 100 < 5 || $num % 100 > 20 ){
  if( $num % 10 == 1 ){
    $word = 'товар';
  }
  if( $num % 10 > 1 && $num % 10 < 5 ){
    $word = 'товара';
  }
}
echo " ${num} ${word} ";


?>

  <div class="py-5 text-center">
    <p class="lead">Внимательно заполните поля формы, проверьте корректность введённых данных и позиции товаров и их количество.</p>
  </div>
  <form class="form" method="POST">
  <div class="row">
    <div class="col-md-6 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Корзина</span>
        <span class="badge badge-secondary badge-pill">
          <?= $counter ? $counter : 'товаров в корзине нет' ?>
        </span>
      </h4>
      <ul class="list-group mb-3">
        <?php
          $booksBasket = getBooksByBasket();
          if( count($_SESSION['basket']) ):
            foreach( $_SESSION['basket'] as $id => $quantity ){
              calcAmount( $booksBasket[$id]['price'] * $quantity );
        ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?= $booksBasket[$id]['title']?></h6>
            <small class="text-muted">краткое необходимое описание</small>
          </div>
          <span class="text-muted"><?= $booksBasket[$id]['price']?>руб. * <?= $quantity ?>шт</span>
          <span class="text-muted"><?= $booksBasket[$id]['price'] * $quantity ?>руб.</span>
          <span ><a href="?del=<?= $id ?>" class="btn btn-success btn-sm ">Удалить</a></span>
        </li>
        <?php
            }
          endif;
        ?>

        <li class="list-group-item d-flex justify-content-between">
          <span>Всего: </span>
          <strong><?= calcAmount( 0 ) ?>руб.</strong>
        </li>
      </ul>

    </div>
    <div class="col-md-6 order-md-1">
      <h4 class="mb-3">Информация</h4>
      <form class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Имя</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Укажите корректное имя
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Фамилия</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Укажите корректную фамилию
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(опционально)</span></label>
          <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Укажите корректный email 
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Адрес доставки</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="город, улица, дом, квартира" required>
          <div class="invalid-feedback">
            Укажите адрес доставки
          </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Оформить заказ!</button>
      </form>
    </div>
  </div>
  </form>