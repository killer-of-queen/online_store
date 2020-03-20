<?php include ROOT.'/views/layouts/header.php' ?>
<main class="main wrapper user-cabinet__wrapper">
    <div class="user-cabinet__orders__header">Корзина</div>
    <?php if ($productsInCart): ?>
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
            <?php foreach($products as $key => $product): ?>
            <tr class="user-cabinet__orders__list-row">
                <td><?php echo $product['id']?></td>
                <td><?php echo $product['name']?></td>
                <td><img class="contact__image" src="/template/images/<?php echo $product['image']?>" width="100rem" alt="img"></td>
                <td><?php echo $product['price']?></td>
                <td><?php echo $productsInCart[$product['id']]?></td>
                <td><?php echo $product['price'] * $productsInCart[$product['id']]?></td>
                <td><a href="/cart/delete/<?php echo $product['id']?>">
                        <i class="fa fa-trash-o fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                    </a></td>
            </tr>
            <?php endforeach; ?>
            <tr class="user-cabinet__orders__list-row">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Всего:</td>
                <td><?php echo $totalPrice?></td>
            </tr>
        </table>
        <a href="/cart/checkout" class="product-list__btn-buy">Оформить заказ</a>
    </div>
    <?php else: ?>
    Ваша корзина пуста
    <?php endif;?>
</main>
<?php include ROOT.'/views/layouts/footer.php' ?>
