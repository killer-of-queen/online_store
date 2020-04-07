<?php


class AdminProductController extends AdminBase
{
    public function actionIndex() {
        self::checkAdmin();

        $productList = Product::getAllProductList();

        require_once (ROOT . '/views/admin_product/index.php');
        return true;
    }


    public function actionCreate() {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
        }
    }

    public function actionDelete($id) {
        self::checkAdmin();

        Product::deleteProductById($id);

        header("Location: /admin/product");
    }
}