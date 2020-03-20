<?php


class CabinetController
{
    public function actionIndex() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $orders = Order::getUserOrders($userId);
        require_once (ROOT . '/views/cabinet/index.php');
        return true;
    }

    public function actionEditLogin() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $name = $_POST['name'];

        $answer = "";
        if (!User::checkName($name)) {
            $answer = "Имя не должно быть короче двух символов!";
        } else {
            $result = User::editName($userId, $name);
            if ($result) {
                $answer = "Успешно изменено";
            } else {
                $answer = "Что-то не так";
            }
        }
        echo $answer;
        return true;
    }

    public function actionEditEmail() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $email = $_POST['email'];

        $answer = "";

        if (!User::checkEmail($email)) {
            $answer = "Неправльный email!";
        } else {
            $result = User::editEmail($userId, $email);
            if ($result) {
                $answer = "Успешно изменено";
            } else {
                $answer = "Что-то не так";
            }
        }
        echo $answer;
        return true;
    }

    public function actionEditPassword() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $password = $_POST['password'];

        $answer = "";

        if (!User::checkPassword($password)) {
            $answer = "Пароль не должен быть короче 6-ти символов!";
        } else {
            $result = User::editPassword($userId, $password);
            if ($result) {
                $answer = "Успешно изменено";
            } else {
                $answer = "Что-то не так";
            }
        }
        echo $answer;
        return true;
    }

    public function actionDelete() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $errors = false;
        $result = false;
        if (isset($_POST['submit'])) {
            $result = User::deleteAccount($userId);
        }
        if ($result) {
            header("Location: /user/logout");
        } else {
            $errors['delete'] = "Что-то пошло не так";
        }
        require_once (ROOT . '/views/cabinet/index.php');
        return true;
    }

}