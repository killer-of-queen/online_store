<?php include ROOT.'/views/layouts/admin_header.php' ?>
<main class="main wrapper user-cabinet__wrapper">
    <div class="user-cabinet__orders__header">Список заказов пользователей</div>
    <div class="user-cabinet__orders">
        <form class="user-cabinet__orders__search-form" action="">
            <div class="user-cabinet__orders__search-form__div">
                <i class="serach__icon fa fa-search" aria-hidden="true"></i>
                <input class="user-cabinet__orders__search-form__input" placeholder="Введите id или дату заказа" type="text">
            </div>
        </form>
        <table class="user-cabinet__orders__list">
            <?php if($orders): ?>
                <tr class="user-cabinet__orders__list-row user-cabinet__orders__list-row__header">
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Дата</th>
                    <th>Количество товаров</th>
                    <th>Статус</th>
                    <th>Редактировать</th>
                    <th>Отменить</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr class="user-cabinet__orders__list-row">
                        <td><?php echo $order['id']?></td>
                        <td><a href="/admin/user/<?php echo $order['user_id']?>"><?php echo $order['user']?></a></td>
                        <td><?php echo $order['date']?></td>
                        <td><?php echo $order['quantity']?></td>
                        <td><?php echo $order['status']?></td>
                        <td>
                            <a href="/admin/order/update/<?php echo $order['id']?>">
                                <i class="fa fa-edit fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <a href="/admin/order/delete/<?php echo $order['id']?>">
                                <i class="fa fa-trash-o fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                Ваша корзина пуста
            <?php endif; ?>
        </table>
    </div>
</main>