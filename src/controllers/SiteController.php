<?php


class SiteController
{
    public function actionIndex() {
        require_once (ROOT.'/views/site/index.php');
        return true;
    }

    public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = false;
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail)) {
                $errors['is_email_correct'] = 'Неправильный email!';
            }

            if ($errors == false) {
                $adminEmail = 'margarita_star92@mail.ru';
                $message = "Текст: {$userText}. От: {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        require_once (ROOT . '/views/site/contact.php');
        return true;
    }
}