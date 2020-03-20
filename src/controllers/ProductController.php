<?php

class ProductController
{
    public function actionList($page = 1)
    {
        $productList = array();
        $productList = Product::getProductList($page);
        $total = Product::getTotalProducts();
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        $is_product = 1;
        require_once (ROOT.'/views/product/index.php');
        return true;
    }

    public function actionView($id)
    {
        $productItem = Product::getProductItemById($id);
        $is_product = 1;
        require_once (ROOT.'/views/product/view.php');
        return true;
    }
}