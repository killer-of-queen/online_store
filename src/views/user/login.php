<?php include ROOT.'/views/layouts/header.php' ?>
    <main class="main registration__wrapper">
        <div class="wrapper">
            <div class="registration">
                <p class="registration__header">Вход</p>
                <p class="registration__error">
                    <?php if (isset($errors) && isset($errors['incorrect'])): ?>
                        <?php if (isset($errors['incorrect'])): ?>
                            <?php echo $errors['incorrect'] ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo "&nbsp;" ?>
                    <?php endif; ?>
                </p>
                <form class="registration_form" action="#" method="post">
                    <label class="registration__label" for="email">Ваш адрес электронной почты</label>
                    <input id="email" class="registration__field" value="<?php echo $email;?>" type="email" name="email" placeholder="Ваш email">
                    <p class="registration__error">
                        <?php if (isset($errors) && isset($errors['email'])): ?>
                            <?php if (isset($errors['email'])): ?>
                                <?php echo $errors['email'] ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo "&nbsp;" ?>
                        <?php endif; ?>
                    </p>
                    <label class="registration__label" for="password">Ваш пароль</label>
                    <input id="password" class="registration__field" value="<?php echo $password;?>" type="password" name="password" placeholder="Пароль">
                    <p class="registration__error">
                        <?php if (isset($errors) && isset($errors['password'])): ?>
                            <?php if (isset($errors['password'])): ?>
                                <?php echo $errors['password'] ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo "&nbsp;" ?>
                        <?php endif; ?>
                    </p>
                    <div class="registration__form__choice">
                        <a class="registration__link" href="/user/register">Регистрация</a>
                        <input class="registration_submit" type="submit" name="submit" value="Войти">
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php include ROOT.'/views/layouts/footer.php' ?>