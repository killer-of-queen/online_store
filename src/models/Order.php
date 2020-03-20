<?php


class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $productsInCart) {
        $products = json_encode($productsInCart);

        $productsIds = array_keys($productsInCart);
        $productsList = Product::getProductsByIds($productsIds);
        $totalAmount = 0;

        foreach ($productsIds as $id) {
            $totalAmount += Product::productAmount($id);
        }

        $totalPrice = Cart::getTotalPrice($productsList);

        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products, quantity, price) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products, :quantity, :price)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        $result->bindParam(':quantity', $totalAmount, PDO::PARAM_INT);
        $result->bindParam(':price', $totalPrice);

        return $result->execute();
    }

    public static function getUserOrders($userId) {
        $db = Db::getConnection();

        $sql = "SELECT product_order.id AS id, status, price, quantity, DATE_FORMAT(date, '%d.%m.%Y') AS date, 
                status.name AS status 
                    FROM product_order 
                    INNER JOIN status ON product_order.status=status.id 
                    WHERE user_id=:id";
        $result = $db->prepare($sql);

        $result->bindParam(':id', $userId);
        $result->execute();

        $result -> setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        $orders = false;
        while ($row = $result->fetch()) {
            $orders[$i]['id'] = $row['id'];
            $orders[$i]['date'] = $row['date'];
            $orders[$i]['status'] = $row['status'];
            $orders[$i]['price'] = $row['price'];
            $orders[$i]['quantity'] = $row['quantity'];
            $i++;
        }
        return $orders;
    }
}