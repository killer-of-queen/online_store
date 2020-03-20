<?php


class UserController
{
    public function actionRegister() {
        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $errors = false;
            if (!User::checkName($name)) {
                $errors['name'] = "Имя не должно быть короче двух символов!";
            }

            if (!User::checkEmail($email)) {
                $errors['email'] = "Неправльный email!";
            }

            if (!User::checkPassword($password)) {
                $errors['password'] = "Пароль не должен быть короче 6-ти символов!";
            }

            if(User::checkEmailExists($email)) {
                $errors['email_exists'] = "Такой email уже используется!";
            }

            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }
        }

        require_once(ROOT . '/views/user/register.php');
        return true;
    }

    public function actionLogin() {
        $email = '';
        $password = '';
        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            $email = $_POST['email'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors['email'] = "Неправльный email!";
            }

            if (!User::checkPassword($password)) {
                $errors['password'] = "Пароль не должен быть короче 6-ти символов!";
            }

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors['incorrect'] = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);
                header("Location: /cabinet");
            }
        }

        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: /");
    }

}