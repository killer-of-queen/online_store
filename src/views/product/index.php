<?php include ROOT.'/views/layouts/header.php' ?>
    <main>
        <div class="product-list wrapper">
            <div class=" wrapper__product-list">
                <?php foreach ($productList as $item):?>
                    <a class="product-list__item-link" href="/product/<?php echo $item['id']?>">
                        <div class="product-list__item">
                            <img class="product-list__image" src="/template/images/<?php echo $item['image']?>" width="290px" height="290px" alt="">
                            <div class="product-list__content">
                                <div>
                                    <p class="product-list__item-name"><?php echo $item['name']?></p>
                                    <p class="product-list__item-price"><?php echo $item['price']?>$</p>
                                </div>
                                <button data-id="<?php echo $item['id']?>" class="add-to-cart product-list__btn-buy">КУПИТЬ</button>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="catalog__paginator"><?php echo $pagination->get() ?></div>
        </div>
    </main>
<?php include ROOT.'/views/layouts/footer.php' ?>