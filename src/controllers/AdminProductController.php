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
            $options['price'] = ($_POST['price'] == '') ? '0' : $_POST['price'];
            $options['short_name'] = $_POST['short_name'];
            $options['short_description'] = $_POST['short_description'];
            $options['description'] = $_POST['description'];
            $options['amount'] = $_POST['amount'];

            $errors = false;
            $success = false;
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = Product::createProduct($options);
                if($id) {
                    $success = "Новый товар №" . $id . " был успешно добавлен";
                    require_once (ROOT . '/views/admin/success.php');
                    return true;
                    //if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    //move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] .  '/template/images/');
                    // }
                    return true;
                }
            }
        }

        require_once (ROOT . '/views/admin_product/create.php');
        return true;
    }

    public function actionDelete($id) {
        self::checkAdmin();

        Product::deleteProductById($id);

        header("Location: /admin/product");
    }

    public function actionUpdate($id) {

        $product = Product::getProductItemById($id);
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $short_name = $_POST['short_name'];
            $short_description = $_POST['short_description'];
            $description = $_POST['description'];
            $amount = $_POST['amount'];
        }

        require_once (ROOT . '/views/admin_product/update.php');
        return true;
    }
}