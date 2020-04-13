<?php


class AdminOrderController extends AdminBase
{
    public function actionIndex() {
        self::checkAdmin();

        $orders = [];
        $orders = Order::getOrders();
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    public function actionUser($id) {
        self::checkAdmin();
        $orders = [];
        $orders = Order::getUserOrders($id);
        $user = User::getUserById($id);
        $paid = count(array_filter($orders, function ($order) {
            return $order['status_id'] === '1';
        }));

        $paidSum = array_sum(array_column(array_filter($orders, function ($order) {
            return $order['status_id'] === '1';
        }), 'sum'));

        $new = count(array_filter($orders, function ($order) {
            return $order['status_id'] === '0';
        }));

        $newSum = array_sum(array_column(array_filter($orders, function ($order) {
            return $order['status_id'] === '0';
        }), 'sum'));

        $canceled = count(array_filter($orders, function ($order) {
            return $order['status_id'] === '2';
        }));

        $canceledSum = array_sum(array_column(array_filter($orders, function ($order) {
            return $order['status_id'] === '2';
        }), 'sum'));
        $sum = $newSum + $paidSum + $canceledSum;
        $total = $new + $paid + $canceled;
        require_once(ROOT . '/views/admin_order/user_list.php');
        return true;
    }

    public function actionUpdate($order_id) {
        self::checkAdmin();
        $status = Order::getOrderStatuses();
        $order = [];
        $order = Order::getOrderContentById($order_id);
        $orderInfo = Order::getOrderInfoById($order_id);
        $totalPrice = 0;
        foreach ($order as $product) {
            $totalPrice += $product['amount'] * $product['price'];
        }
        require_once(ROOT . '/views/admin_order/edit.php');
        return true;
    }

    public function actionDelete($order_id) {
        self::checkAdmin();
        $order = Order::getOrderInfoById($order_id);
        if ($order['status'] == 2) {
            $error = "Заказ №" . $order_id . " был отменен ранее!";
            require_once(ROOT . '/views/admin/error.php');
            return true;
        }
        $orderContent = Order::getOrderContentById($order_id);
        $sum = 0;

        foreach ($orderContent as $item) {
            $sum += $item['amount'] * $item['price'];
        }
        if(Order::deleteOrderById($order_id, $order['status'], $sum,  $order['user_id'], $orderContent)) {
            $success = "Заказ №" . $order_id . " был успешно отменен!";
            require_once(ROOT . '/views/admin/success.php');
            return true;
        } else {
            $error = "При отмене заказа №" . $order_id . " произошла ошибка! Попробуйте еще раз";
            require_once(ROOT . '/views/admin/error.php');
            return true;
        }
    }
    public function actionDeleteProduct($order_id, $order_element) {
        $userId = User::checkLogged();
        Order::deleteOrderElement($order_element);
        $totalAmount = Order::getAmountProductInOrder($order_id);
        if ($totalAmount["count"] > 0) {
            header("Location:/admin/order/update/$order_id");
        } else {
            //Нужна ошибка
            $result = Order::deleteEmptyOrder($order_id);
            header("Location:/admin/user/" . $userId);
        }
    }

}