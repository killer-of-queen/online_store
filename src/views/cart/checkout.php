<?php include ROOT.'/views/layouts/header.php' ?>
<main class="main wrapper registration__wrapper">
    <?php if ($result == false): ?>
        <div class="registration">
            <p class="registration__header">Оформление заказа</p>
            <p class="registration__error">&nbsp;</p>
            <form class="registration_form" action="#" method="post">
                <label class="registration__label" for="name">Ваше имя</label>
                <input id="name" value="<?php echo $userName?>" class="registration__field" type="text" name="name" placeholder="Ваше имя">
                <p class="registration__error">&nbsp;</p>
                <label class="registration__label" for="tel">Номер телефона</label>
                <input id="tel" placeholder="+7(914)093-31-33" class="registration__field" type="tel" name="tel">
                <p class="registration__error">&nbsp;</p>
                <label class="registration__label" for="comment">Комментарий к заказу</label>
                <input id="comment" class="registration__field" type="text" name="comment" placeholder="Сообщение">
                <p class="registration__error">&nbsp;</p>
                <input class="registration_submit" type="submit" name="submit" value="Оформить">
            </form>
        </div>
    <?php else:?>
    <?php echo "Ваш заказ оформлен. Наш менеджер свяжется с вами в ближайшее время.";?>
    <?php endif;?>
</main>
<?php include ROOT.'/views/layouts/footer.php' ?>
