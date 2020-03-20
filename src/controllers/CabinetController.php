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

        $name = $user['login'];

        $result = false;
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];

            $errors = false;
            if (!User::checkName($name)) {
                $errors['name'] = "Имя не должно быть короче двух символов!";
            }

            if ($errors == false) {
                $result = User::editName($userId, $name);
            }
        }
        header("Location: /cabinet");
    }

    public function actionEditEmail() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $email = $user['email'];

        $result = false;
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];

            $errors = false;
            if (!User::checkEmail($email)) {
                $errors['email'] = "Неправльный email!";
            }

            if ($errors == false) {
                $result = User::editEmail($userId, $email);
            }
        }
        header("Location: /cabinet");
    }

    public function actionEditPassword() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $password = $user['password'];

        $result = false;
        if (isset($_POST['submit'])) {
            $password = $_POST['password'];

            $errors = false;
            if (!User::checkPassword($password)) {
                $errors['password'] = "Пароль не должен быть короче 6-ти символов!";
            }

            if ($errors == false) {
                $result = User::editPassword($userId, $password);
            }
        }
        header("Location: /cabinet");
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
        return true;
    }

}