<div class="container">
  <div class="py-5 text-center">
    <h2>Заказы</h2>
    <p class="lead">Перечень заказов.</p>
  </div>

    <table class="table table-border">
        <tr>
            <th>Номер заказа</th>
            <th>Время</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>емайл</th>
            <th>адрес</th>
        </tr>
    <?php
        if(file_exists(ORDERS)) :
        $orderRows = file(ORDERS);
        foreach($orderRows as $orderRow):
            list($id, $time, $fname, $lname, $email, $address) = explode('|', $orderRow);
            $time = date("d-m-Y H:i:s", $time);
    ?>
        <tr>
            <td><?= $id?></td>
            <td><?= $time?></td>
            <td><?= $fname?></td>
            <td><?= $lname?></td>
            <td><?= $email?></td>
            <td><?= $address?></td>
        </tr>
    <?php
        endforeach;
        endif;
    ?>
    </table>
</div>