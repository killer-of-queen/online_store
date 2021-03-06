<?php


class Product
{
    const SHOW_BY_DEFAULT = 3;

    public static function getTotalProducts()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT COUNT(id) as count FROM product');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];
    }

    public static function getProductItemById($id)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, price, image, short_name, short_description, description, amount FROM product WHERE id='.$id);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $productItem = $result->fetch();
        return $productItem;
    }

    public static function getProductList($page)
    {
        $db = Db::getConnection();

        /*Cмещение для ограниченного списка*/
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $productList = array();
        $result = $db->query('SELECT id, name, price, image FROM product WHERE amount > 0 LIMIT '.self::SHOW_BY_DEFAULT.' OFFSET '.$offset);
        $i = 0;
        while($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['image'] = $row['image'];
            $i++;
        }

        return $productList;
    }

    public static function getAllProductList() {
        $db = Db::getConnection();
        $productList = array();
        $result = $db->query('SELECT id, name, price, image, amount FROM product WHERE is_deleted=0');
        $i = 0;
        while($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['amount'] = $row['amount'];
            $i++;
        }

        return $productList;
    }

    public static function getProductsByIds($idsArray) {
        $products = array();

        $db = Db::getConnection();
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE id IN ($idsString)";

        $result = $db->query($sql);
        $result -> setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;

        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['amount'] = $row['amount'];
            $i++;
        }

        return $products;
    }

    public static function productAmount($id) {
        $db = Db::getConnection();
        $sql = "SELECT amount FROM product WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['amount'];
    }

    public static function deleteProductById($id) {
        $db = Db::getConnection();
        $sql = "UPDATE product SET is_deleted=1 WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        return $result->execute();
    }

    public static function createProduct($options) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO product '
                . '(name, price, short_name, short_description, description, amount) '
                . 'VALUES '
                . '(:name, :price, :short_name, :short_description, :description, :amount)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':short_name', $options['short_name'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':amount', $options['amount'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }

    public static function updateProductById($id, $options) {
        $db = Db::getConnection();

        $sql = "UPDATE product
            SET
                name=:name,
                price=:price,
                short_name=:short_name,
                short_description=:short_description,
                description=:description,
                amount=:amount
            WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':short_name', $options['short_name'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':amount', $options['amount'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function addProductImage($id, $image) {
        $db = Db::getConnection();
        $sql = "UPDATE product
            SET
                image=:image
            WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':image', $image, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}