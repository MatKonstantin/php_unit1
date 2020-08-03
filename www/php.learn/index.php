<?php

  session_start();

  include 'config.php';
  include_once 'library.php';

  if( !isset( $_SESSION['basket'] ) ){
    $_SESSION['basket'] = [];
  }

  if( !empty($_GET['add']) ){
    $add = (int) $_GET['add'];
    $_SESSION['basket'][$add]++;
    header('Location: /');
    die;
  }
  if( !empty($_GET['del']) ){
    $del = (int) $_GET['del'];
    $_SESSION['basket'][$del]--;
    if($_SESSION['basket'][$del] <= 0) unset($_SESSION['basket'][$del]);
    header('Location: /?page=basket');
    die;
  }

  $counter = 0;

  foreach( $_SESSION['basket'] as $key => $val){
    $counter += $val;
  }


  if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
  
    $firstName = postParam('firstName');
    $lastName = postParam('lastName');
    $email = postParam('email');
    $address = postParam('address');

    $alert = false;
    if( !$firstName ) {
      $alert = true;
      $flash['firstName'] = "Не заполнено поле <strong>firstName</strong>";
    }
    if( !$lastName ) {
      $alert = true;
      $flash['lastName'] = "Не заполнено поле <strong>lastName</strong>";
    }
    if( !$email ) {
      $alert = true;
      $flash['email'] = "Не заполнено поле <strong>email</strong>";
    }
    if( !$address ){
      $alert = true;
      $flash['address'] = "Не заполнено поле <strong>address</strong>";
    }
    

    if( !$alert && !saveOrder(
      $firstName,
      $lastName,
      $email,
      $address
    )){
      $flash[] = 'Проблема с оформлением заказа';
    }

    // запрос на вставку данных по книге в БД
    // $query = "INSERT INTO book VALUES (NULL, 'Автор', 'Название книги', 456, 'Описание', 'Категория')";
    // $author = 'Тестовый автор';
    // $title = 'Название книги';
    // $price = 678;
    // $description = '';
    // $category = 'Классика';
    // $query = "INSERT INTO book VALUES (NULL, '$author', '$title', $price, '$description', '$category')";

    // $successOrder = "$firstName! Заказ оформлен!";
    // $isPost = false;
  }

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


  $publisher = ['Издатель 1', 'Издатель 2', 'Издатель 3'];

  $page = getParam('page');
  $page = $page ?: 'index';

  $menu = [
    'Доставка' => '?page=delivery',
    'Контакты' => '?page=contacts',
    'Войти' => '?page=login',
    'Корзина' => '?page=basket',
    'Dropdown' => [
      'Action1' => '?page=action1',
      'Action2' => '?page=action2'
    ]
  ];

  $categories = ['Категория 1', 'Категория 2', 'Категория 3', 'Категория 4'];

  

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

        $badgeCounter = $textLink == 'Корзина' ? "<span class='badge badge-secondary'> $counter </span>" : "";

        if( is_string($url)){
          echo <<<LI
          <li class="nav-item active">
            <a class="nav-link" href="$url">$textLink $badgeCounter</a>
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

  </div>
  </div>
</nav>


<div class="container">

  <?php

  switch( $page ){
    case 'index' : echo '<h1>Каталог</h1>'; include("inc/$page.php"); break;
    case 'delivery' : echo '<h1>Доставка</h1>'; include("inc/$page.php"); break;
    case 'contacts' : echo '<h1>Контакты</h1>'; include("inc/$page.php"); break;
    case 'login' : echo '<h1>Вход</h1>'; include("inc/$page.php"); break;
    case 'basket' : echo '<h1>Корзина</h1>'; include("inc/$page.php"); break;
    default: echo '<h1>Страницы не найдена</h1>';
  }

  ?>

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