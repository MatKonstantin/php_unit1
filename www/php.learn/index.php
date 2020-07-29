<?php

  include 'config.php';
  $publisher = ['Издатель 1', 'Издатель 2', 'Издатель 3'];

  $page = 'index';

  $menu = [
    'Доставка' => 'delivery.php',
    'Контакты' => 'contacts.php',
    'Войти' => 'login.php',
    'Корзина' => 'basket.php',
    'Dropdown' => [
      'Action1' => 'action1.php',
      'Action2' => 'action2.php'
    ]
  ];

  $book = [
    'idbook' => 123,
    'title' => 'Название книги',
    'author' => 'Имя автора',
    'description' => 'описание книги',
    'price' => 1500
  ];
  $books = [];
  $books[] = $book;
  $books[] = [
    'idbook' => 345,
    'title' => 'Название книги2',
    'author' => 'Имя автора2',
    'description' => 'описание книги2',
    'price' => 1500
  ];
  $books[] = [
    'idbook' => 234,
    'title' => 'Название книги3',
    'author' => 'Имя автора3',
    'description' => 'описание книги3',
    'price' => 1500
  ];
  $books[] = [
    'idbook' => 541,
    'title' => 'Название книги4',
    'author' => 'Имя автора4',
    'description' => 'описание книги4',
    'price' => 1500
  ];

  $categories = ['Категория 1', 'Категория 2', 'Категория 3', 'Категория 4'];
  
  $lastName = 'Пупкин';
  $email = 'some@some.ru';
  $address = 'г. Москва';

  $order = '';
  $order .= $firstName . '|';
  $order .= $lastName . '|';
  $order .= $email . '|';
  $order .= $address . '\n';

  $order = "$firstName|$lastName|$email|$address\n";

// запрос на вставку данных по книге в БД
// $query = "INSERT INTO book VALUES (NULL, 'Автор', 'Название книги', 456, 'Описание', 'Категория')";
$author = 'Тестовый автор';
$title = 'Название книги';
$price = 678;
$description = '';
$category = 'Классика';
$query = "INSERT INTO book VALUES (NULL, '$author', '$title', $price, '$description', '$category')";

$successOrder = "$firstName! Заказ оформлен!";
$isPost = false;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <!-- <link href="starter-template.css" rel="stylesheet"> -->

    <title>PHP часть 1. Основы PHP</title>

    <style>
    .card-deck{
      margin-top: 20px      
    }

    .card-body img{
      display: block;
      margin: 0 auto 15px;

    }
    .card-footer{
      background: transparent;
      border: 0;
    }
    </style>
  </head>
  <body>

   

      

 
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
  <a class="navbar-brand" href="/">Интернет-магазин Книжка</a>    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="книгу.." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти!</button>
    </form>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <?php
    if(count($menu)){

      echo '<ul class="navbar-nav mr-auto">';
      
      foreach($menu as $textLink => $url){
        if( is_string($url)){
          echo <<<LI
          <li class="nav-item active">
            <a class="nav-link" href="$url">$textLink</a>
          </li>
LI;
        } else {
          echo <<<STARTDROPDOWN
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
STARTDROPDOWN;
          foreach($url as $textDropDownLink => $urlDropDown){
            echo <<<A
            <a class="dropdown-item" href="$urlDropDown">$textDropDownLink</a>
A;
          }
          echo '</div></li>';
        }
      }
      echo '</ul>';
    }
  ?>
    <!--ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= $menu['Доставка']?>">Доставка</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $menu['Контакты']?>">Контакты</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $menu['Войти']?>">Войти</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $menu['Корзина']?>">Корзина</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= $menu['Dropdown']['Action1']?>">Action</a>
          <a class="dropdown-item" href="<?= $menu['Dropdown']['Action2']?>">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul-->

  </div>
  </div>
</nav>

<div class="container">

<div class="row">
<div class="col-md-3 col-sm-3 ">
        
  <h4>Категория</h4>
  
  <div class="row">
  <?php
    if( count($categories) ) {
      $i = 0;
      while( $i < count($categories) ){
        echo "<a class=\"dropdown-item\" href=\"#\">" . $categories[$i] ."</a>";
        $i++;
      }
  ?>
    <!--a class="dropdown-item" href="#"><?= $categories[0] ?></!--a>
    <a class="dropdown-item" href="#"><?= $categories[0] ?></a>
    <a class="dropdown-item" href="#"><?= $categories[0] ?></a>
    <a-- class="dropdown-item" href="#"><?= $categories[0] ?></a-->
  <?php
    } else {
  ?>
    <a class="dropdown-item" href="#">Эелементов нет</a>
  <?php
    }
  ?>
  </div>
 <hr>
         
 <h4>Цена</h4>
  
  <div class="row">
    <div class="input-group mb-1">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">от</span>
    </div>
    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"> &nbsp;
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">до</span>
    </div>
    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">&nbsp;

    <button type="button" class="btn btn-success">Найти</button>    
  </div>
  </div>
 <hr>  
  <h4>Издательство</h4>

  <div class="row">
  <ul class="list-group col-md-12 col-sm-12">
  <?php
  if( $length = count($publisher) ){
    for($i = 0; $i < $length; ++$i ){
      echo <<<LI
    <li class="list-group-item">
      <input type="checkbox"  id="exampleCheck{$i}" name="publisher[]" value="{$i}">
      <label class="form-check-label" for="exampleCheck{$i}"> {$publisher[$i]} </label>
    </li>
LI;
    }
  ?>
    <li class="list-group-item">
      <button type="button" class="btn btn-success">Найти</button>    
    </li>
  </ul>

  <?php
    } else {
  ?>
    <li class="list-group-item">элементов нет</li>
  <?php
    }
  ?>
  </div>
 <hr>

 
</div>

<div class="col-md-9 col-sm-9 ">
  <!-- h1>Каталог</!-->

  <?php

  switch( $page ){
    case 'index' : echo '<h1>Каталог</h1>'; break;
    case 'delivery' : echo '<h1>Доставка</h1>'; break;
    case 'contacts' : echo '<h1>Контакты</h1>'; break;
    case 'login' : echo '<h1>Вход</h1>'; break;
    case 'basket' : echo '<h1>Корзина</h1>'; break;
    default: echo '<h1>Страницы не найдена</h1>';
  }

  $i = 0;
  $i++;
  echo $i, ' ', $i < 10;

  $i = 0;
  foreach( $books as list($idbook, $title, $author, $description, $price) ){
    if($i % 3 == 0){
      echo '<div class="card-deck">';
      $i = 0;
    }
    
    echo  <<<CARD
    <div class="card">        
      <div class="card-body">
        <img src="http://placehold.it/150x220"  alt="...">
        <h3 class="card-title">{$price}руб</h3>
        <p class="card-text"><small class="text-muted">Автор: {$author}</small></p>
        <p class="card-text">{$description} <a href="#">Полезное</a></p>
      </div>
      <div class="card-footer">
        <button type="button" class="btn btn-primary">В корзину</button>
      </div>
    </div>
CARD;

    echo ($i == 2) ? '</div>' : '';
  }

  ?>
  


</div>

   
</div>

  
</div>

<div class="container">

  </div><!-- /.container -->
  <?php include 'inc/footer.inc.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>