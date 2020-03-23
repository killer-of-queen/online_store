<?php


class OrderController
{
    public function actionContent($order_id) {
        $totalPrice = 0;
        $order = [];
        $order = Order::getOrderContentById($order_id);
        foreach ($order as $item) {
            $totalPrice += $item['price'] * $item['amount'];
        }
        $orderInfo = Order::getOrderInfoById($order_id);
        require_once(ROOT . '/views/order/content.php');
        return true;
    }

    public function actionDelete($order_id, $order_element) {
        Order::deleteOrderElement($order_element);
        header("Location:/order/content/$order_id");
    }

    public function actionPayment($order_id) {
        if (User::isGuest()) {
            header("Location:/login");
        }
        else
            $userId = User::checkLogged();

        $price = 0;
        $order = Order::getOrderContentById($order_id);
        foreach ($order as $item)
            $price += $item['price'];

        $error = false;
        if (!User::checkBalance($userId, $price)) {
            $error['balance'] = 'Недостаточно средств на вашем счете. Пополните баланс';
        } else {
            $result = Order::Pay($userId, $price, $order_id);
            if ($result) {
                header("Location:/order/content/$order_id");
            } else {

            }
        }
        return true;
    }
}