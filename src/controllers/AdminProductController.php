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
            $options['price'] = (float) $_POST['price'];
            $options['short_name'] = $_POST['short_name'];
            $options['short_description'] = $_POST['short_description'];
            $options['description'] = $_POST['description'];
            $options['amount'] = (int) $_POST['amount'];

            $errors = false;
            $success = false;
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = Product::createProduct($options);
                if($id) {
                    $success = "Новый товар №" . $id . " был успешно добавлен";
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        dump($_FILES['image']);
                        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/template/images/' . $_FILES['image']['name']);
                        Product::addProductImage($id, $_FILES['image']['name']);
                    }
                    require_once (ROOT . '/views/admin/success.php');
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
        self::checkAdmin();
        $product = Product::getProductItemById($id);
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['short_name'] = $_POST['short_name'];
            $options['short_description'] = $_POST['short_description'];
            $options['description'] = (float) $_POST['description'];
            $options['amount'] =  (int) $_POST['amount'];

            if (Product::updateProductById($id, $options)) {
                $success = "Товар №" . $id . " был успешно обновлен";
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/template/images/' . $_FILES['image']['name']);
                    Product::addProductImage($id, $_FILES['image']['name']);
                }
                require_once (ROOT . '/views/admin/success.php');
                return true;
            } else {
                $error = "Произошла ошибка при добавлении товара. Попробуйте еще раз.";
                require_once (ROOT . '/views/admin/error.php');
                return true;
            }
        }

        require_once (ROOT . '/views/admin_product/update.php');
        return true;
    }
}