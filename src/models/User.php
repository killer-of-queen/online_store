<?php
use \Firebase\JWT\JWT;

class User
{

    public static function register($name, $email, $password) {
        $db = Db::getConnection();

        $password = password_hash($password, PASSWORD_ARGON2ID);

        $sql = 'INSERT INTO user (login, email, password, role) '
                . 'VALUES (:name, :email, :password, 1)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name);
        $result->bindParam(':email', $email);
        $result->bindParam(':password', $password);
        return $result->execute();
    }

    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkBalance($userId, $totalPrice) {
        $user = User::getUserById($userId);
        $balance = $user['balance'];
        if ($balance < $totalPrice) {
            return false;
        }
        return true;
    }

    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkPhone($phone) {
        return preg_match('/\+7\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}/', $phone);
    }

    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email) {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if($result->fetchColumn()) {
            return true;
        }
        return false;
    }

    public static function checkUserData($email, $password) {

        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    public static function auth($userId) {
        $payload = [
            'userId' => $userId,
            'exp' => time() + 3600,
        ];
        $jwt = JWT::encode($payload, KEY);
        setcookie('jwtAuth', $jwt, time() + 3600, "/");
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged() {
        if (isset($_COOKIE['jwtAuth'])) {
            $jwt = $_COOKIE['jwtAuth'];
            $decoded = JWT::decode($jwt, KEY, array('HS256'));
        }
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }

    public static function isGuest() {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function getUserById($id) {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            return $result->fetch();
        }
    }

    public static function editName($id, $name) {
        $db = Db::getConnection();

        $sql = "UPDATE user
                SET login = :name  WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function editEmail($id, $email) {
        $db = Db::getConnection();

        $sql = "UPDATE user
                SET email = :email  WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function editPassword($id, $password) {
        $db = Db::getConnection();

        $password = password_hash($password, PASSWORD_ARGON2ID);

        $sql = "UPDATE user
                SET password = :password  WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function deleteAccount($id) {
        $db = Db::getConnection();

        $sql = "UPDATE user
                SET is_deleted = 1  WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}