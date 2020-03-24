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
        $totalAmount = Order::getAmountProductInOrder($order_id);
        if ($totalAmount["count"] > 0) {
            header("Location:/order/content/$order_id");
        } else {
            //Нужна ошибка
            $result = Order::deleteEmptyOrder($order_id);
            header("Location:/cabinet");
        }
    }

    public function actionPayment($order_id) {

        $userId = User::checkLogged();

        $price = 0;
        $order = Order::getOrderContentById($order_id);
        foreach ($order as $item)
            $price += $item['price'];

        $error = "";
        if (!User::checkBalance($userId, $price)) {
            $error = 'Недостаточно средств на вашем счете. Пополните баланс';
        } else {
            $result = Order::Pay($userId, $price, $order_id);
            if ($result) {
                $error = "ok";
            } else {
                $error = 'Что то пошло не так...';
            }
        }
        echo $error;
        return true;
    }
}