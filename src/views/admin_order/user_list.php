<?php include ROOT.'/views/layouts/admin_header.php' ?>
<main class="main wrapper user-cabinet__wrapper">
    <div class="user-cabinet__orders__header">Список заказов пользователя №<?php echo $id?> (<?php echo $user['login']?>)</div>
    <div class="user-cabinet__personal-information">
        <div class="user-cabinet__personal-information__item">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-calendar fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">Дата последнего посещения:</div>
            </div>
            <div class="admin__user__info"><?php echo $new?></div>
        </div>
        <div class="user-cabinet__personal-information__item">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-lock fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">Новые заказы:</div>
            </div>
            <div class="admin__user__info"><?php echo $new?> (<?php echo $newSum?>$)</div>
        </div>
        <div class="user-cabinet__personal-information__item">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-plus-square-o fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">Оплаченные заказы:</div>
            </div>
            <div class="admin__user__info"><?php echo $paid?> (<?php echo $paidSum?>$)</div>
        </div>
        <div class="user-cabinet__personal-information__item">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-minus-square fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">Отмененные заказы:</div>
            </div>
            <div class="admin__user__info"><?php echo $canceled?> (<?php echo $canceledSum?>$)</div>
        </div>
        <div class="user-cabinet__personal-information__item">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-money fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">Всего:</div>
            </div>
            <div class="admin__user__info"><?php echo $total?> (<?php echo $sum?>$)</div>
        </div>
    </div>
    <div class="user-cabinet__orders__header">Все заказы</div>
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
                    <th>Дата</th>
                    <th>Количество товаров</th>
                    <th>Статус</th>
                    <th>Редактировать</th>
                    <th>Отменить</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr class="user-cabinet__orders__list-row">
                        <td><?php echo $order['id']?></td>
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
