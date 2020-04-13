<?php


class CartController
{
    public function actionAdd($id) {
        Cart::addProduct($id);
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionAddAjax($id) {
        echo Cart::addProduct($id);
        return true;
    }

    public function actionIndex() {
        $userId = User::checkLogged();
        $productsInCart = false;

        $productsInCart = Cart::getProducts();
        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    public function actionCheckout() {
        $result = false;

        if (isset($_POST['submit'])) {
            $userName = $_POST['name'];
            $userPhone = $_POST['tel'];
            $userComment = $_POST['comment'];

            $errors = false;
            if (!User::checkName($userName)) {
                $errors['error_name'] = 'Неправильное имя';
                echo "Name!";
            }
            if (!User::checkPhone($userPhone)) {
                $errors['error_phone'] = 'Неправильный телефон';
                echo "Phone!";
            }

            if ($errors == false) {
                $productsInCart = Cart::getProducts();
                if (User::isGuest())
                    $userId = false;
                else
                    $userId = User::checkLogged();

                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    Cart::clear();
                    $adminEmail = 'margarita_star92@mail.ru';
                    $message = 'http://localhost/admin/orders';
                    $subject = 'Новый заказ';
                    mail($adminEmail, $subject, $message);
                } else {
                    $productsInCart = Cart::getProducts();
                    $productsIds = array_keys($productsInCart);
                    $products = Product::getProductsByIds($productsIds);
                    $totalPrice = Cart::getTotalPrice($products);
                    $totalQuantity = Cart::countItems();
                }
            }
        } else {
            $productsInCart = Cart::getProducts();

            if ($productsInCart == false)
                header("Location: /");
            else {

                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                if (User::isGuest()) {

                } else {
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    $userName = $user['login'];
                }
            }
        }

        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

    public function actionDelete($id) {
        $userId = User::checkLogged();
        Cart::deleteProduct($id);
        header("Location:/cart/");
    }
}