<?php include ROOT.'/views/layouts/header.php' ?>
<main class="main wrapper user-cabinet__wrapper">
    <div class="user-cabinet__orders__header">Содержимое заказа № <?php echo $order_id?></div>
    <?php if ($order): ?>
        <div class="user-cabinet__orders">
            <table class="contact__table user-cabinet__orders__list">
                <tr class="user-cabinet__orders__list-row user-cabinet__orders__list-row__header">
                    <th>ID</th>
                    <th>Название</th>
                    <th>Изображение</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Стоимость</th>
                    <th>Удалить</th>
                </tr>
                <?php foreach($order as $key => $item): ?>
                    <tr class="user-cabinet__orders__list-row">
                        <td><?php echo $item['id']?></td>
                        <td><?php echo $item['name']?></td>
                        <td><img class="contact__image" src="/template/images/<?php echo $item['image']?>" width="100rem" alt="img"></td>
                        <td><?php echo $item['price']?></td>
                        <td><?php echo $item['amount']?></td>
                        <td><?php echo sprintf("%.2f", $item['price'] * $item['amount'])?></td>
                        <td class="order-delete-item">
                            <?php if($orderInfo['status'] != 1 && $orderInfo['status'] != 2):?>
                                <a class="order-delete-link" href="/admin/order/deleteProduct/<?php echo $order_id?>/<?php echo $item['id']?>">
                                    <i class="fa fa-trash-o fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                                </a>
                            <?php else: ?>
                                <i class="fa fa-trash-o fa-2x" style="color: #7a7a7a" aria-hidden="true"></i>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="user-cabinet__orders__list-row">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Всего:</td>
                    <td><?php echo sprintf("%.2f", $totalPrice)?></td>
                </tr>
            </table>
            <div class="order__query">
                <?php if($orderInfo['status'] != 1 && $orderInfo['status'] != 2):?>
                    <div class="payment__control">
                        <a id="payment-button" data-id="<?php echo $order_id?>" class="product-list__btn-buy">Оплатить</a>
                        <div class="payment-error" id="payment-error"></div>
                    </div>
                <?php else: ?>
                    <?php if($orderInfo['status'] == 1): ?>
                        <div class="order__is__paid"><?php echo "Оплачено"?></div>
                    <?php else: ?>
                        <div class="order__is__paid"><?php echo "Отменено"?></div>
                    <?php endif;?>
                <?php endif;?>
            </div>
        </div>
    <?php else: ?>
        Список заказа пуст
    <?php endif;?>
</main>