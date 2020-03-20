<?php include ROOT.'/views/layouts/header.php' ?>
    <main class="main registration__wrapper">
        <div class="wrapper">
            <?php if($result): ?>
                <p class="registration__success">Наш менеджер свяжется с вами в ближайшее время!</p>
            <?php else: ?>
                <div class="registration">
                    <p class="registration__header">Форма обратной связи</p>
                    <p class="registration__error">
                        <?php if (isset($errors) && isset($errors['is_email_correct'])): ?>
                            <?php if (isset($errors['is_email_correct'])): ?>
                                <?php echo $errors['is_email_correct'] ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo "&nbsp;" ?>
                        <?php endif; ?>
                    </p>
                    <form class="registration_form" action="#" method="post">
                        <label class="registration__label" for="email">Ваш адрес электронной почты</label>
                        <input id="email" class="registration__field contact_field" value="<?php echo $userEmail;?>" type="email" name="userEmail" placeholder="Email для обратной связи">
                        <label class="registration__label" for="text">Ваше вопрос</label>
                        <input id="text" class="registration__field contact_field" value="<?php echo $userText;?>" type="text" name="userText" placeholder="Ваш вопрос">
                        <input class="registration_submit" type="submit" name="submit" value="Отправить">
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </main>
<?php include ROOT.'/views/layouts/footer.php' ?>