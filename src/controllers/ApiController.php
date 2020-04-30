<?php
use \Firebase\JWT\JWT;


class ApiController
{
    public function auth() {
        $jwt=isset($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : "";
        if($jwt) {
            $key = "dkjfvbdjhvdfvbjdu8765";
            try {
                $decoded = JWT::decode($jwt, $key, array('HS256'));
                return true;
            }
            catch (Exception $e){
                return false;
            }
        }
        return false;
    }

    public function actionLogin() {
        header("Access-Control-Allow-Origin: http://authentication-jwt/");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $data = json_decode(file_get_contents("php://input"));
        $login = $data->login;
        $password = $data->password;

        $user = Api::checkUserData($login, $password);
        if ($user) {
            $token = array(
                "data" => array(
                    "id" => $user->id,
                    "login" => $user->login
                )
            );
            http_response_code(200);
            $key = "dkjfvbdjhvdfvbjdu8765";
            $jwt = JWT::encode($token, $key);
            echo json_encode(
                array(
                    "message" => "Успешный вход в систему.",
                    "jwt" => $jwt
                )
            );
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Ошибка входа."));
        }

    }

    public function actionRegister() {
        header("Access-Control-Allow-Origin: http://authentication-jwt/");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $data = json_decode(file_get_contents("php://input"));
        $login = $data->login;
        $password = $data->password;
        $user = Api::register($login, $password);
        if ($user) {
            http_response_code(200);
            echo json_encode($user);
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Невозможно создать пользователя."));
        }
        return true;
    }

    public function actionProducts() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        if(!self::auth()) {
            http_response_code(401);
            echo json_encode(array(
                "message" => "Отказано в доступе"
            ));
            return true;
        }
        $products_arr = Product::getAllProductList();
        if ($products_arr)
        {
            http_response_code(200);
            echo json_encode($products_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
        }
        return true;
    }

    public function actionProduct($id) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        $product = Product::getProductItemById($id);
        if($product)
        {
            http_response_code(200);
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Товар не найден."), JSON_UNESCAPED_UNICODE);
        }
        return true;
    }
}