<?php include ROOT.'/views/layouts/header.php' ?>
    <main class="product__item-info">
        <div class="wrapper">
            <p class="product__item-short_name"><?php echo $productItem['short_name']?></p>
            <div class="wrapper__product-item">
                <div>
                    <img src="/template/images/<?php echo $productItem['image']?>" width="500px" alt="">
                </div>
                <div>
                    <p class="product__item-name"><?php echo $productItem['name']?></p>
                    <p class="product__item-short_description"><?php echo $productItem['short_description']?></p>
                    <p class="product__item-price"><span>Цена:</span> <?php echo $productItem['price']?>$</p>
                    <p class="product__item-description"><span>Описание:</span> <?php echo $productItem['description']?></p>
                    <button class="product-list__btn-buy">Добавить в корзину</button>
                </div>
            </div>
        </div>
    </main>
<?php include ROOT.'/views/layouts/footer.php' ?>