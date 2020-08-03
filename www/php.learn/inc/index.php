<div class="row">
<div class="col-md-3 col-sm-3 ">
        
  <h4>Категория</h4>
  
  <div class="row">
  <?php
    if( count($categories) ) {
      echo renderCategories($categories);
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
                echo renderPublisher($publisher);
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

<?php

$i = 0;
  foreach( $books as $book ){
    if($i % 3 == 0){
      echo '<div class="card-deck">';
      $i = 0;
    }
    
    echo  <<<CARD
    <div class="card">        
      <div class="card-body">
        <img src="http://placehold.it/150x220"  alt="...">
        <h3 class="card-title">{$book['price']}руб</h3>
        <p class="card-text"><small class="text-muted">Автор: {$book['author']}</small></p>
        <p class="card-text">{$book['description']} <a href="#">Полезное</a></p>
      </div>
      <div class="card-footer">
        <a href="?add={$book['idbook']}" class="btn btn-primary" >В корзину</a>
      </div>
    </div>
CARD;

    echo ($i == 2) ? '</div>' : '';
  }
?>

</div>

   
</div>
