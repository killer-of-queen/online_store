<?php


class AdminController extends AdminBase
{
    public function actionIndex() {
        self::checkAdmin();

        require_once(ROOT . '/views/admin/index.php');
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
                header("Location: /admin/index.php");
            }
        }

        require_once(ROOT . '/views/user/login.php');
        return true;
    }
}