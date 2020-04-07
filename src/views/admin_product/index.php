<?php include ROOT.'/views/layouts/admin_header.php' ?>
<main class="main wrapper user-cabinet__wrapper">
    <div class="admin__product__add">
        <div class="user-cabinet__header">Добавить новый</div>
        <a class="admin__product__add__button user-cabinet__logout" href="/admin/product/create">
            <i class="fa fa-plus fa-2x" style="color: #FFB800" aria-hidden="true"></i>
        </a>
    </div>
    <div class="user-cabinet__orders__header">Список товаров</div>
    <div class="user-cabinet__orders">
        <form class="user-cabinet__orders__search-form" action="">
            <div class="user-cabinet__orders__search-form__div">
                <i class="serach__icon fa fa-search" aria-hidden="true"></i>
                <input class="user-cabinet__orders__search-form__input" placeholder="Введите id или наименование товара" type="text">
            </div>
        </form>
        <table class="contact__table user-cabinet__orders__list">
            <tr class="user-cabinet__orders__list-row user-cabinet__orders__list-row__header">
                <th>ID</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
            <?php foreach($productList as $key => $product): ?>
                <tr class="user-cabinet__orders__list-row">
                    <td><?php echo $product['id']?></td>
                    <td><?php echo $product['name']?></td>
                    <td><img class="contact__image" src="/template/images/<?php echo $product['image']?>" width="100rem" alt="img"></td>
                    <td><?php echo $product['price']?></td>
                    <td><?php echo $product['amount']?></td>
                    <td>
                        <a href="/admin/product/update/<?php echo $product['id']?>">
                            <i class="fa fa-edit fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>
                        <a href="/admin/product/delete/<?php echo $product['id']?>">
                            <i class="fa fa-trash-o fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>