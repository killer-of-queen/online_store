<?php include ROOT.'/views/layouts/header.php' ?>
    <main class="main registration__wrapper">
        <div class="wrapper">
            <?php if($result): ?>
                <p class="registration__success">Вы были успешно зарегистрированы!</p>
            <?php else: ?>
                <div class="registration">
                    <p class="registration__header">Регистрация</p>
                    <p class="registration__error">
                        <?php if (isset($errors) && isset($errors['email_exists'])): ?>
                            <?php if (isset($errors['email_exists'])): ?>
                                <?php echo $errors['email_exists'] ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo "&nbsp;" ?>
                        <?php endif; ?>
                    </p>
                    <form class="registration_form" action="#" method="post">
                        <label class="registration__label" for="name">Ваше имя</label>
                        <input id="name" class="registration__field" value="<?php echo $name;?>" type="text" name="name" placeholder="Ваше имя">
                        <p class="registration__error">
                            <?php if (isset($errors) && isset($errors['name'])): ?>
                                <?php if (isset($errors['name'])): ?>
                                    <?php echo $errors['name'] ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo "&nbsp;" ?>
                            <?php endif; ?>
                        </p>
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
                        <input class="registration_submit" type="submit" name="submit" value="Зарегистрироваться">
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </main>
<?php include ROOT.'/views/layouts/footer.php' ?>