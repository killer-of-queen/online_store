<?php
use \Firebase\JWT\JWT;

class Api
{
    public static function register($login, $password) {
        $db = Db::getConnection();

        $password = password_hash($password, PASSWORD_ARGON2ID);
        $token_info = [
            'login' => $login,
            'createdTime' => time() + 3600,
        ];

        $token = JWT::encode($token_info, KEY);

        $sql = 'INSERT INTO api_user(login, password, token) '
            . 'VALUES (:login, :password, :token)';


        $result = $db->prepare($sql);
        $result->bindParam(':login', $login);
        $result->bindParam(':password', $password);
        $result->bindParam(':token', $token);


        if ($result->execute()) {
            $user_data = [];
            $user_data['token'] = $token;
            $user_data['id'] = $db->lastInsertId();
            return $user_data;
        } else {
            return false;
        }

    }

    public static function loginExists($login) {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM api_user WHERE login = :login';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();
        if($result->fetchColumn()) {
            return true;
        }
        return false;
    }

    public static function checkUserData($login, $password) {

        $db = Db::getConnection();

        $sql = 'SELECT * FROM api_user WHERE login = :login';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}