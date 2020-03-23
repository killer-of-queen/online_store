<?php


class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $productsInCart) {
        //Creating data for transaction
        $productsIds = array_keys($productsInCart);
        $productsList = Product::getProductsByIds($productsIds);
        $totalAmount = 0;

        $approvedProductList = [];
        foreach ($productsList as $listItem) {
            $id = $listItem['id'];
            $amount = $listItem['amount'];
            $count = $productsInCart[$listItem['id']];
            $count = ($amount < $count) ? $amount : $count;
            $totalAmount += $count;
            array_push($approvedProductList, ["user_id" => $userId, "order_id" => false, "product_id" => $id, "amount" => $count, "price" => $listItem['price']]);
        }

        //Connection to DB
        $db = Db::getConnection();

        //Transaction
        try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->beginTransaction();

        //First query (creating order)
        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, quantity) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :quantity)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':quantity', $totalAmount, PDO::PARAM_INT);
        $result->execute();


        //Creating data for second query
        $order_id = $db->lastInsertId();
        for ($i = 0; $i < count($approvedProductList); $i++) {
            $approvedProductList[$i]["order_id"] = $order_id;
        }

        //Second query (filling in the order)
        $prepValues = rtrim(str_repeat(' (?, ?, ?, ?),', sizeof($approvedProductList)), ',');
        $sql = "INSERT INTO order_content (order_id, product_id, amount, price) VALUES" . $prepValues;
        $result = $db->prepare($sql);
        for ($inx = 0; $inx < count($approvedProductList); $inx++) {
            $row = $inx * 4;
            $result->bindValue($row + 1, $approvedProductList[$inx]["order_id"], PDO::PARAM_INT);
            $result->bindValue($row + 2, $approvedProductList[$inx]["product_id"], PDO::PARAM_INT);
            $result->bindValue($row + 3, $approvedProductList[$inx]["amount"], PDO::PARAM_INT);
            $result->bindValue($row + 4, $approvedProductList[$inx]["price"]);
        }
        $result->execute();

        //Success transaction
        $db->commit();
        return true;
        } catch (Exception $e) {
            //Errors during transaction
            $db->rollBack();
            return false;
        }
    }

    public static function getUserOrders($userId) {
        $db = Db::getConnection();

        $sql = "SELECT product_order.id AS id, status, quantity, DATE_FORMAT(date, '%d.%m.%Y') AS date, 
                status.name AS status 
                    FROM product_order 
                    INNER JOIN status ON product_order.status=status.id 
                    WHERE user_id=:id";
        $result = $db->prepare($sql);

        $result->bindParam(':id', $userId);
        $result->execute();

        $result -> setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        $orders = [];
        while ($row = $result->fetch()) {
            $orders[$i]['id'] = $row['id'];
            $orders[$i]['date'] = $row['date'];
            $orders[$i]['status'] = $row['status'];
            $orders[$i]['quantity'] = $row['quantity'];
            $i++;
        }
        return $orders;
    }

    public static function getOrderContentById($order_id) {
        $db = Db::getConnection();

        $sql = "SELECT order_content.id AS id, order_content.amount AS amount, product.name AS name, product.image AS image, order_content.price AS price 
                FROM order_content 
                INNER JOIN product ON order_content.product_id=product.id 
                WHERE order_content.order_id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $order_id);

        $result->execute();
        $result -> setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;

        $products = [];
        while ($row = $result->fetch()) {
            $products[$i] = $row;
            $i++;
        }

        return $products;
    }

    public static function deleteOrderElement($order_element) {
        $db = Db::getConnection();
        $sql = "DELETE FROM order_content WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $order_element);
        return $result->execute();
    }

    public static function Pay($userId, $price, $order_id) {
        $db = Db::getConnection();
        try {
            $db->beginTransaction();
            $sql = "UPDATE product_order SET status=1 WHERE id=:id";
            $result = $db->prepare($sql);
            $result->bindParam(':id', $order_id);
            $result->execute();

            $sql = "UPDATE user SET balance=balance-:price WHERE id=:id";
            $result = $db->prepare($sql);
            $result->bindParam(':id', $userId);
            $result->bindParam(':price', $price);
            $result->execute();
            $db->commit();
            return true;
        } catch (Exception $err) {
            $db->rollBack();
            return false;
        }
    }

    public static function getOrderInfoById($order_id) {
        $db = Db::getConnection();
        $sql = "SELECT * FROM product_order WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $order_id);
        $result->execute();
        $result -> setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }
}