<?php

/**
 * renderCategories() - функция рендеринга списка категорий
 * @cat array - массив списка категорий
 * @return string - готовый вид списка категорий
 */
function renderCategories( array $cat = [] ): string
{
    $result = '';
    $i = 0;
    while( $i < count($cat) ){
        $result .= "<a class=\"dropdown-item\" href=\"#\">". $cat[$i] ."</a>";
        $i++;
    }
    return $result;
}

/**
 * renderPublisher() - функция рендеринга списка издателей
 * @pub array - массив издательств строк
 * @return string - готовый вид списка издательств
 */
function renderPublisher( array $pub = [] ): string
{
    $result = '';
    $length = count($pub);

    for($i = 0; $i < $length; ++$i ){
        $result .= <<<LI
      <li class="list-group-item">
        <input type="checkbox"  id="exampleCheck{$i}" name="publisher[]" value="{$i}">
        <label class="form-check-label" for="exampleCheck{$i}"> {$pub[$i]} </label>
      </li>
LI;
    }

    return $result;
}

function renderMenu( $menu )
{

}

/**
 * saveOrder() - функция сохранения заказа в файл
 * @firstName string - имя
 * @lastName string - фамилия
 * @email string - почта
 * @address string - почтовый адрес
 * @return boolean - результат
 */
function saveOrder( $firstName, $lastName, $email, $address ): bool
{
    $time = time();
    $idorder = uniqid();
    $order = "$idorder|$time|$firstName|$lastName|$email|$address\n";
    if( file_put_contents(ORDERS, $order, FILE_APPEND) ) {
        return true;
    }
    return false;
}

function calcAmount( float $delta = 100 ): float
{
    static $summa = 0;
    $summa += $delta;
    return $summa;
}


function getParam( string $param ): ?string
{
    return (isset($_GET[$param])) ? str_replace("|","",trim(strip_tags($_GET[$param]))) : null;
}

function postParam( string $param ): ?string
{
    return (isset($_POST[$param])) ? str_replace("|","",trim(strip_tags($_POST[$param]))) : null;
}

/**
 * Возвращает массив книг из корзины с ключами номерами книг
 */
function getBooksByBasket(): array
{
    global $books;
    $booksBasket = [];
    foreach( $books as $book ){
        if( array_key_exists($book['idbook'], $_SESSION['basket'])  ){
            $booksBasket[$book['idbook']] = $book;
        }
    }

    return $booksBasket;
}