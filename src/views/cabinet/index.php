<?php include ROOT.'/views/layouts/header.php' ?>
<main class="main wrapper user-cabinet__wrapper">
    <div class="user-cabinet__title">
        <div class="user-cabinet__header">Личный кабинет</div>
        <a class="user-cabinet__logout" href="/user/logout">
            <i class="fa fa-sign-out fa-2x" style="color: #FFB800" aria-hidden="true"></i>
        </a>
    </div>
    <div class="user-cabinet__personal-information">
        <form class="user-cabinet__personal-information__item" method="post" action="/cabinet/editLogin">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-user-md fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <input name="name" onkeydown="this.style.width = ((this.value.length + 1) * 8) + 'px';" class="user-cabinet__personal-information__item__info__name" value="<?php echo $user['login']?>"/>
            </div>
            <input value="Изменить" class="personal-information__submit" type="submit" name="submit"/>
        </form>
        <form class="user-cabinet__personal-information__item" method="post" action="/cabinet/editEmail">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-envelope-o fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">
                    <div>Электронная почта</div>
                    <input type="email" name="email" value="<?php echo $user['email']?>" class="user-cabinet__personal-information__item__info__value"/>
                </div>
            </div>
            <input value="Изменить" class="personal-information__submit" type="submit" name="submit"/>
        </form>
        <form class="user-cabinet__personal-information__item" method="post" action="/cabinet/editPassword">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-key fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">
                    <div>Пароль</div>
                    <input type="password" name="password" placeholder="Ваш новый пароль" class="user-cabinet__personal-information__item__info__value"/>
                </div>
            </div>
            <input value="Изменить" class="personal-information__submit" type="submit" name="submit"/>
        </form>
        <form class="user-cabinet__personal-information__item" method="post" action="/cabinet/delete">
            <div class="user-cabinet__personal-information__item__info">
                <i class="fa fa-trash-o fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                <div class="user-cabinet__personal-information__item__info__name">Удалить аккаунт</div>
            </div>
            <input type="submit" name="submit" value="Удалить" class="personal-information__submit" type="submit"/>
        </form>
    </div>
    <div class="user-cabinet__orders__header">Список заказов</div>
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
                <th>Цена</th>
                <th>Статус</th>
            </tr>
                <?php foreach ($orders as $order): ?>
                    <tr class="user-cabinet__orders__list-row">
                        <td><?php echo $order['id']?></td>
                        <td><?php echo $order['date']?></td>
                        <td><?php echo $order['quantity']?></td>
                        <td><?php echo $order['price']?></td>
                        <td><?php echo $order['status']?></td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                Ваша корзина пуста
            <?php endif; ?>
        </table>
    </div>
</main>
<?php include ROOT.'/views/layouts/footer.php' ?>
