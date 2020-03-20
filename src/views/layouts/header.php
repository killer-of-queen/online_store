<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishStore</title>
    <link rel="stylesheet" href="/template/css/custom.css">
    <link href="/template/css/roboto.css" rel="stylesheet">
    <link rel="stylesheet" href="/template/css/font-awesome.css">
    <script src="/template/js/jquery.js"></script>
</head>
<body>
<div class="layout">
    <div class="content">
        <header class="header">
            <div class="wrapper header__wrapper">
                <a href="/">
                    <img src="/template/images/logo.svg" width="150px" alt="">
                </a>
                <a class="header__item" href="/about">О нас</a>
                <a class="header__item  <?php echo (isset($is_product)) ? 'header__item-active' : '';?>" href="/product">Каталог</a>
                <a class="header__item" href="/news">Новости</a>
                <a class="header__item" href="/contact">Контакты</a>
                <span>
                        <a class="header__item" href="/cabinet"><i class="fa fa-user fa-2x" aria-hidden="true" style="color: #FFB800"></i></a>
                        <a class="header__cart header__item" href="/cart">
                            <i class="fa fa-shopping-cart fa-2x" style="color: #FFB800" aria-hidden="true"></i>
                            <div id="cart-count" class="header__cart__counter"><?php echo Cart::countItems();?></div>
                        </a>
                    </span>
            </div>
        </header>
