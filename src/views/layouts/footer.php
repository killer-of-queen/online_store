            </div>
            <footer class="footer">
                <div class="footer__subscription">
                    <div class="wrapper footer__wrapper footer__wrapper-subscription">
                        <div class="footer__subscription-info">
                            <div class="footer__subscription-info-icon" >
                                <i class="fa fa-envelope fa-3x" style="color: #3E2774" aria-hidden="true"></i>
                            </div>
                            <div class="footer__subscription-info-text">
                                <span>Подписывайтесь <br>на новости и акции</span>
                            </div>
                        </div>
                        <form action="" class="footer__subscription-form">
                            <input placeholder="Оставьте свой адрес электронной почты" type="email" class="input">
                            <button class="footer__subscription-form-button">Подписаться</button>
                        </form>
                    </div>
                </div>
                <div class="wrapper footer__info">
                    <div class="footer__info__category">
                        <div class="footer__info__category__name">Каталог</div>
                        <a class="footer__info-item" href="#">Список товаров</a>
                        <a class="footer__info-item" href="#">Акции</a>
                        <a class="footer__info-item" href="#">Новинки</a>
                    </div>
                    <div class="footer__info__category">
                        <div class="footer__info__category__name">Новости</div>
                        <a class="footer__info-item" href="#">Блог</a>
                        <a class="footer__info-item" href="#">Акции</a>
                        <a class="footer__info-item" href="#">Реклама</a>
                    </div>
                    <div class="footer__info__category">
                        <div class="footer__info__category__name">Информация</div>
                        <a class="footer__info-item" href="#">Наша команда</a>
                        <a class="footer__info-item" href="#">Отзывы</a>
                        <a class="footer__info-item" href="#">Партнеры</a>
                    </div>
                    <div class="footer__info__category">
                        <div class="footer__info__category__name">Контакты</div>
                        <a class="footer__info-item" href="tel:+7 (996) 072-31-92"><i class="fa fa-phone" style="color: #3E2774" aria-hidden="true"></i>&nbsp;+7 (996) 072-31-92</a>
                        <a class="footer__info-item" href="mailto:margarita_star92@mail.ru"><i class="fa fa-envelope" style="color: #3E2774" aria-hidden="true"></i>&nbsp;margarita_star92@mail.ru</a>
                        <a class="footer__info-item" href="#"><i class="fa fa-home" style="color: #3E2774" aria-hidden="true"></i> г.Южно-Сахалинск,<br>ул&nbsp;Есенина&nbsp;3-39</a>
                    </div>
                </div>
                <div class="wrapper">
                    <hr class="footer__info__delimiter" size="1" noshade>
                </div>
                <div class="wrapper footer__social__info">
                    <div class="footer__social__info__item">
                        <i class="fa fa-twitter fa-2x" style="color: #3E2774" aria-hidden="true"></i>
                    </div>
                    <div class="footer__social__info__item">
                        <i class="fa fa-instagram fa-2x" style="color: #3E2774" aria-hidden="true"></i>
                    </div>
                    <div class="footer__social__info__item">
                        <i class="fa fa-vk fa-2x" style="color: #3E2774" aria-hidden="true"></i>
                    </div>
                    <div class="footer__social__info__item">
                        <i class="fa fa-facebook fa-2x" style="color: #3E2774" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="footer__copyright">
                    <div class="wrapper">
                        <span class="footer__copyright__text">Copyright 2020 &copy; - Все права защищены</span>
                    </div>
                </div>
            </footer>
        </div>
            <script>
                $(document).ready(function () {
                    $(".add-to-cart").click(function () {
                        var id = $(this).attr("data-id");
                        $.post("/cart/addAjax/" + id, {}, function (data) {
                            $("#cart-count").html(data);
                        });
                        return false;
                    })
                })
            </script>
    </body>
</html>